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


		$vars['detail_url'] 		= $base_url.'fuel/order/detail?order_id=';
		$vars['del_url'] 			= $base_url.'fuel/order/del?order_id=';
		$vars['multi_del_url'] 		= $base_url.'fuel/order/do_multi_del';
		$vars['results'] 			= $results;
		$vars['total_rows'] 		= $total_rows;
		$vars['search_url'] 		= $base_url.'fuel/order/lists';
		$vars['export_url']			= base_url().'fuel/order/export_excel';/**/
		$vars['CI'] = & get_instance();

		$this->fuel->admin->render('_admin/order_lists_view', $vars);

	}

	function detail()
	{
		$module_uri = base_url().$this->module_uri;
		$order_id = $this->input->get("order_id");

		if($order_id)
		{
			$content_result = $this->order_manage_model->get_order_detail($order_id);
			$detail_result = $this->order_manage_model->get_order_pro_detail($order_id);

			if(empty($content_result))
			{
				$this->plu_redirect($module_uri, 0, "查無此訂單");
				die();
			}
		}
		else
		{
			$this->plu_redirect($module_uri, 0, "查無此訂單");
			die();
		}


		$vars['form_action'] = base_url().'fuel/product/do_edit?order_id='.$order_id;
		$vars['form_method'] = 'POST';
		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);	
 
	 

		$vars['module_uri'] 			= base_url().$this->module_uri;
		$vars['edit_url'] 				= base_url().'fuel/order/edit?order_id='.$order_id;
		$vars["content_result"] 		= $content_result;
		$vars["detail_result"] 			= $detail_result;
		$vars['del_detail_url'] 		= base_url().'fuel/order/detail/del/';
		$vars['set_order_status_url']	= base_url().'fuel/order/set/order_status/';
		$vars["view_name"] 				= "訂單資訊";
		$this->fuel->admin->render('_admin/order_detail_view', $vars);
	}

	function edit()
	{
		$module_uri = base_url().$this->module_uri;
		$order_id = $this->input->get("order_id");

		if($order_id)
		{
			$content_result = $this->order_manage_model->get_order_detail($order_id);
			$detail_result = $this->order_manage_model->get_order_pro_detail($order_id);

			if(empty($content_result))
			{
				$this->plu_redirect($module_uri, 0, "查無此訂單");
				die();
			}
		}
		else
		{
			$this->plu_redirect($module_uri, 0, "查無此訂單");
			die();
		}


		$vars['form_action'] = base_url().'fuel/order/do_edit?order_id='.$order_id;
		$vars['form_method'] = 'POST';
		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);	
 
	 

		$vars['module_uri'] 			= base_url().$this->module_uri;
		$vars["content_result"] 		= $content_result;
		$vars["detail_result"] 			= $detail_result;
		$vars['del_detail_url'] 		= base_url().'fuel/order/detail/del/';
		$vars["view_name"] 				= "訂單資訊";
		$this->fuel->admin->render('_admin/order_edit_view', $vars);
	}

function do_edit()
	{
		$base_url = base_url();
		$module_uri = base_url().$this->module_uri;
		$order_id = $this->input->get("order_id");

		$insert_data = array();
		$insert_data['order_vat_number']			= $this->input->get_post("order_vat_number");
		$insert_data['order_invoice_title']			= $this->input->get_post("order_invoice_title");
		$insert_data['order_addressee_name']		= $this->input->get_post("order_addressee_name");
		$insert_data['order_addressee_mobile']		= $this->input->get_post("order_addressee_mobile");
		$insert_data['order_addressee_addr']		= $this->input->get_post("order_addressee_addr");
		$insert_data['order_note']					= $this->input->get_post("order_note");
		$insert_data['order_status']				= $this->input->get_post("order_status");
		$insert_data['order_ship_status']			= $this->input->get_post("order_ship_status");
		$insert_data['order_inv_status']			= $this->input->get_post("order_inv_status");

		$success = $this->order_manage_model->modify($insert_data, $order_id);
		
		if($success)
		{
			$this->plu_redirect($base_url.'fuel/order/detail?order_id='.$order_id, 0, "修改成功");
			die();
		}
		else
		{
			$this->plu_redirect($base_url.'fuel/order/detail?order_id='.$order_id, 0, "修改失敗");
			die();
		}
		return;
	} 

	function do_del_detail_item($did)
	{
		$response = array();

		if(!empty($did))
		{
			$success = $this->order_manage_model->del_detail_item($did);

			if($success)
			{
				$response['status'] = 1;
			}
			else
			{
				$response['status'] = -1;
			}
		}
		else
		{
			$response['status']	= -1;
		}

		echo json_encode($response);
	}

	function set_order_status($order_id, $status)
	{
		$module_uri = base_url().$this->module_uri;
		if(!empty($order_id) && !empty($status))
		{
			$success = $this->order_manage_model->set_order_status($order_id, $status);

			if($success)
			{
				$this->plu_redirect($module_uri, 0, "更新成功");
				die();
			}
			else
			{
				$this->plu_redirect($module_uri, 0, "更新失敗");
				die();
			}
			return;
		}
		else
		{
			$this->plu_redirect($module_uri, 0, "更新失敗");
			die();
		}

		return;
	}

	function do_del()
	{
		$order_id = $this->input->get("order_id");
		$response = array();
		if(!empty($order_id))
		{
			$success = $this->order_manage_model->del($order_id);

			if($success)
			{
				$response['status'] = 1;
			}
			else
			{
				$response['status'] = -1;
			}
		}
		else
		{
			$response['status'] = -1;
		}

		echo json_encode($response);
	}

	function do_multi_del()
	{
		$order_ids = $this->input->get_post("orderids");
		$response = array();

		if(!empty($order_ids))
		{
			if(is_array($order_ids))
			{
				$ids = implode(",", $order_ids);
				$success = $this->order_manage_model->multi_del($ids);

				if($success)
				{
					$response['status']	= 1;
				}
				else
				{
					$response['status']	= -1;
				}
			}
			else
			{
				$response['status']	= -1;
			}

		}
		else
		{
			$response['status']	= -1;
		}

		echo json_encode($response);

		return;
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