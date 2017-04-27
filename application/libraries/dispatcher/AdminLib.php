<?php
class AdminLib {

	public function __construct() {
		$this->CI = & get_instance ();
	}

	public function getAllAdmin ($param) {
		$this->CI->load->model ( 'users/AdminUser_model', 'admin' );
		$res = $this->CI->admin->getAllAdmin ( $param );
		return $res;
	}
	
	public function getChatPeople ($param) {
		$this->CI->load->model ( 'users/AdminUser_model', 'admin' );
		$res = $this->CI->admin->getChatPeople ( $param );
		return $res;
	}
	
	public function getAdminById ($id) {
		$this->CI->load->model ( 'users/AdminUser_model', 'admin' );
		$res = $this->CI->admin->getAdminById ($id);
		return $res;
	}
	
	public function updateAdminById ($data) {
		$this->CI->load->model ( 'users/AdminUser_model', 'admin' );
		$res = $this->CI->admin->updateAdminById ( $data );
		return $res;
	}
	
	public function addAdmin ($data) {
		$this->CI->load->model ( 'users/AdminUser_model', 'admin' );
		$res = $this->CI->admin->addAdmin ( $data );
		return $res;
	}
	
	public function updateCurrentLocationById($data)
	{
		$this->CI->load->model ( 'users/AdminUser_model', 'admin' );
		$res = $this->CI->admin->updateCurrentLocationById ( $data);
		return $res;
	}
	
	public function getAdminByUserName ($data)
	{
		$this->CI->load->model ( 'users/AdminUser_model', 'admin' );
		$res = $this->CI->admin->getAdminByUserName ( $data);
		return $res;
	}
	
	public function resetPassword ($param)
	{
		$this->CI->load->model ( 'users/AdminUser_model', 'admin' );
		$res = $this->CI->admin->resetPassword ( $param);
		return $res;
	}
	


}
