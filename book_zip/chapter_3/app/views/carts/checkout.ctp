<?php 
	$cartContents = $this->requestAction("/carts/checkout/c:$catId/p:$pdId/s:$sid");
?>

<form method="POST" action="https://checkout.google.com/api/checkout/v2/checkoutForm/Merchant/632688601791968"
      accept-charset="utf-8">
<?php for( $i = 0; $i < count($cartContents); $i++ ) { ?>
  <input type="hidden" name="item_name_<?=$i+1;?>" value="<?=$cartContents[$i]['pd']['pd_name'];?>"/>
  <input type="hidden" name="item_description_<?=$i+1;?>" value="<?=$cartContents[$i]['pd']['pd_description'];?>"/>
  <input type="hidden" name="item_quantity_<?=$i+1;?>" value="<?=$cartContents[$i]['ct']['ct_qty'];?>"/>
  <input type="hidden" name="item_price_<?=$i+1;?>" value="<?=$cartContents[$i]['pd']['pd_price'];?>"/>
  <input type="hidden" name="item_currency_<?=$i+1;?>" value="GBP"/>
  <?php } ?>
  <input type="hidden" name="_charset_"/>
  <input type="image" name="Google Checkout" alt="Fast checkout through Google"
src="http://checkout.google.com/buttons/checkout.gif?merchant_id=632688601791968&w=180&h=46&style=white&variant=text&loc=en_US"
height="46" width="180"/>

</form>