<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/ 
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
| 
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'backend/Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE; 

/* *********** API ROUTES ************ */
$route ['api/auth/login.(:any)'] = 'api/auth/Api/loginUser/$1';
$route ['api/auth/sign_in.(:any)'] = 'api/auth/Api/markAttendanceAsSignin/$1';
$route ['api/auth/sign_out.(:any)'] = 'api/auth/Api/markAttendanceAsSignout/$1';
$route ['api/job/listAssignedJob.(:any)'] = 'api/job/Api/getAssignJobDetailByFieldworker/$1';
$route ['api/job/getJobDetail.(:any)'] = 'api/job/Api/getJobDetailById/$1';
//$route ['api/job/updateStatusOfJob.(:any)'] = 'api/job/Api/updateJobAction/$1';
$route ['api/job/updateJobAction.(:any)'] = 'api/job/Api/updateJobAction/$1';

$route ['api/auth/updateCurrentLocationById.(:any)'] = 'api/auth/Api/updateCurrentLocationById/$1';
$route ['api/job/getjobcount.(:any)'] = 'api/job/Api/getJobCount/$1';
$route ['api/job/gettripdetails.(:any)'] = 'api/job/Api/getTripDetails/$1';

//$route ['api/job/gettripdetails.(:any)'] = 'api/job/Api/getTripDetails/$1';

/* *********** Frontend Routes ********** */ 
$route['login'] = 'backend/Login';
$route['authlogin'] = 'frontend/Login/loginuser';
$route['lock_screen'] = 'frontend/Login/lock_screen';
$route['unlock'] = 'frontend/Login/unlock';
$route['get_chat_people'] = 'frontend/Login/get_chat_people';
$route['job'] = 'frontend/Job';
$route['add_job'] = 'frontend/Job/add_job';
$route['edit_job/([0-9]+)'] = 'frontend/Job/edit_job/$1';
$route['job_list'] = 'frontend/Job/job_list';
$route['filter_job'] = 'frontend/Job/filter_job';
$route['job_not_started'] = 'frontend/Job/job_not_started';
$route['job_detail/([0-9]+)'] = 'frontend/Job/job_detail/$1';
$route['add_user'] = 'frontend/User';
$route['fieldworker/add'] = 'frontend/User/add_fieldworker';
$route['fieldworker/save_user'] = 'frontend/User/add_user';
$route['fieldworker/edit_user/([0-9]+)'] = 'frontend/User/edit_user/$1';
$route['fieldworker/update_user'] = 'frontend/User/update_user';
$route['user_list'] = 'frontend/User/user_list';
$route['field_worker_list'] = 'frontend/User/fieldworker_list';
$route['get_branch_by_company_id/([0-9]+)'] = 'frontend/General/get_branch_by_company_id/$1';
$route['logout'] =  'frontend/Login/logout';
//$route['admin/login'] = 'backend/login/adminlogin';
$route['dashboard'] = 'frontend/dashboard';
$route['schedular'] = 'frontend/schedular';
$route['schedular/updatescheduletime'] = 'frontend/schedular/updateScheduleTime';
$route['schedular/jobonmap'] = 'frontend/schedular/jobOnMap';
$route['schedular/route_of_fieldworker'] = 'frontend/schedular/field_worker_route';
$route['schedular/direction'] = 'frontend/schedular/direction';
$route['schedular/street'] = 'frontend/schedular/street';
$route['schedular/directionplace'] = 'frontend/schedular/directionplace';

$route['all_job_on_map'] = 'frontend/Job/all_job_on_map';
$route['fieldworker/route_of_fieldworker'] = 'frontend/job/field_worker_route';
$route['job/job_on_map'] = 'frontend/job/job_on_map';
$route['job/job_direction'] = 'frontend/job/job_direction';
$route['job/job_street'] = 'frontend/job/job_street';
$route['job/job_location'] = 'frontend/job/job_location';
$route['job/get_distance'] = 'frontend/job/get_distance';

// Reports
$route['report/jobs_by_company'] = 'frontend/Report';
$route['report/filter_jobs_by_company'] = 'frontend/Report/filter_jobs_by_company';
$route['report/jobs_by_branch'] = 'frontend/Report/jobs_by_branch';
$route['report/filter_jobs_by_branch'] = 'frontend/Report/filter_jobs_by_branch';
$route['report/fieldworker_report'] = 'frontend/Report/fieldworker_report';
$route['report/filter_fieldworker'] = 'frontend/Report/filter_fieldworker';
    
