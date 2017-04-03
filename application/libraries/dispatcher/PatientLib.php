<?php
class PatientLib {

	public function __construct() {
		$this->CI = & get_instance ();
	}

	public function addPatient ($data) {
		$this->CI->load->model ( 'Patient_model', 'patient' );
		$patient_id = $this->CI->patient->addPatient ( $data );
		return $patient_id;
	}


}
