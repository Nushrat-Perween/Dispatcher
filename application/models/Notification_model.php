<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

/**
 * Notification model
 *
 * <p>
 * We are using this model to add, update, delete and get notification.
 * </p>
 *
 * @package Patient
 * @author Nushrat
 * @copyright Copyright &copy; 2015, Dispatcher
 * @category CI_Model API
 */
class Notification_model extends CI_Model {

	function __construct() {
		parent::__construct ();
	}


		/**
		 * Add notification
		 *
		 * @param array $params
		 * @return integer notification ID
		 */
		public function addNotification ($params) {
			$this->db->insert(TABLES::$NOTIFICATION,$params);
			return $this->db->insert_id();
		}

		/**
		 * Add admin notification
		 *
		 * @param array $params
		 * @return integer notification ID
		 */
		public function addAdminNotification ($params) {
			$this->db->insert(TABLES::$ADMIN_NOTIFICATION,$params);
			return $this->db->insert_id();
		}


		/**
		 * get all notification
		 *
		 * @return array
		 */
		public function getAllNotification ($param)
		{
			$this->db->select ( '*' );
			$this->db->from ( TABLES::$NOTIFICATION);
			$this->db->where ( 'is_deleted', 0 );
			if(isset($param['company_id'])) {
				$this->db->where ( 'company_id', $param['company_id'] );
			}
			if(isset($param['branch_id'])) {
				$this->db->where ( 'branch_id', $param['branch_id'] );
			}
			//$this->db->where ( 'DATE(created_date)', date('Y-m-d') );
			$this->db->order_by ( 'created_date', 'DESC' );
			$query = $this->db->get ();
			//echo $query = $this->db->last_query ();
			$result = $query->result_array ();
			return $result;
		}
		
		/**
		 * get all notification
		 *
		 * @return array
		 */
		public function getAllAdminNotification ($param)
		{
			$this->db->select ( '*' );
			$this->db->from ( TABLES::$ADMIN_NOTIFICATION);
			$this->db->where ( 'is_deleted', 0 );
			if(isset($param['company_id'])) {
				$this->db->where ( 'company_id', $param['company_id'] );
			}
			if(isset($param['branch_id'])) {
				$this->db->where ( 'branch_id', $param['branch_id'] );
			}
			//$this->db->where ( 'DATE(created_date)', date('Y-m-d') );
			$this->db->order_by ( 'created_date', 'DESC' );
			$query = $this->db->get ();
			//echo $query = $this->db->last_query ();
			$result = $query->result_array ();
			return $result;
		}

}

