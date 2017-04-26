<?php
class Auth {
	
	public function __construct() {
		$this->CI = & get_instance ();
	}
	
	public function login($udata) {
		$map = array();
	
			$this->CI->load->model ( 'users/user_model', 'user' );
			$userdetail = $this->CI->user->getUserByUserName ( $udata['username'] );
			if(count($userdetail) > 0) {
				if($userdetail[0]['verified'] == 1 && $userdetail[0]['is_blocked'] > 0) {
					if($userdetail[0]['is_blocked'] == 2) {
						$blacklisted_text = "Dear User, Your account have been blocked for 3 months.";
					} else if($userdetail[0]['is_blocked'] == 3) {
						$blacklisted_text = "Dear User, Your account have been blocked for one year.";
					} else if($userdetail[0]['is_blocked'] == 4) {
						$blacklisted_text = "Dear User, Your account have been blocked permanently.";
					} else {
						$blacklisted_text = "Dear User, Your account have been blocked for one month.";
					}
					
					$map ['status'] = 0;
					$map ['msg'] = $blacklisted_text." For further details contact our customer care at +91 80 99 33 22 11 .";
				} else if($userdetail[0]['verified'] == 0 && $userdetail[0]['is_blocked'] == 0) {
					$map ['status'] = 0;
					$map ['msg'] = "Your account is not verified.  For further details contact our customer care at +91  .";
				}else {
					if($userdetail[0]['password'] == md5($udata['password'])) {
						
						
						if($userdetail[0]['verified'] == 1 && $userdetail[0]['is_blocked'] == 0) {
							$userlog = array();
							$userlog['user_id'] = $userdetail[0]['id'];
							$userlog['company_id'] = $userdetail[0]['company_id'];
							$userlog['logindatetime'] = date('Y-m-d H:i:s');
							if(!empty($udata['imei_no']))
							{
								$userlog['machine_id'] = $udata['imei_no'];
							}
							else
							{
								$userlog['machine_id'] = $this->CI->input->ip_address();
							}
							$resultid = $this->CI->user->addUserLog($userlog);
							$is_log['id'] = $userdetail[0]['id'];
							$is_log['is_logged_in'] = 1;
							$is_login = $this->CI->user->updateUserById ($is_log);
						} 
						$userinfo = array();
						$userinfo['id'] = $userdetail[0]['id'];
						$userinfo['first_name'] = $userdetail[0]['first_name'];
						$userinfo['last_name'] = $userdetail[0]['last_name'];
						$userinfo['email'] = $userdetail[0]['email'];
						$userinfo['mobile'] = $userdetail[0]['mobile'];
						$userinfo['user_role'] = $userdetail[0]['user_role'];
						$userinfo['role_name'] = $userdetail[0]['role_name'];
						$userinfo['company_id'] = $userdetail[0]['company_id'];
						$userinfo['branch_id'] = $userdetail[0]['branch_id'];
						$userinfo['group_id'] = $userdetail[0]['group_id'];
						$userinfo['company_name'] = $userdetail[0]['company_name'];
						$userinfo['logo'] = $userdetail[0]['logo'];
						$userinfo['theme_color'] = $userdetail[0]['theme_color'];
						$userinfo['address'] = $userdetail[0]['address'];
						$userinfo['street'] = $userdetail[0]['street'];
						$userinfo['city'] = $userdetail[0]['city'];
						$userinfo['state_id'] = $userdetail[0]['state_id'];
						$userinfo['pincode'] = $userdetail[0]['pincode'];
						$userinfo['created_date'] = $userdetail[0]['created_date'];
						$userinfo['created_by'] = $userdetail[0]['created_by'];
						$userinfo['group_name'] = $userdetail[0]['group_name'];
						$userinfo['branch_name'] = $userdetail[0]['branch_name'];
						$userinfo['verified'] = $userdetail[0]['verified'];
						$userinfo['is_blocked'] = $userdetail[0]['is_blocked'];
						$userinfo['password'] = $userdetail[0]['password'];
						$userinfo['text_password'] = $userdetail[0]['text_password'];
						$userinfo['profile_pic'] = $userdetail[0]['profile_pic'];
						$map ['status'] = 1;
						$map ['msg'] = "Logged In successfully.";
						$map['result'] = $userinfo;
					} else {
						
						$map ['status'] = 0;
						$map ['msg'] = "Username or password is wrong.";
					}
				}
			} else {
			
				$map ['status'] = 0;
				$map ['msg'] = "Username or password is wrong.";
			}
	
		return $map;
	}
	
