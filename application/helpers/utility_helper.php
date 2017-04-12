<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('asset_url()'))
{
	function asset_url()
    {
      	return base_url().'assets/';
    }
}


/**
 *
 * @param File $file
 * @param string $upload_dir
 * @param string $file_types
 * @param int $max_file_size
 * @return multitype:number unknown |multitype:number string unknown
 */
function uploadImage($file,$upload_dir,$file_types,$max_file_size,$file_name=""){
	$status = array();
	$status['status'] = 0;
	$original_file_name = clean(basename($file["name"]));
	$files = explode(".",$original_file_name);
	$file_extention = end($files);
	if($file_name == "") {
		$file_name = $files[0];
	}

	$target_file = $upload_dir . microtime(true) . $file_name.".".$file_extention;
	$msg = validateFile($target_file,$file,$max_file_size,$file_types);
	if ($msg != "success") {
		$status['status'] = 0;
		$status['msg'] = $msg;
		return $status;
	} else {
		if (move_uploaded_file($file["tmp_name"], $target_file)) {
			$paths = explode("/",$target_file);
			array_shift($paths);
			$status['status'] = 1;
			$status['msg'] = "The file ". basename( $file["name"]). " has been uploaded.";
			$status['image'] = implode("/",$paths);
			return $status;
		} else {
			$status['status'] = 0;
			$status['msg'] = "Sorry, there was an error uploading your file.";
			return $status;
		}
	}
}

function validateFile($target_file,$file,$max_file_size,$file_types){
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	if ($file["size"] > $max_file_size) {
		return "File size is too large.";
	}
	$imageFileType = strtolower($imageFileType);
	if(!in_array($imageFileType, $file_types)) {
		return "Sorry, only ".implode(",",$file_types)." files are allowed.";
	}
	return "success";
}

function clean($string) {
	$string = preg_replace('/\s+/', '-',$string);
	return preg_replace('/[^A-Za-z0-9\-.]/', '-', $string);
}

function auto_logout () {
	
	$inactive = 600;
	
	$session_life = time()  - $_SESSION['timeout'];
	
	if($session_life > $inactive) {  
		$_SESSION['lock_count'] = 1;
		redirect(base_url().'lock_screen'); 
	} 
	
	$_SESSION['timeout'] =time();
}

function auto_admin_logout () {
	
	$inactive = 600;
	
	$session_life = time()  - $_SESSION['admin_timeout'];
	
	if($session_life > $inactive) {  
		$_SESSION['admin_lock_count'] = 1;
		redirect(base_url().'admin/lock_screen'); 
	} 
	
	$_SESSION['admin_timeout'] =time();
}

/**
 * Get Post Load ID
 * @param integer load ID
 * @return string load ID
 */
function getLastJobID($job_id){
	$job_id = $job_id +1;
	$jobid = str_pad($job_id, 5, '0', STR_PAD_LEFT);
	$jobid = "J".$jobid;
	return $jobid;
}

function getJobID($job_id){
	
	$jobid = str_pad($job_id, 5, '0', STR_PAD_LEFT);
	$jobid = "J".$jobid;
	return $jobid;
}

function getUserID($user_id){
	
	$userid = str_pad($user_id, 5, '0', STR_PAD_LEFT);
	$userid = "U".$userid;
	return $userid;
}

