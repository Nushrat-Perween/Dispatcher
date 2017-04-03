<?php
class UserLib {

	public function __construct() {
		$this->CI = & get_instance ();
	}

	public function addUser ($data) {
		$this->CI->load->model ( 'users/user_model', 'user' );
		$users = $this->CI->user->addUser ( $data );
		return $users;
	}
	
	public function getAllUser () {
		$this->CI->load->model ( 'users/user_model', 'user' );
		$users = $this->CI->user->getAllUser (  );
		return $users;
	}
	
	public function getAllFieldworker () {
		$this->CI->load->model ( 'users/user_model', 'user' );
		$users = $this->CI->user->getAllFieldworker (  );
		return $users;
	}

	public function getUserById ($id) {
		$this->CI->load->model ( 'users/user_model', 'user' );
		$res = $this->CI->user->getUserById ($id);
		return $res;
	}
	
	public function updateUserById ($data) {
		$this->CI->load->model ( 'users/user_model', 'user' );
		$res = $this->CI->user->updateUserById ($data);
		return $res;
	}


}
