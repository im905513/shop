<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['resume_manage'] = array(
		'module_name' => '外包案件管理',
		'model_name' => 'resume_manage_model',
		'module_uri' => 'resume/lists',
		'model_location' => 'resume',
		'permission' => 'resume/manage',
		'nav_selected' => 'resume/lists',
		'archivable' => TRUE,
		'instructions' => '新增/修改履歷'
	);
?>