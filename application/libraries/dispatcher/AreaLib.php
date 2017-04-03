<?php
class AreaLib {

	public function __construct() {
		$this->CI = & get_instance ();
	}

	public function getLocationExist ($data) {
		$this->CI->load->model ( 'Area_model', 'area' );
		$location_id = $this->CI->area->getLocationExist ( $data );
		return $location_id;
	}
	
	public function addLocation ($data) {
		$this->CI->load->model ( 'Area_model', 'area' );
		$location_id = $this->CI->area->addLocation ( $data );
		return $location_id;
	}
	
	public function getCityExist ($data) {
		$this->CI->load->model ( 'Area_model', 'area' );
		$city_id = $this->CI->area->getCityExist ( $data );
		return $city_id;
	}
	
	public function getAllCity () {
		$this->CI->load->model ( 'Area_model', 'area' );
		$city = $this->CI->area->getAllCity ();
		return $city;
	}
	
	public function getAllLocality () {
		$this->CI->load->model ( 'Area_model', 'area' );
		$locality = $this->CI->area->getAllLocality ();
		return $locality;
	}
	
	public function getAllZone () {
		$this->CI->load->model ( 'Area_model', 'area' );
		$zone = $this->CI->area->getAllZone ();
		return $zone;
	}
	
	public function addCity ($data) {
		$this->CI->load->model ( 'Area_model', 'area' );
		$city_id = $this->CI->area->addCity ( $data );
		return $city_id;
	}
	
	public function saveLocality ($data) {
		$this->CI->load->model ( 'Area_model', 'area' );
		$locality_id = $this->CI->area->saveLocality ( $data );
		return $locality_id;
	}
	
	public function saveZone ($data) {
		$this->CI->load->model ( 'Area_model', 'area' );
		$zone_id = $this->CI->area->saveZone ( $data );
		return $zone_id;
	}
	
	public function getStateExist ($data) {
		$this->CI->load->model ( 'Area_model', 'area' );
		$state_id = $this->CI->area->getStateExist ( $data );
		return $state_id;
	}
	
	public function addState ($data) {
		$this->CI->load->model ( 'Area_model', 'area' );
		$state_id = $this->CI->area->addState ( $data );
		return $state_id;
	}
	
	public function getPostalCodeExist ($data) {
		$this->CI->load->model ( 'Area_model', 'area' );
		$state_id = $this->CI->area->getPostalCodeExist ( $data );
		return $state_id;
	}
	
	public function addPostalCode ($data) {
		$this->CI->load->model ( 'Area_model', 'area' );
		$postal_code_id = $this->CI->area->addPostalCode ( $data );
		return $postal_code_id;
	}
	
	public function getCityByID ($id) {
		$this->CI->load->model ( 'Area_model', 'area' );
		$res = $this->CI->area->getCityByID ( $id );
		return $res;
	}
	
	public function getLocalityByID ($id) {
		$this->CI->load->model ( 'Area_model', 'area' );
		$res = $this->CI->area->getLocalityByID ( $id );
		return $res;
	}
	
	public function getZoneByID ($id) {
		$this->CI->load->model ( 'Area_model', 'area' );
		$res = $this->CI->area->getZoneByID ( $id );
		return $res;
	}
	
	public function updateCity ($data) {
		$this->CI->load->model ( 'Area_model', 'area' );
		$res = $this->CI->area->updateCity ( $data );
		return $res;
	}
	
	public function updateLocality ($data) {
		$this->CI->load->model ( 'Area_model', 'area' );
		$res = $this->CI->area->updateLocality ( $data );
		return $res;
	}
	
	public function updateZone ($data) {
		$this->CI->load->model ( 'Area_model', 'area' );
		$res = $this->CI->area->updateZone ( $data );
		return $res;
	}




}
