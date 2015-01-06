<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['contact_manage'] = array(
		'module_name' => '外包案件管理',
		'model_name' => 'contact_manage_model',
		'module_uri' => 'contact/lists',
		'model_location' => 'contact',
		'permission' => 'contact/manage',
		'nav_selected' => 'contact/lists',
		'archivable' => TRUE,
		'instructions' => '新增/修改'
	);
?>