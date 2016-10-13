<?php
class Product extends AppModel
{
    // Mainly for PHP4 users
    var $name = 'Product';

	// Products belong To some category
	var $belongsTo = array('Category');		

	function lists($catIds = NULL) {
		if(is_array($catIds)) {
		$results = $this->find( 'all', array( 
			'conditions'=>array('Product.category_id'=>$catIds),
			'order' => 'Product.category_id ASC' ));		
		return $results;
		}
	}
}
?>