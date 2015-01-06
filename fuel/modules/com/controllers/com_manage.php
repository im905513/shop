<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Com_manage extends Fuel_base_controller {
	public $view_location = 'com';
	public $nav_selected = 'com/manage';
	public $module_name = 'com';
	public $module_uri = 'com/lists';
	function __construct()
	{
		parent::__construct();
		$this->_validate_user('com/manage');
		$this->load->module_model(COM_FOLDER, 'com_manage_model');
		$this->load->helper('ajax');
		$this->load->library('pagination');
		$this->load->library('set_page');
		$this->load->module_model(CODEKIND_FOLDER, 'codekind_manage_model');
	}
	
	function lists($dataStart=0)
	{
		$base_url = base_url(); 
		$act = $this->input->get_post("act");
		$search_item = $this->input->get_post("search_item");
		$filter = "";

		


		if($search_item && $act)
		{
			switch ($act) {
				case 'by_name':
					$filter = " WHERE com_title LIKE '%".$search_item."%'";
					break;
				case 'by_email':
					$filter = " WHERE com_email LIKE '%".$search_item."%'";
					break;	
				default:
					$filter = " WHERE 1=1 " ;
					break;
			}
		}
		
		$target_url = $base_url.'fuel/com/lists/';

		$new_count = $this->com_manage_model->get_total_rows(" WHERE DATE(  `create_time` ) = DATE( NOW( ) )  ");
		$total_count = $this->com_manage_model->get_total_rows(" WHERE 1=1 ");
		$search_count = $this->com_manage_model->get_total_rows($filter);

		$vars['new_count'] = $new_count;
		$vars['total_count'] = $total_count;
		$vars['search_count'] = $search_count;

		$config = $this->set_page->set_config($target_url, $search_count, $dataStart, 20);
		$dataLen = $config['per_page'];
		$this->pagination->initialize($config);

		$com_results = $this->com_manage_model->get_com_list($dataStart, $dataLen, $filter);

		$vars['search_item'] = $search_item;
		$vars['act'] = $act;
		$vars['form_action'] = $base_url.'fuel/com/lists';
		$vars['form_method'] = 'POST';
		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);

		$vars['page_jump'] = $this->pagination->create_links();
		$vars['create_url'] = $base_url.'fuel/com/create';
		$vars['edit_url'] = $base_url.'fuel/com/edit/';
		$vars['del_url'] = $base_url.'fuel/com/del/';
		$vars['multi_del_url'] = $base_url.'fuel/com/do_multi_del';
		$vars['com_results'] = $com_results;
		$vars['search_url'] = $base_url.'fuel/com/lists';
		$vars['CI'] = & get_instance();

		$this->fuel->admin->render('_admin/com_lists_view', $vars);
		//$this->load->view('_admin/member_lists_view', $vars, 'member');

	}

	function create()
	{
		$view_name = "新增發案者";
		$base_url = base_url(); 

		$vars['cli_kind_result'] = $this->codekind_manage_model->get_code_list_for_other_mod('cli_role');
		$vars['view_name'] = $view_name;

		$vars['form_action'] = $base_url."fuel/com/do_create";
		$vars['form_method'] = 'POST';

		$com_row = new stdClass();
		$com_row->com_title = "";
		$com_row->com_email = "";
		$com_row->com_mobile = "";
		$com_row->com_phone_day = "";
		$com_row->com_phone_night = "";
		$vars['com_row'] = $com_row;
		$vars['module_uri'] = $this->module_uri;
		$vars['submit_url'] = $base_url."fuel/com/do_create";
		$vars['back_url'] = $base_url."fuel/com/lists";
		$vars['CI'] = & get_instance();

		$this->fuel->admin->render('_admin/com_maintain_view', $vars);
	}

	function do_create()
	{
		$base_url = base_url();
		
		$com_title = $this->input->get_post("com_title");
		$com_email = $this->input->get_post("com_email");
		$com_mobile = $this->input->get_post("com_mobile");
		$com_phone_day = $this->input->get_post("com_phone_day");
		$com_phone_night = $this->input->get_post("com_phone_night");

		 
// ($cli_title, $cli_email, $cli_fbid, $cli_logo	, $cli_detail,
// 								  $cli_mobile, $cli_phone_day, $cli_phone_night, $cli_kind, $cli_regi_kind
// 								  , $cli_skills, $cli_tools, $cli_live_city, $is_index)
		$success = $this->com_manage_model->do_add_com($com_title, $com_email, $com_mobile, $com_phone_day,$com_phone_night);

		if($success)
		{
			$this->plu_redirect($base_url."fuel/com/lists", 0, "新增成功");
			die();
		}
	}

	function edit($com_id)
	{
		$view_name = "修改接案者";
		$base_url = base_url();

		$com_row = $this->com_manage_model->get_com_detail($com_id);
 
 		$vars['cli_kind_result'] = $this->codekind_manage_model->get_code_list_for_other_mod('cli_role');
		$vars['form_method'] = 'POST';
		$vars['module_uri'] = $this->module_uri;
		$vars['view_name'] = $view_name;
		$vars['com_row'] = $com_row;
		$vars['back_url'] = $base_url."fuel/com/lists";
		$vars['form_action'] = $base_url."fuel/com/do_edit/".$com_id;
		$vars['CI'] = & get_instance();

		$this->fuel->admin->render('_admin/com_maintain_view', $vars);
	}

	function do_edit($com_id)
	{
		$base_url = base_url();
		
		$com_title = $this->input->get_post("com_title");
		$com_email = $this->input->get_post("com_email");
		$com_mobile = $this->input->get_post("com_mobile");
		$com_phone_day = $this->input->get_post("com_phone_day");
		$com_phone_night = $this->input->get_post("com_phone_night");

		$success = $this->com_manage_model->do_edit_com($com_id,$com_title, $com_email, $com_mobile, $com_phone_day,$com_phone_night);
		if($success)
		{
			$this->plu_redirect($base_url."fuel/com/lists", 0, "修改成功");
			die();
		}
	}

	function do_del($com_id)
	{
		$result = array();

		$success = $this->com_manage_model->do_del_com($com_id);

		if($success)
		{
			$result['status'] = 1;
		}
		else
		{
			$result['status'] = -1;
		}


		if(is_ajax())
		{
			echo json_encode($result);
		}
	}

	function do_multi_del()
	{
		$result = array();

		$com_ids = $this->input->get_post("com_ids");

		if($com_ids)
		{
			$im_com_ids = implode(",", $com_ids);

			$success = $this->member_manage_model->do_multi_del_com($im_com_ids);
		}
		else
		{
			$success = false;
		}



		if(isset($success))
		{
			$result['status'] = 1;
		}
		else
		{
			$result['status'] = $im_order_ids;
		}


		if(is_ajax())
		{
			echo json_encode($result);
		}
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

}