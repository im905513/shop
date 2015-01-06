<?php
/*
|--------------------------------------------------------------------------
| FUEL NAVIGATION: An array of navigation items for the left menu
|--------------------------------------------------------------------------
*/
$config['nav']['client'] = array(
'client/lists'		=> '接案者列表'
);

// deterines whether to use this configuration below or the database for controlling the blogs behavior
$config['crawleruse_db_table_settings'] = TRUE;

// the cache folder to hold blog cache files
$config['client_cache_group'] = 'client';

$config['tables']['mod_client'] = 'mod_client';


$config['client_javascript'] = array(
	'jquery.js',
	'jquery.min.js',
	'bootstrap.min',
	'count.js',
	'jquery-ui.min.js'
);

$config['client_css'] = array(
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