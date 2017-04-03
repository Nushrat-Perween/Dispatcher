<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends MX_Controller {

	function __construct()
	{
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/FB.ini" );
	}
	
	public function index()
	{
		$this->load->library('dispatcher/ClientLib');
		$client_list = $this->clientlib->getAllClient ();
		$this->template->set ( 'client_list', $client_list );
		$this->template->set ( 'page', 'User List' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | User List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('clientlist');
	}

	public function add_client()
	{
		$password=mt_rand(100000,999999);
		$data['text_password'] = $password;
		$this->load->library('dispatcher/PackageLib');
		$package = $this->packagelib->getAllPackage ();
	
		$this->template->set ('password',$data);
		$this->template->set ('package',$package);
		$this->template->set ( 'page', 'User' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Add User' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('client');
	}
	
	public function save_client()
	{
		$data = array();
		$data = $this->input->post('data');
		$data['created_date'] = date('Y-m-d H:i:s');
		$data['created_by'] = $_SESSION['admin']['id'];
		$data['user_role'] = 3;
		$data['text_password'] = $data['password'];
		$data['password'] = md5($data['password']);
		$data['latitude'] = $this->input->post('latitude');
		$data['longitude'] = $this->input->post('longitude');
		$this->load->library('dispatcher/ClientLib');
		//print_r($data);
		$id = $this->clientlib->save_client ($data);
		$userdata = array();
		if($id) {
			$userdata['status'] = 1;
			$userdata['msg'] = "Client added successfully.";
		} else {
			$userdata['status'] = 0;
			$userdata['msg'] = "Error! Please check your data.";
		}
		echo json_encode($userdata);
	}
	
	public function edit_client($id)
	{
		
		$this->load->library('dispatcher/PackageLib');
		$package = $this->packagelib->getAllPackage ();
		
	
		$this->load->library('dispatcher/ClientLib');
		$client = $this->clientlib->getClientById ($id);
		if($client)
		{
			$this->template->set ( 'client', $client[0] );
		}
		$this->template->set ('package',$package);
		$this->template->set ( 'page', 'User' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Edit User' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('editclient');
	}
	
	public function update_client()
	{
		$data = array();
		$data = $this->input->post('data');
		$this->load->library('dispatcher/ClientLib');
		
		//print_r($data);
		$id = $this->clientlib->updateClientById ($data);
		$userdata = array();
		if($id) {
			$userdata['status'] = 1;
			$userdata['msg'] = "Client updated successfully.";
		} else {
			$userdata['status'] = 0;
			$userdata['msg'] = "Error! Please check your data.";
		}
		echo json_encode($userdata);
	}

}

?>