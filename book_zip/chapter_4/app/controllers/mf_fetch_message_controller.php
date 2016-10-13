<?php

include_once( 'mf_controller.php' );

class MfFetchMessageController extends MfController {

    var $name = 'MfFetchMessage';
    
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
    
        $this->data = array( 'MfFetchMessage' );                        
        $this->data[ 'MfFetchMessage' ][ 'messageId' ] = '';

        if ( isset( $this->passedArgs[ 'messageId' ] ) ) {
            $this->data[ 'MfFetchMessage' ][ 'messageId' ] = $this->passedArgs[ 'messageId' ];
        }
                            
        $this->MfFetchMessage->set( $this->data );                                     

        if ( !$this->MfFetchMessage->validates() ) {
        
            $result = false;
        
            $this->result[ 'result' ] = '0';
            $this->result[ 'message' ] = "There are some problems with your request.";
            $this->result[ 'errors' ] = $this->MfFetchMessage->validationErrors;
        }
                
        return $result;
    }        

    function index() {
                            
        if ( $this->_validation() ) {

            $message = $this->Message->findById( $this->data[ 'MfFetchMessage' ][ 'messageId' ] );
            
            if ( $message == '' ) {
                $this->result[ 'result' ] = '0';
                $this->result[ 'message' ] = 'There was a problem fetching the message. Please try again later.';
            }
            else {
                
                $this->result[ 'result' ] = '1';
                $this->result[ 'message' ] = 'Message fetched successfully.';
                $this->result[ 'data' ] = $message;
            }
        }
    }
    
    function beforeRender() {
        
        $this->set( 'result', $this->result );   
    }
}

?>