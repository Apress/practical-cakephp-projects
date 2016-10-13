<?php
class FieldTypeValue extends AppModel {

	var $name = 'FieldTypeValue';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'FieldTypeGroup' => array('className' => 'FieldTypeGroup',
								'foreignKey' => 'field_type_group_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'ProductFieldValue' => array('className' => 'ProductFieldValue',
								'foreignKey' => 'field_type_value_id',
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
			'ProductSearch' => array('className' => 'ProductSearch',
								'foreignKey' => 'field_type_value_id',
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