<div>

    <h2><?php __('Stories');?></h2>
    <p>
        <?php
            echo $paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)));
        ?>
    </p>
    
    <table class="list_stories" cellpadding="0" cellspacing="0">
    
        <tr>
        	<th><?php echo $paginator->sort('id');?></th>
        	<th><?php echo $paginator->sort('title');?></th>
        	<th><?php echo $paginator->sort('body');?></th>
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
                    <?php echo $html->link(__('Edit', true), array('action'=>'edit', $story['Story']['id'])); ?>
                    <?php echo '&nbsp;|&nbsp;'; ?>
        			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $story['Story']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $story['Story']['id'])); ?>
        		</td>
        		
        	</tr>
        	
        <?php endforeach; ?>
    </table>
    
</div>
    
<div class="paging">
    	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
     | 	<?php echo $paginator->numbers();?>
    	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>

