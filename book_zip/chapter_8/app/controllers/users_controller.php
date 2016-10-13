<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form');
	
	function beforeFilter() {  
	
        // we need to temporarily allow access during the setup
        $this->Auth->allow( 'index', 'security',
                            'add', 'edit', 'delete');
    }	

	function login() {
        
    }
	
	function logout() {
	
        return $this->redirect( $this->Auth->logout() );		
	}
    
    function edit($id = null) {
	
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {

            // if no password is supplied, we don't change it		  
            if ( trim( $this->data['User']['password'] ) == Security::hash( '', null, true) ) {
                unset( $this->data['User']['password'] );
            }
		
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
                // $this->redirect(array('action'=>'index'));
            } else {
				$this->Session->setFlash(__('The User could not be saved.
                                            Please, try again.', true));
            }
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
			
			// we set the password to nothing
			// passwords are only changed if you enter something
			// since its one way only!
            $this->data['User']['password'] = '';
		}
		
		// for the parent group
        $groups = $this->User->Group->find('list');
        $this->set( 'groups', $groups );
	}
    
    function security($id) {
	
        if (!empty($this->data)) {
                    
            // lets get the Aro i.e. the group                    
            $aro_foreign_key = $this->data['User']['id'];
            
            $aro = new Aro();
            $aro_record = $aro->findByAlias( 'User:'.$aro_foreign_key );
            
            $aro_alias = $aro_record['Aro']['alias'];
            $aco_of_aro = $aro_record['Aco'];
            
            // lets run through the security selection
            $sec_access = $this->data['User']['SecurityAccess'];
            
            $aco = new Aco();
            $inflect = new Inflector();
            
            foreach ( $sec_access as $aco_id => $access_type ) {
                
                $aco_record = $aco->findById( $aco_id );
                
                $model_plural = $inflect->pluralize( $aco_record['Aco']['model'] );
                
                if ( $access_type == 'allow' ) {
                    $this->Acl->allow( $aro_alias, $model_plural.'/'.$aco_record[ 'Aco' ][ 'alias' ], '*');
                }
                elseif ( $access_type == 'deny' ) {
                    $this->Acl->deny( $aro_alias, $model_plural.'/'.$aco_record[ 'Aco' ][ 'alias' ], '*');
                }
            }
        }	   
	        
        // lets gather the aco selections available	       	        
        $aco = new Aco();
        
        // list the whole tree
        $aco_tree = $aco->generateTreeList();	
        
        // now get the details of the Aco records
        $aco_records = $aco->find('all');	
        
        $this->set( compact( 'aco_tree', 'aco_records' ) );
        
        $this->set( 'current_alias', $this->User->name.':'.$this->User->id );
        
        if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
    }
	
	// The following are baked

	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid User.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}
	
    function add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for User', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->User->del($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>