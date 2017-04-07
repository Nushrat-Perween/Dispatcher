<?php
    if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
    
    /**
     * Job model
     *
     * <p>
     * We are using this model to add, update, delete and get jobs.
     * </p>
     *
     * @package Job
     * @author Nushrat
     * @copyright Copyright &copy; 2015, Dispatcher
     * @category CI_Model API
     */
    class Job_model extends CI_Model {
        
        function __construct() {
            parent::__construct ();
        }
        
        // old one functions
        public function getLastJobID ()
        {
            $this->db->select ( 'id' );
            $this->db->from ( TABLES::$JOB);
            $this->db->order_by ('id','DESC');
            $this->db->limit (1);
            $query = $this->db->get ();
            //echo $this->db->last_query ();
            $result = $query->result_array ();
            return $result;
        }
        
        public function getAllClientJob($data)
        		{
	            //$data['created_date'] = date("Y-m-d");
	            $this->db->select('j.*,concat(jc.first_name," ",jc.last_name) as contact_name,jc.mobile,(jc.id) as job_contact_id,
	                              (p.name) as patient_name,p.caller,p.created_date,(p.id) as patient_id,ja.action,
	                              js.status,concat(a.first_name," ",a.last_name) as fieldworker_name');
	            $this->db->from ( TABLES::$JOB.' AS j' );
	            $this->db->join ( TABLES::$JOB_CONTACT.' AS jc',"jc.id=j.job_contact_id","left" );
	            $this->db->join ( TABLES::$PATIENT.' AS p',"p.id=j.patient_id","left" );
	            $this->db->join ( TABLES::$ADMIN . ' AS a', 'a.id=j.assign_to', 'left' );
	            $this->db->join ( TABLES::$JOB_STATUS.' AS js',"js.id=j.status_id","left" );
	            $this->db->join ( TABLES::$JOB_ACTION.' AS ja',"ja.id=j.action_id","left" );
	            if(isset($data['hospital_id']))
	             	{
	             		$this->db->where ( 'j.hospital_id', $data['hospital_id'] );
	                 }
	            if(isset($data['client_id']))
	            		{
	            			$this->db->where ( 'j.client_id', $data['client_id'] );
	            		}
	                              
	             //$this->db->where ( 'date(j.created_date) ','date(now())');
	             $this->db->order_by('j.id','DESC');
	             //echo $this->db->last_query();
	             $query = $this->db->get ();
	             $result = $query->result_array ();
	             return $result;
       		}
                              
                              
		public function getFilterJob ($param)
			{
				if(isset($param['startdate'])) {
					if($param['startdate']!="")
						$startdate = date('Y-m-d',strtotime($param['startdate']));
					else
						$startdate="";
				}
		                              
				if(isset($param['enddate'])) {
					if($param['enddate']!="")
						$enddate = date('Y-m-d',strtotime($param['enddate']));
					else
						$enddate="";
				}
				//$data['created_date'] = date("Y-m-d");
		 		$this->db->select('j.*,concat(jc.first_name," ",jc.last_name) as contact_name,jc.mobile,(jc.id) as job_contact_id,
											(p.name) as patient_name,p.caller,p.created_date,(p.id) as patient_id,ja.action,
											js.status,concat(a.first_name," ",a.last_name) as fieldworker_name');
				$this->db->from ( TABLES::$JOB.' AS j' );
				$this->db->join ( TABLES::$JOB_CONTACT.' AS jc',"jc.id=j.job_contact_id","left" );
				$this->db->join ( TABLES::$PATIENT.' AS p',"p.id=j.patient_id","left" );
				$this->db->join ( TABLES::$ADMIN . ' AS a', 'a.id=j.assign_to', 'left' );
				$this->db->join ( TABLES::$JOB_STATUS.' AS js',"js.id=j.status_id","left" );
				$this->db->join ( TABLES::$JOB_ACTION.' AS ja',"ja.id=j.action_id","left" );
				if(isset($data['hospital_id']))
					{
						$this->db->where ( 'j.hospital_id', $data['hospital_id'] );
					}
				if(isset($data['client_id']))
					{
						$this->db->where ( 'j.client_id', $data['client_id'] );
					}
		
				if(isset($param['enddate']) or isset($param['startdate'])) {
					if($startdate!="" and $enddate!="") {
						$this->db->where("DATE(j.created_date) >='".$startdate."' AND DATE(j.created_date) <='".$enddate."'",'',FALSE);
					}
		                                                
					if($startdate!="" and $enddate=="") {
						$this->db->where("DATE(j.created_date) >='".$startdate."'",'',FALSE);
					}
		                                                
					if($startdate=="" and $enddate!="") {
						$this->db->where("DATE(j.created_date) <='".$enddate."'",'',FALSE);
					}
				}
				if(isset($param['period'])) {
					$cdate = date('Y-m-d');
					if ($param['period'] == 1) {
						$this->db->where("DATE(j.created_date) = '".$cdate."'",'',FALSE);
					} else if ($param['period'] == 2) {
						$this->db->where(" (DATE(j.created_date) BETWEEN DATE(DATE_SUB(NOW(), INTERVAL 7 DAY)) AND DATE(NOW()))",'',FALSE);
					} else if ($param['period'] == 3) {
		 				$this->db->where(" (DATE(j.created_date) BETWEEN DATE(DATE_SUB(NOW(), INTERVAL 1 MONTH)) AND DATE(NOW()))",'',FALSE);
		                                                
					} else if ($param['period'] == 4) {
						$this->db->where(" (DATE(j.created_date) BETWEEN DATE(DATE_SUB(NOW(), INTERVAL 1 YEAR)) AND DATE(NOW()))",'',FALSE);
					}
				}
				if(isset($param['job_id']) and $param['job_id'] != "") {
		                                                
					$this->db->where('j.id',$param['job_id']);
				}
		                                                
				if(isset($param['status']) and $param['status'] != "") {
		                                                
					$this->db->where('j.status_id',$param['status']);
				}
		                                                
				if(isset($param['action']) and $param['action'] != "") {
		                                                
					$this->db->where('j.action_id',$param['action']);
				}
		                                                
				if(isset($param['priority']) and $param['priority'] != "") {
		                                                
					$this->db->where('j.priority',$param['priority']);
				}
		                                                
		                                                
				$this->db->order_by ('j.id','DESC');
				$query = $this->db->get ();
				//echo $this->db->last_query ();
				$result = $query->result_array ();
				return $result;
			}
		                                                
		                                                
		public function getJobByID ($data)
			{
				$this->db->select('j.*,concat(jc.first_name," ",jc.last_name) as contact_name,jc.mobile,(jc.id) as job_contact_id,
											(p.name) as patient_name,p.caller,p.created_date,(p.id) as patient_id,ja.action,
											js.status,concat(a.first_name," ",a.last_name) as fieldworker_name');
				$this->db->from ( TABLES::$JOB.' AS j' );
				$this->db->join ( TABLES::$JOB_CONTACT.' AS jc',"jc.id=j.job_contact_id","left" );
				$this->db->join ( TABLES::$PATIENT.' AS p',"p.id=j.patient_id","left" );
				$this->db->join ( TABLES::$ADMIN . ' AS a', 'a.id=j.assign_to', 'left' );
				$this->db->join ( TABLES::$JOB_STATUS.' AS js',"js.id=j.status_id","left" );
				$this->db->join ( TABLES::$JOB_ACTION.' AS ja',"ja.id=j.action_id","left" );
				if(isset($data['hospital_id']))
					{
		 				$this->db->where ( 'j.hospital_id', $data['hospital_id'] );
					}
				if(isset($data['client_id']))
					{
						$this->db->where ( 'j.client_id', $data['client_id'] );
					}
				$this->db->where ( 'j.is_deleted', 0 );
				$this->db->where ( 'j.id', $data['id'] );
				$query = $this->db->get ();
				//echo $this->db->last_query ();
				$result = $query->result_array ();
				return $result;
			}
		                                                                  
		                                                                  
		public function getJobNotStarted ()
			{
				$this->db->select ( 'j.*,ja.action,b.branch_name,concat(a.first_name," ",a.last_name) as assign_to,aj.assign_to as field_worker_id,j.created_date,js.status,COALESCE(aj.start_date ,"NA") as start_date,aj.end_date' );
				$this->db->from ( TABLES::$JOB. ' AS j');
				$this->db->join ( TABLES::$JOB_CONTACT . ' AS jc', 'jc.id=j.job_contact_id', 'inner' );
				$this->db->join ( TABLES::$ASSIGN_JOB . ' AS aj', 'aj.id=j.job_assign_id', 'left' );
				$this->db->join ( TABLES::$ADMIN . ' AS a', 'a.id=aj.assign_to', 'left' );
				$this->db->join ( TABLES::$COMPANY.' AS c',"j.company_id=c.id","left" );
				$this->db->join ( TABLES::$BRANCH.' AS b',"j.branch_id=b.id","left" );
				$this->db->join ( TABLES::$GROUP.' AS g',"j.group_id=g.id","left" );
				$this->db->join ( TABLES::$JOB_STATUS.' AS js',"js.id=j.status_id","left" );
				$this->db->join ( TABLES::$JOB_ACTION.' AS ja',"ja.id=j.action_id","left" );
				$this->db->where ( 'j.is_deleted', 0 );
				$this->db->where ( 'DATE(j.created_date) > ', date('Y-m-d') );
				$this->db->order_by ('id','DESC');
				$query = $this->db->get ();
				//echo $this->db->last_query ();
				$result = $query->result_array ();
				return $result;
			}
		                                                                  
		public function addJob ($data)
			{
				$this->db->insert(TABLES::$JOB,$data);
				return $this->db->insert_id();
			}
		                                                                  
		public function updateJob ($data)
			{
				$this->db->where ( 'id', $data['id'] );
				return $this->db->update(TABLES::$JOB,$data);
			}
		                                                                  
		public function updateJobAssignment ($data)
			{
				$this->db->where ( 'id', $data['id'] );
				return $this->db->update(TABLES::$JOB,$data);
			}
		                                                                  
		public function addJobContact ($data)
			{
				$this->db->insert(TABLES::$JOB_CONTACT,$data);
				return $this->db->insert_id();
			}
		                                                                  
		public function addAssignJob ($data)
			{
				$this->db->insert(TABLES::$ASSIGN_JOB,$data);
				return $this->db->insert_id();
			}
		                                                                  
		public function getJobStatusByCompanyID ($company_id)
			{
				$this->db->select ( 'id,status' );
				$this->db->from ( TABLES::$JOB_STATUS);
				//$this->db->where ( 'is_deleted', 0 );
				 $this->db->where ( 'company_id', $company_id );
				$query = $this->db->get ();
				//echo $this->db->last_query ();
				$result = $query->result_array ();
				return $result;
			}
		                                                                  
		public function getAllJobAction ()
			{
				$this->db->select ( 'id,action' );
				$this->db->from ( TABLES::$JOB_ACTION);
				$this->db->where ( 'is_deleted', 0 );
				$query = $this->db->get ();
				//echo $this->db->last_query ();
				$result = $query->result_array ();
				return $result;
			}
		                                                                  
		public function getAllJobStatus ()
			{
				$this->db->select ( 'id,status' );
				$this->db->from ( TABLES::$JOB_STATUS);
				//$this->db->where ( 'is_deleted', 0 );
				$query = $this->db->get ();
				//echo $this->db->last_query ();
				$result = $query->result_array ();
				return $result;
			}
		                                                                  
		public function getJobActionNameByActionID ($action_id)
			{
				$this->db->select ( 'id,action' );
				$this->db->from ( TABLES::$JOB_ACTION);
				$this->db->where ( 'id', $action_id );
				$this->db->where ( 'is_deleted', 0 );
				$query = $this->db->get ();
				//echo $this->db->last_query ();
				$result = $query->result_array ();
				return $result;
			}
		                                                                  
		public function getAssignedJobByAdminID ($data)
			{
				$this->db->select ( 'j.*,ja.action,b.branch_name,concat(a.first_name," ",a.last_name) as assign_to,aj.assign_to as field_worker_id,j.created_date,j.priority,js.status,aj.start_date,aj.end_date' );
				$this->db->from ( TABLES::$JOB. ' AS j');
				$this->db->join ( TABLES::$JOB_CONTACT . ' AS jc', 'jc.id=j.job_contact_id', 'inner' );
				$this->db->join ( TABLES::$ASSIGN_JOB . ' AS aj', 'aj.id=j.job_assign_id', 'left' );
				$this->db->join ( TABLES::$ADMIN . ' AS a', 'a.id=aj.assign_to', 'left' );
				$this->db->join ( TABLES::$COMPANY.' AS c',"j.company_id=c.id","left" );
				$this->db->join ( TABLES::$BRANCH.' AS b',"j.branch_id=b.id","left" );
				$this->db->join ( TABLES::$GROUP.' AS g',"j.group_id=g.id","left" );
				$this->db->join ( TABLES::$JOB_STATUS.' AS js',"js.id=j.status_id","left" );
				$this->db->join ( TABLES::$JOB_ACTION.' AS ja',"ja.id=j.action_id","left" );
				$this->db->where ( 'j.is_deleted', 0 );
				$this->db->where ( 'aj.assign_to', $data['session_id'] );
				$this->db->order_by ('j.id','DESC');
				$query = $this->db->get ();
				//echo $this->db->last_query ();
				$result = $query->result_array ();
				return $result;
			}
		                                                                  
		                                                                  
		  public function getAssignJobDetailByFieldworker($id)
		  {
			$this->db->select ( 'j.id as job_id,j.job_name,j.description,jc.mobile,concat(jc.first_name," ",jc.last_name) as contact_name,jc.latitude as pickup_latitide,jc.longitude as pickup_logitude,jc.street as pickup_street,jc.lookup_name as pickup_lookup_name,h.locality as del_street,h.latitude as del_latitude,h.longitude as del_longitude,h.address as del_address,(concat(a.first_name," ",a.last_name)) as del_name,a.mobile as del_mobile,j.delivery_date,j.delivery_time,j.status_id,j.action_id' );
		  	$this->db->from ( TABLES::$JOB. ' AS j');
		  	$this->db->join ( TABLES::$JOB_CONTACT . ' AS jc', 'jc.id=j.job_contact_id', 'inner' );
		  	$this->db->join ( TABLES::$HOSPITAL . ' AS h', 'h.id=j.hospital_id', 'inner' );
		  	$this->db->join ( TABLES::$ADMIN . ' AS a', 'h.id=a.hospital_id', 'inner' );
		  	$this->db->where('j.assign_to',$id);
		  	$query = $this->db->get ();
		  	$result = $query->result_array ();
		  	return $result;
		  }
		  public function getJobDetailById($id)
		  {
		  	$this->db->select ( 'j.id as job_id,j.job_name,j.description,jc.mobile,concat(jc.first_name," ",jc.last_name) as contact_name,jc.latitude as pickup_latitide,jc.longitude as pickup_logitude,jc.street as pickup_street,jc.lookup_name as pickup_lookup_name,h.locality as del_street,h.latitude as del_latitude,h.longitude as del_longitude,h.address as del_address,(concat(a.first_name," ",a.last_name)) as del_name,a.mobile as del_mobile,j.delivery_date,j.delivery_time,j.status_id,j.action_id' );
		  	$this->db->from ( TABLES::$JOB. ' AS j');
		  	$this->db->join ( TABLES::$JOB_CONTACT . ' AS jc', 'jc.id=j.job_contact_id', 'inner' );
		  	$this->db->join ( TABLES::$HOSPITAL . ' AS h', 'h.id=j.hospital_id', 'inner' );
		  	$this->db->join ( TABLES::$ADMIN . ' AS a', 'h.id=a.hospital_id', 'inner' );
		  	$this->db->where('j.id',$id);
		  	$query = $this->db->get ();
		  	$result = $query->result_array ();
		  	return $result;
		  	
		  }
		  
		  public function updateJobAction($data)
		  {
			  	$this->db->where ( 'id', $data['id'] );
			  	return $this->db->update(TABLES::$JOB,$data);
		  	
		  }
		                                                                  
		  public function saveJobHistory($data)
		  {
		  	$this->db->insert(TABLES::$JOB_HISTORY,$data);
		  	return $job_history_id = $this->db->insert_id();
		  	
		  }
		  public function getJobCount($id)
		  {
		  	$this->db->select('sum(if(status_id=0,1,0)) as pending_job,sum(if(status_id=1,1,0)) as success_job,sum(if(status_id=2,1,0)) as cancel_job')->from(TABLES::$JOB);
		  	$this->db->where('assign_to=',$id);
		  	$query=$this->db->get();
		  	$result=$query->result_array();
		  	return $result;
		  }
                                                                  
  }
    
