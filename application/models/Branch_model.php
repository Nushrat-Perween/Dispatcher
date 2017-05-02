<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

/**
 * Notification model
 *
 * <p>
 * We are using this model to add, update, delete and get notification.
 * </p>
 *
 * @package Branch
 * @author Nushrat
 * @copyright Copyright &copy; 2015, Dispatcher
 * @category CI_Model API
 */
class Branch_model extends CI_Model {

	function __construct() {
		parent::__construct ();
	}


	/**
	 * get all notification
	 *
	 * @return array
	 */
	public function getAllBranch ($param)
	{
		$this->db->select ( 'b.*,h.name as hospital_name' );
		$this->db->from ( TABLES::$BRANCH. ' AS b' );
		$this->db->join ( TABLES::$HOSPITAL . ' AS h', 'h.id=b.hospital_id', 'inner' );
		$this->db->where ( 'b.is_deleted', 0 );
		if(isset($param['client_id'])) {
			$this->db->where ( 'b.client_id', $param['client_id'] );
		}
		if(isset($param['hospital_id'])) {
			$this->db->where ( 'b.hospital_id', $param['hospital_id'] );
		}
		$this->db->where ( 'DATE(b.created_date)', date('Y-m-d') );
		$this->db->order_by ( 'b.created_date', 'DESC' );
		$query = $this->db->get ();
		//echo $query = $this->db->last_query ();
		$result = $query->result_array ();
		return $result;
	}
	
	/**
	 * Add branch
	 *
	 * @param array $params
	 * @return integer branch ID
	 */
	public function addBranch ($params) {
		$this->db->insert(TABLES::$BRANCH,$params);
		return $this->db->insert_id();
	}
	
	public function getBranchByID ($id) {
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$BRANCH);
		$this->db->where ( 'is_deleted', 0 );
		$this->db->where ( 'id', $id );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	/**
	 * Update Branch
	 *
	 * @param array $data
	 * @return integer 0/1
	 */
	public function updateBranch ($data) {
		$this->db->where ( 'id', $data['id'] );
		return $this->db->update(TABLES::$BRANCH,$data);
	}



}

