<?php
 
class AppController extends Controller {

    // default page title
    var $pageTitle = 'Chapter 6 - Mashing Twitter with the Google Translator';
    
    // The view helpers that we'll use globally
    var $helpers = array( 'Cache', 'Form', 'Html', 'Rss' ); 
    
    // Componenets that we'll often use
    var $components = array( 'Session', 'RequestHandler' );
    
    // The default language to view the statuses
    var $currentLang = '';
    
    var $uses = array( 'TwitterRequest', 'TwitterStatus',
                        'TwitterTranslation', 'Language' );
                        
    // we cache the models        
    var $persistModel = true;                        
    
    function beforeFilter() {

        $cache_get_lang = Cache::read( 'getLang' );

        if ( empty( $cache_get_lang ) ) {

            // this is a site wide function
            Cache::write( 'getLang', $this->Language->getLang(), 0 );
        }
                
        $session_get_lang = $this->Session->read( "getLang" );
        
        if ( empty( $session_get_lang ) ) {
            $this->Session->write( "getLang", Cache::read( 'getLang' ) );
        }

        // hackish!
        /*
        if ( preg_match( '/\/rss$/', Router::url() ) ) {
            $this->RequestHandler->ext = 'rss';
        }*/	
        
        $this->__langChoice();
    }
    
    function __langChoice() {
    
        // If user has selected default viewing language
        if ( $this->Session->read( "userLang" ) ) {
            $this->currentLang = $this->Session->read( "userLang" );
        }
    }

}
?>