// Notification
$route['notification/getAllNotification'] = 'frontend/Notification/getAllNotification';


/* *********** Backend Routes ********** */
$route['admin'] = 'backend/Login';
$route['admin/authlogin'] = 'backend/Login/loginuser';
$route['admin/lock_screen'] = 'backend/Login/lock_screen';
$route['admin/unlock'] = 'backend/Login/unlock';
$route['admin/logout'] =  'backend/Login/logout';
$route['admin/dashboard'] = 'backend/dashboard';
$route['admin/profile'] = 'backend/Admin/view_profile';
$route['admin/profile/editpassword'] = 'backend/Admin/editpassword';
$route['admin/profile/editprofile'] = 'backend/Admin/editprofile';
$route['admin/get_chat_people'] = 'backend/Login/get_chat_people';
$route['admin/add_fieldworker'] = 'backend/Admin/add_fieldworker';
$route['admin/save_backend_user'] = 'backend/Admin/add_backend_user';
$route['admin/fieldworker/edit_backend_user/([0-9]+)'] = 'backend/Admin/edit_backend_user/$1';
$route['admin/update_backend_user'] = 'backend/Admin/update_backend_user';
$route['admin/field_worker_list'] = 'backend/Admin/fieldworker_list';
$route['admin/add_city'] = 'backend/Area/add_city';
$route['admin/save_city'] = 'backend/Area/save_city';
$route['admin/city_list'] = 'backend/Area/city_list';
$route['admin/add_locality'] = 'backend/Area/add_locality';
$route['admin/save_locality'] = 'backend/Area/save_locality';
$route['admin/locality_list'] = 'backend/Area/locality_list';
$route['admin/add_zone'] = 'backend/Area/add_zone';
$route['admin/save_zone'] = 'backend/Area/save_zone';
$route['admin/zone_list'] = 'backend/Area/zone_list';
$route['admin/assign_zone_area'] = 'backend/Area/assign_zone_area';
$route['admin/edit_city/([0-9]+)'] = 'backend/Area/edit_city/$1';
$route['admin/save_assigned_zone_area'] = 'backend/Area/save_assigned_zone_area';
$route['admin/update_city'] = 'backend/Area/update_city';
$route['admin/edit_locality/([0-9]+)'] = 'backend/Area/edit_locality/$1';
$route['admin/update_locality'] = 'backend/Area/update_locality';
$route['admin/edit_zone/([0-9]+)'] = 'backend/Area/edit_zone/$1';
$route['admin/update_zone'] = 'backend/Area/update_zone';
$route['admin/schedule'] = 'backend/Schedule';
$route['admin/getfieldworkerschedule/([0-9]+)'] = 'backend/Schedule/getSchedule/$1';
$route['admin/forgot_password'] = 'backend/Login/forgot_password';
$route['admin/send_password_reset_instruction'] = 'backend/Login/send_password_reset_instruction';
$route['admin/reset_password'] = 'backend/Login/reset_password';
$route['admin/save_reset_password'] = 'backend/Login/save_reset_password';

// Chat 
$route['admin/open_chat_box'] = 'backend/Chat/open_chat_box';
$route['admin/save_chat'] = 'backend/Chat/save_chat';

// Error Pages

$route['admin/error_screen'] = 'backend/Login/error_screen';
$route['admin/coming_soon'] = 'backend/Login/coming_soon'; 

// Attendance 
$route['admin/attendance'] = 'backend/Attendance';
$route['admin/mark_attendance_as_signin'] = 'backend/Attendance/mark_attendance_as_signin';
$route['admin/mark_attendance_as_signout'] = 'backend/Attendance/mark_attendance_as_signout';
$route['admin/get_latest_attendance'] = 'backend/Attendance/get_latest_attendance';
$route['admin/fieldworker_attendance'] = 'backend/Attendance/fieldworker_attendance';
$route['admin/filter_fieldworker_attendance'] = 'backend/Attendance/filter_fieldworker_attendance';

