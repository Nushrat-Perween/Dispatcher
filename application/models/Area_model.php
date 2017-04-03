<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

/**
 * Area model
 *
 * <p>
 * We are using this model to add, update, delete and get area.
 * </p>
 *
 * @package Area
 * @author Nushrat
 * @copyright Copyright &copy; 2015, Dispatcher
 * @category CI_Model API
 */
class Area_model extends CI_Model {

	function __construct() {
		parent::__construct ();
	}


	public function getLocationExist ($data) {
		$this->db->select ( 'id' );
		$this->db->from ( TABLES::$LOCATION );
		$this->db->where ( 'is_active', 1 );
		$this->db->like ( 'location_name', $data['location_name'] );
		$this->db->where ( 'company_id', $data['company_id'] );
		$this->db->where ( 'branch_id', $data['branch_id'] );
		$this->db->where ( 'group_id', $data['group_id'] );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		if ($result) 
			return $result[0]['id'];
		else 
			return 0;
	}

	public function addLocation ($data)
	{
		$this->db->insert(TABLES::$LOCATION,$data);
		return $location_id = $this->db->insert_id();
	}

	public function getCityExist ($data) {
		$this->db->select ( 'id' );
		$this->db->from ( TABLES::$CITY );
		$this->db->where ( 'is_active', 1 );
		$this->db->like ( 'city_name', $data['city_name'] );
		$this->db->where ( 'company_id', $data['company_id'] );
		$this->db->where ( 'branch_id', $data['branch_id'] );
		$this->db->where ( 'group_id', $data['group_id'] );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		if($result) {
			return $result[0]['id'];
		} else
			return 0;
	}

	public function addCity ($data)
	{
		$this->db->insert(TABLES::$CITY,$data);
		return $city_id = $this->db->insert_id();
	}
	
	public function saveLocality ($data)
	{
		$this->db->insert(TABLES::$LOCALITY,$data);
		return $locality_id = $this->db->insert_id();
	}
	
	public function saveZone ($data)
	{
		$this->db->insert(TABLES::$ZONE,$data);
		return $zone_id = $this->db->insert_id();
	}
	
	public function getAllCity () {
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$CITY );
		$this->db->where ( 'is_active', 1 );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	
	}
	
	public function getAllLocality () {
		$this->db->select ( 'l.*,c.city_name,z.name as zone_name' );
		$this->db->from ( TABLES::$LOCALITY. ' AS l' );
		$this->db->join ( TABLES::$CITY . ' AS c', 'c.id=l.city_id', 'left' );
		$this->db->join ( TABLES::$ZONE . ' AS z', 'z.id=l.zone_id', 'left' );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getAllZone () {
		$this->db->select ( 'z.*,c.city_name' );
		$this->db->from ( TABLES::$ZONE. ' AS z' );
		$this->db->join ( TABLES::$CITY . ' AS c', 'c.id=z.city_id', 'left' );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getStateExist ($data) {
		$this->db->select ( 'id' );
		$this->db->from ( TABLES::$STATE );
		$this->db->where ( 'is_active', 1 );
		$this->db->like ( 'state_name', $data['state_name'] );
		$this->db->where ( 'company_id', $data['company_id'] );
		$this->db->where ( 'branch_id', $data['branch_id'] );
		$this->db->where ( 'group_id', $data['group_id'] );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		if($result) {
			return $result[0]['id'];
		} else
			return 0;
	}

	public function addState ($data)
	{
		$this->db->insert(TABLES::$STATE,$data);
		return $state_id = $this->db->insert_id();
	}
	
	public function getPostalCodeExist ($data) {
		$this->db->select ( 'id' );
		$this->db->from ( TABLES::$POSTAL_CODE );
		$this->db->where ( 'is_active', 1 );
		$this->db->like ( 'postal_code', $data['postal_code'] );
		$this->db->where ( 'company_id', $data['company_id'] );
		$this->db->where ( 'branch_id', $data['branch_id'] );
		$this->db->where ( 'group_id', $data['group_id'] );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		if($result) {
			return $result[0]['id'];
		} else
			return 0;
	}

	public function addPostalCode ($data)
	{
		$this->db->insert(TABLES::$POSTAL_CODE,$data);
		return $postal_code_id = $this->db->insert_id();
	}
	
	public function getCityByID ($id) {
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$CITY);
		$this->db->where ( 'is_deleted', 0 );
		$this->db->where ( 'id', $id );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	public function getLocalityByID ($id) {
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$LOCALITY);
		$this->db->where ( 'is_deleted', 0 );
		$this->db->where ( 'id', $id );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	
	public function getZoneByID ($id) {
		$this->db->select ( '*' );
		$this->db->from ( TABLES::$ZONE);
		$this->db->where ( 'is_deleted', 0 );
		$this->db->where ( 'id', $id );
		$query = $this->db->get ();
		//echo $this->db->last_query();
		$result = $query->result_array ();
		return $result;
	}
	
	public function updateCity ($data)
	{
		$this->db->where ( 'id', $data['id'] );
		return $this->db->update(TABLES::$CITY,$data);
	}
	
	public function updateLocality ($data)
	{
		$this->db->where ( 'id', $data['id'] );
		return $this->db->update(TABLES::$LOCALITY,$data);
	}
	
	public function updateZone ($data)
	{
		$this->db->where ( 'id', $data['id'] );
		return $this->db->update(TABLES::$ZONE,$data);
	}



}

