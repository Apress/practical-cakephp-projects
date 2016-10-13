<?php echo $form->create('/blog/save_' . $action . '/'); ?>
	<?php 	
		if(isset($blog_id)) { 		
        echo $form->hidden( 'blog/$blog_id', array( 'value' => @$blog_id ));
	}
?>
	<br />
    <b>Title:</b><br/>	
     <?php echo $form->input('blog/subject', array( 'maxlength' => 50, 'size' => 50, 'value' => @$blog['subject'] )); ?><br />	
     <?php echo $form->error('Blog/subject', 'Please enter in a subject.') ?><br />		
    <b>Message:</b><br/>
      <?php echo $form->textarea('blog/message',  array('cols'=>'60', 'rows'=>'10', 'value'=>@$blog['message']) );?><br />
      <?php echo $form->error('Blog/message', 'Please enter in a message.') ?>	<br />					    		    	
    <b>Enabled:</b><br/>	            	    
      <?php   
          $options = $enabled;
          $selected = @$blog['enabled'];
		  echo $form->selectTag( 'blog/enabled', $options, $selected );
     ?>	
	<?php echo $form->end(); ?>
    <br/>
</form>
