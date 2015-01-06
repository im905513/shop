<?php
class About_user extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        define('FUELIFY', FALSE);
		$this->load->model('about_user_model');
		$this->load->library('set_meta');
		$this->load->library('pagination');
		$this->load->library('set_page');
        $this->load->library('comm');
		$this->load->module_library(FUEL_FOLDER, 'fuel_auth');
		$this->load->module_model(MEMBER_FOLDER, 'member_manage_model');
		$this->load->helper('ajax');
	}


	function fb_login()
	{	
        $fbid = NULL;
        if($this->input->post('fbid') && $this->input->post('signed_request'))
        {
            $fbid = $this->input->post('fbid');

            /*
				加強登入機制安全性
            */

            $signed_request = $this->input->post('signed_request');
	        list($encoded_sig, $payload) = explode('.', $signed_request, 2); 

	        // decode the data
	        $expected_sig = hash_hmac('sha256', $payload, FB_APP_SECRET, $raw = true);

	        $sig = $this->base64_url_decode($encoded_sig);

            if($sig !== $expected_sig)
            {
            	$fbid = NULL;
            	$result['status'] = -99;
            	$result['message'] = "Promession Deny";
            }
        }

        if($fbid != NULL)
        {
        	$result['fbid'] = $fbid;
        	$basic_info = $this->about_user_model->get_user_basic_info_by_fbid($fbid);

			$this->load->helper('convert');
			$this->load->helper('cookie');
			
        	if($basic_info != null)
        	{
				$valid_user = $this->member_manage_model->valid_user_by_fbid($fbid);
				if (!empty($valid_user)) 
				{
					$this->fuel_auth->set_valid_user_fb($valid_user);
					// reset failed login attempts
					// set the cookie for viewing the live site with added FUEL capabilities
					$config = array(
						'name' => $this->fuel->auth->get_fuel_trigger_cookie_name(), 
						'value' => serialize(array('id' => $this->fuel->auth->user_data('id'), 'language' => $this->fuel->auth->user_data('language'))),
						'expire' => 3600,
						//'path' => WEB_PATH
						'path' => $this->fuel->config('fuel_cookie_path')
					);
					set_cookie($config);

                    if(empty($basic_info->cli_mobile))
                    {
                        $result['cli_mobile'] = -1;
                    }
                    else
                    {
                        $result['cli_mobile'] = $basic_info->cli_mobile;
                    }

					$result['status'] = 1;
					$result['user_data'] = $this->fuel->auth->user_data('id');
				}
				else
				{
					$result['status'] = -1;
				}
        	}
        	else
        	{
			    $result['status'] = -3;
			    $result['fbid'] = $fbid;
			    $result['signed_request'] = $this->input->post('signed_request');
			    $result['message'] = 'FB ID Not Exist';
        	}
        }
        else
        {
        	$result['status'] = -99;
        	$result['message'] = "Promession Deny";
        }

        if(is_ajax())
        {
        	echo json_encode($result);
        }
        else
        {
        	show_404();
        }
	}

    function base64_url_decode($input) 
    {
      return base64_decode(strtr($input, '-_', '+/'));
    }

    function fb_reg()
    {
    	$cli_fbid = $this->input->get_post("fbid");
    	$cli_email = $this->input->get_post("cli_email");
    	$cli_title = $this->input->get_post("cli_title");

    	if($cli_fbid)
    	{
    		$success = $this->about_user_model->insert_fb_user_data($cli_fbid, $cli_email, $cli_title);

    		if($success)
    		{
    			$valid_user = $this->about_user_model->valid_user_by_fbid($cli_fbid);
    			if(!empty($valid_user))
    			{
					$this->fuel_auth->set_valid_user_fb($valid_user);
					// reset failed login attempts
					// set the cookie for viewing the live site with added FUEL capabilities
					$config = array(
						'name' => $this->fuel->auth->get_fuel_trigger_cookie_name(), 
						'value' => serialize(array('id' => $this->fuel->auth->user_data('id'), 'language' => $this->fuel->auth->user_data('language'))),
						'expire' => 3600,
						//'path' => WEB_PATH
						'path' => $this->fuel->config('fuel_cookie_path')
					);
					set_cookie($config);

					$result['status'] = 1;
                    $result['msg']    = '註冊成功';
    			}
    			else
    			{
    				$result['status'] = -1;
                    $result['msg']    = '查無您的資料';
    			}
    		}
    		else
    		{
    			$result['status'] = -1;
                $result['msg']    = '註冊失敗';
    		}
    	}
    	else
    	{
    		$result['status']     = -1;
            $result['msg']        = '沒有您的facebok ID';
    	}

    	if(is_ajax())
    	{
    		echo json_encode($result);
    	}
    	else
    	{
    		show_404();
    	}
    }

    function update_cli_email_mobile()
    {
        $is_logined = $this->fuel_auth->is_logged_in();
        if($is_logined)
        {
            $user = $this->fuel_auth->valid_user();

            $cli_email = $this->input->get_post("cli_email");
            $cli_mobile = $this->input->get_post("cli_mobile");

            if($cli_email && $cli_mobile)
            {
                $success = $this->about_user_model->do_update_cli_email_mobile($cli_email, $cli_mobile, $user['id']);

                if($success)
                {
                    $result['status'] = 1;
                }
                else
                {
                    $result['status']   = -1;
                    $result['msg']      = "更新失敗";
                }
            }
            else
            {
                $result['status']   = -1;
                $result['msg']      = "資料未完全";
            }
        }
        else
        {
            $result['status']   = -99;
            $result['msg']      = "您沒有權限";
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

    function logout()
    {
        $this->fuel_auth->logout();

        redirect(site_url());
    }

    function user_login()
    {
        $this->set_meta->set_meta_data();
        $is_logined = $this->fuel_auth->is_logged_in();
        fuel_set_var('page_id', "6");
        if($is_logined)
        {
            redirect(site_url());
        }
        else
        {
            $vars['views'] = 'login_view';
            $vars['base_url'] = base_url();
            
            $this->fuel->pages->render('login_view', $vars);              
        }
    }

    function member_center()
    {
        $this->set_meta->set_meta_data();
        $is_logined = $this->fuel_auth->is_logged_in();
        fuel_set_var('page_id', "7");
        if($is_logined)
        {
            $user = $this->fuel_auth->valid_user();

            $cli_result = $this->about_user_model->get_user_all_info_by_id($user['id']);
            $cli_role = $this->about_user_model->get_code_by_codkind_key("cli_role");
            $unread_cnt = $this->about_user_model->get_unread_reply_cnt($user['id']);

            $vars['views']          = "member_center_view";
            $vars['upload_path']    = base_url().'assets/uploads/client/';
            $vars['cli_result']     = $cli_result;
            $vars['cli_role']       = $cli_role;
            $vars['unread_cnt']     = $unread_cnt;

            $this->fuel->pages->render("member_center_view", $vars);
        }
        else
        {
            $this->comm->plu_redirect(base_url()."login", 0, "請登入");
        }

        return;
    }

    function member_reply_center($dataStart=0)
    {
        $this->set_meta->set_meta_data();
        $is_logined = $this->fuel_auth->is_logged_in();
        fuel_set_var('page_id', "7");
        if($is_logined)
        {
            $user = $this->fuel_auth->valid_user();

            $target_url = base_url().'member/reply/';
            $total_rows = $this->about_user_model->get_reply_total_rows($user['id']);
            $config = $this->set_page->set_config($target_url, $total_rows, $dataStart, 20);
            $dataLen = $config['per_page'];
            $this->pagination->initialize($config);

            $cli_result = $this->about_user_model->get_user_all_info_by_id($user['id']);
            $unread_cnt = $this->about_user_model->get_unread_reply_cnt($user['id']);
            $reply_list = $this->about_user_model->get_reply_list_by_user($user['id'], $dataStart, $dataLen);
            
            $vars['views']          = "member_reply_center_view";
            $vars['unread_cnt']     = $unread_cnt;
            $vars['reply_list']     = $reply_list;
            $vars['upload_path']    = base_url().'assets/uploads/client/';
            $vars['cli_result']     = $cli_result;
            $vars['page_jump'] = $this->pagination->create_links();

            $this->fuel->pages->render("member_reply_center_view", $vars);
        }
        else
        {
            $this->comm->plu_redirect(base_url()."login", 0, "請登入");
        }

        return;
    }

    function member_reply_detail($cml_id)
    {
        $this->set_meta->set_meta_data();
        $is_logined = $this->fuel_auth->is_logged_in();
        fuel_set_var('page_id', "7");
        if($is_logined)
        {
            $user = $this->fuel_auth->valid_user();

            $cli_result     = $this->about_user_model->get_user_all_info_by_id($user['id']);
            $reply_detail   = $this->about_user_model->get_reply_content($user['id'], $cml_id);

            if(isset($reply_detail))
            {
                $this->about_user_model->set_reply_read($cml_id);
            }
            else
            {
                show_404();
                die();
            }
            $unread_cnt     = $this->about_user_model->get_unread_reply_cnt($user['id']);
            
            $vars['views']          = "member_reply_detail_view";
            $vars['unread_cnt']     = $unread_cnt;
            $vars['reply_detail']   = $reply_detail;
            $vars['upload_path']    = base_url().'assets/uploads/client/';
            $vars['cli_result']     = $cli_result;

            $this->fuel->pages->render("member_reply_detail_view", $vars);
        }
        else
        {
            $this->comm->plu_redirect(base_url()."login", 0, "請登入");
        }

        return;        
    }

    function member_update()
    {
        $is_logined = $this->fuel_auth->is_logged_in();

        if($is_logined)
        {
            $user = $this->fuel_auth->valid_user();
            $update_data['cli_title']       = $this->input->get_post('cli_title');
            $update_data['cli_email']       = $this->input->get_post('cli_email');
            $update_data['cli_mobile']      = $this->input->get_post('cli_mobile');
            $update_data['cli_kind']        = $this->input->get_post('cli_kind');
            $update_data['cli_intro1']      = htmlspecialchars($this->input->get_post('cli_intro1'), ENT_QUOTES);
            $update_data['cli_intro2']      = htmlspecialchars($this->input->get_post('cli_intro2'), ENT_QUOTES);
            $update_data['cli_intro3']      = htmlspecialchars($this->input->get_post('cli_intro3'), ENT_QUOTES);
            $update_data['agree_edm']       = $this->input->get_post('agree_edm');

            if(!empty($update_data['cli_title']) && !empty($update_data['cli_mobile']) && !empty($update_data['cli_email']))
            {
                if(strlen($update_data['cli_intro2']) > 0)
                {
                    $num = strlen($update_data['cli_intro2']);
                    if($num < 100)
                    {
                        $this->comm->plu_redirect(base_url()."member", 0, "自介2的文字至少五十個字");
                        die();
                    }
                }

                if(strlen($update_data['cli_intro3']) > 0)
                {
                    $num = strlen($update_data['cli_intro3']);
                    if($num < 100)
                    {
                        $this->comm->plu_redirect(base_url()."member", 0, "自介3的文字至少五十個字");
                        die();
                    }
                }

                $success = $this->about_user_model->do_update_cli($update_data, $user['id']);

                if($success)
                {
                    $this->comm->plu_redirect(base_url()."member", 0, "更新成功");
                }
                else
                {
                    $this->comm->plu_redirect(base_url()."member", 0, "更新失敗");
                }
            }
            else
            {
                $this->comm->plu_redirect(base_url()."member", 0, "請確認名稱、手機、email是否有填");
                die();
            }
        }
        else
        {
            $this->comm->plu_redirect(base_url()."login", 0, "請登入");
        }

        return;
    }

    function upload_files()
    {
        $this->load->library('upload');
        $base_url = base_url();
        $is_logined = $this->fuel_auth->is_logged_in();

        if($is_logined)
        {
            $files = $_FILES;

            $user = $this->fuel_auth->valid_user();

            $response = array();

            $rand_num= mt_rand();

            $name = "cli_".$user['id']."_".$rand_num.substr($files["pic"]["name"], strpos($files["pic"]["name"], "."));

            $_FILES['pic']['name']=  $name;
            $_FILES['pic']['type']= $files['pic']['type'];
            $_FILES['pic']['tmp_name']= $files['pic']['tmp_name'];
            $_FILES['pic']['error']= $files['pic']['error'];
            $_FILES['pic']['size']= $files['pic']['size'];    

            $this->upload->initialize($this->set_upload_options());

            if (!$this->upload->do_upload('pic')) 
            {
                $error = array('error' => $this->upload->display_errors());
                $response['stats'] = -1;
                $response['msg'] = "上傳失敗";
                $response['error'] = $error;
            } 
            else 
            {
                $success = $this->about_user_model->update_cli_logo($name, $user['id']);

                if($success)
                {
                    $response['status'] = 1;
                    $response['imgData']['name'] = $name;
                    $response['imgData']['logo_url'] = $base_url."assets/uploads/client/".$name;
                }
                else
                {
                    $response['stats'] = -1;
                    $response['msg'] = "更新失敗";
                }
                
            }       
        }

        if(is_ajax())
        {
            echo json_encode($response);
        }
        else
        {
            show_404();
        }

        
    }

    private function set_upload_options()
    {   
        //  upload an image options
        $config = array();
        $config['upload_path'] = assets_server_path('uploads/client/');
        $config['allowed_types'] = 'jpg|jpeg|png|JPG|JPEG';
        $config['max_size']      = '50000';
        $config['overwrite']     = FALSE;

        return $config;
    }

    public function get_unread_msg_cnt()
    {
        $is_logined = $this->fuel_auth->is_logged_in();
        if($is_logined)
        {
            $user = $this->fuel_auth->valid_user();
            $msg_cnt = $this->about_user_model->get_unread_reply_cnt($user['id']);

            $result['status']   = 1;
            $result['msgCnt']   = $msg_cnt;
            $result['msg']      = "成功";
        }
        else
        {
            $result['status']   = -99;
            $result['msg']      = "您沒有權限";
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
	
}