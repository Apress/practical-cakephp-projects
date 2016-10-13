<?php

class MagicFieldsPlusBehavior extends ModelBehavior {

    var $magicFieldParams = array();

    // Assign values to the magic fields
	function setup( &$model, $config = array() ) {
        
        $this->magicFieldParams = am( $this->magicFieldParams, $config ); 
    }
    
    function afterFind(&$model, $results, $primary) {
        
        // m_lock, update m_lock field
        $this->m_lock_magic( $model, $results, $primary );
        
        // m_accessed_magic
        $this->m_accessed_magic( $model, $results, $primary );
                
        return $results;
    }
    
    function beforeFind( &$model, $query ) {
        // m_record_order
        return $this->m_record_order_magic( $model, $query );
    }
    
    function beforeValidate(&$model) {
        
        // first find the record
        if ( isset( $model->data[$model->name][ 'id' ] ) ) {
            
            $id = $model->data[$model->name][ 'id' ];
            $table = $model->table; 
            
            $currentRecord = $model->query( "select * from $table where id = '".$id."'" );
            
            if ( !empty( $currentRecord ) ) {
            
                
                if ( isset( $model->data[$model->name]['m_lock'] ) ) {
                
                    if ( $model->data[$model->name]['m_lock'] != $currentRecord[0][ $table ][ 'm_lock' ] ) {
                        
                        $model->validationErrors[ 'm_lock' ] = 'Update conflict, another user has already updated the record. Please list and edit the record again.';
                        
                        return false; 
                    }
                }
            }
        }
        
        return true; 
    }
    
    /*
    * Start of magic fields
    */ 
    
    function m_accessed_magic( &$model, $results, $primary ) {
    
        if ( $model->hasField( 'm_accessed' ) ) {
    
            foreach( $results as $record ) {
                
                $record[ $model->name ][ 'm_accessed' ] = $record[ $model->name ][ 'm_accessed' ]+1;
                $model->save( $record );
            }
        }
    }   
    
    function m_record_order_magic( &$model, $query ) {
    
        if ( $model->hasField( 'm_record_order' ) ) {
        
            $direction = 'DESC';
            
            if ( isset( $this->magicFieldParams[ 'm_record_order' ][ 'direction' ] ) ) {
                
                $direction = $this->magicFieldParams[ 'm_record_order' ][ 'direction' ];
            }
        
            $query[ 'order' ] = 'm_record_order '.$direction;
        }
        
        return $query;
    }
    
    function m_lock_magic( &$model, &$results, $primary ) {
          
        if ( $model->hasField( 'm_lock' ) ) { 
        
            if ( sizeof( $results ) == 1 ) {
                
                $uuid = String::uuid();
                
                // results that we will present to the user
                $results[0][ $model->name ][ 'm_lock' ] = $uuid;
            }
        
            $tableName = $model->table;
            $id = $model->id;
                
            $model->query( "update $tableName set m_lock = '".$uuid."' where id = '".$id."'" );
            
            // the current model data, maybe used in form
            $model->data[$model->name][ 'm_lock' ] = $uuid;
        } 
    }

}
?>