<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

/**
 * AdminUser model
 *
 * <p>
 * We are using this model to add, update, delete and get admin users.
 * </p>
 *
 * @package AdminUser
 * @author Nushrat
 * @copyright Copyright &copy; 2015, Dispatcher
 * @category CI_Model API
 */
class adminUser_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}

	
	public function getAdminByUserName($username) {
		$this->db->select ( 'a.*,ar.name as role_name' );
		$this->db->from ( TABLES::$ADMIN.' AS a' );
		$this->db->join ( TABLES::$ADMIN_USER_ROLE.' AS ar',"ar.id=a.user_role","left" );
		$this->db->where ( 'a.is_deleted', 0 ); 
		$this->db->where ( 'a.verified', 1 );
		$this->db->where ( "(a.email='".$username."' OR a.mobile='".$username."')",'',FALSE );
		$query = $this->db->get ();
	//  echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getAllAdmin ($param) {
		$this->db->select ( 'a.*,ar.name as role_name' );
		$this->db->from ( TABLES::$ADMIN.' AS a' );
		$this->db->join ( TABLES::$ADMIN_USER_ROLE.' AS ar',"ar.id=a.user_role","left" );
		$this->db->where ( 'a.is_deleted', 0 );
		if(isset($param['user_role'])) {
			$this->db->where ( 'a.user_role', $param['user_role'] );
		}
		if(isset($param['client_id'])) {
			$this->db->where ( 'a.client_id', $param['client_id'] );
		}
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getAdminById ($id) {
		$this->db->select ( 'a.*,ar.name as role_name' );
		$this->db->from ( TABLES::$ADMIN.' AS a' );
		$this->db->join ( TABLES::$ADMIN_USER_ROLE.' AS ar',"ar.id=a.user_role","left" );
		$this->db->where ( 'a.is_deleted', 0 );
		$this->db->where ( 'a.id', $id );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	
	public function addAdminLog ($data)
	{
		$this->db->insert(TABLES::$ADMINLOG,$data);
		return $this->db->insert_id();
	}
	
	public function addAdmin ($data)
	{
		$this->db->insert(TABLES::$ADMIN,$data);
		return $this->db->insert_id();
	}
	
	public function updateAdminById ($data)
	{
		$this->db->where ( 'id', $data['id'] );
		return $this->db->update(TABLES::$ADMIN,$data);
	}
	public function updateCurrentLocationById($data)
	{
		$this->db->where ( 'id', $data['id'] );
		unset($data['id']);
		return $this->db->update(TABLES::$ADMIN,$data);
	}
}

