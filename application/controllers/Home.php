<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	private $user_id = FALSE;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('posts_model');
		if( ! $this->users_model->is_logged_in() ) redirect(site_url('user/login'));
		$this->user_id = $_SESSION['user_id'];
		//$this->output->enable_profiler(TRUE);
	}

	public function index()
	{
		
		$data = new stdClass();
		$data->page_title = 'Home';

		// form handlers
		$data->post_handler = site_url('post/do_post');
		$data->comment_handler = site_url('comment/do_comment');

		// other data
		$data->posts = $this->posts_model->get_many_by_user($this->user_id);

		$this->load->view('home/index', $data);
	}

	public function search()
	{
		$data = new stdClass();
		$data->s = $this->input->get('s');
		$data->page_title = 'Search results for ' . $data->s;

		$this->load->view('home/search', $data);
	}

	public function friends()
	{
		$data = new stdClass();
		$data->friends = $this->users_model->get_friends();
		$data->page_title = 'My Friends';
		$this->load->view('home/friends', $data);
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */