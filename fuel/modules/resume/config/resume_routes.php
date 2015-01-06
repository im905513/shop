<?php 
//link the controller to the nav link


$route[FUEL_ROUTE.'resume/lists'] 			= RESUME_FOLDER.'/resume_manage/lists';
$route[FUEL_ROUTE.'resume/lists/(:num)'] 		= RESUME_FOLDER.'/resume_manage/lists/$1';
$route[FUEL_ROUTE.'resume/create'] 			= RESUME_FOLDER.'/resume_manage/create';
$route[FUEL_ROUTE.'resume/edit'] 		= RESUME_FOLDER.'/resume_manage/edit';
$route[FUEL_ROUTE.'resume/del'] 		= RESUME_FOLDER.'/resume_manage/do_del';
$route[FUEL_ROUTE.'resume/do_create'] 		= RESUME_FOLDER.'/resume_manage/do_create';
$route[FUEL_ROUTE.'resume/do_edit'] 	= RESUME_FOLDER.'/resume_manage/do_edit';
$route[FUEL_ROUTE.'resume/export_excel'] 	= RESUME_FOLDER.'/resume_manage/export_excel';
$route[FUEL_ROUTE.'resume/do_multi_del'] 		= RESUME_FOLDER.'/resume_manage/do_multi_del';
$route[FUEL_ROUTE.'resume/area/(:num)'] 		= RESUME_FOLDER.'/resume_manage/getArea/$1';

 