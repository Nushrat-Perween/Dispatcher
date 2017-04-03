<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class schedular extends MX_Controller {
	 
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
   		$userdata = $this->session->userdata('user');
		$this->load->library('dispatcher/SchedularLib');
	   	$schedule = $this->schedularlib->getSchedule ($userdata['company_id'],$userdata['branch_id']);
		//print_r($_SESSION);
		//echo json_encode($schedule);
		$this->template->set ( 'schedule', $schedule);
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('schedular');
   	}
	public function updateScheduleTime()
	{
		$data = array();
		$data['end_date'] = $this->input->post('end_date');
		$data['start_date'] = $this->input->post('start_date');
		$data['job_id'] = $this->input->post('id');
		$this->load->library('dispatcher/SchedularLib');
	   	$schedule = $this->schedularlib->updateScheduleTime ($data);
		$data['status'] = 1;
		echo json_encode($data);
	}
	public function jobOnMap()
	{
		
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
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('job_on_map');
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
	public function direction()
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
	public function street()
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
	public function directionplace()
	{

		if($this->input->post(‘submit’))
		{
		$this->load->library(‘googlemaps’);
		$config['zoom'] = 'auto';
		$config['directions'] = TRUE;
		$config['directionsStart'] = $this->input->post('place1');
		$config['directionsEnd'] =  $this->input->post('place2');
		$config['directionsDivID'] = 'directionsDiv';
		$this->googlemaps->initialize($config);
		$data[‘map’] = $this->googlemaps->create_map();
		$this->load->view('direction_view', $data);
		}
		else
		{
		$data['map']=false;
		$this->load->view('direction_view',$data);
		}

	}
	
 }