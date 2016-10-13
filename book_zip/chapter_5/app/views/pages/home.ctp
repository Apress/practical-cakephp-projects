<p id="journey_helper_message">
    You currently have no journey planned, enter a starting location to begin.
</p>

<div>
    
    <p>
        Location Name:
                    
        <?php echo $form->text( 'LocationName' ); ?>
        <?php echo $form->button(   'Enter a Location',
                                    array(  'id'=>'location_name_button' ) );
        ?>
    </p>           

</div>

<div id="map_functions_wrapper">
    
    <!-- find the best route -->
    <?php 
        echo $form->button( 'Calculate Journey',
                            array(  'id'=>'find_route_button' ) );
    ?>
            
    <!-- start a new route -->        
    <?php
        echo $form->button( 'Start Again',
                            array(  'id'=>'start_again_button' ) );
    ?>
    
    <!-- save the route -->
    <?php
        echo $form->create( null, array(    'id' => 'add_form',
                                            'url' => '/journeys/add_form',
                                            'class' => 'function_form'                                            
                                            ) );  
        
        // used to store the location is json format
        echo $form->hidden( 'locations' );                                            
           
        echo $form->submit( 'Save Journey', array( 'div' => false ) );
                            
        echo $form->end();                                                        
    ?>  
                        
</div>  

<!-- This is where our Google Map will be displayed in -->
<div id="map_canvas"></div>





