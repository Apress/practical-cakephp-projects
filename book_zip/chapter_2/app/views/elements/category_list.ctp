<br />
<?php foreach($categoryList as $category): ?>

<div class="product_container">
<? 
    if ( $category['Category']['cat_image'] ) {
        $cat_thumbnail = '/img/products/' . $category['Category']['cat_image'];
    } else {
        $cat_thumbnail = 'no-image-small.png';
    }

      e( $html->link(
	      $html->image($cat_thumbnail, array( 'border' => '0' )),
          array('action' => '/index/cat_id:' . $category['Category']['cat_id']),
          array('escape' => false))); ?>
    <br>
    <? echo $html->link( $category['Category']['cat_name'], "/Ecommerce/index/cat_id:".$category['Category']['cat_id'] ); ?>
</div>

<? endforeach;?>