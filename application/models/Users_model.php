<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {

	protected $tbl = 'users';
	protected $pk = 'id';

	public function __construct()
	{
		parent::__construct();
		
	}

	// getters

	public function get( $id )
	{
		$this->db->where( $this->pk, $id );
		return $this->db->get( $this->tbl );
	}

	/**
	 * get_many will return rows based on:
	 * $conditions - see codeigniter db->where()
	 * $limit - see codeigniter db->limit()
	 * $order - see codeigniter db->order_by()
	 *
	 * @return an array of objects
	 */

	public function get_many( $conditions = FALSE, $limit = array(0,10), $order = array( 'id', 'ASC') )
	{
		if( $conditions ){
			$this->db->where( $conditions );
		}
		$this->db->limit = $limit;
		$this->db->order_by( $order[0], $order[1] );
		return $this->db->get( $this->tbl )->result();
	}

	public function get_all( $conditions = FALSE, $order = array( 'id', 'ASC') )
	{
		if( $conditions ){
			$this->db->where( $conditions );
		}
		$this->db->order_by( $order[0], $order[1] );
		return $this->db->get( $this->tbl )->result();
	}

	/**
	 * get one based on $conditions
	 *
	 * @return object
	 */
	function get_one( $conditions = FALSE )
	{
		if( ! $conditions ){
			return $this->get_many();
		}
		$this->db->where( $conditions );
		return $this->db->get( $this->tbl )->row();
	    
	}

	// setters
	/**
	 * create
	 *
	 * @return bool
	 * @author 
	 */
	function create($formdata)
	{
		$formdata->created = date('Y-m-d h:i:s');
	    return $this->db->insert( $this->tbl, $formdata );
	}

	/**
	 * generic setter
	 *
	 * @return bool
	 * @author 
	 */
	function set($data, $id)
	{
		$this->db->where( $this->pk, $id );
		$data['updated'] = date('Y-m-d h:i:s');
	    return $this->db->update( $this->tbl, $data ) ;
	}

	function delete( $id ){
		return $this->set( array('deleted' => 1), $id );
	}


	// post getters
	function get_posts($id)
	{
		$this->load->model('posts_model');
		$condition = array( 'user_id' => $id );
		$posts = $this->posts_model->get_many( $condition );

		return $posts;
	}

	// post setters
	function write_post( $content )
	{
		$this->load->model('posts_model');

		$postdata = new stdClass();
		$postdata->user_id = 2;
		$postdata->content = $content;
		
		return $this->posts_model->create( $postdata );

	}



	// utilities
	
	function is_logged_in()
	{
		if( isset( $_SESSION['logged_in'] ) && $_SESSION['logged_in'] == 1 ){
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * friends methods
	 */
	
	/*======================================
	=     get_nonfriends/get_friends       =
	========================================
	 * A friend is represented in the `friends` table as
	 * someone who has the current user in the `user_2` column
	 */
	
	
	
	function get_nonfriends()
	{
		
		$this->load->model('friends_model'); // load model
		$id = $this->session->user_id; // retrieves the user_id of the logged-in user

		// build a list of exclusions
		$exclusions = array($id); // current user

		// get friends of $id
		$friends = $this->friends_model->get_friends( $id );
		foreach( $friends as $friend ){
			$exclusions[] = $friend->user_2;
		}
		
		// get all users - exclusions
		$users = $this->db->where_not_in( 'id', $exclusions )->get($this->tbl)->result();
		return $users;

	}

	function get_friends()
	{
		$this->load->model('friends_model'); // load model
		$id = $this->session->user_id; // retrieves the user_id of the logged-in user

		// get friends of $id
		$friends = $this->friends_model->get_friends( $id );
		
		
		return $friends;
	}

}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */