
var TravelMapprManager = Class.create( {

    // id of container
    map_container : '',

    /* the current map */
    map : null,
    
    /* geocoding location */
    geocoder : null,
    
    /* user entered locations */
    user_journey : new Array(),

    initialize : function( map_container ) {
    
        this.map_container = map_container;
        
        // start the map
        Event.observe( window, 'load', this.displayMap.bind(this) );
        
        // observe the map buttons
        Event.observe( document, 'dom:loaded', this.initObservers.bind(this) );
        
    },
    
    initObservers : function() {
    
        if ( $('location_name_button') ) {
            $('location_name_button').observe(
                'click', this.findLocation.bindAsEventListener(this) );
        }
        
        if ( $('find_route_button') ) {
            $('find_route_button').observe(
                'click', this.findBestJourney.bindAsEventListener(this) );
        }
        
        if ( $('start_again_button') ) {
            $('start_again_button').observe(
                'click', this.startAgain.bindAsEventListener(this) );
        }
         
        if ( $('add_form') ) {               
            $('add_form').observe( 'submit',
                this.saveJourney.bindAsEventListener(this) );
        }
    },

    displayMap : function() {
    
        if ( GBrowserIsCompatible() ) {
        
            if ( $( this.map_container ) ) {
            
                // create a map instance
                this.map = new GMap2( $( this.map_container ) );
                
                // add map controls
                this.map.addControl(new GLargeMapControl());
                this.map.addControl(new GMapTypeControl());
                
                // center the map at a certain location
                this.map.setCenter( new GLatLng( 48.85656, 2.35097 ), 8 );
                
                // setup a geocoding instance
                this.geocoder = new GClientGeocoder();
                
                // unload map
                Event.observe( window, 'unload', GUnload );
            }
        }
    },
    
    /*
    * Save the location entered
    */
    findLocation : function() {
    
        location_name = $( 'LocationName' ).value;
        
        if ( location_name == '' ) {
            alert( "Please enter a location name." );
            return;            
        }
    
        // we only allow a maximum number of locations
        if ( this.user_journey.length >= 20 ) {
            alert( "Sorry! We have reached the maximum number of locations." );
            return;
        }
    
        // Do geocoding, find the longitude and latitude of the location
        if ( this.geocoder ) {
        
            var current_o = this;
        
            this.geocoder.getLatLng(
                location_name,
                function( point ) {
                
                    if ( !point ) {
                        alert( location_name + " not found" );
                    } else {
                    
                        // store the location
                        current_o.storeLocation( location_name, point );
                    
                        // center the location on the map and add push pin marker
                        current_o.map.setCenter( point, 13 );
                        var marker = new GMarker( point );
                        current_o.map.addOverlay( marker );
                    }
                }
            );
        }
    },
    
    /*
    * Store the location
    */
    storeLocation : function( location_name, point ) {
    
        var new_loc = new Array();
        
        new_loc['coord'] = point.lat()+','+point.lng();
        new_loc['location_name'] = location_name;
    
        this.user_journey.push( new_loc );
        
        // update the journey message
        this.updateJourneyMessage()
    },
    
    /*
    * Update journey message
    */
    updateJourneyMessage : function() {
    
        // default journey message
        var journey_message =   'You currently have no journey planned, ';
                                + 'start by entering a starting location.';
    
        if ( this.user_journey.length > 0 ) {
            
            journey_message = 'Locations you are visiting:<br />';
        
            for ( var x = 0; x < this.user_journey.length; x++ ) {  
                loc_num = x+1;
                journey_message += loc_num + ': '
                                + this.user_journey[x][ 'location_name' ] + '<br />';
            }
        }
        
        $( 'journey_helper_message' ).innerHTML = journey_message;
    },
    
    /*
    * Find the best journey using the Nearest Neighbour Algorithm
    */
    
    // all the journey combinations, A=>B, A=>C, ...etc. but not B=>A
    journey_combination : new Array(),

    findBestJourney : function() {
    
        // we won't calculate a journey if there is no journey to calculate
        if ( this.user_journey.length < 2 ) {
            alert( "Please enter at least 2 locations." );
            return;          
        }
    
        // we won't calculate the journey again if its already been done.
        if ( this.best_journey.length == this.user_journey.length ) {
            return;
        }
    
        // get all the journey combinations
        var num_locs = this.user_journey.length;
        
        for ( var x = 0; x < num_locs; x++ ) {
    
            from_here = this.user_journey[x];
            
            for ( var y = x+1; y < num_locs; y++ ) {
            
                to_here = this.user_journey[y];
                                            
                current_journey = new Array();
                                
                current_journey[ "from" ] = from_here;
                current_journey[ "to" ] = to_here;
                current_journey[ "journey_distance" ] = '';
                                                
                this.journey_combination.push( current_journey );
            }
        }
        
        this.getJourneyDistance();
               
        return false;    
    },
    
    /*
    * This gets the journey distance, Mainly the distance between each location.
    * This function is recursive.
    */
    getJourneyDistance : function() {
    
        // start getting the journey distance, once we have found a journey
        // without any distance, lets just pick that one and fetch the 
        // journey distance from Google.
        var do_journey = -1;
        
        for ( var x = 0; x < this.journey_combination.length; x++ ) {  
        
            if ( this.journey_combination[x][ 'journey_distance' ] == '' ) {
                // no journey distance here, so lets get it
                var do_journey = x;
                break;
            }  
        }
               
        if ( do_journey >= 0 ) {
            
            // we found a journey to do
                           
            var directions = new GDirections();
                        
            var current_o = this;
            
            GEvent.addListener( directions, "load", function() {
                current_o.journey_combination[do_journey][ 'journey_distance' ] = directions.getRoute(0).getDistance().meters;
                current_o.getJourneyDistance();
            });
                        
            direction_journey = 'from: ';
            direction_journey += this.journey_combination[do_journey]['from']['coord'];
            direction_journey += ' to: ';
            direction_journey += this.journey_combination[do_journey]['to']['coord'];
            
            directions.load( direction_journey );
            
            return true;
        }
        
        // now that its all finished, we can starting calculating the journey
        this.calcTSP();
            
        
    },
                
    // cities already visited
    visited : new Array(),
    
    // for holding the best journey
    best_journey : new Array(),
    
    calcTSP : function() {
        
        var stopInfin = 0;
        
        // while there is a next location to visit
        while ( this._visitNextCity() ) {
        
            // temp var for holding the best(shorest) nearest neighbour so far
            var nearest_neighbour = -1;
        
            if ( stopInfin > 10 ) { return; }
            stopInfin++;
        
            start_here = this._getNextNeighbour();
                
            // get all neighbours that's not been visited from the
            // "start_here" location   
            var neighbours = this._getNearestNeighbours( start_here );  
            
            for ( var x = 0; x < neighbours.length; x++ ) {  
            
                if ( nearest_neighbour == -1 ) {
                    nearest_neighbour = neighbours[x];                    
                }
                
                // now find the shortest journey
                if (    neighbours[x][ 'journey_distance' ] <
                        nearest_neighbour[ 'journey_distance' ] ) {
                    nearest_neighbour = neighbours[x]; 
                }   
            }               
            
            if ( nearest_neighbour != -1 ) {
            
                // we should now have the next nearest neighbour
                this.best_journey.push( nearest_neighbour['to'] );
                
                this._markVisited( nearest_neighbour['to'] );  
            }
        }
                
        this._plotBestJourney();
    },
    
    _visitNextCity : function() {
    
        if ( this.visited.length == this.user_journey.length ) {
            return false;
        }
        
        return true;
    },
    
    _getNextNeighbour : function() {
    
        var next_city = '';
    
        if ( this.best_journey.length == 0 ) {
        
            // init. we take the first journey as the starting point
            start_here = this.journey_combination[0]['from'];
            this.best_journey.push( start_here );
            this._markVisited( start_here );  
            
            next_city = start_here;
        }
        else {
        
            // we pick the last city
            var last_loc = this.best_journey.length-1;
            next_city = this.best_journey[last_loc];
        }   
                
        return next_city;                        
    },
    
    _plotBestJourney : function() {
    
        var new_journey = new Array();
    
        for ( var x = 0; x < this.best_journey.length; x++ ) {  
            direction_journey = this.best_journey[x]['coord'];
            new_journey[x] = direction_journey;
        }     
        
        // add the starting point back as starting position
        new_journey.push( this.best_journey[0]['coord'] );
        
        directions = new GDirections( this.map );
        
        var current_o = this;
        
        // remove the default red markers
        GEvent.addListener( directions, "load", function() {
            current_o.map.clearOverlays();
        } );
        
        // remove the last marker, so the first one would show up
        GEvent.addListener( directions, "addoverlay", function() {
            var num_markers = directions.getNumGeocodes();
            current_o.map.removeOverlay( directions.getMarker(num_markers-1) );
        } );
            
        directions.loadFromWaypoints( new_journey );
    },
    
    _markVisited : function( loc ) {
    
        this.visited.push( loc['location_name'] );
    },
    
    _locVisited : function( location_name ) {
        
        for ( var x = 0; x < this.visited.length; x++ ) {  
            
            if ( location_name == this.visited[x] ) {
                return true;
            }
        }
        
        return false;
    },
    
    /*
    * Get all neighbours not visited
    */        
    _getNearestNeighbours : function( from_loc ) {
    
        var result = new Array();
        
        for ( var x = 0; x < this.journey_combination.length; x++ ) {  
                
            if ( from_loc['location_name'] == this.journey_combination[x]['from']['location_name'] )
            {
                var next_loc = new Array();
                next_loc[ 'from' ] = from_loc;
                next_loc[ 'to' ] = this.journey_combination[x]['to'];
                next_loc[ 'journey_distance' ] = this.journey_combination[x]['journey_distance'];
            
                // check whether the to has been visited already
                if ( !this._locVisited( this.journey_combination[x]['to']['location_name'] ) ) {
                    result.push( next_loc );
                }
            }   
            else if ( from_loc['location_name'] == this.journey_combination[x]['to']['location_name'] )
            {
                var next_loc = new Array();
                next_loc[ 'from' ] = from_loc;
                next_loc[ 'to' ] = this.journey_combination[x]['from'];
                next_loc[ 'journey_distance' ] = this.journey_combination[x]['journey_distance'];
            
                // check whether the from has been visited already
                if ( !this._locVisited( this.journey_combination[x]['from']['location_name'] ) ) {
                    result.push( next_loc );
                }
            }  
        }
                
        return result;
    },
    
    /*
    * Start another fresh search
    */
    startAgain : function() {
    
        if ( this.user_journey.length == 0 ) {
            alert( 'It is already a new journey!' );
            return false;
        }
        
    	if ( !confirm( "Start a new journey?" ) ){
    	   return false;
    	}
    	
    	// init the map
    	this.displayMap();
    
        // reset user journey
        this.user_journey = new Array();
        
        // cities visited
        this.visited = new Array();
        
        // journey combinations
        this.journey_combination = new Array();
        
        // best journey
        this.best_journey = new Array();
        
        // user journey message
        this.updateJourneyMessage();
        
        // clear location box
        $( 'LocationName' ).value = '';
    },
    
    /*
    * Check whether a journey exists
    */
    checkJourneyExists : function() {
    
        if ( this.best_journey.length == 0 ) {
            alert(  'No journey to save, create a journey first,\nor maybe'
                    + ' the journey has not been calculated yet.' );
            return false;
        }
        
        return true;
    },
    
    saveJourney : function(e) {
    
        if ( this.checkJourneyExists() ) {
        
            // creat the json notation
            xml_loc = '{'; 
            
            for ( var x = 0; x < this.best_journey.length; x++ ) { 
                xml_loc += '"' + x + '":';
                xml_loc += '{'
                
                xml_loc += '"id":';
                xml_loc += '""';
                
                xml_loc += ',';
                
                xml_loc += '"comments":';
                xml_loc += '""';
                
                xml_loc += ',';
                
                xml_loc += '"coord":';
                xml_loc += '"' + this.best_journey[x]['coord'] + '"';
                
                xml_loc += ',';
                
                xml_loc += '"location_name":';
                xml_loc += '"' + this.best_journey[x]['location_name'] + '"';
                
                xml_loc += '}'
                
                if ( x+1 < this.best_journey.length ) { xml_loc += ','; }
            }
            
            xml_loc += '}'; 
        
            $('locations').value = xml_loc;
            
            return true;
        }
        else {
            
            Event.stop(e);
        
            return false;
        }
    }
    
} );

new TravelMapprManager( 'map_canvas' );

