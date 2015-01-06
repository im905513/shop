<?php
/*
|--------------------------------------------------------------------------
| FUEL NAVIGATION: An array of navigation items for the left menu
|--------------------------------------------------------------------------
*/
$config['nav']['product'] = array(
	'product/lists'		=> '產品列表'
);

// deterines whether to use this configuration below or the database for controlling the blogs behavior
$config['crawleruse_db_table_settings'] = TRUE;

// the cache folder to hold blog cache files
$config['product'] = 'product';

$config['tables']['mod_product'] = 'mod_product';


$config['product_javascript'] = array(
    site_url().'assets/admin_js/jquery.js',
    site_url().'assets/admin_js/bootstrap.min.js',
    site_url().'assets/admin_css/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js',
    "ckeditor.js",
    "adapters/jquery.js",
    "jquery.numeric.min.js"
);

$config['product_css'] = array(
	site_url().'assets/admin_css/bootstrap.min.css',
	site_url().'assets/admin_css/style.css',
	site_url().'assets/admin_css/style-responsive.css',
	site_url().'assets/admin_css/bootstrap-datetimepicker/css/datetimepicker.css',
	site_url().'assets/admin_css/font-awesome/css/font-awesome.css'
	// site_url().'assets/admin_css/datepicker.css'
);

?>