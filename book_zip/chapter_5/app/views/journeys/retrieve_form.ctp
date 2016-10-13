<?php 
    
   if ( !empty( $user_message ) )
      echo $user_message;
?>

<p>Fields marked with * are needed.</p> 

<div>

<?php

    echo $form->create( 'Journey', array( 'url' => '/journeys/retrieve' ) );                                                                     

    echo '<div class="form_fields">';  
    echo '<h5>Journey ID: *<h5>';
    echo $form->input( 'journey_id', array( 'div' => false, 'label' => false ) );
    echo '</div>';
    
    echo '<div class="form_fields">';  
    echo '<h5>Password: *<h5>';
    echo $form->input( 'password', array( 'div' => false, 'label' => false ) );
    echo '</div>';
            
    echo '<div class="form_fields">';               
    echo $form->submit( 'Retrieve Journey' );
    echo '</div>'; 
    
    echo $form->end();
?>

</div>