<?php

class UsersController extends AppController {

	var $name = 'Users';
	
	var $helpers = array('Html', 'Form');
	
	function login() {
	
		if ( !empty( $this->data ) ) {
		
			$user = $this->User->findByUsername( $this->data['User']['username'] );
			
			if( $user ) {
			
    			if( $user['User']['password'] == md5( $this->data['User']['password'] ) ) {
    			
    				$this->Session->write( 'User', $user );
    				                
    				$this->Session->setFlash( 'Hello! '.$user['User']['name'] );
    				
                    $this->redirect('/');
                    
    			}
                else {
    				$this->set( 'error', 'Login Failed!' );
    			}
    		}
		}
	}

	function logout() {
		
		$this->Session->delete('User');
		
		$this->Session->setFlash( 'Log out OK. Please come back soon!' );
		
        $this->redirect('/');
	}
}

?>