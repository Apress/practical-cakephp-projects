<?php

class MfFetchMessages extends AppModel
{
    // Mainly for PHP4 users
    var $name = 'MfFetchMessages';

    var $useTable = false;

    var $validate = array(  'threadId' => array( 'rule' => array( 'between', 36, 36 ),
                                            'required' => true,
                                            'message' => 'Please provide a thread id of 36 characters in length.' )
                            );
}

?>