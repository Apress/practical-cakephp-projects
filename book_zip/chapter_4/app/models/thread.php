<?php

class Thread extends AppModel
{
    // Mainly for PHP4 users
    var $name = 'Thread';

    // Which db table to use
    var $useTable = 'threads';
               
    // This is need when we want to list all threads according to last post
    // So this is normally needed first
    var $belongsTo = array( 'Message' => array( 'className' => 'Message', 'foreignKey' => 'first_message_id' ) );               
                                    
    // This is needed when we're drilling down and looking at all posts within a thread                                        
    // var $hasMany = array( 'Message' => array( 'className' => 'Message', 'order' => 'Message.t_created_at' ) );

    function threadPlusOne( $threadId ) {
                
        uses('sanitize');
        $cleaner = new Sanitize();
        $threadId = $cleaner->escape( $threadId );
        
        $this->query( "update threads set message_num = message_num+1 where id = '".$threadId."'" );
    }
}

?>