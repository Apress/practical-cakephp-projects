<h2>Search Results</h2>

<?php
    if ( $result[ 'result' ] == '0' ) {
        echo '<div class="hilight">';
        echo $result[ 'message' ];
        echo '</div>';
    }
?>

<?php

    if ( $result[ 'data' ] ) {
    
        foreach ( $result[ 'data' ] as $current_message ) {
            
            echo '<div class="message_header">';
                echo '<h3>'.$current_message[ 'Message' ][ "subject" ].'</a></h3>';
                echo '&nbsp;<h6>By '.$current_message[ 'Message' ][ "email" ].'</h6>';
                 
            echo '</div>';
            
            $message_id = $current_message[ 'Message' ][ "id" ];
            $thread_id = $current_message[ 'Message' ][ "thread_id" ];
                    
            echo '<div class="message_message" short_message="" full_message="" fetched="0" id="message_'.$message_id.'">';
                
                echo $text->highlight(   $current_message[ 'Message' ][ "message" ],
                                    $result[ 'search_term' ],
                                    '<span class="highlight_search">\1</span>'
                                    ); 
                
                echo '<div><span id="open_link_'.$message_id.'"><a href="/cake/__chapters__/message_forum/MfFetchMessages/index/threadId:'.$thread_id.'/">View in thread</a></div>';
            echo '</div>';
        }
    }
    else {
        echo '<div class="hilight">';
        echo 'No Results';
        echo '</div>';
    }

?>

<hr class="paginator_line">

<?php
    if ( isset( $paginator ) ) {
    
        $paginator->options(array('update' => 'main_content_container', 'indicator' => 'loading')); 
    
        echo $paginator->prev( '« Previous ', null, null, array( 'class' => 'disabled' ) );
        echo '&nbsp;';
        echo $paginator->next( ' Next »', null, null, array( 'class' => 'disabled' ) );
        echo '&nbsp;';
        echo $paginator->counter();
    }
?>

