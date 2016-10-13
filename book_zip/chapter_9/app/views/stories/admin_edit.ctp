<div class="form">

    <?php echo $form->create('Story');?>
    
	<fieldset>
        
        <legend>
            <?php
                if ( isset( $trans_lang_name ) ) {
                    echo 'Translating Story to '.$trans_lang_name;
                }
                else {
                    __('Edit Story');
                }
            ?>
        </legend>
        
    	<?php
    		echo $form->input('id');
    		echo $form->input('title');
    		echo $form->input('body');
    		echo $form->hidden('trans_lang');
    		echo $form->end('Submit');
    	?>
    	
	</fieldset>

</div>
