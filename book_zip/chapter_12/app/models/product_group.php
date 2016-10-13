<?php
class ProductGroup extends AppModel {

	var $name = 'ProductGroup';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'ParentProductGroup' => array('className' => 'ProductGroup',
								'foreignKey' => 'product_group_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'ProductFieldGroup' => array('className' => 'ProductFieldGroup',
								'foreignKey' => 'product_field_group_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'ChildProductGroup' => array('className' => 'ProductGroup',
								'foreignKey' => 'product_group_id',
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

	var $hasAndBelongsToMany = array(
			'Product' => array('className' => 'Product',
						'joinTable' => 'products_product_groups',
						'foreignKey' => 'product_group_id',
						'associationForeignKey' => 'product_id',
						'unique' => true,
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
			)
	);

}
?>