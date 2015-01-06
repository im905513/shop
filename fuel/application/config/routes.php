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


$route['default_controller'] = 'home';
$route['404_override'] = 'fuel/page_router';

$route['register/step1_save'] 		= 'register/step1_save';
$route['register/step2'] 			= 'register/step2';
$route['register/step2_save'] 		= 'register/step2_save';
$route['register/step3'] 			= 'register/step3';
$route['register/school'] 			= 'register/getSchool';

$route['user/myinfo'] 			= 'user/myinfo';
$route['user/editinfo'] 		= 'user/editinfo';
$route['user/do_fb_login'] 			= 'user/do_fb_login';
$route['user/do_fb_regi'] 			= 'user/do_fb_regi';
$route['user/do_login']			= 'user/do_login';
$route['user/logout'] 			= 'user/logout';

$route['login'] 			= 'welcome/login';

$route['event']					= 'events';
$route['event/(:num)']			= 'events/index/$1';
$route['event/detail/(:num)']	= 'events/event_detail/$1';
$route['api/regievent/(:num)']	= 'events/regi_event/$1';


$route['home/aboutus'] 	= 'home/aboutus';
$route['home/login'] 	= 'home/login';
$route['home/campusevents'] 	= 'home/campusevents';
$route['home/contact'] 			= 'home/contact';
$route['home/do_contact'] 			= 'home/do_contact';
$route['user/logout'] 			= 'user/logout';

$route['case'] 					= 'about_case/index';
$route['case/(:num)'] 			= 'about_case/index/$1';
$route['case/detail/(:num)'] 	= 'about_case/case_detail/$1';

$route['case/help'] 			= 'about_case/help_me';
$route['case/help/step2'] 		= 'about_case/help_me_step2';
$route['case/help/step3'] 		= 'about_case/help_me_step3';

$route['case/help/require']		= 'about_case/require_help';
$route['case/post/step1']		= 'about_case/post_case_step1';


$route['user/update/email/mobile'] 		= 'about_user/update_cli_email_mobile';
$route['member']						= 'about_user/member_center';
/*
$route['member/reply']					= 'about_user/member_reply_center';
$route['member/reply/(:num)']			= 'about_user/member_reply_center/$1';
$route['member/reply/detail/(:num)']	= 'about_user/member_reply_detail/$1';
*/
$route['member/update']					= 'about_user/member_update';
$route['member/unread/cnt']				= 'about_user/get_unread_msg_cnt';

$route['profile']						= 'about_user/client_profile';
$route['user/update/photo']				= 'about_user/upload_files';

$route['api/reply/case/help']			= 'api/about_email/reply_case_help';
$route['api/get/reply/list']			= 'api/about_case_api/get_reply_list';
$route['api/get/text/show']				= 'api/about_case_api/get_text_show';
$route['api/get/text/show/(:num)']		= 'api/about_case_api/get_text_show/$1';

$route['api/case/get/subcate/(:num)']	= 'api/about_case_api/get_sub_cate/$1';
$route['api/case/get/all/cate']			= 'api/about_case_api/get_all_cate';
$route['api/case/get/new/case']			= 'api/about_case_api/get_new_case';
$route['api/case/get/list']				= 'api/about_case_api/get_case_list';
$route['api/case/get/detail/(:num)']	= 'api/about_case_api/get_case_detail/$1';

//$route['test']						= 'about_case/mail_test';

/*	
| Uncomment this line if you want to use the automatically generated sitemap based on your navigation.
| To modify the sitemap.xml, go to the views/sitemap_xml.php file.
*/ 
//$route['sitemap.xml'] = 'sitemap_xml';

include(MODULES_PATH.'/fuel/config/fuel_routes.php');

/* End of file routes.php */
/* Location: ./application/config/routes.php */