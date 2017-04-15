<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends MX_Controller {

	function __construct()
	{
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/FB.ini" );
	}
	public function index()
	{
		$param['user_role'] = 7;
		$param['client_id'] = $_SESSION['admin']['client_id'];
		$this->load->library('dispatcher/AdminLib');
		$this->load->library('dispatcher/JobLib');
		$fieldworker_list = $this->adminlib->getAllAdmin ($param);
		$job = $this->joblib->getJobScheduleByFieldworkerId (28);
		//print_r($job);
		//print_r($fieldworker_list);
		$this->template->set ( 'fieldworker', $fieldworker_list );
		$this->template->set ( 'page', 'User' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('backend')
		->title ( 'Dispatcher | Add FieldWorker' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('schedule');
	}
	public function getSchedule($id)
	{
		$param['user_role'] = 7;
		$this->load->library('dispatcher/JobLib');
		$job = $this->joblib->getJobScheduleByFieldworkerId ($id);
		echo json_encode($job);
	}
}