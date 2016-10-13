<script>

function checkSearchTerm() {

    if ( $( 'SearchSearchTerm' ).value == '' ) {
        alert( 'Please enter a search term.' );
        return false;
    }
    
    return true;
}

</script>

<?php
    echo $ajax->form(   null,
                        'post',
                        array(  'update' => 'update_container',
                                'url' => '/MfSearchProcess/index', 
                                'indicator' => 'loading',
                                'complete' => 'updateForm(request,json);',
                                'condition' => 'checkSearchTerm()'
                                )
                        );                      
?>                       

<?php
    echo $form->error( 'Search.search_term' );	  
    echo $form->input( 'Search.search_term', array( 'div' => false, 'label' => 'Search: ', 'size' => '30', 'maxlength' => '20', 'error' => false ) );
?>
    
<?php echo $form->end( array( 'label' => ' Search ', 'div' => false ) );?>

<div id="loading" style="display: none;">
    <?php echo $html->image('ajax-loader.gif'); ?>
</div>

<div id="update_container"></div>