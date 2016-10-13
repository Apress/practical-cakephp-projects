<div class="form">

    <?php echo $form->create('Story');?>
    
	<fieldset>
        
        <legend><?php __('Edit Story');?></legend>
        
    	<?php
    		echo $form->input('id');
    		echo $form->input('title');
    		echo $form->input('body');
    		echo $form->end('Submit');
    	?>
    	
	</fieldset>

</div>
