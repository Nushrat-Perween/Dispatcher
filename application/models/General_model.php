<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

/**
 * General model
 *
 * <p>
 * We are using this model to add, update, delete and get all things.
 * </p>
 *
 * @package General
 * @author Nushrat
 * @copyright Copyright &copy; 2015, Dispatcher
 * @category CI_Model API
 */
class General_model extends CI_Model {

	function __construct() {
		parent::__construct ();
	}


	public function getAllUserOfCompany ($company_id,$user_id) {
		$this->db->select ( 'u.*' );
		$this->db->from ( TABLES::$USERS.' AS u' );
		$this->db->join ( TABLES::$COMPANY.' AS c',"u.company_id=c.id","left" );
		$this->db->where ( 'u.is_deleted', 0 );
		$this->db->where ( 'u.id !=', $user_id );
		$this->db->where ( 'u.verified', 1 );
		$this->db->where ( 'c.id', $company_id );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getBranchByCompanyID ($company_id) {
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$BRANCH);
		$this->db->where ( 'is_deleted', 0 );
		$this->db->where ( 'company_id', $company_id );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getFieldWorkerByBranch ($company_id,$branch_id) {
		$this->db->select ( 'id,first_name,last_name,user_role' );
		$this->db->from ( TABLES::$USERS);
		$this->db->where ( 'is_deleted', 0 );
		$this->db->where ( 'company_id', $company_id );
		$this->db->where ( 'branch_id', $branch_id );
		$this->db->where ( 'user_role', 4 );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}




}

