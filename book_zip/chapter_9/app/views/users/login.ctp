<div class="form">

    <form action="<?php echo $html->url('/Users/login/'); ?>" method="post">
    
    <fieldset>
    	<legend><?php __('Login');?></legend>
    	<?php
    		echo $form->input('User.username');
    		echo $form->input('User.password');
    		echo $form->end('Submit');
    	?>
    </fieldset>
    
</div>
