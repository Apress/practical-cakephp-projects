<?php

class MfFetchMessage extends AppModel
{
    // Mainly for PHP4 users
    var $name = 'MfFetchMessage';

    var $useTable = false;

    var $validate = array(  'messageId' => array(   'rule' => array( 'between', 36, 36 ),
                                                    'required' => true,
                                                    'message' => 'Please provide a message id of 36 characters in length.' )
                            );
}

?>