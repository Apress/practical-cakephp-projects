<?php
	if ( $product[0]['Product']['image'] ) {
		$pd_thumbnail = '/img/products/' . $product[0]['Product']['image'];
    } else {
		$pd_thumbnail = 'no-image-small.png';
    }
	e($html->image($pd_thumbnail, array( 'border' => '0', 'width'=>'150', 'height'=>'150' )));
?> 
<br />
<strong><?php echo $product[0]['Product']['name']; ?></strong>
<br />
Price : <?php echo Configure::read('Shop.currency'); ?><?php echo $product[0]['Product']['price']; ?><br>
<?php
    if ($product[0]['Product']['qty'] > 0) {
		e($html->link('Add to Shopping Basket','/carts/add/cat_id:'.$catId.'/pd_id:'.$product[0]['Product']['id']));
	} else {
		e('Out Of Stock');
    }
?>
<br />
<?php
	e( nl2br($product[0]['Product']['description']));
?>