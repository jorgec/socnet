<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Friend extends CI_Controller {
	private $user_id = FALSE;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('posts_model');
		$this->load->model('friends_model');
		if( ! $this->users_model->is_logged_in() ) redirect(site_url('user/login'));
	}

	public function index()
	{
		
	}

	public function lookup()
	{
		$data = new stdClass();
		$data->user_id = $this->uri->segment(2);
		$this->user_id = $data->user_id;
		$data->user = $this->users_model->get($data->user_id)->row();
		$data->page_title = $data->user->username;

		// form handlers
		$data->post_handler = site_url('post/do_friend_post');
		$data->comment_handler = site_url('comment/do_friend_comment');

		// other data
		$data->posts = $this->posts_model->get_many_by_user($this->user_id);
		$data->friendship = $this->friends_model->check_friendship( $_SESSION['user_id'], $this->user_id );

		$this->load->view('friend/index', $data);
	}

	public function confirm($user_id)
	{

	}
	public function deny($user_id)
	{

	}
	public function request($user_id)
	{
		
	}
	public function remove($user_id)
	{

	}

}

/* End of file Friend.php */
/* Location: ./application/controllers/Friend.php */