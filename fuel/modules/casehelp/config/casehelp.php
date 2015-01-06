<?php
/*
|--------------------------------------------------------------------------
| FUEL NAVIGATION: An array of navigation items for the left menu
|--------------------------------------------------------------------------
*/
$config['nav']['casehelp'] = array(
'casehelp/lists'		=> '提案案件列表'
);

// deterines whether to use this configuration below or the database for controlling the blogs behavior
$config['crawleruse_db_table_settings'] = TRUE;

// the cache folder to hold blog cache files
$config['casehelp_cache_group'] = 'casehelp';

$config['tables']['data_case_help'] = 'data_case_help';


$config['case_help_javascript'] = array(
	'jquery.min.js',
	'bootstrap.min', 
	'count.js',
	'jquery-ui.min.js'
);
 
$config['case_help_css'] = array(
	'bootstrap.min.css',
	'bootstrap-reset.css?t=12341234',
	'font-awesome/css/font-awesome.css',
	'jquery-easy-pie-chart/jquery.easy-pie-chart.css',
	'style.css',
	'style-responsive.css',
	'admin_style.css',
	'jquery-ui.css', 
);

?>