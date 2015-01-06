<?php 
//link the controller to the nav link


$route[FUEL_ROUTE.'product/lists'] 							= PRODUCT_FOLDER.'/product_manage/lists';
$route[FUEL_ROUTE.'product/lists/(:num)'] 					= PRODUCT_FOLDER.'/product_manage/lists/$1';
$route[FUEL_ROUTE.'product/create'] 						= PRODUCT_FOLDER.'/product_manage/create';
$route[FUEL_ROUTE.'product/edit'] 							= PRODUCT_FOLDER.'/product_manage/edit';
$route[FUEL_ROUTE.'product/del'] 							= PRODUCT_FOLDER.'/product_manage/do_del';
$route[FUEL_ROUTE.'product/do_create'] 						= PRODUCT_FOLDER.'/product_manage/do_create';
$route[FUEL_ROUTE.'product/do_edit'] 						= PRODUCT_FOLDER.'/product_manage/do_edit';
$route[FUEL_ROUTE.'product/do_multi_del'] 					= PRODUCT_FOLDER.'/product_manage/do_multi_del';
$route[FUEL_ROUTE.'product/get/codechild/(:any)/(:num)']	= PRODUCT_FOLDER.'/product_manage/get_codechild/$1/$2';
$route[FUEL_ROUTE.'product/replylist/(:num)'] 				= PRODUCT_FOLDER.'/product_manage/replylist/$1';
$route[FUEL_ROUTE.'product/reply_del/(:num)'] 				= PRODUCT_FOLDER.'/product_manage/reply_del/$1';
$route[FUEL_ROUTE.'product/multi_del_reply'] 				= PRODUCT_FOLDER.'/product_manage/multi_del_reply';
$route[FUEL_ROUTE.'product/export_excel'] 					= PRODUCT_FOLDER.'/product_manage/export_excel';
$route[FUEL_ROUTE.'product/reply_prod_reply/(:num)']        = PRODUCT_FOLDER.'/product_manage/reply_prod_reply/$1';
$route[FUEL_ROUTE.'product/do_reply'] 		                = PRODUCT_FOLDER.'/product_manage/do_reply';
?>