<?php foreach($productList as $product): ?>

<div class="product_container">
<? 
    if ( $product['pd']['pd_thumbnail'] ) {
        $pd_thumbnail = '/img/products/' . $product['pd']['pd_thumbnail'];
    } else {
        $pd_thumbnail = 'no-image-small.png';
    }

      e( $html->link(
	      $html->image($pd_thumbnail, array( 'border' => '0' )),
          array('controller' =>'Products',
		  'action' => "details/cat_id:$catId/pd_id:".$product['pd']['pd_id']
		  ),
          array('escape' => false))); ?>
    <br>
    <? echo $html->link( $product['pd']['pd_name'], "/Products/details/cat_id:$catId/pd_id:".$product['pd']['pd_id'] ); ?>
    <br>Price : $<?=$product['pd']['pd_price'];
?>
</div>

<? endforeach;?>