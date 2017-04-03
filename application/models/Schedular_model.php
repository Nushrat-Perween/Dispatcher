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
 * @author Rohit Singh
 * @category CI_Model API
 */
class Schedular_model extends CI_Model {

	function __construct() {
		parent::__construct ();
	}

	public function getSchedule ($company_id,$branch_id)
	{
		$this->db->select('a.id as title,b.start_date ,b.end_date')->from(TABLES::$JOB.' AS a')
		 ->join(TABLES::$ASSIGN_JOB.' AS b',' a.job_assign_id = b.id','inner')
		->where('company_id',$company_id)
		->where('branch_id',$branch_id);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function updateScheduleTime($data)
	{
		$this->db->select('job_assign_id')->from(TABLES::$JOB.' AS a')
		->where('id',$data['job_id']);
		$query = $this->db->get();
		$result = $query->result_array();
		$this->db->where('id',$result[0]['job_assign_id']);
		unset($data['job_id']);
		$this->db->update(TABLES::$ASSIGN_JOB,$data);
		return 1;
	}




}

