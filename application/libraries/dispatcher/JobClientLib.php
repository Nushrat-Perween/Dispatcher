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
		$job= $this->CI->jobclient->save_job ( $job );
		return $job;
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
