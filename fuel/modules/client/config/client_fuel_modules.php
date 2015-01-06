<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['client_manage'] = array(
		'module_name' => '接案者管理',
		'model_name' => 'client_manage_model',
		'module_uri' => 'client/lists',
		'model_location' => 'client',
		'permission' => 'client/manage',
		'nav_selected' => 'client/lists',
		'archivable' => TRUE,
		'instructions' => '新增/修改接案者'
	);
?>