// Job 
$route['admin/job_list'] = 'backend/Job/job_list';
$route['admin/filter_job'] = 'backend/Job/filter_job';
$route['admin/update_jobList_through_pusher'] = 'backend/Job/update_jobList_through_pusher';
$route['admin/job_detail/([0-9]+)'] = 'backend/Job/job_detail/$1';
$route['admin/job/edit_assign_fieldworker'] = 'backend/Job/edit_assign_fieldworker';
$route['admin/job/save_fieldworker_to_job'] = 'backend/Job/save_fieldworker_to_job';
$route['admin/job/edit_job_action'] = 'backend/Job/edit_job_action';
$route['admin/job/update_job_action'] = 'backend/Job/update_job_action';
$route['admin/job/assignment/([0-9]+)'] = 'backend/Job/job_assignment/$1';
$route['admin/job/update_job_assignment'] = 'backend/Job/update_job_assignment';

// Backend Notification
$route['admin/getAllNotification'] = 'backend/Notification/getAllNotification';
$route['admin/turn_on_off_notification'] = 'backend/Notification/turn_on_off_notification';

// Reports
$route['report/fieldworker_report'] = 'backend/Report/fieldworker_report';
$route['report/filter_fieldworker'] = 'backend/Report/filter_fieldworker';

/*********************Site Admin Route **********************/

$route['admin/add_user'] = 'backend/UserNew/add_user';
$route['admin/save_user'] = 'backend/UserNew/save_user';
$route['admin/user_list'] = 'backend/UserNew';
$route['admin/edit_user/([0-9]+)'] = 'backend/UserNew/edit_user/$1';
$route['admin/update_user'] = 'backend/UserNew/update_user';
$route['admin/add_client'] = 'backend/Client/add_client';
$route['admin/save_client'] = 'backend/Client/save_client';
$route['admin/client_list'] = 'backend/Client';
$route['admin/edit_client/([0-9]+)'] = 'backend/Client/edit_client/$1';
$route['admin/update_client'] = 'backend/Client/update_client';
$route['admin/add_package'] = 'backend/Package/add_package';
$route['admin/package_list'] = 'backend/Package';
$route['admin/save_package'] = 'backend/Package/save_package';
$route['admin/edit_package/([0-9]+)'] = 'backend/Package/edit_package/$1';
$route['admin/update_package'] = 'backend/Package/update_package';

/**********Client Route ************************/

$route['client/job_list'] = 'backend/Hospital';
$route['client/getcustomerlist'] = 'backend/Hospital/getCustomerList';
$route['client/client_add_job'] = 'backend/Hospital/addJob';
$route['client/client_report'] = 'backend/Hospital/report';
$route['client/getpatientlist'] = 'backend/Hospital/getPatientList';
$route['client/client_save_job'] = 'backend/Hospital/clientSaveJob';
$route['client/edit_client_job/([0-9]+)'] = 'backend/Hospital/edit_client_job/$1';
$route['client/update_job_client'] = 'backend/Hospital/updateJobClient';
$route['client/clientjob_byMob'] = 'backend/Hospital/clientjobByMob';
$route['client/getPatientListBydate'] = 'backend/Hospital/getPatientListBydate';
$route['client/getCustomerListBydate'] = 'backend/Hospital/getCustomerListBydate';

$route['admin/add_hospital'] = 'backend/UserNew/addHospital';
$route['admin/add_client_user'] = 'backend/UserNew/addClientUser';
$route['admin/save_client_user'] = 'backend/UserNew/saveClientUser';
$route['admin/save_hospital'] = 'backend/UserNew/saveHospital';
$route['admin/client_userlist'] = 'backend/UserNew/clientUserList';
$route['admin/edit_clientuser/([0-9]+)'] = 'backend/UserNew/editClientUser/$1';
$route['admin/update_client_user'] = 'backend/UserNew/updateClientUser';

$route['admin/save_hospital'] = 'backend/UserNew/saveHospital';
$route['admin/hospital_list'] = 'backend/UserNew/hospitalList';
$route['admin/edit_hospital/([0-9]+)'] = 'backend/UserNew/editHospital/$1';
$route['admin/update_hospital'] = 'backend/UserNew/updateHospital';
$route['admin/searchcity'] = 'backend/Hospital/searchCity';
$route['admin/searchstate'] = 'backend/Hospital/searchState';

