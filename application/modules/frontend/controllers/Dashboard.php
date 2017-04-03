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
		$this->load->library('dispatcher/DashboardLib');
		$this->load->library('dispatcher/GeneralLib');
		$job_actions = $this->dashboardlib->getCountOfJobActionsByCompanyID ($this->session->userdata('user')['company_id']);
		$job_status = $this->dashboardlib->getCountOfAllBranchJobStatusByCompanyID ($this->session->userdata('user')['company_id']);
// 		foreach ($branch as $row) {
// 			$branch_name = $row['branch_name'];
// 			$branch_job_actions[$branch_name] = $this->dashboardlib->getCountOfJobActionsByCompanyIDAndBranch ($this->session->userdata('user')['company_id'],$this->session->userdata('user')['branch_id']);
			
// 		}
		$this->template->set ( 'job_status', $job_status );
		$this->template->set ( 'job_actions', $job_actions );
		$this->template->set ( 'page', 'dashboard' );
		$this->template->set ( 'user_id', $this->session->userdata('user')['id'] );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('dashboard');
	}
	

}
