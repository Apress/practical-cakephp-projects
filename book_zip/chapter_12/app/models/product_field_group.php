<?php
class ProductFieldGroup extends AppModel {

	var $name = 'ProductFieldGroup';

	var $hasMany = array(
			'ProductField' => array('className' => 'ProductField',
								'foreignKey' => 'product_field_group_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			),
			'ProductGroup' => array('className' => 'ProductGroup',
								'foreignKey' => 'product_field_group_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			),
			'Product' => array('className' => 'Product',
								'foreignKey' => 'product_field_group_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			)
	);

}
?>