<?php
class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		define('FUELIFY', FALSE);
		$this->load->library('set_meta');
		$this->load->library('comm');
	}

	function user() 
	{
		parent::Controller();

	}

	function index()
	{	
		$this->load->model('about_case_model');
		$this->url_checker();
		$this->set_meta->set_meta_data();
		fuel_set_var('page_id', "1");
		$all_cate = array();

		$case_cate	= $this->about_case_model->get_case_cate_code();

		if(isset($case_cate))
		{
			foreach ($case_cate as $key => $row) 
			{
				$sub_cate_result = $this->about_case_model->get_case_sub_cate($row->code_id);

				$all_cate[$key]['parent_cate'] 		= $row;
				$all_cate[$key]['sub_cate_result']	= $sub_cate_result;
			}
		}
		$vars['views'] = 'home';
		$vars['all_cate']	= $all_cate;
		$vars['base_url'] = base_url();
		$page_init = array('location' => 'home');
		$this->fuel->pages->render('home', $vars);
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

	function myinfo()
	{	
		$this->load->model('code_model');
		
		$this->set_meta->set_meta_data();
		fuel_set_var('page_id', "1");
		$all_cate = array();

		$account = $this->code_model->get_logged_in_account();

		if($account == null){
			$this->comm->plu_redirect(site_url(), 0, "尚未登入");
		}

		$account_data = $this->code_model->get_account_data($account);
		$vars['views'] = 'myinfo';
		$vars['account'] = $account;
		$vars['data'] = $account_data;
		$page_init = array('location' => 'home');
		$this->fuel->pages->render('myinfo', $vars);
	
	}

	function do_connect_fb2account(){
		$this->load->model('code_model');
		$account = $this->code_model->get_logged_in_account();

		$data = $this->code_model->get_fb_data();


		if(isset($data['user_profile'])){
			$result = $this->code_model->do_update_fbid2resume($account,$data['user_profile']['id']);
			$this->comm->plu_redirect(site_url()."user/editinfo", 0, "FACEBOOK連接成功");

		}else{
			$this->comm->plu_redirect(site_url(), 0, "FACEBOOK連接失敗");
		}


	}
	function editinfo()
	{	

		//ALTER TABLE  `mod_resume` ADD  `find_job_kind` INT( 10 ) NULL
		$this->load->model('code_model');
		$this->load->helper('cookie');
		$this->set_meta->set_meta_data();
		fuel_set_var('page_id', "1");
		$all_cate = array();

		$account = $this->code_model->get_logged_in_account();
		$recommended_id = $this->input->cookie("ytalent_recommended_id");

		if($account == null){
			$this->comm->plu_redirect(site_url(), 0, "尚未登入");
		}

		$account_data = $this->code_model->get_account_data($account);
		$skill_list = $this->code_model->get_user_not_skill($account);
		$user_skill_list = $this->code_model->get_skill_list(" WHERE account = '$account' ");


		$fb_data	= $this->code_model->get_fb_data("user/do_connect_fb2account");
		$vars['fb_data'] = $fb_data;
	
		$vars['skill_list']	= $skill_list;
		$vars['user_skill_list']	= $user_skill_list;
		$vars['views'] = 'editinfo';
		$vars['recommended_id'] = $recommended_id;
		$vars['account'] = $account;
		$vars['account'] = $this->input->get("account");
		$vars['token'] = $this->input->get("token");
		$vars['data'] = $account_data;
		$page_init = array('location' => 'home');
		$this->fuel->pages->render('editinfo', $vars);
	
	}
	function do_edit(){
		
		$post_arr = $this->input->post();
		$config['upload_path'] = assets_server_path('avatar/');
		$config['allowed_types'] = 'png';
		$config['max_size']	= '9999';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload',$config);

		$files = $_FILES;

	 	$name = $post_arr['account'].".png";

        $_FILES['pic']['name']=  $name;
        $_FILES['pic']['type']= $files['avatar']['type'];
        $_FILES['pic']['tmp_name']= $files['avatar']['tmp_name'];
        $_FILES['pic']['error']= $files['avatar']['error'];
        $_FILES['pic']['size']= $files['avatar']['size'];    
        $msg = null;
		if (!$this->upload->do_upload('pic') && $_FILES['pic']['size'] != 0)
		{
			$msg = "頭像圖片更新失敗，限制140x140以內，PNG的圖片";
		}
		else
		{
			$data = array('upload_data'=>$this->upload->data());
			$post_arr["avatar"] = $data["upload_data"]["file_name"];
		}
		$this->load->model('code_model');
		
		$this->set_meta->set_meta_data();
		fuel_set_var('page_id', "1");
		$all_cate = array();
		$result = $this->code_model->do_update_resume($post_arr);
		if($result){
			$this->comm->plu_redirect(site_url()."user/myinfo?account=".$post_arr['account'], 0, $msg);
		}else{
			$this->comm->plu_redirect(site_url(), 0, "更新失敗");
		}
		
	}
 	function logout()
    {
       // $this->fuel_auth->logout();
$this->load->helper('cookie');
        delete_cookie("ytalent_account");

        redirect(site_url());
    }

    function do_login()
    {
    	$this->load->helper('cookie');
        $this->set_meta->set_meta_data();
		$this->load->model('code_model');
        $account = $this->input->post("login_mail");
        $password = $this->input->post("login_password");

        $is_logined = $this->code_model->is_account_logged_in($account);
       
        if($is_logined)
        {
            redirect(site_url()."user/myinfo");
        }
        else
        {
            $login_result = $this->code_model->do_logged_in($account,$password);   
            
            if($login_result){
				$this->input->set_cookie("ytalent_account",$account, 3600);

            	$this->comm->plu_redirect(site_url()."user/myinfo", 0, "登入成功");
            }else{

            	$this->comm->plu_redirect(site_url(), 0, "登入失敗");
            }
			
			    
        }
    }
    public function do_fb_regi(){
    	$this->load->helper('cookie');
		$this->load->model('code_model');

		$data = $this->code_model->get_fb_data();


		if(isset($data['user_profile'])){

			$this->input->set_cookie("ytalent_account","", time()-3600);
			$mail = $data['user_profile']['id'];
			$password = $data['user_profile']['id'];
			$name = "";
			$fb_email = "";
			if(isset($data['user_profile']['name'])){
				$name = $data['user_profile']['name'];
			}
			if(isset($data['user_profile']['email'])){
				$fb_email = $data['user_profile']['email'];
			}



			$result = $this->code_model->do_register_resume($mail,$password,$name,$fb_email,$data['user_profile']['id']);
			$this->input->set_cookie("ytalent_account",$mail, time()+3600);
			$this->input->set_cookie("ytalent_fb_logout_url",$data['logout_url'], time()+3600);

			$this->comm->plu_redirect(site_url()."user/editinfo?account=".$mail, 0, "FACEBOOK登入成功");

		}else{
			$this->comm->plu_redirect(site_url(), 0, "FACEBOOK登入失敗");
		}
	}
	function step3()
	{	
		$this->load->model('code_model');
		$this->url_checker();
		$this->set_meta->set_meta_data();
		fuel_set_var('page_id', "1");
		$all_cate = array();
		$vars['views'] = 'register3';
		$vars['account'] = $this->input->get("account");
		$vars['token'] = $this->input->get("token");
		$page_init = array('location' => 'home');
		$this->fuel->pages->render('register3', $vars);
	}
	
}