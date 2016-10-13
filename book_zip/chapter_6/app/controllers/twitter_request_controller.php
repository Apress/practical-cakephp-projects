<?php

class TwitterRequestController extends AppController {

    var $cacheAction = array( 'TwitterRequest/view' => '60' );

    /*
    * View entire archive
    */    
	function view() {
		
        // get all twitter requests
        $allRequests = $this->TwitterRequest->find( 'all', 
                                                    array(  null, 
                                                            null, 
                                                            'recursive' => -1
                                                            ) );
        
        $this->set( 'twitterRequests', $allRequests );
    }
    
    /*
    * This should be called by cron every few seconds
    */    
    function getTwitterRequests() {
    
        $this->layout = 'blank';
        
        $this->makeTwitterRequest();
    }
    
    /*
    * This call the twitter public time line
    */    
    function makeTwitterRequest() {
        
        // save the request header
        $this->TwitterRequest->saveRequest();
                
        // Set up and execute the socket call
        $url = 'http://www.twitter.com/statuses/public_timeline.xml';
        
        App::import( 'HttpSocket' );
        $http = new HttpSocket();
        $request = array( 'uri' => $url );
        $body = $http->request($request);
        
        // now save into db
        $this->TwitterStatus->saveStatuses( $body,
                                            $this->TwitterRequest->id );
    }

}

?>