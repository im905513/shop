<?php 
//link the controller to the nav link


$route[FUEL_ROUTE.'com/lists'] 			= COM_FOLDER.'/com_manage/lists';
$route[FUEL_ROUTE.'com/lists/(:num)'] 	= COM_FOLDER.'/com_manage/lists/$1';
$route[FUEL_ROUTE.'com/create'] 		= COM_FOLDER.'/com_manage/create';
$route[FUEL_ROUTE.'com/edit/(:num)'] 	= COM_FOLDER.'/com_manage/edit/$1';
$route[FUEL_ROUTE.'com/del/(:num)'] 	= COM_FOLDER.'/com_manage/do_del/$1';
$route[FUEL_ROUTE.'com/do_create'] 		= COM_FOLDER.'/com_manage/do_create';
$route[FUEL_ROUTE.'com/do_edit/(:num)'] = COM_FOLDER.'/com_manage/do_edit/$1';
$route[FUEL_ROUTE.'com/do_multi_del'] 	= COM_FOLDER.'/com_manage/do_multi_del';