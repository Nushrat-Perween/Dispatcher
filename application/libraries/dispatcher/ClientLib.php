<?php
class ClientLib {

	public function __construct() 
	{
		$this->CI = & get_instance ();
	}

	public function save_client ($data) 
	{
		$user = array();
		$user['password']=$data['password'];
		$user['text_password']=$data['text_password'];
		$user['user_role']=$data['user_role'];
		$user['created_date']=$data['created_date'];
		$user['created_by']=$data['created_by'];
		$user['email'] = $data['email'];
		$user['first_name'] = $data['first_name'];
		$user['last_name'] = $data['last_name'];
		$user['mobile'] = $data['mobile'];
		$user['verified'] = $data['verified'];
		//print_r($user);
		unset($data['password']);
		unset($data['text_password']);
		unset($data['user_role']);
		unset($data['email']);
		unset($data['first_name']);
		unset($data['last_name']);
		unset($data['mobile']);
		unset($data['verified']);
		$this->CI->load->model ( 'client/client_model', 'client' );
		$client = $this->CI->client->save_client ( $data );
		$user['client_id']=$client;
		$this->CI->load->model ( 'users/user_model_new', 'user' );
		$users = $this->CI->user->saveUser ( $user );
		return $client;
	}
	
	public function getAllClient()
	{
		$this->CI->load->model ( 'client/client_model', 'client' );
		$client = $this->CI->client->getAllClient ( );
		return $client;
	}
	
	public function getClientById($id)
	{
		$this->CI->load->model ( 'client/client_model', 'client' );
		$client = $this->CI->client->getClientById ($id );
		return $client;
	}
	
	public function updateClientById($data)
	{
		$client = array();
		$client['first_name'] = $data['first_name'];
		$client['last_name'] = $data['last_name'];
		$client['mobile'] = $data['mobile'];
		$client['verified'] = $data['verified'];
		$client['id'] = $data['id'];
		$client['text_password'] = $data['text_password'];
		$client['password'] = md5($data['text_password']);
		$client['email'] = $data['email'];
		unset($data['text_password']);
		unset($data['first_name']);
		unset($data['last_name']);
		unset($data['mobile']);
		unset($data['hospital_id']);
		unset($data['verified']);
		unset($data['email']);
		//print_r($client);
		$this->CI->load->model ( 'client/client_model', 'client' );
		$client_data = $this->CI->client->updateClientById ($data );
		$client_data1 = $this->CI->client->updateClientByClientId ( $client );
		return $client_data;
	}
}
