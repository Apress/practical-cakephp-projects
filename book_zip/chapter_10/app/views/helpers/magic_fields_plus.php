<?php

class MagicFieldsPlusHelper extends AppHelper {

    function errors( $view ) {
    
        if ( isset( $view->validationErrors[ 'YourTable' ][ 'm_lock' ] ) ) {
            echo '<h4>'.$view->validationErrors[ 'YourTable' ][ 'm_lock' ].'</h4>';
        }
    }
}

?>