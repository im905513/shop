<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Resume_manage extends Fuel_base_controller {
	public $view_location = 'resume';
	public $nav_selected = 'resume/manage';
	public $module_name = 'resume manage';
	public $module_uri = 'fuel/resume/lists';
	function __construct()
	{
		parent::__construct();
		$this->_validate_user('resume/manage');
		$this->load->module_model(RESUME_FOLDER, 'resume_manage_model');
		$this->load->module_model(CODEKIND_FOLDER, 'codekind_manage_model');
		$this->load->helper('ajax');
		$this->load->library('pagination');
		$this->load->library('set_page');
		$this->load->library('session');
		$this->load->library('comm');
	}
	
	function lists($dataStart=0)
	{
		$base_url = base_url(); 

		$post_ary = $this->input->post();

		// print_r($post_ary);
		
	 
		$search_id            = $post_ary["search_id"];
		$search_name          = $post_ary["search_name"];
		$search_recommended   = $post_ary["search_recommended"];
		$create_time_s        = $post_ary["create_time_s"];
		$create_time_e        = $post_ary["create_time_e"];
		$search_age_s         = $post_ary["search_age_s"];
		$search_age_e         = $post_ary["search_age_e"];
		$search_find_job_kind = $post_ary["search_find_job_kind"];
		$search_exp           = $post_ary["search_exp"];
		$search_city     = $post_ary["search_city"];
		$search_school        = $post_ary["search_school"];
		$search_skill         = $post_ary["search_skill"];
		$search_job_state     = $post_ary["search_job_state"];
		$search_email     = $post_ary["search_email"];
		$search_about     = $post_ary["search_about"];
		$search_note     = $post_ary["search_note"];
		$search_sex     = $post_ary["search_sex"];



		$filter = " WHERE 1=1  ";

		if ($search_name != "") {
			$filter .= " AND name LIKE '%$search_name%'";
			$this->session->set_userdata('search_name', $search_name);
		}else{
			if (!isset($search_name) ) {
				$search_name = $this->session->userdata('search_name'); 
				if ($search_name != "") {
					$search_name = $search_name;
					$filter .= " AND name LIKE '%$search_name%'";
				} 
			}else{
				$this->session->set_userdata('search_name', "");
			}					
		}

		if ($search_city != "") {
			$filter .= " AND address_city = '$search_city'";
			$this->session->set_userdata('search_city', $search_city);
		}else{
			if (!isset($search_city) ) {
				$search_city = $this->session->userdata('search_city'); 
				if ($search_city != "") {
					$search_city = $search_city;
					$filter .= " AND address_city = '$search_city'";
				} 
			}else{
				$this->session->set_userdata('search_city', "");
			}					
		}
  

		if ($search_id != "") {
			$filter .= " AND id = '$search_id'";
			$this->session->set_userdata('search_id', $search_id);
		}else{
			if (!isset($search_id) ) {
				$search_id = $this->session->userdata('search_id'); 
				if ($search_id != "") {
					$search_id = $search_id;
					$filter .= " AND id = '$search_id'";
				} 
			}else{
				$this->session->set_userdata('search_id', "");
			}				
		}

		if ($search_job_state != "") {
			$filter .= " AND job_status = '$search_job_state'";
			$this->session->set_userdata('search_job_state', $search_job_state);
		}else{
			if (!isset($search_job_state) ) {
				$search_job_state = $this->session->userdata('search_job_state'); 
				if ($search_job_state != "") {
					$search_job_state = $search_job_state;
					$filter .= " AND job_status = '$search_job_state'";
				} 
			}else{
				$this->session->set_userdata('search_job_state', "");
			}				
		}

		if ($search_find_job_kind != "") {
			$filter .= " AND find_job_kind = '$search_find_job_kind'";
			$this->session->set_userdata('search_find_job_kind', $search_find_job_kind);
		}else{
			if (!isset($search_find_job_kind) ) {
				$search_find_job_kind = $this->session->userdata('search_find_job_kind'); 
				if ($search_find_job_kind != "") {
					$search_find_job_kind = $search_find_job_kind;
					$filter .= " AND find_job_kind = '$search_find_job_kind'";
				} 
			}else{
				$this->session->set_userdata('search_find_job_kind', "");
			}				
		}


		if ($search_recommended  != "") {
			$filter .= " AND recommended like '%$search_recommended%'";
			$this->session->set_userdata('search_recommended', $search_recommended);
		}else{
			if (!isset($search_recommended) ) {
				$search_recommended = $this->session->userdata('search_recommended'); 
				if ($search_recommended != "") {
					$search_recommended = $search_recommended;
					$filter .= " AND recommended like '%$search_recommended%'";
				} 
			}else{
				$this->session->set_userdata('search_recommended', "");
			}			
		}

		if ($search_age_s  != "") {
			$filter .= " AND DATEDIFF(NOW(),birth)/365 >= '$search_age_s'";
			$this->session->set_userdata('search_age_s', $search_age_s);
		}else{
			if (!isset($search_age_s) ) {
				$search_age_s = $this->session->userdata('search_age_s'); 
				if ($search_age_s != "") {
					$search_age_s = $search_age_s;
					$filter .= " AND DATEDIFF(NOW(),birth)/365 >= '$search_age_s'";
				} 
			}else{
				$this->session->set_userdata('search_age_s', "");
			}			
		}

		if ($search_age_e  != "") {
			$filter .= " AND DATEDIFF(NOW(),birth)/365 <= '$search_age_e'";
			$this->session->set_userdata('search_age_e', $search_age_e);
		}else{
			if (!isset($search_age_e) ) {
				$search_age_e = $this->session->userdata('search_age_e'); 
				if ($search_age_e != "") {
					$search_age_e = $search_age_e;
					$filter .= " AND DATEDIFF(NOW(),birth)/365 <= '$search_age_e'";
				} 
			}else{
				$this->session->set_userdata('search_age_e', "");
			}			
		}

		if ($create_time_s  != "") {
			$filter .= " AND create_time >= '$create_time_s'";
			$this->session->set_userdata('create_time_s', $create_time_s);
		}else{
			if (!isset($create_time_s) ) {
				$create_time_s = $this->session->userdata('create_time_s'); 
				if ($create_time_s != "") {
					$create_time_s = $create_time_s;
					$filter .= " AND create_time >= '$create_time_s'";
				} 
			}else{
				$this->session->set_userdata('create_time_s', "");
			}			
		}

		if ($create_time_e  != "") {
			$filter .= " AND create_time <= '$create_time_e'";
			$this->session->set_userdata('create_time_e', $create_time_e);
		}else{
			if (!isset($create_time_e) ) {
				$create_time_e = $this->session->userdata('create_time_e'); 
				if ($create_time_e != "") {
					$create_time_e = $create_time_e;
					$filter .= " AND create_time <= '$create_time_e'";
				} 
			}else{
				$this->session->set_userdata('create_time_e', "");
			}				
		}

		if ($search_school  != "") {
			$filter .= " AND account in (select account from mod_school where school_id = '$search_school' ) ";
			$this->session->set_userdata('search_school', $search_school);
		}else{
			if (!isset($search_school) ) {
				$search_school = $this->session->userdata('search_school'); 
				if ($search_school != "") {
					$search_school = $search_school;
					$filter .= " AND account in (select account from mod_school where school_id = '$search_school' ) ";
				} 
			}else{
				$this->session->set_userdata('search_school', "");
			}		
		}

		if ($search_skill  != "") {
			$filter .= " AND account in (select account from mod_skill where skill_id = '$search_skill' ) ";
			$this->session->set_userdata('search_skill', $search_skill);
		}else{
			if (!isset($search_skill) ) {
				$search_skill = $this->session->userdata('search_skill'); 
				if ($search_skill != "") {
					$search_skill = $search_skill;
					$filter .= " AND account in (select account from mod_skill where skill_id = '$search_skill' ) ";
				} 
			}else{
				$this->session->set_userdata('search_skill', "");
			}			
		}

		if ($search_exp  != "") {
			if ($search_exp == "1") {
				 $filter .= " AND account in (select distinct account from mod_exp  ) ";
			}else if ($search_exp == "0") {
				 $filter .= " AND account not in (select distinct account from mod_exp  ) ";
			}
			
			$this->session->set_userdata('search_exp', $search_exp);
		}else{
			if (!isset($search_exp) ) {
				$search_exp = $this->session->userdata('search_exp'); 
				if ($search_exp != "") {
					$search_exp = $search_exp;
					if ($search_exp == "1") {
						 $filter .= " AND account in (select distinct account from mod_exp  ) ";
					}else if ($search_exp == "0") {
						 $filter .= " AND account not in (select distinct account from mod_exp  ) ";
					}
				} 
			}else{
				$this->session->set_userdata('search_exp', "");
			}			
		}

		if ($search_email != "") {
			$filter .= " AND contact_mail LIKE '%$search_email%'";
			$this->session->set_userdata('search_email', $search_email);
		}else{
			if (!isset($search_email) ) {
				$search_email = $this->session->userdata('search_email'); 
				if ($search_email != "") {
					$search_email = $search_email;
					$filter .= " AND contact_mail LIKE '%$search_email%'";
				} 
			}else{
				$this->session->set_userdata('search_email', "");
			}					
		}

		if ($search_about != "") {
			$filter .= " AND about_self LIKE '%$search_about%'";
			$this->session->set_userdata('search_about', $search_about);
		}else{
			if (!isset($search_about) ) {
				$search_about = $this->session->userdata('search_about'); 
				if ($search_about != "") {
					$search_about = $search_about;
					$filter .= " AND about_self LIKE '%$search_about%'";
				} 
			}else{
				$this->session->set_userdata('search_about', "");
			}					
		}

		if ($search_note != "") {
			$filter .= " AND note LIKE '%$search_note%'";
			$this->session->set_userdata('search_note', $search_note);
		}else{
			if (!isset($search_note) ) {
				$search_note = $this->session->userdata('search_note'); 
				if ($search_note != "") {
					$search_note = $search_note;
					$filter .= " AND note LIKE '%$search_note%'";
				} 
			}else{
				$this->session->set_userdata('search_note', "");
			}					
		}

		if ($search_sex != "") {
			$filter .= " AND sex = '$search_sex'";
			$this->session->set_userdata('search_sex', $search_sex);
		}else{
			if (!isset($search_sex) ) {
				$search_sex = $this->session->userdata('search_sex'); 
				if ($search_sex != "") {
					$search_sex = $search_sex;
					$filter .= " AND sex = '$search_sex'";
				} 
			}else{
				$this->session->set_userdata('search_sex', "");
			}					
		}
 
		
		$target_url = $base_url.'fuel/resume/lists/';

		$total_rows = $this->resume_manage_model->get_total_rows($filter);
		$config = $this->set_page->set_config($target_url, $total_rows, $dataStart, 20);
		$dataLen = $config['per_page'];
		$this->pagination->initialize($config);

		// echo $filter;

	    $recommended_ary = $this->codekind_manage_model->get_codekind_list(0,999,"WHERE codekind_key = 'EMPCODE'" ,'mod_code');
	    $job_state_ary = $this->codekind_manage_model->get_codekind_list(0,999,"WHERE codekind_key = 'job_state'" ,'mod_code');
	    $school_ary = $this->codekind_manage_model->get_codekind_list(0,999,"WHERE codekind_key = 'school'" ,'mod_code');
	    $skill_ary = $this->codekind_manage_model->get_codekind_list(0,999,"WHERE codekind_key = 'skill'" ,'mod_code');
	    $city_ary = $this->resume_manage_model->get_resume_option('address_city');

		$results = $this->resume_manage_model->get_resume_list($dataStart, $dataLen,$filter);
		

		$vars['search_id'] = $search_id;
		$vars['search_name'] = $search_name;
		$vars['search_recommended'] = $search_recommended;
		$vars['search_job_state'] = $search_job_state;
		$vars['create_time_s'] = $create_time_s;
		$vars['create_time_e'] = $create_time_e;
		$vars['search_age_s'] = $search_age_s;
		$vars['search_age_e'] = $search_age_e;
		$vars['search_find_job_kind'] = $search_find_job_kind;
		$vars['search_exp'] = $search_exp;
		$vars['search_city'] = $search_city;
		$vars['search_school'] = $search_school;
		$vars['search_skill'] = $search_skill;
		$vars['search_email'] = $search_email;
		$vars['search_about'] = $search_about;
		$vars['search_note'] = $search_note;
		$vars['search_sex'] = $search_sex;


		$vars['recommended_ary'] = $recommended_ary;
		$vars['job_state_ary'] = $job_state_ary;
		$vars['school_ary'] = $school_ary;
		$vars['skill_ary'] = $skill_ary;
		$vars['city_ary'] = $city_ary;


		

		$vars['total_rows'] = $total_rows; 
		$vars['form_action'] = $base_url.'fuel/resume/lists';
		$vars['form_method'] = 'POST';
		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);

		$vars['page_jump'] = $this->pagination->create_links();
		$vars['create_url'] = $base_url.'fuel/resume/create';
		$vars['export_url'] = $base_url.'fuel/resume/export_excel';
		$vars['edit_url'] = $base_url.'fuel/resume/edit?account=';
		$vars['del_url'] = $base_url.'fuel/resume/del';
		$vars['multi_del_url'] = $base_url.'fuel/resume/do_multi_del';
		$vars['results'] = $results;
		$vars['total_rows'] = $total_rows;
		$vars['search_url'] = $base_url.'fuel/resume/lists';
		$vars['level_url'] = $base_url.'fuel/code/lists?codekind_key=';
		$vars['CI'] = & get_instance();

		$this->fuel->admin->render('_admin/resume_lists_view', $vars);

	} 

 
	function create()
	{
		$vars['form_action'] = base_url().'fuel/resume/do_create';
		$vars['form_method'] = 'POST';
		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);		

		$vars['module_uri'] = base_url().$this->module_uri;
		$vars['view_name'] = "新增履歷";

		$job_state = $this->codekind_manage_model->get_code_list_for_other_mod("job_state");
		$vars['job_state'] = $job_state;

		$job_cate = $this->codekind_manage_model->get_code_list_for_other_mod("job_cate");
		$vars['job_cate'] = $job_cate;

		$city = $this->codekind_manage_model->get_code_list_for_other_mod("city");
		$vars['city'] = $city;

		$place = $this->codekind_manage_model->get_code_list_for_other_mod("city");
		$placeOrdered = array();
		foreach ($place as $key) {
			 $value = $this->codekind_manage_model->get_code_detail_by_parent_id($key->code_id);
			 array_push($placeOrdered, $key);
			 foreach ($value as $key2) {
			 	array_push($placeOrdered, $key2);
			 }
		}
		$vars['place'] = $placeOrdered;

		$this->fuel->admin->render("_admin/resume_create_view", $vars);
	}

	function do_create()
	{
		$module_uri = base_url().$this->module_uri;
		 
		$insert_data = array();
		$insert_data['account'] = $this->input->get_post("account");
		$insert_data['password'] = $this->input->get_post("password");
		$insert_data['name'] = $this->input->get_post("name");
		$insert_data['birth'] = $this->input->get_post("birth");
		$insert_data['contact_tel'] = $this->input->get_post("contact_tel");
		$insert_data['contact_mail'] = $this->input->get_post("contact_mail");
		$insert_data['address_zip'] = $this->input->get_post("address_zip");
		$insert_data['address_city'] = $this->input->get_post("address_city");
		$insert_data['address_area'] = $this->input->get_post("address_area");
		$insert_data['address'] = $this->input->get_post("address");
		$insert_data['job_status'] = $this->input->get_post("job_status");
		$insert_data['note'] = $this->input->get_post("note");
		$insert_data['about_self'] = $this->input->get_post("about_self");
		$insert_data['exclude_cate'] = implode(";",$this->input->get_post("exclude_cate"));
		$insert_data['job_location'] = implode(";",$this->input->get_post("place"));
		$insert_data['fb_account'] = $this->input->get_post("fb_account");

		$success = $this->resume_manage_model->insert($insert_data);
		$success = true;
		if($success)
		{
			$this->plu_redirect($module_uri, 0, "新增成功");
			die();
		}
		else
		{
			$this->plu_redirect($module_uri, 0, "新增失敗");
			die();
		}

		return;
	}

	 
	function edit()
	{
		$account = $this->input->get("account");
		if(isset($account))
		{
			$result = $this->resume_manage_model->get_resume_detail($account);
		}

		$vars['form_action'] = base_url().'fuel/resume/do_edit?account='.$account;
		$vars['form_method'] = 'POST';
		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);	
 

		$job_state = $this->codekind_manage_model->get_code_list_for_other_mod("job_state");
		$vars['job_state'] = $job_state;

		$job_cate = $this->codekind_manage_model->get_code_list_for_other_mod("job_cate");
		$vars['job_cate'] = $job_cate;

		$city = $this->codekind_manage_model->get_code_list_for_other_mod("city");
		$vars['city'] = $city;

		$place = $this->codekind_manage_model->get_code_list_for_other_mod("city");
		$placeOrdered = array();

		foreach ($place as $key) {
			 $value = $this->codekind_manage_model->get_code_detail_by_parent_id($key->code_id);
			 array_push($placeOrdered, $key);
			 foreach ($value as $key2) {
			 	array_push($placeOrdered, $key2);
			 }
		}
		$vars['place'] = $placeOrdered;

		$skill = $this->resume_manage_model->get_resume_skill($account);		
		$vars["skill"] = $skill;

		$school = $this->resume_manage_model->get_resume_school($account);		
		$vars["school"] = $school;


		$exp = $this->resume_manage_model->get_resume_exp($account);		
		$vars["exp"] = $exp;
	 

		$vars['module_uri'] = base_url().$this->module_uri;
		$vars["result"] = $result;
		$vars["view_name"] = "修改履歷";
		$this->fuel->admin->render('_admin/resume_edit_view', $vars);
	}

	function do_edit()
	{
		$account = $this->input->get("account");
		$module_uri = base_url().$this->module_uri;
		if(!empty($account))
		{
			$update_data = array();
			$update_data['account'] = $this->input->get_post("account");
			$password = $this->input->get_post("password");
			if (!empty($password)) {
				$update_data['password'] = $this->input->get_post("password");	
			}
			$update_data['name'] = $this->input->get_post("name");
			$update_data['birth'] = $this->input->get_post("birth");
			$update_data['contact_tel'] = $this->input->get_post("contact_tel");
			$update_data['contact_mail'] = $this->input->get_post("contact_mail");
			$update_data['sex'] = $this->input->get_post("sex");
			// $update_data['address_zip'] = $this->input->get_post("address_zip");
			// $update_data['address_city'] = $this->input->get_post("address_city");
			// $update_data['address_area'] = $this->input->get_post("address_area");
			// $update_data['address'] = $this->input->get_post("address");
			$update_data['note'] = $this->input->get_post("note");
			$update_data['job_status'] = $this->input->get_post("job_status");
			$update_data['about_self'] = $this->input->get_post("about_self");
			$exclude_cate = $this->input->get_post("exclude_cate");
			if (is_array($exclude_cate)  && sizeof($exclude_cate)>0) { 
				 $update_data['exclude_cate'] = implode(";",$exclude_cate );
			}else{
				$update_data['exclude_cate'] = "";
			}
			$place = $this->input->get_post("place");
			if (is_array($place)  && sizeof($place)>0) {
				 $update_data['job_location'] = implode(";",$place);
			} else{
				$update_data['job_location'] = "";
			}
			$update_data['fb_account'] = $this->input->get_post("fb_account");

			$success = $this->resume_manage_model->update($update_data);

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
		}
		else
		{
			$this->plu_redirect($module_uri, 0, "更新失敗");
			die();
		}

		return;
	} 

	function getArea($code_id)
	{
		$response = $this->codekind_manage_model->get_code_detail_by_parent_id($code_id);
		 
		echo json_encode($response);
	} 

	function do_del()
	{
		$account = $this->input->get("account");
		$response = array();
		if(!empty($account))
		{
			$success = $this->resume_manage_model->del($account);

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

			$col_name = array("Last Name","First Name","Middle Name","Alias","Company","Designation","Mobile No","Office No","Office Ext","Personal Email","Work Email","Home No","Gender","DateOfBirth","Industry-Sector","Function-SkillSet","Remarks","Address","ZipCode","education","work-experence","FBID");
			$value = $this->resume_manage_model->get_resume_export_list();
			$title = "Resume Data Export";
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
			ob_end_clean();
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$file_name.'.xls"');
			header('Cache-Control: max-age=0');

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
	}

}