<?php
class Branch extends MX_Controller {
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

	public function branch_list () {
		$param = array();
		$param['client_id'] = $_SESSION['admin']['client_id'];
		$this->load->library('dispatcher/BranchLib');
		$branch_list = $this->branchlib->getAllBranch ($param);
		$this->template->set ( 'branch_list', $branch_list );
		$this->template->set ( 'page', 'Branch' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
			->title ( 'Dispatcher | Branch' )
			->set_partial ( 'header', 'partials/header' )
			->set_partial ( 'side_menu', 'partials/side_menu' )
			->set_partial ( 'chat_model', 'partials/chat_model' )
			->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('branch_list');
	}
	
	public function add_branch () {
		$this->load->library('dispatcher/UserLibNew');
		$hospital_list = $this->userlibnew->gettAllHospital ();
		$this->template->set ('hospitallist', $hospital_list );
		$this->template->set ( 'page', 'Branch' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Branch' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('add_branch');
	}


	public function save_branch () {
		$param = array();
		$param = $this->input->post('data');
		$param['client_id'] = $this->session->userdata('admin')['client_id'];
		$param['created_by'] = $this->session->userdata('admin')['id'];
		$param['created_date'] = date('Y-m-d H:i:s');
		$this->load->library('dispatcher/BranchLib');
		$id = $this->branchlib->addBranch ($param);
		$response = array();
		if($id) {
			$response['status'] = 1;
			$response['msg'] = "Branch added successfully.";
		} else {
			$response['status'] = 0;
			$response['msg'] = "Error! Please check your data.";
		}
		echo json_encode($response);
	}
	
	public function edit_branch ($id) {
		
		$this->load->library('dispatcher/BranchLib');
		$branch = $this->branchlib->getBranchByID($id);
		if(count($branch)) {
			$this->template->set ( 'branch', $branch[0] );
		}
		$this->template->set ( 'page', 'Branch' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Branch' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('add_branch');
	}
	
	public function update_branch () {
		$param = array();
		$param = $this->input->post('data');
		$param['updated_by'] = $this->session->userdata('admin')['id'];
		$param['updated_date'] = date('Y-m-d H:i:s');
		$this->load->library('dispatcher/BranchLib');
		$res = $this->branchlib->updateBranch ($param);
		$response = array();
		if($res) {
			$response['status'] = 1;
			$response['msg'] = "Branch updated successfully.";
		} else {
			$response['status'] = 0;
			$response['msg'] = "Error! Please check your data.";
		}
		echo json_encode($response);
	}

	public function get_branch_by_id ($id) {
		$this->load->library('dispatcher/BranchLib');
		$branch = $this->branchlib->getBranchByID ($id);
		echo json_encode($branch);
	}
}
