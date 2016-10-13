<?php

class TwitterStatusController extends AppController {

    // View any particular twitter request
    var $currentTwitterReqId = '';
    
    /*
    * View statuses
    */    
    function index( $twitterReqId = '', $transLang = '' ) {

        // Override current twitter request
        if ( $twitterReqId ) {
            $this->currentTwitterReqId = $twitterReqId;
        }
        
        if ( isset( $this->passedArgs['id'] ) ) {
            $this->currentTwitterReqId = $this->passedArgs['id'];
        }	
        
        // If there is no id for the current request, then we assume
        // most recent statuses so we only cache for 60 secs
        if ( $this->currentTwitterReqId ) {
            // cache it for a year     
            $this->cacheAction = array( 'duration' => 31536000 );
        }
        else {
            $this->cacheAction = array( 'duration' => 60 );
        }
				
        // Override current language view
        if ( $transLang ) {
            $this->currentLang = $transLang;
        }
        
        if ( isset( $this->passedArgs['lang'] ) ) {
            $this->currentLang = $this->passedArgs['lang'];
        }
				
        $this->__displayTwitters();
    }
    
    /*
    * This displays the minute we want
    */    
	function __displayTwitters() {
		
        // We check whether a particular twitter request was requested or
        // we just fetch the recent one
        $conditions = array();
        
        if ( is_numeric( $this->currentTwitterReqId ) ) {
            $conditions[ 'TwitterRequest.id' ] = $this->currentTwitterReqId;
        }
        else {
            $conditions = array ();
            $conditions[] = array(
                "TwitterStatus.t_created_at <" => date(
                                            'Y-m-d H:i:00', 
                                            strtotime( "-1 minute" )
                                            ) );
            $conditions[] = array(
                "TwitterStatus.t_created_at >" => date(
                                            'Y-m-d H:i:00',
                                            strtotime( "-2 minute" )
                                            ) );                                    
        }
                   
        // Check to see if user has selected to view the statuses in
        // any particular language 
        if ( $this->currentLang ) {       
        
            $twitTransTable = array(
                'TwitterTranslation' => array( 
                                'className' => 'TwitterTranslation', 
                                'foreignKey' => 'twitter_status_id', 
                                'conditions' => "TwitterTranslation.lang_to = '{$this->currentLang}'" ) );
    
            $this->TwitterStatus->bindModel(
                                array( 'hasMany' => $twitTransTable ) );
        }
        else {
            // No point getting translation, so lets unbind it
            $this->TwitterStatus->unbindModel(
                        array( 'hasMany' => array( 'TwitterTranslation' ) ) );
        }                                                                                                   
                                
        $min_statuses = $this->TwitterStatus->find( 'all', 
                        array(  'conditions' => $conditions, 
                                null, 
                                'order' => 'TwitterStatus.t_created_at DESC'
                                ) );
                
        // OK, now we got the status for the minute in question,
        // we check whether the language translation exists
        // in those statuses
        $statusesTrans = $this->__statusTranslate( $min_statuses );                                                 
                             
        // The view has no knowledge of what lang to display something,
        // so we need another layer                             
        $this->set( 'statuses', $statusesTrans );    
    }
    
    /*
    * Translate the given statuses
    */    
    function __statusTranslate( $statuses ) {
    
        $result = array();
    
        for( $idx=0; $idx<sizeof( $statuses ); $idx++ ) {
                
            // Original language text
            $t_user_name = $statuses[$idx][ "TwitterStatus" ][ "t_user_name" ];
            $t_text = $statuses[$idx][ "TwitterStatus" ][ "t_text" ];
            $t_user_url = $statuses[$idx][ "TwitterStatus" ][ "t_user_url" ];
            $t_user_profile_image_url = $statuses[$idx][ "TwitterStatus" ][ "t_user_profile_image_url" ];
            $t_user_location =
                    $statuses[$idx][ "TwitterStatus" ][ "t_user_location" ];
            $t_user_screen_name =
                $statuses[$idx][ "TwitterStatus" ][ "t_user_screen_name" ];
            $t_created_at = $statuses[$idx][ "TwitterStatus" ][ "t_created_at" ];
                  
            // We only check if there is a destination language specified                                
            // Check if there is a translation from the original to the
            // destination, if there is, we override, original text
            if ( $this->currentLang ) {   
            
                if ( isset( $statuses[$idx][ "TwitterTranslation" ] ) ) {
                
                    // Note we only translate status                        
                
                    $trans_result = $this->__getStatusTranslation(
                                                        $statuses[$idx] );
                    
                    if ( isset( $trans_result[ "t_text" ] ) ) {
                        $t_text = $trans_result[ "t_text" ];
                    }
                }
            }
                    
            $current_result = array();
            
            $current_result[ "v_t_user_name" ] = $t_user_name;
            $current_result[ "v_t_text" ] = $t_text;
            $current_result[ "v_t_user_url" ] = $t_user_url;
            $current_result[ "v_t_user_profile_image_url" ] =
                                                $t_user_profile_image_url;
            $current_result[ "v_t_user_location" ] = $t_user_location;
            $current_result[ "v_t_user_screen_name" ] = $t_user_screen_name;
            $current_result[ "v_t_created_at" ] = $t_created_at;
            
            $result[] = $current_result;
        }
        
        return $result;
    }
    
