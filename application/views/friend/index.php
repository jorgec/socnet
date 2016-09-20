<?php
/**
 * we'll split this file into sections:
 * - header
 * - body
 * --- left sidebar
 * --- content
 * ------ process result message (success or error)
 * ------ status form
 * ------ list of current user's status messages
 * --- right sidebar
 * - footer
 **/?>
<?php $this->load->view('includes/header');?>
<?php $this->load->view('friend/partials/friendbar');?>
<div class="container">
	<div class="row">
		<div class="col-xs-3 col-sm-2">
			// left sidebar
		</div>
		<div class="col-xs-6 col-sm-8">

			<?php if( $this->session->flashdata('post_status_message')):?>
				<?php 
					$post_status = $this->session->flashdata('post_status_message');
					$this->load->view('snippets/' . $post_status[0], $post_status[1]);
				?>
			<?php endif;?>

			<?php $this->load->view('friend/partials/status_messages');?>

		</div>
		<div class="col-xs-3 col-sm-2">
			// right sidebar
		</div>
	</div>
</div>
<?php $this->load->view('includes/footer');?>