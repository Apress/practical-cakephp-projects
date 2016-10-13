<?php

    if ( isset( $result[ 'data' ][ 'Message' ] ) ) {
    
        echo '<div class="message">';
        
            echo '<div class="message_header">';
                echo '<h3>'.$result[ 'data' ][ 'Message' ][ "subject" ].'</a></h3>';
                echo '&nbsp;<h6>By '.$result[ 'data' ][ 'Message' ][ "email" ].'</h6>';
            echo '</div>';
            
            $message_id = $result[ 'data' ][ 'Message' ][ "id" ];
            $thread_id = $result[ 'data' ][ 'Message' ][ "thread_id" ];
                    
            echo '<div class="message" short_message="" full_message="" fetched="0" id="message_'.$message_id.'">';
                
                echo $result[ 'data' ][ 'Message' ][ "message" ];
                
                $reply_link = $html->link( 'Reply', '/cake/__chapters__/message_forum/MfMessageForm/index/reply_to:'.$message_id.'/thread_id:'.$thread_id.'/' );
                echo '<div>'.$reply_link.'</div>';
                
            echo '</div>';
        
        echo '</div>';
    }
?>