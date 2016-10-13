<?php
	
    function rss_transform($item) {
		return array('title' => $item['Post']['title'],
			'link' => array('controller' => 'posts', 'action' => 'view', 'ext' => 'rss', $item['Post']['id']),
			'guid' => array('controller' => 'posts', 'action' => 'view', 'ext' => 'rss', $item['Post']['id']),
			'description' => strip_tags($item['Post']['content']),
			'pubDate' => $item['Post']['created'],				
			);
	}
	
	$this->set('items', $rss->items($posts, 'rss_transform'));
?>