<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['com_manage'] = array(
		'module_name' => '發案者管理',
		'model_name' => 'com_manage_model',
		'module_uri' => 'com/lists',
		'model_location' => 'com',
		'permission' => 'com/manage',
		'nav_selected' => 'com/lists',
		'archivable' => TRUE,
		'instructions' => '新增/修改發案者'
	);
?>