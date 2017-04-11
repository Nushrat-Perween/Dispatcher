<?php
class PackageLib {

	public function __construct() 
	{
		$this->CI = & get_instance ();
	}

	public function save_package ($data) 
	{
		$this->CI->load->model ( 'package/package_model', 'package' );
		$package = $this->CI->package->save_package ( $data );
		return $package;
	}
	
	public function getAllPackage () {
		$this->CI->load->model ( 'package/package_model', 'package' );
		$package = $this->CI->package->getAllPackage (  );
		return $package;
	}
	
	public function getPackageById($id)
	{
		$this->CI->load->model ( 'package/package_model', 'package' );
		$package = $this->CI->package->getPackageById ($id);
		return $package;
	}
	
	public function update_package($data)
	{
		$this->CI->load->model ( 'package/package_model', 'package' );
		$package = $this->CI->package->update_package ($data);
		return $package;
	}
	
}