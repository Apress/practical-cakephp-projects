<?php
	echo 'Welcome to the land of music!
	<br />
	Please select your own music product!
	<br />
	Thanks for dropping bye!<br />';
	
	if ($pdId) {
		echo $this->element('product_details');	
	} else if ($catId) {
		echo $this->element('product_list');	
	} else {
		echo $this->element('category_list');	
	}
?>