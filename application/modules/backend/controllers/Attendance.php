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
		$this->template->set_layout ('backend')
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
	$param = array();
	$param['client_id'] = $this->session->userdata('admin')['client_id'];
	$param['date'] = date('Y-m-d');
	$this->load->library('dispatcher/AttendanceLib');
	$attendance_list = $this->attendancelib->getFieldworkerAttendance ($param);
	$this->template->set ( 'attendance_list', $attendance_list );
	$this->template->set ( 'page', 'Attendance' );
	$this->template->set_theme('default_theme');
	$this->template->set_layout ('backend')
	->title ( 'Dispatcher | Dashboard' )
	->set_partial ( 'header', 'partials/header' )
	->set_partial ( 'side_menu', 'partials/side_menu' )
	->set_partial ( 'chat_model', 'partials/chat_model' )
	->set_partial ( 'footer', 'partials/footer' );
	$this->template->build ('fieldworker_attendance');
}
	

}
