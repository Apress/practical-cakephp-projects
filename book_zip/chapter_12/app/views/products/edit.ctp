<div class="products form">
<?php echo $form->create('Product');?>
	<fieldset>
 		<legend><?php __('Edit Product');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('title');
		echo $form->input('product_field_group_id');
		echo $form->input('ProductGroup');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Product.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Product.id'))); ?></li>
		<li><?php echo $html->link(__('List Products', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Product Field Groups', true), array('controller'=> 'product_field_groups', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Product Field Group', true), array('controller'=> 'product_field_groups', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Product Field Values', true), array('controller'=> 'product_field_values', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Product Field Value', true), array('controller'=> 'product_field_values', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Product Groups', true), array('controller'=> 'product_groups', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Product Group', true), array('controller'=> 'product_groups', 'action'=>'add')); ?> </li>
	</ul>
</div>
