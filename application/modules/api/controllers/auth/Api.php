<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/**
 * Auth API
 * @author Nushrat
 * @package Auth
 *
 */
class Api extends REST_Controller {

	/**
	 * Fuction For user Login
	 * @return json
	 */
	public function loginUser_post()
	{
		$data = array();
		$map = array();
		$data['username'] = $this->post('username');
		$data['password'] = $this->post('password');
		$data['gcm_id'] = $this->post('gcm_id');
	  
		$this->load->library('dispatcher/auth');
		$userdata = $this->auth->adminlogin($data);
		$map = $userdata['result'];
		$map ['status'] = $userdata['status'];
		if($userdata['status'] == 1) {
			$this->session->set_userdata('admin',$userdata['result']);
		}
		echo json_encode($map);
	  
	}

	public function markAttendanceAsSignin_post () {
		$param = array();
		$res = array();
		$param['admin_id'] = $this->post('user_id');
		$param['gcm_id'] = $this->post('gcm_id');
		$param['action'] = 1;
		$param['action_time'] = date('Y-m-d H:i:s');
		$this->load->library('dispatcher/AttendanceLib');
		$attendance = $this->attendancelib->addAttendanceAction ($param);
		if($attendance) {
			$res['status'] = 1;
			$res['msg'] = "Sign in successfully";
		} else {
			$res['status'] = 0;
			$res['msg'] = "Please check some error occur.";
		}
		echo json_encode($res);
	}

	public function markAttendanceAsSignout_post () {
		$param = array();
		$res = array();
		$param['admin_id'] = $this->post('user_id');
		$param['gcm_id'] = $this->post('gcm_id');
		$param['action'] = 0;
		$param['action_time'] = date('Y-m-d H:i:s');
		$this->load->library('dispatcher/AttendanceLib');
		$attendance = $this->attendancelib->addAttendanceAction ($param);
		if($attendance) {
			$res['status'] = 1;
			$res['msg'] = "Sign out successfully";
		} else {
			$res['status'] = 0;
			$res['msg'] = "Please check some error occur.";
		}
		echo json_encode($res);
	}
	
	public function updateCurrentLocationById_post()
	{
		$data = array();
		$data['current_locality'] = $this->post('locality');
		$data['id'] = $this->post('id');
		$data['current_latitude'] = $this->post('latitude');
		$data['current_longitude'] = $this->post('longitude');
		$this->load->library('delivery/AdminLib');
		$fieldworker = $this->adminlib->updateCurrentLocationById ($data);
		if($fieldworker)
		{
			$res['staus'] = 1;
			$res['msg'] = "Updated Successfully";
		}
		else
		{
			$res['status'] = 0;
			$res['msg'] = "Please check some error occur.";
		}
		echo json_encode($res);
	}
	


}

