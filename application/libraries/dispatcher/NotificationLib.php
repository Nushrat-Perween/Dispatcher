<?php
class NotificationLib {

	public function __construct() {
		$this->CI = & get_instance ();
	}



	public function getAllNotification ($param) {
		$this->CI->load->model ( 'Notification_model', 'notification' );
		$notification = $this->CI->notification->getAllNotification ( $param );
		return $notification;
	}
	
	public function getAllAdminNotification ($param) {
		$this->CI->load->model ( 'Notification_model', 'notification' );
		$notification = $this->CI->notification->getAllAdminNotification ( $param );
		return $notification;
	}




}
