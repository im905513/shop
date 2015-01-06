<?php
/*
|--------------------------------------------------------------------------
| FUEL NAVIGATION: An array of navigation items for the left menu
|--------------------------------------------------------------------------
*/
$config['nav']['member'] = array(
'member/lists'		=> '會員列表'
);

// deterines whether to use this configuration below or the database for controlling the blogs behavior
$config['crawleruse_db_table_settings'] = TRUE;

// the cache folder to hold blog cache files
$config['member_cache_group'] = 'member';

$config['tables']['mod_member'] = 'mod_member';


$config['member_javascript'] = array(
	'jquery.js',
	'jquery.min.js',
	'bootstrap.min',
	'jquery.dcjqaccordion.2.7.js',
	'jquery.scrollTo.min.js',
	'jquery.nicescroll.js',
	'jquery.sparkline.js',
	'../css/jquery-easy-pie-chart/jquery.easy-pie-chart.js',
	'owl.carousel.js',
	'jquery.customSelect.min.js',
	'respond.min.js',
	'jquery.dcjqaccordion.2.7.js',
	'common-scripts.js',
	'sparkline-chart.js',
	'easy-pie-chart.js',
	'count.js',
	'jquery-ui.min.js'
);

$config['member_css'] = array(
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