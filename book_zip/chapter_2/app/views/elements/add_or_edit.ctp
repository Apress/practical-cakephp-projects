<style>

fieldset {
  padding: 1em;
  width: 600px;
}

legend {
    font-size: 2em;
    padding-left: 0.5em;
    padding-right: 0.5em;
}

label {
  float:left;
  width: 6em;
  margin-right:0.5em;
  padding-top:0.2em;
  text-left:right;
  font-weight:bold;
}

.submit {
    padding: 0.5em;
    padding-left: 7.8em;
}

.submit input {
    
}

.input {
    padding: 0.3em;
}

</style>
<fieldset>
	<legend> <?php __("$actionHeading");?> </legend>
	<?=$actionSlogan;?>
	<?php 
		echo $form->create('Post');	
        echo $form->error( 'Post.title' );	  
		echo $form->input( 'Post.title', array( 'id' => 'posttitle', 'label' => 'Title:', 'size' => '50', 'maxlength' => '255', 'error' => false ) );
		
		echo $form->error( 'Post.content' );	  
        echo $form->input( 'Post.content', array( 'id' => 'postcontent', 'type'=>'textarea', 'label' => 'Content:', 'rows' => '10', 'error' => false ) ); 
		
		echo $form->end( array( 'label' => ' Submit Post ' ) );		
	?>
</fieldset>
