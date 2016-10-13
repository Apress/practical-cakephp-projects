<?php

/*
* This is the tag model
*/

class Tag extends AppModel
{
    var $name = 'Tag';
    
    var $belongsTo = array('Journey');
}

?>