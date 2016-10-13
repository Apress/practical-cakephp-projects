<?php
class Order extends AppModel
{
	var $name = 'Order';
	var $useTable = false;	
	var $validate = array(
						'name' => array( 'rule' => array( 'between', 2, 255 ),
						'required' => true,
						'message' => 'Please enter a name.' ),
						'address' => array( 'rule' => array( 'between', 4, 255 ),
						'required' => true,
						'message' => 'Please enter an address.' ),
						'comment' => array( 'rule' => array( 'between', 5, 255 ),
						'required' => true,
						'message' => 'Please enter a comment.' ));	
}
?>