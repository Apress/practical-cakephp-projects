<div class="yourTables form">

<?php
    echo $magicFieldsPlus->errors( $this );
?>
<?php echo $form->create('YourTable');?>

<?php
    echo $form->hidden( 'YourTable.m_lock' );
?>

	<fieldset>
 		<legend><?php __('Edit YourTable');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('title');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('YourTable.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('YourTable.id'))); ?></li>
		<li><?php echo $html->link(__('List YourTables', true), array('action'=>'index'));?></li>
	</ul>
</div>
