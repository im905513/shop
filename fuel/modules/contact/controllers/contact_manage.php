<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Contact_manage extends Fuel_base_controller {
	public $view_location = 'contact';
	public $nav_selected = 'contact/manage';
	public $module_name = 'contact manage';
	public $module_uri = 'fuel/contact/lists';
	function __construct()
	{
		parent::__construct();
		$this->_validate_user('contact/manage');
		$this->load->module_model(CONTACT_FOLDER, 'contact_manage_model');
		$this->load->module_model(CODEKIND_FOLDER, 'codekind_manage_model');
		$this->load->helper('ajax');
		$this->load->library('pagination');
		$this->load->library('set_page');
		$this->load->library('session');
	}
	
	function lists($dataStart=0)
	{
		$base_url = base_url(); 
	 
		$search_type = $this->input->get_post("search_type");
		$search_status = $this->input->get_post("search_status");  

		$filter = " WHERE 1=1  ";

		if ($search_type == "") {
			$search_type = $this->session->userdata('search_type'); 
		}   

		if ($search_status == "") {
			$search_status = $this->session->userdata('search_status');  
		}

		
		$this->session->set_userdata('search_type', $search_type);
		$this->session->set_userdata('search_status', $search_status); 	
	 

		$filter .= " AND contact_type = '$search_type'";
		$filter .= " AND contact_status = '$search_status'";
	   
		$target_url = $base_url.'fuel/contact/lists/';

		$total_rows = $this->contact_manage_model->get_total_rows($filter);
		$config = $this->set_page->set_config($target_url, $total_rows, $dataStart, 20);
		$dataLen = $config['per_page'];
		$this->pagination->initialize($config);
 
		$results = $this->contact_manage_model->get_contact_list($dataStart, $dataLen,$filter);
		
		$vars['total_rows'] = $total_rows;
		$vars['search_type'] = $search_type;
		$vars['search_status'] = $search_status; 
		$vars['form_action'] = $base_url.'fuel/contact/lists';
		$vars['form_method'] = 'POST';

		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);

		$vars['page_jump'] = $this->pagination->create_links();

		$vars['detail_url'] = $base_url.'fuel/contact/detail/';		
		$vars['results'] = $results;
		$vars['total_rows'] = $total_rows;
		// $vars['search_url'] = $base_url.'fuel/contact/lists';
		// $vars['level_url'] = $base_url.'fuel/code/lists?codekind_key=';
		$vars['batch_url'] = $base_url.'fuel/contact/do_batch';
		$vars['CI'] = & get_instance();

		$this->fuel->admin->render('_admin/contact_lists_view', $vars);

	} 

	function detail($id)
	{
		$base_url = base_url(); 
		
		$target_url = $base_url.'fuel/contact/lists/';   
		$contact = $this->contact_manage_model->get_contact_detail($id);


		if ($contact->contact_type == 2) {
			 $job = $this->contact_manage_model->get_job_detail($id);
			 if (isset($job)) {
			 	 $vars['job'] = $job; 
				 $skill_0 = $this->contact_manage_model->get_skill($job->id,0);
				 $vars['skill_0'] = $skill_0; 
				 $skill_1 = $this->contact_manage_model->get_skill($job->id,1);
				 $vars['skill_1'] = $skill_1; 
			 }
			 
		}
		
 	// 	$vars['form_action'] = $base_url.'fuel/contact/lists';
		// $vars['form_method'] = 'POST';

		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);

		$vars['module_uri'] = base_url().$this->module_uri;
		$vars['view_name'] = "聯絡資訊";
		$vars['contact'] = $contact; 
		
		$vars['detail_url'] = $base_url.'fuel/contact/detail/';		  
		$vars['CI'] = & get_instance();

		$this->fuel->admin->render('_admin/contact_detail_view', $vars);
	}

	function do_multi_update_status(){
		$result = array();

		$ids = $this->input->get_post("ids");
		$contact_status = $this->input->get_post("contact_status");


		if(isset($ids))
		{
			$im_ids = implode(",", $ids);  
			$success = $this->contact_manage_model->do_multi_update_status($contact_status,$im_ids);
		}
		else
		{
			$success = false;
		}

		// $result['msg'] = $success; 

		if($success)
		{
			$result['status'] = 1; 
		}
		else
		{
			$result['status'] = $ids; 
		}


		if(is_ajax())
		{
			echo json_encode($result);
		}
	} 

}