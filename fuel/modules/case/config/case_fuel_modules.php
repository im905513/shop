<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['case_manage'] = array(
		'module_name' => '外包案件管理',
		'model_name' => 'case_manage_model',
		'module_uri' => 'case/lists',
		'model_location' => 'case',
		'permission' => 'case/manage',
		'nav_selected' => 'case/lists',
		'archivable' => TRUE,
		'instructions' => '新增/修改外包案件'
	);
?>