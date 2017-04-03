<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

/**
 * User model
 *
 * <p>
 * We are using this model to add, update, delete and get users.
 * </p>
 *
 * @package User
 * @author Nushrat
 * @copyright Copyright &copy; 2015, Dispatcher
 * @category CI_Model API
 */
class Package_model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	
	public function save_package ($data)
	{
		$this->db->insert(TABLES::$PACKAGING,$data);
		return $this->db->insert_id();
	}
	
	public function getAllPackage()
	{
		$this->db->select ( '*' )->from ( TABLES::$PACKAGING);
		$query = $this->db->get ();
		$result = $query->result_array ();
		return $result;
	}
}

