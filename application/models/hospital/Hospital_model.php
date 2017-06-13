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
	
	public function getAllHospitalByClient ($param)
	{
		$this->db->select ('(h.name) as hospital_name,h.address,h.locality,h.created_date,CONCAT(a.first_name," ",a.last_name) AS name,a.verified, a.email,a.mobile,h.id,h.city,h.business_name,h.state' );
		$this->db->from ( TABLES::$HOSPITAL.' AS h' );
		$this->db->join ( TABLES::$ADMIN.' AS a',"h.id=a.hospital_id","left" );
		$this->db->where('a.user_role',6);
		$this->db->where('a.client_id',$param['client_id']);
		$query = $this->db->get ();
		//echo $this->db->last_query ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getAssignedHospitalByDriverId ($driver_id)
	{
		$this->db->select ('h.*' );
		$this->db->from ( TABLES::$ASSIGN_HOSPITAL_TO_DRIVER.' AS a' );
		$this->db->join ( TABLES::$HOSPITAL.' AS h',"h.id=a.hospital_id","left" );
		$this->db->where('a.driver_id',$driver_id);
		$query = $this->db->get ();
// 		echo $this->db->last_query ();
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
		$this->db->select ( "group_concat(DISTINCT h.name) as hospital_assigned,(CASE WHEN aa.present IS NULL THEN 'No' ELSE 'Yes' END) AS attendance,aa.*,j1.*,a.*,ar.name as role_name,b.branch_name" );
		$this->db->from ( TABLES::$ADMIN.' AS a' );
		$this->db->join ( TABLES::$ADMIN_USER_ROLE.' AS ar',"ar.id=a.user_role","left" );
		$this->db->join ( TABLES::$ASSIGN_HOSPITAL_TO_DRIVER.' AS ah',"ah.driver_id=a.id","left" );
		$this->db->join ( TABLES::$HOSPITAL.' AS h',"ah.hospital_id=h.id","left" );
		$this->db->join ( TABLES::$BRANCH.' AS b',"b.id=a.branch_id","left" );
		
		$this->db->join ( '(SELECT admin_id,count(admin_id) as present,action_time from tbl_admin_attendance where DATE(action_time) = DATE(NOW()) group by admin_id) as `aa` ',"a.id=aa.admin_id","left" );
		$this->db->join ( '(select `j`.`id` as `job_id`, j.assign_to ,`j`.`start_date`, `j`.`start_time`, `j`.`end_date`, `j`.`end_time` From `tbl_job` AS `j` where ( j.action_id != 6 and j.action_id != 7 and j.action_id != 8 and DATE(j.created_date) = DATE(NOW()) )) as j1',"j1.assign_to=a.id","left" );
		$this->db->where ( 'a.is_deleted', 0 );
		$this->db->where ( 'a.user_role', 7 );
// 		$this->db->where ( '( j.action_id != 6 and j.action_id != 7 and j.action_id != 8) and   DATE(j.created_date) = DATE(NOW()) ','',false );
		
		if(isset($param['branch_id'])) {
			$this->db->where ( 'a.branch_id', $param['branch_id'] );
		}
		if(isset($param['client_id'])) {
			$this->db->where ( 'a.client_id', $param['client_id'] );
		}
		if(isset($param['hospital_id'])) {
			$this->db->where ( 'a.hospital_id', $param['hospital_id'] );
		}
		$this->db->group_by('ah.driver_id');
		$query = $this->db->get ();
// 		echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	
	public function resetDriverIDToZeroInHospital ($driver_id) {
		$param['driver_id'] = 0;
		$this->db->where ( 'driver_id', $driver_id );
		$res = $this->db->update(TABLES::$HOSPITAL,$param);
		//echo $this->db->last_query();
		return  $res;
	}
	
	public function assignDriverToHospital ($param) {
		$driver_id = $param[0]['driver_id'];
		$this->db->where('driver_id',$driver_id);
		$this->db->delete(TABLES::$ASSIGN_HOSPITAL_TO_DRIVER);
		return  $res = $this->db->insert_batch(TABLES::$ASSIGN_HOSPITAL_TO_DRIVER,$param);
	}
	public function getclientbyrider()
	{
		$this->db->select('j.driver_id,j.name');
		$this->db->from ( TABLES::$HOSPITAL.' AS j' );
		$this->db->where("j.driver_id !=0");
		$this->db->order_by('driver_id','asc');
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
}