	public function adminlogin($udata) {
		$map = array();
	
			$this->CI->load->model ( 'users/AdminUser_model', 'admin' );
			$userdetail = $this->CI->admin->getAdminByUserName ( $udata['username'] );
			if(count($userdetail) > 0) {
				if($userdetail[0]['verified'] == 1 && $userdetail[0]['is_blocked'] > 0) {
					if($userdetail[0]['is_blocked'] == 2) {
						$blacklisted_text = "Dear User, Your account have been blocked for 3 months.";
					} else if($userdetail[0]['is_blocked'] == 3) {
						$blacklisted_text = "Dear User, Your account have been blocked for one year.";
					} else if($userdetail[0]['is_blocked'] == 4) {
						$blacklisted_text = "Dear User, Your account have been blocked permanently.";
					} else {
						$blacklisted_text = "Dear User, Your account have been blocked for one month.";
					}
					
					$map ['status'] = 0;
					$map ['msg'] = $blacklisted_text." For further details contact our customer care at +91 80 99 33 22 11 .";
				} else if($userdetail[0]['verified'] == 0 && $userdetail[0]['is_blocked'] == 0) {
					$map ['status'] = 0;
					$map ['msg'] = "Your account is not verified.  For further details contact our customer care at +91  .";
				}else {
					if($userdetail[0]['password'] == md5($udata['password'])) {
						if($userdetail[0]['verified'] == 1 && $userdetail[0]['is_blocked'] == 0) {
							$userlog = array();
							$userlog['admin_id'] = $userdetail[0]['id'];
							$userlog['product_type'] = 1;
							$userlog['comment'] = "Login at ".date('d-m-Y H:i:s');
							$userlog['action_date'] = date('Y-m-d H:i:s');
							if(isset($udata['gcm_id']))
							{
								$userlog['gcm_id'] = $udata['gcm_id'];
							}
							else
							{
								$userlog['machine_id'] = $this->CI->input->ip_address();
							}
							$resultid = $this->CI->admin->addAdminLog($userlog);
							$is_log['id'] = $userdetail[0]['id'];
							$is_log['is_logged_in'] = 1;
							if(isset($udata['gcm_id']))
							{
								$is_log['gcm_id'] = $udata['gcm_id'];
							}
							$is_login = $this->CI->admin->updateAdminById ($is_log);
						} 
						$userinfo = array();
						$userinfo['id'] = $userdetail[0]['id'];
						$userinfo['first_name'] = $userdetail[0]['first_name'];
						$userinfo['hospital_id'] = $userdetail[0]['hospital_id'];
						$userinfo['client_id'] = $userdetail[0]['client_id'];
						$userinfo['last_name'] = $userdetail[0]['last_name'];
						$userinfo['email'] = $userdetail[0]['email'];
						$userinfo['mobile'] = $userdetail[0]['mobile'];
						$userinfo['user_role'] = $userdetail[0]['user_role'];
						$userinfo['role_name'] = $userdetail[0]['role_name'];
						$userinfo['verified'] = $userdetail[0]['verified'];
						$userinfo['is_blocked'] = $userdetail[0]['is_blocked'];
						$userinfo['password'] = $userdetail[0]['password'];
						$userinfo['text_password'] = $userdetail[0]['text_password'];
						$userinfo['profile_pic'] = $userdetail[0]['profile_pic'];
						$userinfo['is_notification_active'] = $userdetail[0]['is_notification_active'];
						$map ['status'] = 1;
						$map ['msg'] = "Logged In successfully.";
						$map['result'] = $userinfo;
					} else {
						
						$map ['status'] = 0;
						$map ['msg'] = "Username or password is wrong.";
					}
				}
			} else {
			
				$map ['status'] = 0;
				$map ['msg'] = "Username or password is wrong.";
			}
	
		return $map;
	}
	
	public function editPassword($data) {
		$this->CI->load->model ( 'users/AdminUser_model', 'admin' );
		return $userdetail = $this->CI->admin->editPassword ( $data );
	}
	public function checkPassword($data) {
		$response = array ();
		$this->CI->load->model ( 'users/AdminUser_model', 'admin' );
		$result = $userdetail = $this->CI->admin->checkPassword ( $data );
		if (count ( $result ) > 0) {
			$response ['status'] = 1;
			$response ['msg'] = "Record Found";
		} else {
				
			$response ['status'] = 0;
			$response ['msg'] = "Old Password Not correct";
		}
		return $response;
	}
	


}
