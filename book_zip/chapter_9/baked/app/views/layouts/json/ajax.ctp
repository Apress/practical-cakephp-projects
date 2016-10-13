<?php

    // This is used when the call is from an ajax form
    // Used like this in the controller
    /*
    if ( $this->RequestHandler->isAjax() ) { 
        $this->RequestHandler->renderAs( $this, 'json' );
    }
    */

    header("Pragma: no-cache");
    header("Cache-Control: no-store, no-cache, max-age=0, must-revalidate");
    header('Content-Type: text/x-json');
    header("X-JSON: ".$content_for_layout);
    
    echo $content_for_layout;
?>