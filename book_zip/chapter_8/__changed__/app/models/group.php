<?php
class Group extends AppModel {

	var $name = 'Group';
	
    var $actsAs = array('Acl'=>'requester');

	var $hasMany = array(
			'User' => array( 'className' => 'User',
    							'foreignKey' => 'group_id',
    							'dependent' => false,
    							'conditions' => '',
    							'fields' => '',
    							'order' => '',
    							'limit' => '',
    							'offset' => '',
    							'exclusive' => '',
    							'finderQuery' => '',
    							'counterQuery' => ''
			)
	);
	
	var $validate = array( 'title' => VALID_NOT_EMPTY );
	
  	function afterSave($created) {

  		if ( $created ) {
  		
  		    // its a creation

			$id = $this->getLastInsertID();

			$aro = new Aro();

            $aro->updateAll(    array('alias'=>'\'Group:'.$id.'\''),
                                array(  'Aro.model'=>'Group',
                                        'Aro.foreign_key'=>$id)
                                );
		}
		else {
		
            // its an edit, we have to update the tree
            $data = $this->read();
            $parent_id = $data['Group']['parent_id'];

            $aro = new Aro();
            
            $aro_record = $aro->findByForeignKey( $this->id );
            $parent_record = $aro->findByForeignKey( $parent_id );
                          
            if ( empty( $aro_record ) ) {
            
                // orphaned child
                $this->Aro->save( array(
                    'model' => $this->name,
                    'foreign_key' => $this->id,
                    'alias' => $this->name.':'.$this->id,
    			    'parent_id'		=> $parent_record['Aro']['id']
                ) );
            }
            else {
            
                // just moving nodes
                $this->Aro->save( array(
                    'model' => $this->name,
                    'foreign_key' => $this->id,
                    'alias' => $this->name.':'.$this->id,
    			    'parent_id'		=> $parent_record['Aro']['id'],
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
        return 'Group:'.$data['Group']['parent_id'];
    }
}
?>