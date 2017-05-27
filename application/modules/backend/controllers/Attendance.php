<?php
class Attendance extends MX_Controller {
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
	
public function index() {
		$param = array();
		$param['admin_id'] = $this->session->userdata('admin')['id'];
		$param['client_id'] = $this->session->userdata('admin')['client_id'];
		$param['is_limited'] = 1;
		$this->load->library('dispatcher/AttendanceLib');
		$attendance_list = $this->attendancelib->getAttendanceByAdminID ($param);
		$this->template->set ( 'attendance_list', $attendance_list );
		if(count($attendance_list)) {
			$this->session->set_userdata('attendance_last_action',$attendance_list[0]['action']);
		} else {
			$this->session->set_userdata('attendance_last_action',0);
		}
		$this->template->set ( 'attendance_list', $attendance_list );
		$this->template->set ( 'page', 'Attendance' );
		$this->template->set_theme('default_theme');
		$this->template->set_layout ('default')
		->title ( 'Dispatcher | Dashboard' )
		->set_partial ( 'header', 'partials/header' )
		->set_partial ( 'side_menu', 'partials/side_menu' )
		->set_partial ( 'chat_model', 'partials/chat_model' )
		->set_partial ( 'footer', 'partials/footer' );
		$this->template->build ('attendance');
	}
	
public function get_latest_attendance () {
	$param = array();
	$param['admin_id'] = $this->session->userdata('admin')['id'];
	$param['is_limited'] = 1;
	$this->load->library('dispatcher/AttendanceLib');
	$attendance_list = $this->attendancelib->getAttendanceByAdminID ($param);

	$i=0;
	$data = array();
	foreach($attendance_list as $row) {
		if($row['action'] == 1) { 
			$data[$i]['action'] = "Sign In    - ";
		} else{ 
			$data[$i]['action'] = "Sign Out - "; 
		}
		$data[$i]['time']=date('d M Y H:i',strtotime($row['action_time']));
		$i++;
	}
	echo json_encode($data);
}
public function mark_attendance_as_signin () {
	$param = array();
	$param['admin_id'] = $this->session->userdata('admin')['id'];
	$param['action'] = 1;
	$param['action_time'] = date('Y-m-d H:i:s');
	$this->load->library('dispatcher/AttendanceLib');
	$attendance_list = $this->attendancelib->addAttendanceAction ($param);
}
	
public function mark_attendance_as_signout () {
	$param = array();
	$param['admin_id'] = $this->session->userdata('admin')['id'];
	$param['action'] = 0;
	$param['action_time'] = date('Y-m-d H:i:s');
	$this->load->library('dispatcher/AttendanceLib');
	$attendance_list = $this->attendancelib->addAttendanceAction ($param);
}
	
public function fieldworker_attendance () {
	$data = array();
	$data['user_role'] = 7;
	$data['client_id'] = $this->session->userdata('admin')['client_id'];
	$this->load->library('dispatcher/AdminLib');
	$field_worker = $this->adminlib->getAllAdmin ($data);
	$this->template->set ( 'field_worker', $field_worker );
	$param = array();
	$param['client_id'] = $this->session->userdata('admin')['client_id'];
	$param['start_date'] = date('Y-m-01');
	$param['end_date'] = date('Y-m-t');
	$this->load->library('dispatcher/AttendanceLib');
	$attendance_list = $this->attendancelib->getMonthlyFieldworkerAttendance ($param);
	//$attendance_list = $this->attendancelib->getFieldworkerAttendance ($param);
	$this->template->set ( 'attendance_list', $attendance_list );
	$this->template->set ( 'page', 'Attendance' );
	$this->template->set_theme('default_theme');
	$this->template->set_layout ('default')
	->title ( 'Dispatcher | Dashboard' )
	->set_partial ( 'header', 'partials/header' )
	->set_partial ( 'side_menu', 'partials/side_menu' )
	->set_partial ( 'chat_model', 'partials/chat_model' )
	->set_partial ( 'footer', 'partials/footer' );
	$this->template->build ('fieldworker_attendance');
}

public function filter_fieldworker_attendance () {
	$params = array();
	$params = $this->input->post();
	if($params['admin_id'] == "") {
		unset($params['admin_id']);
	}
	if($params['month'] != "") {
		$params['start_date'] = date('Y-'.$params['month'].'-01');
		$params['end_date'] = date('Y-'.$params['month'].'-t');
	} else {
		$param['start_date'] = date('Y-m-01');
		$param['end_date'] = date('Y-m-t');
	}
	unset($params['month']);
	$params['client_id'] = $this->session->userdata('admin')['client_id'];
	$this->load->library('dispatcher/AttendanceLib');
	$result = $this->attendancelib->getMonthlyFieldworkerAttendance ($params);

	$i=0;
	$sr=1;
	$data = array();
	foreach($result as $row) {

		if($row['action_time'] == NULL)
			$data[$i]['date'] = 'NA';
		else
			$data[$i]['date']=date('d-m-Y',strtotime($row['action_time']));

		if($row['action_time'] == NULL)
			$data[$i]['time'] = 'NA';
		else
			$data[$i]['time']=date(' g:i A',strtotime($row['action_time']));



		$data[$i]['action']=$row['attendance'];
		if($row['location'] == "" OR $row['location'] == NULL) {
			$data[$i]['location'] = "NA";
		} else {
			$data[$i]['location'] = $row['location'];
		}
		if($row['fieldworker_name'] == "" OR $row['fieldworker_name'] == NULL) {
			$data[$i]['fieldworker_name'] = "NA";
		} else {
			$data[$i]['fieldworker_name'] = $row['fieldworker_name'];
		}
							

		$i++;
		$sr++;
	}
	echo json_encode($data);
}


}
