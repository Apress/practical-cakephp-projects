<?php

include_once( 'mf_controller.php' );

class MfSearchProcessController extends MfController {

    var $name = 'MfSearchProcess';    
    
    var $paginate = array(  'limit' => 20,
                            'order' => array( 'Message.t_created_at' => 'asc' ) );
                            
    var $result = array(    'result' => '',
                            'message' => '',
                            'errors' => '',
                            'data' => '',
                            'search_term' => ''
                            );     
                            
    var $search_term = '';                                                   

    function _validation() {
    
        $result = true;
    
        if ( isset( $this->data[ 'MfSearchProcess' ]['search_term'] ) ) {
        
            $search_term = $this->data[ 'MfSearchProcess' ]['search_term'];
        }
        elseif ( $this->Session->read( "search_term" ) ) {
            
            $search_term = $this->Session->read( "search_term" );
            $this->data[ 'MfSearchProcess' ]['search_term'] = $search_term;
        }
        elseif ( isset( $this->passedArgs['search_term'] ) ) {
        
            $search_term = $this->passedArgs['search_term'];
            $this->data[ 'MfSearchProcess' ]['search_term'] = $search_term;
        }
        
        $this->MfSearchProcess->set( $this->data ); 
        
        // now check search term
        if ( !$this->MfSearchProcess->validates() ) {
        
            $result = false;

            $this->result[ 'result' ] = '0';

            // since there's only 1 field, for the minute
            // we'll assume its from the search term
            $validation_error = '';
            
            if ( isset( $this->MfSearchProcess->validationErrors[ 'search_term' ] ) ) {
                $validation_error = $this->MfSearchProcess->validationErrors[ 'search_term' ];
            }
            
            $message = __( 'Sorry, there was a problem with your search form. '.$validation_error, true );
            
            $this->result[ 'message' ] = $message;
            $this->result[ 'errors' ] = $this->MfSearchProcess->validationErrors;
        }
        
        $this->result[ 'search_term' ] = $this->data[ 'MfSearchProcess' ]['search_term'];
        $this->search_term = $this->data[ 'MfSearchProcess' ]['search_term'];
                
        return $result;
    } 
	
    function index() {
    
        $messages = array();

        if ( $this->_validation() ) {
            
            $conditions = array();
            
            if ( $this->search_term ) {
            
                $this->Session->write( "search_term", $this->search_term );
                
                $search_term = $this->search_term;
                
                $conditions[] = array( "MATCH(email,subject,message) AGAINST ('$search_term')" );
            }
            
            $messages = $this->paginate( 'Message', array( "or" => $conditions ) );
            
            if ( $messages == '' ) {
                $this->result[ 'result' ] = '0';
                $this->result[ 'message' ] = 'There was a problem with the search. Please try again later.';
            }
            else {
                        
                $this->result[ 'result' ] = '1';
                $this->result[ 'message' ] = 'Search results fetched successfully.';
                $this->result[ 'data' ] = $messages;
            }
        }
    }
    
    function beforeRender() {
        
        $this->set( 'result', $this->result );   
    }
}

?>