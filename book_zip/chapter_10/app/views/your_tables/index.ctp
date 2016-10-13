<div class="yourTables index">
<h2><?php __('YourTables');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('title');?></th>
	<th><?php echo $paginator->sort('m_lock');?></th>
	<th><?php echo $paginator->sort('m_record_order');?></th>
	<th><?php echo $paginator->sort('m_security');?></th>
	<th><?php echo $paginator->sort('m_display_record');?></th>
	<th><?php echo $paginator->sort('m_accessed');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($yourTables as $yourTable):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $yourTable['YourTable']['id']; ?>
		</td>
		<td>
			<?php echo $yourTable['YourTable']['title']; ?>
		</td>
		<td>
			<?php echo $yourTable['YourTable']['m_lock']; ?>
		</td>
		<td>
			<?php echo $yourTable['YourTable']['m_record_order']; ?>
		</td>
		<td>
			<?php echo $yourTable['YourTable']['m_security']; ?>
		</td>
		<td>
			<?php echo $yourTable['YourTable']['m_display_record']; ?>
		</td>
		<td>
			<?php echo $yourTable['YourTable']['m_accessed']; ?>
		</td>
		<td>
			<?php echo $yourTable['YourTable']['created']; ?>
		</td>
		<td>
			<?php echo $yourTable['YourTable']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $yourTable['YourTable']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $yourTable['YourTable']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $yourTable['YourTable']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $yourTable['YourTable']['id'])); ?>
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
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New YourTable', true), array('action'=>'add')); ?></li>
	</ul>
</div>
