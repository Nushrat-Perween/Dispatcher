<?php
class BranchLib {

	public function __construct() {
		$this->CI = & get_instance ();
	}


	public function getAllBranch ($param) {
		$this->CI->load->model ( 'Branch_model', 'branch' );
		$res = $this->CI->branch->getAllBranch ( $param );
		return $res;
	}

	public function addBranch ($param) {
		$this->CI->load->model ( 'Branch_model', 'branch' );
		$res = $this->CI->branch->addBranch ( $param );
		return $res;
	}
	
	public function getBranchByID ($id) {
		$this->CI->load->model ( 'Branch_model', 'branch' );
		$res = $this->CI->branch->getBranchByID ( $id );
		return $res;
	}

	public function updateBranch ($param) {
		$this->CI->load->model ( 'Branch_model', 'branch' );
		$res = $this->CI->branch->updateBranch ( $param );
		return $res;
	}


}
