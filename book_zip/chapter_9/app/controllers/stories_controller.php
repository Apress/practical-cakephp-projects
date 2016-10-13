<?php

class StoriesController extends AppController {

	var $name = 'Stories';
	
	var $helpers = array( 'Html', 'Form', 'Paginator' );
	
	var $paginate = array( 'limit' => 2 );
	
	function beforeFilter() {
	
        // The locale can be set by any action
        if ( isset( $this->passedArgs[ 'locale' ] ) ) {
            $this->Session->write( 'locale', $this->passedArgs[ 'locale' ] );
        }
        
        parent::beforeFilter();
	}

    /*
    * This will decide which language we will use in the behaviour
    */  
    function _setI10nByLocale( $current_locale = '' ) {
    
        // default locale is en_us
        $locale = "en_us";            
        
        // decide on session
        if ( $session_locale = $this->Session->read( 'locale' ) ) {	
            $locale = $session_locale;
        }                
        
        // user can override locale
        if ( $current_locale != '' ) {
            $locale = $current_locale;
        }
        
        $this->Story->locale = $locale;
    }
    
    /*
    * Using the language, we set the locale
    */    
    function _setI10nByLang( $current_lang = '' ) {
    
        if ( $current_lang ) {
                    
            $cat = $this->getLang( $current_lang );
            $this->_setI10nByLocale( $cat[ 'locale' ] );
        }
    }
    
    /*
    * The locale is the starting point for locale processes
    */    
    function setI10n() {
    
        $this->_setI10nByLocale();
    }
	
	/*
    * Public Listing
    */    
	function viewAllStories() {
	
        $this->_setI10nByLocale();	       
	
		$this->Story->recursive = 0;
		$this->set('stories', $this->paginate());
	}
	
	/*
    * List the stories
    */    
    function admin_index() {
    
        $this->_setI10nByLocale( 'en_us' );
    
    	$this->Story->recursive = 0;
        $this->set('stories', $this->paginate());
    }
	
	/*
    * View stories
    */    
	function view( $id = null ) {
	
        // set the correct locale
        $this->setI10n();	       
	
		if (!$id) {
			$this->Session->setFlash(__( 'Invalid Story.', true ) ); 
		}
		
		$this->set('story', $this->Story->read( null, $id ) );
	}
	
	/*
	* List the stories that we want to translate
	*/
	function admin_toTrans() {
	
        $this->set('trans_lang', ''); 	   
        $language = '';	       
	
        // Once user has picked the language, here we list the stories
        // that need translating	   
        if ( !empty( $this->params['url']['language'] ) ) {
            $language = $this->params['url']['language'];
        }
        elseif ( isset( $this->passedArgs[ 'language' ] ) ) {
            $language = $this->passedArgs[ 'language' ];
        }
        
        if ( $language ) {
                            
            // The language we're using to translate the stories in                            
            $this->Story->transLanguage = $language;
            $this->set('trans_lang', $language);   
            
            // Get the language name, e.g. German
            $cat = $this->getLang( $language );
            $this->set('language', $cat[ 'language' ] );                         
            
            // Which pagination method we're using
            $this->Story->usePaginate = 'paginateTranslation';
            $this->set('stories', $this->paginate());
        }
	}
	
	/*
    * Add a story
    */    
	function admin_add() {
   
        $this->_setI10nByLocale( 'en_us' );	   

		if (!empty($this->data)) {
			$this->Story->create();
			if ($this->Story->save($this->data)) {
				$this->Session->setFlash(__( 'Story saved.', true ) ); 
				$this->redirect( array( 'controller' => 'Stories', 'action' => 'index' ) );
			} else {
			}
		}
	}
	
	/*
    * Delete a story, in all locales
    */    
	function admin_delete($id = null) {
	
		if (!$id) {
			$this->Session->setFlash(__( 'Invalid Story.', true ) ); 
		}
		
		if ($this->Story->del($id)) {
            $this->Session->setFlash(__( 'Story deleted.', true ) );		          
        }
		
		$this->redirect( array( 'controller' => 'Stories', 'action' => 'index' ) );
	}
	
	/*
    * Edit a story
    */    
	function admin_edit($id = null) {

        if ( $this->data['Story']['trans_lang'] ) {
            $this->_setI10nByLang( $this->data['Story']['trans_lang'] );
        }
        	
		if (!$id && empty($this->data)) {
			$this->Session->setFlash( __('Invalid Story') ); 
		}
	       
		if (!empty($this->data)) {
		
    			if ($this->Story->save($this->data)) {
    				$this->Session->setFlash(__( 'The Story has been saved.', true ) ); 
    				//$this->redirect( array( 'controller' => 'Stories', 'action' => 'index' ) );
    			} else {
    			}
    	
		}
		
		if (empty($this->data)) {
			$this->data = $this->Story->read(null, $id);
		}
		
		// what translation to translate the story into
		// used in the hidden "trans_lang" field
		if ( isset( $this->passedArgs[ 'trans_lang' ] ) ) {
            $this->data['Story']['trans_lang'] = $this->passedArgs[ 'trans_lang' ];
            
            // The language name, e.g. German
            $cat = $this->getLang( $this->passedArgs[ 'trans_lang' ] );
            $this->set('trans_lang_name', $cat[ 'language' ] ); 
        }
	}
	
	/*
    * Get locale catalogue information from the 3 letter language
    */    
	function getLang( $lang ) {
	
        App::import('i18n');
        $I18n =& I18n::getInstance();
        $twoLetterLang = $I18n->l10n->map( $lang );
        $cat = $I18n->l10n->catalog( $twoLetterLang );
        
        if ( isset( $cat ) ) {
            return $cat;
        }
        
        return array();
    }
    
    /*
    * Get the locale information
    */    
	function getLocale( $locale ) {
	
        App::import('i18n');
        $I18n =& I18n::getInstance();
        $__l10nCatalog = $I18n->l10n->__l10nCatalog;
        
        foreach( $__l10nCatalog as $lang => $cat ) {
            if ( $cat['locale'] == $locale ) {
                return array( $lang => $cat );
            }
        }
        
        return array();
    }
    
    /*
    * Change locale
    */    
    function changeLocale() {
    
        // The locale session var is actually changed in the App beforeFilter  
        
        // redirect back to calling page
        $this->redirect( $this->referer() );
    }

}
?>