<?php
class Post extends AppModel {
	var $name = 'Post';
	var $hasMany = array('Comment');

	var $validate = array(
		'title'=>array(
			'alphaNumeric'=>array(
			'rule'=>'alphaNumeric',
			'required'=>true,
			'message'=>'Enter a title for this post',
			)
		),
		'content'=>array(
			'alphaNumeric'=>array(
			'rule'=>'alphaNumeric',
			'required'=>true,
			'message'=>'Enter some content for your post',
			)
		)
	);	
}	
?>