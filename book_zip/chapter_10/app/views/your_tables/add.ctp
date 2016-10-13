<div class="yourTables form">
<?php echo $form->create('YourTable');?>
	<fieldset>
 		<legend><?php __('Add YourTable');?></legend>
	<?php
		echo $form->input('title');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List YourTables', true), array('action'=>'index'));?></li>
	</ul>
</div>
