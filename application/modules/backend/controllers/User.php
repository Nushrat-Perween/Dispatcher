<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MX_Controller {

	function __construct()
	{
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/FB.ini" );
	}

	/**
	 * add user
	 */
	public function index(){
			
		$this->template->set ( 'page', 'User' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Add User' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('add_user');
	}





	/**
	 * add new job
	 */
	public function add_user () {
		$data = array();
		$data = $this->input->post('data');
		$data['text_password'] = $data['password'];
		$data['password'] = md5($data['password']);
		$this->load->library('dispatcher/UserLib');
		$id = $this->userlib->addUser ($data);
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

	public function edit_user ($id){
		$this->load->library('dispatcher/UserLib');
		$user = $this->userlib->getUserById ($id);
		if($user){
			$this->template->set ( 'user', $user[0] );
		}
		$this->template->set ( 'page', 'User' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Edit User' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('edit_user');
	}

	public function update_user () {
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
	public function user_list (){
		$this->load->library('dispatcher/UserLib');
		$user_list = $this->userlib->getAllUser ();
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
	
	public function fieldworker_list () {
		$this->load->library('dispatcher/UserLib');
		$fieldworker_list = $this->userlib->getAllFieldworker ();
		$this->template->set ( 'fieldworker_list', $fieldworker_list );
		$this->template->set ( 'page', 'User List' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | User List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('fieldworker_list');
	}


}

?>
