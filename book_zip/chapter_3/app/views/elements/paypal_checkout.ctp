<?php
	echo $form->create('Order', array('url'=>'https://www.paypal.com/cgi-bin/webscr','id'=>'payPalForm') );
	echo $form->hidden("item_number", array( 'value'=>"The Music Club"));
	echo $form->hidden("cmd", array( 'value'=>"_xclick"));	
	echo $form->hidden("no_note", array( 'value'=>"1"));
	echo $form->hidden("business", array( 'value'=>"sales@practicalcakephp.com"));
	echo $form->hidden("currency_code", array( 'value'=>"USD"));
	echo $form->hidden("return", array( 'value'=>"http://practicalcakephp.com"));
	$i = 0;	
	foreach($carts AS $cart) {
	$x = $i+1;
	echo $form->hidden("item_number", array( 'value'=>"The Music Club"));
	echo $form->hidden("item_description_$x", array( 'value'=>$cart['Product']['description']));
	echo $form->hidden("item_quantity_$x", array( 'value'=>$cart['Cart']['qty']));
	echo $form->hidden("item_price_$x", array( 'value'=>$cart['Product']['price']));
	}
	echo $form->end( array( 'label' => ' Submit ' ) );
?>