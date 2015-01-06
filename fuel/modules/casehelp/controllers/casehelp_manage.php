<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Casehelp_manage extends Fuel_base_controller {
	public $view_location = 'casehelp';
	public $nav_selected = 'casehelp/manage';
	public $module_name = 'casehelp manage';
	public $module_uri = 'fuel/casehelp/lists';
	function __construct()
	{
		parent::__construct();
		$this->_validate_user('casehelp/manage');
		$this->load->module_model(CASEHELP_FOLDER, 'casehelp_manage_model');
		$this->load->helper('ajax');
		$this->load->library('pagination');
		$this->load->library('set_page');
		$this->load->library('email');
	}
	
	function lists($dataStart=0)
	{
		$base_url = base_url(); 

		$act = $this->input->get_post("act");
		$search_item = $this->input->get_post("search_item");
		$done = $this->input->get_post("done");
		// echo "done : $done";
		$filter = "";

		if ($done == "on") {
			$filter .= " AND a.ch_done=1 "; 
			$vars['done'] = 'checked';
		}else{
			$filter .= " AND a.ch_done=0 ";
			$vars['done'] = '';
		}
		 
		if (!empty($search_item)) {
			switch ($act) {
				case 'by_title':
					$filter .= " AND c.cli_title LIKE '%".$search_item."%'";
					break;
				case 'by_content':
					$filter .= " AND b.cd_title LIKE '%".$search_item."%'"; 
					break;
			}
		}
		
		// echo $filter;
		$target_url = $base_url.'fuel/casehelp/lists/';

		$total_rows = $this->casehelp_manage_model->get_total_rows($filter);
		$config = $this->set_page->set_config($target_url, $total_rows, $dataStart, 20);
		$dataLen = $config['per_page'];
		$this->pagination->initialize($config);

		$case_results = $this->casehelp_manage_model->get_casehelp_list($dataStart, $dataLen, $filter);
		$today_count = $this->casehelp_manage_model->get_today_data_count();
        $vars['search_item'] = $search_item;
		$vars['act'] = $act;
		$vars['form_action'] = $base_url.'fuel/casehelp/lists';
		$vars['form_method'] = 'POST';
		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);
 		$vars['multi_done_url'] = $base_url.'fuel/casehelp/batch';
		$vars['page_jump'] = $this->pagination->create_links();
		$vars['case_url'] = $base_url.'fuel/case/edit/';
		$vars['client_url'] = $base_url.'fuel/client/edit/';  
		$vars['replyed_url'] = $base_url.'fuel/casehelp/replyed/lists';
		$vars['replay_url']		= $base_url.'fuel/casehelp/replay/';
		$vars['case_results'] = $case_results;
		$vars['today_count'] = $today_count;
		$vars['total_rows'] = $total_rows;
		$vars['search_url'] = $base_url.'fuel/casehelp/lists';
		$vars['CI'] = & get_instance();

		$this->fuel->admin->render('_admin/casehelp_lists_view', $vars);
		//$this->load->view('_admin/member_lists_view', $vars, 'member');

	}

	function winformList(){
		$result = $this->casehelp_manage_model->get_casehelp_list_winform();
		echo json_encode($result);
	}

	function replyed_list($dataStart=0)
	{
		$base_url = base_url(); 
		
		$target_url = $base_url.'fuel/casehelp/replyed/lists/';

		$total_rows = $this->casehelp_manage_model->get_replyed_total_row();
		$config = $this->set_page->set_config($target_url, $total_rows, $dataStart, 20);
		$dataLen = $config['per_page'];
		$this->pagination->initialize($config);

		$case_results = $this->casehelp_manage_model->get_replyed_list($dataStart, $dataLen, $filter);

 		$vars['multi_done_url'] = $base_url.'fuel/casehelp/batch';
		$vars['page_jump'] 		= $this->pagination->create_links();
		$vars['case_url'] 		= $base_url.'fuel/case/edit/';
		$vars['client_url'] 	= $base_url.'fuel/client/edit/';
		$vars['casehelp_url']	= $base_url.'fuel/casehelp/lists';
		$vars['replay_url'] 	= $base_url.'fuel/casehelp/replay/';
		$vars['cml_url']		= base_url().'fuel/casehelp/replyed/detail/';
		$vars['case_results'] 	= $case_results;
		$vars['total_rows'] 	= $total_rows;
		$vars['CI'] = & get_instance();

		$this->fuel->admin->render('_admin/casehelp_replay_list_view', $vars);
	}

	function reply_detail($cml_id)
	{
		$vars['reply_detail'] = $this->casehelp_manage_model->get_reply_content($cml_id);
		$vars['cml_list_url']	= base_url().'fuel/casehelp/replyed/lists';
		$vars['cml_url']		= base_url().'fuel/casehelp/replyed/detail/';
		$vars['CI'] = & get_instance();
		$this->fuel->admin->render('_admin/caehelp_reply_detail_view', $vars);
	}

	function replay($ch_id){
		$base_url = base_url(); 
		$vars['ch_id'] = $ch_id;
		//$casehelp_row = $this->casehelp_manage_model->get_casehelp_detail($ch_id);
		$vars['casehelp_row'] = $this->casehelp_manage_model->get_casehelp_detail($ch_id);
		
		$vars['form_action'] = $base_url.'fuel/casehelp/doReplay';
		$vars['form_method'] = 'POST';
		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);
		$vars['CI'] = & get_instance();
		$this->fuel->admin->render('_admin/casehelp_replay_view', $vars);
	}

	function do_replay(){
		$base_url = base_url(); 

		$ch_id = $this->input->get_post("ch_id");	
		$cml_title = $this->input->get_post("cml_title");
		$cml_content = $this->input->get_post("cml_content");

		$client_row = $this->casehelp_manage_model->get_client_detail($ch_id);



		$this->email->from('service@mail.9icase.com', '【9iCase】免費接外包網');
		$this->email->to($client_row->cli_email); 

		$this->email->subject($cml_title);
		$this->email->message(nl2br(htmlspecialchars_decode($cml_content)));

		
		// $this->casehelp_manage_model->do_batch($ch_id);
		// $this->casehelp_manage_model->do_add_log($ch_id,$cml_title,$cml_content);
		if($success = $this->email->send())
		{
			//$this->edm_manage_model->update_send_status($row->edm_log_id);
			$this->casehelp_manage_model->do_batch($ch_id);
			$this->casehelp_manage_model->do_add_log($ch_id,$cml_title,$cml_content);
		}
		if($success)
		{
			$this->plu_redirect($base_url."fuel/casehelp/lists", 0, "寄送成功");
			die();
		}
	}

	function do_batch(){
		$result = array();

		$ch_ids = $this->input->get_post("ch_ids");

		if($ch_ids)
		{
			$im_ch_ids = implode(",", $ch_ids);

			$success = $this->casehelp_manage_model->do_batch($im_ch_ids);
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
			$result['status'] = $im_ch_ids;
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