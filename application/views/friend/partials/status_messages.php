<?php if( $posts ):?>
	<div class="section">
	<?php foreach( $posts->posts as $post ):?>
		<div class="post box-container" id="post-<?php echo $post->id;?>">
			<div class="row">
				<div class="post-heading">
					<div class="post-author col-xs-6">
						<a href="<?php echo site_url('user/' . $posts->user->id);?>"><?php echo $posts->user->username;?></a>
					</div>
					<div class="post-date col-xs-6">
						<?php 
							$unix_ts = strtotime($post->created);
							$now_ts = time();
							echo timespan($unix_ts, $now_ts) . ' ago';
						?>
					</div>
				</div>
			</div>
			<div class="post-content"><?php echo $post->content;?></div>
			<div class="comments row">
				<?php if( $post->comments ):?>
					<?php foreach( $post->comments as $comment ):?>
						<div class="comment">
							<strong><a href="<?php echo site_url('user/' . $comment->user->id);?>"><?php echo $comment->user->username;?></a></strong> <?php echo $comment->comment;?>
							<br>
							<span class="comment-ts">
								<?php
									$unix_ts = strtotime($comment->created);
									$now_ts = time();
									echo timespan($unix_ts, $now_ts) . ' ago';
								?>
							</span>
						</div>
					<?php endforeach;?>
				<?php else:?>
					<div class="alert alert-warning">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						This post has no comments yet.
					</div>
				<?php endif;?>
			</div>
			<div class="comment-form">
				<form action="<?php echo $comment_handler;?>" method="POST" class="form-horizontal" role="form">

					<div class="form-group">
						<label for="comment-<?php echo $post->id;?>" class="control-label">Reply to this Status Message:</label>
						<div>
							<textarea name="comment" id="comment-<?php echo $post->id;?>" class="form-control" rows="1" required="required"></textarea>
						</div>
					</div>
					<input type="hidden" name="post_id" id="post-<?php echo $post->id;?>" class="form-control" value="<?php echo $post->id;?>">
					<button type="submit" class="btn btn-primary pull-right">Submit</button>
				</form>
			</div>
		</div>
	<?php endforeach;?>
	</div>
<?php else:?>
	<div class="alert alert-warning">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Warning!</strong> You have no posts to show!
	</div>
<?php endif;?>