<?php
class Area extends MX_Controller {
	public function __construct() {
		parent::__construct ();
		$current_lang = $this->session->userdata('my_lang');
		if(!$current_lang) {
			$current_lang = 'english';
			$this->session->set_userdata('my_lang','english');
		}
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$this->load->helper('mylang');
		$this->lang->load($current_lang.'_home_page_lang', $current_lang);
		$fb_config = parse_ini_file ( APPPATH . "config/FB.ini" );
	}

	public function add_city () {
		
		$this->template->set ( 'page', 'City' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Dispatcher | City' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('add_city');
	}
	
	public function add_locality () {
		
		$this->load->library('dispatcher/AreaLib');
		$city = $this->arealib->getAllCity ();
		$this->template->set ( 'city', $city );
		$this->template->set ( 'page', 'Locality' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Dispatcher | Locality' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('add_locality');
	}
	
	public function add_zone () {
		$this->load->library('dispatcher/AreaLib');
		$city = $this->arealib->getAllCity ();
		$this->template->set ( 'city', $city );
		$this->template->set ( 'page', 'Zone' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Dispatcher | Zone' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('add_zone');
	}


	public function save_city () {
		$param = array();
		$param = $this->input->post('data');
		$param['is_active'] = 1;
		$param['created_by'] = $this->session->userdata('admin')['id'];
		$param['created_date'] = date('Y-m-d H:i:s');
		$this->load->library('dispatcher/AreaLib');
		$id = $this->arealib->addCity ($param);
		$response = array();
		if($id) {
			$response['status'] = 1;
			$response['msg'] = "City added successfully.";
		} else {
			$response['status'] = 0;
			$response['msg'] = "Error! Please check your data.";
		}
		echo json_encode($response);
	}
	
	public function save_locality () {
		$param = array();
		$param = $this->input->post('data');
		//$param['is_active'] = 1;
		$param['created_by'] = $this->session->userdata('admin')['id'];
		$param['created_date'] = date('Y-m-d H:i:s');
		$this->load->library('dispatcher/AreaLib');
		$id = $this->arealib->saveLocality ($param);
		$response = array();
		if($id) {
			$response['status'] = 1;
			$response['msg'] = "Locality added successfully.";
		} else {
			$response['status'] = 0;
			$response['msg'] = "Error! Please check your data.";
		}
		echo json_encode($response);
		
	}
	
	public function save_zone () {
		$param = array();
		$param = $this->input->post('data');
		$param['status'] = 1;
		$param['created_by'] = $this->session->userdata('admin')['id'];
		$param['created_date'] = date('Y-m-d H:i:s');
		$this->load->library('dispatcher/AreaLib');
		$id = $this->arealib->saveZone ($param);
		$response = array();
		if($id) {
			$response['status'] = 1;
			$response['msg'] = "Zone added successfully.";
		} else {
			$response['status'] = 0;
			$response['msg'] = "Error! Please check your data.";
		}
		echo json_encode($response);
		
	}

	public function city_list (){
		$this->load->library('dispatcher/AreaLib');
		$city = $this->arealib->getAllCity ();
		$this->template->set ( 'city_list', $city );
		$this->template->set ( 'page', 'City' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Dispatcher | City' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('city_list');
	}
	public function locality_list (){
		$this->load->library('dispatcher/AreaLib');
		$locality = $this->arealib->getAllLocality ();
		$this->template->set ( 'locality_list', $locality );
		$this->template->set ( 'page', 'Locality' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Dispatcher | Locality' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('locality_list');
	}
	
	public function zone_list (){
		$this->load->library('dispatcher/AreaLib');
		$zone = $this->arealib->getAllZone ();
		$this->template->set ( 'zone_list', $zone );
		$this->template->set ( 'page', 'Zone' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Dispatcher | Zone' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('zone_list');
	}
	
	public function assign_zone_area () {
		$this->load->library('dispatcher/AreaLib');
		$zone = $this->arealib->getAllZone ();
		$this->template->set ( 'zone', $zone );
		$locality = $this->arealib->getAllLocality ();
		$this->template->set ( 'locality', $locality );
		$city = $this->arealib->getAllCity ();
		$this->template->set ( 'city', $city );
		$this->template->set ( 'page', 'Zone' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Dispatcher | Zone' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('assign_zone_area');
	}
	
	public function save_assigned_zone_area () {
		$param = array();
		$param = $this->input->post('data');
		//$param['is_active'] = 1;
		$param['updated_by'] = $this->session->userdata('admin')['id'];
		$param['updated_date'] = date('Y-m-d H:i:s');
		$this->load->library('dispatcher/AreaLib');
		$res = $this->arealib->updateLocality ($param);
		$response = array();
		if($res) {
			$response['status'] = 1;
			$response['msg'] = "Locality assigned successfully.";
		} else {
			$response['status'] = 0;
			$response['msg'] = "Error! Please check your data.";
		}
		echo json_encode($response);
	}

	public function edit_city ($id) {
		$this->load->library('dispatcher/AreaLib');
		$city = $this->arealib->getCityByID($id);
		if(count($city)) {
		$this->template->set ( 'city', $city[0] );
		}
		$this->template->set ( 'page', 'City' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Dispatcher | City' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('add_city');
	}
	
	public function edit_locality ($id) {
	
		$this->load->library('dispatcher/AreaLib');
		$city = $this->arealib->getAllCity ();
		$this->template->set ( 'city', $city );
		$locality = $this->arealib->getLocalityByID($id);
		if(count($locality)) {
		$this->template->set ( 'locality', $locality[0] );
		}
		$this->template->set ( 'page', 'Locality' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Dispatcher | Locality' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('add_locality');
	}
	
	public function edit_zone ($id) {
		$this->load->library('dispatcher/AreaLib');
		$city = $this->arealib->getAllCity ();
		$this->template->set ( 'city', $city );
		$zone = $this->arealib->getZoneByID($id);
		if(count($zone)) {
		$this->template->set ( 'zone', $zone[0] );
		}
		$this->template->set ( 'page', 'Zone' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Dispatcher | Zone' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('add_zone');
	}
	
	public function update_city () {
		$param = array();
		$param = $this->input->post('data');
		//$param['is_active'] = 1;
		$param['updated_by'] = $this->session->userdata('admin')['id'];
		$param['updated_date'] = date('Y-m-d H:i:s');
		$this->load->library('dispatcher/AreaLib');
		$res = $this->arealib->updateCity ($param);
		$response = array();
		if($res) {
			$response['status'] = 1;
			$response['msg'] = "City updated successfully.";
		} else {
			$response['status'] = 0;
			$response['msg'] = "Error! Please check your data.";
		}
		echo json_encode($response);
	}
	public function update_locality () {
		$param = array();
		$param = $this->input->post('data');
		//$param['is_active'] = 1;
		$param['updated_by'] = $this->session->userdata('admin')['id'];
		$param['updated_date'] = date('Y-m-d H:i:s');
		$this->load->library('dispatcher/AreaLib');
		$res = $this->arealib->updateLocality ($param);
		$response = array();
		if($res) {
			$response['status'] = 1;
			$response['msg'] = "Locality updated successfully.";
		} else {
			$response['status'] = 0;
			$response['msg'] = "Error! Please check your data.";
		}
		echo json_encode($response);
	}
	
	public function update_zone () {
		$param = array();
		$param = $this->input->post('data');
		//$param['is_active'] = 1;
		$param['updated_by'] = $this->session->userdata('admin')['id'];
		$param['updated_date'] = date('Y-m-d H:i:s');
		$this->load->library('dispatcher/AreaLib');
		$res = $this->arealib->updateZone ($param);
		$response = array();
		if($res) {
			$response['status'] = 1;
			$response['msg'] = "Zone updated successfully.";
		} else {
			$response['status'] = 0;
			$response['msg'] = "Error! Please check your data.";
		}
		echo json_encode($response);
	}
	
	

}
