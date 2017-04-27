<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hospital extends MX_Controller {

	function __construct()
	{
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/FB.ini" );
	}
	
	public function index (){
		$this->load->library('dispatcher/HospitalLib');
		$data['client_id'] = $_SESSION['admin']['client_id'];
		$data['hospital_id'] = $_SESSION['admin']['hospital_id'];
		$data['created_date'] = date('Y-m-d');
		$joblist= $this->hospitallib->getAllJob ($data);
		$this->template->set ('joblist', $joblist );
		$this->template->set ( 'page', 'Job List' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Dispatcher | Job List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('client_job_list');
	}
	public function searchJobByDate (){
		$this->template->set ( 'page', 'Job List' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Dispatcher | Job List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('client_job_list');
	}
	
	public function getCustomerList ()
	{
		
		$this->load->library('dispatcher/HospitalLib');
		$customerlist = $this->hospitallib->getCustomerList ();
		$this->template->set ('customerlist', $customerlist );
		$this->template->set ( 'page', 'Job List' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Dispatcher | Job List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('client_customer_list');
	}
	
	public function getPatientList()
	{
		$this->load->library('dispatcher/HospitalLib');
		$patientlist = $this->hospitallib->getPatientList ();
		$this->template->set ('patientlist', $patientlist );
		$this->template->set ( 'page', 'Job List' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
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
		$this->template->set_layout ('backend')
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
		$this->template->set_layout ('backend')
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
		if($_SESSION['admin']['user_role']==3 ||$_SESSION['admin']['user_role']==5 ||$_SESSION['admin']['user_role']==4)
		{
			$data['hospital_id'] = $this->input->post('hospital_id');
		}
		$data['job_name'] = $this->input->post('jobname');
		$data['priority'] = $this->input->post('priority');
		$data['description'] = $this->input->post('jobdesc');
		$data['lookup_name'] = $this->input->post('jobname');
		$data['street'] = $this->input->post('street');
		$data['building'] = $this->input->post('building');
		$data['city_name'] = $this->input->post('city');
		$data['state_name'] = $this->input->post('state');
		$data['postalcode'] = $this->input->post('postalcode');
		$data['delivery_time'] = $this->input->post('delivery_time');
		$data['delivery_date'] = $this->input->post('delivery_date');
		$data['latitude'] = $this->input->post('latitude');
		$data['longitude'] = $this->input->post('longitude');
		$data['name'] = $this->input->post('pname');
		$data['first_name'] = $this->input->post('fname');
		$data['delivery_date'] = date('Y-m-d',strtotime($this->input->post('delivery_date')));
		$data['delivery_time'] = date('H:i:s',strtotime($this->input->post('delivery_time')));
		$data['last_name'] = $this->input->post('lname');
		$data['email'] = $this->input->post('email');
		$data['	mobile'] = $this->input->post('mobno');
		$data['room_no'] = $this->input->post('rnumber');
		$data['test'] = $this->input->post('tests');
		$data['caller'] = $this->input->post('caller');
		$data['latitude'] = $this->input->post('latitude');
		$data['longitude'] = $this->input->post('longitude');
		$data['special_instruction'] = $this->input->post('sintruction');
		$data['created_date'] = date('Y-m-d H:i:s');
		$data['created_by'] = $_SESSION['admin']['id'];
		//print_r($data);
		$this->load->library('dispatcher/HospitalLib');
		//print_r($data);
		$id = $this->hospitallib->clientSaveJob ($data);
		$userdata = array();
		if($id) {
			$userdata['id'] = $id;
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
		
		$this->load->library('dispatcher/HospitalLib');
		$job = $this->hospitallib->getJobById ($jobid);
		//print_r($job);
		$patient = $this->hospitallib->getPatientListByPatientId ($job[0]['patient_id']);
		//print_r($patient);
		$customer = $this->hospitallib->getCustomerListByCustomerId ($job[0]['job_contact_id']);
	//print_r($customer);
		$this->template->set ( 'patient', $patient );
		$this->template->set ( 'customer', $customer );
		$this->template->set ( 'job', $job );
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
		
		$patient = array();
		$contact = array();
		$job = array();
		$job['job_name'] = $this->input->post('jobname');
		$job['description'] = $this->input->post('jobdesc');
		$job['id'] = $this->input->post('job_id');
		$job['delivery_date'] = date('Y-m-d',strtotime($this->input->post('delivery_date')));
		$job['delivery_time'] = date('H:i:s',strtotime($this->input->post('delivery_time')));
		
		$contact['lookup_name'] = $this->input->post('lookupname');
		$contact['street'] = $this->input->post('street');
		$contact['building'] = $this->input->post('building');
		$contact['city_name'] = $this->input->post('city');
		$contact['state_name'] = $this->input->post('state');
		$contact['postalcode'] = $this->input->post('postalcode');
		$contact['latitude'] = $this->input->post('latitude');
		$contact['longitude'] = $this->input->post('longitude');
		$contact['last_name'] = $this->input->post('lname');
		$contact['email'] = $this->input->post('email');
		$contact['mobile'] = $this->input->post('mobno');
		$contact['first_name'] = $this->input->post('fname');
		$contact['id'] = $this->input->post('contact_id');
		
		
		$patient['name'] = $this->input->post('pname');
		$patient['room_no'] = $this->input->post('rnumber');
		$patient['test'] = $this->input->post('tests');
		$patient['caller'] = $this->input->post('caller');
		$patient['special_instruction'] = $this->input->post('sintruction');
		$patient['id'] = $this->input->post('patient_id');
		$this->load->library('dispatcher/HospitalLib');
		
		//print_r($data);
		$id = $this->hospitallib->updateJobClientById ($job);
		$id = $this->hospitallib->update_patient ($patient);
		$id = $this->hospitallib->update_contact ($contact);
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
		$this->load->library('dispatcher/HospitalLib');
		$joblist = $this->hospitallib->clientjobByMob ($data);
		//print_r($joblist);
		echo json_encode($joblist);
	}
	
	public function getCustomerListBydate()
	{
		$data['mobile']=$this->input->post('mobile_number');
		$data['from_date']= date('Y-m-d',strtotime($this->input->post('from_date')));
		$data['to_date']= date('Y-m-d',strtotime($this->input->post('to_date')));
		$data['client_id'] = $_SESSION['admin']['client_id'];
		$data['hospital_id'] = $_SESSION['admin']['hospital_id'];
		$this->load->library('dispatcher/HospitalLib');
		$customerlist = $this->hospitallib->getCustomerListBydate ($data);
		//print_r($joblist);
		echo json_encode($customerlist);
	}
	
	public function getPatientListBydate()
	{
		$data['mobile']=$this->input->post('mobile_number');
		$data['from_date']= date('Y-m-d',strtotime($this->input->post('from_date')));
		$data['to_date']= date('Y-m-d',strtotime($this->input->post('to_date')));
		$data['client_id'] = $_SESSION['admin']['client_id'];
		$data['hospital_id'] = $_SESSION['admin']['hospital_id'];
		$this->load->library('dispatcher/HospitalLib');
		$customerlist = $this->hospitallib->getPatientListBydate ($data);
		//print_r($joblist);
		echo json_encode($customerlist);
	}
	public function searchCity()
	{
		$data = $this->input->post('city');
		$this->load->library('dispatcher/HospitalLib');
		$city = $this->hospitallib->getCity ($data);
		$i=0;
		if (!empty($city))
		{
			
			foreach ($city as $row):
			$i++;
			echo "<div class='col-md-12' style='border-bottom:1px solid #aaa;padding:2px;cursor:pointer' id='div".$i."' onclick='fill(".$i.")'>". $row['name']." </div>";
			endforeach;
		}
		else
		{
			echo "<div class='col-md-12'> <em> Not found ... </em> </div>";
		}
	}
	
	public function searchState()
	{
		$data = $this->input->post('state');
		$this->load->library('dispatcher/HospitalLib');
		$state = $this->hospitallib->getState ($data);
		$i=0;
		if (!empty($state))
		{
				
			foreach ($state as $row):
			$i++;
			echo "<div class='col-md-12' style='border-bottom:1px solid #aaa;padding:2px;cursor:pointer' id='div1".$i."' onclick='fill1(".$i.")'>". $row['name']." </div>";
			endforeach;
		}
		else
		{
			echo "<div class='col-md-12'> <em> Not found ... </em> </div>";
		}
	}
	
	
	
}