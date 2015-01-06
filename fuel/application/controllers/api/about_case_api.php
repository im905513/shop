<?php
class About_case_api extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('api/about_case_api_model');
		$this->load->library('email');
		$this->load->helper('ajax');
	}


	function get_reply_list()
	{	
		$result = array();

		$reply_list = $this->about_case_api_model->get_unproccess_reply();
		
		if($reply_list)
		{
			$result['status'] 		= 1;
			$result['reply_list']	= $reply_list;
		}
		else
		{
			$result['status']	= -1;
			$result['msg']		= '讀取失敗';
		}

		echo json_encode($result);
		die();

	}

	function get_text_show($dataStart=0)
	{
		$result = array();

		$show_text = $this->about_case_api_model->get_new_case_title($dataStart);

		if($show_text)
		{
			$result['status'] 		= 1;
			$result['show_text']	= $show_text;
		}
		else
		{
			$result['status']	= -1;
			$result['msg']		= '讀取失敗';
		}

		echo json_encode($result);
		die();
	}

	function get_sub_cate($code_id)
	{
		$result = array();

		$sub_cate_result = $this->about_case_api_model->get_sub_cate_list($code_id);

		if($sub_cate_result)
		{
			$result['status'] 		= 1;
			$result['sub_cate_result']	= $sub_cate_result;
		}
		else
		{
			$result['status']	= -1;
			$result['sub_cate_result']	= $sub_cate_result;
			$result['msg']		= '讀取失敗';
		}

		echo json_encode($result);
		die();
	}

	function get_all_cate()
	{
		$result = array();

		$all_cate_result = $this->about_case_api_model->get_all_cate_list();

		if($all_cate_result)
		{
			$result["status"]			= 1;
			$result["all_cate_result"]	= $all_cate_result;
		}
		else
		{
			$result['status']			= -1;
			$result['all_cate_result']	= $all_cate_result;
			$result['msg']				= '讀取失敗';			
		}

		$var["json_data"] = $result;

		$this->load->view('api/api_view', $var);
		return;
	}

	function get_new_case()
	{
		$result = array();

		$new_cate_result = $this->about_case_api_model->get_new_case_list();

		if($new_cate_result)
		{
			$result["status"]			= 1;
			$result["new_cate_result"]	= $new_cate_result;
		}
		else
		{
			$result['status']			= -1;
			$result['new_cate_result']	= array();
			$result['msg']				= '讀取失敗';	
		}

		$var["json_data"]	= $result;

		$this->load->view('api/api_view', $var);
		return;
	}

	function get_case_list($dataStart=0)
	{
		$code_id		= $this->input->get_post("code_id");
		$search_txt		= $this->input->get_post("search_txt");
		$page_size		= $this->input->get_post("pageSize");
		$current_page	= $this->input->get_post("currentPage");
		$filter			= "";
		$total_count	= 0;

		if($current_page == 1 || empty($current_page))
		{
			$dataStart 	= 0;
		}
		else
		{
			$dataStart 	= ($current_page - 1) * $page_size;
		}

		if(empty($page_size))
		{
			$dataLen	= 10;
		}
		else
		{
			$dataLen	= $page_size;
		}
		

		if(!empty($code_id) && !empty($search_txt))
		{
			$filter 		= " AND real_cate IN($code_id) AND cd_title LIKE '%".$search_txt."%' ";
			$total_count	= $this->about_case_api_model->get_case_total_rows($filter);
			$case_result	= $this->about_case_api_model->get_case_list($dataStart, $dataLen, $filter);
		}
		else if(!empty($code_id) && empty($search_txt))
		{
			$filter 		= " AND real_cate IN($code_id) ";
			$total_count	= $this->about_case_api_model->get_case_total_rows($filter);
			$case_result	= $this->about_case_api_model->get_case_list($dataStart, $dataLen, $filter);
		}
		else if(!empty($search_txt) && empty($code_id))
		{
			$filter 		= " AND cd_title LIKE '%".$search_txt."%' ";
			$total_count	= $this->about_case_api_model->get_case_total_rows($filter);
			$case_result	= $this->about_case_api_model->get_case_list($dataStart, $dataLen, $filter);			
		}
		else
		{
			$total_count	= $this->about_case_api_model->get_case_total_rows($filter);
			$case_result	= $this->about_case_api_model->get_case_list($dataStart, $dataLen, $filter);
		}

		if($case_result)
		{
			$result["status"]		= 1;
			$result["total_count"]	= $total_count;
			foreach ($case_result as $key => $row) 
			{
				if($row["board"] == "518case")
				{
					$case_result[$key]["board"] = "518外包網";
				}
			}
			$result["case_result"]	= $case_result;
		}
		else
		{
			$result["status"]		= -1;
			$result["case_result"]	= array();
			$result["msg"]			= "讀取失敗";
		}

		$var["json_data"]	 = $result;

		$this->load->view('api/api_view', $var);
		return;
	}

	function get_case_detail($cd_id=NULL)
	{
		if($cd_id !== NULL)
		{
			$case_detail = $this->about_case_api_model->get_case_detail($cd_id);

			if($case_detail)
			{
				$result["status"]	= 1;
				$result["case_detail"]	= $case_detail;
			}
			else
			{
				$result["status"]		= -1;
				$result["case_result"]	= array();
				$result["msg"]			= "讀取失敗";
			}
		}
		else
		{
			$result["status"]		= -1;
			$result["msg"]			= "缺少參數";			
		}

		$var["json_data"]	= $result;

		$this->load->view('api/api_view', $var);
		return;		
	}	
}