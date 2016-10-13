<div class="products index">
<h2><?php __('Products');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table id="product_listing" border="1" cellspacing="1">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('title');?></th>
	<th><?php echo $paginator->sort('product_field_group_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($products as $product):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $product['Product']['id']; ?>
		</td>
		<td>
			<?php echo $product['Product']['title']; ?>
		</td>
		<td>
			<?php echo $html->link($product['ProductFieldGroup']['title'], array('controller'=> 'product_field_groups', 'action'=>'view', $product['ProductFieldGroup']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $product['Product']['id'])); ?>
			<?php echo $html->link( __('Add Data', true), '/Products/addData/productId:'.$product['Product']['id'].'/productFieldGroupId:'.$product['Product']['product_field_group_id'] ); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $product['Product']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $product['Product']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>

