<?php
class HospitalLib {

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
		$job['delivery_date']=$data['delivery_date'];
		$job['delivery_time']=$data['delivery_time'];
		/*********** Contact Data ***************/
		unset($data['name']);
		unset($data['room_no']);
		unset($data['test']);
		unset($data['caller']);
		unset($data['special_instruction']);
		unset($data['job_name']);
		unset($data['description']);
		unset($data['delivery_date']);
		unset($data['delivery_time']);
		//print_r($data);
		$this->CI->load->model ( 'patient/patient_model', 'patient' );
		$patient_id= $this->CI->patient->save_patient ( $patient );
		$job['patient_id']=$patient_id;
		$this->CI->load->model ( 'contact/contact_model', 'contact' );
		$contact = $this->CI->contact->save_contact ( $data );
		$job['job_contact_id']=$contact;
		$this->CI->load->model ('hospital/hospital_model', 'hospital' );
		$job= $this->CI->hospital->save_job ( $job );
		return $job;
	}
	
	public function getAllJob($data)
	{
		$this->CI->load->model ('hospital/hospital_model', 'hospital' );
		$job= $this->CI->hospital->getAllJob ( $data );
		return $job;
	}
	
	
	public function getJobById($jobid)
	{
		$this->CI->load->model ('hospital/hospital_model', 'hospital' );
		$job= $this->CI->hospital->getJobById ( $jobid );
		return $job;
	}
	
	public function updateJobClientById($job)
	{
		
		$this->CI->load->model ('hospital/hospital_model', 'hospital' );
		$job= $this->CI->hospital->update_job ( $job );
		return $job;
	}
	
	public function update_patient($patient)
	{
		$this->CI->load->model ( 'patient/patient_model', 'patient' );
		$patient_id= $this->CI->patient->update_patient ( $patient );
		return $patient_id;
	}
	public function update_contact($contact)
	{
		$this->CI->load->model ( 'contact/contact_model', 'contact' );
		$contact = $this->CI->contact->update_contact ( $contact );
		return $contact;
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
		$this->CI->load->model ('hospital/hospital_model', 'hospital' );
		$job= $this->CI->hospital->clientjobByMob ( $data );
		return $job;
	}
	public function getPatientListByPatientId($id)
	{
		$this->CI->load->model ( 'patient/patient_model', 'patient' );
		$patient= $this->CI->patient->getPatientListByPatientId ($id);
		return $patient;
	}
	
	public function getCustomerListByCustomerId($id)
	{
		$this->CI->load->model ( 'contact/contact_model', 'contact' );
		$contact = $this->CI->contact->getCustomerListByCustomerId ($id);
		return $contact;
	}
	
	public function getCustomerListBydate($data)
	{
		//print_r($data);
		$this->CI->load->model ( 'contact/contact_model', 'contact' );
		$contact = $this->CI->contact->getCustomerListBydate ($data);
		
		return $contact;
	}
	
	public function getPatientListBydate($data)
	{
		
		$this->CI->load->model ( 'patient/patient_model', 'patient' );
		$patient= $this->CI->patient->getPatientListBydate ($data);
		return $patient;
	}
	
}