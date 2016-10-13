<?php
class Category extends AppModel
{
    // Mainly for PHP4 users
    var $name = 'Category';
	var $hasMany = array('Product');

	function getCategories($field='Category.id',$direction='ASC') {
		return $this->find('all',array('order'=>$field.' '.$direction));
	}
		
	/*
		Return the current category list which only shows
		the currently selected category and it's children.
		This function is made so it can also handle deep 
		category levels ( more than two levels )
	*/
	function buildCategories($categories, $parentId)
	{
		// $ChildCategories stores all children categories
		// of $parentId
		$ChildCategories = array();
		
		// expand only the categories with the same parent id
		// all other remain compact
		$ids = array();
		foreach ($categories as $category) {
			if ($category['Category']['parent_id'] == $parentId) {
				$ChildCategories[] = $category['Category'];
			}
			
			// save the ids for later use
			$ids[$category['Category']['id']] = $category['Category'];
		}	
	
		$HoldParentId = $parentId;
		
		// keep looping until we found the 
		// category where the parent id is 0
		while ($HoldParentId != 0) {
			$parent    = array($ids[$HoldParentId]);
			$currentId = $parent[0]['id'];
	
			// get all categories on the same level as the parent
			$HoldParentId = $ids[$HoldParentId]['parent_id'];
			foreach ($categories as $category) {
				// found one category on the same level as parent
				// put in $parent if it's not already in it
				if ($category['Category']['parent_id'] == $HoldParentId && !in_array($category['Category'], $parent)) {
					$parent[] = $category['Category'];
				}
			}
			
			// sort the category alphabetically
			array_multisort($parent);
		
			// merge parent and child
			$n = count($parent);
			$ChildCategories2 = array();
			for ($i = 0; $i < $n; $i++) {
				$ChildCategories2[] = $parent[$i];
				if ($parent[$i]['id'] == $currentId) {
					$ChildCategories2 = array_merge($ChildCategories2, $ChildCategories);
				}
			}
			$ChildCategories = $ChildCategories2;
		}
		return $ChildCategories;
	}
	
	/*
		Fetch all children categories of $id. 
		Used for display categories
	*/
	function getChildCategories($categories, $id, $recursive = true)
	{
		if ($categories == NULL) {
			$categories = $this->getCategories();
		}
		
		$n     = count($categories);
	
		$child = array();
		for ($i = 0; $i < $n; $i++) {
			$catId    = $categories[$i]['id'];
			$parentId = $categories[$i]['parent_id'];
			
			if ($parentId == $id) {
				$child[] = $catId;
				if ($recursive) {
					$child   = array_merge($child, $this->getChildCategories($categories, $catId));
				}	
			}
		}
		return $child;
	}
}
?>