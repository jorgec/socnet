<div class="post box-container">
	<div class="post-content">
		<form action="<?php echo $post_handler;?>" method="POST" class="form-horizontal" role="form">

			<div class="form-group">
				<label for="textarea" class="col-sm-2 control-label">Post a Status Message:</label>
				<div class="col-sm-10 col-xs-12">
					<textarea name="content" id="content" class="form-control" rows="3" required="required"></textarea>
				</div>
			</div>
			<input type="hidden" name="poster_id" class="form-control" value="<?php echo $user_id;?>">
			<button type="submit" class="btn btn-primary pull-right">Submit</button>
		</form>
	</div>
</div>