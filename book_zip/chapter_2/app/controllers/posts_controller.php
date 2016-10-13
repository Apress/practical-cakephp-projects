<?php
class PostsController extends AppController
{	
	var $name = 'Posts';
	var $uses = array('Post', 'Comment');	

	function index() {
		$posts = $this->Post->find('all');	
		
	// Rss section
	$channelData = array('title' => 'Current posts | The blogger',
				'link' => array('controller' => 'posts', 'action' => 'index', 'ext' => 'rss'),
				'url' => array('controller' => 'posts', 'action' => 'index', 'ext' => 'rss'),
				'description' => 'The current posts in our blog',
				'language' => 'en-uk'
				);
	$posts = $this->Post->find('all', array('limit' => 10, 'order' => 'Post.created'));
	$comments = $this->Post->Comment->find('all',array('conditions'=>array('Post.id'=>1)));
	
	$this->set(compact('channelData', 'posts','comments'));	
	}

	function add() {
		$actionHeading = 'Add a Post!';				
		$actionSlogan = 'Please fill in all fields. Feel free to add your post and express your opinion.';
		$this->set(compact('actionHeading','actionSlogan'));
		if (!empty($this->data)) {
			$this->Post->create();
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('The Post has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Post could not be saved. Please try again.', true));
			}
		}
	}

	function enable($id=null) {
		$post = $this->Post->read(null,$id);
		if (!$id && empty($post)) {
			$this->Session->setFlash(__('You must provide a valid ID number to enable a post.',true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($post)) {
			$post['Post']['published'] = 1;
			if ($this->Post->save($post)) {
				$this->Session->setFlash(__('Post ID '.$id.' has been published.',true));
			} else {
				$this->Session->setFlash(__('Post ID '.$id.' was not saved.',true));
			}
			$this->redirect(array('action'=>'index'));
		} else {
			$this->Session->setFlash(__('No Post by that ID was found.',true));
			$this->redirect(array('action'=>'index'));
		}
	}

	function disable($id=null) {
		$post = $this->Post->read(null,$id);
		if (!$id && empty($post)) {
			$this->Session->setFlash(__('You must provide a valid ID number to disable a post.',true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($post)) {
			$post['Post']['published'] = 0;
			if ($this->Post->save($post)) {
				$this->Session->setFlash(__('Post ID '.$id.' has been disabled.',true));
			} else {
				$this->Session->setFlash(__('Post ID '.$id.' was not saved.',true));
			}
			$this->redirect(array('action'=>'index'));
		} else {
			$this->Session->setFlash(__('No Post by that ID was found.',true));
			$this->redirect(array('action'=>'index'));
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Post', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Post->del($id)) {
			$this->Session->setFlash(__('Post deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

	function edit($id = null) {
		$actionHeading = 'Edit a Post!';				
		$actionSlogan = 'Please fill in all fields. Now you can amend your post.';		
		$this->set(compact('actionHeading','actionSlogan'));
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Post', true));
			$this->redirect(array('action'=>'index'));
		}
	
		if (!empty($this->data)) {
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('The Post has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Post could not be saved. Please try again.', true));
			}
		}
	
		if (empty($this->data)) {
			$this->data = $this->Post->read(null, $id);
		}
	}

	function buildRssFeeds($id = null) {
		$posts = $this->Post->find('all', array('conditions'=>array('published'=> 1)));		
		$rssFeeds = $rss->item($posts);
		$this->set('rssFeeds', $rssFeeds);
	}



}
?>