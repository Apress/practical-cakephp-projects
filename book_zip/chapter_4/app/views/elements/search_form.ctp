
<style>
.search_form {
    display: inline;
}
</style>

<?php
    echo $javascript->link( 'elements/search_form' );
?>

<?php
    echo $ajax->form(   null,
                        'post',
                        array(  'update' => 'main_content_container',
                                'url' => '/MfSearchProcess/index', 
                                'indicator' => 'loading',
                                'condition' => 'checkSearchTerm()',
                                'class' => 'search_form'
                                )
                        );                      
?>                       

<?php
    echo $form->input( 'MfSearchProcess.search_term', array( 'div' => false, 'label' => 'Search: ', 'size' => '20', 'maxlength' => '20', 'error' => false ) );
?>
    
<?php echo $form->end( array( 'label' => ' Search ', 'div' => false ) );?>


