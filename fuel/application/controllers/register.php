<?php
class Register extends CI_Controller {

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

	function index()
	{	
		$this->load->helper('cookie');
		$this->load->library('facebook'); 
		$this->set_meta->set_meta_data();
		fuel_set_var('page_id', "1");
		$all_cate = array();

		$this->load->model('code_model');





		$fb_data	= $this->code_model->get_fb_data();
		$vars['fb_data'] = $fb_data;

		// use Fuel_page to render so it will grab all opt-in variables and do any necessary parsing
		
		$vars['all_cate']	= $all_cate;
		$vars['base_url'] = base_url();

		$vars['views'] = 'm_register1';
		$page_init = array('location' => 'm_register1');
		$this->fuel->pages->render('m_register1', $vars);

	}

	function step1_save(){
		$this->load->helper('cookie');
		$this->input->set_cookie("ytalent_account","", time()-3600);
		$mail = $this->input->get_post("mail");
		$password = $this->input->get_post("password");
		$this->load->model('code_model');
		$result = $this->code_model->do_register_resume($mail,$password);

		if($result){
			
			$this->input->set_cookie("ytalent_account",$mail, time()+3600);
			$this->comm->plu_redirect(site_url()."register/step2?account=$mail&token=".md5(md5($mail)), 0, null);
		}else{
			$this->comm->plu_redirect(site_url(), 0, "此帳號已被註冊");
		}

		
	}

	function step2()
	{	
		$this->load->model('code_model');
		$this->load->helper('cookie');
		$this->set_meta->set_meta_data();
		fuel_set_var('page_id', "1");
		$all_cate = array();

		$school_list = $this->code_model->get_school_list();
		$skill_list = $this->code_model->get_skill();

		$recommended_id = $this->input->cookie("ytalent_recommended_id");

		$vars['school_list']	= $school_list;
		$vars['skill_list']	= $skill_list;
		$vars['recommended_id']	= $recommended_id;
		$vars['account'] = $this->input->get("account");
		$vars['token'] = $this->input->get("token");
		$vars['post'] = "";


		if($this->code_model->is_mobile()){
			$vars['views'] = 'm_register2';
			$page_init = array('location' => 'm_register2');
			$this->fuel->pages->render('m_register2', $vars);
		}else{
			$vars['views'] = 'register2';
			$page_init = array('location' => 'register2');
			$this->fuel->pages->render('register2', $vars);
		}

	}
	function step2_save(){
		
		$post_arr = $this->input->post();
		  
		$this->load->model('code_model');
		
		$this->set_meta->set_meta_data();
		fuel_set_var('page_id', "1");
		$all_cate = array();

		if(md5(md5($post_arr['account'])) == $post_arr['token']){
			$result = $this->code_model->do_update_resume($post_arr);
			if($result){
				$this->comm->plu_redirect(site_url()."register/step3?account=".$post_arr['account']."&token=".md5(md5($post_arr['account'])), 0, null);
			}else{
				$this->comm->plu_redirect(site_url(), 0, "更新失敗");
			}
		}else{
			$this->comm->plu_redirect(site_url(), 0, "非法進入頁面");
		}

		
	}
	function step3()
	{	
		$this->load->model('code_model');
		
		$this->set_meta->set_meta_data();
		fuel_set_var('page_id', "1");
		$all_cate = array();
		$vars['views'] = 'register3';
		$vars['account'] = $this->input->get("account");
		$vars['token'] = $this->input->get("token");
		$page_init = array('location' => 'home');
		$this->fuel->pages->render('register3', $vars);

		if($this->code_model->is_mobile()){
			$vars['views'] = 'm_register3';
			$page_init = array('location' => 'm_register3');
			$this->fuel->pages->render('m_register3', $vars);
		}else{
			$vars['views'] = 'register3';
			$page_init = array('location' => 'register3');
			$this->fuel->pages->render('register3', $vars);
		}
	}

	function getSchool()
	{
		$this->load->model('code_model');
		$response = $this->code_model->get_school();

		$ary = array();

		foreach ($response as $key) {
			 array_push($ary, $key->code_name);
		}
		 
		echo json_encode($ary);
	} 
	
}