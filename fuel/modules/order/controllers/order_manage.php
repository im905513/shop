<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Order_manage extends Fuel_base_controller {
	public $view_location = 'order';
	public $nav_selected = 'order/manage';
	public $module_name = 'Order manage';
	public $module_uri = 'fuel/order/lists';

	function __construct()
	{
		parent::__construct();
		$this->_validate_user('order/manage');
		$this->load->module_model(ORDER_FOLDER, 'order_manage_model');
		$this->load->helper('ajax');
		$this->load->library('pagination');
		$this->load->library('set_page');
		$this->load->library('session');
		$this->load->library('comm');
	}
	
	function lists($dataStart=0)
	{
		$base_url = base_url();

		$search_type = $this->input->get_post("search_type");
		$search_txt = htmlspecialchars($this->input->get_post("search_txt"), ENT_QUOTES);
		
		$filter = "";

		switch ($search_type) 
		{
			case 1:
				$filter = " WHERE a.id = '".$search_txt."'";
				break;
			case 2:
				$filter = " WHERE b.member_name LIKE '%".$search_txt."%'";
				break;
			default:
				$filter = "";
				break;
		}

		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);

		$target_url = $base_url.'fuel/order/lists/';

		$total_rows = $this->order_manage_model->get_total_rows($filter);
		$config = $this->set_page->set_config($target_url, $total_rows, $dataStart, 20);
		$dataLen = $config['per_page'];
		$this->pagination->initialize($config);

		$results = $this->order_manage_model->get_order_list($dataStart, $dataLen, $filter);

		$vars['page_jump'] = $this->pagination->create_links();


		$vars['edit_url'] 			= $base_url.'fuel/order/edit?pro_id=';
		$vars['del_url'] 			= $base_url.'fuel/order/del?pro_id=';
		$vars['multi_del_url'] 		= $base_url.'fuel/order/do_multi_del';
		$vars['results'] 			= $results;
		$vars['total_rows'] 		= $total_rows;
		$vars['search_url'] 		= $base_url.'fuel/order/lists';
		$vars['export_url']			= base_url().'fuel/order/export_excel';/**/
		$vars['CI'] = & get_instance();

		$this->fuel->admin->render('_admin/order_lists_view', $vars);

	} 


	function export_excel(){
		$this->load->library('excel');

			// Create new PHPExcel object
			$objPHPExcel = new PHPExcel();

			// Set properties
			$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
										 ->setLastModifiedBy("Maarten Balliauw")
										 ->setTitle("Office 2007 XLSX Test Document")
										 ->setSubject("Office 2007 XLSX Test Document")
										 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
										 ->setKeywords("office 2007 openxml php")
										 ->setCategory("Test result file");

			$col_name = array(
						"Item number",
						"Category",
						"Name",
						"Slogan",
						"Designation",
						"Format 1",
						"Format 2",
						"Format 3",
						"Color",
						"Size",
						"Inventory",
						"Ship Note",
						"Original price",
						"Wholesale Price",
						"VIP Price",
						"Start Time",
						"End Time",
						"Product Order",
						"Status");
			$value = $this->product_manage_model->get_product_export_list();
			$title = "Product Data Export";
			$file_name = "export_data";
			
			// Add some data
			$row_num = 1;
			$col_num = "A";
			foreach($col_name as $cols){
				
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue($col_num++.$row_num, "$cols");
			}
			/*foreach($col_name as $cols){
				
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue($col_num++.$row_num, "$cols");
			}*/
			foreach($value as $rows){
				$row_num++;
				$col_num = "A";
				foreach($rows as $key => $val ){
					$objPHPExcel->setActiveSheetIndex(0)
								->setCellValue($col_num++.$row_num, $val);		
				}
			}
			// Rename sheet
			$objPHPExcel->getActiveSheet()->setTitle($title);


			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);


			// Redirect output to a client’s web browser (Excel5)
			//flush();
			if (ob_get_contents()) ob_end_clean();
			//ob_end_clean();
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$file_name.'.xls"');
			header('Cache-Control: max-age=0');

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
	}

	function plu_redirect($url, $delay, $msg)
	{
	    if( isset($msg) )
	    {
	        $this->notify($msg);
	    }

	    echo "<meta http-equiv='Refresh' content='$delay; url=$url'>";
	}

	function notify($msg)
	{
	    $msg = addslashes($msg);
	    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	    echo "<script type='text/javascript'>alert('$msg')</script>\n";
	    echo "<noscript>$msg</noscript>\n";
	    return;
	}

	private function gen_file_name()
	{
		$r_char = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		$file_name = "";

		for($i=0; $i<10; $i++)
		{
			$file_name .= $r_char[rand(0, strlen($r_char) - 1)];
		}

		return $file_name;
	}

}
?>