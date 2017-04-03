<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends MX_Controller {

	function __construct()
	{
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/FB.ini" );
	}



	/**
	 * get branch
	 */
	public function get_branch_by_company_id ($company_id) {
		$this->load->library('dispatcher/GeneralLib');
		$branch_array = $this->generallib->getBranchByCompanyID ($company_id);
		$branch = array();
		foreach ($branch_array as $row) {
			$branch[] = $row['branch_name'];
		}
		//print_r($branch);
		echo json_encode($branch);
	}




}

?>
