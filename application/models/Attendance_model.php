<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

/**
 * Attendance model
 *
 * <p>
 * We are using this model to add, update, delete and get attendance.
 * </p>
 *
 * @package Attendance
 * @author Nushrat
 * @copyright Copyright &copy; 2015, Dispatcher
 * @category CI_Model API
 */
class Attendance_model extends CI_Model {

	function __construct() {
		parent::__construct ();
	}


	public function getAttendanceByAdminID ($param) {
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$ADMIN_ATTENDANCE );
		if(isset($param['admin_id'])) {
			$this->db->where ( 'admin_id', $param['admin_id'] );
		}
		if(isset($param['is_limited'])) {
			$this->db->limit (5);
		}
		$this->db->order_by ('action_time','DESC');
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	

	public function addAttendanceAction ($data)
	{
		$this->db->insert(TABLES::$ADMIN_ATTENDANCE,$data);
		return $attendance_id = $this->db->insert_id();
	}

	public function getFieldworkerAttendance ($param) {
		
		$sql = "select *,(CASE WHEN present IS NULL THEN 'No' ELSE 'Yes' END) AS attendance from (SELECT a.id as admin_id,present,a.client_id,a.hospital_id,concat(a.first_name,' ',a.last_name) as worker_name,aa.action_time FROM (select * from tbl_admin_user where user_role=7) AS `a` LEFT JOIN (SELECT admin_id,count(admin_id) as present,action_time from tbl_admin_attendance where DATE(action_time) = '".$param['date']."') as `aa` ON `a`.`id`=`aa`.`admin_id` ) as b where ";
		
		if(isset($param['client_id'])) {
			$sql .= 'b.client_id='.$param['client_id'];
		}
		if(isset($param['admin_id'])) {
			$sql .= ' AND b.admin_id='.$param['admin_id'];
		}
		if(isset($param['hospital_id'])) {
			$sql .= ' AND b.hospital='.$param['hospital_id'];
		}
		//echo $sql;
		 $query = $this->db->query($sql);
		//echo $this->db->last_query();
		return $query->result_array();
		
	}

}

