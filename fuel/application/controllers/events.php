<?php
class Events extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		define('FUELIFY', FALSE);
		$this->load->library('set_meta');
		$this->load->library('comm');
	}

	function register() 
	{
		parent::Controller();

	}

	function index($dataStart=0)
	{	
		$this->load->helper('cookie');
		$this->load->library('facebook');
		$this->load->library('pagination');
		$this->load->library('set_page');
		$base_url = base_url();
		$this->load->module_model(EVENT_FOLDER, 'event_manage_model');
		$this->set_meta->set_meta_data();
		fuel_set_var('page_id', "1");
		$filter = '';
		$target_url = $base_url.'event/';
		$total_rows = $this->event_manage_model->get_total_rows($filter);
		$config = $this->set_page->set_front_end_config($target_url, $total_rows, $dataStart, 8);
		$dataLen = $config['per_page'];
		$this->pagination->initialize($config);

		$results = $this->event_manage_model->get_event_list($dataStart, $dataLen, $filter);

		$vars['base_url'] 			= $base_url;
		$vars['photo_path']			= $base_url.'assets/uploads/event/';
		$vars['results']			= $results;
		$vars['event_detail_url']	= $base_url.'event/detail/';
		$vars['page_jump'] 			= $this->pagination->create_links();
		$vars['views'] 				= 'event_list';
		$page_init = array('location' => 'event_list');
		$this->fuel->pages->render('event_list', $vars);

	}

	function event_detail($event_id)
	{
		$this->load->helper('cookie');
		$this->load->library('facebook');
		$this->load->model('code_model');
		$base_url = base_url();
		$this->load->module_model(EVENT_FOLDER, 'event_manage_model');

		$result = $this->event_manage_model->get_event_detail($event_id);
		$regi_num = $this->event_manage_model->get_regi_num($event_id);

		$r_url = "event/detail/".$event_id;

		$fb_data	= $this->code_model->get_fb_data($r_url);
		$vars['fb_data'] = $fb_data;

		$vars['views'] 		= 'event_detail';
		$vars['photo_path']	= $base_url.'assets/uploads/event/';
		$vars['result']		= $result;
		$vars['regi_num']	= $regi_num;
		$vars['regi_url']	= $base_url.'api/regievent/'.$event_id;
		$page_init = array('location' => 'event_detail');
		$this->fuel->pages->render('event_detail', $vars);
	}

	function regi_event($event_id)
	{
		$this->load->model('code_model');
		$this->load->module_model(EVENT_FOLDER, 'event_manage_model');
		$response = array();

		if($this->code_model->is_logged_in())
		{
			$account = $this->code_model->get_logged_in_account();
			$chk_limit = $this->event_manage_model->do_chk_limit($event_id);

			if($chk_limit === true)
			{
				$chk_regied = $this->event_manage_model->do_chk_regied($event_id, $account);

				if($chk_regied === true)
				{
					$success = $this->event_manage_model->do_regi_event($event_id, $account);

					if($success)
					{
						$result['status']	= 1;
						$result['msg']		= "活動報名完成";
					}
					else
					{
						$result['status']	= -1;
						$result['msg']		= "伺服器忙線中，請稍後再試";
					}
				}
				else
				{
					$result['status']	= -3;
					$result['msg']		= "您已報名過此活動";
				}
			}
			else
			{
				$result['status']	= -2;
				$result['msg']		= "報名活動名額已滿";
			}
		}
		else
		{
			$result['status']	= -99;
			$result['msg']		= "尚未登入";
		}

		echo json_encode($result);
	}
	
}