<?php $this->load->view('includes/header');?>

<div class="container">
	<div class="row">
		<div class="col-sm-6">
			<h1>Friends</h1>
			<ul>
			<?php if( $friends ):?>
				<?php foreach( $friends as $user ):?>
					<li><a href="<?php echo site_url('friend/'. $user->id);?>"><?php echo $user->username;?></a></li>
				<?php endforeach;?>
			<?php else:?>
				<li>You have no friends!</li>
			<?php endif;?>
			</ul>
		</div>
		<div class="col-sm-6"></div>

	</div>
</div>

<?php $this->load->view('includes/footer');?>