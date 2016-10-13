<div class="products form">
<?php echo $form->create('Product');?>
	<fieldset>
 		<legend><?php __('Add Product');?></legend>
	<?php
		echo $form->input('title');
		echo $form->input('product_field_group_id');
		echo $form->input('ProductGroup');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
