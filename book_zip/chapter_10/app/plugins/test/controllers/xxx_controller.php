<?php

class XxxController extends TestAppController { 

	var $uses = null;

	function index() {
	   
	   $var1 = '';
	   
	   if ( isset( $this->passedArgs['var1'] ) ) {
	       $var1 = $this->passedArgs['var1'];
	   }
	   
	   $this->set( 'what', $var1 );
	}
}

?>
