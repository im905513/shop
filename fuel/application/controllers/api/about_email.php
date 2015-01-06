<?php
class About_email extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('api/about_email_model');
		$this->load->library('email');
		$this->load->helper('ajax');
	}


	function reply_case_help()
	{	
		$result = array();

			$cli_id			= $this->input->get_post("cli_id");
			$ch_id			= $this->input->get_post("ch_id");
			$to_email		= $this->input->get_post("to_email");
			$mail_content	= $this->input->get_post("mail_content");

			if(!empty($cli_id) && !empty($ch_id) && !empty($mail_content))
			{
				$this->email->from('service@9icase.com', '【9iCase】免費接外包網');
				$this->email->to($to_email); 

				$this->email->subject("協助提案回覆");
				$this->email->message(nl2br(htmlspecialchars_decode($mail_content)));

				if($this->email->send())
				{
					$this->about_email_model->do_add_log($ch_id,"協助提案回覆",$mail_content);
					$success = $this->about_email_model->set_ch_done($ch_id);

					if($success)
					{
						$result['status'] 	= 1;
						$result['msg']		= '成功';
					}
					else
					{
						$result['status'] 	= -1;
						$result['msg']		= '改變狀態失敗';
					}
					
				}
				else
				{
					$result['status'] 	= -1;
					$result['msg']		= $this->email->print_debugger();
				}		
			}
			else
			{
				$result['status'] 	= -1;
				$result['msg']		= '缺少參數';
			}

	

		echo json_encode($result);
		die();

	}
	
}