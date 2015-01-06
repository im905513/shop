<?php 
//link the controller to the nav link


$route[FUEL_ROUTE.'client/lists'] 			= CLIENT_FOLDER.'/client_manage/lists';
$route[FUEL_ROUTE.'client/lists/(:num)'] 	= CLIENT_FOLDER.'/client_manage/lists/$1';
$route[FUEL_ROUTE.'client/create'] 			= CLIENT_FOLDER.'/client_manage/create';
$route[FUEL_ROUTE.'client/edit/(:num)'] 	= CLIENT_FOLDER.'/client_manage/edit/$1';
$route[FUEL_ROUTE.'client/del/(:num)'] 		= CLIENT_FOLDER.'/client_manage/do_del/$1';
$route[FUEL_ROUTE.'client/do_create'] 		= CLIENT_FOLDER.'/client_manage/do_create';
$route[FUEL_ROUTE.'client/do_edit/(:num)'] 	= CLIENT_FOLDER.'/client_manage/do_edit/$1';
$route[FUEL_ROUTE.'client/do_multi_del'] 	= CLIENT_FOLDER.'/client_manage/do_multi_del';