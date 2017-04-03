<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('asset_url()'))
{
	function asset_url()
    {
      	return base_url().'assets/';
    }
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

