<?php
class AppController extends Controller {
	
    // default page title
    var $pageTitle = 'Chapter 3 - Ecommerce';
	var $catId;
	var $pdId;
	var $sid;
				
	var $uses = array('Product','Category');
	    
    // The view helpers that we'll use globally
    var $helpers = array( 'Form', 'Html',  'Session', 'Javascript'  );
    
    // Componenets that we'll often use
    var $components = array( 'Session', 'RequestHandler', 'Shop' );
	
	function beforeFilter() {
		if ( isset( $this->passedArgs['cat_id'] ) && (int)$this->passedArgs['cat_id'] != 1 )  {
				$this->catId = (int)$this->passedArgs['cat_id'];
		} else {
				$this->catId = 0;
		}
		if ( isset( $this->passedArgs['pd_id'] ) && $this->passedArgs['pd_id'] != '' )  {
				$this->pdId = (int)$this->passedArgs['pd_id'];
		} else {
				$this->pdId = 0;
		}
		
		$data = $this->Session->read();
		$this->sid = $data['Config']['userAgent'];							
		$this->set('catId', $this->catId);
		$this->set('pdId', $this->pdId);		
		$this->set('sid', $this->sid);
		$this->setPageTitle();			
	}

	 function setPageTitle() {
		if ( $this->pdId > 0 ) {
			$result = $this->Product->find('all', array('conditions'=>array('Product.id' => $this->pdId )));
			$this->pageTitle = $result[0]['Product']['name'];
		} elseif ( $this->catId > 0 ){
			$result = $this->Category->find('all', array('conditions'=>array('Category.id' => $this->catId )));
			$this->pageTitle = $result[0]['Category']['name'];
		}	 
	 }
	
}
?>