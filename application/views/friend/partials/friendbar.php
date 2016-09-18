<div id="friend-control-panel">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6" id="friend-identifier">
				<h2><?php echo $user->username;?></h2>
			</div>
			<div class="col-xs-12 col-sm-6" id="friend-controls">
				<div id="friendship-status">
				<?php
					if( $friendship ){
						if( $friendship->status == 0 ){
							if( $friendship->user_1 == $_SESSION['user_id'] ) {
								?>
								<span class="label label-warning">Pending friend request</span>
								<?php
							}
							if( $friendship->user_2 == $_SESSION['user_id'] ) {
								?>
								<span class="label label-info">This person has a pending friend request for you. <a href="<?php echo site_url('friend/confirm/' . $user_id);?>">Confirm</a> or <a href="<?php echo site_url('friend/deny/' . $user_id);?>">Deny</a>?</span>
								<?php
							}
						}else{
							echo '<span class="label label-success">You are friends with ' . $user->username . '</span>';
						}
					}else{
						echo '<span class="label label-warning">You are not friends with ' . $user->username . '. Do you want to <a href="' . site_url('friend/request/' . $user_id) . '">send a friend request</a>?</span>';
					}
				?>
				</div>
			</div>
		</div>
	</div>
</div>