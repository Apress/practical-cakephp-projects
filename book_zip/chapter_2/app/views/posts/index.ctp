<div id="center_content" style="border: 0px solid #222222;">
    <h2>Post Listings</h2>	
    <p>Here is a list of the existing posts.</p>    
	<?php foreach($comments as $comment) {?>
	<div class="comment">
		<p><b><?=$comment['Comment'][''];?></b></p>
		<p><?=$comment['Comment']['content'];?></p>
	</div>
	<?php }	?>
    <div>
    </div>
	<?php
		if ( isset( $posts ) && is_array( $posts ) ) {			
			?>
			<table style="padding: 0px;" border="0" cellpadding="0" cellspacing="0">
				<tr >
                    <td style="border-bottom: 1px solid #444444;">
                        <b>ID</b>
                    </td>						      
					<td style="border-bottom: 1px solid #444444;">
                        <b>title</b>
                    </td>
					<td style="border-bottom: 1px solid #444444;">
                        <b>content</b>
                    </td>
					<td style="border-bottom: 1px solid #444444;">
                        <b>Last Modified</b>
                    </td>       
					<td style="border-bottom: 1px solid #444444;" colspan="3"><b>Action</b></td>
				</tr>
			<?php

			for( $idx=0; $idx<sizeof( $posts ); $idx++ ) {
				$posts_id = $posts[$idx][ 'Post' ][ 'id' ];
				
				?>
				<tr>
                    <td width="5%"><?php echo $posts[$idx][ 'Post' ][ 'id' ]; ?></td>							                            
                    <td width="15%"><?php echo $posts[$idx][ 'Post' ][ 'title' ]; ?></td>	
                    <td width="45%"><?php echo $posts[$idx][ 'Post' ][ 'content' ]; ?></td>
					<td width="15%"><?php echo $posts[$idx][ 'Post' ][ 'modified' ]; ?></td>
					<td width="5%">
					<?php if($posts[$idx][ 'Post' ][ 'published' ] == 1) { 
						echo $html->link('Publish', array('action'=>'disable', $posts[$idx][ 'Post' ][ 'id' ]));
					}else{
						echo $html->link('Unpublish', array('action'=>'enable', $posts[$idx][ 'Post' ][ 'id' ]));						
					}
					?>
					</td>
					<td width="5%">
						<?php echo $html->link('Edit', array('action'=>'edit', $posts[$idx][ 'Post' ][ 'id' ]), null);?>
					</td>
					<td width="5%">
						<?php echo $html->link(__('Delete', true), array('action'=>'delete', $posts[$idx][ 'Post' ][ 'id' ]), null, sprintf(__('Are you sure you want to delete Post # %s?', true), $posts[$idx][ 'Post' ][ 'id' ]));?>
					</td>					
				</tr>
				<?php
			}
			
			if ( sizeof( $posts ) == 0 ) {
				?>
				<tr style="background-color: #cccccc;">
					<td colspan="6"><span style="font-size: 17px;">No post Found.</font></td>
				</tr>
				<?php
			}
			?>
			</table>
			
			<br/>
			<?php
		}
	?>
</div>