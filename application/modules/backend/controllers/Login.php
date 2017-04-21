<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {

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
		 
		$this->template->set ( 'page', 'login' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('login')
		->title ( 'Dispatcher | Login' )
		->set_partial ( 'header', 'partials/header_home' );

		$this->template->build ('login');
	}

	 

	/**
	 * chech for valid user(username or password)
	 */
	public function loginuser() {
		$data = array();
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		$this->load->library('dispatcher/auth');
		$userdata = $this->auth->adminlogin($data);
		 
		if($userdata['status'] == 1) {
			$_SESSION['admin_timeout'] =time();
			$_SESSION['admin_lock_count'] = 0;
			$this->load->library('dispatcher/AdminLib');
			$this->session->set_userdata('admin',$userdata['result']);
			
			$param = array();
			$param['client_id'] =  $this->session->userdata('admin')['client_id'];
			$param['user_role'] =  $this->session->userdata('admin')['user_role'];
			if($this->session->userdata('admin')['user_role'] == '6') {
				$param['hospital_id'] = $this->session->userdata('admin')['hospital_id'];
			}
			$chat_admin = $this->adminlib->getChatPeople ($param);
			//print_r($chat_users);
			
			$this->session->set_userdata('chat_admin',$chat_admin);
			$notification_param = array();
			$notification_param['client_id'] = $this->session->userdata('admin')['client_id'];
			$this->load->library('dispatcher/NotificationLib');
			$notification = $this->notificationlib->getAllAdminNotification($notification_param);
			$this->session->set_userdata('admin_notification_count',count($notification));
			$this->session->set_userdata('admin_notification',$notification);

		}
		echo json_encode($userdata);
	}

	public function get_chat_people () {
		$param = array();
		$param['client_id'] =  $this->session->userdata('admin')['client_id'];
		$param['user_role'] =  $this->session->userdata('admin')['user_role'];
		if($this->session->userdata('admin')['user_role'] == '6') {
			$param['hospital_id'] = $this->session->userdata('admin')['hospital_id'];
		}
		$this->load->library('dispatcher/AdminLib');
		$chat_admin = $this->adminlib->getChatPeople ($param);
		$this->template->set_theme( 'default_theme' );
		$this->template->set('chat_admin', $chat_admin);
		$this->template->set_layout (false);
		$this->template->build ('partials/list_chat_people',true);
	}

	/**
	 * Code For Logout Functionality
	 */
	public function logout() {
		$fbuser = $this->session->userdata('admin');
		$userid = $fbuser['id'];
		$userdata = array();
		$userdata['id'] = $userid;
		$userdata['is_logged_in'] = 0;
		$userdata['last_visit_date'] = date('Y-m-d H:i:s');
		$this->load->library('dispatcher/AdminLib');
		$userdata = $this->adminlib->updateAdminById($userdata);
		 
		$this->session->unset_userdata('chat_admin');
		$this->session->unset_userdata('admin');
		$this->session->set_userdata('admin_notification_count');
		$this->session->set_userdata('admin_notification');
		redirect(base_url()."admin");
	}


	public function lock_screen (){
		$_SESSION['admin_timeout'] =time();
		$this->template->set ( 'page', 'login' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('login')
		->title ( 'Dispatcher | Lock Screen' )
		->set_partial ( 'header', 'partials/header_home' );

		$this->template->build ('lock_screen');
		//session_destroy ();
	}
	 
	public function unlock () {
		$password = md5($this->input->post('password'));
		$global_password = $this->input->post('global_password');
		if($password == $global_password) {
			 
			$_SESSION['admin_lock_count'] = 0;
			redirect(base_url()."admin/dashboard");
			 
		} else {
			$_SESSION['admin_lock_count'] +=1;
			if($_SESSION['admin_lock_count'] >=4) {
				session_destroy ();
				redirect(base_url()."admin");
			} else {
				redirect(base_url()."admin/lock_screen");
			}
		}

	}
	
	public function error_screen (){
		$this->template->set ( 'page', 'error' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('login')
		->title ( 'Dispatcher | Error' )
		->set_partial ( 'header', 'partials/header_home' );
	
		$this->template->build ('pages-404');
		//session_destroy ();
	}
	
	public function coming_soon (){
		$this->template->set ( 'page', 'error' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('login')
		->title ( 'Dispatcher | Error' )
		->set_partial ( 'header', 'partials/header_home' );
		
	
		$this->template->build ('coming_soon');
		//session_destroy ();
	}
}

?>
