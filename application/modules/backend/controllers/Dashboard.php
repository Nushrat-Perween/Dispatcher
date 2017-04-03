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
		$data['hospital_id'] = $_SESSION['admin']['hospital_id'];
		$data['current_date'] = date('Y-m-d');
		$data['client_id'] = $_SESSION['admin']['client_id'];
		$this->load->library('dispatcher/ReportLib');
		$this->load->library('dispatcher/DashboardLib');
		$getcustomeralljob = $this->dashboardlib->getAllJobDetailByClientId ($data);
		//print_r($getcustomeralljob);
		$totalclient = $this->dashboardlib->getTotalClientByClientId($data);
		$newclient = $this->dashboardlib->getNewClientByClientId($data);
		$getalljob = $this->dashboardlib->getAllJobByHospitalId ($data);
		$getnewjob =  $this->dashboardlib->getNewJobByHospitalId($data);
		$pendingjob = $this->dashboardlib->getPendingJobByHospitalId($data);
		$completedjob = $this->dashboardlib->getCompletedJobByHospitalId($data);
		$canceljob = $this->dashboardlib->getCancelJobByHospitalId($data);
		$customer = $this->reportlib->getCutomerReport ();
		$customerreport = $this->reportlib->getJobByCustomer ();
		$this->template->set ( 'totalclient', $totalclient);
		$this->template->set ( 'newlclient', $newclient);
		$this->template->set ( 'getcustomeralljobdetail', $getcustomeralljob);
		$this->template->set ( 'customer', $customer );
		$this->template->set ( 'customerreport', $customerreport );
		$this->template->set ( 'totaljob', $getalljob );
		$this->template->set ( 'newjob', $getnewjob );
		$this->template->set ( 'pendingjob', $pendingjob );
		$this->template->set ( 'completedjob', $completedjob );
		$this->template->set ( 'cancejob', $canceljob);
		$this->template->set ( 'page', 'dashboard' );
		$this->template->set ( 'admin_id', $this->session->userdata('admin')['id'] );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		if($this->session->userdata('admin')['user_role'] == 3 || $this->session->userdata('admin')['user_role'] == 4 ||$this->session->userdata('admin')['user_role'] == 5)
			$this->template->build ('dashboard');
		if($this->session->userdata('admin')['user_role'] == 6 )
			$this->template->build ('client_dashboard');
		if($this->session->userdata('admin')['user_role'] == 1 || $this->session->userdata('admin')['user_role'] == 2)
			$this->template->build ('siteadmin_dashboard');
	}
	

}