<?php
// included in the main config/MY_fuel_modules.php

$config['modules']['codekind_manage'] = array(
		'module_name' => '外包案件管理',
		'model_name' => 'codekind_manage_model',
		'module_uri' => 'codekind/lists',
		'model_location' => 'codekind',
		'permission' => 'codekind/manage',
		'nav_selected' => 'codekind/lists',
		'archivable' => TRUE,
		'instructions' => '新增/修改外包案件'
	);
?>