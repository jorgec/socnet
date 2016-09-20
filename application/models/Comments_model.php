<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments_model extends CI_Model {

	protected $tbl = 'comments';
	protected $pk = 'id';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('posts_model');
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

	public function get_many_by_user( $user_id )
	{
		$data = new stdClass();
		$this->db->where( array('user_id' => $user_id));
		$this->db->limit = array(0, 100);
		$this->db->order_by( 'created', 'DESC' );
		$data->posts = $this->db->get( $this->tbl )->result();
		$data->user = $this->users_model->get($user_id)->row();
		return $data;
	}

	public function get_many_by_post( $post_id )
	{
		$comments = new stdClass();
		$this->db->where( array('post_id' => $post_id));
		$this->db->limit = array(0, 100);
		$this->db->order_by( 'created', 'ASC' );
		$comments = $this->db->get( $this->tbl )->result();
		foreach( $comments as $k => $c ){
			$comments[$k]->user = $this->users_model->get($c->user_id)->row();
		}
		return $comments;
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
		$formdata->created = date('Y-m-d H:i:s');
	    return $this->db->insert( $this->tbl, $formdata );
	}

	/**
	 * generic setter
	 *
	 * @return bool
	 * @author 
	 */
	function set($column, $value, $id)
	{
		$this->db->where( $this->pk, $id );
	    return $this->db->update( $this->tbl, array( $column => $value ) );
	}

	function delete( $id ){
		return $this->set( 'deleted', 1, $id );
	}

}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */