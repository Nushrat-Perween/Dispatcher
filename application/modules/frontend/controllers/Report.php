<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MX_Controller {

	function __construct()
	{
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/FB.ini" );
	}

	/**
	 * call Login Page
	 */
	public function index(){
		$this->load->library('dispatcher/GeneralLib');
		$this->load->library('dispatcher/JobLib');
		$branch_list = $this->generallib->getBranchByCompanyID ($this->session->userdata('user')['company_id']);
		$job_status_list = $this->joblib->getJobStatusByCompanyID ($this->session->userdata('user')['company_id']);
		
		$job = $this->joblib->getJobList ();
		$this->template->set ( 'job', $job );
		$this->template->set ( 'branch_list', $branch_list );
		$this->template->set ( 'job_status_list', $job_status_list );
		$this->template->set ( 'page', 'Job List' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Job List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
	
		$this->template->build ('job_report');
	}
	
	public function jobs_by_branch () {
		$this->load->library('dispatcher/ReportLib');
		$this->load->library('dispatcher/GeneralLib');
		$this->load->library('dispatcher/JobLib');
		$branch_list = $this->generallib->getBranchByCompanyID ($this->session->userdata('user')['company_id']);
		$job_status_list = $this->joblib->getJobStatusByCompanyID ($this->session->userdata('user')['company_id']);
		
		$job = $this->joblib->getJobList ();
		$this->template->set ( 'job', $job );
		$this->template->set ( 'branch_list', $branch_list );
		$this->template->set ( 'job_status_list', $job_status_list );
		$currentmonthfirstdate = date('Y-m-01');
		$currentmonthlastdate = date('Y-m-d');
		$first_day = date('Y-m-d',strtotime($currentmonthfirstdate));
		$last_day = date('Y-m-d',strtotime($currentmonthlastdate));
		$params = array();
		$params['from_date'] = $first_day;
		$params['to_date'] = $last_day;
		$params['company_id'] = $this->session->userdata('user')['company_id'];
		$report = $this->reportlib->getJobReportByCompanyID ($params);
		
		foreach ($report as $row) {
			$created_date[] = $row['created_date'];
			$branch1[] = $row['branch1'];
			$branch2[] = $row['branch2'];
			$branch3[] = $row['branch3'];
		}
		array_unshift($created_date , 'created_date');
		array_unshift($branch1 , 'branch1');
		array_unshift($branch2 , 'branch2');
		array_unshift($branch3 , 'branch3');
		
		
		$this->template->set ( 'report', json_encode($report ));
		$this->template->set ( 'created_date', json_encode($created_date ));
		$this->template->set ( 'branch1', json_encode($branch1 ));
		$this->template->set ( 'branch2', json_encode($branch2 ));
		$this->template->set ( 'branch3', json_encode($branch3 ));
		$this->template->set ( 'page', 'Job' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Report Job' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('branch_report');
		
		
// 		$this->load->library('dispatcher/ReportLib');
// 		$this->load->library('dispatcher/GeneralLib');
// 		$this->load->library('dispatcher/JobLib');
// 		$branch_list = $this->generallib->getBranchByCompanyID ($this->session->userdata('user')['company_id']);
// 		$job_status_list = $this->joblib->getJobStatusByCompanyID ($this->session->userdata('user')['company_id']);
		
// 		$job = $this->joblib->getJobList ();
// 		$this->template->set ( 'job', $job );
// 		$this->template->set ( 'branch_list', $branch_list );
// 		$this->template->set ( 'job_status_list', $job_status_list );
// 		$currentmonthfirstdate = date('Y-m-01');
// 		$currentmonthlastdate = date('Y-m-d');
// 		$first_day = date('Y-m-d',strtotime($currentmonthfirstdate));
// 		$last_day = date('Y-m-d',strtotime($currentmonthlastdate));
// 		$params = array();
// 		$params['from_date'] = $first_day;
// 		$params['to_date'] = $last_day;
// 		$params['company_id'] = $this->session->userdata('user')['company_id'];
// 		$params['branch_id'] = $this->session->userdata('user')['branch_id'];
// 		$report = $this->reportlib->getJobReportByBranchID ($params);
		
		
		
// 		$this->template->set ( 'report', json_encode($report ));
// 		$this->template->set ( 'page', 'Job' );
// 		$this->template->set_theme('default_theme');
// 		$this->template->set_layout ('default')
// 		->title ( 'Dispatcher | Report Job' )
// 		->set_partial ( 'header', 'partials/header' )
// 		->set_partial ( 'side_menu', 'partials/side_menu' )
// 		->set_partial ( 'chat_model', 'partials/chat_model' )
// 		->set_partial ( 'footer', 'partials/footer' );
// 		$this->template->build ('branch_report');
	}
	
	public function filter_jobs_by_branch () {
		$params = array();
		$params = $this->input->post();
		$this->load->library('dispatcher/ReportLib');
		if($params['branch_id'] != "") {
			$report = $this->reportlib->filterJobReportByBranchID ($params);
		} else {
			$report = $this->reportlib->getJobReportByCompanyID ($params);
		}
		echo json_encode($report);
	}
    
    public function fieldworker_report () {
	    	$this->load->library('dispatcher/GeneralLib');
	    	$branch_list = $this->generallib->getBranchByCompanyID ($this->session->userdata('user')['company_id']);
	    	$this->template->set ( 'branch_list', $branch_list );
        $this->load->library('dispatcher/UserLib');
        $fieldworker_list = $this->userlib->getAllFieldworker ();
        $this->template->set ( 'fieldworker_list', $fieldworker_list );
        $this->template->set ( 'page', 'Field worker' );
        $this->template->set_theme('default_theme');
        $this->template->set_layout ('default')
        ->title ( 'Dispatcher | User List' )
        ->set_partial ( 'header', 'partials/header' )
        ->set_partial ( 'side_menu', 'partials/side_menu' )
        ->set_partial ( 'chat_model', 'partials/chat_model' )
        ->set_partial ( 'footer', 'partials/footer' );
        $this->template->build ('fieldworker_report');
    }
    
    public function filter_fieldworker () {
    	$params = array();
    	$params = $this->input->post();
    	$this->load->library('dispatcher/ReportLib');
    	$result = $this->reportlib->getFieldWorkerReport ($params);
    	$i=0;
    	$sr=1;
    	$data = array();
    	foreach($result as $row) {
    		$data[$i]['id']=$row['id'];
    		$data[$i]['user_id']= getUserID($row['id']);
    		$data[$i]['sr']=$sr;
    		$data[$i]['branch_id'] = $row['branch_id'];
    		
    		if($row['first_name']!="" || $row['last_name']!="") {
    			$data[$i]['name'] = $row['first_name']." ".$row['last_name']; 
    		} else 
    			$data[$i]['name'] = "NA";
    		
    		if($row['mobile'] != "") {
    			$data[$i]['mobile'] = $row['mobile']; 
    		} else 
    			$data[$i]['mobile'] =  "NA";
    		
    		if($row['group_name'] != "") 
    			$data[$i]['group_name'] = $row['group_name']; 
    		else 
    			$data[$i]['group_name'] =  "NA";
    		
    		if($row['branch_name'] != "") 
    			$data[$i]['branch_name'] = $row['branch_name']; 
    		else
    			$data[$i]['branch_name'] = "NA";
    		
    		if($row['verified'] == 1)
    			$data[$i]['verified'] = "Verified";
    		else
    			$data[$i]['verified'] = "Not Verified";
    		
    		 
    		$i++;
    		$sr++;
    								
    								
    	}
    	echo json_encode($data);
    }
    
}
