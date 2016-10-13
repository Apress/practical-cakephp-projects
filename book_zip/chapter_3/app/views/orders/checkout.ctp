<?php 
?><fieldset>
	<legend> <?php echo $this->pageTitle = __('<strong>Checkout</strong>', true); ?> </legend>
	<?php 
		echo $form->create('Order', array('url'=>'/orders/confirm/') );			
        echo $form->error( 'Order.name' );	  
		echo $form->input( 'Order.name', array( 'id' => 'ordername', 'label' => 'Name:', 'size' => '30', 'maxlength' => '255', 'error' => false ) );
		
		echo $form->error( 'Order.address' );	  
        echo $form->input( 'Order.address', array( 'id' => 'orderaddress', 'type'=>'textarea', 'label' => 'Address:', 'rows' => '3', 'error' => false ) ); 
				
		echo $form->error( 'Order.comment' );	  
        echo $form->input( 'Order.comment', array( 'id' => 'ordercomment', 'type'=>'textarea', 'label' => 'Comment:', 'rows' => '5', 'error' => false ) ); 
		
        echo $form->error( 'Order.payment' );	  
		echo $form->input( 'Order.payment', array('type'=>'radio', 'options'=>array(1=>'Google', 2=>'Paypal')));
		
		echo $form->input( 'cts', array('type'=>'hidden', 'value'=>$data) );		
		
		echo $form->end( array( 'label' => ' Confirm Order ' ) );		
	?>
</fieldset>


<br />
<?php 	echo $this->element('checkout');
?>