    /*
    * Translate one status
    */    
    function __getStatusTranslation( $statuses ) {
    
        $result = array();
        
        $transTo = $this->currentLang;

        // 1. check t_text translation, we always use the first one
        if ( isset( $statuses[ "TwitterTranslation" ][0][ "t_text_translation" ] ) ) {
            
            // yes there is a translation, lets use that
            $result[ "t_text" ] =
                $statuses[ "TwitterTranslation" ][0][ "t_text_translation" ];                                
        }
        else {
            $sourceLang = '';
        
            // no there is no translation, lets get one
            
            // start with t_text
            $t_text = $statuses[ "TwitterStatus" ][ "t_text" ];
            $google_trans_result =
                                $this->__translateText( $t_text, $transTo );
            
            $result[ "t_text" ] = $google_trans_result[ "translation" ];
            $sourceLang = $google_trans_result[ "source_lang" ];
        
            $this->__saveTrans( $sourceLang,
                                $transTo, 
                                $result, 
                                $statuses[ "TwitterStatus" ][ "id" ] );
        }
                
        return $result;
    }
    
    /*
    * This requests the Google Translator and translates given text
    */    
    function __translateText( $transText, $destLang ) {
    
        $result = array(    "translation" => "",
                            "source_lang" => "",
                            "response_status" => "" );
    
        if ( empty( $transText ) ) { return ""; }
    
        $params = array();
		$params[ "v" ] = "1.0";
		$params[ "q" ] = $transText;
		$params[ "langpair" ] = "|".$destLang;
		$params[ "key" ] = "!!!!!! Insert Your Google API Key Here !!!!!!";
						
		$paramStr = $this->__constructURL( $params );
        
        $url = "http://ajax.googleapis.com/ajax/services/language/translate?".$paramStr;

        App::import( 'HttpSocket' );
        $http = new HttpSocket();
        $request = array(
            'uri' => $url,
            'header' => array(
            'Referer' => 'http://'.env('SERVER_NAME')
            )
        );
        $body = $http->request($request);
        
        // now, process the JSON string
        $json = json_decode( $body );
        
        if ( isset( $json->responseStatus ) ) {
        
            // translation was good
            if ( $json->responseStatus == "200" ) {
                $result[ "translation" ] = $json->responseData->translatedText;
                $result[ "source_lang" ] = $json->responseData->detectedSourceLanguage;
                $result[ "response_status" ] = "200";
            }
            else {
                // we just fill with original
                $result[ "translation" ] = $transText;
                $result[ "source_lang" ] = "UNKNOWN";
                $result[ "response_status" ] = $json->responseStatus;
            }
        }
                
        // we always wait for a bit before next action, 0.5 sec
        usleep( 500000 );
        
        return $result;
    }
    
    /*
    * Save a status translation
    */    
    function __saveTrans( $sourceLang, $destLang, $transResult, $twitterStatusId ) {
    
        // We first check whether the translation exists for the
        // "twitter_status_id" and "lang_to" even if it does, we may 
        // still have 2 or more of the same entries in the database.
        
        $conditions = array (
                    "TwitterTranslation.twitter_status_id" => $twitterStatusId,
                    "TwitterTranslation.lang_to" => $destLang
                                );      
                      
        $transExist = $this->TwitterTranslation->find(
                            'first', array(  'conditions' => $conditions ) );
        
        
        if ( empty( $transExist ) ) {
   
            $statusTrans = array();
            $statusTrans[ 'lang_from' ] = $sourceLang;
            $statusTrans[ 'lang_to' ] = $destLang;
            $statusTrans[ 't_text_translation' ] = $transResult[ "t_text" ];
            $statusTrans[ 'twitter_status_id' ] = $twitterStatusId;
            
            $this->TwitterTranslation->create( $statusTrans );
            $this->TwitterTranslation->save();
        }
    }
    
    /*
	* Form URL query string
	*/	
	function __constructURL( $params ) {
	
        $result = '';
	
        foreach ( $params as $key => $value) {
            $result .= $key.'='.urlencode( $value ).'&';
        }	       
        
        return $result;        
    }

}

?>