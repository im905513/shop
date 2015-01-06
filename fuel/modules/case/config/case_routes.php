<?php 
//link the controller to the nav link


$route[FUEL_ROUTE.'case/lists'] 			= CASE_FOLDER.'/case_manage/lists';
$route[FUEL_ROUTE.'case/lists/(:num)'] 		= CASE_FOLDER.'/case_manage/lists/$1';
$route[FUEL_ROUTE.'case/create'] 			= CASE_FOLDER.'/case_manage/create';
$route[FUEL_ROUTE.'case/edit/(:num)'] 		= CASE_FOLDER.'/case_manage/edit/$1';
$route[FUEL_ROUTE.'case/del/(:num)'] 		= CASE_FOLDER.'/case_manage/do_del/$1';
$route[FUEL_ROUTE.'case/do_create'] 		= CASE_FOLDER.'/case_manage/do_create';
$route[FUEL_ROUTE.'case/do_edit/(:num)'] 	= CASE_FOLDER.'/case_manage/do_edit/$1';
$route[FUEL_ROUTE.'case/do_multi_del'] 		= CASE_FOLDER.'/case_manage/do_multi_del';