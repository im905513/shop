<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Event_manage extends Fuel_base_controller {
	public $view_location = 'event';
	public $nav_selected = 'event/manage';
	public $module_name = 'Event manage';
	public $module_uri = 'fuel/event/lists';
	function __construct()
	{
		parent::__construct();
		$this->_validate_user('event/manage');
		$this->load->module_model(EVENT_FOLDER, 'event_manage_model');
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
		$search_txt = $this->input->get_post("search_txt");
		$filter = "";

		switch ($search_type) 
		{
			case 0:
				$filter = " WHERE event_title LIKE '%".$search_txt."%'";
				break;
			case 1:
				$filter = " WHERE event_charge=".$search_txt;
				break;
			case 2:
				$filter = " WHERE event_place LIKE '%".$search_txt."%'";
				break;
			
			default:
				$filter = "";
				break;
		}

		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);

		$target_url = $base_url.'fuel/event/lists/';

		$total_rows = $this->event_manage_model->get_total_rows($filter);
		$config = $this->set_page->set_config($target_url, $total_rows, $dataStart, 20);
		$dataLen = $config['per_page'];
		$this->pagination->initialize($config);

		$results = $this->event_manage_model->get_event_list($dataStart, $dataLen, $filter);

		$vars['page_jump'] = $this->pagination->create_links();
		$vars['create_url'] = $base_url.'fuel/event/create';

		$vars['edit_url'] 			= $base_url.'fuel/event/edit?event_id=';
		$vars['del_url'] 			= $base_url.'fuel/event/del?event_id=';
		$vars['multi_del_url'] 		= $base_url.'fuel/event/do_multi_del';
		$vars['results'] 			= $results;
		$vars['total_rows'] 		= $total_rows;
		$vars['search_url'] 		= $base_url.'fuel/event/lists';
		$vars['event_status_url']	= $base_url.'fuel/event/status/';
		$vars['CI'] = & get_instance();


		$this->fuel->admin->render('_admin/event_lists_view', $vars);

	} 

 
	function create()
	{
		$vars['form_action'] = base_url().'fuel/event/do_create';
		$vars['form_method'] = 'POST';
		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);		

		$vars['module_uri'] = base_url().$this->module_uri;
		$vars['module_path'] = base_url().'fuel/modules/event/';
		$vars['view_name'] = "新增活動";

		$this->fuel->admin->render("_admin/event_create_view", $vars);
	}

	function do_create()
	{
		$base_url = base_url();
		$module_uri = base_url().$this->module_uri;

		$files = $_FILES;

		$config['upload_path']		= assets_server_path('uploads/event/');
		$config['allowed_types']	= 'gif|jpg|png';
		$config['max_size']			= '10000';
		$config['max_width']		= '1920';
		$config['max_height']		= '1280';

		$file_name = $this->gen_file_name().substr($files["event_photo"]["name"], strpos($files["event_photo"]["name"], "."));
		$_FILES['event_photo']['name']		= $file_name;
		$_FILES['event_photo']['type']		= $files['event_photo']['type'];
		$_FILES['event_photo']['tmp_name']	= $files['event_photo']['tmp_name'];
		$_FILES['event_photo']['error']		= $files['event_photo']['error'];
		$_FILES['event_photo']['size']		= $files['event_photo']['size'];

		$insert_data = array();
		$insert_data['event_title']			= $this->input->get_post("event_title");
		$insert_data['event_start_date']	= $this->input->get_post("event_start_date");
		$insert_data['event_end_date']		= $this->input->get_post("event_end_date");
		$insert_data['regi_start_date']		= $this->input->get_post("regi_start_date");
		$insert_data['regi_end_date']		= $this->input->get_post("regi_end_date");
		$insert_data['event_charge']		= $this->input->get_post("event_charge");
		$insert_data['event_place']			= $this->input->get_post("event_place");
		$insert_data['regi_limit_num']		= $this->input->get_post("regi_limit_num");
		$insert_data['event_detail']		= $this->input->get_post("event_detail");
		$insert_data['event_photo']			= $file_name;

		$this->load->library('upload', $config);

		// Alternately you can set preferences by calling the initialize function. Useful if you auto-load the class:
		$this->upload->initialize($config);

		$field_name = 'event_photo';
		if(!$this->upload->do_upload($field_name))
		{
			$this->plu_redirect($base_url.'fuel/event/create', 0, $this->upload->display_errors());
			die();
		}
		else
		{
			$success = $this->event_manage_model->insert($insert_data);
		}


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
		$event_id = $this->input->get("event_id");

		if($event_id)
		{
			$result = $this->event_manage_model->get_event_detail($event_id);

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

		$vars['form_action'] = base_url().'fuel/event/do_edit?event_id='.$event_id;
		$vars['form_method'] = 'POST';
		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);	
 
	 

		$vars['module_uri'] = base_url().$this->module_uri;
		$vars["result"] = $result;
		$vars["view_name"] = "修改活動";
		$this->fuel->admin->render('_admin/event_edit_view', $vars);
	}

	function do_edit()
	{
		$base_url = base_url();
		$module_uri = base_url().$this->module_uri;
		$event_id = $this->input->get("event_id");
		if(!empty($_FILES['event_photo']['name']))
		{
			$files = $_FILES;

			$config['upload_path']		= assets_server_path('uploads/event/');
			$config['allowed_types']	= 'gif|jpg|png';
			$config['max_size']			= '10000';
			$config['max_width']		= '1920';
			$config['max_height']		= '1280';

			$file_name = $this->gen_file_name().substr($files["event_photo"]["name"], strpos($files["event_photo"]["name"], "."));
			$_FILES['event_photo']['name']		= $file_name;
			$_FILES['event_photo']['type']		= $files['event_photo']['type'];
			$_FILES['event_photo']['tmp_name']	= $files['event_photo']['tmp_name'];
			$_FILES['event_photo']['error']		= $files['event_photo']['error'];
			$_FILES['event_photo']['size']		= $files['event_photo']['size'];

			$this->load->library('upload', $config);

			// Alternately you can set preferences by calling the initialize function. Useful if you auto-load the class:
			$this->upload->initialize($config);

			$field_name = 'event_photo';
			if(!$this->upload->do_upload($field_name))
			{
				$this->plu_redirect($base_url.'fuel/event/edit?event_id='.$event_id, 0, $this->upload->display_errors());
				die();
			}
			else
			{
				$event_photo = $this->event_manage_model->get_photo_name($event_id);

				$cmd = "rm ".$config['upload_path'].$event_photo;
				exec($cmd);
				$this->event_manage_model->modify_photo_name($file_name, $event_id);
			}

		}

		$insert_data = array();
		$insert_data['event_title']			= $this->input->get_post("event_title");
		$insert_data['event_start_date']	= $this->input->get_post("event_start_date");
		$insert_data['event_end_date']		= $this->input->get_post("event_end_date");
		$insert_data['regi_start_date']		= $this->input->get_post("regi_start_date");
		$insert_data['regi_end_date']		= $this->input->get_post("regi_end_date");
		$insert_data['event_charge']		= $this->input->get_post("event_charge");
		$insert_data['event_place']			= $this->input->get_post("event_place");
		$insert_data['regi_limit_num']		= $this->input->get_post("regi_limit_num");
		$insert_data['event_detail']		= $this->input->get_post("event_detail");

		$success = $this->event_manage_model->modify($insert_data, $event_id);
		
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
		$event_id = $this->input->get("event_id");
		$response = array();
		if(!empty($event_id))
		{
			$success = $this->event_manage_model->del($event_id);

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
		$event_ids = $this->input->get_post("eventids");
		$response = array();

		if(!empty($event_ids))
		{
			if(is_array($event_ids))
			{
				$ids = implode(",", $event_ids);
				$success = $this->event_manage_model->multi_del($ids);

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

	function event_status($event_id)
	{
		$module_uri = base_url().$this->module_uri;

		if($event_id)
		{
			$base_url = base_url();
			$crumbs = array($this->module_uri => $this->module_name);
			$this->fuel->admin->set_titlebar($crumbs);

			$results = $this->event_manage_model->get_status_list($event_id);

			$vars['module_uri']	= base_url().$this->module_uri;
			$vars['view_name'] 	= "報名狀態";
			$vars['bath_url']	= $base_url.'fuel/event/update/regitype';
			$vars['results']	= $results;
			$vars['total_rows']	= count($results);

			$vars['CI'] = & get_instance();


			$this->fuel->admin->render('_admin/event_status_view', $vars);			
		}
		else
		{
			$this->plu_redirect($module_uri, 0, "找不到資料");
			die();
		}
	}

	function do_batch_regi_type()
	{
		$regi_ids = $this->input->get_post("regiids");
		$regi_type = $this->input->get_post("regi_type");
		$response = array();

		if(!empty($regi_ids))
		{
			if(is_array($regi_ids))
			{
				$ids = implode(",", $regi_ids);
				$success = $this->event_manage_model->multi_update_regi_type($ids, $regi_type);

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