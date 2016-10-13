<?php 
   if ( !empty( $user_message ) )
      echo $user_message;
?>

<p>Fields marked with * are needed.</p> 

<div>

<?php
    
    // Decide whether we're adding a journey or editing
    if ( $journey_id ) {
        echo $form->create( 'Journey',
                            array( 'url' => '/journeys/edit/'.$journey_id ) );
    }
    else {
        echo $form->create( 'Journey',
                            array( 'url' => '/journeys/add' ) );
    }                                                                

    echo '<div class="form_fields">';     
    echo '<h5>Journey Name *:</h5>';
    echo $form->input( 'journey_name', array( 'div' => false, 'label' => false ) );
    echo '</div>';        
    
    echo '<div class="form_fields">';    
    echo '<h5>Password:</h5>';
    echo $form->password( 'password', array( 'div' => false, 'label' => false ) );
    echo '  <p>Used to retrieve your journey. If you do not enter your own
            password, one will be generated for you.</p></div>'; 
    
    echo '<div class="form_fields">';    
    echo '<h5>Tags:</h5>';
    echo $form->input( 'tags', array( 'div' => false, 'label' => false ) );
    echo '<p>Please separate tags with commas.</p></div>'; 
            
    echo '<div class="form_fields">';            
    echo '<h5>Notes:</h5>';
    echo $form->textarea(   'notes',
                            array(  'div' => false, 'label' => false,
                                    'rows' => '7', 'cols' => '60'
                                    ) );
    echo '</div>';  
    
    // locations
    echo $map->generateFields( $locations );
            
    echo '<div class="form_fields">';             
    echo $form->submit( 'Save Journey' );
    echo '</div>';  
    
    echo $form->end();
?>

</div>

