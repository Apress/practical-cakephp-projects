<?php
    if ( $session->check( 'Message.flash'  ) ) {
        echo '<div class="hilight">';
        $session->flash();
        echo '</div>';
    }
?>

<!-- TinyMCE -->
<?php
    echo $javascript->link( 'jscripts/tiny_mce/tiny_mce' );
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

<style>

fieldset {
  padding: 1em;
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

<script>
    
    function updateForm(request,json) {
        
        var msg_render = '';
        var result = json['result'];
        var message = json['message'];
        var errors = json['errors'];
        
        $('page_message').innerHTML = '<div class="hilight">'+message+'</div>';
        
        $$('.submit input')[0].disabled = false;
        
        // remove all previous error messages
        var current_errors = $$('.error-message');
        
        for( var i=0; i<current_errors.length; i++ ) {
        	var error_tag = current_errors[i];
        	error_tag.parentNode.removeChild(error_tag);
        }
                      
        // if there are error messages, update these
        if ( errors != '' ) {
        
            for( var field_id in errors ){
            
                // The error message in a div        
                var div_error = document.createElement( "div" );
                div_error.className = "error-message";
                div_error.innerHTML = errors[field_id];
                
                form_ele = $('post'+field_id);
                parent_form_ele = form_ele.parentNode;
                
                parent_form_ele.insertBefore( div_error, form_ele.previousSibling );
            }
        }
        
        // if it was successful, then we clear the form
        if ( result == 1 ) {
            $('post_form').innerHTML = '';
        }
    }
    
    function beforePost() {
    
        tinyMCE.triggerSave();
    
        $('page_message').innerHTML = '<div class="hilight">Posting, please wait ... <img src="/cake/__chapters__/message_forum/img/ajax-loader.gif" alt="" /></div>';
    
        $$('.submit input')[0].disabled = true;
    }
    
</script>

<div id="page_message"></div>

<div id="post_form">

<?php
    echo $ajax->form(   null,
                        'post',
                        array(  'url' => '/MfPostProcess/index', 
                                'complete' => 'updateForm(request,json);',
                                'before' => 'beforePost();'
                                )
                        );                      
?>

<fieldset>
	<legend> <?php __('Add a Message!');?> </legend>
	Please fill in all fields. Remember, spam and be damned!
	<?php
        echo $form->error( 'Post.email' );	   
        echo $form->input( 'Post.email', array( 'id' => 'postemail', 'label' => 'Email:', 'size' => '50', 'maxlength' => '255', 'error' => false ) );
        
        echo $form->error( 'Post.subject' );	  
		echo $form->input( 'Post.subject', array( 'id' => 'postsubject', 'label' => 'Subject:', 'size' => '50', 'maxlength' => '255', 'error' => false ) );
		
		echo $form->error( 'Post.message' );	  
        echo $form->input( 'Post.message', array( 'id' => 'postmessage', 'type'=>'textarea', 'label' => 'Message:', 'rows' => '20', 'error' => false ) ); 
        
        echo $form->hidden( 'Post.reply_to' );
        echo $form->hidden( 'Post.thread_id' );
	?>
</fieldset>
	
<?php echo $form->end( array( 'label' => ' Submit Message ' ) );?>

</div>
