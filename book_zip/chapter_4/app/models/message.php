<?php

class Message extends AppModel
{
    // Mainly for PHP4 users
    var $name = 'Message';

    // Which db table to use
    var $useTable = 'messages';
    
    var $belongsTo = array( 'Thread' => array( 'className' => 'Thread', 'foreignKey' => 'thread_id' ) );
    
    // The journey data validation
    var $validate = array(  'email' => array( 'rule' => array( 'between', 1, 255 ),
                                            'required' => true,
                                            'message' => 'Please enter an email address.' ),
                            'subject' => array( 'rule' => array( 'between', 1, 255 ),
                                                'required' => true,
                                                'message' => 'Please enter a subject.' )                                            
                            );
                                            
                                              
}
?>