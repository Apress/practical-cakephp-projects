<?php
 
class AppController extends Controller {

    // default page title
    var $pageTitle = 'Chapter 4 - A Message Forum Web Webservice';
    
    // The view helpers that we'll use globally
    var $helpers = array( 'Ajax', 'Form', 'Html', 'Text' ); 
    
    // Componenets that we'll often use
    var $components = array( 'Session', 'RequestHandler' );

}
?>