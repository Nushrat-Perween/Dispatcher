<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

/**
 * Patient model
 *
 * <p>
 * We are using this model to add, update, delete and get patient.
 * </p>
 *
 * @package Patient
 * @author Nushrat
 * @copyright Copyright &copy; 2015, Dispatcher
 * @category CI_Model API
 */
class Patient_model extends CI_Model {

	function __construct() {
		parent::__construct ();
	}



	public function addPatient ($data)
	{
		$this->db->insert(TABLES::$PATIENT,$data);
		return $patient_id = $this->db->insert_id();
	}






}

