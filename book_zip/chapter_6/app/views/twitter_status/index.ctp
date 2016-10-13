<?php

    foreach ( $statuses as $current_status ) {
        
        echo '<div class="status_rec">';
            echo '<h3><a href="http://twitter.com/'.$current_status[ "v_t_user_screen_name" ].'" target="_blank">'.$current_status[ "v_t_user_name" ].'</a></h3>';
            echo '<hr align="left" noshade="" size=1 width="100%">';
            
            if ( $current_status[ "v_t_user_url" ] ) {
                echo '  <a href="'.$current_status[ "v_t_user_url" ].'">
                        <img class="profile_img" src="'.$current_status[ "v_t_user_profile_image_url" ].'" align="left"></a>';
            }
            else {
                echo '<img class="profile_img" src="'.$current_status[ "v_t_user_profile_image_url" ].'" align="left">';
            }
            
            echo $current_status[ "v_t_text" ].'<br />';
            
            if ( $current_status[ "v_t_user_location" ] ) {
                echo '<b>From:</b> '.$current_status[ "v_t_user_location" ];
            }
             
        echo '</div>';
    }

?>
