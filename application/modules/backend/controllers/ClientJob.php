<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClientJob extends MX_Controller {

	function __construct()
	{
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/FB.ini" );
	}
	
	public function index (){
		$this->load->library('dispatcher/JobClientLib');
		$data['client_id'] = $_SESSION['admin']['client_id'];
		$data['hospital_id'] = $_SESSION['admin']['hospital_id'];
		$joblist= $this->jobclientlib->getAllJob ($data);
		$this->template->set ('joblist', $joblist );
		$this->template->set ( 'page', 'Job List' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Job List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('client_job_list');
	}
	public function job_list (){
		
		$this->template->set ( 'page', 'Job List' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Job List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
// 		$this->template->build ('client_job_list');
	}
	public function searchJobByDate (){
		$this->template->set ( 'page', 'Job List' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Job List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('client_job_list');
	}
	
	public function getCustomerList ()
	{
		
		$this->load->library('dispatcher/JobClientLib');
		$customerlist = $this->jobclientlib->getCustomerList ();
		$this->template->set ('customerlist', $customerlist );
		$this->template->set ( 'page', 'Job List' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Job List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('client_customer_list');
	}
	
	public function getPatientList()
	{
		$this->load->library('dispatcher/JobClientLib');
		$patientlist = $this->jobclientlib->getPatientList ();
		$this->template->set ('patientlist', $patientlist );
		$this->template->set ( 'page', 'Job List' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Job List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('patient_list');
		
	}
	
	public function addJob (){
		$this->load->library('dispatcher/UserLibNew');
		$hospital_list = $this->userlibnew->gettAllHospital ();
		$this->template->set ('hospitallist', $hospital_list );
		$this->template->set ( 'page', 'Job List' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Job List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('client_add_job');
	}
	
	public function report (){
		$this->template->set ( 'page', 'Job List' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Job List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('client_job_report');
	}
	
	public function clientSaveJob()
	{
		$data = array();
		$data['job_name'] = $this->input->post('jobname');
		$data['description'] = $this->input->post('jobdesc');
		$data['lookup_name'] = $this->input->post('jobname');
		$data['street'] = $this->input->post('street');
		$data['building'] = $this->input->post('building');
		$data['city_name'] = $this->input->post('city');
		$data['state_name'] = $this->input->post('state');
		$data['postalcode'] = $this->input->post('postalcode');
		$data['latitude'] = $this->input->post('latitude');
		$data['longitude'] = $this->input->post('longitude');
		$data['name'] = $this->input->post('pname');
		$data['first_name'] = $this->input->post('fname');
		$data['last_name'] = $this->input->post('lname');
		$data['email'] = $this->input->post('email');
		$data['	mobile'] = $this->input->post('mobno');
		$data['room_no'] = $this->input->post('rnumber');
		$data['test'] = $this->input->post('tests');
		$data['caller'] = $this->input->post('caller');
		$data['special_instruction'] = $this->input->post('sintruction');
		$data['created_date'] = date('Y-m-d H:i:s');
		$data['created_by'] = $_SESSION['admin']['id'];
		$this->load->library('dispatcher/JobClientLib');
		//print_r($data);
		$id = $this->jobclientlib->clientSaveJob ($data);
		$userdata = array();
		if($id) {
			$userdata['status'] = 1;
			$userdata['msg'] = "Job added successfully.";
		} else {
			$userdata['status'] = 0;
			$userdata['msg'] = "Error! Please check your data.";
		}
		echo json_encode($userdata);
	}
	
	public function edit_client_job($jobid)
	{
		
		$this->load->library('dispatcher/JobClientLib');
		$client = $this->jobclientlib->getjobClientById ($jobid);
		if($client)
		{
			$this->template->set ( 'jobclient', $client[0] );
		}
		$this->template->set ( 'page', 'User' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Edit User' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('edit_client_job');
	}
	
	public function updateJobClient()
	{
		$data = array();
		$data['job_name'] = $this->input->post('jobname');
		$data['first_name'] = $this->input->post('fname');
		$data['last_name'] = $this->input->post('lname');
		$data['	mobile'] = $this->input->post('contactno');
		$data['name'] = $this->input->post('patientname');
		$data['caller'] = $this->input->post('caller');
		$data['job_id'] = $this->input->post('job_id');
		$data['patient_id'] = $this->input->post('patient_id');
		$data['job_contact_id'] = $this->input->post('job_contact_id');
		
		$this->load->library('dispatcher/JobClientLib');
		
		//print_r($data);
		$id = $this->jobclientlib->updateJobClientById ($data);
		$userdata = array();
		if($id) {
			$userdata['status'] = 1;
			$userdata['msg'] = "Client Job updated successfully.";
		} else {
			$userdata['status'] = 0;
			$userdata['msg'] = "Error! Please check your data.";
		}
		echo json_encode($userdata);
	}
	
	public function clientjobByMob()
	{
		$data['mobile']=$this->input->post('mobile_number');
		$data['from_date']= date('Y-m-d',strtotime($this->input->post('from_date')));
		$data['to_date']= date('Y-m-d',strtotime($this->input->post('to_date')));
		$data['client_id'] = $_SESSION['admin']['client_id'];
		$data['hospital_id'] = $_SESSION['admin']['hospital_id'];
		$this->load->library('dispatcher/JobClientLib');
		$joblist = $this->jobclientlib->clientjobByMob ($data);
		//print_r($joblist);
		echo json_encode($joblist);
	}
	
}