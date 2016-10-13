<?php 
$products = $this->requestAction("/products/lists/c:$catId/");
foreach($products as $product): ?>
<div class="product_container">
<?php 
    if ( $product['Product']['thumbnail'] ) {
        $thumbnail = '/img/products/' . $product['Product']['thumbnail'];
    } else {
        $thumbnail = 'no-image-small.png';
    }
      e( $html->link(
	      $html->image($thumbnail, array( 'border' => '0' )),
          array('controller' =>'products',
		  'action' => "view/cat_id:$catId/pd_id:".$product['Product']['id']
		  ),
          array('escape' => false))); ?>
    <br>
    <? echo $html->link( $product['Product']['name'], "/products/view/cat_id:$catId/pd_id:".$product['Product']['id'] ); ?>
    <br>Price : $<?=$product['Product']['price'];
?>
</div>
<? endforeach;?>