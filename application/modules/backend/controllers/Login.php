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
			$param['session_id'] =  $this->session->userdata('admin')['id'];
			if($this->session->userdata('admin')['user_role'] == '6') {
				$param['hospital_id'] = $this->session->userdata('admin')['hospital_id'];
			}
			$chat_admin = $this->adminlib->getChatPeople ($param);
			//print_r($chat_users);
			
			$this->session->set_userdata('chat_admin',$chat_admin);
			$notification_param = array();
			$notification = array();
			$notification_param['client_id'] = $this->session->userdata('admin')['client_id'];
			$this->load->library('dispatcher/NotificationLib');
			if($_SESSION['admin']['is_notification_active'] == 1) {
				$notification = $this->notificationlib->getAllAdminNotification($notification_param);
			}
			$this->session->set_userdata('admin_notification_count',count($notification));
			$this->session->set_userdata('admin_notification',$notification);

		}
		echo json_encode($userdata);
	}

	public function get_chat_people () {
		$param = array();
		$param['session_id'] =  $this->session->userdata('admin')['id'];
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
	
	/**
	 * Call Forgot Password Page
	 */
	public function forgot_password (){
			
		$this->template->set ( 'page', 'forgot password' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('login')
		->title ( 'Dispatcher | Login' )
		->set_partial ( 'header', 'partials/header_home' );
	
		$this->template->build ('forgot_password');
	}
	
	/**
	 * Function To Recover the password
	 */
	public function send_password_reset_instruction ()
	{
		$response = array();
		$this->load->library('dispatcher/AdminLib');
		$emailid = $this->input->post('email');
		$emailchk = $this->adminlib->getAdminByUserName ($emailid);
		if($emailchk[0]['email'] == $emailid)
		{
			if($emailchk[0]['verified'] == 1)
			{
				if($emailchk[0]['is_blocked'] == 0)
				{
					$this->load->library('encrypt');
					$name = $emailchk[0]['first_name']." ".$emailchk[0]['last_name'];
					$encrypted_string = $this->encrypt->encode($emailid);
					$url = base_url('admin/reset_password?token='.urlencode($encrypted_string));
					$this->load->library('email');
					$this->email->initialize(array(
						  'protocol' => 'smtp',
						  'smtp_host' => 'ssl://smtp.googlemail.com',
						  'smtp_port' => '465',
						  'smtp_user' => 'nushahmad04@gmail.com', // change it to yours
						  'smtp_pass' => '17@nushahmad', // change it to yours
						  'mailtype' => 'html',
						  'charset' => 'iso-8859-1',
						  'wordwrap' => TRUE,
						  'crlf' => "\r\n",
  			 			  'newline' => "\r\n"
					));
					$this->email->from('nushahmad04@gmail.com', 'Nushrat Perween');
					$this->email->to('nushahmad04@gmail.com');
					//$this->email->cc('another@another-example.com');
					//$this->email->bcc('them@their-example.com');
					$this->email->subject('Password Recovery Of Dispatcher');
					$msg = "Dear ".$name." <br><br>You have requested help with recovering your Dispatcher account password.
							Please click on the link below to reset your password. If you have any questions or issues please contact our 
							customer care at 123456. <br><br>URL : ".$url."<br><br>Regards,<br>Dispatcher.com";
					$this->email->message($msg);
					$this->email->send();
					$this->email->print_debugger();
					$response['status'] = 1;
					$response['msg'] = "Password reset instructions have been sent to your email.";
				} else {
					$response['status'] = 0;
					$response['msg'] = "This account is blocked.";
				}
			} else {
				$response['status'] = 0;
				$response['msg'] = "This account is not verified.";
			}
		
		}
		else
		{
			$response['status'] = 0;
			$response['msg'] = "This Email Id is not exist.";
		}
		echo json_encode($response);
	}
	
	/**
	 * Call Reset Password Page
	 */
	public function reset_password (){
		$this->load->library('encrypt');
		$encrypted_emailid = $_GET['token'];
		$emailid = $this->encrypt->decode($encrypted_emailid);
		$this->template->set('emailid', $emailid);
		$this->template->set ( 'page', 'forgot password' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('login')
		->title ( 'Dispatcher | Reset Password' )
		->set_partial ( 'header', 'partials/header_home' );
	
		$this->template->build ('reset_password');
	}
	
	/**
	 * Call Reset Password Page
	 */
	public function save_reset_password (){
		$response = array();
		$this->load->library('dispatcher/AdminLib');
		$param['email'] = $this->input->post('email');
		$param['text_password'] = $this->input->post('password');
		$param['password'] = md5($param['text_password']);
		$resp = $this->adminlib->resetPassword ($param);
		if($resp) {
			$response['status'] = 1;
			$response['msg'] = "Your account password reset successfully.";
		} else {
			$response['status'] = 0;
			$response['msg'] = "Please check some error is there.";
		}
		echo json_encode($response);
		
	}
	
}

?>
