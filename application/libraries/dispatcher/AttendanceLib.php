<?php
class AttendanceLib {

	public function __construct() {
		$this->CI = & get_instance ();
	}

	public function getAttendanceByAdminID ($param) {
		$this->CI->load->model ( 'Attendance_model', 'attendance' );
		$res = $this->CI->attendance->getAttendanceByAdminID ( $param );
		return $res;
	}
	
	public function addAttendanceAction ($data) {
		$this->CI->load->model ( 'Attendance_model', 'Attendance_model' );
		$res = $this->CI->Attendance_model->addAttendanceAction ( $data );
		return $res;
	}
	
	public function getFieldworkerAttendance ($param) {
		$this->CI->load->model ( 'Attendance_model', 'Attendance_model' );
		$res = $this->CI->Attendance_model->getFieldworkerAttendance ( $param );
		return $res;
	}
	
	public function getMonthlyFieldworkerAttendance ($param) {
		$this->CI->load->model ( 'Attendance_model', 'Attendance_model' );
		$res = $this->CI->Attendance_model->getMonthlyFieldworkerAttendance ( $param );
		return $res;
	}

}
