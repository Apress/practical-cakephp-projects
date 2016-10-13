<?php 
    
   if ( !empty( $user_message ) )
      echo $user_message;
?>

<p>Fields marked with * are needed.</p> 

<div>

<?php

    echo $form->create( 'Journey',
                        array( 'url' => '/journeys/display_journey' ) );                                                                     

    echo '<div class="form_fields">';  
    echo '<h5>Journey ID: *<h5>';
    echo $form->input( 'journey_id', array( 'div' => false, 'label' => false ) );
    echo '</div>';
            
    echo '<div class="form_fields">';               
    echo $form->submit( 'Display Journey' );
    echo '</div>'; 
    
    echo $form->end();
?>

</div>

<!-- display journey here -->
<?php

    if ( isset( $journey ) ) {
    
        echo '<div class="display_journey_container">';
        echo '<h3>Your Journey Details</h3>';
    
        // journey name
        echo '<div class="form_fields">';  
        echo '<h4>Journey Name:</h4>';
        echo $journey[ 'Journey' ][ 'journey_name' ];
        echo '</div>';
        
        // journey notes
        echo '<div class="form_fields">';  
        echo '<h4>Journey Notes:</h4>';
        echo str_replace( chr(10), '<br />', $journey[ 'Journey' ][ 'notes' ] );
        echo '</div>';
        
        // tag
        $tag = $journey[ 'Tag' ];
        $tag_str = '';
        for( $idx=0; $idx<sizeof( $tag ); $idx++ ) {
        
            $tag_str .= $tag[$idx][ 'tag_name' ];
            if ( $idx+1 < sizeof( $tag ) ) { $tag_str .= ','; }
        }
       
        echo '<div class="form_fields">';  
        echo '<h4>Journey Tags:</h4>';
        echo $tag_str;
        echo '</div>';
        
        // locations
        $locations = $journey[ 'Location' ];
        
        for( $idx=0; $idx<sizeof( $locations ); $idx++ ) {
        
            echo '<div class="form_fields">';  
            echo '<h3>Location: '.$locations[$idx][ 'location_name' ].'</h3>';
            echo $locations[$idx][ 'comments' ];
            echo '</div>';
        }
        
        echo '</div>';
    }
?>