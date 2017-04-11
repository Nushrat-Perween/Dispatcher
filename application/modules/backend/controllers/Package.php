<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends MX_Controller {

	function __construct()
	{
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/FB.ini" );
	}
	
	public function index()
	{
		$this->load->library('dispatcher/PackageLib');
		$package_list = $this->packagelib->getAllPackage ();
		$this->template->set ( 'package_list', $package_list );
		$this->template->set ( 'page', 'User List' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | User List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('package_list');
	}

	public function add_package()
	{
			
		$this->template->set ( 'page', 'User' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Add User' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('add_package');
	}
	
	
	public function save_package()
	{
		$data = array();
		$data = $this->input->post('data');
		$data['created_date'] = date('Y-m-d H:i:s');
		$this->load->library('dispatcher/PackageLib');
		//print_r($data);
		$id = $this->packagelib->save_package ($data);
		$userdata = array();
		if($id) {
			$userdata['status'] = 1;
			$userdata['msg'] = "User added successfully.";
		} else {
			$userdata['status'] = 0;
			$userdata['msg'] = "Error! Please check your data.";
		}
		echo json_encode($userdata);
	}
	public function edit_package($id)
	{
		
		$this->load->library('dispatcher/PackageLib');
		$package = $this->packagelib->getPackageById ($id);
		//print_r($package).'mukesh';
		if($package)
		{
			$this->template->set ( 'package', $package[0] );
		}
		$this->template->set ( 'page', 'User' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Edit User' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('edit_package');
	}
	
	public function update_package()
	{
		$this->load->library('dispatcher/PackageLib');
		$data = array();
		$data = $this->input->post('data');
		$package = $this->packagelib->update_package ($data);
		$userdata = array();
		if($package) {
			$userdata['status'] = 1;
			$userdata['msg'] = "Package updated successfully.";
		} else {
			$userdata['status'] = 0;
			$userdata['msg'] = "Error! Please check your data.";
		}
		echo json_encode($userdata);
	}
	
}

	

?>