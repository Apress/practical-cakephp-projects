<div class="products view">
<h2><?php  __('Product');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Product Field Group'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($product['ProductFieldGroup']['title'], array('controller'=> 'product_field_groups', 'action'=>'view', $product['ProductFieldGroup']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Product', true), array('action'=>'edit', $product['Product']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Product', true), array('action'=>'delete', $product['Product']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $product['Product']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Products', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Product', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Product Field Groups', true), array('controller'=> 'product_field_groups', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Product Field Group', true), array('controller'=> 'product_field_groups', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Product Field Values', true), array('controller'=> 'product_field_values', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Product Field Value', true), array('controller'=> 'product_field_values', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Product Groups', true), array('controller'=> 'product_groups', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Product Group', true), array('controller'=> 'product_groups', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Product Field Values');?></h3>
	<?php if (!empty($product['ProductFieldValue'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Product Field Id'); ?></th>
		<th><?php __('Value'); ?></th>
		<th><?php __('Field Type Value Id'); ?></th>
		<th><?php __('Product Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($product['ProductFieldValue'] as $productFieldValue):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $productFieldValue['id'];?></td>
			<td><?php echo $productFieldValue['product_field_id'];?></td>
			<td><?php echo $productFieldValue['value'];?></td>
			<td><?php echo $productFieldValue['field_type_value_id'];?></td>
			<td><?php echo $productFieldValue['product_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'product_field_values', 'action'=>'view', $productFieldValue['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'product_field_values', 'action'=>'edit', $productFieldValue['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'product_field_values', 'action'=>'delete', $productFieldValue['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $productFieldValue['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Product Field Value', true), array('controller'=> 'product_field_values', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Product Groups');?></h3>
	<?php if (!empty($product['ProductGroup'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Product Group Id'); ?></th>
		<th><?php __('Product Field Group Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($product['ProductGroup'] as $productGroup):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $productGroup['id'];?></td>
			<td><?php echo $productGroup['title'];?></td>
			<td><?php echo $productGroup['description'];?></td>
			<td><?php echo $productGroup['product_group_id'];?></td>
			<td><?php echo $productGroup['product_field_group_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'product_groups', 'action'=>'view', $productGroup['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'product_groups', 'action'=>'edit', $productGroup['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'product_groups', 'action'=>'delete', $productGroup['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $productGroup['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Product Group', true), array('controller'=> 'product_groups', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
