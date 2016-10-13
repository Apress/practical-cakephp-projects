Find stories which have not been translated to the language selected.

<div class="form">

    <form action="<?php echo $html->url('/admin/Stories/toTrans/'); ?>" method="get">
    
    <fieldset>
    	<legend><?php __('Translate Stories to Language');?></legend>
    	<?php
            // ISO 639-3 	       
    		echo 'Language: '.$form->select( '', array( 'deu' => 'German', 'jpn' => 'Japanese' ), $trans_lang, array( 'name' => 'language' ) );
    		echo $form->end( array( 'label' => 'Submit', 'div' => false ) );
    	?>
    </fieldset>
    
</div>

<?php

    if ( isset( $stories ) ) {
    
        if ( sizeof( $stories ) > 0 ) {
            echo $this->renderElement( 'admin_list_trans_stories' );
        }
        else {
            echo '<div class="hilight">No Stories to Translate</div>';
        }   
    }             
?>