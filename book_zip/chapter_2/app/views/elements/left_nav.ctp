<ul>
<li><a href="<?php echo $this->base; ?>">All Category</a></li>
<?php

foreach ($categories as $category) {
	extract($category);
	// now we have $cat_id, $cat_parent_id, $cat_name
	
	$level = ($cat_parent_id == 0) ? 1 : 2;

    $url   = $this->base. '/Ecommerce/index/cat_id:' . $cat_id;	

	// for second level categories we print extra spaces to give
	// indentation look
	if ($level == 2) {
		$cat_name = '&nbsp; &nbsp; &raquo;&nbsp;' . $cat_name;
	}
	
	// assign id="current" for the currently selected category
	// this will highlight the category name
	$listId = '';
	if ($cat_id == $catId) {
		$listId = ' id="current"';
	}
?>
<li<?php echo $listId; ?>><a href="<?php echo $url; ?>"><?php echo $cat_name; ?></a>
</li>
<?php
}
?>
</ul>