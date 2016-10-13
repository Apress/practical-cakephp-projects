<h3>User Security</h3>

This page allows you to control the access rights for the selected user.

<p>

<?php

    echo $form->create( array( 'url' => '/Users/security/'.$this->data['User']['id'] ) );

    foreach ( $acoTree as $item ) {
    
        // id
        $aco_id = str_replace( "_", "", $item );
        
        // record details
        $acoRecord = array();
        $selected = '';
        
        foreach ( $acoRecords as $aco ) {
        
            if ( $aco['Aco']['id'] == $aco_id ) {
                $acoRecord = $aco; 
                
                // check whether its been selected
                $aroRecords = $aco['Aro'];
                
                foreach ( $aroRecords as $aro ) {
                
                    if ( $aro[ 'alias' ] == $current_alias ) {
                        
                        if (    ( $aro[ 'Permission' ][ '_create' ] == 1 ) &&
                                ( $aro[ 'Permission' ][ '_read' ] == 1 ) &&
                                ( $aro[ 'Permission' ][ '_update' ] == 1 ) &&
                                ( $aro[ 'Permission' ][ '_delete' ] == 1 )
                            ) {
                            $selected = 'yes';
                            break;
                        }
                        else {
                            $selected = 'deny';
                            break;
                        }
                    }
                }
                
                break;
            }
        }
        
        // levels
        $pattern = '/_/';
        $matches = preg_match($pattern, $item);
                
        echo str_repeat( '&nbsp;', $matches*3 );
        echo $acoRecord['Aco']['model'].' : '.$acoRecord['Aco']['alias'].'&nbsp;';
        
        $inflect = new Inflector();
        if ( $inflect->pluralize( $acoRecord['Aco']['model'] ) != $acoRecord['Aco']['alias'] ) {
                    
            echo $form->radio(  'User.SecurityAccess.'.$aco_id,
                                array(  'allow' => '&nbsp;Allow',
                                        'deny' => '&nbsp;Deny' ),
                                array( 'default' => $selected,
                                        'legend' => false
                                        )
                                );
        }
        
        echo '<br />';
    }
        
    echo $form->hidden( 'User.id', $this->data['User']['id'] );
        
    echo $form->end( array( 'label' => 'Submit', 'div' => false ) );
?>

</p>