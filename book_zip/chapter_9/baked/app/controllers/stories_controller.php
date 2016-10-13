<?php
class StoriesController extends AppController {

	var $name = 'Stories';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Story->recursive = 0;
		$this->set('stories', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(    __('Invalid Story', true),
                            array('action'=>'index'));
		}
		$this->set('story', $this->Story->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Story->create();
			if ($this->Story->save($this->data)) {
				$this->flash(   __('Story saved.', true),
                                array('action'=>'index'));
			} else {
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(    __('Invalid Story', true),
                            array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Story->save($this->data)) {
				$this->flash(   __('The Story has been saved.', true),
                                array('action'=>'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Story->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Story', true),
                        array('action'=>'index'));
		}
		if ($this->Story->del($id)) {
			$this->flash(__('Story deleted', true),
                        array('action'=>'index'));
		}
	}


	function admin_index() {
		$this->Story->recursive = 0;
		$this->set('stories', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Story', true),
                        array('action'=>'index'));
		}
		$this->set('story', $this->Story->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Story->create();
			if ($this->Story->save($this->data)) {
				$this->flash(__('Story saved.', true),
                            array('action'=>'index'));
			} else {
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Story', true),
                        array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Story->save($this->data)) {
				$this->flash(__('The Story has been saved.', true),
                            array('action'=>'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Story->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Story', true),
                        array('action'=>'index'));
		}
		if ($this->Story->del($id)) {
			$this->flash(__('Story deleted', true),
                        array('action'=>'index'));
		}
	}

}
?>