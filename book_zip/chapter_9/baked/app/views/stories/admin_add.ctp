<div class="stories form">
<?php echo $form->create('Story');?>
	<fieldset>
 		<legend><?php __('Add Story');?></legend>
	<?php
		echo $form->input('title');
		echo $form->input('body');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Stories', true), array('action'=>'index'));?></li>
	</ul>
</div>
