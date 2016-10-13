<div>

    <?php
        echo $paginator->counter( array( 'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true ) ));
    ?>
    
    <?php
        foreach ($stories as $story) {
            
            echo '<h2>'.$story['Story']['title'].'</h2>';
            echo '<p>'.$story['Story']['body'].'</p>';
        }
    ?>

</div>

<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>

