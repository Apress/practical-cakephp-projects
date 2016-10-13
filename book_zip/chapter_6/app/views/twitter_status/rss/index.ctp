<?php

    function rssTransform( $current_status ) {
    
        return array('title' => $current_status['v_t_user_name'],
                    'link' => 'http://twitter.com/'.$current_status[ "v_t_user_screen_name" ],
                    'guid' => 'http://twitter.com/'.$current_status[ "v_t_user_screen_name" ],
                    'description' => $current_status['v_t_text'],
                    'pubDate' => $current_status['v_t_created_at'],              
                    );
                    
    }
    
    echo $rss->items( $statuses, 'rssTransform' );
?>

