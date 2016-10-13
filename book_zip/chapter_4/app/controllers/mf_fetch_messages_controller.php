<?php

include_once( 'mf_controller.php' );

class MfFetchMessagesController extends MfController {

    var $name = 'MfFetchMessages';
    
    // The message results
    var $messages = array();
    
    // The message results ordered with indent indicator
    var $messagesOrdered = array();
    
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
    
        $this->data = array( 'MfFetchMessages' );                        
        $this->data[ 'MfFetchMessages' ][ 'threadId' ] = '';

        if ( isset( $this->passedArgs[ 'threadId' ] ) ) {
            $this->data[ 'MfFetchMessages' ][ 'threadId' ] = $this->passedArgs[ 'threadId' ];
        }
                            
        $this->MfFetchMessages->set( $this->data );                                     

        if ( !$this->MfFetchMessages->validates() ) {
        
            $result = false;
        
            $this->result[ 'result' ] = '0';
            $this->result[ 'message' ] = "There are some problems with your request.";
            $this->result[ 'errors' ] = $this->MfFetchMessage->validationErrors;
        }
                
        return $result;
    }                            
    	
    function index() {
    
        if ( $this->_validation() ) {

            $conditions = array ();
    
            if ( isset( $this->data[ 'MfFetchMessages' ][ 'threadId' ] ) ) {
            
                $threadId = $this->data[ 'MfFetchMessages' ][ 'threadId' ];
                $conditions[] = array( "Message.thread_id =" => $threadId );
            }
    
            $messages = $this->Message->find( 'all',
                                        array(  'conditions' => $conditions,
                                                null,
                                                'order' => 'Message.t_created_at ASC'
                                                ) );
            
            if ( $messages == '' ) {
            
                $this->result[ 'result' ] = '0';
                $this->result[ 'message' ] = 'There was a problem fetching the threads. Please try again later.';
            }
            else {
            
                $this->messages = $messages;
            
                $this->_sortMessages();
            
                $this->result[ 'result' ] = '1';
                $this->result[ 'message' ] = 'Messages fetched successfully.';
                $this->result[ 'data' ] = $this->messagesOrdered;
            }
        }
        
        $this->set( 'result', $this->result );    
    }
    
    function beforeRender() {
        
        $this->set( 'result', $this->result );   
    }
    
    function _sortMessages( $start_id = '', $level = '' ) {
    
        static $stopRun = 1;
        
        // you never know!
        if ( $stopRun++ > 1000 ) {
            return;
        }

        for( $idx=0; $idx<sizeof( $this->messages ); $idx++ ) {
            
            if ( !isset( $this->messages[$idx][ 'Done' ] ) ) {
            
                // Found a root message
                if ( $this->messages[$idx][ 'Message' ][ 'reply_to' ] == $start_id ) {
                
                    $this->messages[$idx][ 'Message' ][ 'indent' ] = $level;                        
                
                    $this->messagesOrdered[] = $this->messages[$idx]; 
                    
                    $message_id = $this->messages[$idx][ 'Message' ][ 'id' ];
                    
                    // that's done, lets remove it 
                    $this->messages[$idx][ 'Done' ] = '1';
                    
                    $this->_sortMessages( $message_id, $level.'.' );         
                }
            }
        }
    }
}

?>