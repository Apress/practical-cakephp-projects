<?php
class OrdersController extends AppController {

    var $name = 'Orders';	
	var $uses = array('Order', 'Cart');	

	function checkout() {
		$data = $this->passedArgs['cts'];
		//$data = explode('_', $data);
		$this->set('data', $data);
		$this->layout = 'checkbase';
	}
	
	function confirm() {
		$this->layout = 'checkbase';		
		if (!empty($this->data)) {
			$orders = $this->data;
			$carts = $this->Cart->find('all', array(
			'conditions'=>array('Cart.id'=>$this->data['Order']['cts']),
			'recursive' => 1 ));
			$this->set(compact('carts', 'orders'));			
		}
	}
	
	function subTotal($ids) {
	
	}
}
?>