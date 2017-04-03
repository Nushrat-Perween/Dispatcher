<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

/**
 * Report model
 *
 * <p>
 * We are using this model to add, update, delete and get report.
 * </p>
 *
 * @package Report
 * @author Nushrat
 * @copyright Copyright &copy; 2015, Dispatcher
 * @category CI_Model API
 */
class Report_model extends CI_Model {

	function __construct() {
		parent::__construct ();
	}


	public function getCutomerReport () {
		$this->db->select ( 'sum(if(is_blocked=1,1,0)) as block_customer,sum(if (date(created_date)=date(now()),1,0)) as new_customer,count(id) as total_customer' )->from ( TABLES::$ADMIN);
		$this->db->where('user_role',3);
		//echo $this->db->get_compiled_select();
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	
	}
	public function getJobByCustomer ()
	{
		$this->db->select ( 'sum(if(status=1,1,0)) as success,sum(if(status=0,1,0)) as pending,sum(if(status=2,1,0)) as cancel,count(id) as total' )->from ( TABLES::$JOB);
		$this->db->where('client_id',$_SESSION['admin']['client_id']);
		//echo $this->db->get_compiled_select();
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
}