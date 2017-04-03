<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/**
 * Auth API
 * @author Nushrat
 * @package Auth
 *
 */
class Api extends REST_Controller {

	public function getAssignJobDetailByFieldworker_get ()
	{
		$id = $this->get('user_id');
		$this->load->library('dispatcher/JobLib');
		$userdata = $this->joblib->getAssignJobDetailByFieldworker($id);
		$userdata ['status'] = 1;
		$userdata ['msg'] = "Updated successfully";
		echo json_encode($userdata);
	}
	public function getJobDetailById_get ()
	{
		$id = $this->get('id');
		$this->load->library('dispatcher/JobLib');
		$userdata = $this->joblib->getJobDetailById($id);
		echo json_encode($userdata);
			
	}
	public function updateJobAction_post ()
	{
		$data = array();
		$data['action_id'] = $this->post('action_id');
		$data['job_id'] = $this->post('action_id');
		$data['id'] = $this->post('id');
		$data['latitude'] = $this->post('latitute');
		$data['longitude'] = $this->post('longitude');
		$data['locality'] = $this->post('locality');
		$this->load->library('dispatcher/JobLib');
		$this->joblib->getJobDetailById($data);
		$res['status'] = 1;
		$res['msg'] = "Updated successfully";
		echo json_encode($res);
	}





}




