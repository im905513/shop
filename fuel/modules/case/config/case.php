<?php
/*
|--------------------------------------------------------------------------
| FUEL NAVIGATION: An array of navigation items for the left menu
|--------------------------------------------------------------------------
*/
$config['nav']['case'] = array(
'case/lists'		=> '外包案件列表'
);

// deterines whether to use this configuration below or the database for controlling the blogs behavior
$config['crawleruse_db_table_settings'] = TRUE;

// the cache folder to hold blog cache files
$config['case_cache_group'] = 'case';

$config['tables']['data_case_detail'] = 'data_case_detail';


$config['case_javascript'] = array(
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

$config['bootstrap_datepicker'] = array(
	'../flat_plugin/bootstrap-datepicker/js/bootstrap-datepicker.js',
	'../flat_plugin/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js',
	'../flat_plugin/bootstrap-daterangepicker/moment.min.js',
	'../flat_plugin/bootstrap-daterangepicker/daterangepicker.js',
	'advanced-form-components.js'
);

$config['case_css'] = array(
	'bootstrap.min.css',
	'bootstrap-reset.css?t=12341234',
	'font-awesome/css/font-awesome.css',
	'jquery-easy-pie-chart/jquery.easy-pie-chart.css',
	'style.css',
	'style-responsive.css',
	'admin_style.css',
	'jquery-ui.css',
	'../flat_plugin/bootstrap-datepicker/css/datepicker.css',
	'../flat_plugin/bootstrap-timepicker/compiled/timepicker.css',
	'../flat_plugin/bootstrap-daterangepicker/daterangepicker-bs3.css',
	'../flat_plugin/bootstrap-datetimepicker/css/datetimepicker.css'
);

?>