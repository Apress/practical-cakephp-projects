<?php
class ProductField extends AppModel {

	var $name = 'ProductField';

	var $belongsTo = array(
    	'FieldTypeGroup' => array('className' => 'FieldTypeGroup',
    						'foreignKey' => 'field_type_group_id',
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
		'ProductFieldValue' => array('className' => 'ProductFieldValue',
							'foreignKey' => 'product_field_id',
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
							'foreignKey' => 'product_field_id',
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
	
	function searchFilters( $searchField ) {

        // We get the fields relating to this product group
        $productFields = array();
        
        if ( $searchField['ProductGroup'][ 'product_field_group_id' ] ) {
        
            $productFieldGroupId = $searchField['ProductGroup'][ 'product_field_group_id' ];      
        
            $fields = $this->findAllByProductFieldGroupId( $productFieldGroupId );
            
            foreach( $fields as $product_field ) {
                
                $productFields[] = $product_field[ 'ProductField' ][ 'id' ];
            }
        }       
                
        // Next, for each field, we get the search criteria, e.g. list of
        // brand names, price range ...etc.
        $fieldRefine = array();
        
        foreach( $fields as $productField ) {
                        
            $productFieldId = $productField[ 'ProductField' ][ 'id' ];
            
            $fieldSelection = $this->ProductSearch->findAllByProductFieldId( $productFieldId );
            
            $fieldValues = array();
            
            foreach( $fieldSelection as $selection ) {
                $fieldValues[] = $selection;
            }
            
            $productField[ 'field_selections' ] = $fieldValues;
            
            $fieldRefine[] = $productField;
        }
        
        return $fieldRefine;
    }

}
?>