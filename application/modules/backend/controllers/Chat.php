<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends MX_Controller {

	function __construct()
	{
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/FB.ini" );
	}

		/**
		 * Open chat box
		 */
		public function open_chat_box () {
			$param['sender_id'] = $this->session->userdata('admin')['id'];
			$param['receiver_id'] = $this->input->post("receiver_id");
			$this->load->library('dispatcher/ChatLib');
			$chats = $this->chatlib->getchat ($param);
			$this->template->set ( 'chats', $chats );
			$this->template->set ( 'receiver_id', $param['receiver_id'] );
			$this->template->set ( 'page', 'Chat' );
			$this->template->set_theme( 'default_theme' );
			$this->template->set_layout ( false)
			->title ( 'Dispatcher | Chat' );
			$this->template->build ('view_chat',true);
		}

	public function save_chat () {
		$param['message'] = trim($this->input->post("message"));
		$param['sender_id'] = $this->session->userdata('admin')['id'];
		$param['receiver_id'] = $this->input->post("receiver_id");
		$param['created_date'] = date("Y-m-d H:i:s");
		$this->load->library('dispatcher/ChatLib');
		$res = $this->chatlib->saveChat ($param);
		$response = array();
		if($res) {
			$param1['sender_id'] = $this->session->userdata('admin')['id'];
			$param1['receiver_id'] = $this->input->post("receiver_id");
			$this->load->library('dispatcher/ChatLib');
			$chats = $this->chatlib->getchat ($param1);
			$this->template->set ( 'chats', $chats );
			$this->template->set ( 'receiver_id', $param['receiver_id'] );
			$this->template->set ( 'page', 'Chat' );
			$this->template->set_theme( 'default_theme' );
			$this->template->set_layout ( false)
			->title ( 'Dispatcher | Chat' );
			$this->template->build ('view_chat',true);
		} 
	}


}

?>
