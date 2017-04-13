<?php
class JobClientLib {

	public function __construct() 
	{
		$this->CI = & get_instance ();
	}

	public function clientSaveJob ($data) 
	{
		$patient = array();
		$job = array();
		$data['client_id'] = $_SESSION['admin']['client_id'];
		$data['hospital_id'] = $_SESSION['admin']['hospital_id'];
		/********** Patient Data *****************/
		$patient['name'] = $data['name'];
		$patient['room_no'] = $data['room_no'];
		$patient['test'] = $data['test'];
		$patient['caller'] = $data['caller'];
		$patient['special_instruction'] =  $data['special_instruction'];
		$patient['created_by'] = $data['created_by'];
		$patient['created_date'] = $data['created_date'];
		$patient['hospital_id'] = $_SESSION['admin']['hospital_id'];
		$patient['client_id'] = $_SESSION['admin']['client_id'];
		//print_r($patient);
		//print_r($data);
		
		/********** Job Data *****************/
		$job['job_name'] = $data['job_name'];
		$job['description'] = $data['description'];
		$job['created_by']=$data['created_by'];
		$job['created_date']=$data['created_date'];
		$job['hospital_id'] = $_SESSION['admin']['hospital_id'];
		$job['client_id'] = $_SESSION['admin']['client_id'];
		/*********** Contact Data ***************/
		unset($data['name']);
		unset($data['room_no']);
		unset($data['test']);
		unset($data['caller']);
		unset($data['special_instruction']);
		unset($data['job_name']);
		unset($data['description']);
		//print_r($data);
		$this->CI->load->model ( 'patient/patient_model', 'patient' );
		$patient_id= $this->CI->patient->save_patient ( $patient );
		$job['patient_id']=$patient_id;
		$this->CI->load->model ( 'contact/contact_model', 'contact' );
		$contact = $this->CI->contact->save_contact ( $data );
		$job['job_contact_id']=$contact;
		$this->CI->load->model ('jobclient/jobclient_model', 'jobclient' );
		$job_id= $this->CI->jobclient->save_job ( $job );
		if($job_id) {
		
			/**** Pusher Management ****/
			$this->CI->load->model ( 'Notification_model', 'notification' );
			$this->CI->load->model ('hospital/Hospital_model', 'hospital' );
			$hospital= $this->CI->hospital->getHospitalById ($data['hospital_id']);
			if(count($hospital)) {
				$hospital_name = $hospital[0]['name'];
			} else {
				$hospital_name = "NA";
			}
			$this->CI->load->library('ci_pusher');
			$pusher = $this->CI->ci_pusher->get_pusher();
			$pusherdata = array();
		
			// Set message
			$pusherdata['admin_message'] = "New job ID ".getJobID($job_id)." is added by hospital '".$hospital_name."'. <a class='btn-primary' style='background: #f5821f;' href='".base_url()."admin/job_list' target='_blank'>&nbsp;&nbsp;View&nbsp;&nbsp;</a>";
			$pusherdata['title'] = 'New Job Received';
			$pusherdata['notification_type'] = 1;
			$pusherdata['client_id'] = $data['client_id'];
			$pusherdata['hospital_id'] = $data['hospital_id'];
		
			// Send message
			$event = $pusher->trigger('test_channel', 'my_event', $pusherdata);
		
			// Add Notification in DB
			$notification_params = array();
			$notification_params['client_id'] = $pusherdata['client_id'];
			$notification_params['hospital_id'] = $pusherdata['hospital_id'];
			$notification_params['notification_type'] = $pusherdata['notification_type'];
			$notification_params['created_date'] = date('Y-m-d H:i:s');
			$notification_params['title'] = "<a href='".base_url()."admin/job_list' target='_blank'><span class='notification-icon'>
                <span class='circle-icon bg-info text-white'>J</span></span>
                <div class='notification-message'>".$pusherdata['title'];
			$notification_params['notification'] = ' <span class="time">New job ID '.getJobID($job_id).' is added by hospital "'.$hospital_name.'". </span></div></a>';
			$notification_res = $this->CI->notification->addAdminNotification ($notification_params);
			/**** End Pusher Management ****/
		}
		return $job_id;
	}
	
	public function getAllJob($data)
	{
		$this->CI->load->model ('jobclient/jobclient_model', 'jobclient' );
		$job= $this->CI->jobclient->getAllJob ( $data );
		return $job;
	}
	
	
	public function getjobClientById($jobid)
	{
		$this->CI->load->model ('jobclient/jobclient_model', 'jobclient' );
		$job= $this->CI->jobclient->getjobClientById ( $jobid );
		return $job;
	}
	
	public function updateJobClientById($data)
	{
		$patient = array();
		$job = array();
		$patient['id'] = $data['patient_id'];
		$patient['name'] = $data['name'];
		$patient['caller'] = $data['caller'];
		$job['id'] = $data['job_id'];
		$job['job_name'] = $data['job_name'];
		unset($data['name']);
		unset($data['job_name']);
		unset($data['caller']);
		
		$this->CI->load->model ( 'patient/patient_model', 'patient' );
		$patient_id= $this->CI->patient->update_patient ( $patient );
		$this->CI->load->model ( 'contact/contact_model', 'contact' );
		$contact = $this->CI->contact->update_contact ( $data );
		$this->CI->load->model ('jobclient/jobclient_model', 'jobclient' );
		$job= $this->CI->jobclient->update_job ( $job );
		return $job;
	}
	
	public function getCustomerList()
	{
		$this->CI->load->model ( 'contact/contact_model', 'contact' );
		$contact = $this->CI->contact->getCustomerList ();
		return $contact;
	}
	
	public function getPatientList()
	{
		$this->CI->load->model ( 'patient/patient_model', 'patient' );
		$patient= $this->CI->patient->getPatientList ();
		return $patient;
	}
	
	public function clientjobByMob($data)
	{
		$this->CI->load->model ('jobclient/jobclient_model', 'jobclient' );
		$job= $this->CI->jobclient->clientjobByMob ( $data );
		return $job;
	}
	
}
