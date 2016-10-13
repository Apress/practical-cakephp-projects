<?php
class Story extends AppModel {

	var $name = 'Story';

    var $actsAs = array( 'Translate' => array( 'title', 'body' ) );
    
    var $usePaginate = 'paginateStandard';
    
    var $transLanguage = '';
    
    function paginate(  $conditions, $fields, $order, $limit,
                        $page = 1, $recursive = null) {
    
        switch( $this->usePaginate ) {
        
            case 'paginateStandard':
                return $this->paginateStandard( $conditions,
                                                $fields,
                                                $order,
                                                $limit,
                                                $page,
                                                $recursive );
                
            case 'paginateTranslation':
                return $this->paginateTranslation(  $conditions,
                                                    $fields,
                                                    $order,
                                                    $limit,
                                                    $page,
                                                    $recursive );                
        }                            
    } 
    
    function paginateCount($conditions = null, $recursive = 0) {
    
        switch( $this->usePaginate ) {
        
            case 'paginateStandard':
                return $this->paginateCountStandard(    $conditions,
                                                        $recursive );
                
            case 'paginateTranslation':
                return $this->paginateCountTranslation( $conditions,
                                                        $recursive );                
        } 
    }
    
    /* The following are the different pagination functions */
    
    // Method 1
    function paginateStandard(  $conditions, $fields, $order,
                                $limit, $page = 1,
                                $recursive = null ) {
    
        $recursive = -1;
              
        return $this->find( 'all', array(   'conditions' => $conditions,
                                            'fields' => $fields,
                                            'order' => $order,
                                            'limit' => $limit,
                                            'page' => $page, 
                                            'recursive' => $recursive
                                            ) );
    }
    
    function paginateCountStandard($conditions = null, $recursive = 0) {
        
        $recursive = -1;
        
        return $this->find( 'count', array( 'conditions' => $conditions,
                                            'recursive' => $recursive
                                            ) );
    } 
    
    // Method 2
    function paginateTranslation(   $conditions, $fields, $order,
                                    $limit, $page = 1,
                                    $recursive = null ) {
    
        $locale = $this->getLocale( $this->transLanguage );
        $offset = $limit*($page-1);
    
        return $this->query( "  select * from stories as Story
                                where
                                Story.id not in
                                (
                                    select foreign_key from i18n
                                    where
                                    locale = '$locale'
                                )
                                limit $offset, $limit
                                " );
    }
    
    function paginateCountTranslation($conditions = null, $recursive = 0) {
        
        $locale = $this->getLocale( $this->transLanguage );
            
        $results = $this->query( "  select id from stories as Story
                                    where
                                    Story.id not in
                                    (
                                        select foreign_key from i18n
                                        where
                                        locale = '$locale'
                                    )
                                    " );
        
        return count($results);
    } 
    
    function getLocale( $lang ) {
    
        App::import('i18n');
        $I18n =& I18n::getInstance();
        $langCode = $I18n->l10n->map( $lang );
        $cat = $I18n->l10n->catalog( $langCode );
        
        if ( isset( $cat[ 'locale' ] ) ) {
            return $cat[ 'locale' ];
        }
        
        return '';            
    }
}
?>