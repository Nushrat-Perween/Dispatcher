<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Global_config {
	private $CI;
	private $pci;
	private $fb_config;
	private $pusher_key='';
	
	function load_config() {
		$this->CI = &get_instance();
		$fb_config = parse_ini_file(APPPATH."config/FB.ini");
// 		$this->pusher_key = $fb_config['pusher_key'];
// 		$this->CI->template->set('pusher_key',$this->pusher_key);
		$pci = get_instance(); // CI_Loader instance
		$pci->load->config('pusher');
		$this->CI->template->set('pusher_key',$pci->config->item('pusher_app_key'));
		//echo "<script>alert('".$this->CI->router->directory."');</script>";
		if($this->CI->router->directory=="../modules/frontend/controllers/"){
	        $this->CI->template->set('global_url',site_url());
	        $this->CI->template->set('asset_url',asset_url());
			$this->CI->load->library('user_agent');
			$chat_users = $this->CI->session->userdata('chat_users');
			$userdata = $this->CI->session->userdata('user');
			$this->CI->template->set('chat_users',$chat_users);
			$this->CI->template->set('global_user_id',$userdata['id']);
			$this->CI->template->set('first_name',$userdata['first_name']);
			$this->CI->template->set('last_name',$userdata['last_name']);
			$this->CI->template->set('email',$userdata['email']);
			$this->CI->template->set('mobile',$userdata['mobile']);
			$this->CI->template->set('global_user_role',$userdata['user_role']);
			$this->CI->template->set('global_role_name',$userdata['role_name']);
			$this->CI->template->set('global_company_id',$userdata['company_id']);
			$this->CI->template->set('global_branch_id',$userdata['branch_id']);
			$this->CI->template->set('global_group_id',$userdata['group_id']);
			$this->CI->template->set('global_password',$userdata['password']);
			$this->CI->template->set('notification_count',$this->CI->session->userdata('notification_count'));
			$this->CI->template->set('notification',$this->CI->session->userdata('notification'));
		
		}
		if($this->CI->router->directory=="../modules/backend/controllers/"){
			$this->CI->template->set('global_url',site_url());
			$this->CI->template->set('asset_url',asset_url());
			$chat_admin = $this->CI->session->userdata('chat_admin');
			$admindata = $this->CI->session->userdata('admin');
			$this->CI->template->set('admindata',$admindata);
			$this->CI->template->set('chat_admin',$chat_admin);
			$this->CI->template->set('global_admin_id',$admindata['id']);
			$this->CI->template->set('admin_notification_count',$this->CI->session->userdata('admin_notification_count'));
			$this->CI->template->set('admin_notification',$this->CI->session->userdata('admin_notification'));
		}
	}
	
	function initilize_config() {
		$this->CI->template->set('base_url',base_url());
		$this->CI->load->library('session');
		$this->CI->load->helper('cookie');
	}
	
}
