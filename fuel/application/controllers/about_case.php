<?php
class About_case extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		define('FUELIFY', FALSE);
		$this->load->model('about_case_model');
		$this->load->model('about_user_model');
		$this->load->library('set_meta');
		$this->load->library('pagination');
		$this->load->library('set_page');
		$this->load->helper('ajax');
		$this->load->module_library(FUEL_FOLDER, 'fuel_auth');
		$this->load->library('comm');
	}


	function index($dataStart=0)
	{	
		
		fuel_set_var('page_id', "3");

		$kw = isset($_GET['kw'])?htmlspecialchars($_GET['kw'], ENT_QUOTES, 'UTF-8'):"";
		$code_id = $this->input->get_post("case_type");
		$sub_cate_result = array();
		$vars['parent_id'] 	= 0;
		$vars['sub_id']		= 0;

		if(!empty($code_id))
		{
			$this->set_meta->set_meta_data($code_id, "case_cate");
		}
		else
		{
			$this->set_meta->set_meta_data();
		}

		if($kw != "")
		{
			$filter = " WHERE board='soho' and cd_title LIKE '%$kw%'";
			$display_sub_cate = 0;
		}
		else if(!empty($code_id))
		{
			$parent_id = $this->about_case_model->get_parent_id($code_id);
			$display_sub_cate = 1;
			if($parent_id == -1)
			{
				$sub_ids = $this->about_case_model->get_case_cate_sub_ids($code_id);
				$sub_cate_result = $this->about_case_model->get_case_sub_cate($code_id);
				if(isset($sub_ids))
				{
					$filter = " WHERE board='soho' AND real_cate IN ($sub_ids)";
				}
				else
				{
					$filter = " WHERE board='soho'";
				}

				$vars['parent_id'] = $code_id;
				$vars['sub_id']		= -1;
			}
			else
			{
				$vars['parent_id'] 	= $parent_id;
				$vars['sub_id']		= $code_id;
				$filter = " WHERE board='soho' AND real_cate='$code_id'";
				$sub_cate_result = $this->about_case_model->get_case_sub_cate($parent_id);
			}
		}
		else
		{
			$filter = " WHERE board='soho' ";
			$display_sub_cate = 0;
		}
		
		$target_url = base_url()."case/";

		$total_rows = $this->about_case_model->get_total_rows($filter);
		$config = $this->set_page->set_config($target_url, $total_rows, $dataStart, 10);
		$dataLen = $config['per_page'];
		$this->pagination->initialize($config);

		$case_result = $this->about_case_model->get_case_list($dataStart, $dataLen, $filter);
		$case_cate	= $this->about_case_model->get_case_cate_code();
		$vars['filter']	= $filter;
		$vars['views'] = 'about_case_view';
		$vars['detail_url'] = base_url()."case/detail/";
		$vars['case_result'] = $case_result;
		$vars['case_cate']	= $case_cate;
		$vars['sub_cate']	= $sub_cate_result;
		$vars['display_sub_cate']	= $display_sub_cate;
		$vars['base_url'] = base_url();
		$vars['this_url']	= base_url().'case/';
		$vars['page_jump'] = $this->pagination->create_links();

		$this->fuel->pages->render('about_case_view', $vars);
	}

	function case_detail($cd_id)
	{
		$this->set_meta->set_meta_data($cd_id, "case");
		fuel_set_var('page_id', "3");
		$relation_case = array();
		if(isset($cd_id))
		{
			$case_detail = $this->about_case_model->get_case_detail($cd_id);
			if($case_detail->real_cate != null)
			{
				$parent_id = $this->about_case_model->get_parent_id($case_detail->real_cate);

				if($parent_id != -1)
				{
					$sub_ids = $this->about_case_model->get_case_cate_sub_ids($parent_id);
					$filter = " WHERE board='soho' AND real_cate IN ($sub_ids)";

					$relation_case = $this->about_case_model->get_relation_case($filter, $case_detail->cd_id);
				}				
			}


			
            $date = date_create($case_detail->run_date);
            $vars['date_d'] = date_format($date, 'd');
            $vars['date_m'] = date_format($date, 'F');

			$vars['case_detail'] = $case_detail;
			$vars['relation_case']	= $relation_case;
			$vars['views'] = 'case_detail_view';
			$vars['base_url'] = base_url();
			$vars['page_jump'] = $this->pagination->create_links();

			$this->fuel->pages->render('case_detail_view', $vars);			
		}
		else
		{
			show_404();
		}

	}

	function help_me()
	{
		$this->set_meta->set_meta_data();
		fuel_set_var('page_id', "2");
		$is_logined = $this->fuel_auth->is_logged_in();

		if($is_logined)
		{
			redirect(site_url().'case/help/step2');
		}
		else
		{
			$vars['views'] = 'help_me_view';
			$vars['base_url'] = base_url();
			
			$this->fuel->pages->render('help_me_view', $vars);				
		}
		
		
	}

	function help_me_step2()
	{
		$is_logined = $this->fuel_auth->is_logged_in();

		if($is_logined)
		{
			$this->set_meta->set_meta_data();
			fuel_set_var('page_id', "2");

			$user = $this->fuel_auth->valid_user();

			$user_data = $this->about_user_model->get_user_basic_info_by_fbid($user['fbid']);

			if(!empty($user_data->cli_email) && !empty($user_data->cli_mobile))
			{
				redirect(site_url().'case/help/step3');
			}
			else
			{
				$vars['views'] = 'help_me_step2_view';
				$vars['user_data'] = $user_data;
				$vars['base_url'] = base_url();
				
				$this->fuel->pages->render('help_me_step2_view', $vars);				
			}
			
		}
		else
		{
			$this->comm->plu_redirect(site_url().'case/help', 0, "請先登入");
		}

			
	}

	function help_me_step3()
	{
		$is_logined = $this->fuel_auth->is_logged_in();

		if($is_logined)
		{
			$user = $this->fuel_auth->valid_user();
			$cd_id = $this->input->get_post("cd_id");
			$this->set_meta->set_meta_data();
			fuel_set_var('page_id', "2");
			$user_data = $this->about_user_model->get_user_basic_info_by_fbid($user['fbid']);

			
			if(empty($user_data->cli_email) || empty($user_data->cli_mobile))
			{
				redirect(site_url().'case/help/step2');
				die();
			}
			

			if(!empty($cd_id))
			{
				$case_url = $this->about_case_model->get_case_url($cd_id);
			}
			else
			{
				$case_url = "";
			}

			$vars['cli_intro'] = $this->about_user_model->get_cli_intro($user['id']);
			$vars['case_url'] = $case_url;
			$vars['cd_id']	= $cd_id;
			$vars['views'] = 'help_me_step3_view';
			$vars['base_url'] = base_url();
			
			$this->fuel->pages->render('help_me_step3_view', $vars);
		}
		else
		{
			$this->comm->plu_redirect(site_url().'case/help', 0, "請先登入");
		}		
	}

	function require_help()
	{
		$is_logined = $this->fuel_auth->is_logged_in();
		$result = array();
		$insert_data = array();

		if($is_logined)
		{
			$user = $this->fuel_auth->valid_user();
			$cli_intro	= $this->input->get_post("cli_intro");
			$insert_data['cd_id'] 		= $this->input->get_post("cd_id");
			$insert_data['case_url']	= $this->input->get_post("case_url");
			$insert_data['cli_id']		= $user['id'];

			$is_exist = $this->about_case_model->get_case_help_by_cli_id($insert_data);

			if($is_exist === false)
			{
				$insert_data['cli_intro'] = $this->about_user_model->get_intro_detail($user['id'], $cli_intro);

				if(strlen($insert_data['cli_intro']) > 100)
				{
					$success = $this->about_case_model->do_insert_help($insert_data);

					if($success)
					{
						$result['status']	= 1;
						exec("php /var/www/html/9icase/iOSAPN.php");
					}
					else
					{
						$result['status'] 	= -1;
						$result['msg']		= "新增失敗";
					}						
				}
				else
				{
					$result['status'] 	= -1;
					$result['msg']		= "您的自介尚未填寫，或自介字數未超過50個字，請填寫正確再來提案";
				}
			
			}
			else
			{
				$result['status'] 	= -1;
				$result['msg']		= "您已對這個案件提出申請，請選擇其它案件";
			}				
		}
		else
		{
			$result['status']  	= -99;
			$result['msg'] 		= "您沒有權限";
		}

		if(is_ajax())
		{
			echo json_encode($result);
			die();
		}
		else
		{
			show_404();
		}
	}

	function post_case_step1()
	{
		$case_cate	= $this->about_case_model->get_case_cate_code();

		$vars['main_cate']	= $case_cate;
		$vars['views'] = 'case_post_step1_view';
		$vars['base_url'] = base_url();
		
		$this->fuel->pages->render('case_post_step1_view', $vars);
	}

	function mail_test()
	{
		$this->load->library('email');

		$this->email->from('service@9icase.com', '【9iCase】免費接外包網');
		$this->email->to("im905513@gmail.com"); 

		$this->email->subject("test");
		$this->email->message("test111111");
		
		if($this->email->send())
		{
			echo "success";
			echo "im905513@gmail.com";
		}
		else
		{
			echo $this->email->print_debugger();
		}
	}
	
}