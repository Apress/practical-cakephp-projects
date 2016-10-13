<?php
class ProductsController extends AppController {

	var $name = 'Products';
	var $helpers = array( 'Html', 'Form');
	
	var $uses = array( 'Product', 'ProductSearch', 'ProductGroup',
                        'ProductFieldValue', 'ProductField',
                        'FieldTypeValues' );
	
	function search() {
	
        if ( isset( $this->params['form']['product_group_id'] ) ) {
        
            $searchResult = $this->Product->doSearch( $this->params['form'] );
            
            $this->set( 'search_results', $searchResult ); 
        }	   
	
        $this->_listProductSearch();
    }
    
    function _listProductSearch() {
	
        // At the moment, this is hard coded to a default value of 1
        // but you may want to change this to your product group id           	
        $productGroupId = '1';
        
        if ( isset( $this->passedArgs[ 'productGroupId' ] ) ) {
            $productGroupId = $this->passedArgs[ 'productGroupId' ];
        }	   
	
        // get the end node group
        $productGroup = $this->ProductGroup->findById( $productGroupId ); 
                                                    
        $this->set( 'product_group', $productGroup );                                              
                 
        $this->set( 'product_fields',
                    $this->ProductField->searchFilters( $productGroup ) );
    }
	
	function addData() {
	
        if (!empty($this->data)) {

            $fieldData = $this->data[ 'Product' ]['data_fields'];   
            
            foreach( $fieldData as $fieldVal ) { 
            
                if ( is_array( $fieldVal ) ) {
                    list( $key, $value ) = each( $fieldVal );
                    
                    $fieldData2Split = explode( ",", $key );
                    $product_field_id = $fieldData2Split[0];
                    $field_type_value_id = $fieldData2Split[1];
                }
                else {
                    $fieldData2Split = explode( ",", $fieldVal );
                    $product_field_id = $fieldData2Split[0];
                    $field_type_value_id = $fieldData2Split[1];
                    $value = $this->getFieldTypeValue( $field_type_value_id );
                }
        
                $data = array();
                $data[ 'ProductFieldValue' ][ 'product_field_id' ] = $product_field_id;
                $data[ 'ProductFieldValue' ][ 'value' ] = $value;
                $data[ 'ProductFieldValue' ][ 'field_type_value_id' ] = $field_type_value_id;
                $data[ 'ProductFieldValue' ][ 'product_id' ] = $this->data[ 'Product' ]['product_id'];
            
                $this->ProductFieldValue->create( $data );
                $this->ProductFieldValue->save();
            }            
        }
        	   
        if ( isset( $this->passedArgs[ 'productFieldGroupId' ] ) ) {
        
            $productFieldGroupId = $this->passedArgs[ 'productFieldGroupId' ];
            
            // Lets find all the data fields
            $productFields = $this->ProductField->findAllByProductFieldGroupId( $productFieldGroupId );

            // Next we need the values relating to the data fields
            foreach( $productFields as &$field ) {
            
                $fieldTypeGroupId = $field[ 'FieldTypeGroup' ][ 'id' ];
                
                $fieldTypeValues = $this->FieldTypeValues->findAllByFieldTypeGroupId( $fieldTypeGroupId );
                
                $field[ 'FieldTypeValues' ] = $fieldTypeValues; 
            }
            
            $this->set( 'field_type_values', $productFields );
        }  
        
        $productId = '';
        if ( isset( $this->passedArgs[ 'productId' ] ) ) {
            $productId = $this->passedArgs[ 'productId' ];
        }
        
        $this->set( 'product_id', $productId );
        
    }
    
    function getFieldTypeValue( $field_type_value_id ) {
    
        $result = '';
    
        $fieldTypeValues = $this->FieldTypeValues->findById( $field_type_value_id );
        
        if ( !empty( $fieldTypeValues ) ) {
        
            if ( isset( $fieldTypeValues[ "FieldTypeValues" ][ "title" ] ) ) {
                $result = $fieldTypeValues[ "FieldTypeValues" ][ "title" ];                
            }
        }
        
        return $result;
    }
	
	/* The following are baked */

	function index() {
		$this->Product->recursive = 0;
		$this->set('products', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Product.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('product', $this->Product->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Product->create();
			if ($this->Product->save($this->data)) {
				$this->Session->setFlash(__('The Product has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Product could not be saved.
                                            Please, try again.', true));
			}
		}
		$productGroups = $this->Product->ProductGroup->find('list');
		$productFieldGroups = $this->Product->ProductFieldGroup->find('list');
		$this->set(compact('productGroups', 'productFieldGroups'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Product', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Product->save($this->data)) {
				$this->Session->setFlash(__('The Product has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Product could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Product->read(null, $id);
		}
		$productGroups = $this->Product->ProductGroup->find('list');
		$productFieldGroups = $this->Product->ProductFieldGroup->find('list');
		$this->set(compact('productGroups','productFieldGroups'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Product', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Product->del($id)) {
			$this->Session->setFlash(__('Product deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>