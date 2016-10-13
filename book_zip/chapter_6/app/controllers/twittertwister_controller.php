<?php

class TwittertwisterController extends AppController {

    var $name = 'Twittertwister';

    var $uses = array();
	
	/*
    * User specifically changed language
    */    
	function changeLanguage() {
		        
        if ( $this->data[ "Twittertwister" ][ "language" ] ) {		        
            $this->Session->write(
                            "userLang",
                            $this->data[ "Twittertwister" ][ "language" ] );
        }
        
        // we must also change the locale language
        $this->__changeSessionLocale(
                            $this->data[ "Twittertwister" ][ "language" ] );
        
        $url = Router::parse( $this->referer() ); 
        
        $url_str = '/'.$url[ 'controller' ].'/'.$url[ 'action' ].'/';
        
        if ( isset( $url[ 'named' ][ 'id' ] ) ) {
            $url_str .= 'id:'.$url[ 'named' ][ 'id' ].'/';
        }
        
        // Set language parameter for action in calling page
        $url_str .= 'lang:'.$this->data[ "Twittertwister" ][ "language" ].'/';
        
        // redirect back to calling page
        $this->redirect( $url_str );
    }
    
    /*
    * Change the locale
    */    
    function __changeSessionLocale( $google_lang_code ) {
    
        $lang = $this->Language->findByGoogleLangCode( $google_lang_code );
        
        if ( $lang ) {
            $this->Session->write(  "userLocale",
                                    $lang[ 'Language' ][ 'lang_code' ] );
        }
    }
}

?>