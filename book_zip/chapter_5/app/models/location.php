<?php

/*
* This is the location model
*/

class Location extends AppModel
{
    var $name = 'Location';
    
    var $belongsTo = array('Journey');        
}

?>