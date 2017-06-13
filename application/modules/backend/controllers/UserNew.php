<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserNew extends MX_Controller {

	function __construct()
	{
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/FB.ini" );
	}
	
	public function index()
	{
		$this->load->library('dispatcher/UserLibNew');
		$user_list = $this->userlibnew->getAllUser ();
		$this->template->set ( 'user_list', $user_list );
		$this->template->set ( 'page', 'User List' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | User List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('userlistnew');
	}

	public function add_user()
	{
			
		$this->template->set ( 'page', 'User' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Add User' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('add_usernew');
	}
	
	public function save_user()
	{
		$data = array();
		$data = $this->input->post('data');
		$data['text_password'] = $data['password'];
		$data['password'] = md5($data['password']);
		$created_date = date('Y-m-d H:i:s');
		$data['created_date'] = date('Y-m-d H:i:s');
		$data['created_by'] = $_SESSION['admin']['id'];
		$data['user_role'] = 2;
		$this->load->library('dispatcher/UserLibNew');
		//print_r($data);
		$id = $this->userlibnew->saveUser ($data);
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
	
	/*public function user_list (){
		$this->load->library('dispatcher/UserLibNew');
		$user_list = $this->userlibnew->getAllUser ();
		$this->template->set ( 'user_list', $user_list );
		$this->template->set ( 'page', 'User List' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | User List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('userlistnew');
	}*/
	
	public function edit_user ($id)
	{
		$this->load->library('dispatcher/UserLibNew');
		$user = $this->userlibnew->getUserById ($id);
		if($user)
		{
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
		$this->template->build ('edit_usernew');
	}
	
	public function update_user()
	{
		$data = array();
		$data = $this->input->post('data');
		$data['id'] = $this->input->post('id');
		$this->load->library('dispatcher/UserLibNew');
		//print_r($data);
		$id = $this->userlibnew->updateUserById ($data);
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
	public function addHospital()
	{
		$password=mt_rand(100000,999999);
		$data['text_password'] = $password;
		$this->load->library('dispatcher/PackageLib');
		$package = $this->packagelib->getAllPackage ();
		$this->template->set ('package',$package);
		$this->template->set ('password',$data);
		$this->template->set ( 'page', 'User' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Add User' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('add_hospital');
	}
	public function addClientUser()
	{		$param = array();
		$param['client_id'] = $_SESSION['admin']['client_id'];
		$this->load->library('dispatcher/BranchLib');
		$branch_list = $this->branchlib->getAllBranch ($param);
		$this->template->set ( 'branch_list', $branch_list );
		$this->template->set ( 'page', 'User' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Add User' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('add_subadmin');
	}
	public function saveClientUser()
	{
		$data = array();
		$data = $this->input->post('data');
		$data['text_password'] = $data['password'];
		$data['password'] = md5($data['password']);
		$created_date = date('Y-m-d H:i:s');
		$data['created_date'] = date('Y-m-d H:i:s');
		$data['created_by'] = $_SESSION['admin']['id'];
		$data['client_id'] = $_SESSION['admin']['client_id'];
		$this->load->library('dispatcher/UserLibNew');
		//print_r($data);
		$id = $this->userlibnew->saveClientUser ($data);
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
	
	public function clientUserList()
	{
		$this->load->library('dispatcher/UserLibNew');
		$user_list = $this->userlibnew->getClientAllUser ();
		$this->template->set ( 'client_userlist', $user_list );
		$this->template->set ( 'page', 'User List' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | User List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('client_userlist');
	}
	
	public function editClientUser ($id)
	{
		$param = array();
		$param['client_id'] = $_SESSION['admin']['client_id'];
		$this->load->library('dispatcher/BranchLib');
		
		$branch_list = $this->branchlib->getAllBranch ($param);
		$this->load->library('dispatcher/UserLibNew');
		$user = $this->userlibnew->getClientUserById ($id);
		if($user)
		{
			$this->template->set ( 'user', $user[0] );
		}
		$this->template->set ( 'branch_list', $branch_list );
		$this->template->set ( 'page', 'User' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Edit User' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('edit_clientuser');
	}
	
	public function updateClientUser()
	{
		$data = array();
		$data = $this->input->post('data');
		$this->load->library('dispatcher/UserLibNew');
		//print_r($data);
		$data['password'] = md5($data['text_password']);
		$id = $this->userlibnew->updateClientUserByID ($data);
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
	public function saveHospital()
	{
		$data = array();
		$data = $this->input->post('data');
		$data['created_date'] = date('Y-m-d H:i:s');
		$data['created_by'] = $_SESSION['admin']['id'];
		$data['client_id'] = $_SESSION['admin']['client_id'];
		$data['user_role'] = 6;
		$data['text_password'] = $data['password'];
		$data['password'] = md5($data['password']);
		$data['latitude'] = $this->input->post('latitude');
		$data['longitude'] = $this->input->post('longitude');
		$this->load->library('dispatcher/UserLibNew');
		//print_r($data);
		//$data ['name'] = $data ['first_name']." ".$data ['last_name'];
		$id = $this->userlibnew->saveHospital ($data);
		$userdata = array();
		if($id) {
			$userdata['status'] = 1;
			$userdata['msg'] = "Hospital added successfully.";
		} else {
			$userdata['status'] = 0;
			$userdata['msg'] = "Error! Please check your data.";
		}
		echo json_encode($userdata);
	}
	
	public function hospitalList()
	{
		$this->load->library('dispatcher/UserLibNew');
		$hospital_list = $this->userlibnew->gettAllHospital ();
		$this->template->set ('hospitallist', $hospital_list );
		$this->template->set ( 'page', 'User List' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | User List' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('hospitallist');
	}
	
	public function editHospital($id)
	{
		$this->load->library('dispatcher/UserLibNew');
		$hospital = $this->userlibnew->getHospitalById ($id);
		if($hospital)
		{
			$this->template->set ('hospital', $hospital[0] );
		}
		$this->template->set ( 'page', 'User' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Edit User' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('edit_hospital');
	}
	
	public function updateHospital()
	{
		$data = array();
		$data = $this->input->post('data');
		$data['client_id'] = $_SESSION['admin']['client_id'];
		$data['latitude'] = $this->input->post('latitude');
		$data['longitude'] = $this->input->post('longitude');
		$data['id'] = $this->input->post('id');
		$data['hospital_id'] = $this->input->post('hospital_id');
		
		$this->load->library('dispatcher/UserLibNew');
		//print_r($data);
		//$data ['name'] = $data ['first_name']." ".$data ['last_name'];
		$id = $this->userlibnew->updateHospital ($data);
		$userdata = array();
		if($id) {
			$userdata['status'] = 1;
			$userdata['msg'] = "Hospital updated successfully.";
		} else {
			$userdata['status'] = 0;
			$userdata['msg'] = "Error! Please check your data.";
		}
		echo json_encode($userdata);
	}
	public function getHospitalAddress($id)
	{
		$this->load->library('dispatcher/UserLibNew');
		$hospital = $this->userlibnew->getHospitalById ($id);
		echo json_encode($hospital);
	}
}

?>