<?php
class AppController extends Controller {
    // default page title
    var $pageTitle = 'Chapter 2 - Blogging';
    
    // The view helpers that we'll use globally
    var $helpers = array( 'Form', 'Html', 'Ajax', 'Session', 'Javascript', 'Rss' );
    
    // Components that we'll often use
    var $components = array( 'Session', 'RequestHandler' );
}
?>