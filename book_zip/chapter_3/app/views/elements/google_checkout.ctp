<?php
	echo $form->create('Order', array('url'=>'https://checkout.google.com/api/checkout/v2/checkoutForm/Merchant/xxxxxxxxxxxxxxx', 'accept-charset'=>'utf-8') );
	$i = 0;	
	foreach($carts AS $cart) {
	$x = $i+1;
	echo $form->hidden("item_name_$x", array( 'value'=>$cart['Product']['name']));
	echo $form->hidden("item_description_$x", array( 'value'=>$cart['Product']['description']));
	echo $form->hidden("item_quantity_$x", array( 'value'=>$cart['Cart']['qty']));
	echo $form->hidden("item_price_$x", array( 'value'=>$cart['Product']['price']));
	
	echo $form->hidden("item_currency_$x", array( 'value'=>Configure::read('Item.currency')));
	echo $form->hidden("ship_method_name_$x", array( 'value'=>Configure::read('Order.shipmethod')));
	echo $form->hidden("ship_method_price_$x", array( 'value'=>Configure::read('Order.shipprice')));
	echo $form->hidden('tax_rate', array( 'value'=>Configure::read('Order.taxrate')));
	echo $form->hidden('tax_us_state', array( 'value'=>Configure::read('Order.taxstate')));
	}
	echo $form->hidden('_charset_');
	echo $html->image('http://checkout.google.com/buttons/checkout.gif?merchant_id=xxxxxxxxxxxxxxx&w=180&h=46&style=white&variant=text&loc=en_US',
	array('name'=>'Google Checkout', 'alt'=>'Fast checkout through Google', 'height'=>'46', 'width'=>'180'));
	echo $form->end( array( 'label' => ' Confirm Order ' ) );
?>