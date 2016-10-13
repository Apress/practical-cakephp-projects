<?php
class FieldTypeGroup extends AppModel {

	var $name = 'FieldTypeGroup';

	var $hasMany = array(
			'FieldTypeValue' => array('className' => 'FieldTypeValue',
								'foreignKey' => 'field_type_group_id',
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
			'ProductField' => array('className' => 'ProductField',
								'foreignKey' => 'field_type_group_id',
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