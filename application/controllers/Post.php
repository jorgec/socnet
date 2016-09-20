<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('posts_model');
		if( ! $this->users_model->is_logged_in() ) redirect(site_url('user/login'));
	}

	public function index()
	{
		
	}

	/**
	 * do_post() handles the form that creates a status message
	 * 
	 * redirects to 'home' when done, with appropriate flashdata message
	 **/
	public function do_post()
	{
		$formdata = new stdClass(); // form data object
		$data = new stdClass(); // view objects
		$formdata->user_id = $_SESSION['user_id']; // get user_id from session
		$formdata->content = $this->input->post('content'); // get status message content from <textarea name="content">
		$formdata->content = strip_tags($formdata->content, '<img>');
		$post = $this->posts_model->create($formdata); // save the data

		if( $post ){
			$data->message = 'Status posted!';
			$_SESSION['post_status_message'] = array('success', $data);
		}else{
			$data->message = $this->db->error_message;
			$_SESSION['post_status_message'] = array('error', $data);
		}
		
		/**
		 * post_status_message is an array with two values:
		 *	[0] -> status (success or error)
		 *  [1] -> status message
		 **/
		$this->session->mark_as_flash('post_status_message'); // mark the post_status_message session as temporary

		redirect(site_url('home'));

	}

	public function do_friend_post()
	{
		$formdata = new stdClass(); // form data object
		$data = new stdClass(); // view objects
		$formdata->user_id = $_SESSION['user_id']; // get user_id from session
		$formdata->content = $this->input->post('content'); // get status message content from <textarea name="content">
		$formdata->content = strip_tags($formdata->content, '<img>');
		$post = $this->posts_model->create($formdata); // save the data

		if( $post ){
			$data->message = 'Status posted!';
			$_SESSION['post_status_message'] = array('success', $data);
		}else{
			$data->message = $this->db->error_message;
			$_SESSION['post_status_message'] = array('error', $data);
		}
		
		/**
		 * post_status_message is an array with two values:
		 *	[0] -> status (success or error)
		 *  [1] -> status message
		 **/
		$this->session->mark_as_flash('post_status_message'); // mark the post_status_message session as temporary

		$poster_id = $this->input->post('poster_id');
		redirect(site_url('friend/' . $poster_id));			
	}

}

/* End of file Post.php */
/* Location: ./application/controllers/Post.php */