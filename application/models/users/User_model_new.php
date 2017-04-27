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
class User_model_new extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	
	public function saveUser ($data)
	{
		$this->db->insert(TABLES::$ADMIN,$data);
		return $this->db->insert_id();
	}
	
	public function getAllUser()
	{
		$this->db->select ( '*' )->from ( TABLES::$ADMIN);
		$this->db->where('user_role',2);
		$this->db->order_by('created_date','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getUserById($id)
	{
		$this->db->select ( '*' )->from ( TABLES::$ADMIN);
		$this->db->where('id',$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function updateUserById ($data)
	{
		$this->db->where ( 'id', $data['id'] );
		unset($data['id']);
		return $this->db->update(TABLES::$ADMIN,$data);
	}
	public function saveClientUser ($data)
	{
		$this->db->insert(TABLES::$ADMIN,$data);
		return $this->db->insert_id();
	}
	
	public function getClientAllUser()
	{
		$this->db->select ( '*' )->from ( TABLES::$ADMIN);
		$this->db->or_where('user_role',4);
		$this->db->or_where('user_role',5);
		$this->db->or_where('user_role',7);
		$this->db->where('client_id',$_SESSION['admin']['client_id']);
		$this->db->order_by('created_date','ASC');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getClientUserById ($id)
	{
		$this->db->select ( '*' )->from ( TABLES::$ADMIN);
		$this->db->where('id',$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function updateClientUserByID ($data)
	{
		$this->db->where ( 'id', $data['id'] );
		unset($data['id']);
		return $this->db->update(TABLES::$ADMIN,$data);
	}
	public function saveHospital ($data)
	{
		$this->db->insert(TABLES::$HOSPITAL,$data);
		return $this->db->insert_id();
	}
	
	public function gettAllHospital()
	{
		$client_id = $_SESSION['admin']['client_id'];
		$this->db->select ('(h.name) as hospital_name,h.address,h.locality,h.created_date,CONCAT(a.first_name," ",a.last_name) AS name,a.verified, a.email,a.mobile,h.id,h.city,h.business_name,h.state' );
		$this->db->from ( TABLES::$HOSPITAL.' AS h' );
		$this->db->join ( TABLES::$ADMIN.' AS a',"h.id=a.hospital_id","left" );
		$this->db->where('a.user_role',6);
		$this->db->where('a.client_id',$client_id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getHospitalById($id)
	{
		$this->db->select ('(h.name) as hospital_name,h.address,h.locality,h.created_date,a.text_password,a.first_name,a.last_name, a.email,a.mobile,h.id,a.hospital_id,a.verified,h.latitude,h.longitude,h.pincode,h.business_name,h.state,h.city' );
		$this->db->from ( TABLES::$HOSPITAL.' AS h' );
		$this->db->join ( TABLES::$ADMIN.' AS a',"h.id=a.hospital_id","left" );
		$this->db->where('h.id',$id);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function updateHospital($hospital)
	{
		$this->db->where ( 'id', $hospital['id'] );
		unset($hospital['id']);
		return $this->db->update(TABLES::$HOSPITAL,$hospital);
	}
	
	public function updateUserByHospitalId ($user)
	{
		$this->db->where ( 'hospital_id', $user['hospital_id'] );
		unset($user['hospital_id']);
		return $this->db->update(TABLES::$ADMIN,$user);
	}
}