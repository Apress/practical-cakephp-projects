<?php echo $form->create('Post'); ?>
	<?php 	
		if(isset($blog_id)) { 		
        echo $form->hidden( 'blog/$blog_id', array( 'value' => @$blog_id ));
	}
?>
	<br />	
     <?php echo $form->input('title'); ?><br />	
     <?php echo $form->error('title') ?><br />
	 <b>Message:</b>		
      <?php echo $form->textarea('content', array('cols'=>'60', 'rows'=>'10') );?><br />
      <?php echo $form->error('content') ?>	<br />					    		    		
	<?php echo $form->end('Submit'); ?>
    <br/>
</form>
