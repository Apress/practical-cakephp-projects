<?php
class CategoriesController extends AppController {

    var $name = 'Categories';	
	var $uses = array('Category');		

	function getAll() {
		return $this->Category->getCategories();
	}	
	
	function menu() {
		// get all categories ordered by category name		
		$categories = $this->getAll();
		// format the categories for display	
		return $this->Category->buildCategories($categories, $this->passedArgs['c']);		
	}	
}
?>