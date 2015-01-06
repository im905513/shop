<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['casehelp_manage'] = array(
		'module_name' => '提案案件管理',
		'model_name' => 'casehelp_manage_model',
		'module_uri' => 'casehelp/lists',
		'model_location' => 'casehelp',
		'permission' => 'casehelp/manage',
		'nav_selected' => 'casehelp/lists',
		'archivable' => TRUE,
		'instructions' => '新增/修改提案案件'
	);
?>