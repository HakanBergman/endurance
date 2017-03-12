<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "login";
$route['404_override'] = '';

$route['teacher/list'] = 'teacher/list_teachers';
$route['teacher/password/(:num)'] = 'teacher/password/$1';
$route['teacher/edit/(:num)'] = 'teacher/edit_teacher/$1';
$route['teacher/delete/(:num)'] = 'teacher/delete_teacher/$1';
$route['teacher/edit/add'] = 'teacher/add_teacher';
$route['student/coaches/(:num)'] = 'student/coaches/$1';
$route['user/password'] = 'user/password';
$route['user/fullname'] = 'user/fullname';
$route['user/email'] = 'user/email';
$route['user'] = 'user';
$route['reset/email'] = 'reset/email';
$route['reset/password/(:num)/(:any)'] = 'reset/password/$1/$2';
$route['reset'] = 'reset/email';

$route['group/edit/(:num)/(:num)'] = 'group/edit_group/$1/$2';
$route['group/edit/(:num)'] = 'group/edit_group/$1';
$route['group/delete/(:num)'] = 'group/delete_group/$1';
$route['group/statistics/(:num)'] = 'group/statistics/$1';
$route['group/list'] = 'group/list_groups';
$route['group/add'] = 'group/add_group';
$route['group/sort'] = 'group/sort_groups';

$route['school/statistics/(:num)'] = 'school/statistics/$1';

$route['student/calendar/(:num)/stats/(:any)'] = 'student/calendar_stats/$1/$2';
$route['student/statistics/(:num)'] = 'student/statistics/$1';
$route['student/plan/(:num)'] = 'student/plan/$1';
$route['student/chat/(:num)'] = 'student/chat/$1';
$route['student/edit/(:num)'] = 'student/edit_student/$1';
$route['student/delete/(:num)/(:num)'] = 'student/delete_student/$1/$2';
$route['student/add'] = 'student/add_student';
$route['student/list/(:num)'] = 'student/list_students/$1';
$route['student/list'] = 'student/list_students';
$route['student/search'] = 'student/search';

$route['schedule/assign/(:num)'] = 'schedule/assign/$1';
$route['schedule/edit/(:num)'] = 'schedule/edit_schedule/$1';
$route['schedule/duplicate/(:num)'] = 'schedule/duplicate_schedule/$1';
$route['schedule/duplicate/add/(:num)'] = 'schedule/duplicate_schedule/$1';
$route['schedule/delete/(:num)'] = 'schedule/delete_schedule/$1';

$route['schedule/summary/(:num)'] = 'schedule/summary/$1';
$route['schedule/calendar/(:num)'] = 'schedule/calendar/$1';

$route['event/edit/(:num)'] = 'event/edit_event/$1';
$route['event/delete/(:num)'] = 'event/delete_event/$1';
$route['event/add'] = 'event/create_event/';
$route['event/calendar'] = 'event/calendar';


$route['schedule/add'] = 'schedule/add_schedule';
$route['schedule/list'] = 'schedule/list_schedule';
$route['template/workout'] = 'template/list_workouts';



$route['popup/day_workout/(:num)/delete'] = 'popup/delete_day_workout/$1';
$route['popup/day_workout/(:num)/(:any)'] = 'popup/edit_day_workout/$1/$2';
$route['popup/day_workout/(:num)'] = 'popup/edit_day_workout/$1';

$route['popup/day_workoutnotes/(:num)/delete'] = 'popup/delete_day_workoutnotes/$1';
$route['popup/day_workoutnotes/(:num)/(:any)'] = 'popup/edit_day_workoutnotes/$1/$2';
$route['popup/day_workoutnotes/(:num)'] = 'popup/edit_day_workoutnotes/$1';

$route['popup/day_result/(:num)'] = 'popup/edit_day_result/$1';
$route['popup/day_result/(:num)/delete'] = 'popup/delete_day_result/$1';
$route['popup/day_result/add/(:any)'] = 'popup/add_day_result/$1';
$route['popup/day_result/add'] = 'popup/add_day_result/';

$route['popup/schedule_workout/(:num)'] = 'popup/edit_schedule_workout/$1';
$route['popup/schedule_workout/(:num)/delete'] = 'popup/delete_schedule_workout/$1';

$route['popup/template_workout/edit/(:num)/delete'] = 'popup/delete_template_workout/$1';
$route['popup/template_workout/edit/(:num)'] = 'popup/edit_template_workout/$1';
$route['popup/template_workout/add'] = 'popup/add_template_workout';
$route['popup/template_workout/delete/(:num)'] = 'popup/delete_template_workout/$1';

$route['calendar/schedule_workout/(:num)'] = 'calendar/schedule_workout/$1';
$route['calendar/day_workout/(:num)/(:any)'] = 'calendar/day_workout/$1/$2';
$route['calendar/day_result/(:num)/(:any)'] = 'calendar/day_result/$1/$2';

$route['external'] = 'external/external_coach';
$route['external/add'] = 'external/add_external_coach';

$route['ssf/statistics'] = 'external/ssf_statistics';
$route['ssf/list/(:num)'] = 'external/ssf_edit_list/$1';
$route['ssf/save/(:num)'] = 'external/ssf_save_to_list/$1';
$route['ssf/remove/(:num)/(:num)'] = 'external/ssf_remove_from_list/$1/$2';
$route['ssf'] = 'external/ssf';

$route['overview/(:num)/(:any)'] = 'student/calendar/$1/$2';
$route['overview/(:num)'] = 'student/calendar/$1';
$route['overview'] = 'student/calendar';

$route['mswitch/(:any)'] = 'student/mswitch/$1';

$route['mobile/(:num)/(:any)'] = 'student/mobile_calendar/$1/$2';
$route['mobile/(:num)'] = 'student/mobile_calendar/$1';
$route['mobile'] = 'student/mobile_calendar';


$route['activity'] = 'activity/index';
$route['activity/(:any)'] = 'activity/index/$1';

$route['login'] = 'login/check_login';
$route['logout'] = 'login/logout';

/* End of file routes.php */
/* Location: ./application/config/routes.php */