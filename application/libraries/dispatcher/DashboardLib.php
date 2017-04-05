<?php
class DashboardLib {

	public function __construct() {
		$this->CI = & get_instance ();
	}
/**
 * Get Job status by company
 *
 * @return array
 */
public function getCountOfJobActionsByCompanyID ($company_id) {
	$this->CI->load->model ( 'Dashboard_model', 'dashboard' );
	$data = $this->CI->dashboard->getCountOfJobActionsByCompanyID ($company_id);
	return $data;
}

/**
 * Get Job status by company
 *
 * @return array
 */
public function getCountOfAllBranchJobStatusByCompanyID ($company_id) {
	$this->CI->load->model ( 'Dashboard_model', 'dashboard' );
	$data = $this->CI->dashboard->getCountOfAllBranchJobStatusByCompanyID ($company_id);
	return $data;
}

/**
 * Get Job status 
 *
 * @return array
 */
public function getCountOfAllJobActions () {
	$this->CI->load->model ( 'Dashboard_model', 'dashboard' );
	$data = $this->CI->dashboard->getCountOfAllJobActions ();
	return $data;
}

/**
 * Get Job status 
 *
 * @return array
 */
public function getCountOfAllBranchJobStatus () {
	$this->CI->load->model ( 'Dashboard_model', 'dashboard' );
	$data = $this->CI->dashboard->getCountOfAllBranchJobStatus ();
	return $data;
}

public function getAllJobByHospitalId($data)
{
	$hospital_id = $_SESSION['admin']['hospital_id'];
	//echo $client_id;
	$this->CI->load->model ( 'Dashboard_model', 'dashboard' );
	$data = $this->CI->dashboard->getAllJobByClientId ($data);
	return $data;
}
public function getNewJobByHospitalId($data)
{
	$this->CI->load->model ( 'Dashboard_model', 'dashboard' );
	$newjob = $this->CI->dashboard->getNewJobByHospitalId ($data);
	return $newjob;
}

public function getPendingJobByHospitalId($data)
{
	$this->CI->load->model ( 'Dashboard_model', 'dashboard' );
	$pendingjob = $this->CI->dashboard->getPendingJobByHospitalId ($data);
	return $pendingjob;
}

public function getCompletedJobByHospitalId($data)
{
	$this->CI->load->model ( 'Dashboard_model', 'dashboard' );
	$completedjob = $this->CI->dashboard->getCompletedJobByHospitalId ($data);
	return $completedjob;
}

public function getCancelJobByHospitalId($data)
{
	
	$this->CI->load->model ( 'Dashboard_model', 'dashboard' );
	$completedjob = $this->CI->dashboard->getCancelJobByHospitalId ($data);
	return $completedjob;
}
public function getAllJobDetailByClientId($data)
{
	$this->CI->load->model ( 'Dashboard_model', 'dashboard' );
	$completedjob = $this->CI->dashboard->getAllJobDetailByClientId ($data);
	return $completedjob;
}

public function getTotalClientByClientId($data)
{
	$this->CI->load->model ( 'Dashboard_model', 'dashboard' );
	$completedjob = $this->CI->dashboard->getTotalClientByClientId ($data);
	return $completedjob;
}
public function getNewClientByClientId($data)
{
	$this->CI->load->model ( 'Dashboard_model', 'dashboard' );
	$completedjob = $this->CI->dashboard->getNewClientByClientId ($data);
	return $completedjob;
}
}