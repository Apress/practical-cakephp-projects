<?php

    foreach ( $twitterRequests as $currentRequest ) {
        
        $archive_url = $html->link( $currentRequest[ "TwitterRequest" ][ "request_time" ],
                                    '/TwitterStatus/index/id:'.$currentRequest[ "TwitterRequest" ][ "id" ].'/lang:'.$session->read( "userLang" )
                                    );
    
        echo '<p>';
        echo '<h4>'.$archive_url.'</h4>';
        echo '</p>';
    }

?>
