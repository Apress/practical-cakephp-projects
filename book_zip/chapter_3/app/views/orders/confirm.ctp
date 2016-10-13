<?php
	if($orders['Order']['payment'] == 1) {
		echo $this->element('google_checkout');
	} else {
		echo $this->element('paypal_checkout');	
	}
?>