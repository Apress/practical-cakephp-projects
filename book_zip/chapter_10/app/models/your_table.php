<?php
class YourTable extends AppModel {

	var $name = 'YourTable';

    var $actsAs = array( 'MagicFieldsPlus' => array( "m_record_order" => array( "direction" => "ASC" ) ) );
    
}
?>