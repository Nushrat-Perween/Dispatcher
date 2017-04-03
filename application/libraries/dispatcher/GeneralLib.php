<?php
class GeneralLib {

	public function __construct() {
		$this->CI = & get_instance ();
	}

	public function getAllUserOfCompany ($company_id,$user_id) {
		$this->CI->load->model ( 'General_model', 'general' );
		$users = $this->CI->general->getAllUserOfCompany ( $company_id,$user_id );
		return $users;
	}
	
	public function getFieldWorkerByBranch ($company_id,$branch_id) {
		$this->CI->load->model ( 'General_model', 'general' );
		$users = $this->CI->general->getFieldWorkerByBranch ( $company_id,$branch_id );
		return $users;
	}
	
	/**
	 * Get Branch by company
	 *
	 * @return array
	 */
	public function getBranchByCompanyID ($company_id) {
		$this->CI->load->model ( 'General_model', 'general' );
		$users = $this->CI->general->getBranchByCompanyID ( $company_id );
		return $users;
	}

	public function updateUserById ($data) {
		$this->CI->load->model ( 'users/user_model', 'user' );
		$res = $this->CI->user->updateUserById ($data);
		return $res;
	}
	


}
