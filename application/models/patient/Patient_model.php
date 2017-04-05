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
class Patient_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	
	public function save_patient ($patient)
	{
		//print_r($patient);
		$this->db->insert(TABLES::$PATIENT,$patient);
		return $this->db->insert_id();
	}
	
	public function update_patient($patient)
	{
		$this->db->where ( 'id', $patient['id'] );
		unset($patient['id']);
		return $this->db->update(TABLES::$PATIENT,$patient);
	}
	
	public function getPatientList()
	{
		$this->db->select ( 'name,room_no,test,	caller,special_instruction,created_date' )->from ( TABLES::$PATIENT);
		$this->db->order_by('created_date','ASC');
		$this->db->where ( 'client_id', $_SESSION['admin']['client_id'] );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getPatientListByPatientId($id)
	{
		$this->db->select('*')->from ( TABLES::$PATIENT );
		$this->db->where ( 'id', $id );
		//echo $this->db->last_query();
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getPatientListBydate($data)
	{
		$this->db->select ( 'name,room_no,test,	caller,special_instruction,created_date' )->from ( TABLES::$PATIENT);
		
		if(!empty($data['hospital_id']))
		{
			$this->db->where ( 'hospital_id', $data['hospital_id'] );
		}
		if(!empty($data['client_id']))
		{
			$this->db->where ( 'client_id', $data['client_id'] );
		}
		if(!empty($data['from_date'] && !empty($data['to_date'])))
		{
			$this->db->where("date(created_date) BETWEEN '".$data['from_date']."' AND '".$data['to_date']."'",'',false);
		}
		
		$this->db->order_by('created_date','ASC');
		$this->db->where ( 'client_id', $_SESSION['admin']['client_id'] );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
}