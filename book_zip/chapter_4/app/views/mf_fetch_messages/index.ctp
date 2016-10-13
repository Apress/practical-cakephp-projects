<h2>Messages</h2>

<?php

    if ( isset( $result[ 'data' ][0] ) ) {
    
        foreach ( $result[ 'data' ] as $current_message ) {
        
            // $indent = strlen( $current_message[ 'Message' ][ "indent" ] )*20;
            $indent = strlen( $current_message[ 'Message' ][ "indent" ] );
        
            echo '<div style="margin-left: '.$indent.'em;">';
            
                echo '<div class="message_header">';
                    echo '<h3>'.$current_message[ 'Message' ][ "subject" ].'</a></h3>';
                    echo '&nbsp;<h6>By '.$current_message[ 'Message' ][ "email" ].'</h6>';
                     
                echo '</div>';
                
                $message_id = $current_message[ 'Message' ][ "id" ];
                $thread_id = $current_message[ 'Message' ][ "thread_id" ];
                        
                echo '<div class="message_message" short_message="" full_message="" fetched="0" id="message_'.$message_id.'">';
                    echo $current_message[ 'Message' ][ "message" ];
                    echo '<div><a href="/cake/__chapters__/message_forum/MfMessageForm/index/reply_to:'.$message_id.'/thread_id:'.$thread_id.'/">Reply</a></div>';
                echo '</div>';
            
            echo '</div>';
        }
    }

?>

