<?php

class MfSearchProcess extends AppModel
{
    // Mainly for PHP4 users
    var $name = 'MfSearchProcess';

    var $useTable = false;

    // The journey data validation
    var $validate = array(  'search_term' => array( 'rule' => array( 'between', 3, 255 ),
                                            'required' => true,
                                            'message' => 'Search term must have 3 or more characters.' )
                            );
}

?>