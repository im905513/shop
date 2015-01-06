<?php 
//link the controller to the nav link


$route[FUEL_ROUTE.'codekind/lists'] 			= CODEKIND_FOLDER.'/codekind_manage/lists';
$route[FUEL_ROUTE.'codekind/lists/(:num)'] 		= CODEKIND_FOLDER.'/codekind_manage/lists/$1';
$route[FUEL_ROUTE.'codekind/create'] 			= CODEKIND_FOLDER.'/codekind_manage/create';
$route[FUEL_ROUTE.'codekind/edit/(:num)'] 		= CODEKIND_FOLDER.'/codekind_manage/edit/$1';
$route[FUEL_ROUTE.'codekind/del/(:num)'] 		= CODEKIND_FOLDER.'/codekind_manage/do_del/$1';
$route[FUEL_ROUTE.'codekind/do_create'] 		= CODEKIND_FOLDER.'/codekind_manage/do_create';
$route[FUEL_ROUTE.'codekind/do_edit/(:num)'] 	= CODEKIND_FOLDER.'/codekind_manage/do_edit/$1';
$route[FUEL_ROUTE.'codekind/do_multi_del'] 		= CODEKIND_FOLDER.'/codekind_manage/do_multi_del';

$route[FUEL_ROUTE.'code/lists'] 				= CODEKIND_FOLDER.'/codekind_manage/code_lists';
$route[FUEL_ROUTE.'code/lists/(:num)'] 			= CODEKIND_FOLDER.'/codekind_manage/code_lists/$1';
$route[FUEL_ROUTE.'code/create'] 				= CODEKIND_FOLDER.'/codekind_manage/code_create';
$route[FUEL_ROUTE.'code/edit/(:num)'] 			= CODEKIND_FOLDER.'/codekind_manage/code_edit/$1';
$route[FUEL_ROUTE.'code/del/(:num)'] 			= CODEKIND_FOLDER.'/codekind_manage/do_code_del/$1';
$route[FUEL_ROUTE.'code/do_create'] 			= CODEKIND_FOLDER.'/codekind_manage/do_code_create';
$route[FUEL_ROUTE.'code/do_edit/(:num)'] 		= CODEKIND_FOLDER.'/codekind_manage/do_code_edit/$1';
$route[FUEL_ROUTE.'code/do_multi_del'] 			= CODEKIND_FOLDER.'/codekind_manage/do_code_multi_del';