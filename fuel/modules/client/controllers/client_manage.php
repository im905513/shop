<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Client_manage extends Fuel_base_controller {
	public $view_location = 'client';
	public $nav_selected = 'client/manage';
	public $module_name = 'client';
	public $module_uri = 'client/lists';
	function __construct()
	{
		parent::__construct();
		$this->_validate_user('client/manage');
		$this->load->module_model(CLIENT_FOLDER, 'client_manage_model');
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
					$filter = " WHERE cli_title LIKE '%".$search_item."%'";
					break;
				case 'by_email':
					$filter = " WHERE cli_email LIKE '%".$search_item."%'";
					break;	
				default:
					$filter = " WHERE 1=1 " ;
					break;
			}
		}
		
		$target_url = $base_url.'fuel/client/lists/';

		$new_count = $this->client_manage_model->get_total_rows(" WHERE DATE(  `create_time` ) = DATE( NOW( ) )  ");
		$total_count = $this->client_manage_model->get_total_rows(" WHERE 1=1 ");
		$search_count = $this->client_manage_model->get_total_rows($filter);

		$vars['new_count'] = $new_count;
		$vars['total_count'] = $total_count;
		$vars['search_count'] = $search_count;

		$config = $this->set_page->set_config($target_url, $search_count, $dataStart, 20);
		$dataLen = $config['per_page'];
		$this->pagination->initialize($config);

		$client_results = $this->client_manage_model->get_client_list($dataStart, $dataLen, $filter);

		$vars['search_item'] = $search_item;
		$vars['act'] = $act;
		$vars['form_action'] = $base_url.'fuel/client/lists';
		$vars['form_method'] = 'POST';
		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);

		$vars['page_jump'] = $this->pagination->create_links();
		$vars['create_url'] = $base_url.'fuel/client/create';
		$vars['edit_url'] = $base_url.'fuel/client/edit/';
		$vars['del_url'] = $base_url.'fuel/client/del/';
		$vars['multi_del_url'] = $base_url.'fuel/client/do_multi_del';
		$vars['client_results'] = $client_results;
		$vars['search_url'] = $base_url.'fuel/client/lists';
		$vars['CI'] = & get_instance();

		$this->fuel->admin->render('_admin/client_lists_view', $vars);
		//$this->load->view('_admin/member_lists_view', $vars, 'member');

	}

	function create()
	{
		$view_name = "新增接案者";
		$base_url = base_url(); 

		$vars['cli_kind_result'] = $this->codekind_manage_model->get_code_list_for_other_mod('cli_role');
		$vars['view_name'] = $view_name;

		$vars['form_action'] = $base_url."fuel/client/do_create";
		$vars['form_method'] = 'POST';

		$client_row = new stdClass();
		$client_row->cli_fbid = "";
		$client_row->cli_title = "";
		$client_row->cli_live_city = "";
		$client_row->cli_mobile = "";
		$client_row->cli_phone_day = "";
		$client_row->cli_phone_night = "";
		$client_row->cli_email = "";
		$client_row->cli_kind = "";
		$client_row->cli_intro1 = "";
		$client_row->cli_intro2 = "";
		$client_row->cli_intro3 = "";
		$vars['client_row'] = $client_row;
		$vars['module_uri'] = $this->module_uri;
		$vars['submit_url'] = $base_url."fuel/client/do_create";
		$vars['back_url'] = $base_url."fuel/client/lists";
		$vars['CI'] = & get_instance();

		$this->fuel->admin->render('_admin/client_maintain_view', $vars);
	}

	function do_create()
	{
		$base_url = base_url();
		
		$cli_fbid = $this->input->get_post("cli_fbid");
		$cli_title = $this->input->get_post("cli_title");
		$cli_live_city = $this->input->get_post("cli_live_city");
		$cli_mobile = $this->input->get_post("cli_mobile");
		$cli_phone_day = $this->input->get_post("cli_phone_day");
		$cli_phone_night = $this->input->get_post("cli_phone_night");
		$cli_email = $this->input->get_post("cli_email"); 
		$cli_kind = $this->input->get_post("cli_kind");
		$cli_intro1 = $this->input->get_post("cli_intro1");
		$cli_intro2 = $this->input->get_post("cli_intro2");
		$cli_intro3 = $this->input->get_post("cli_intro3");

		 
// ($cli_title, $cli_email, $cli_fbid, $cli_logo	, $cli_detail,
// 								  $cli_mobile, $cli_phone_day, $cli_phone_night, $cli_kind, $cli_regi_kind
// 								  , $cli_skills, $cli_tools, $cli_live_city, $is_index)
		$success = $this->client_manage_model->do_add_client($cli_title, $cli_email, $cli_fbid, "",
			                                                 $cli_mobile, $cli_phone_day, $cli_phone_night,$cli_kind,"",
			                                                 "","",$cli_live_city,"0",$cli_intro1,$cli_intro2,$cli_intro3);

		if($success)
		{
			$this->plu_redirect($base_url."fuel/client/lists", 0, "新增成功");
			die();
		}
	}

	function edit($cli_id)
	{
		$view_name = "修改接案者";
		$base_url = base_url();

		$client_row = $this->client_manage_model->get_client_detail($cli_id);
 
 		$vars['cli_kind_result'] = $this->codekind_manage_model->get_code_list_for_other_mod('cli_role');
		$vars['form_method'] = 'POST';
		$vars['module_uri'] = $this->module_uri;
		$vars['view_name'] = $view_name;
		$vars['client_row'] = $client_row;
		$vars['back_url'] = $base_url."fuel/client/lists";
		$vars['form_action'] = $base_url."fuel/client/do_edit/".$cli_id;
		$vars['CI'] = & get_instance();

		$this->fuel->admin->render('_admin/client_maintain_view', $vars);
	}

	function do_edit($cli_id)
	{
		$base_url = base_url();
		
		$cli_fbid = $this->input->get_post("cli_fbid");
		$cli_title = $this->input->get_post("cli_title");
		$cli_live_city = $this->input->get_post("cli_live_city");
		$cli_mobile = $this->input->get_post("cli_mobile");
		$cli_phone_day = $this->input->get_post("cli_phone_day");
		$cli_phone_night = $this->input->get_post("cli_phone_night");
		$cli_email = $this->input->get_post("cli_email"); 
		$cli_kind = $this->input->get_post("cli_kind");
		$cli_intro1 = $this->input->get_post("cli_intro1");
		$cli_intro2 = $this->input->get_post("cli_intro2");
		$cli_intro3 = $this->input->get_post("cli_intro3");

		$success = $this->client_manage_model->do_edit_client($cli_id,$cli_title, $cli_email, $cli_fbid, "", 
			                                                 $cli_mobile, $cli_phone_day, $cli_phone_night,$cli_kind,"",
			                                                 "","",$cli_live_city,"0",$cli_intro1,$cli_intro2,$cli_intro3);
		if($success)
		{
			$this->plu_redirect($base_url."fuel/client/lists", 0, "修改成功");
			die();
		}
	}

	function do_del($cli_id)
	{
		$result = array();

		$success = $this->client_manage_model->do_del_client($cli_id);

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

		$cli_ids = $this->input->get_post("cli_ids");

		if($cli_ids)
		{
			$im_cli_ids = implode(",", $cli_ids);

			$success = $this->member_manage_model->do_multi_del_client($im_cli_ids);
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