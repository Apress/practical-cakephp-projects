<?php

class Language extends AppModel
{
    // Mainly for PHP4 users
    var $name = 'Language';

    // Which db table to use
    var $useTable = 'languages';
    
    /*
    * Remove cache after database has been changed
    */    
    function afterSave() {
    
        App::import( 'Cache' );
        Cache::delete( 'getLang' );
    }
    
    /*
    * Get all the Twitter requests
    */    
    function getLang() {
        
		$result = array();
				
		$allLang = $this->find( 'all' );
        
        foreach ( $allLang as $lang ) {
                    
            $google_lang_code = $lang[ "Language" ][ "google_lang_code" ];
            $lang_name = $lang[ "Language" ][ "lang_name" ];
            
            $result[ $google_lang_code ] = $lang_name;
        }
        
        return $result;  	
    }
}

?>