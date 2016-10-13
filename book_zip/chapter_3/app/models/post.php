<?php
class Post extends AppModel
{
    // Mainly for PHP4 users
    var $name = 'Post';

    // Which db table to use
    var $useTable = 'posts';
	
    var $belongsTo = array( 'User' => array( 'className' => 'User', 'foreignKey' => 'user_id' ) );
}
?>