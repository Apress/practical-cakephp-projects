<?php

class MfController extends AppController {

    var $name = 'Mf';
	
	var $uses = array( 'Thread', 'Message', 'MfSearchProcess', 'MfFetchMessage',
                        'MfFetchMessages', 'MfFetchThreads' );

    function _checkAjax() {
        
        if ( $this->RequestHandler->isAjax() ) { 
        
            // this must exist: \app\views\layouts\json\ajax.ctp
            $this->RequestHandler->renderAs( $this, 'json' );
        }
    }

    function index() {

    }
}

?>