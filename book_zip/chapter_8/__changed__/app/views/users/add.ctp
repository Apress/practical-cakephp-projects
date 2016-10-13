<div class="users form">

<?php
    if ( $session->check('Message.flash')) {
        $session->flash();
    }
?>

<?php echo $form->create('User');?>
	<fieldset>
 		<legend><?php __('Add User');?></legend>
	<?php
		echo $form->input('username');
		echo $form->input('password');
		echo $form->input('group_id', array( 'empty' => true ));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
