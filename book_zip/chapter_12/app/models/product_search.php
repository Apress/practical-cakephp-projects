<?php
class ProductSearch extends AppModel {

	var $name = 'ProductSearch';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'ProductField' => array('className' => 'ProductField',
								'foreignKey' => 'product_field_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'FieldTypeValue' => array('className' => 'FieldTypeValue',
								'foreignKey' => 'field_type_value_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>