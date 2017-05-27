<?php
    class JobLib {
        
        public function __construct() {
            $this->CI = & get_instance ();
        }
        
        public function getAllClientJob ($data) {
            $this->CI->load->model ( 'Job_model', 'job' );
            $job = $this->CI->job->getAllClientJob ($data);
            return $job;
        }
        
        public function getLastJobID () {
            $this->CI->load->model ( 'Job_model', 'job' );
            $users = $this->CI->job->getLastJobID ();
            return $users;
        }
        
        public function saveClientJob ($patient,$contact,$job) {
        	
        	$this->CI->load->model ( 'patient/patient_model', 'patient' );
        	$patient_id= $this->CI->patient->save_patient ( $patient );
        	$job['patient_id']=$patient_id;
        	$this->CI->load->model ( 'contact/contact_model', 'contact' );
        	$contact = $this->CI->contact->save_contact ( $contact );
        	$job['job_contact_id']=$contact;
        	$this->CI->load->model ('Job_model', 'job' );
        	$job_id= $this->CI->job->addJob ( $job );
        	if($job_id) {
        	
        		/**** Pusher Management ****/
        		$this->CI->load->model ( 'Notification_model', 'notification' );
        		$this->CI->load->model ('hospital/Hospital_model', 'hospital' );
        		$hospital= $this->CI->hospital->getHospitalById ($contact['pickup_hospital_id']);
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
        		$pusherdata['client_id'] = $patient['client_id'];
        		$pusherdata['hospital_id'] = $patient['hospital_id'];
        	
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
        public function updateJob ($data) {
            $this->CI->load->model ( 'Job_model', 'job' );
            $res = $this->CI->job->updateJob ( $data );
            return $res;
        }
        
        public function updateJobContact ($data) {
            $this->CI->load->model ( 'contact/Contact_model', 'contact' );
            $res = $this->CI->contact->update_contact ( $data );
            return $res;
        }
        
        public function getJobByID ($data) {
            $this->CI->load->model ( 'Job_model', 'job' );
            $job = $this->CI->job->getJobByID ( $data );
            return $job;
        }
        public function addJobContact ($data) {
            $this->CI->load->model ( 'Job_model', 'job' );
            $job_contact_id = $this->CI->job->addJobContact ( $data );
            return $job_contact_id;
        }
        public function addAssignJob ($data) {
            $this->CI->load->model ( 'Job_model', 'job' );
            $assign_job_id = $this->CI->job->addAssignJob ( $data );
            return $assign_job_id;
        }
        
        public function updateUserById ($data) {
            $this->CI->load->model ( 'users/user_model', 'user' );
            $res = $this->CI->user->updateUserById ($data);
            return $res;
        }
        
        public function getJobList () {
            $this->CI->load->model ( 'Job_model', 'job' );
            $job_list = $this->CI->job->getJobList ();
            return $job_list;
        }
        
        public function getAllJobList () {
            $this->CI->load->model ( 'Job_model', 'job' );
            $job_list = $this->CI->job->getAllJobList ();
            return $job_list;
        }
        
        public function getJobNotStarted () {
            $this->CI->load->model ( 'Job_model', 'job' );
            $job_list = $this->CI->job->getJobNotStarted ();
            return $job_list;
        }
        
        /**
         * filter Job
         *
         * @return array
         */
        public function getFilterJob ($param) {
            $this->CI->load->model ( 'Job_model', 'job' );
            $data = $this->CI->job->getFilterJob ($param);
            return $data;
        }
        
        /**
         * Get Job status by company
         *
         * @return array
         */
        public function getJobStatusByCompanyID ($client_id) {
            $this->CI->load->model ( 'Job_model', 'job' );
            $data = $this->CI->job->getJobStatusByCompanyID ($client_id);
            return $data;
        }
        
        
        /**
         * Get Assigned Job by Admin ID
         *
         * @return array
         */
        public function getAssignedJobByAdminID ($data) {
            $this->CI->load->model ( 'Job_model', 'job' );
            $res = $this->CI->job->getAssignedJobByAdminID ($data);
            return $res;
        }
        
        public function updateJobAssignment ($data) {
            $this->CI->load->model ( 'Job_model', 'job' );
            $res = $this->CI->job->updateJobAssignment ($data);
            return $res;
        }
        
        public function getAllJobAction () {
            $this->CI->load->model ( 'Job_model', 'job' );
            $res = $this->CI->job->getAllJobAction ();
            return $res;
        }
        
        public function getAllJobStatus () {
            $this->CI->load->model ( 'Job_model', 'job' );
            $res = $this->CI->job->getAllJobStatus ();
            return $res;
        }
        
        public function getAssignJobDetailByFieldworker($id)
        {
        	$this->CI->load->model ( 'Job_model', 'job' );
        	$res = $this->CI->job->getAssignJobDetailByFieldworker ($id);
        	return $res;
        }
        public function getJobDetailById($id)
        {
        	$this->CI->load->model ( 'Job_model', 'job' );
        	$res = $this->CI->job->getJobDetailById ($id);
        	return $res;
        }
        
        public function updateJobAction($id)
        {
        	$this->CI->load->model ( 'Job_model', 'job' );
        	$res = $this->CI->job->updateJobAction ($id);
        	return $res;
        }
        
        public function getJobActionHistoryByID ($id)
        {
        	$this->CI->load->model ( 'Job_model', 'job' );
        	$res = $this->CI->job->getJobActionHistoryByID ($id);
        	return $res;
        }
        
        public function getDeliveryStatusByJobId($job_id)
        {
        	$this->CI->load->model ( 'Job_model', 'job' );
        	$delivery = $this->CI->job->getDeliveryStatusByJobId ($job_id);
        	return $delivery;
        }
        
        public function getAdvisorInsight($data)
        {
        	$this->CI->load->model ( 'Job_model', 'job' );
        	$res = $this->CI->job->getAdvisorInsight ($data);
        	return $res;
        }
        public function getJobCount($id)
        {
        	$this->CI->load->model ( 'job_model', 'job' );
        	$order = $this->CI->job->getJobCount ($id);
        	return $order;
        }
        public function getJobScheduleByFieldworkerId($id)
		{
			$this->CI->load->model ( 'job_model', 'job' );
			$order = $this->CI->job->getJobScheduleByFieldworkerId ($id);
			return $order;
        }
        
        public function getTripDetails($id)
        {
        	$result = array();
        	$details = "";
        	$this->CI->load->model ( 'job_model', 'job' );
        	$job = $this->CI->job->getTripDetails ($id);
        	$i=1;
        	$j=0;
        	//print_r($job);
        	foreach($job as $row)
        	{
        			
        		if($i%2 != 0)
        		{
        			$platitude = $row['latitude'];
        			$plongitude = $row['longitude'];
        			$pickupaddress = $row['last_known_location'];
        		}
        		if($i%2 == 0)
        		{
        			$dlatitude = $row['latitude'];
        			$dlongitude = $row['longitude'];
        			$deliveryaddress = $row['last_known_location'];
        			$request_url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$platitude."+".$plongitude."&destinations=".$dlatitude."+".$dlongitude."&sensor=false&key=AIzaSyABBiAxhJDZNZXJ-cwb1pWrPxWBe3hfyQY";
        			$json = file_get_contents($request_url);
        			$details = json_decode($json, TRUE);
        			if (false !== $details)
        			{
        				$details=$details['rows'][0]['elements'][0]['distance']['text'];
        				$list = explode(' ',$details);
        			}
        			$result[$j]['job_id'] = $row['job_id'];
        			$result[$j]['details'] = $details;
        			$result[$j]['pickup_address'] = $pickupaddress;
        			$result[$j]['delivery_address'] = $deliveryaddress;
        			$j++;
        		}
        		$i++;
        	}
        	return $result;
        }
        
    }
