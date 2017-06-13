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
		$this->template->set_layout ('default')
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
		$this->load->library('dispatcher/HospitalLib');
		$customerlist = $this->hospitallib->getCustomerList ();
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
		$this->load->library('dispatcher/HospitalLib');
		$patientlist = $this->hospitallib->getPatientList ();
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
		$param = array();
		$param['user_role'] = 7;
		$param['client_id'] = $_SESSION['admin']['client_id'];
		$this->load->library('dispatcher/UserLibNew');
		$this->load->library('dispatcher/BranchLib');
		$hospital_list = $this->userlibnew->gettAllHospital ();
		$this->template->set ('hospitallist', $hospital_list );
		$branch_list = $this->branchlib->getAllBranch ($param);
		$this->template->set ('branchlist', $branch_list );
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
		if($_SESSION['admin']['user_role']==3 ||$_SESSION['admin']['user_role']==5 ||$_SESSION['admin']['user_role']==4)
		{
			$data['hospital_id'] = $this->input->post('hospital_id');
		}
		$data['client_id'] = $this->session->userdata('admin')['client_id'];
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
		$data['created_by'] =  $this->session->userdata('admin')['id'];
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
		$this->load->library('dispatcher/UserLibNew');
		$hospital_list = $this->userlibnew->gettAllHospital ();
		$this->template->set ('hospitallist', $hospital_list );
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
	
	public function driver_list (){
		
		$param = array();
		$param['user_role'] = 7;
		$param['client_id'] = $this->session->userdata('admin')['client_id'];
		$this->load->library('dispatcher/HospitalLib');
		$fieldworker_list = $this->hospitallib->getDriverList ($param);
		$this->template->set ( 'fieldworker_list', $fieldworker_list );
		$this->load->library('dispatcher/BranchLib');
		$branch_list = $this->branchlib->getAllBranch ($param);
		$this->template->set ('branchlist', $branch_list );
		$this->template->set ( 'page', 'Fieldworker List' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | User List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('fieldworker_list');
	}
	
	public function filter_driver_list (){
		$param = array();
		$param['user_role'] = 7;
		$param['branch_id'] = $this->input->post('branch_id');
		$param['client_id'] = $this->session->userdata('admin')['client_id'];
		$this->load->library('dispatcher/HospitalLib');
		$result = $this->hospitallib->getDriverList ($param);
		
		$i=0;
		$sr=1;
		$data = array();
		foreach($result as $row) {
			$data[$i]['id']=$row['id'];
			$data[$i]['sr']=$sr;
			
			if($row['first_name']!="" || $row['last_name']!="") 
				$data[$i]['name'] = $row['first_name']." ".$row['last_name']; 
			else 
				$data[$i]['name'] = "NA";
			
			if($row['mobile'] != "") 
				$data[$i]['mobile'] = $row['mobile']; 
			else 
				$data[$i]['mobile'] = "NA";
			
			if($row['email'] != "") 
				$data[$i]['email'] = $row['email']; 
			else 
				$data[$i]['email'] = "NA";
			
			if($row['role_name'] != "") 
				$data[$i]['role_name'] = $row['role_name']; 
			else 
				$data[$i]['role_name'] = "NA";
			
			if($row['verified'] == 1)
				$data[$i]['verified'] = "Verified";
			else 
				$data[$i]['verified'] = "Not Verified";
			
			if($row['job_id'] != "") 
				$data[$i]['job_id'] = getJobID($row['job_id']); 
			else 
				$data[$i]['job_id'] = "Not Assigned";
			
			if($row['branch_name'] != "") 
				$data[$i]['branch_name'] = $row['branch_name']; 
			else 
				$data[$i]['branch_name'] = "Not Assigned";
			
			if($row['start_date'] != "") 
				$data[$i]['start_date'] = date("d-m-Y",strtotime($row['start_date']))." ".date("g:i A",strtotime($row['start_time'])); 
			else 
				$data[$i]['start_date'] = "NA";
			
			if($row['end_date'] == 1)
				$data[$i]['end_date'] = date("d-m-Y",strtotime($row['end_date']))." ".date("g:i A",strtotime($row['end_time']));
			else 
				$data[$i]['end_date'] = "NA";
			$data[$i]['attendance']=$row['attendance'];
			
			if($row['hospital_assigned'] != "")
				$data[$i]['hospital_assigned'] = $row['hospital_assigned']; 
			else 
				echo "NA";
			$i++;
			$sr++;
		}
		echo json_encode($data);
	}
	
	public function edit_assign_hospital () {
		$param = array();
		$param['client_id'] = $this->session->userdata('admin')['client_id'];
		$field_worker_id = $this->input->post("field_worker_id");
		$this->template->set ( 'field_worker_id', $field_worker_id );
		$this->load->library('dispatcher/HospitalLib');
		$hospital = $this->hospitallib->getAllHospitalByClient ($param);
		$assigned_hospital = $this->hospitallib->getAssignedHospitalByDriverId ($field_worker_id);
		//print_r($assigned_hospital);
		$this->template->set ( 'assigned_hospital', $assigned_hospital );
		$this->template->set ( 'hospital', $hospital );
		$this->template->set ( 'hospital_assignment', 1 );
		
		
		$this->template->set_theme( 'default_theme' );
		$this->template->set_layout ( false)
		->title ( 'Dispatcher | hospital' );
		$this->template->build ( 'hospital_model',true );
	}
	
	public function assign_hospital_to_driver () {
		$this->load->library('dispatcher/HospitalLib');
		$hospital_array = $this->input->post('hospital_id');
		$driver_id = $this->input->post('driver_id');
		$this->hospitallib->resetDriverIDToZeroInHospital ($driver_id);
// 		print_r($hospital_array);
		// Code for assigning f=hospital to driver
		$hospital_count = count($hospital_array);
		if($hospital_count > 0)
		{
			
			$hospitals = array();
			for($i = 0; $i < $hospital_count; $i++){
				$hospital = array();
				$hospital['hospital_id'] = $hospital_array[$i];
				$hospital['driver_id'] = $driver_id;
				$hospitals[] = $hospital;
				
			}
			if(count($hospitals) > 0)
				$res = $this->hospitallib->assignDriverToHospital ($hospitals);
		}
		
		$resdata = array();
		if($res) {
			$resdata['status'] = 1;
			$resdata['msg'] = "Assigned successfully.";
		} else {
			$resdata['status'] = 0;
			$resdata['msg'] = "Error! Please check your data.";
		}
		echo json_encode($resdata);
	}
	
}