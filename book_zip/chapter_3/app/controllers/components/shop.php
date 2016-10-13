<?php
class ShopComponent extends Object {

	var $controller;

    var $components = array( 'Session');

	function startup(&$controller) {
		$this->controller = &$controller;
	}
	 
	function getSessionId() {
		$data = $this->Session->read();
		return $data['Config']['userAgent'];	
	}

	function getCategoryId() {
						
		if ( isset( $this->controller->passedArgs['cat_id'] ) && (int)$this->controller->passedArgs['cat_id'] != 1 )  {
				return (int)$this->controller->passedArgs['cat_id'];
		} else {
			return 0;
		}	
	}
	
	function getProductId() {
		if ( isset( $this->controller->passedArgs['pd_id'] ) && $this->controller->passedArgs['pd_id'] != '' )  {
			return (int)$this->controller->passedArgs['pd_id'];
		} else {
			return 0;
		}
	}

	function displayAmount($amount)
	{
		return Configure::read('Shop.currency') . number_format($amount);
	}	
}
?>