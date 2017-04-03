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
   		$userdata = $this->auth->login($data);
   		
   		if($userdata['status'] == 1) {
   				$_SESSION['timeout'] =time();
   				$_SESSION['lock_count'] = 0;
	   			$this->load->library('dispatcher/GeneralLib');
	   			$chat_users = $this->generallib->getAllUserOfCompany ($userdata['result']['company_id'],$userdata['result']['id']);
	   			//print_r($chat_users);
	   			
   				$this->session->set_userdata('chat_users',$chat_users);
   				$this->session->set_userdata('user',$userdata['result']);
   				$notification_param = array();
   				$notification_param['company_id'] = $userdata['result']['company_id'];
   			
   				if($userdata['result']['user_role'] != 1 & $userdata['result']['user_role'] != 2 ) {
   					$notification_param['branch_id'] = $userdata['result']['branch_id'];
   				}
   				$this->load->library('dispatcher/NotificationLib');
   				$notification = $this->notificationlib->getAllNotification($notification_param);
   				$this->session->set_userdata('notification_count',count($notification));
   				$this->session->set_userdata('notification',$notification);
   			
   		}
   		echo json_encode($userdata); 
   	}
   	
   	public function get_chat_people () {
   		$this->load->library('dispatcher/GeneralLib');
   		$company_id = $this->input->post('company_id');
   		$user_id = $this->input->post('user_id');
   		$chat_users = $this->generallib->getAllUserOfCompany ($company_id,$user_id);
   		$this->template->set_theme( 'default_theme' );
   		$this->template->set('chat_users', $chat_users);
   		$this->template->set_layout (false);
   		$this->template->build ('partials/list_chat_people',true);
   	}
   	
   	/**
   	 * Code For Logout Functionality
   	 */
   	public function logout() {
   		$fbuser = $this->session->userdata('user');
   		$userid = $fbuser['id'];
   		$userdata = array();
   		$userdata['id'] = $userid;
   		$userdata['is_logged_in'] = 0;
   		$userdata['last_visit_date'] = date('Y-m-d H:i:s');
   		$this->load->library('dispatcher/GeneralLib');
   		$userdata = $this->generallib->updateUserById($userdata);
   		
   		$this->session->unset_userdata('chat_users',$chat_users);
   		$this->session->unset_userdata('user',$userdata['result']);
   		redirect(base_url());
   	}
   	
 
   	public function lock_screen (){
   		$_SESSION['timeout'] =time();
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
   		
   		$_SESSION['lock_count'] = 0;
   		redirect(base_url()."dashboard");
   		
   	} else {
   		$_SESSION['lock_count'] +=1;
   		if($_SESSION['lock_count'] >=4) {
   			session_destroy ();
   			redirect(base_url()."login");
   		} else {
   			redirect(base_url()."lock_screen");
   		}
   	}
   	
   }
}

?>
