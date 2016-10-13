<?php

/*
* This class is used to manage a journey
*/

class JourneysController extends AppController
{
    // Mainly for PHP4 users
    var $name = 'Journeys'; 

    // These are the models we're going to use in this controller
    var $uses = array( 'Journey', 'Tag', 'Location' );
    
    // Helpers for this controller
    var $helpers = array( 'Map' );

    /*
    * This action is called when a user clicks on the save journey
    */    
    function add_form() {
               
        // get the locations from the hidden form element
        $locations = json_decode( $this->data['locations'], true );
        $this->set( 'locations', $locations );
        
        // its a new journey, so no id yet
        $this->set( 'journey_id', "" );
    }
    
    /*
    * This carries out the action of saving the journey data as generated
    * by Google Map.   
    */    
    function add() {
        
        // If no data is supplied, we just render the journey form
        if ( empty( $this->data ) ) {
        
            $this->redirect( '/' );
            exit();
        }
        else {
        
            // Whether the save was successful
            $save_result = 1;
        
            if ( $save_result ) {
            
                // Check password
                $password = $this->data[ 'Journey' ][ 'password' ];
                if ( empty( $this->data[ 'Journey' ][ 'password' ] ) ) {
                    $password = rand( 1, 1000 );
                }
            
                // Save journey
                $journey = array();
                $journey[ 'journey_name' ] = $this->data[ 'Journey' ][ 'journey_name' ];
                $journey[ 'notes' ] = $this->data[ 'Journey' ][ 'notes' ];
                $journey[ 'password' ] = md5( $password );
                $save_journey_result = $this->Journey->save( $journey );
                
                // Journey didn't save properly
                if ( !$save_journey_result ) {
                    $save_result = 0;
                }
            }
            
            if ( $save_result ) {
            
                // Save locations
                $save_loc_result = $this->_save_locations(
                                        $this->data[ 'Journey' ][ 'locations' ],
                                        $this->Journey->id
                                        );
                                        
                // Locations didn't save properly
                if ( !$save_loc_result ) {
                    $save_result = 0;
                }       
            }       
            
             if ( $save_result ) {                                        
                                                                        
                // Save tags
                $save_tag_result = $this->_save_tags(
                                            $this->data[ 'Journey' ][ 'tags' ],
                                            $this->Journey->id
                                            );  
                                    
                // Tags didn't save properly
                if ( !$save_tag_result ) {
                    $save_result = 0;
                }  
            }                                                                                                   
                                        
            if ( $save_result ) {
            
                // Now render the success message view
                $this->set( 'journey_id', $this->Journey->id ); 
                
                $this->set( 'password', $password ); 
                
                $this->render( 'add_success' ); 
            }        
            else {
            
                $this->set( 'user_message',
                            'Please correct the form errors as shown below.' );
                
                // We have to reform the location data
                $locations_for_form = $this->_reformat_locations(
                                            $this->data['Journey']['locations']
                                            );                           
                $this->set( 'locations', $locations_for_form );    
                
                $this->set( 'journey_id', '' );  
                
                $this->render( 'add_form' );
            }                                                          
        }  
    }
    
    /*
    * This private action is used by the add action
    * to save the journey tags
    */
    function _save_tags( $tags, $journey_id ) {
    
        $tags_a = explode( ",", $tags );
        
        for( $idx=0; $idx<sizeof( $tags_a ); $idx++ ) {
            
            $db_tag = array();
            $db_tag[ 'tag_name' ] = trim( $tags_a[$idx] );
            $db_tag[ 'journey_id' ] = $journey_id;
            
            // We need to create a new tag before saving another
            $this->Tag->create( $db_tag );
            $save_result = $this->Tag->save( $db_tag );
            
            if ( !$save_result ) {
                return false;
            }
        }
        
        return true;
    }
    
    /*
    * This updates the details of a journey as saved by the add action
    */    
    function edit( $journey_id = '' ) {
               
        $this->Journey->id = $journey_id;
               
        // If no data is supplied, we redirect user back to the retrive form    
        if ( empty( $this->data ) ) {
        
            $this->redirect( '/journeys/retrieve_form' );
            exit();
        }
        else
        {
            // Whether the save was successful
            $save_result = 1;
        
            if ( $save_result ) {
            
                // Check password
                $password = $this->data[ 'Journey' ][ 'password' ];
                if ( empty( $this->data[ 'Journey' ][ 'password' ] ) ) {
                    $password = rand( 1, 1000 );
                }
            
                // Save journey
                $journey = array();
                $journey[ 'journey_name' ] = $this->data[ 'Journey' ][ 'journey_name' ];
                $journey[ 'notes' ] = $this->data[ 'Journey' ][ 'notes' ];
                $journey[ 'password' ] = md5( $password );
                $save_journey_result = $this->Journey->save( $journey );
                
                // Journey didn't save properly
                if ( !$save_journey_result ) {
                    $save_result = 0;
                }
            }
            
            if ( $save_result ) {
            
                $save_loc_result = $this->_save_locations(
                                        $this->data[ 'Journey' ][ 'locations' ],
                                        $this->Journey->id
                                        );
                                        
                // Locations didn't save properly
                if ( !$save_loc_result ) {
                    $save_result = 0;
                }       
            }       
            
             if ( $save_result ) {                                        
                                                                        
                // save tags
                $save_tag_result = $this->_update_tags(
                                            $this->data[ 'Journey' ][ 'tags' ],
                                            $this->Journey->id
                                            );  
                                    
                // Tags didn't save properly
                if ( !$save_tag_result ) {
                    $save_result = 0;
                }  
            }                                                                                                   
                                        
            if ( $save_result ) {
            
                // Now render the success message view
                $this->set( 'journey_id', $this->Journey->id ); 
                
                $this->set( 'password', $password ); 
                
                $this->render( 'edit_success' ); 
            }        
            else {
            
                $this->set( 'user_message',
                            'Please correct the form errors as shown below.' );
                
                // We have to reform the location data
                $locations_for_form = $this->_reformat_locations(
                                            $this->data['Journey']['locations']
                                            );                           
                $this->set( 'locations', $locations_for_form );  
                
                $this->set( 'journey_id', $this->Journey->id );  
                
                $this->render( 'add_form' );
            }                                                          
        }  
    }
    
