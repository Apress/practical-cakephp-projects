<?php

    for( $idx=0; $idx<sizeof( $statuses ); $idx++ ) {
    
        echo '<status>';
            echo '<user_name>'.$statuses[$idx][ "v_t_user_name" ].'</user_name>';
            echo '<text>'.$statuses[$idx][ "v_t_text" ].'</text>';
        echo '</status>';
    }

?>