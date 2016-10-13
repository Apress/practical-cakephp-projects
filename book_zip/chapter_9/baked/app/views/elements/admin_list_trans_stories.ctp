<div>

    <h2>
        <?php __( 'Stories to Translate into '.$language );?>
    </h2>
    
    <p>
        <?php
            echo $paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)));
        ?>
    </p>
    
    <table class="list_stories" cellpadding="0" cellspacing="0">
    
        <tr>
        	<th>Id</th>
        	<th>Title</th>
        	<th>Body</th>
        	<th class="actions"><?php __('Actions');?></th>
        </tr>
        
        <?php
            $i = 0;
            foreach ($stories as $story):
            	$class = null;
            	if ($i++ % 2 == 0) {
            		$class = ' class="altrow"';
            	}
        ?>
        	<tr<?php echo $class;?>>
        	
        		<td>
        			<?php echo $story['Story']['id']; ?>
        		</td>
        		
        		<td>
        			<?php echo $story['Story']['title']; ?>
        		</td>
        		
        		<td>
        			<?php echo $story['Story']['body']; ?>
        		</td>
        		
        		<td class="actions">
        			<?php echo $html->link(__('View', true), array( 'admin' => '', 'action' => 'view', $story['Story']['id'] ), array( 'target' => '_blank' ) ); ?>
        			<?php echo '&nbsp;|&nbsp;'; ?>
                    <?php echo $html->link(__('Translate', true), array( 'action'=>'edit', $story['Story']['id'], 'trans_lang' => $trans_lang ) ); ?>
                </td>
        		
        	</tr>
        	
        <?php endforeach; ?>
    </table>
    
</div>
    
<div class="paging">
    	<?php echo $paginator->prev('<< '.__('previous', true), array( 'url' => array( 'action' => 'toTrans/language:'.$trans_lang ) ), null, array('class'=>'disabled'));?>
     | 	<?php echo $paginator->numbers();?>
    	<?php echo $paginator->next(__('next', true).' >>', array( 'url' => array( 'action' => 'toTrans/language:'.$trans_lang ) ), null, array('class'=>'disabled'));?>
</div>