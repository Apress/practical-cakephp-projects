function getMessage(message_id,thread_id) {

    var full_message = $('message_'+message_id).getAttribute( 'full_message' );
    
    if ( full_message != '' ) {
        $('message_'+message_id).innerHTML = full_message;
        return false;
    }

    new Ajax.Request(   '/cake/__chapters__/message_forum/MfFetchMessage/index/messageId:'+message_id+'/.json',
                        {   asynchronous:true, 
                            evalScripts:true, 
                            onComplete: function(response,json){
                                
                                if ( json[ 'result' ] == '1' ) {
                                    $('message_'+message_id).innerHTML = json[ 'data' ][ 'Message' ][ 'message' ] + ' <div><a href="javascript: void(0);" onclick="closeMessage(\''+message_id+'\');">Close</a> | <a href="/cake/__chapters__/message_forum/MfFetchMessages/index/threadId:'+thread_id+'/">List Messages</a> | <a href="/cake/__chapters__/message_forum/MfMessageForm/index/reply_to:'+message_id+'/thread_id:'+thread_id+'/">Reply</a></div>';
                                    $('message_'+message_id).setAttribute( 'full_message', $('message_'+message_id).innerHTML );
                                    $('loading_'+message_id).innerHTML = '';
                                }
                            },
                            onLoading: function() {
                            
                                $('message_'+message_id).setAttribute( 'short_message', $('message_'+message_id).innerHTML );
                                $('loading_'+message_id).innerHTML = '<img src="/cake/__chapters__/message_forum/img/ajax-loader.gif" alt="" /> loading, please wait.';
                            }
                            } );
}    

function closeMessage(message_id) {
    
    var short_message = $('message_'+message_id).getAttribute( 'short_message' );
    $('message_'+message_id).innerHTML = short_message;
}