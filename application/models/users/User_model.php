<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

/**
 * User model
 *
 * <p>
 * We are using this model to add, update, delete and get users.
 * </p>
 *
 * @package User
 * @author Nushrat
 * @copyright Copyright &copy; 2015, Dispatcher
 * @category CI_Model API
 */
class User_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}

	
	public function getUserByUserName($username) {
		$this->db->select ( 'u.*,c.name as company_name,c.logo,c.theme_color,c.address,c.street,c.city,c.state_id,c.pincode,c.created_date,c.created_by,b.branch_name,g.group_name,ur.name as role_name' );
		$this->db->from ( TABLES::$USERS.' AS u' );
		$this->db->join ( TABLES::$COMPANY.' AS c',"u.company_id=c.id","left" );
		$this->db->join ( TABLES::$BRANCH.' AS b',"u.branch_id=b.id","left" );
		$this->db->join ( TABLES::$GROUP.' AS g',"u.group_id=g.id","left" );
		$this->db->join ( TABLES::$USER_ROLE.' AS ur',"ur.id=u.user_role","left" );
		$this->db->where ( 'u.is_deleted', 0 );
		$this->db->where ( 'u.verified', 1 );
		$this->db->where ( "(u.email='".$username."' OR u.mobile='".$username."')",'',FALSE );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	} 
	
	public function getAllUser () {
		$this->db->select ( 'u.*,c.name as company_name,c.logo,c.theme_color,c.address,c.street,c.city,c.state_id,c.pincode,c.created_date,c.created_by,b.branch_name,g.group_name' );
		$this->db->from ( TABLES::$USERS.' AS u' );
		$this->db->join ( TABLES::$COMPANY.' AS c',"u.company_id=c.id","left" );
		$this->db->join ( TABLES::$BRANCH.' AS b',"u.branch_id=b.id","left" );
		$this->db->join ( TABLES::$GROUP.' AS g',"u.group_id=g.id","left" );
		$this->db->where ( 'u.is_deleted', 0 );
		//$this->db->where ( 'u.verified', 1 );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	} 
	
	public function getAllFieldworker () {
		$this->db->select ( 'u.*,c.name as company_name,c.logo,c.theme_color,c.address,c.street,c.city,c.state_id,c.pincode,c.created_date,c.created_by,b.branch_name,g.group_name' );
		$this->db->from ( TABLES::$USERS.' AS u' );
		$this->db->join ( TABLES::$COMPANY.' AS c',"u.company_id=c.id","left" );
		$this->db->join ( TABLES::$BRANCH.' AS b',"u.branch_id=b.id","left" );
		$this->db->join ( TABLES::$GROUP.' AS g',"u.group_id=g.id","left" );
		$this->db->where ( 'u.is_deleted', 0 );
		$this->db->where ( 'u.user_role', 4 );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	} 
	
	public function getUserById ($id) {
		$this->db->select ( 'u.*,c.name as company_name,c.logo,c.theme_color,c.address,c.street,c.city,c.state_id,c.pincode,c.created_date,c.created_by,b.branch_name,g.group_name' );
		$this->db->from ( TABLES::$USERS.' AS u' );
		$this->db->join ( TABLES::$COMPANY.' AS c',"u.company_id=c.id","left" );
		$this->db->join ( TABLES::$BRANCH.' AS b',"u.branch_id=b.id","left" );
		$this->db->join ( TABLES::$GROUP.' AS g',"u.group_id=g.id","left" );
		$this->db->where ( 'u.is_deleted', 0 );
		$this->db->where ( 'u.id', $id );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	} 
	

	
	public function addUserLog ($data)
	{
		$this->db->insert(TABLES::$USERLOG,$data);
		return $this->db->insert_id();
	}
	
	public function addUser ($data)
	{
		$this->db->insert(TABLES::$USERS,$data);
		return $this->db->insert_id();
	}
	
	public function updateUserById ($data)
	{
		$this->db->where ( 'id', $data['id'] );
		return $this->db->update(TABLES::$USERS,$data);
	}
	
	
}

