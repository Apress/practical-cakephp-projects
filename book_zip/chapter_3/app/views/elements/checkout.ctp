<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
<?php     
	$cartContents = $this->requestAction("/carts/getMiniCart/c:$catId/p:$pdId/s:$sid");
        if ( !empty($cartContents) && is_array($cartContents) ) { 
		$subTotal = null;
		?>
  <tr class="entryTableHeader"> 
   <td colspan="2" align="center">Item</td>
   <td align="center">Unit Price</td>

   <td width="75" align="center">Quantity</td>
   <td align="center">Total</td>
  <td width="75" align="center">&nbsp;</td>
 </tr>
 		<?php 				
				foreach($cartContents as $cartContent) { 
					$subTotal += $cartContent['pd']['price'] * $cartContent['ct']['qty'];
	
	echo $form->create('Carts', array('url'=>'/carts/updates/') );
	?>

  <tr class="content"> 
  <td width="80" align="center"><?php  
      e( $html->link(
	      $html->image('/img/products/' . $cartContent['pd']['thumbnail'], array( 'border' => '0' )),
          array('action' => '/products/view/pd_id'),
          array('escape' => false))); ?>  
  </td>
  <td><? echo $html->link( $cartContent['pd']['name'], "/products/view/pd_id:".$cartContent['ct']['product_id'].'id:'.$cartContent['ct']['id']);?></td>
   <td align="right"><?=Configure::read('Shop.currency');?><?=$cartContent['pd']['price'];?></td>

  <td width="75">
  <?php echo $form->input('Cart.qty', array( 'name'=>'data['.$cartContent['ct']['id']. ']', 'type'=>'text', 'label'=>null, 'value'=>$cartContent['ct']['qty'] ) );?>
          
 <?=$form->hidden('Cart.id', array( 'value'=>$cartContent['ct']['id']));?>
 <br />
  <?=$form->hidden('Cart.id', array( 'value'=>$cartContent['ct']['product_id']));?>
  </td>
  <td align="right"><?=Configure::read('Shop.currency');?><?=$cartContent['pd']['price'] * $cartContent['ct']['qty'];?></td>
  <td width="75" align="center">
   
   <?php echo $form->button('Delete', array( 'class'=>'box' , 'onClick'=>"window.location.href='".$this->base."/carts/remove/ct_id:".$cartContent['ct']['id']."'" ) ) ;?>

  </td>
 </tr>
<?php 	}
}
?>
<tr class="content"> 
   <td colspan="4" align="right">Total </td>
  <td align="right"><?=Configure::read('Shop.currency');?><?=$subTotal;?></td>
  <td width="75" align="center">&nbsp;</td>
 </tr>  
 <tr class="content"> 
  <td colspan="5" align="right">&nbsp;</td>
  <td width="75" align="center">
  
  <?=$form->end( array('class'=>'box' , 'label'=>'Update Cart', 'id'=>'btnUpdate') );?>	
	
</td>
 </tr>
</table>
<br />
<table width="550" border="0" align="center" cellpadding="10" cellspacing="0">
 <tr align="center"> 
  <td>
   <?php echo $form->button('Continue Shopping', array( 'class'=>'box' , 'onClick'=>"window.location.href='".$this->base."/products/view/pd_id:".$cartContent['ct']['product_id']."'" ) ) ;?>
  </td>  
  <td>
  <?php echo $form->button('Proceed To Checkout', array( 'class'=>'box' , 'onClick'=>"window.location.href='".$this->base."/orders/checkout/pd_id:".$cartContent['ct']['product_id']."'" ) ) ;?>    
  </td>
 </tr>
</table>