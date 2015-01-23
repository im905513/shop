<?php 
//link the controller to the nav link


$route[FUEL_ROUTE.'order/lists'] 							= ORDER_FOLDER.'/order_manage/lists';
$route[FUEL_ROUTE.'order/lists/(:num)'] 					= ORDER_FOLDER.'/order_manage/lists/$1';
$route[FUEL_ROUTE.'order/create'] 						    = ORDER_FOLDER.'/order_manage/create';
$route[FUEL_ROUTE.'order/edit']                             = ORDER_FOLDER.'/order_manage/edit';
$route[FUEL_ROUTE.'order/detail'] 							= ORDER_FOLDER.'/order_manage/detail';
$route[FUEL_ROUTE.'order/del'] 							    = ORDER_FOLDER.'/order_manage/do_del';
$route[FUEL_ROUTE.'order/do_create'] 						= ORDER_FOLDER.'/order_manage/do_create';
$route[FUEL_ROUTE.'order/do_edit'] 						    = ORDER_FOLDER.'/order_manage/do_edit';
$route[FUEL_ROUTE.'order/do_multi_del'] 					= ORDER_FOLDER.'/order_manage/do_multi_del';
$route[FUEL_ROUTE.'order/get/codechild/(:any)/(:num)']	    = ORDER_FOLDER.'/order_manage/get_codechild/$1/$2';
$route[FUEL_ROUTE.'order/replylist/(:num)'] 				= ORDER_FOLDER.'/order_manage/replylist/$1';
$route[FUEL_ROUTE.'order/reply_del/(:num)'] 				= ORDER_FOLDER.'/order_manage/reply_del/$1';
$route[FUEL_ROUTE.'order/multi_del_reply'] 				    = ORDER_FOLDER.'/order_manage/multi_del_reply';
$route[FUEL_ROUTE.'order/export_excel'] 					= ORDER_FOLDER.'/order_manage/export_excel';
$route[FUEL_ROUTE.'order/reply_prod_reply/(:num)']          = ORDER_FOLDER.'/order_manage/reply_prod_reply/$1';
$route[FUEL_ROUTE.'order/do_reply'] 		                = ORDER_FOLDER.'/order_manage/do_reply';
$route[FUEL_ROUTE.'order/detail/del/(:num)']                = ORDER_FOLDER.'/order_manage/do_del_detail_item/$1';
$route[FUEL_ROUTE.'order/update/status']                    = ORDER_FOLDER.'/order_manage/do_update_order_status';
$route[FUEL_ROUTE.'order/set/order_status/(:num)/(:num)']   = ORDER_FOLDER.'/order_manage/set_order_status/$1/$2';
?>