<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('posts_model');
		$this->load->model('comments_model');
		if( ! $this->users_model->is_logged_in() ) redirect(site_url('user/login'));
	}

	public function index()
	{
		
	}

	/**
	 * do_comment() handles the form that posts a comment on a status message
	 * 
	 * redirects to 'home' when done, with appropriate flashdata message
	 **/
	public function do_comment()
	{
		$formdata = new stdClass(); // form data object
		$data = new stdClass(); // view objects
		$formdata->user_id = $_SESSION['user_id']; // get user_id from session
		$formdata->comment = $this->input->post('comment'); // get status message comment from <textarea name="comment">
		$formdata->post_id = $this->input->post('post_id');
		$comment = $this->comments_model->create($formdata); // save the data

		if( $comment ){
			$data->message = 'Status commented!';
			$_SESSION['comment_status_message'] = array('success', $data);
		}else{
			$data->message = $this->db->error_message;
			$_SESSION['comment_status_message'] = array('error', $data);
		}
		
		/**
		 * comment_status_message is an array with two values:
		 *	[0] -> status (success or error)
		 *  [1] -> status message
		 **/
		$this->session->mark_as_flash('comment_status_message'); // mark the comment_status_message session as temporary

		redirect(site_url('home'));

	}

	public function do_friend_comment()
	{
		$formdata = new stdClass(); // form data object
		$data = new stdClass(); // view objects
		$formdata->user_id = $_SESSION['user_id']; // get user_id from session
		$formdata->comment = $this->input->post('comment'); // get status message comment from <textarea name="comment">
		$formdata->post_id = $this->input->post('post_id');
		$comment = $this->comments_model->create($formdata); // save the data

		if( $comment ){
			$data->message = 'Status commented!';
			$_SESSION['comment_status_message'] = array('success', $data);
		}else{
			$data->message = $this->db->error_message;
			$_SESSION['comment_status_message'] = array('error', $data);
		}
		
		/**
		 * comment_status_message is an array with two values:
		 *	[0] -> status (success or error)
		 *  [1] -> status message
		 **/
		$this->session->mark_as_flash('comment_status_message'); // mark the comment_status_message session as temporary
		$poster_id = $this->input->post('poster_id');
		redirect(site_url('friend/' . $poster_id));		
	}

}

/* End of file Comment.php */
/* Location: ./application/controllers/Comment.php */