<?php
    echo $html->image('no-image-large.png');
?> 

<br>
<strong><?php echo $productDetails['Product']['pd_name']; ?></strong>

<br>
Price : <?php echo Configure::read('Shop.currency'); ?><?php echo $productDetails['Product']['pd_price']; ?><br>

<?php
    
    // if we still have this product in stock
    // show the 'Add to cart' button
    
    if ($productDetails['Product']['pd_qty'] > 0) {    
        echo $html->link('Add to Shopping Basket','/Carts/add/cat_id:'.$catId.'/pd_id:'.$productDetails['Product']['pd_id']);
    } else {
    	echo 'Out Of Stock';
    }
?>

<br>
<?php
    echo nl2br($productDetails['Product']['pd_description']);
?>
    
    