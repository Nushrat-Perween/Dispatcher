<?php
class UserLibNew {

	public function __construct() 
	{
		$this->CI = & get_instance ();
	}

	public function saveUser ($data) 
	{
		$this->CI->load->model ( 'users/user_model_new', 'user' );
		$users = $this->CI->user->saveUser ( $data );
		return $users;
	}
	
	public function getAllUser () {
		$this->CI->load->model ( 'users/user_model_new', 'user' );
		$users = $this->CI->user->getAllUser (  );
		return $users;
	}
	
	public function getUserById ($id) {
		$this->CI->load->model ( 'users/user_model_new', 'user' );
		$res = $this->CI->user->getUserById ($id);
		return $res;
	}
	
	public function updateUserById ($data) {
		$this->CI->load->model ( 'users/user_model_new', 'user' );
		$res = $this->CI->user->updateUserById ($data);
		return $res;
	}
	public function saveClientUser ($data) {
		$this->CI->load->model ( 'users/user_model_new', 'user' );
		$res = $this->CI->user->saveClientUser ($data);
		return $res;
	}
	
	public function getClientAllUser()
	{
		$this->CI->load->model ( 'users/user_model_new', 'user' );
		$users = $this->CI->user->getClientAllUser ( );
		return $users;
	}
	
	public function getClientUserById($id)
	{
		$this->CI->load->model ( 'users/user_model_new', 'user' );
		$users = $this->CI->user->getClientUserById ( $id);
		return $users;
	}
	public function updateClientUserByID($id)
	{
		$this->CI->load->model ( 'users/user_model_new', 'user' );
		$users = $this->CI->user->updateClientUserByID ( $id);
		return $users;
	}
	public function saveHospital($data)
	{
		$user = array();
		$hospital = array();
	
		$user['password'] = $data['password'];
		$user['text_password'] = $data['text_password'];
		$user['user_role'] = $data['user_role'];
		$user['created_date'] = $data['created_date'];
		$user['created_by'] = $data['created_by'];
		$user['email'] = $data['email'];
		//$user['first_name'] = $data['first_name'];
		//$user['last_name'] = $data['last_name'];
		$user['mobile'] = $data['mobile'];
		$user['verified'] = $data['verified'];
		$user['client_id'] = $data['client_id'];
	
		//$hospital['name'] = $data['name'];
		//$hospital['locality'] = $data['locality'];
		$hospital['address'] = $data['address'];
		$hospital['created_date'] = $data['created_date'];
		$hospital['created_by'] = $data['created_by'];
		$hospital['pincode'] = $data['pincode'];
		$hospital['latitude'] = $data['latitude'];
		$hospital['longitude'] = $data['longitude'];
		$hospital['business_name'] = $data['business_name'];
		$hospital['state'] = $data['state'];
		$hospital['city'] = $data['city'];
		$hospital['fax_no'] = $data['fax_no'];
		$this->CI->load->model ( 'users/user_model_new', 'user' );
		$hospital_id = $this->CI->user->saveHospital ($hospital);
		$user['hospital_id'] = $hospital_id;
		$this->CI->load->model ( 'users/user_model_new', 'user' );
		$users = $this->CI->user->saveUser ( $user );
		return $users;
	}
	
	public function gettAllHospital()
	{
		$this->CI->load->model ( 'users/user_model_new', 'user' );
		$hospital = $this->CI->user->gettAllHospital ( );
		return $hospital;
	}
	
	public function getHospitalById($id)
	{
		$this->CI->load->model ( 'users/user_model_new', 'user' );
		$hospital = $this->CI->user->getHospitalById ($id);
		return $hospital;
	}
	
	public function updateHospital($data)
	{
		$user = array();
		$hospital = array();
		$user['email'] = $data['email'];
		//$user['first_name'] = $data['first_name'];
		//$user['last_name'] = $data['last_name'];
		$user['mobile'] = $data['mobile'];
		$user['verified'] = $data['verified'];
		$user['hospital_id'] = $data['hospital_id'];
	
		//$hospital['name'] = $data['name'];
		//$hospital['locality'] = $data['locality'];
		$hospital['address'] = $data['address'];
		$hospital['pincode'] = $data['pincode'];
		$hospital['latitude'] = $data['latitude'];
		$hospital['longitude'] = $data['longitude'];
		$hospital['id'] = $data['id'];
		$hospital['business_name'] = $data['business_name'];
		$hospital['city'] = $data['city'];
		$hospital['state'] = $data['state'];
		$hospital['fax_no'] = $data['fax_no'];
		$this->CI->load->model ( 'users/user_model_new', 'user' );
		$hospital_id = $this->CI->user->updateHospital ($hospital);
		$user = $this->CI->user->updateUserByHospitalId ($user);
		return $user;
	}
	
}