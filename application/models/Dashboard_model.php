<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

/**
 * Dashboard model
 *
 * <p>
 * We are using this model to display all analysis of every thing.
 * </p>
 *
 * @package Dashboard
 * @author Nushrat
 * @copyright Copyright &copy; 2015, Dispatcher
 * @category CI_Model API
 */
class Dashboard_model extends CI_Model {

	function __construct() {
		parent::__construct ();
	}



	public function getCountOfJobActionsByCompanyID ($company_id)
	{
		
		$this->db->select ( 'ja.id as action_id,ja.action,(SELECT count(j.id) FROM tbl_job as j WHERE ja.id = j.action_id AND j.is_deleted =0 AND j.company_id = '.$company_id.') as number_count' );
		$this->db->from ( TABLES::$JOB_ACTION. ' AS ja');
		$this->db->where ( 'ja.company_id', $company_id );
		$this->db->where ( 'ja.is_deleted', 0 );
		$query = $this->db->get ();
	//	echo $this->db->last_query ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getCountOfAllBranchJobStatusByCompanyID ($company_id)
	{
		
		$this->db->select ( 'b.id as branch_id,b.branch_name,
				(SELECT count(j.id) FROM tbl_job as j WHERE j.status_id = 1 AND j.is_deleted =0 AND j.branch_id = b.id) as not_assigned , 
				(SELECT count(j.id) FROM tbl_job as j WHERE j.status_id = 2 AND j.is_deleted =0 AND j.branch_id = b.id) as cancel ,
				(SELECT count(j.id) FROM tbl_job as j WHERE j.status_id = 3 AND j.is_deleted =0 AND j.branch_id = b.id) as pending ,
				(SELECT count(j.id) FROM tbl_job as j WHERE j.status_id = 4 AND j.is_deleted =0 AND j.branch_id = b.id) as in_route,
				(SELECT count(j.id) FROM tbl_job as j WHERE j.status_id = 5 AND j.is_deleted =0 AND j.branch_id = b.id) as completed' );
		$this->db->from ( TABLES::$BRANCH. ' AS b');
		$this->db->where ( 'b.company_id', $company_id );
		$this->db->where ( 'b.is_deleted', 0 );
		$query = $this->db->get ();
	//	echo $this->db->last_query ();
		$result = $query->result_array ();
		return $result;
		
	}
	
	public function getCountOfAllJobActions ()
	{
		
		$this->db->select ( 'ja.id as action_id,ja.action,(SELECT count(j.id) FROM tbl_job as j WHERE ja.id = j.action_id AND j.is_deleted =0 ) as number_count' );
		$this->db->from ( TABLES::$JOB_ACTION. ' AS ja');
		$this->db->where ( 'ja.is_deleted', 0 );
		$query = $this->db->get ();
	//	echo $this->db->last_query ();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getCountOfAllBranchJobStatus ()
	{
		
		$this->db->select ( 'b.id as branch_id,b.branch_name,
				(SELECT count(j.id) FROM tbl_job as j WHERE j.status_id = 1 AND j.is_deleted =0 AND j.branch_id = b.id) as not_assigned , 
				(SELECT count(j.id) FROM tbl_job as j WHERE j.status_id = 2 AND j.is_deleted =0 AND j.branch_id = b.id) as cancel ,
				(SELECT count(j.id) FROM tbl_job as j WHERE j.status_id = 3 AND j.is_deleted =0 AND j.branch_id = b.id) as pending ,
				(SELECT count(j.id) FROM tbl_job as j WHERE j.status_id = 4 AND j.is_deleted =0 AND j.branch_id = b.id) as in_route,
				(SELECT count(j.id) FROM tbl_job as j WHERE j.status_id = 5 AND j.is_deleted =0 AND j.branch_id = b.id) as completed' );
		$this->db->from ( TABLES::$BRANCH. ' AS b');
		$this->db->where ( 'b.is_deleted', 0 );
		$query = $this->db->get ();
	//	echo $this->db->last_query ();
		$result = $query->result_array ();
		return $result;
		
	}





}

