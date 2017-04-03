<?php
class Dashboard extends MX_Controller {
	public function __construct() {
		parent::__construct ();
		$current_lang = $this->session->userdata('my_lang');
		if(!$current_lang) {
			$current_lang = 'english';
			$this->session->set_userdata('my_lang','english');
		}
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$this->load->helper('mylang');
		$this->lang->load($current_lang.'_home_page_lang', $current_lang);
		$fb_config = parse_ini_file ( APPPATH . "config/FB.ini" );
	}
	
	public function index() {
		$this->load->library('dispatcher/ReportLib');
		$customer = $this->reportlib->getCutomerReport ();
		$customerreport = $this->reportlib->getJobByCustomer ();
		$this->template->set ( 'customer', $customer );
		$this->template->set ( 'customerreport', $customerreport );
		$this->template->set ( 'page', 'dashboard' );
		$this->template->set ( 'admin_id', $this->session->userdata('admin')['id'] );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		if($this->session->userdata('admin')['user_role'] == 3 )
			$this->template->build ('dashboard');
		if($this->session->userdata('admin')['user_role'] == 6 )
			$this->template->build ('client_dashboard');
		if($this->session->userdata('admin')['user_role'] == 1 || $this->session->userdata('admin')['user_role'] == 2)
			$this->template->build ('dashboard');
	}
	

}
