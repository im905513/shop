<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['event_manage'] = array(
		'module_name' => '活動管理',
		'model_name' => 'event_manage_model',
		'module_uri' => 'event/lists',
		'model_location' => 'event',
		'permission' => 'event/manage',
		'nav_selected' => 'event/lists',
		'archivable' => TRUE,
		'instructions' => '新增/修改活動'
	);
?>