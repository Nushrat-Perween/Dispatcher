<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends MX_Controller {

	function __construct()
	{
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( 'cookie' );
		$fb_config = parse_ini_file ( APPPATH . "config/FB.ini" );
	}



	/**
	 * get branch
	 */
	public function getAllNotification () {
		
		$notification_param = array();
		$notification_param['client_id'] = $this->session->userdata('admin')['client_id'];
		
		$this->load->library('dispatcher/NotificationLib');
		$notification = $this->notificationlib->getAllAdminNotification($notification_param);
		
		$count_notification = 0;
		
		$i=0;
		$sr=1;
		$data = array();
		foreach ($notification as $row) {
			$count_notification++ ;
			$data[$i]['id'] = $row['id'];
			$data[$i]['client_id'] = $row['client_id'];
			$data[$i]['hospital_id'] = $row['hospital_id'];
			$data[$i]['title'] = $row['title'];
			$data[$i]['notification'] = $row['notification'];
			$data[$i]['notification_type'] = $row['notification_type'];
			$data[$i]['created_date'] = $row['created_date'];
			$data[$i]['is_read'] = $row['is_read'];
			$i++;
		}
		//echo $count_notification;
		$res['admin_notification_count'] = $count_notification;
		$res['admin_notification'] = $data;
		$this->session->set_userdata('admin_notification_count',$count_notification);
		$this->session->set_userdata('admin_notification',$data);
		echo json_encode($res);
	}


	/**
	 * Turn on/off automatic notification
	 *
	 * @return array
	 */
	public function turn_on_off_notification () {
		$this->load->library('dispatcher/AdminLib');
		$param = array();
		$result = 0;
		//unset($param['user_id']);
		$param = $this->input->post();
		$params['id'] = $this->session->userdata('admin')['id'];
		$params['updated_date'] = date('Y-m-d H:i:s');
		$params['updated_by'] = $this->session->userdata('admin')['id'];
	
		if(isset($param['turn_on'])) {
			$params['is_notification_active'] = 1;
	
		} else if(isset($param['turn_off'])) {
			$params['is_notification_active'] = 0;
		}
	
		$result = $this->adminlib->updateAdminById ($params);
	
	
		if($result)
		{
			$message = "No message";
			if(isset($param['turn_on'])) {
				$message = "Turn on getting notification is successfully.";
				$_SESSION['admin']['is_notification_active'] = 1;
			} else if(isset($param['turn_off'])) {
				$message = "Turned off getting notification is successfully.";
				$_SESSION['admin']['is_notification_active'] = 0;
			}
			$response['status'] = 1;
			$response['message'] = $message;
	
		}
		else
		{
			$response['status'] = 0;
			$response['message'] = "<b>Failed ! Please check.</b>";
	
		}
	
		echo json_encode($response);
	}

}

?>
