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
		$this->db->join ( TABLES::$ADMIN . ' AS aa', 'id=aa.admin_id', 'left' );
		if(isset($param['admin_id'])) {
			$this->db->where ( 'admin_id', $param['admin_id'] );
		}
		if(isset($param['admin_id'])) {
			$this->db->where ( 'aa.client_id', $param['client_id'] );
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
	
	public function getMonthlyFieldworkerAttendance ($param) {
		$this->db->select ( "aa.*,(CASE WHEN action = 1 THEN 'Sign In' ELSE 'Sign Out' END) AS attendance,concat(a.first_name,' ',a.last_name) as fieldworker_name" );
		$this->db->from ( TABLES::$ADMIN.' AS a' );
		$this->db->join ( TABLES::$ADMIN_ATTENDANCE . ' AS aa', 'a.id=aa.admin_id', 'left' );
		if(isset($param['admin_id'])) {
			$this->db->where ( 'admin_id', $param['admin_id'] );
		}
		if(isset($param['client_id'])) {
			$this->db->where ( 'a.client_id', $param['client_id'] );
		}
		if(isset($param['hospital_id'])) {
			$this->db->where ( 'a.hospital_id', $param['hospital_id'] );
		}
		if(isset($param['start_date']) || isset($param['end_date'])) {
			if($param['start_date']!="" and $param['end_date']=="") {
				$this->db->where("DATE(aa.action_time) >='".$param['start_date']."'",'',FALSE);
			} else if($param['start_date']=="" and $param['end_date']!="") {
				$this->db->where("DATE(aa.action_time) <='".$param['end_date']."'",'',FALSE);
			} else {
				$this->db->where(" (DATE(aa.action_time) BETWEEN '".$param['start_date']."' AND '".$param['end_date']."')",'',FALSE);
			}
				
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
		
		$sql = "select *,(CASE WHEN present IS NULL THEN 'No' ELSE 'Yes' END) AS attendance from (SELECT a.id as admin_id,present,a.client_id,a.hospital_id,concat(a.first_name,' ',a.last_name) as worker_name,aa.action_time FROM (select * from tbl_admin_user where user_role=7) AS `a` LEFT JOIN (SELECT admin_id,count(admin_id) as present,action_time from tbl_admin_attendance where DATE(action_time) = '".$param['date']."' group by admin_id) as `aa` ON `a`.`id`=`aa`.`admin_id` ) as b where ";
		
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

