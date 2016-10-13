<?php

/*
* This is the journey model
*/

class Journey extends AppModel
{
    var $name = 'Journey';

    // The journey data validation
    var $validate = array( 'journey_name' => array( 'rule' => array( 'between', 1, 255 ),
                                            'required' => true,
                                            'message' => 'Your journey name 
                                                must be between 1 and 255 
                                                characters long.' ) );
                                  
    // Each journey has many locations and also many tags.                                            
    var $hasMany = array(   'Location' => array( 'className' => 'Location' ),
                            'Tag' => array( 'className' => 'Tag' )
                            );
}

?>