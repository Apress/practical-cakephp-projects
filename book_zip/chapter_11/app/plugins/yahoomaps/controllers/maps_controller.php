<?php

class MapsController extends YahooMapsAppController { 

	var $uses = null;

	function display() {
	   
	   // do longitude
	   $longitude = '-0.127144';
	   
	   if ( isset( $this->passedArgs['longitude'] ) ) {
	       $longitude = $this->passedArgs['longitude'];
	   }
	   
	   $this->set( 'longitude', $longitude );
	   
	   // do latitude
	   $latitude = '51.506325';
	   
	   if ( isset( $this->passedArgs['latitude'] ) ) {
            $latitude = $this->passedArgs['latitude'];
	   }
	   
	   $this->set( 'latitude', $latitude );
	   
	   // location can also be specified
	   // which overrides the long and lat values
	   $this->set( 'location', '' );
	   
	   if ( isset( $this->passedArgs['location'] ) ) {
	       $this->set( 'location', $this->passedArgs['location'] );
	   }
	}
}

?>
