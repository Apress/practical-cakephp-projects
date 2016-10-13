<?php
    
    // This is used when the call extension is .json
    header( "Pragma: no-cache" );
    header( 'Content-Type: text/x-json' );
    header( "X-JSON: ".$content_for_layout );
    
    $controller = $this->name;
    $action = $this->action;
    $datetime = date( "Y_M_j__G_i_s_T" ); 
    $file_name = $controller.'_'.$action.'_'.$datetime;
    
    header( 'Content-Disposition: attachment; filename="'.$file_name.'.json"' );
    
    echo $content_for_layout;
?>