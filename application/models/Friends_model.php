<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Friends_model extends CI_Model {

	protected $tbl = 'friends';
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
	function set($column, $value, $id)
	{
		$this->db->where( $this->pk, $id );
		$formdata->updated = date('Y-m-d h:i:s');
	    return $this->db->update( $this->tbl, array( $column => $value ) );
	}
	function set_by($condition, $column, $value)
	{
		$this->db->where($condition);
		return $this->db->update( $this->tbl, array( $column => $value ) );
	}

	function delete( $id ){
		return $this->set( 'deleted', 1, $id );
	}



	function get_friends( $user_id )
	{
		//$condition = array( 'user_1' => $user_id );
		$condition =  "(`user_1` = '$user_id' OR `user_2` = '$user_id') AND `status` = 1";
		$friends = $this->get_all( $condition );
		foreach( $friends as $k => $f ){
			if( $friends[$k]->user_1 == $_SESSION['user_id'] ){
				$friends[$k]->userdata = $this->users_model->get($friends[$k]->user_2)->row();
			}else{
				$friends[$k]->userdata = $this->users_model->get($friends[$k]->user_1)->row();
			}
		}
		return $friends;
	}

	function check_friendship( $user_1, $user_2 )
	{
		$condition =  "(`user_1` = '$user_1' OR `user_2` = '$user_1') OR (`user_1` = '$user_2' OR `user_2` = '$user_2')";
		$status = $this->get_one($condition);
		return $status;
	}

	function unfriend($user_1, $user_2)
	{
		$condition =  "(`user_1` = '$user_1' OR `user_2` = '$user_1') OR (`user_1` = '$user_2' OR `user_2` = '$user_2')";
		$unfriend = $this->set_by( $condition, 'status', 0 );
		return $unfriend;
	}

	function befriend( $user_1, $user_2 )
	{
		$data->user_1 = $user_1;
		$data->user_2 = $user_2;

		return $this->create($data);
	}

	function confirm( $user_1, $user_2 )
	{
		$condition =  "(`user_1` = '$user_1' OR `user_2` = '$user_1') OR (`user_1` = '$user_2' OR `user_2` = '$user_2')";
		$confirm = $this->set_by( $condition, 'status', 1 );
		return $confirm;		
	}

	function deny( $user_1, $user_2 )
	{
		$condition =  "(`user_1` = '$user_1' OR `user_2` = '$user_1') OR (`user_1` = '$user_2' OR `user_2` = '$user_2')";
		$this->db->where($condition);
		$deny = $this->db->delete($this->tbl);
		return $deny;
	}
	
}

/* End of file Friends_model.php */
/* Location: ./application/models/Friends_model.php */