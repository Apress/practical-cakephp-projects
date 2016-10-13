<div class="form">

    <? if ( $session->check( 'Message.auth' ) ) $session->flash( 'auth' ); ?>
    
    <?= $form->create( 'User', array( 'action' => 'login' ) ); ?>
    
    <fieldset>
    	<legend><?php __('Login');?></legend>
    	<?php
    		echo $form->input('User.username');
    		echo $form->input('User.password');
    		echo $form->end('Submit');
    	?>
    </fieldset>
    
</div>
