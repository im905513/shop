<?php 
//link the controller to the nav link


$route[FUEL_ROUTE.'casehelp/lists'] 				= CASEHELP_FOLDER.'/casehelp_manage/lists';
$route[FUEL_ROUTE.'casehelp/lists/(:num)'] 			= CASEHELP_FOLDER.'/casehelp_manage/lists/$1';
$route[FUEL_ROUTE.'casehelp/replyed/lists'] 		= CASEHELP_FOLDER.'/casehelp_manage/replyed_list';
$route[FUEL_ROUTE.'casehelp/replyed/lists/(:num)'] 	= CASEHELP_FOLDER.'/casehelp_manage/replyed_list/$1'; 
$route[FUEL_ROUTE.'casehelp/batch'] 				= CASEHELP_FOLDER.'/casehelp_manage/do_batch';
$route[FUEL_ROUTE.'casehelp/replay/(:num)'] 		= CASEHELP_FOLDER.'/casehelp_manage/replay/$1';
$route[FUEL_ROUTE.'casehelp/doReplay'] 				= CASEHELP_FOLDER.'/casehelp_manage/do_replay';
$route[FUEL_ROUTE.'casehelp/replyed/detail/(:num)']	= CASEHELP_FOLDER.'/casehelp_manage/reply_detail/$1';
$route[FUEL_ROUTE.'casehelp/winform'] 				= CASEHELP_FOLDER.'/casehelp_manage/winformList';