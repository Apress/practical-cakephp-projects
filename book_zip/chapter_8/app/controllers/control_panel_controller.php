<?php

class ControlPanelController extends AppController {

	var $name = 'ControlPanel';
	var $helpers = array('Html', 'Form');
	
	var $uses = array( 'User' );

    function beforeFilter() {  
        
        // public access actions
        $this->Auth->allow( 'welcome' ); 
    }

    // Public welcome page of control panel
    function welcome() {
    
        // check if the temporary user exists
        $tmpUser = $this->User->findByUsername( 'temp' );
        
        if ( empty( $tmpUser ) ) {
            
            $this->User->create();
            $this->User->save( array(   'username' => 'temp',
                                        'password' => Security::hash( 'temp', null, true ) ) );
        }
    }

    // Page when logged in
	function index() {
		
	}
	
	function dashBoard() {
		
		// list number of users
		
		// last login users
		
		// first 10 lines of debug log
		
		// last 10 lines of error log
		
		// application specific data
    }
}
?>