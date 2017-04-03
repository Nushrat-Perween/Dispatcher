<?php
class SchedularLib {

	public function __construct() {
		$this->CI = & get_instance ();
	}

	public function getSchedule ($company_id,$branch_id) {
		$this->CI->load->model ( 'Schedular_model', 'schedular' );
		$users = $this->CI->schedular->getSchedule ( $company_id,$branch_id );
		
		return $users;
	}
	
	public function updateScheduleTime ($data) {
		$this->CI->load->model ( 'Schedular_model', 'schedular' );
		$res =  $this->CI->schedular->updateScheduleTime ($data);
		return $res;
	}


}
