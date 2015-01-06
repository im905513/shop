<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Product_manage extends Fuel_base_controller {
	public $view_location = 'product';
	public $nav_selected = 'product/manage';
	public $module_name = 'Product manage';
	public $module_uri = 'fuel/product/lists';
	public $reply_list_uri = 'replylist/';
	function __construct()
	{
		parent::__construct();
		$this->_validate_user('product/manage');
		$this->load->module_model(PRODUCT_FOLDER, 'product_manage_model');
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
				$filter = " WHERE pro_name LIKE '%".$search_txt."%'";
				break;
			case 2:
				$filter = " WHERE pro_item_no LIKE '%".$search_txt."%'";
				break;
			default:
				$filter = "";
				break;
		}

		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);

		$target_url = $base_url.'fuel/product/lists/';

		$total_rows = $this->product_manage_model->get_total_rows($filter);
		$config = $this->set_page->set_config($target_url, $total_rows, $dataStart, 20);
		$dataLen = $config['per_page'];
		$this->pagination->initialize($config);

		$results = $this->product_manage_model->get_product_list($dataStart, $dataLen, $filter);

		$vars['page_jump'] = $this->pagination->create_links();
		$vars['create_url'] = $base_url.'fuel/product/create';

		$vars['edit_url'] 			= $base_url.'fuel/product/edit?pro_id=';
		$vars['del_url'] 			= $base_url.'fuel/product/del?pro_id=';
		$vars['multi_del_url'] 		= $base_url.'fuel/product/do_multi_del';
		$vars['results'] 			= $results;
		$vars['total_rows'] 		= $total_rows;
		$vars['search_url'] 		= $base_url.'fuel/product/lists';
		$vars['prod_reply_url']		= $base_url.'fuel/product/replylist/';
		$vars['export_url']				= base_url().'fuel/product/export_excel';
		$vars['CI'] = & get_instance();

		$this->fuel->admin->render('_admin/product_lists_view', $vars);

	} 

 
	function create()
	{
		$vars['form_action'] = base_url().'fuel/product/do_create';
		$vars['form_method'] = 'POST';
		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);		

		$pro_cate_result 	= $this->product_manage_model->get_code_list("WHERE codekind_key='PROCATE' AND parent_id=-1");
		$pro_size_result 	= $this->product_manage_model->get_code_list("WHERE codekind_key='PROSIZE' AND parent_id=-1");
		$pro_color_result 	= $this->product_manage_model->get_code_list("WHERE codekind_key='PROCOLOR' AND parent_id=-1");
		$pro_status_result 	= $this->product_manage_model->get_code_list("WHERE codekind_key='PROSTATUS' AND parent_id=-1");
		$vars['pro_cate_result']	= $pro_cate_result;
		$vars['pro_size_result']	= $pro_size_result;
		$vars['pro_color_result']	= $pro_color_result;
		$vars['pro_status_result']	= $pro_status_result;

		$vars['module_uri'] = base_url().$this->module_uri;
		$vars['module_path'] = base_url().'fuel/modules/product/';
		$vars['get_cate_child_url'] 	= base_url().'fuel/product/get/codechild/';
		$vars['view_name'] = "新增產品";

		$this->fuel->admin->render("_admin/product_create_view", $vars);
	}

	function do_create()
	{
		$base_url = base_url();
		$module_uri = base_url().$this->module_uri;
		/*
		$files = $_FILES;
		
		$config['upload_path']		= assets_server_path('uploads/product/');
		$config['allowed_types']	= 'gif|jpg|png';
		$config['max_size']			= '10000';
		$config['max_width']		= '1920';
		$config['max_height']		= '1280';
		
		$file_name = $this->gen_file_name().substr($files["product_photo"]["name"], strpos($files["product_photo"]["name"], "."));
		$_FILES['product_photo']['name']		= $file_name;
		$_FILES['product_photo']['type']		= $files['product_photo']['type'];
		$_FILES['product_photo']['tmp_name']	= $files['product_photo']['tmp_name'];
		$_FILES['product_photo']['error']	= $files['product_photo']['error'];
		$_FILES['product_photo']['size']		= $files['product_photo']['size'];
		*/

		$insert_data = array();
		$insert_data['pro_item_no']			= $this->input->get_post("pro_item_no");
		$insert_data['pro_cate']			= $this->input->get_post("pro_cate");
		$pro_cate_child 					= $this->input->get_post("pro_cate_child");
		$insert_data['pro_name']			= $this->input->get_post("pro_name");
		$insert_data['pro_slogan']			= $this->input->get_post("pro_slogan");
		$pro_color							= $this->input->get_post("pro_color");
		$pro_size							= $this->input->get_post("pro_size");
		$insert_data['pro_num']				= $this->input->get_post("pro_num");
		$insert_data['pro_original_price']	= $this->input->get_post("pro_original_price");
		$insert_data['pro_wholesale_price']	= $this->input->get_post("pro_wholesale_price");
		$insert_data['pro_vip_price']		= $this->input->get_post("pro_vip_price");
		$insert_data['pro_stime']			= $this->input->get_post("pro_stime");
		$insert_data['pro_etime']			= $this->input->get_post("pro_etime");
		$insert_data['pro_order']			= $this->input->get_post("pro_order");
		$insert_data['pro_status']			= $this->input->get_post("pro_status");
		$insert_data['pro_desc']			= $this->input->get_post("pro_desc");
		$insert_data['pro_format_1']		= $this->input->get_post("pro_format_1");
		$insert_data['pro_format_2']		= $this->input->get_post("pro_format_2");
		$insert_data['pro_format_3']		= $this->input->get_post("pro_format_3");
		$insert_data['pro_ship_note']		= $this->input->get_post("pro_ship_note");
		$insert_data['seo_title']			= $this->input->get_post("seo_title");
		$insert_data['seo_kw']				= $this->input->get_post("seo_kw");
		$insert_data['seo_desc']			= $this->input->get_post("seo_desc");

		if(is_array($pro_color))
		{
			$insert_data['pro_color'] = implode(",", $pro_color);
		}
		else
		{
			$insert_data['pro_color']	= "";
		}

		if(is_array($pro_size))
		{
			$insert_data['pro_size'] = implode(",", $pro_size);
		}
		else
		{
			$insert_data['pro_size']	= "";
		}

		if(!empty($pro_cate_child))
		{
			$insert_data['pro_cate'] = $pro_cate_child;
		}

		$success = $this->product_manage_model->insert($insert_data);

		/*
		$this->load->library('upload', $config);

		// Alternately you can set preferences by calling the initialize function. Useful if you auto-load the class:
		$this->upload->initialize($config);

		$field_name = 'product_photo';
		if(!$this->upload->do_upload($field_name))
		{
			$this->plu_redirect($base_url.'fuel/product/create', 0, $this->upload->display_errors());
			die();
		}
		else
		{
			$success = $this->product_manage_model->insert($insert_data);
		}

		*/
		if($success)
		{
			$this->plu_redirect($module_uri, 0, "新增成功");
			die();
		}
		else
		{
			$cmd = "rm ".$config['upload_path'].$file_name;
			exec($cmd);

			$this->plu_redirect($module_uri, 0, "新增失敗");
			die();
		}

		return;
	}

	 
	function edit()
	{
		$module_uri = base_url().$this->module_uri;
		$pro_id = $this->input->get("pro_id");

		if($pro_id)
		{
			$result = $this->product_manage_model->get_product_detail($pro_id);

			if(empty($result))
			{
				$this->plu_redirect($module_uri, 0, "查無此id");
				die();
			}
		}
		else
		{
			$this->plu_redirect($module_uri, 0, "查無此id");
			die();
		}

		$pro_cate_result 	= $this->product_manage_model->get_code_list("WHERE codekind_key='PROCATE' AND parent_id=-1");
		$pro_size_result 	= $this->product_manage_model->get_code_list("WHERE codekind_key='PROSIZE' AND parent_id=-1");
		$pro_color_result 	= $this->product_manage_model->get_code_list("WHERE codekind_key='PROCOLOR' AND parent_id=-1");
		$pro_status_result 	= $this->product_manage_model->get_code_list("WHERE codekind_key='PROSTATUS' AND parent_id=-1");
		$vars['pro_cate_result']	= $pro_cate_result;
		$vars['pro_size_result']	= $pro_size_result;
		$vars['pro_color_result']	= $pro_color_result;
		$vars['pro_status_result']	= $pro_status_result;

		$vars['form_action'] = base_url().'fuel/product/do_edit?pro_id='.$pro_id;
		$vars['form_method'] = 'POST';
		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);	
 
	 

		$vars['module_uri'] = base_url().$this->module_uri;
		$vars["result"] = $result;
		$vars["pro_size"] = explode(",", $result->pro_size);
		$vars["pro_color"] = explode(",", $result->pro_color);
		$vars['get_cate_child_url'] 	= base_url().'fuel/product/get/codechild/';
		$vars["view_name"] = "修改活動";
		$this->fuel->admin->render('_admin/product_edit_view', $vars);
	}

	function do_edit()
	{
		$base_url = base_url();
		$module_uri = base_url().$this->module_uri;
		$pro_id = $this->input->get("pro_id");
		/*
		if(!empty($_FILES['product_photo']['name']))
		{
			$files = $_FILES;

			$config['upload_path']		= assets_server_path('uploads/product/');
			$config['allowed_types']	= 'gif|jpg|png';
			$config['max_size']			= '10000';
			$config['max_width']		= '1920';
			$config['max_height']		= '1280';

			$file_name = $this->gen_file_name().substr($files["product_photo"]["name"], strpos($files["product_photo"]["name"], "."));
			$_FILES['product_photo']['name']		= $file_name;
			$_FILES['product_photo']['type']		= $files['product_photo']['type'];
			$_FILES['product_photo']['tmp_name']	= $files['product_photo']['tmp_name'];
			$_FILES['product_photo']['error']		= $files['product_photo']['error'];
			$_FILES['product_photo']['size']		= $files['product_photo']['size'];

			$this->load->library('upload', $config);

			// Alternately you can set preferences by calling the initialize function. Useful if you auto-load the class:
			$this->upload->initialize($config);

			$field_name = 'product_photo';
			if(!$this->upload->do_upload($field_name))
			{
				$this->plu_redirect($base_url.'fuel/product/edit?pro_id='.$pro_id, 0, $this->upload->display_errors());
				die();
			}
			else
			{
				$product_photo = $this->product_manage_model->get_photo_name($pro_id);

				$cmd = "rm ".$config['upload_path'].$product_photo;
				exec($cmd);
				$this->product_manage_model->modify_photo_name($file_name, $pro_id);
			}

		}
		*/

		$insert_data = array();
		$insert_data['pro_item_no']			= $this->input->get_post("pro_item_no");
		$insert_data['pro_cate']			= $this->input->get_post("pro_cate");
		$pro_cate_child 					= $this->input->get_post("pro_cate_child");
		$insert_data['pro_name']			= $this->input->get_post("pro_name");
		$insert_data['pro_slogan']			= $this->input->get_post("pro_slogan");
		$pro_color							= $this->input->get_post("pro_color");
		$pro_size							= $this->input->get_post("pro_size");
		$insert_data['pro_num']				= $this->input->get_post("pro_num");
		$insert_data['pro_original_price']	= $this->input->get_post("pro_original_price");
		$insert_data['pro_wholesale_price']	= $this->input->get_post("pro_wholesale_price");
		$insert_data['pro_vip_price']		= $this->input->get_post("pro_vip_price");
		$insert_data['pro_stime']			= $this->input->get_post("pro_stime");
		$insert_data['pro_etime']			= $this->input->get_post("pro_etime");
		$insert_data['pro_order']			= $this->input->get_post("pro_order");
		$insert_data['pro_status']			= $this->input->get_post("pro_status");
		$insert_data['pro_desc']			= $this->input->get_post("pro_desc");
		$insert_data['pro_format_1']		= $this->input->get_post("pro_format_1");
		$insert_data['pro_format_2']		= $this->input->get_post("pro_format_2");
		$insert_data['pro_format_3']		= $this->input->get_post("pro_format_3");
		$insert_data['pro_ship_note']		= $this->input->get_post("pro_ship_note");
		$insert_data['seo_title']			= $this->input->get_post("seo_title");
		$insert_data['seo_kw']				= $this->input->get_post("seo_kw");
		$insert_data['seo_desc']			= $this->input->get_post("seo_desc");

		if(is_array($pro_color))
		{
			$insert_data['pro_color'] = implode(",", $pro_color);
		}
		else
		{
			$insert_data['pro_color']	= "";
		}

		if(is_array($pro_size))
		{
			$insert_data['pro_size'] = implode(",", $pro_size);
		}
		else
		{
			$insert_data['pro_size']	= "";
		}

		if(!empty($pro_cate_child))
		{
			$insert_data['pro_cate'] = $pro_cate_child;
		}
		$success = $this->product_manage_model->modify($insert_data, $pro_id);
		
		if($success)
		{
			$this->plu_redirect($module_uri, 0, "修改成功");
			die();
		}
		else
		{
			$this->plu_redirect($module_uri, 0, "修改失敗");
			die();
		}
		return;
	} 

	function do_del()
	{
		$pro_id = $this->input->get("pro_id");
		$response = array();
		if(!empty($pro_id))
		{
			$success = $this->product_manage_model->del($pro_id);

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
		$pro_ids = $this->input->get_post("eventids");
		$response = array();

		if(!empty($pro_ids))
		{
			if(is_array($pro_ids))
			{
				$ids = implode(",", $pro_ids);
				$success = $this->product_manage_model->multi_del($ids);

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

	function get_codechild($codekind_key, $code_id)
	{
		$response = array();

		if(!empty($code_id))
		{
			$str = "WHERE codekind_key='".$codekind_key."' AND parent_id=".$code_id;
			$result = $this->product_manage_model->get_code_list($str);
		}

		if(!empty($result))
		{
			$response['status'] = 1;
			$response['result']	= $result;
		}
		else
		{
			$response['status']	= -1;
			$response['result']	= array();
		}

		echo json_encode($response);

		return;
	}

	function replylist($pro_id)
	{
		$module_uri = base_url().$this->module_uri;
		if($pro_id)
		{
			$base_url = base_url();
			$crumbs = array($this->module_uri => $this->module_name);
			$this->fuel->admin->set_titlebar($crumbs);

			$results = $this->product_manage_model->get_prod_reply_list($pro_id);

			$vars['module_uri']	= base_url().$this->module_uri;
			$vars['view_name'] 	= "商品留言";
			//$vars['bath_url']	= $base_url.'fuel/product/update/regitype';
			$vars['del_reply_url']	= $base_url.'fuel/product/reply_del/';
			$vars['results']	= $results;
			$vars['reply_url']	= $base_url.'fuel/product/reply_prod_reply/';
			$vars['total_rows']	= count($results);

			$vars['CI'] = & get_instance();


			$this->fuel->admin->render('_admin/product_reply_list_view', $vars);			
		}
		else
		{
			$this->plu_redirect($module_uri, 0, "找不到資料");
			die();
		}
	}

	function reply_prod_reply($r_id)
	{
		$vars['form_action'] = base_url().'fuel/product/do_reply?r_id='.$r_id;
		$vars['form_method'] = 'POST';
		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);		

		$result = $this->product_manage_model->get_reply_content($r_id);

		if(empty($result))
		{
			$this->plu_redirect($this->reply_list_uri.$result->product_id, 0, "找不到資料");
			return;
		}

		$vars['module_uri']		= base_url().'fuel/product/replylist/'.$result->product_id;
		$vars['module_path']	= base_url().'fuel/modules/product/';
		$vars['result']			= $result;
		$vars['view_name'] 		= "回覆留言";

		$this->fuel->admin->render("_admin/prod_reply_view", $vars);
	}

	function do_reply()
	{
		$r_id = $this->input->get_post('r_id');

		if(!empty($r_id))
		{
			$insert_data['admin_reply_content']	= $this->input->get_post("admin_reply_content");
			$insert_data['pro_id']				= $this->input->get_post("pro_id");
			$insert_data['r_id']				= $this->input->get_post("r_id");

			$success = $this->product_manage_model->reply_reply($insert_data);

			if($success)
			{
				$this->plu_redirect($this->reply_list_uri.$insert_data['pro_id'], 0, "回覆成功");
				die();
			}
			else
			{
				$this->plu_redirect($this->reply_list_uri.$insert_data['pro_id'], 0, "回覆失敗");
				die();
			}
		}
	}

	function reply_del($r_id)
	{
		$response = array();
		if(!empty($r_id))
		{
			$success = $this->product_manage_model->del_reply($r_id);

			if($success)
			{
				$response['status'] = 1;
			}
			else
			{
				$response['msg']	= 'del fail';
				$response['status'] = -1;
			}
		}
		else
		{
			$response['msg']	= 'missing para';
			$response['status'] = -1;
		}

		echo json_encode($response);
	}

	function multi_del_reply()
	{
		$r_ids = $this->input->get_post("rids");
		$response = array();

		if(!empty($r_ids))
		{
			if(is_array($r_ids))
			{
				$ids = implode(",", $r_ids);
				$success = $this->product_manage_model->multi_reply_del($ids);

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