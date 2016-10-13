<?php
class ActionsController extends AppController {

	var $name = 'Actions';
	var $helpers = array('Html', 'Form');

    function beforeFilter() {  
        
        // we need to temporarily allow access during the setup
        $this->Auth->allow( 'index' ); 
    }

    // Add and remove controller actions for Aco
	function index() {

        if (!empty($this->data)) {
            
            $this->__processActions();            
        }
            
        $this->__listActions();                
    }
	
	// Add or delete actions
	function __processActions() {

        $securityAccess = $this->data['Actions']['SecurityAccess'];
        
        $inflect = new Inflector();
            
        foreach ( $securityAccess as $name_pair_key => $access_selection ) {
            
            $name_pair = explode( "__", $name_pair_key );
            
            $controller = $inflect->singularize( $name_pair[0] );
            $action = $name_pair[1]; 
                       
            if ( $access_selection == 'delete' ) {
            
                $aco = new Aco();                        
                
                $aco_record = $aco->find( array(
                                    "Aco.model" => $controller,
                                    "Aco.alias" => $action ) );
                                  
                if ( !empty( $aco_record ) ) {
                
                    $delete_id = $aco_record['Aco']['id'];                         
                    $this->Action->Aco->Delete( $delete_id );
                }  
            }
            elseif ( $access_selection == 'include' ) {
            
                $parent_id = '0';
            
                // Find the parent, if no parent, we create one
                $aco_parent = new Aco();
                $aco_parent_record = $aco_parent->find(
                                    array(  "Aco.model" => $controller,
                                            "Aco.alias" => $name_pair[0] ) );
            
                if ( empty( $aco_parent_record ) ) {
                    
                    $aco_parent = new Aco();
                    
                    $aco_parent->create();
                    $aco_parent->save( array(   'model' => $controller,
                                                'foreign_key' => '',
                                                'alias' => $name_pair[0],
                                			    'parent_id'		=> ''                            			    
                                                ) );  
                                    
                    $parent_id = $aco_parent->id;                                                                   
                }     
                else {
                
                    $parent_id =  $aco_parent_record['Aco']['id'];  
                }                                 
            
                // now lets create the aco record itself
                $aco = new Aco();
                
                $aco->create();                        
                $aco->save( array(  'model' => $controller,
                                    'foreign_key' => '',
                                    'alias' => $action,
                    			    'parent_id'		=> $parent_id                            			    
                                    ) );                                        
            }
        }
	}
	
	function __listActions() {
	
        // get all the actions in the controllers
      
        $actions = array();
        
        App::import( 'File', 'Folder' );
        
        $folder = new Folder( APP.'controllers/' );
        $folders = $folder->find();

        foreach( $folders as $file  ) {

            if ( is_file( APP.'controllers/'.$file ) ) {
                                        
                $file = new File( APP.'controllers/'.$file );
                $file_contents = $file->read();
                $file->close();
    
                // get the controller name
                $class_pattern = '/class [a-zA-Z0-9]*Controller extends AppController/';
                preg_match($class_pattern, $file_contents, $matches);
                $class_name_1 = str_replace( 'class ', '', $matches[0] );
                $class_name = str_replace(
                            'Controller extends AppController',
                            '', $class_name_1 );
                
                // get the action names
                $pattern = '/function [a-zA-Z0-9]*\(/';
                preg_match_all($pattern, $file_contents, $matches);
                
                // now gather action details together                      
                $action_group = array();
                
                $inflect = new Inflector();
                $class_name_sing = $inflect->singularize( $class_name );
                
                $action_group[ 'name' ] = $class_name;
                $action_group[ 'name_singular' ] = $class_name_sing;
                $action_group[ 'actions' ] = $matches[0];
                
                $actions[] = $action_group;
            }
        }

        $this->set( 'actions', $actions );
        
        // Get the full list of Aco records
        $aco = new Aco();
        
        $aco_list = $aco->find('all');
        
        $result = array();
        
        $inflect = new Inflector();
        
        foreach ( $aco_list as $current_aco ) {
        
            $key_0 = $current_aco['Aco']['model'];
            $key_1 = $current_aco['Aco']['alias'];
        
            $result[ $key_0.'__'.$key_1 ] = $current_aco;
        }
        
        $this->set( 'aco_list', $result );
	}
}
?>