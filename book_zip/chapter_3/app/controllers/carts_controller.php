<?php
class CartsController extends AppController {
    var $name = 'Carts';
	
	function index() {
	
	}

	function checkout() {
		$this->set('cartContents', $this->getMiniCart());	
	}
	
	/*
	Get all item in current session
	from shopping cart table
	*/
	// This renders the mini cart based on the current session id
	function getMiniCart() {	
	   return $this->Cart->getCartContent( $this->sid );
	}	
	
	function getCart() {
		$carts = $this->Cart->find('all', array('conditions' => array('Cart.ct_session_id' => $this->passedArgs['s']),   'recursive' => 2 ));	
		if(isset($this->params['requested'])) {
			return $carts;
		}
		$this->set('carts', $carts);
	}

function add() {	
	$data = $this->Product->findById( $this->pdId );
	if( !is_array( $data ) ) {
		$this->redirect('/');	
	} else {
		// how many of this product we
		// have in stock
		if ($data['Product']['qty'] <= 0) {
			// we no longer have this product in stock
			// show the error message
			$this->Session->setFlash('The product you requested is no longer in stock');
			$this->redirect('/');	
		}
	}
	// check if the product is already
	// in cart table for this session	
	$sessionData = $this->Cart->getCart($this->pdId, $this->sid);
	if ( empty($sessionData)) {	
    	// put the product in cart table
		$this->Cart->addCart($this->pdId, $this->sid);
	} else {
		// update product quantity in cart table
		$this->Cart->updateCart($this->pdId, $this->sid);
	}
	// an extra job for us here is to remove abandoned carts.
	// right now the best option is to call this function here
	$this->Cart->cleanUp();		
	$this->redirect(array('controller'=>'Products', 'action'=>"view/cat_id:$this->catId/pd_id:$this->pdId"));
}
	
	function view() {	
		$this->layout = 'checkbase';
	}
	
	function remove() {
		$this->Cart->emptyBasket($this->passedArgs['ct_id']);		
		if( $this->Cart->isCartEmpty( $this->sid) ) {		
			$this->redirect(array('controller'=>'carts', 'action'=>'index'));
		}else {
			$this->redirect(array('controller'=>'carts', 'action'=>'view'));
		}
	}	
	
	function updates() {	
		$cart = array();
		$data = $this->data;
		foreach( $data as $key => $val ) {		
			if ( is_array($val) ) continue;				
				$this->Cart->doUpdate($val, $key);
		}	
			$this->redirect(array('controller'=>'carts', 'action'=>'view'));
	}
}
?>