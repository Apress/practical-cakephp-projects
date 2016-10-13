<?php

include_once( 'mf_controller.php' );

class MfMessageProcessController extends MfController {

    var $name = 'MfMessageProcess';
    
    var $result = array(    'result' => '',
                            'message' => '',
                            'errors' => '',
                            'data' => ''
                            );
    
    function beforeFilter() {
        
        $this->_checkAjax();
    }     
    
    function _validation() {
    
        $result = true;
    
        if ( !empty( $this->data ) ) {
                            
            $this->Message->set( $this->data );                                     
    
            if ( !$this->Message->validates() ) {
            
                $result = false;
                
                if ( $this->RequestHandler->requestedWith() == 'form' ) {     			     
                    $this->Session->setFlash( __( 'Sorry, there was a problem with your form details, see below.', true ) );
                }
            
                $this->result[ 'result' ] = '0';
                $this->result[ 'message' ] = "There are some problems with your request.";
                $this->result[ 'errors' ] = $this->Message->validationErrors;
            }
        }
                
        return $result;
    } 
    	
    function index() {

        if ( $this->_validation() ) {
		
            $message_date = date( 'y-m-d H:i:s', mktime() );
            $message_id = String::uuid();
            $thread_id = String::uuid();
            $origThreadId = $this->data[ 'Message' ][ 'thread_id' ];
            
            if ( $this->data[ 'Message' ][ 'thread_id' ] ) {
                $thread_id = $this->data[ 'Message' ][ 'thread_id' ];
            }            		     
    	
            $this->Message->create();
    		
    		$this->data[ 'Message' ][ 't_created_at' ] = $message_date;
    		$this->data[ 'Message' ][ 'thread_id' ] = $thread_id;
    		$this->data[ 'Message' ][ 'id' ] = $message_id;
    		
    		if ( $this->Message->save( $this->data ) ) {		
            
                if ( $this->RequestHandler->requestedWith() == 'form' ) {       			 
    			    $this->Session->setFlash( __( 'Your message has been posted!', true ) );
                }    			     
    			
    			$this->result[ 'message' ] = 'Your message has been messageed!';
    			$this->result[ 'result' ] = '1';
    			$this->result[ 'errors' ] = '';
    			    			
    			// Save the thread
    			if ( empty( $origThreadId ) ) {
    			
        			$threadData = array();
        			$threadData[ 'first_message_id' ] = $message_id;
        			$threadData[ 'last_message_date' ] = $message_date;
        			$threadData[ 'id' ] = $thread_id;
        			$threadData[ 'message_num' ] = '1';
        			        			
        			$this->Thread->create();
                    $thread_save = $this->Thread->save( $threadData );
                    
                    if ( !$thread_save ) {
        
                        // Rollback, use transactions instead if you
                        // are using InnoDB
                        $this->Message->delete( $this->data );
                    }
                }
                else {
                    $this->Thread->threadPlusOne( $origThreadId );
                }
                
                // Everything seems ok, lets do a redirect after message
                // is it coming from a standard html message form
    			if ( $this->RequestHandler->requestedWith() == 'form' ) { 
                    $this->redirect( array( 'controller' => 'MfMessageForm',
                                            'action' => 'index' ) );
                    exit();
                }
            }	
            else {
    		
                if ( $this->RequestHandler->requestedWith() == 'form' ) {     			     
                    $this->Session->setFlash( __( 'Sorry, there was a problem with your form details, see below.', true ) );
                }
    			
    			$this->result[ 'message' ] = 'Sorry, there was a problem with your form details.';
    			$this->result[ 'result' ] = '0';
    			$this->result[ 'errors' ] = $this->Message->validationErrors;
            }		      
        }        
    }
    
    function beforeRender() {
        
        $this->set( 'result', $this->result );   
    }
}

?>