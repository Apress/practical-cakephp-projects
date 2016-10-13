<?php

/*
* This is used by the journey add/edit form to display the locations
* form elements
*/
class MapHelper extends AppHelper {

    var $helpers = array( 'Form' );

    function generateFields( $locations ) {
    
        $result = '';
        
        for( $idx=0; $idx<sizeof( $locations ); $idx++ ) {
        
            $id = $locations[$idx][ 'id' ];
            $coord = $locations[$idx]['coord'];
            $location_name = $locations[$idx]['location_name'];
            $comments = $locations[$idx]['comments'];
            
            $json = json_encode( $locations[$idx] );
                
            $result .= '<div class="form_fields">';                  
            $result .= '<h5>Location: '.$location_name.'</h5>';
            $result .= $this->Form->textarea(   'notes',
                            array(  'value' => $comments,
                                    'name' => "data[Journey][locations][".$idx."][comments]",
                                    'div' => false, 'label' => false,
                                    'rows' => '5', 'cols' => '50'
                                    ) );
             
            $result .= '    <input type="hidden"
                            name="data[Journey][locations]['.$idx.'][data]"
                            value=\''.$json.'\' />';
            $result .= '</div>';
        }
        
        return $result;
    }
}

?>