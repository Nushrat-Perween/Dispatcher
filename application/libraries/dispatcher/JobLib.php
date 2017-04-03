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
        
        public function addJob ($data) {
            $company_name = $data['company_name'];
            $branch_name = $data['branch_name'];
            unset($data['company_name']);
            unset($data['branch_name']);
            $this->CI->load->model ( 'Job_model', 'job' );
            $this->CI->load->model ( 'Notification_model', 'notification' );
            $job_id = $this->CI->job->addJob ( $data );
            if($job_id) {
                
                /**** Pusher Management ****/
                
                $this->CI->load->library('ci_pusher');
                $pusher = $this->CI->ci_pusher->get_pusher();
                $pusherdata = array();
                
                // Set message
                $pusherdata['message'] = "New job ID ".getJobID($job_id)." is added <a class='btn-primary' style='background: #f5821f;' href='".base_url()."job_list' target='_blank'>&nbsp;&nbsp;View&nbsp;&nbsp;</a>";
                $pusherdata['admin_message'] = "New job ID ".getJobID($job_id)." is added by '".$branch_name."' branch of '".$company_name."' company. <a class='btn-primary' style='background: #f5821f;' href='".base_url()."admin/job_list' target='_blank'>&nbsp;&nbsp;View&nbsp;&nbsp;</a>";
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
                $notification_params['notification'] = ' <span class="time">New job ID '.getJobID($job_id).' is added. </span></div></a>';
                $notification_params['title'] = "<a href='".base_url()."job_list' target='_blank'><span class='notification-icon'>
                <span class='circle-icon bg-info text-white'>J</span></span>
                <div class='notification-message'>".$pusherdata['title'];
                $notification_params['notification_type'] = $pusherdata['notification_type'];
                $notification_params['created_date'] = date('Y-m-d H:i:s');
                $notification_res = $this->CI->notification->addNotification ($notification_params);
                $notification_params['title'] = "<a href='".base_url()."admin/job_list' target='_blank'><span class='notification-icon'>
                <span class='circle-icon bg-info text-white'>J</span></span>
                <div class='notification-message'>".$pusherdata['title'];
                $notification_params['notification'] = ' <span class="time">New job ID '.getJobID($job_id).' is added by "'.$branch_name.'" branch of "'.$company_name.'" company. </span></div></a>';
                $notification_res = $this->CI->notification->addAdminNotification ($notification_params);
                /**** End Pusher Management ****/
            }
            return $job_id;
        }
        public function updateJob ($data) {
            $this->CI->load->model ( 'Job_model', 'job' );
            $res = $this->CI->job->updateJob ( $data );
            
            if(isset($data['action_id'])) {
                // 			$action = $this->CI->job->getJobActionNameByActionID ( $data['action_id'] )[0]['action'];
                // 			$job = $this->CI->job->getJobByID ( $data['id'] )[0];
                
                // 			/**** Pusher Management ****/
                // 			$this->CI->load->model ( 'Notification_model', 'notification' );
                // 			$this->CI->load->library('ci_pusher');
                // 			$pusher = $this->CI->ci_pusher->get_pusher();
                // 			$pusherdata = array();
                
                // 			// Set message
                // 			$pusherdata['message'] = "Action of Job ID ".getJobID($data['id'])." is updated to ".$action.". <a class='btn-primary' style='background: #f5821f;' href='".base_url()."job_list' target='_blank'>&nbsp;&nbsp;View&nbsp;&nbsp;</a>";
                // 			$pusherdata['admin_message'] = "Action of Job ID ".getJobID($data['id'])." is updated to ".$action." by '".ucwords($job['assign_to'])."' '".ucwords($job['branch_name'])."' branch of '".ucwords($job['company_name'])."' company. <a class='btn-primary' style='background: #f5821f;' href='".base_url()."admin/job_list' target='_blank'>&nbsp;&nbsp;View&nbsp;&nbsp;</a>";
                // 			$pusherdata['title'] = 'Job Action Updated';
                // 			$pusherdata['notification_type'] = 2;
                // 			$pusherdata['client_id'] = $job['client_id'];
                // 			$pusherdata['hospital_id'] = $job['hospital_id'];
                
                // 			// Send message
                // 			$event = $pusher->trigger('test_channel', 'my_event', $pusherdata);
                
                // 			// Add Notification in DB
                // 			$notification_params = array();
                // 			$notification_params['client_id'] = $pusherdata['client_id'];
                // 			$notification_params['hospital_id'] = $pusherdata['hospital_id'];
                // 			$notification_params['notification'] = ' <span class="time">Action of Job ID '.getJobID($data['id']).' is updated to '.$action.'. </span></div></a>';
                // 			$notification_params['title'] = "<a href='".base_url()."job_list' target='_blank'><span class='notification-icon'>
                // 															<span class='circle-icon bg-info text-white'>J</span></span>
                // 															<div class='notification-message'>".$pusherdata['title'];
                // 			$notification_params['notification_type'] = $pusherdata['notification_type'];
                // 			$notification_params['created_date'] = date('Y-m-d H:i:s');
                // 			$notification_res = $this->CI->notification->addNotification ($notification_params);
                // 			$notification_params['title'] = "<a href='".base_url()."admin/job_list' target='_blank'><span class='notification-icon'>
                // 															<span class='circle-icon bg-info text-white'>J</span></span>
                // 															<div class='notification-message'>".$pusherdata['title'];
                // 			$notification_params['notification'] = ' <span class="time">Action of Job ID '.getJobID($data['id']).' is updated to '.$action.' by '.ucwords($job['assign_to']).' '.ucwords($job['branch_name']).' branch of '.ucwords($job['company_name']).' company. </span></div></a>';
                // 			$notification_res = $this->CI->notification->addAdminNotification ($notification_params);
                /**** End Pusher Management ****/
            }
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
        
        public function getDeliveryStatusByJobId($job_id)
        {
        	$this->CI->load->model ( 'Job_model', 'job' );
        	$delivery = $this->CI->job->getDeliveryStatusByJobId ($job_id);
        	return $delivery;
        }
    }
