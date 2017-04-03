<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends MX_Controller {

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
		$this->load->library('dispatcher/JobLib');
		$this->load->library('dispatcher/GeneralLib');
		$joblastID = $this->joblib->getLastJobID ();
		$user_list = $this->generallib->getFieldWorkerByBranch ($this->session->userdata('user')['company_id'],$this->session->userdata('user')['branch_id']);
		$i=0;
		$data = array();
		foreach ($user_list as $row) {
			$data[$i]['value'] = $row['id'];
			$data[$i]['text'] = $row['first_name']." ".$row['last_name'];
			$i++;
		}
		$field_worker_list =  json_encode($data);
		$job_id = getLastJobID($joblastID[0]['id']);
		$this->template->set ( 'job_id', $job_id );
		//print_r($field_worker_list);
		$this->template->set ( 'response', $field_worker_list );
		$this->template->set ( 'page', 'Job' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Add Job' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('add_job');
	}

	 

	/**
	 * add new job
	 */
	public function add_job () {
		$data = array();
		$data = $this->input->post();
		//print_r($data);

		/**** Add Patient *****/
		$patient_data = $data['add_info'];
		$patient_data['company_id'] = $this->session->userdata('user')['company_id'];
		$patient_data['branch_id'] = $this->session->userdata('user')['branch_id'];
		$patient_data['group_id'] = $this->session->userdata('user')['group_id'];
		$patient_data['created_by'] = $this->session->userdata('user')['id'];
		$patient_data['created_date'] = date('Y-m-d H:i:s');
		$this->load->library('dispatcher/PatientLib');
		$patient_id = $this->patientlib->addPatient ($patient_data);
		$this->load->library('dispatcher/AreaLib');
		$this->load->library('dispatcher/JobLib');
		
		/**** Add Location *****/
		$location_data['company_id'] = $this->session->userdata('user')['company_id'];
		$location_data['branch_id'] = $this->session->userdata('user')['branch_id'];
		$location_data['group_id'] = $this->session->userdata('user')['group_id'];
		$location_data['location_name'] = $data['address']['location'];
		$exist_location_id = $this->arealib->getLocationExist ($location_data);
		if($exist_location_id == 0) {
			$location_id = $this->arealib->addLocation ($location_data);
		} else {
			$location_id = $exist_location_id;
		}

		/**** Add City *****/
		$city_data['company_id'] = $this->session->userdata('user')['company_id'];
		$city_data['branch_id'] = $this->session->userdata('user')['branch_id'];
		$city_data['group_id'] = $this->session->userdata('user')['group_id'];
		$city_data['city_name'] = $data['address']['city'];
		$exist_city_id = $this->arealib->getCityExist ($city_data);
		if($exist_city_id == 0) {
			$city_id = $this->arealib->addCity ($city_data);
		} else {
			$city_id = $exist_location_id;
		}

		/**** Add State *****/
		$state_data['company_id'] = $this->session->userdata('user')['company_id'];
		$state_data['branch_id'] = $this->session->userdata('user')['branch_id'];
		$state_data['group_id'] = $this->session->userdata('user')['group_id'];
		$state_data['state_name'] = $data['address']['state'];
		$exist_state_id = $this->arealib->getStateExist ($state_data);
		if($exist_state_id == 0) {
			$state_id = $this->arealib->addState ($state_data);
		} else {
			$state_id = $exist_state_id;
		}
		
		/**** Add PostalCode *****/
		$postal_code_data['company_id'] = $this->session->userdata('user')['company_id'];
		$postal_code_data['branch_id'] = $this->session->userdata('user')['branch_id'];
		$postal_code_data['group_id'] = $this->session->userdata('user')['group_id'];
		$postal_code_data['postal_code'] = $data['address']['postal_code'];
		$exist_postal_code_id = $this->arealib->getPostalCodeExist ($postal_code_data);
		if($exist_postal_code_id == 0) {
			$postal_code_id = $this->arealib->addPostalCode ($postal_code_data);
		} else {
			$postal_code_id = $exist_postal_code_id;
		}
		
		/**** Add Job Contact *****/
		$job_contact_data['company_id'] = $this->session->userdata('user')['company_id'];
		$job_contact_data['branch_id'] = $this->session->userdata('user')['branch_id'];
		$job_contact_data['group_id'] = $this->session->userdata('user')['group_id'];
		$job_contact_data['created_by'] = $this->session->userdata('user')['id'];
		$job_contact_data['created_date'] = date('Y-m-d H:i:s');
		$job_contact_data['first_name'] = $data['contact']['first_name'];
		$job_contact_data['last_name'] = $data['contact']['last_name'];
		$job_contact_data['mobile'] = $data['contact']['mobile'];
		$job_contact_data['email'] = $data['contact']['email'];
		$job_contact_data['street'] = $data['address']['street'];
		$job_contact_data['building'] = $data['address']['building'];
		$job_contact_data['latitude'] = $data['address']['latitude'];
		$job_contact_data['longitude'] = $data['address']['longitude'];
		$job_contact_data['city_id'] = $city_id;
		$job_contact_data['state_id'] = $state_id;
		$job_contact_data['location_id'] = $location_id;
		$job_contact_data['postal_code_id'] = $postal_code_id;
		$job_contact_id = $this->joblib->addJobContact ($job_contact_data);
		
		/**** Add Job Schedule *****/
// 		$job_schedule_data['company_id'] = $this->session->userdata('user')['company_id'];
// 		$job_schedule_data['branch_id'] = $this->session->userdata('user')['branch_id'];
// 		$job_schedule_data['group_id'] = $this->session->userdata('user')['group_id'];
		$job_schedule_data['created_by'] = $this->session->userdata('user')['id'];
		$job_schedule_data['created_date'] = date('Y-m-d H:i:s');
// 		$job_schedule_data = $data['assign_data'];
// 		$job_schedule_data['start_date'] = $data['assign_data']['start_date'].' '.$data['assign_data']['start_time'];
// 		$job_schedule_data['start_time'] = date('H:i:s',strtotime($data['assign_data']['start_time']));
// 		$job_schedule_data['end_date'] = date("Y-m-d H:i:s", strtotime($job_schedule_data['start_date'] . " +".$data['assign_data']['duration']." hours"));
// 		$job_schedule_data['end_time'] = date("H:i:s", strtotime($job_schedule_data['start_time'] . " +".$data['assign_data']['duration']." hours"));
		$job_schedule_id = $this->joblib->addAssignJob ($job_schedule_data);
		
		/**** Add Job *****/
		$job_data['company_id'] = $this->session->userdata('user')['company_id'];
		$job_data['branch_id'] = $this->session->userdata('user')['branch_id'];
		$job_data['company_name'] = $this->session->userdata('user')['company_name'];
		$job_data['branch_name'] = $this->session->userdata('user')['branch_name'];
		$job_data['group_id'] = $this->session->userdata('user')['group_id'];
		$job_data['created_by'] = $this->session->userdata('user')['id'];
		$job_data['created_date'] = date('Y-m-d H:i:s');
		$job_data['patient_id'] = $patient_id;
		$job_data['job_type_id'] = $data['data']['job_type_id'];
		$job_data['priority'] = $data['data']['priority'];
		$job_data['description'] = $data['data']['description'];
		$job_data['job_name'] = $data['data']['job_name'];
		//$job_data['job_id'] = $data['data']['job_id'];
		$job_data['send_job_to_mobile'] = $data['data']['send_job_to_mobile'];
		$job_data['job_assign_id'] = $job_schedule_id;
		$job_data['job_contact_id'] = $job_contact_id;
		$job_data['status_id'] = 1;
		
		
		$id = $this->joblib->addJob ($job_data);
		
		$userdata = array();
		if($id) {
			$update_job_data = array();
			$update_job_data['id'] = $id;
			$update_job_data['job_id'] = getJobID($id);
			$res = $this->joblib->updateJob ($update_job_data);
			$userdata['status'] = 1;
		}
		echo json_encode($userdata);
	}

	public function edit_job ($id){
	
		$this->template->set ( 'page', 'Job' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Edit Job' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('edit_job');
	}
	
	public function job_list (){
		$this->load->library('dispatcher/GeneralLib');
		$this->load->library('dispatcher/JobLib');
		$job_action_list = array();
		$branch_list = $this->generallib->getBranchByCompanyID ($this->session->userdata('user')['company_id']);
		$job_status_list = $this->joblib->getJobStatusByCompanyID ($this->session->userdata('user')['company_id']);
		$job_action_list = $this->joblib->getAllJobAction ();
		
		$job = $this->joblib->getJobList ();
		$this->template->set ( 'job', $job );
		$this->template->set ( 'branch_list', $branch_list );
		$this->template->set ( 'job_status_list', $job_status_list );
		$this->template->set ( 'job_action_list', $job_action_list );
		$this->template->set ( 'page', 'Job List' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Job List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('job_list');
	}
	
	public function filter_job () {
		$params = array();
		$params = $this->input->post();
		$params['is_deleted'] = 0;
		$this->load->library('dispatcher/JobLib');
		$result = $this->joblib->getFilterJob ($params);
		
		$i=0;
		$sr=1;
		$data = array();
		foreach($result as $row) {
			$data[$i]['id']=$row['id'];
			$data[$i]['sr']=$sr;
			$data[$i]['job_id'] = getJobID ($row['id']);
			if($row['created_date'] == '0000-00-00 00:00:00')
				$data[$i]['created_date'] = 'NA';
			else
				$data[$i]['created_date']=date('d-m-Y g:i A',strtotime($row['created_date']));
				
			if($row['start_date'] == '0000-00-00 00:00:00')
				$data[$i]['start_date'] = 'NA';
			else
				$data[$i]['start_date']=date('d-m-Y g:i A',strtotime($row['start_date']));
				
			if($row['end_date'] == '0000-00-00 00:00:00')
				$data[$i]['end_date'] = 'NA';
			else
				$data[$i]['end_date']=date('d-m-Y g:i A',strtotime($row['end_date']));
			$data[$i]['job_name']=$row['job_name'];
			if($row['assign_to'] == "" OR $row['assign_to'] == NULL) {
				$data[$i]['assign_to'] = "Not Assigned";
			} else {
				$data[$i]['assign_to'] = $row['assign_to'];
			}
			$data[$i]['field_worker_id']=$row['field_worker_id'];
			$data[$i]['job_assign_id']=$row['job_assign_id'];
			$data[$i]['branch_name']=$row['branch_name'];
			$data[$i]['company_name']=$row['company_name'];
			$data[$i]['status']=$row['status'];
			$data[$i]['action']=$row['action'];
			if($row['priority'] == 0) {
				$data[$i]['priority']="Low";
			} else if($row['priority'] == 1) {
				$data[$i]['priority']="Medium";
			} else if($row['priority'] == 2) {
				$data[$i]['priority']="Heigh";
			} else {
				$data[$i]['priority']="Not Define";
			}
		
			$i++;
			$sr++;
		}
		echo json_encode($data);
	}
	
	public function job_not_started (){
		$this->load->library('dispatcher/JobLib');
		$job = $this->joblib->getJobNotStarted ();
		$this->template->set ( 'job', $job );
		$this->template->set ( 'page', 'Job List' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Job List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('job_list');
	}
	
	public function job_detail ($id){
			
		$this->template->set ( 'page', 'Job Detail' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Job Detail' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('job_detail');
	}

	public function all_job_on_map (){
		$this->load->library('dispatcher/googlemaps');
		$config['center'] = '37.4419, -122.1419';
		$config['zoom'] = 'auto';
		$this->googlemaps->initialize($config);
	
		$marker = array();
		$marker['position'] = '37.429, -122.1519';
		$marker['infowindow_content'] = '1 - Hello World!';
		$marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|000000';
		$this->googlemaps->add_marker($marker);
	
		$marker = array();
		$marker['position'] = '37.409, -122.1319';
		$marker['draggable'] = TRUE;
		$marker['animation'] = 'DROP';
		$this->googlemaps->add_marker($marker);
	
		$marker = array();
		$marker['position'] = '37.449, -122.1419';
		$marker['onclick'] = 'alert("You just clicked me!!")';
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();
		$this->template->set ( 'map', $data);
		$this->template->set ( 'page', 'Job Detail' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Job Detail' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('all_job_on_map');
	}
	public function field_worker_route()
	{
		$this->load->library('dispatcher/googlemaps');
		$config['center'] = '37.4419, -122.1419';
		$config['zoom'] = 'auto';
		$this->googlemaps->initialize($config);
		$polyline = array();
		$polyline['points'] = array('37.429, -122.1319',
				'37.429, -122.1419',
				'37.4419, -122.1219');
		$this->googlemaps->add_polyline($polyline);
		$data['map'] = $this->googlemaps->create_map();
		$this->template->set ( 'map', $data);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('field_worker_route');
	}
	public function job_on_map()
	{
		$this->load->library('dispatcher/googlemaps');
		$config['center'] = '37.4419, -122.1419';
		$config['zoom'] = 'auto';
		$this->googlemaps->initialize($config);
		$polyline = array();
		$polyline['points'] = array('37.429, -122.1319',
				'37.429, -122.1419',
				'37.4419, -122.1219');
		$this->googlemaps->add_polyline($polyline);
		$data['map'] = $this->googlemaps->create_map();
		$this->template->set ( 'map', $data);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('job_on_map');
	}
	public function job_direction()
	{
		$this->load->library('dispatcher/googlemaps');
		$config['center'] = '37.4419, -122.1419';
		$config['zoom'] = 'auto';
		$config['directions'] = TRUE;
		$config['directionsStart'] = 'empire state building';
		$config['directionsEnd'] = 'statue of liberty';
		$config['directionsDivID'] = 'directionsDiv';
		$this->googlemaps->initialize($config);
		$data['map'] = $this->googlemaps->create_map();
		$this->template->set ( 'map', $data);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('direction');
	}
	public function job_street()
	{
		$this->load->library('dispatcher/googlemaps');
		$config['center'] = '18.5883366, 73.78399460000003';
		$config['map_type'] = 'STREET';
		$config['streetViewPovHeading'] = 90;
		$this->googlemaps->initialize($config);
		$data['map'] = $this->googlemaps->create_map();
		$this->template->set ( 'map', $data);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('street');
	}
	public function job_location ()
	{
		$this->load->library('dispatcher/googlemaps');
		$config['center'] = '37.4419, -122.1419';
		$this->googlemaps->initialize($config);
		$marker = array();
		$marker['position'] = '37.449, -122.1419';
		$marker['icon'] = base_url().'assets/images/bike.png';
		$marker['infowindow_content'] = 'Current Status';
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();
		$this->template->set ( 'map', $data);
		$this->template->set ( 'page', 'Job Detail' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Job Detail' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('job_location');
	}
	function get_distance($lat1 = 37.429, $lat2 = 37.4419, $long1 = -122.1419, $long2 = -122.1219)
	{
		$url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&language=pl-PL";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);
		curl_close($ch);
		$response_a = json_decode($response, true);
		$dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
		$time = $response_a['rows'][0]['elements'][0]['duration']['text'];
	
		return array('distance' => $dist, 'time' => $time);
	}
	 
}

?>
