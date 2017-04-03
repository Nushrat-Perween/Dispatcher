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
class Contact_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	
	public function save_contact ($contact)
	{
		//print_r($contact);
		$this->db->insert(TABLES::$JOB_CONTACT,$contact);
		return $this->db->insert_id();
	}
	
	public function update_contact($data)
	{
		
		$this->db->where ( 'id', $data['id'] );
		unset($data['id']);
		return $this->db->update(TABLES::$JOB_CONTACT,$data);
	}
	public function getCustomerListByCustomerId($id)
	{
		$this->db->select('*')->from ( TABLES::$JOB_CONTACT.' AS j' );
		$this->db->where ( 'j.id', $id );
		//echo $this->db->last_query();
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getCustomerList()
	{
		$this->db->select ( 'concat(first_name, " ",last_name) as contact_name,mobile,city_name,street,building,created_date' )->from ( TABLES::$JOB_CONTACT);
		$this->db->order_by('created_date','ASC');
		$this->db->where ( 'client_id', $_SESSION['admin']['client_id'] );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getCustomerListBydate($data)
	{
		$this->db->select ( 'concat(first_name, " ",last_name) as contact_name,mobile,city_name,street,building,created_date' )->from ( TABLES::$JOB_CONTACT);
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
		if(!empty($data['mobile']))
		{
			$this->db->where ( 'mobile', $data['mobile']);
		}
		$this->db->order_by('created_date','ASC');
		$this->db->where ( 'client_id', $_SESSION['admin']['client_id'] );
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
}