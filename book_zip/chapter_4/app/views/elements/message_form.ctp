<?php
    if ( $session->check( 'Message.flash'  ) ) {
        echo '<div class="hilight">';
        $session->flash();
        echo '</div>';
    }
?>

<!-- TinyMCE -->
<?php
    echo $javascript->link( 'jscripts/tinymce/jscripts/tiny_mce/tiny_mce' );
?>
<script type="text/javascript">
    tinyMCE.init({
    	mode : "textareas",
    	theme : "advanced",
    	theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright, justifyfull,bullist,numlist,undo,redo,link,unlink",
    	theme_advanced_buttons2 : "",
    	theme_advanced_buttons3 : "",
    	theme_advanced_toolbar_location : "top",
    	theme_advanced_toolbar_align : "left",
    	theme_advanced_statusbar_location : "bottom",
    	extended_valid_elements : "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
    	content_css : "/cake/__chapters__/message_forum/css/global.css"

    });
</script>
<!-- /TinyMCE -->

<?php
    echo $javascript->link( 'elements/message_form' );
?>

<div id="page_message"></div>

<div id="message_form">

<?php
    echo $ajax->form(   null,
                        'post',
                        array(  'url' => '/MfMessageProcess/index', 
                                'complete' => 'updateForm(request,json);',
                                'before' => 'beforeMessage();'
                                )
                        );                      
?>

<fieldset style="border:1px solid black; background-image:url( '/cake/__chapters__/message_forum/app/webroot/img/background.gif' );">
	<legend> <?php __('Add a Message!');?> </legend>
	Please fill in all fields. Remember, spam and be damned!
	<?php
        echo $form->error( 'Message.name' );	   
        echo $form->input( 'Message.name', array( 'id' => 'messagename', 'label' => 'Name:', 'size' => '50', 'maxlength' => '255', 'error' => false ) );
        	       
        echo $form->error( 'Message.email' );	   
        echo 'Your email will not be displayed.';
        echo $form->input( 'Message.email', array( 'id' => 'messageemail', 'label' => 'Email:', 'size' => '50', 'maxlength' => '255', 'error' => false ) );
        
        echo $form->error( 'Message.subject' );	  
		echo $form->input( 'Message.subject', array( 'id' => 'messagesubject', 'label' => 'Subject:', 'size' => '50', 'maxlength' => '255', 'error' => false ) );
		
		echo $form->error( 'Message.message' );	  
        echo $form->input( 'Message.message', array( 'id' => 'messagemessage', 'type'=>'textarea', 'label' => 'Message:', 'rows' => '20', 'error' => false ) ); 
        
        echo $form->hidden( 'Message.reply_to' );
        echo $form->hidden( 'Message.thread_id' );
	?>
</fieldset>
	
<?php echo $form->end( array( 'label' => ' Submit Message ' ) );?>

</div>
