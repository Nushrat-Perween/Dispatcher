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

}