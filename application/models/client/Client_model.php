<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

/**
 * Client model
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
class Client_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	
	public function save_client ($data)
	{
		//print_r($data);
		$this->db->insert(TABLES::$CLIENT,$data);
		return $this->db->insert_id();
	}
	
	public function getAllClient()
	{
		$this->db->select ('c.*,CONCAT(a.first_name," ",a.last_name) AS client_name, a.email,a.mobile,a.user_role,a.client_id,a.verified' );
		$this->db->from ( TABLES::$CLIENT.' AS c' );
		$this->db->join ( TABLES::$ADMIN.' AS a',"c.id=a.client_id","left" );
		$this->db->where ( 'a.is_deleted', 0 );
		$this->db->where('user_role',3);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getClientById($id)
	{
		$this->db->select ('c.*,a.email,a.text_password,a.first_name,a.last_name, a.email,a.mobile,a.user_role,a.client_id,a.verified' );
		$this->db->from ( TABLES::$CLIENT.' AS c' );
		$this->db->join ( TABLES::$ADMIN.' AS a',"c.id=a.client_id","left" );
		$this->db->where('c.id',$id);
		$this->db->where('a.client_id',$id);
		//echo $this->db->get_compiled_select();
		//$this->db->where ( 'a.verified', 1 );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function updateClientById($data)
	{
		//echo $data['id'];
		$this->db->where ('id', $data['id'] );
		unset($data['id']);
		return $this->db->update(TABLES::$CLIENT,$data);
	}
	
	public function updateClientByClientId($client)
	{
		$this->db->where ('client_id', $client['id'] );
		unset($client['id']);
		return $this->db->update(TABLES::$ADMIN,$client);
	}
}