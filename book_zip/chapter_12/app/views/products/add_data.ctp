<div class="products form">
<?php echo $form->create('Product',array( 'url' => '/Products/addData' ));?>
	<fieldset>
 		<legend><?php __('Add Product Data');?></legend>
	<?php
		
		if ( isset( $field_type_values ) ) {
		
    		foreach( $field_type_values as $field ) {
    		
                $fieldTypeValues = $field[ 'FieldTypeValues' ];   		  
    		
                $productFieldId = $field[ 'ProductField' ][ 'id' ];    		  
                $productFieldTitle = $field[ 'ProductField' ][ 'title' ];
                $productFieldTitle_2 = strtolower( $productFieldTitle );
                $productFieldTitle_2 = str_replace( " ", "_", $productFieldTitle_2 );

                echo '<div class="form_field">';
                
                    echo $productFieldTitle.'&nbsp;:&nbsp;';
                    
                    // check type of data
                    if ( sizeof( $fieldTypeValues ) == 1 ) {
                    
                        // get field type value id
                        $FieldTypeValueId = $field[ 'FieldTypeValues' ][0][ 'FieldTypeValues' ][ 'id' ];   
                        
                        // we'll assume its a basic data type like int or a string
                        // and not a list of data items
                                            
                        echo $form->input( '', array(   'label' => false,
                                                        'div' => false,
                                                        'name' => 'data[Product][data_fields][]['.$productFieldId.','.$FieldTypeValueId.']' ) );
                        echo '<br />';
                    }
                    else {
                        // we'll assume its a list of data items
                        // lets gather the data together
                        $listItems = array();
                        foreach( $fieldTypeValues as $fieldValue ) {
                            
                            $id = $fieldValue[ 'FieldTypeValues' ][ 'id' ];
                            $title = $fieldValue[ 'FieldTypeValues' ][ 'title' ];
                            
                            $listItems[ $productFieldId.','.$id ] = $title;
                        }
                        
                        echo $form->select( '', $listItems, null, array( 'name' => 'data[Product][data_fields][]' ) ); 
                        echo '<br />';
                    }
                    
                echo '</div>';
            }
        }            
    
    ?>
	</fieldset>
<?php echo $form->hidden( 'product_id', array( 'value' => $product_id ) ); ?>	
	
<?php echo $form->end('Submit');?>
</div>
