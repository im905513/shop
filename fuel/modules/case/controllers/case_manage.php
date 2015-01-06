<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Case_manage extends Fuel_base_controller {
	public $view_location = 'case';
	public $nav_selected = 'case/manage';
	public $module_name = 'case manage';
	public $module_uri = 'fuel/case/lists';
	function __construct()
	{
		parent::__construct();
		$this->_validate_user('case/manage');
		$this->load->module_model(CASE_FOLDER, 'case_manage_model');
		$this->load->helper('ajax');
		$this->load->library('pagination');
		$this->load->library('set_page');
	}
	
	function lists($dataStart=0)
	{
		$base_url = base_url();
		$today = date("Y-m-d 00:00:00");

		$act = $this->input->get_post("act");
		$search_item = $this->input->get_post("search_item");
		$filter = "";

		if($act)
		{
			switch ($act) {
				case 'by_title':
					$filter = " WHERE cd_title LIKE '%".$search_item."%'";
					break;
				case 'by_content':
					$filter = " WHERE cd_content LIKE '%".$search_item."%'";
					break;					
				default:
					$filter = " WHERE cd_title LIKE %'".$search_item."'%";
					break;
			}
		}
		else
		{	

			$filter = " WHERE board='soho' || board='518case'";
		}
		
		$target_url = $base_url.'fuel/case/lists/';

		$total_rows = $this->case_manage_model->get_total_rows($filter);
		$config = $this->set_page->set_config($target_url, $total_rows, $dataStart, 20);
		$dataLen = $config['per_page'];
		$this->pagination->initialize($config);

		$case_results = $this->case_manage_model->get_case_list($dataStart, $dataLen, $filter);
		$today_count = $this->case_manage_model->get_today_data_count("WHERE board='soho' || board='518case' AND run_date>'".$today."'");

		$vars['form_action'] = $base_url.'fuel/case/lists';
		$vars['form_method'] = 'POST';
		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);

		$vars['page_jump'] = $this->pagination->create_links();
		$vars['create_url'] = $base_url.'fuel/case/create';
		$vars['edit_url'] = $base_url.'fuel/case/edit/';
		$vars['del_url'] = $base_url.'fuel/case/del/';
		$vars['multi_del_url'] = $base_url.'fuel/case/do_multi_del';
		$vars['case_results'] = $case_results;
		$vars['today_count'] = $today_count;
		$vars['total_rows'] = $total_rows;
		$vars['search_url'] = $base_url.'fuel/case/lists';
		$vars['CI'] = & get_instance();

		$this->fuel->admin->render('_admin/case_lists_view', $vars);
		//$this->load->view('_admin/member_lists_view', $vars, 'member');

	}

	function edit($cd_id)
	{
		
		if(isset($cd_id))
		{
			$case_result = $this->case_manage_model->get_case_detail($cd_id);
		}

		$vars['module_uri'] = base_url().$this->module_uri;
		$vars["case_result"] = $case_result;
		$vars["view_name"] = "修改外包案件";
		$this->fuel->admin->render('_admin/case_edit_view', $vars);
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