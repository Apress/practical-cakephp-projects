<?php
class Cart extends AppModel
{
    // Mainly for PHP4 users
    var $name = 'Cart';
	var $belongsTo = array('Product');			
	/*
	Get all item in current session
	from shopping cart table
	*/	
	function getCart($pid, $sid) {		
		return $this->find( 'all', array(
		'conditions'=>array('Cart.product_id'=>$pid, 'Cart.ct_session_id'=>$sid),
		'order' => 'Cart.id ASC' )
		);
	}

	function isCartEmpty($sid) {
		$result = $this->find('first', array('conditions'=>array('Cart.ct_session_id'=>$sid),'recursive' => 0 ));
		if ( empty( $result ) ) {
			return true;
		}	
			return false;
	}	
		// put the product in cart table
	function addCart($product_id, $sid) {
	           
        $this->data[ 'Cart' ][ 'product_id' ] = $product_id;
       $this->data[ 'Cart' ][ 'qty' ] = 1;
       $this->data[ 'Cart' ][ 'ct_session_id' ] = $sid;
       
        $this->save();
 
	}
		// put the product in cart table
	function updateCart($product_id, $sid) {
		$sql = "UPDATE carts 
		        SET qty = qty + 1
				WHERE ct_session_id = '$sid' AND product_id = $product_id";		
		$this->query( $sql ); 
	}  	
	
	/*
		Delete all cart entries older than three day
	*/
	function cleanUp() {
		$threeDaysAgo = date('Y-m-d H:i:s', mktime(0,0,0, date('m'), date('d') - 3, date('Y')));
		
        $delete_condition = "Cart.created < '$threeDaysAgo'";
        $this->deleteAll( $delete_condition, false);
    }
	
	function getCartContent( $sid ) {
		$cartContent = array();
		$sql = "SELECT ct.id, ct.product_id, ct.qty, pd.name, pd.description, pd.price, pd.thumbnail, pd.category_id
			FROM carts ct, products pd, categories cat
			WHERE ct_session_id = '$sid' AND ct.product_id = pd.id AND cat.id = pd.category_id";	
		$results = $this->query( $sql );	
		foreach ($results as $result ) {	
			$cartContent[] = $result;
		}
		return $cartContent;
	}	
	
	/*
	Remove an item from the cart
	*/
	function emptyBasket($cartId = NULL) {
		if ($cartId) {	
		  $this->delete( $cartId );
        }
	}

	function doUpdate($newQty, $catId) {
	
		// update product quantity
		$this->data[ 'Cart' ][ 'qty' ] = $newQty;
		$this->id = $catId;
		
		$this->save();	
	}
}
?>