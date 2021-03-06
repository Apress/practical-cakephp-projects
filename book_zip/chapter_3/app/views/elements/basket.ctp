<table id="minicart">
<?php
	$cartContents = $this->requestAction("/carts/getMiniCart/c:$catId/p:$pdId/s:$sid");

	if ( !empty($cartContents) && is_array($cartContents) ) { 
	$subTotal = 0;
	?>
	<tr>
		<td colspan="2">Cart Content</td>
	</tr> 
	<?php 
		foreach($cartContents as $cartContent) { 
		// Subtotal Calculation
		$subTotal += $cartContent['pd']['price'] * $cartContent['ct']['qty'];
	?>
	<tr>
	<td>
		<?=$cartContent['ct']['qty'];?> X 
		<?=$html->link($cartContent['pd']['name'], '/carts/add/product_id:'.$cartContent['ct']['product_id'].'ct_id:'.$cartContent['pd']['cat_id']);?>
	</td>
	<td width="30%" align="right">
		<?=Configure::read('Shop.currency');?><?=$cartContent['pd']['price'] * $cartContent['ct']['qty'];?>
	</td>
	</tr>
	<?php
	} ?>       
	<tr>
	<td align="right">Total</td>
	<td width="30%" align="right"><?=Configure::read('Shop.currency');?><?=$subTotal;?></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
	<td colspan="2" align="center"><?=$html->link(' Go To Shopping Cart','/carts/view');?></td>
	</tr>
	<?php
	} else {
	echo '<tr><td width="150">Shopping Basket is empty</td></tr>';
	}
    ?>
</table>