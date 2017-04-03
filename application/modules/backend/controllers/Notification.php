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
	
		$this->load->library('dispatcher/NotificationLib');
		$notification = $this->notificationlib->getAllAdminNotification($notification_param);
		
		$count_notification = 0;
		
		$i=0;
		$sr=1;
		$data = array();
		foreach ($notification as $row) {
			$count_notification++ ;
			$data[$i]['id'] = $row['id'];
			$data[$i]['title'] = $row['title'];
			$data[$i]['notification'] = $row['notification'];
			$data[$i]['notification_type'] = $row['notification_type'];
			$data[$i]['created_date'] = $row['created_date'];
			$data[$i]['is_read'] = $row['is_read'];
			$i++;
		}
		//echo $count_notification;
		$res['notification_count'] = $count_notification;
		$res['notification'] = $data;
		$this->session->set_userdata('admin_notification_count',$count_notification);
		$this->session->set_userdata('admin_notification',$data);
		echo json_encode($res);
	}




}

?>
