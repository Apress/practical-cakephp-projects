<?php
class YourTablesController extends AppController {

	var $name = 'YourTables';
	var $helpers = array('Html','Form','MagicFieldsPlus');
	
	/*
	* The following methods was baked
	*/	

	function index() {
		$this->YourTable->recursive = 0;
		$this->set('yourTables', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid YourTable.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('yourTable', $this->YourTable->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->YourTable->create();
			if ($this->YourTable->save($this->data)) {
				$this->Session->setFlash(__('The YourTable has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The YourTable could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
	   
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid YourTable', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->YourTable->save($this->data)) {
				$this->Session->setFlash(__('The YourTable has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The YourTable could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->YourTable->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for YourTable', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->YourTable->del($id)) {
			$this->Session->setFlash(__('YourTable deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>