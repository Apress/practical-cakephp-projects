
<table border="1">
<?php

    echo $form->create(array('url' => '/Actions/index'));  

    foreach ( $actions as $current_action_group ) {
    
        $action_name = $current_action_group[ 'name' ];
        $action_name_singular = $current_action_group[ 'name_singular' ];
        $all_actions = $current_action_group[ 'actions' ];
        
        echo '<tr><td>'.$action_name.'</td></tr>';
        
        foreach ( $all_actions as $current_action ) {
        
            $clean = str_replace( 'function ', '', $current_action );
            $clean = str_replace( '(', '', $clean );
            $selected = '';
        
            // selected
            $checked_yes = false;
            $checked_no = false;
            if ( $selected == 'yes' ) {
                $checked_yes = 'checked=""';
            }
            elseif ( $selected == 'no' ) {
                $checked_no = true;
            }                
            
            $action_value_1 = $action_name_singular.'__'.$clean;
            $action_value_2 = $action_name.'__'.$clean;
        
            echo '<tr>';
            echo '<td>';
            echo '&nbsp;&nbsp;&nbsp;'.$clean;
            echo '</td>';
            
            if ( isset( $aco_list[ $action_value_1 ] ) ) {

                echo '<td>Delete:';
                echo $form->checkbox( 'Actions.SecurityAccess.'.$action_value_2,
                                        array(  'label'=>false,
                                                'div'=>false,
                                                'value'=>'delete',
                                                'checked'=>$checked_no ) );
                echo '</td>';                                                
            }
            else {
                
                echo '<td>Add:';
                echo $form->checkbox( 'Actions.SecurityAccess.'.$action_value_2,
                                        array(  'label'=>false,
                                                'div'=>false,
                                                'value'=>'include',
                                                'checked'=>$checked_yes ) );
                echo '</td>';                                                   
            }     
            
            echo '</tr>';       
        }
    }  
    
?>

</table>

<?php
    echo $form->end( array( 'label' => 'Submit', 'div' => false ) );
?>