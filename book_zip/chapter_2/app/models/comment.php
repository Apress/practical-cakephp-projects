<?php
class Comment extends AppModel
{
    // Mainly for PHP4 users
    var $name = 'Comment';

    // Which db table to use
    var $belongsTo = array('Post');
}
?>