<?php

include_once( 'mf_controller.php' );

class MfMessageFormController extends MfController {

    var $name = 'MfMessageForm';

    function index() {

        if ( isset( $this->passedArgs['reply_to'] ) ) {
        
            $this->data['Message']['reply_to'] = $this->passedArgs['reply_to'];
            
            $replyMessageId = $this->data['Message']['reply_to'];
            $replyMessage = $this->Message->findById( $replyMessageId );
            
            if ( !empty( $replyMessage ) ) {
            
                $this->data['Message']['subject'] = 'RE: '.$replyMessage[ 'Message' ][ 'subject' ];
            }
        }            

        if ( isset( $this->passedArgs['thread_id'] ) ) {
        
            $this->data['Message']['thread_id'] = $this->passedArgs['thread_id'];
        }
    }
}

?>