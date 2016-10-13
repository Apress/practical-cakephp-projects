<?php

class TwitterTranslation extends AppModel
{
    // Mainly for PHP4 users
    var $name = 'TwitterTranslation';
    
    var $belongsTo = array( 'TwitterStatus' => array(
                                        'className' => 'TwitterStatus',
                                        'foreignKey' => 'twitter_status_id' ) );  
}

?>