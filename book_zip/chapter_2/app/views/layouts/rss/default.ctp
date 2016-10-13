<?php 
	echo $rss->header();

	$channel = $rss->channel(array(), $channelData, $items);

	echo $rss->document(array(), $channel);
?>