<?php
class Product extends AppModel {

	var $name = 'Product';

	var $belongsTo = array(
			'ProductFieldGroup' => array('className' => 'ProductFieldGroup',
						'foreignKey' => 'product_field_group_id',
						'conditions' => '',
						'fields' => '',
						'order' => ''
			)
	);

	var $hasMany = array(
			'ProductFieldValue' => array('className' => 'ProductFieldValue',
						'foreignKey' => 'product_id',
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
			'ProductGroup' => array('className' => 'ProductGroup',
						'joinTable' => 'products_product_groups',
						'foreignKey' => 'product_id',
						'associationForeignKey' => 'product_group_id',
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
	
    function doSearch( $formValues ) {
    
        $result = array();
    
        $productGroupId = $formValues[ 'product_group_id' ];

        if ( isset( $formValues[ 'field_selection' ] ) ) {
            
            $result = $this->getFieldSelection(
                                $productGroupId,
                                $formValues[ 'field_selection' ] );
            
            // We need to add the field information to each product
            $result = $this->addFieldInformation( $result );
        }
        
        return $result;
    }
    
    function addFieldInformation( $products ) {
    
        foreach( $products as &$current_product ) {
        
            $productId = $current_product['id'];
            
            $productFields = $this->ProductFieldValue->findAllByProductId( $productId  );
            
            $current_product[ 'product_fields' ] = $productFields;
        }
        
        return $products;
    }    
    
    function getSearchCriteria( $fieldSelection ) {
    
        $selectionFlat = array();
    
        $idx = 0;
        
        foreach( $fieldSelection as &$currentSelection ) {
            
            for( $idx2=0; $idx2<sizeof( $currentSelection ); $idx2++ ) {
            
                $selectionValue = $currentSelection[$idx2];
            
                $sql = "    select * from product_searches
                            where
                            id = '$selectionValue'
                            ";

                $searchs = $this->query($sql);
                
                $selectionFlat[$idx][$idx2] = $searchs[0];
            }
            
            $idx++;
        }
    
        return $selectionFlat;
    }    
    
    function getFieldSelection( $productGroupId, $fieldSelection ) {
    
        $result = array();
                
        // Get all products within the group
        $products = $this->ProductGroup->findById( $productGroupId );
               
        $searchCriterias = $this->getSearchCriteria( $fieldSelection );
        
        // now walk through each product to filter out
        // according to user selection
                
        foreach( $products[ 'Product' ] as $currentProduct ) {
            
            $productId = $currentProduct[ 'id' ];
            $productFieldGroupId = $currentProduct[ 'product_field_group_id' ];
        
            $sql = "    select * from product_fields
                        inner join product_field_values on product_field_values.product_field_id = product_fields.id
                        inner join field_type_values on field_type_values.id = product_field_values.field_type_value_id
                        where
                        product_fields.product_field_group_id = '".$productFieldGroupId."' and
                        product_field_values.product_id = '".$productId."'
                        ";
            
            $productFields = $this->query($sql);
            
            $topLevelMatches = 0;
            
            // Walk through each field
            foreach( $productFields as $field ) {
                
                // Now match against the selection
                // Top level groups must match with an "AND"
                // e.g. brand, price ...etc.
                // While second level groups match with an "OR"
                // e.g. Panasonic, Sony ...etc.
                
                // Start with top level
                for( $idx=0; $idx<sizeof( $searchCriterias ); $idx++ ) {
                
                    $subLevels = $searchCriterias[$idx];
                    $subLevelMatching = 0;
                    
                    // Sub level
                    for( $idx2=0; $idx2<sizeof( $subLevels ); $idx2++ ) {
                    
                        if (    (   $subLevels[$idx2]['product_searches'][ 'product_field_id' ] == 
                                (   $field[ 'product_field_values' ][ 'product_field_id' ] ) ) )
                        {
                            // User selected this field to filter
                            // check if selection matches this field
                            
                            if ( $field[ 'field_type_values' ][ 'title' ] == '[DECIMAL]' ) {
                            
                                $valueLess = $subLevels[$idx2]['product_searches'][ 'value_less' ];
                                
                                if ( $valueLess ) {
                                    if ( $field[ 'product_field_values' ][ 'value' ] < $valueLess ) {
                                        $subLevelMatching = 1;
                                    }
                                }
                                
                                $valueFrom = $subLevels[$idx2]['product_searches'][ 'value_from' ];
                                $valueTo = $subLevels[$idx2]['product_searches'][ 'value_to' ];
                                
                                if ( ( $valueFrom ) && ( $valueTo ) ) {
                                    if (    ( $field[ 'product_field_values' ][ 'value' ] > $valueFrom ) &&
                                            ( $field[ 'product_field_values' ][ 'value' ] < $valueTo ) )
                                    {
                                        $subLevelMatching = 1;
                                    }
                                }
                                                           
                                $valueMore = $subLevels[$idx2]['product_searches'][ 'value_more' ];
                                
                                if ( $valueMore ) {
                                    if ( $field[ 'product_field_values' ][ 'value' ] > $valueMore ) {
                                        $subLevelMatching = 1;
                                    }
                                }
                            }
                            else {
                            
                                // If plain id selection e.g. brand names ...etc.
                                if (    $field[ 'product_field_values' ][ 'field_type_value_id' ] ==
                                        $subLevels[$idx2]['product_searches'][ 'field_type_value_id' ] ) {
                                    
                                    $subLevelMatching = 1;
                                }
                            }
                        }
                    }
                    
                    // count how many
                    if ( $subLevelMatching ) {
                        $topLevelMatches++;
                    }
                }
            }

            if ( $topLevelMatches == sizeof( $searchCriterias ) ) {
                $result[] = $currentProduct;
            }
        }
        
        return $result;
    }     

}
?>