    /*
    * This private action is used by the add and edit action
    * to save the journey locations
    */        
    function _save_locations( $location_comments, $journey_id ) {

        for( $idx=0; $idx<sizeof( $location_comments ); $idx++ ) {
                      
            $data = json_decode( $location_comments[$idx][ 'data' ], true );                   
                      
            $db_loc = array();
            $db_loc[ 'id' ] = $data[ 'id' ];
            $db_loc[ 'location_name' ] = $data[ 'location_name' ];
            $db_loc[ 'comments' ] = $location_comments[$idx][ 'comments' ];
            $db_loc[ 'coord' ] = $data[ 'coord' ];
            $db_loc[ 'journey_id' ] = $journey_id;
            
            // We need to create a new location before saving another
            $this->Location->create( $db_loc );
            $save_result = $this->Location->save();
            
            if ( !$save_result ) {
                return false;
            }
        }
        
        return true;
    }
    
    /*
    * This private action is used by the edit action
    * to update the journey tags
    */
    function _update_tags( $tags, $journey_id ) {
    
        // First we delete the old tags
        $this->Tag->deleteAll( array( 'journey_id' => $journey_id ) );
    
        $tags_a = explode( ",", $tags );
        
        for( $idx=0; $idx<sizeof( $tags_a ); $idx++ ) {
            
            $db_tag = array();
            $db_tag[ 'tag_name' ] = trim( $tags_a[$idx] );
            $db_tag[ 'journey_id' ] = $journey_id;
            
            $save_result = $this->Tag->create( $db_tag );
            $save_result = $this->Tag->save( $db_tag );
            
            if ( !$save_result ) {
                return false;
            }
        }
        
        return true;
    }

    /*
    * This private action is used by the edit and add actions to
    * reformat the locations data
    */            
    function _reformat_locations( $form_locations ) {
    
        $locations = array();
        
        for ( $idx=0; $idx<sizeof( $form_locations ); $idx++ ) {
                                
            $data = json_decode( $form_locations[$idx][ 'data' ], true );                                        
                             
            $locations_2 = array();
            $locations_2['id'] = $data['id'];
            $locations_2['coord'] = $data['coord'];
            $locations_2['location_name'] = $data['location_name'];
            $locations_2['comments'] = $form_locations[$idx][ 'comments' ];
            
            $locations[] = $locations_2;
        }
        
        return $locations;
    }
    
    
    
    /*
    * This action is used to display the retrieve journey form
    */    
    function retrieve_form() {
    
    }
    
    /*
    * This actions retrives the journey details
    */    
    function retrieve() {
               
        // If no data is supplied, we redirect user back to the retrive form    
        if ( empty( $this->data ) ) {
        
            $this->redirect( '/journeys/retrieve_form', null, true );
        }
        else
        {
            $journey_id = $this->data[ 'Journey' ][ 'journey_id' ];
            $password = $this->data[ 'Journey' ][ 'password' ];
            $journey = $this->Journey->find(
                                            array( 'id' => $journey_id,
                                            'password' => md5( $password ) ) );
        
            if ( $journey ) {
            
                // Name of the journey
                $this->data['Journey']['journey_name'] = $journey['Journey']['journey_name'];
                                
                // Tags relating to the journey 
                $this->data['Journey']['tags'] = $this->_implode_tag( $journey['Tag'] );
                
                // Notes of the journey
                $this->data['Journey']['notes'] = $journey['Journey']['notes'];
                
                // Locations of the journey
                $this->set( 'locations', $journey['Location'] );  
                
                // Journey ID
                $this->set( 'journey_id', $journey_id );  

                $this->render( 'add_form' );  
            }
            else
            {
                $this->set( 'user_message',
                            '   <div class="error-message">Sorry, we couldn\'t
                                find your journey, or your password is 
                                incorrect!</div>' );  
                
                $this->render( 'retrieve_form' );
            }
        }  
    }
    
    /*
    * Used by the retrieve action
    */
    function _implode_tag( $tags ) {
    
        $result = '';
        
        for( $idx=0; $idx<sizeof( $tags ); $idx++ ) {
            
            $result .= $tags[$idx]['tag_name'];
            if ( $idx+1 < sizeof( $tags ) ) { $result .= ','; }
        }
        
        return $result;
    } 
       
    /*
    * Display a journey
    */
    function display_journey( $get_journey_id = '' ) {
        
        $journey_id = $get_journey_id;
        
        if ( $this->data[ 'Journey' ][ 'journey_id' ] ) {
            $journey_id = $this->data[ 'Journey' ][ 'journey_id' ];
        }
        
        // If no data is supplied, we redirect user back to the retrive form    
        if ( $journey_id ) {
        
            $journey = $this->Journey->findById( $journey_id );
        
            if ( $journey ) {
                $this->set( 'journey', $journey ); 
            }
            else {
                $this->set( 'user_message',
                            '   <div class="error-message">Sorry, we 
                                couldn\'t find the journey!</div>' );
            }
        }
    }    
}

