<?php

include_once( 'mf_controller.php' );

class MfFetchThreadsController extends MfController {

    var $name = 'MfFetchThreads';
    
    var $paginate = array(  'limit' => 20,
                            'order' => array( 'Thread.last_message_date' => 'DESC' ) );
                            
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
        
        return $result;
    }                                                       
	
    function index() {
    
        if ( $this->_validation() ) {
        
            $threads = $this->paginate( 'Thread' );
    
            if ( $threads == '' ) {
                $this->result[ 'result' ] = '0';
                $this->result[ 'message' ] = 'There was a problem fetching the threads. Please try again later.';
            }
            else {
                $this->result[ 'result' ] = '1';
                $this->result[ 'message' ] = 'Threads fetched successfully.';
                $this->result[ 'data' ] = $threads;
            }
        }
    }
    
    function beforeRender() {
        
        $this->set( 'result', $this->result );   
    }
}

?>