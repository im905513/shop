<?php
/*
|--------------------------------------------------------------------------
| FUEL NAVIGATION: An array of navigation items for the left menu
|--------------------------------------------------------------------------
*/
$config['nav']['codekind'] = array(
'codekind/lists'		=> '分類列表'
);

// deterines whether to use this configuration below or the database for controlling the blogs behavior
$config['crawleruse_db_table_settings'] = TRUE;

// the cache folder to hold blog cache files
$config['codekind'] = 'codekind';

$config['tables']['mod_codekind'] = 'mod_codekind';


$config['codekind_javascript'] = array(
	'jquery.js',
	'jquery.min.js',
	'bootstrap.min',
	'jquery-ui.min.js',
	'jquery.sparkline.js',
);

$config['codekind_css'] = array(
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