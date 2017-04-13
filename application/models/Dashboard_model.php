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

   public function getAllJobByClientId($data)
   {
   	    //echo $hospital_id;
   		$this->db->select ( 'count(id) as total_job' )->from ( TABLES::$JOB);
   		$this->db->where('hospital_id',$data['hospital_id']);
   		$query = $this->db->get ();
   		$result = $query->result_array ();
   		return $result;
   }

   public function getNewJobByHospitalId($data)
   {
   	//echo $hospital_id;
   	$this->db->select ( 'count(id) as new_job' )->from ( TABLES::$JOB);
   	$this->db->where('hospital_id',$data['hospital_id']);
   	$this->db->where('date(created_date)',$data['current_date']);
   	$query = $this->db->get ();
   	$result = $query->result_array ();
   	return $result;
   }
   public function getPendingJobByHospitalId($data)
   {
   	//echo $hospital_id;
   	$this->db->select ( 'count(id) as pending_job' )->from ( TABLES::$JOB);
   	$this->db->where('hospital_id',$data['hospital_id']);
   	$this->db->where('status',0);
   	$query = $this->db->get ();
   	$result = $query->result_array ();
   	return $result;
   }
   
   
   public function getCompletedJobByHospitalId($data)
   {
   	//echo $hospital_id;
   	$this->db->select ( 'count(id) as completed_job' )->from ( TABLES::$JOB);
   	$this->db->where('hospital_id',$data['hospital_id']);
   	$this->db->where('status',1);
   	$query = $this->db->get ();
   	$result = $query->result_array ();
   	return $result;
   }
   
   public function getCancelJobByHospitalId($data)
   {
   	//echo $hospital_id;
   	$this->db->select ( 'count(id) as cancel_job' )->from ( TABLES::$JOB);
   	$this->db->where('hospital_id',$data['hospital_id']);
   	$this->db->where('status',2);
   	$query = $this->db->get ();
   	$result = $query->result_array ();
   	return $result;
   }
   public function getAllJobDetailByClientId($data)
   {
   	//print_r($data['client_id']);
   	$this->db->select('sum(if(status=1,1,0)) as completed_job,count(id) as total_job, sum(if(status=2,1,0)) as cancel_job, sum(if(status =0,1,0)) as pendin_job,sum(if(action_id=1,1,0)) as not_started_job,sum(if(action_id=2,1,0)) as accepted_job,sum(if(action_id=3,1,0)) as in_route_job,sum(if(action_id=4,1,0)) as arrived_job,sum(if(action_id=5,1,0)) as departed_job,sum(if(action_id=6,1,0)) as droppedof_job,sum(if(action_id=7,1,0)) as submitted_job,sum(if(priority=0,1,0)) as am,sum(if(priority=1,1,0)) as timed,sum(if(priority=2,1,0)) as stat,',false);
   	$this->db->from(TABLES :: $JOB);
   	$this->db->where('client_id',$data['client_id']);
   	$this->db->group_by('client_id');
   	$query = $this->db->get ();
   	$result = $query->result_array ();
   	return $result;
   }
    
   public function getTotalClientByClientId($data)
   {
   	//echo $hospital_id;
   	$this->db->select ( 'count(client_id) as total_client' )->from ( TABLES::$ADMIN);
   	$this->db->where('client_id',$data['client_id']);
   	$this->db->where('user_role',6);
   	$query = $this->db->get ();
   	$result = $query->result_array ();
   	return $result;
   }
    
   public function getNewClientByClientId($data)
   {
   	//echo $hospital_id;
   	$data['current_date'];
   	$this->db->select ( 'count(client_id) as new_client' )->from ( TABLES::$ADMIN);
   	$this->db->where('client_id',$data['client_id']);
   	$this->db->where('user_role',6);
   	$this->db->where('date(created_date)',$data['current_date']);
   	$query = $this->db->get ();
   	$result = $query->result_array ();
   	return $result;
   }
}