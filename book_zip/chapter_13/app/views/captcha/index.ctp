<fieldset>
	<legend> <?php __("$actionHeading");?> </legend>
	<?=$actionSlogan;?>
	<br />
	<?php 

	e("<pre><table><tr>");
	foreach($captcha as $key => $val) {
		e('<td style="font-size: 13px;">'.$val.'</td>');
	}
	e("</tr></table><pre>");
		echo $form->create('Captcha', array('url'=>'/captcha/check'));	
        echo $form->error( 'Captcha.text' );	  
        echo '<br /><h3>Please enter the text you see above</h3><br />';
		echo $form->input( 'Captcha.text', array( 'id' => 'text', 'label' => '', 'size' => '50', 'maxlength' => '255', 'error' => false ) );		
		echo $form->end( array( 'label' => ' Submit ' ) );		
	?>
</fieldset>

