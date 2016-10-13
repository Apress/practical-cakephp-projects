<?php
class User extends AppModel {

	var $name = 'User';
	
	var $actsAs = array('Acl'=>'requester');

	var $belongsTo = array(
			'Group' => array('className' => 'Group',
								'foreignKey' => 'group_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);
	
	var $validate = array( 'password' => VALID_NOT_EMPTY );

  	function afterSave($created) {

  		if($created) {
  		
  		    // its a creation

			$id = $this->getLastInsertID();

			$aro = new Aro();

			$aro->updateAll( array('alias'=>'\'User:'.$id.'\''),
                                array(  'Aro.model'=>'User',
                                        'Aro.foreign_key'=>$id)
			                     );
		}
		else {
		
            // its an edit, we have to update the tree
            $data = $this->read();
            $parent_id = $data['User']['group_id'];

            $aro = new Aro();
            
            $aro_record = $aro->findByAlias( $this->name.':'.$this->id );
            $parent_record = $aro->findByAlias( 'Group:'.$parent_id );
                          
            if ( !empty( $aro_record ) ) {
            
                $parent_id = '0';
                
                if ( !empty( $parent_record ) ) {
                    $parent_id = $parent_record['Aro']['id'];
                }
                
                // just changing parents
                $this->Aro->save( array(
                    'parent_id'		=> $parent_id,
    				'id'			=> $aro_record['Aro']['id']
    			) );
            }    			
        }
		
		return true;
	}
	
	function parentNode(){
    
        // This should be the alias of the parent $model::$id
        $data = $this->read();

        // This needs to be unique    
        return 'Group:'.$data['User']['group_id'];
    }

}
?>