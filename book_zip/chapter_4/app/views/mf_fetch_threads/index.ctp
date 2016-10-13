<h2>Threads</h2>

<?php
    echo $javascript->link( 'mf_fetch_threads/index' );
?>

<?php

    foreach ( $result[ 'data' ] as $current_message ) {
        
        $message_id = $current_message[ 'Message' ][ "id" ];
        $thread_id = $current_message[ 'Message' ][ "thread_id" ];
        $message_num = $current_message[ 'Thread' ][ "message_num" ];
        
        echo '<div class="thread_header">';
            echo '<h3>'.$current_message[ 'Message' ][ "subject" ].'</a></h3>';
            echo '&nbsp;<h6>Started By '.$current_message[ 'Message' ][ "name" ].'</h6>';
            
            // number of messages
            echo '&nbsp;|&nbsp;'.$message_num.' messages';
            
            // open link
            echo '&nbsp;|&nbsp;<span id="open_link_'.$message_id.'"><a href="javascript: void(0);" onclick="getMessage(\''.$message_id.'\',\''.$thread_id.'\');">Open</a></span>';
            
            // view thread   
            echo '&nbsp;|&nbsp;<a href="/cake/__chapters__/message_forum/MfFetchMessages/index/threadId:'.$thread_id.'/">List Messages</a>';           
             
            // loading 
            echo '&nbsp;|&nbsp;<div id="loading_'.$message_id.'"></div>';             
             
        echo '</div>';

        // display first message                
        echo '<div class="thread_message" short_message=""
            full_message="" fetched="0" id="message_'.$message_id.'"></div>';
    }

?>

<hr class="paginator_line">

<?php
    if ( isset( $paginator ) ) {
    
        echo $paginator->prev( '« Previous ', null,
                                null, array( 'class' => 'disabled' ) );
        echo '&nbsp;';
        echo $paginator->next( ' Next »', null,
                                null, array( 'class' => 'disabled' ) );
        echo '&nbsp;';
        echo $paginator->counter();
    }
?>
