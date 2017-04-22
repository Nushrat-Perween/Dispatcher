<?php
class ChatLib {

	public function __construct() {
		$this->CI = & get_instance ();
	}
	
	public function getChat ($param) {
		$this->CI->load->model ( 'chat/Chat_model', 'chat' );
		$res = $this->CI->chat->getChat ($param);
		return $res;
	}
	
	public function saveChat ($data) {
		$this->CI->load->model ( 'chat/Chat_model', 'chat' );
		$res = $this->CI->chat->saveChat ($data);
		return $res;
	}
	
}