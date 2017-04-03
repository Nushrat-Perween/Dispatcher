<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {

	function __construct()
	{
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/FB.ini" );
	}

// 	/**
// 	 * add user
// 	 */
// 	public function index(){
			
// 		$this->template->set ( 'page', 'User' );
// 		$this->template->set_theme('default_theme');
// 		$this->template->set_layout ('default')
// 		->title ( 'Dispatcher | Add User' )
// 		->set_partial ( 'header', 'partials/header' )
// 		->set_partial ( 'side_menu', 'partials/side_menu' )
// 		->set_partial ( 'chat_model', 'partials/chat_model' )
// 		->set_partial ( 'footer', 'partials/footer' );
// 		$this->template->build ('add_user');
// 	}

	/**
	 * add field worker
	 */
	public function add_fieldworker (){
			
		$this->template->set ( 'page', 'User' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Dispatcher | Add FieldWorker' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('add_fieldworker');
	}

	public function get_fieldworker (){
		$param = array();
		$param['user_role'] = 3;
		$this->load->library('dispatcher/AdminLib');
		return $fieldworker_list = $this->adminlib->getAllAdmin ($param);
	
	}
	
	public function fieldworker_list (){
		$param = array();
		$param['user_role'] = 3;
		$this->load->library('dispatcher/AdminLib');
		$fieldworker_list = $this->adminlib->getAllAdmin ($param);
		$this->template->set ( 'fieldworker_list', $fieldworker_list );
		$this->template->set ( 'page', 'Fieldworker List' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Dispatcher | User List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('fieldworker_list');
	}
	

	/**
	 * add new job
	 */
	public function add_backend_user () {
		$data = array();
		$data = $this->input->post('data');
		$data['text_password'] = $data['password'];
		$data['password'] = md5($data['password']);
		$this->load->library('dispatcher/AdminLib');
		$id = $this->adminlib->addAdmin ($data);
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

// 	public function edit_user ($id){
// 		$this->load->library('dispatcher/UserLib');
// 		$user = $this->userlib->getUserById ($id);
// 		if($user){
// 			$this->template->set ( 'user', $user[0] );
// 		}
// 		$this->template->set ( 'page', 'User' );
// 		$this->template->set_theme('default_theme');
// 		$this->template->set_layout ('default')
// 		->title ( 'Dispatcher | Edit User' )
// 		->set_partial ( 'header', 'partials/header' )
// 		->set_partial ( 'side_menu', 'partials/side_menu' )
// 		->set_partial ( 'chat_model', 'partials/chat_model' )
// 		->set_partial ( 'footer', 'partials/footer' );
// 		$this->template->build ('edit_user');
// 	}

	public function update_admin () {
		$data = array();
		$data = $this->input->post('data');
		$data['text_password'] = $data['password'];
		$data['password'] = md5($data['password']);
		$this->load->library('dispatcher/UserLib');
		$id = $this->userlib->updateUserById ($data);
		$userdata = array();
		if($id) {
			$userdata['status'] = 1;
			$userdata['msg'] = "User updated successfully.";
		} else {
			$userdata['status'] = 0;
			$userdata['msg'] = "Error! Please check your data.";
		}
		echo json_encode($userdata);
	}
	
	public function admin_list (){
		$this->load->library('dispatcher/AdminLib');
		$user_list = $this->userlib->getAllAdminUser ();
		$this->template->set ( 'user_list', $user_list );
		$this->template->set ( 'page', 'User List' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | User List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('user_list');
	}
	


}

?>
