
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
            
            form_ele = $('message'+field_id);
            parent_form_ele = form_ele.parentNode;
            
            parent_form_ele.insertBefore(   div_error,
                                            form_ele.previousSibling );
        }
    }
    
    // if it was successful, then we clear the form
    if ( result == 1 ) {
        $('message_form').innerHTML = '';
    }
}

function beforeMessage() {

    tinyMCE.triggerSave();

    $('page_message').innerHTML = '<div class="hilight">Posting, please wait ... <img src="/cake/__chapters__/message_forum/img/ajax-loader.gif" alt="" /></div>';

    $$('.submit input')[0].disabled = true;
}

