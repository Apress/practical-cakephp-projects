<?php
	echo 'Welcome to the land of music!
	<br />
	Please select your own music product!
	<br />
	Thanks for dropping by!<br />';	
	if ($pdId) {
		//echo $this->element('product_details');	
	} else if ($catId) {
		echo $this->element('products');	
	} else {
		echo $this->element('categories');	
	}
?>