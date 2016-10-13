<div class="stories form">
<?php echo $form->create('Story');?>
	<fieldset>
 		<legend><?php __('Edit Story');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('title');
		echo $form->input('body');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Story.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Story.id'))); ?></li>
		<li><?php echo $html->link(__('List Stories', true), array('action'=>'index'));?></li>
	</ul>
</div>
