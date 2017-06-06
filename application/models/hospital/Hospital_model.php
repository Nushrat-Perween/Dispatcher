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
class Hospital_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	
	public function getHospitalById($id)
	{
		$this->db->select('*')->from ( TABLES::$HOSPITAL );
		$this->db->where ( 'id', $id );
		//echo $this->db->last_query();
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getAllHospital ($param)
	{
		$this->db->select ( 'h.*' );
		$this->db->from ( TABLES::$HOSPITAL. ' AS h' );
		$this->db->where ( 'h.is_deleted', 0 );
		if(isset($param['client_id'])) {
			$this->db->where ( 'h.client_id', $param['client_id'] );
		}
		$this->db->order_by ( 'h.created_date', 'DESC' );
		$query = $this->db->get ();
		//echo $query = $this->db->last_query ();
		$result = $query->result_array ();
		return $result;
	}
	public function save_job ($job)
	{
		//print_r($job);
		$this->db->insert(TABLES::$JOB,$job);
		return $this->db->insert_id();
	}
	
	public function getAllJob($data)
	{
		$this->db->select('concat(jc.first_name," ",jc.last_name) as contact_name,jc.mobile,(jc.id) as job_contact_id,j.job_name,
				j.status,(j.id) as job_id,j.delivery_date,delivery_time,(p.name) as patient_name,p.caller,p.created_date,
				(p.id) as patient_id,h.business_name');
		$this->db->from ( TABLES::$JOB.' AS j' );
		$this->db->join ( TABLES::$HOSPITAL.' AS h',"h.id=j.hospital_id","left" );
		$this->db->join ( TABLES::$JOB_CONTACT.' AS jc',"jc.id=j.job_contact_id","left" );
		$this->db->join ( TABLES::$PATIENT.' AS p',"p.id=j.patient_id","left" );
		if(!empty($data['hospital_id']))
		{
			$this->db->where ( 'j.hospital_id', $data['hospital_id'] );
		}
		if(!empty($data['client_id']))
		{
			$this->db->where ( 'j.client_id', $data['client_id'] );
		}
		
		$this->db->where ( 'date(j.created_date)',$data['created_date']);
		$this->db->order_by('j.id','DESC');
		//echo $this->db->last_query();
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getJobById($jobid)
	{
		$this->db->select('*')->from ( TABLES::$JOB );
		$this->db->where ( 'id', $jobid );
		//echo $this->db->last_query();
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function update_job($job)
	{
		$this->db->where ( 'id', $job['id'] );
		unset($job['id']);
		return $this->db->update(TABLES::$JOB,$job);
	}
	
	public function clientjobByMob($data)
	{
		//$data['created_date'] = date("Y-m-d");
		$this->db->select('concat(jc.first_name," ",jc.last_name) as contact_name,jc.mobile,(jc.id) as job_contact_id,j.job_name,
				j.status,(j.id) as job_id,j.delivery_date,j.delivery_time,(p.name) as patient_name,p.caller,p.created_date,
				(p.id) as patient_id,h.business_name');
		$this->db->from ( TABLES::$JOB.' AS j' );
		$this->db->join ( TABLES::$HOSPITAL.' AS h',"h.id=j.hospital_id","left" );
		$this->db->join ( TABLES::$JOB_CONTACT.' AS jc',"jc.id=j.job_contact_id","left" );
		$this->db->join ( TABLES::$PATIENT.' AS p',"p.id=j.patient_id","left" );
		if(!empty($data['hospital_id']))
		{
			$this->db->where ( 'j.hospital_id', $data['hospital_id'] );
		}
		if(!empty($data['client_id']))
		{
			$this->db->where ( 'j.client_id', $data['client_id'] );
		}
		if(!empty($data['from_date'] && !empty($data['to_date'])))
		{
			$this->db->where("date(p.created_date) BETWEEN '".$data['from_date']."' AND '".$data['to_date']."'",'',false);
		}
		if(!empty($data['mobile']))
		{
			$this->db->where ( 'jc.mobile', $data['mobile']);
		}
		$this->db->order_by('j.id','DESC');
		//echo $this->db->get_compiled_select();
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
	public function getCity($data)
	{
		$this->db->select('j.city_name as name');
		$this->db->from ( TABLES::$JOB_CONTACT.' AS j' );
		$this->db->where("j.city_name LIKE '%$data%'");
		$this->db->group_by('j.city_name');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
		
	}
	
	public function getState($data)
	{
		$this->db->select('j.state_name as name');
		$this->db->from ( TABLES::$JOB_CONTACT.' AS j' );
		$this->db->where("j.state_name LIKE '%$data%'");
		$this->db->group_by('j.state_name');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	
	}
	
	public function getDriverList ($param) {
		$this->db->select ( 'a.*,ar.name as role_name,b.branch_name,(select id from tbl_job as j where j.assign_to=a.id order by j.created_date desc limit 1) as job_id' );
		$this->db->from ( TABLES::$ADMIN.' AS a' );
		$this->db->join ( TABLES::$ADMIN_USER_ROLE.' AS ar',"ar.id=a.user_role","left" );
		$this->db->join ( TABLES::$BRANCH.' AS b',"b.id=a.branch_id","left" );
		$this->db->where ( 'a.is_deleted', 0 );
		$this->db->where ( 'a.user_role', 7 );
		
		if(isset($param['branch_id'])) {
			$this->db->where ( 'a.branch_id', $param['branch_id'] );
		}
		if(isset($param['client_id'])) {
			$this->db->where ( 'a.client_id', $param['client_id'] );
		}
		if(isset($param['hospital_id'])) {
			$this->db->where ( 'a.hospital_id', $param['hospital_id'] );
		}
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
}