<?php
class Action extends AppModel {

	var $name = 'Action';
	
    var $useTable = false; 

    var $validate = array( 'title' => VALID_NOT_EMPTY );
}
?>