<div class="stories view">
<h2><?php  __('Story');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $story['Story']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $story['Story']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Body'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $story['Story']['body']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Story', true),
                array('action'=>'edit', $story['Story']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Story', true),
            array('action'=>'delete', $story['Story']['id']),
            null, sprintf(__('Are you sure you want to delete # %s?', true),
            $story['Story']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Stories', true),
                array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Story', true),
                                array('action'=>'add')); ?> </li>
	</ul>
</div>
