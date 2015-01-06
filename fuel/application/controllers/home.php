<?php
class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		define('FUELIFY', FALSE);
		$this->load->library('set_meta');
		$this->load->library('comm');
	}

	function home() 
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
		if($this->code_model->is_mobile()){
			$vars['views'] = 'm_home';
			$page_init = array('location' => 'm_home');
			$this->fuel->pages->render('m_home', $vars);
		}else{
			$vars['views'] = 'home';
			$page_init = array('location' => 'home');
			$this->fuel->pages->render('home', $vars);
		}
	}
	function login()
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
		if($this->code_model->is_mobile()){
			$vars['views'] = 'm_login';
			$page_init = array('location' => 'm_login');
			$this->fuel->pages->render('m_login', $vars);
		}else{
			$vars['views'] = 'login';
			$page_init = array('location' => 'login');
			$this->fuel->pages->render('login', $vars);
		}
	}
	function contact()
	{	
		//$this->load->model('about_case_model');
		$this->set_meta->set_meta_data();
		fuel_set_var('page_id', "1");

		$this->load->model('code_model');
		$fb_data	= $this->code_model->get_fb_data();
		$vars['fb_data'] = $fb_data;

		$skill_list = $this->code_model->get_user_not_skill("");
		
	
		$vars['skill_list']	= $skill_list;

		$vars['views'] = 'contact';
		$vars['base_url'] = base_url();
		$page_init = array('location' => 'home');
		$this->fuel->pages->render('contact', $vars);
	}
	function do_contact(){
		$this->load->model('code_model');
		$post_arr = $this->input->post();
		$this->set_meta->set_meta_data();
		$result = $this->code_model->do_contact($post_arr);
		$result = $this->code_model->send_mail_by_id("5","YTalent@pplesearch.com");
		$result = $this->code_model->send_mail_by_id("5","judyliu@pplesearch.com");
		$result = $this->code_model->send_mail_by_id("5","chiaoyu@pplesearch.com");
		//$result = $this->code_model->send_mail_by_id("5","kingwang317@gmail.com");
		//$result = $this->code_model->send_mail_by_id("5","kingwang317@yahoo.com.tw");

		if($result){
			$this->comm->plu_redirect(site_url(), 0, "已收到您的聯絡資訊，我們將儘快為您處理");
		}else{
			$this->comm->plu_redirect(site_url(), 0, "失敗");
		}
	}
	function campusevents()
	{	
		//$this->load->model('about_case_model');
		$this->set_meta->set_meta_data();
		fuel_set_var('page_id', "1");

		$this->load->model('code_model');

		

		$fb_data	= $this->code_model->get_fb_data();
		$vars['fb_data'] = $fb_data;

		$vars['views'] = 'campusevents';
		$vars['base_url'] = base_url();
		$page_init = array('location' => 'home');
		$this->fuel->pages->render('campusevents', $vars);

	}
	function terms()
	{	
		//$this->load->model('about_case_model');
		$this->set_meta->set_meta_data();
		fuel_set_var('page_id', "1");

		$this->load->model('code_model');
		$fb_data	= $this->code_model->get_fb_data();
		$vars['fb_data'] = $fb_data;
		$vars['base_url'] = base_url();


		if($this->code_model->is_mobile()){
			$vars['views'] = 'm_terms';
			$page_init = array('location' => 'm_terms');
			$this->fuel->pages->render('m_terms', $vars);
		}else{
			$vars['views'] = 'terms';
			$page_init = array('location' => 'terms');
			$this->fuel->pages->render('terms', $vars);
		}

	}

		function aboutus()
	{	
		//$this->load->model('about_case_model');
		$this->set_meta->set_meta_data();
		fuel_set_var('page_id', "1");

		$this->load->model('code_model');
		$fb_data	= $this->code_model->get_fb_data();
		$vars['fb_data'] = $fb_data;

		$vars['views'] = 'aboutus';
		$vars['base_url'] = base_url();
		$page_init = array('location' => 'home');
		$this->fuel->pages->render('aboutus', $vars);


		if($this->code_model->is_mobile()){
			$vars['views'] = 'm_aboutus';
			$page_init = array('location' => 'm_aboutus');
			$this->fuel->pages->render('m_aboutus', $vars);
		}else{
			$vars['views'] = 'aboutus';
			$page_init = array('location' => 'aboutus');
			$this->fuel->pages->render('aboutus', $vars);
		}

	}
}