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
		//$userdata ['status'] = 1;
		//$userdata ['msg'] = "Updated successfully";
		$this->response($userdata);
	}
	public function getJobDetailById_get ()
	{
		$id = $this->get('job_id');
		$this->load->library('dispatcher/JobLib');
		$userdata = $this->joblib->getJobDetailById($id);
		$this->response($userdata);
		//echo json_encode($id);
			
	}
	public function updateJobAction_post ()
	{
		$data = array();
		$data['action_id'] = $this->post('action_id');
		$data['id'] = $this->post('job_id');
		$data['updated_by'] = $this->post('user_id');
		$data['updated_date'] = date('Y-m-d H:i:s');
		$history_data['job_id'] = $this->post('job_id');
		$history_data['last_known_location'] = $this->post('last_known_location');
		$history_data['latitude'] = $this->post('latitute');
		$history_data['longitude'] = $this->post('longitude');
		$history_data['last_location_date'] = date('Y-m-d',strtotime($this->post('last_location_date')));
		$history_data['last_location_time'] = date('H:i:s',strtotime($this->post('last_location_time')));
		$history_data['comment'] = $this->post('comment');
		$history_data['action_id'] = $this->post('action_id');
		$history_data['is_mobile'] = 1;
		$history_data['created_by'] = $this->post('user_id');
		$history_data['created_date'] = date('Y-m-d H:i:s');
		$this->load->library('dispatcher/JobLib');
		$resp = $this->joblib->updateJobAction($data);
		$job_history_resp = $this->joblib->saveJobHistory($history_data);
		if($resp) {
			if($job_history_resp) {
				$res['status'] = 1;
				$res['msg'] = "Updated successfully";
			} else {
				$res['status'] = 0;
				$res['msg'] = "Please check your data Job History is not saved.";
			}
		} else {
			$res['status'] = 0;
			$res['msg'] = "Please check your data Job is not updated.";
		}
		
		//echo json_encode($res);
		$this->response($res);
	}
	public function getJobCount_get()
	{
		$id = $this->get('id');
		$this->load->library('dispatcher/JobLib');
		$jobcount = $this->joblib->getJobCount($id);
		$this->response($jobcount);
	}


	public function getTripDetails_get()
	{
		$id = $this->get('id');
		$this->load->library('dispatcher/JobLib');
		$trip = $this->joblib->getTripDetails($id);
		$this->response($trip);
	}

}




