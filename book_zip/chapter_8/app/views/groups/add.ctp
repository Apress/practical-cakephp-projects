<div class="groups form">

<?php
    if ( $session->check('Message.flash')) {
        $session->flash();
    }
?>

<?php echo $form->create('Group');?>
	<fieldset>
 		<legend><?php __('Add Group');?></legend>
	<?php
		echo $form->input('title');
		echo $form->input('parent_id', array( 'empty' => true ));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
