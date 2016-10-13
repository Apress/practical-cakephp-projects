<table id="minicart">
    <?php     
        if ( !empty($cartContents) && is_array($cartContents) ) { 
		$subTotal = 0;
		?>
                <tr>
                    <td colspan="2">Cart Content</td>
                </tr> 

				<?php 
				
					foreach($cartContents as $cartContent) { 
					
					// Subtotal Calculation
					$subTotal += $cartContent['pd']['pd_price'] * $cartContent['ct']['ct_qty'];
					
					?>
                
                <tr>
                    <td><?=$cartContent['ct']['ct_qty'];?> X 
					<?=$html->link($cartContent['pd']['pd_name'], '/Carts/add/pd_id:'.$cartContent['ct']['pd_id'].'ct_id:'.$cartContent['pd']['cat_id']);?></td>
                    <td width="30%" align="right"><?=Configure::read('Shop.currency');?><?=$cartContent['pd']['pd_price'] * $cartContent['ct']['ct_qty'];?></td>
                </tr>
              <?php
				} ?>       
                <tr>
                    <td align="right">Total</td>
                    <td width="30%" align="right"><?=Configure::read('Shop.currency');?><?=$subTotal;?></td>
                </tr>
                
                <tr>
                    <td colspan="2">&nbsp;</td></tr>
                <tr>
                    <td colspan="2" align="center"><?=$html->link(' Go To Shopping Cart','/Carts/view');?></td>
                </tr>				
		<?php                 
        }
        else{
            echo '<tr><td width="150">Shopping Basket is empty</td></tr>';
        }
    ?>
</table>