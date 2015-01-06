<?php
/*
|--------------------------------------------------------------------------
| FUEL NAVIGATION: An array of navigation items for the left menu
|--------------------------------------------------------------------------
*/
$config['nav']['com'] = array(
'com/lists'		=> '發案者列表'
);

// deterines whether to use this configuration below or the database for controlling the blogs behavior
$config['crawleruse_db_table_settings'] = TRUE;

// the cache folder to hold blog cache files
$config['com_cache_group'] = 'com';

$config['tables']['mod_company'] = 'mod_company';


$config['com_javascript'] = array(
	'jquery.js',
	'jquery.min.js',
	'bootstrap.min',
	'count.js',
	'jquery-ui.min.js'
);

$config['com_css'] = array(
	'bootstrap.min.css',
	'bootstrap-reset.css',
	'font-awesome/css/font-awesome.css',
	'jquery-easy-pie-chart/jquery.easy-pie-chart.css',
	'style.css',
	'style-responsive.css',
	'admin_style.css',
	'jquery-ui.css'
);

?>