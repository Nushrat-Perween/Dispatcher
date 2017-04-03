<?php
class ReportLib {

	public function __construct() {
		$this->CI = & get_instance ();
	}

	public function getCutomerReport () {
		$this->CI->load->model ( 'Report_model', 'report' );
		$report = $this->CI->report->getCutomerReport ( );
		return $report;
	}
	public function getJobByCustomer () {
		$this->CI->load->model ( 'Report_model', 'report' );
		$report = $this->CI->report->getJobByCustomer ( );
		return $report;
	}
	
}