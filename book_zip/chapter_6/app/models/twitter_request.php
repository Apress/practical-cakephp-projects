<?php

class TwitterRequest extends AppModel
{
    // Mainly for PHP4 users
    var $name = 'TwitterRequest';
                                    
    // Each journey has many locations and also many tags.                                            
    var $hasMany = array(
                    'TwitterStatus' => array(
                        'className' => 'TwitterStatus',
                        'order'     => 'TwitterStatus.t_created_at' ) );

    function saveRequest() {
    
        // each request must be saved in the twitter_requests table
        $reqData = array();
        $reqData[ 'request_time' ] = date( 'Y-m-d H:i:s', mktime() );
        $this->create( $reqData );
        $this->save(); 
    }
}

?>