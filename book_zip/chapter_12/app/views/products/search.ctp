<?php

    echo $form->create( 'Product',
                        array( 'url' => '/Products/search/' ) );
                    
?>                

<?php echo $form->create('Product');?>

<?php

    if ( isset( $product_group ) ) {
    
        $product_group_id = $product_group['ProductGroup'][ 'id' ];
    
        echo $form->hidden( 'product_group_id',
                                array(  'name' => 'product_group_id',
                                        'value' => $product_group_id ) ); 
    }
?>

<?php

    if ( isset( $product_group ) ) {

        // list the product group
        echo $product_group['ProductGroup'][ 'title' ];
    }
    
    echo '<br />';

    echo '<div id="product_search">';

        if ( isset( $product_group ) ) {

            foreach( $product_fields as $product_field ) {
            
                echo '<b>'.$product_field[ 'ProductField' ][ 'title' ].'</b><br />';
                
                $field_selections = $product_field[ 'field_selections' ];
                
                foreach( $field_selections as $field_value ) {
                
                    $title = $field_value[ 'FieldTypeValue' ][ 'title' ];
                    $id = $field_value[ 'ProductSearch' ][ 'id' ];
                    $product_field_id = $field_value[ 'ProductSearch' ][ 'product_field_id' ];
                
                    if ( $title == '[DECIMAL]' ) {
                    
                        // we take it from the range
                        $value_less = $field_value[ 'ProductSearch' ][ 'value_less' ];
                        
                        if ( $value_less ) {
                            
                            echo $form->checkbox( '', array( 'name' => 'field_selection['.$product_field_id.'][]', 'value' => $id ) );
                            
                            echo '<'.$value_less.'<br />';
                        }
                        
                        $value_from = $field_value[ 'ProductSearch' ][ 'value_from' ];
                        
                        if ( $value_from ) {
                        
                            echo $form->checkbox( '', array( 'name' => 'field_selection['.$product_field_id.'][]', 'value' => $id ) );
                            
                            echo $value_from;
                            
                            $value_to = $field_value[ 'ProductSearch' ][ 'value_to' ];
                            
                            if ( $value_to ) {
                            
                                echo ' - '.$value_to.'<br />';
                            }
                        }
    
                        $value_more = $field_value[ 'ProductSearch' ][ 'value_more' ];
                        
                        if ( $value_more ) {
                            echo $form->checkbox( '', array( 'name' => 'field_selection['.$product_field_id.'][]', 'value' => $id ) );
                            
                            echo '>'.$value_more.'<br />';
                        }
                    }
                    else {
                    
                        // for ordinary lists, e.g. brand names.
                        $id = $field_value[ 'ProductSearch' ][ 'id' ];
                        
                        echo $form->checkbox( '', array( 'name' => 'field_selection['.$product_field_id.'][]', 'value' => $id ) );
                        
                        echo $field_value[ 'FieldTypeValue' ][ 'title' ].'<br />';
                    }
                }
                
                echo '<br />';
            }
            
            echo $form->end('Submit');
        }            
            
    echo '</div>';
    
    

?>

<br />
<hr width="100%" color="#555555"> 
<br />

<?php

    if ( isset( $search_results ) ) {
    
        foreach( $search_results as $a_result ) {
        
            $product_fields = $a_result[ 'product_fields' ];

            if ( isset( $product_fields[0][ 'Product' ][ 'title' ] ) ) {
                $product_title = $product_fields[0][ 'Product' ][ 'title' ];
                echo '<p>'.$product_title.'</p>';
            }
            
            foreach( $product_fields as $product_field ) {
            
                $field_title = $product_field[ 'ProductField' ][ 'title' ]; 
            
                switch ( $field_title ) {
                
                    case 'Product Brand':
                        echo '<p><b>Brand:</b> '.$product_field[ 'ProductFieldValue' ][ 'value' ].'</p>';
                        break;
                    
                    case 'Product Price':
                        echo '<p><b>Price:</b> '.$product_field[ 'ProductFieldValue' ][ 'value' ].'</p>';
                        break;
                }
            }
        }
    }        

?>