<?php

class TwitterStatus extends AppModel
{
    // Mainly for PHP4 users
    var $name = 'TwitterStatus';

    // Which db table to use
    var $useTable = 'twitter_statues';
    
    var $hasMany = array( 'TwitterTranslation' => array(
                                        'className' => 'TwitterTranslation',
                                        'foreignKey' => 'twitter_status_id' ) );
    
    var $belongsTo = array( 'TwitterRequest' => array(
                                        'className' => 'TwitterRequest',
                                        'foreignKey' => 'twitter_request_id' ) );  

    /*
    * Save statuses into database
    */    
    function saveStatuses( $statuses, $twitterReqId ) {
    
        // check we have a twitter request id
        if ( !is_numeric( $twitterReqId ) ) {
            return;
        }
               
        $xml = new SimpleXMLElement( $statuses );

        foreach ($xml->status as $status) {
            
            $statusData = array();
            
            $statusData[ "twitter_request_id" ] = $twitterReqId;
            
            $statusData[ "t_created_at" ] = $status->created_at;
            $statusData[ "t_id" ] = $status->id;
            $statusData[ "t_text" ] = $status->text;
            $statusData[ "t_source" ] = $status->source;
            $statusData[ "t_truncated" ] = $status->truncated;
            $statusData[ "t_in_reply_to_status_id" ] =
                                            $status->in_reply_to_status_id;
            $statusData[ "t_in_reply_to_user_id" ] =
                                            $status->in_reply_to_user_id;
            $statusData[ "t_favorited" ] = $status->favorited;
            
            $statusData[ "t_user_id" ] = $status->user->id;
            $statusData[ "t_user_name" ] = $status->user->name;
            $statusData[ "t_user_screen_name" ] = $status->user->screen_name;
            $statusData[ "t_user_location" ] = $status->user->location;
            $statusData[ "t_user_description" ] = $status->user->description;
            $statusData[ "t_user_profile_image_url" ] =
                                            $status->user->profile_image_url;
            $statusData[ "t_user_url" ] = $status->user->url;
            $statusData[ "t_user_protected" ] = $status->user->protected;
            $statusData[ "t_user_followers_count" ] =
                                            $status->user->followers_count;
           
            $this->create( $statusData );
            $this->save(); 
        }
    }   
    
}

?>