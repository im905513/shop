<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Set_meta {

	private $_ci;

    public function __construct()
    {
        // Do something with $params
        $this->_ci =& get_instance();
        $this->_ci->load->model('about_case_model');
        //$this->_ci->load->model('product_model');
        
    }

	public function set_meta_data($id="", $mod="")
	{
		switch ($mod) {
			case 'mod_product':
				//$meta_data = $this->_ci->product_model->get_pro_meta($id);
				break;
			case 'case':
				$meta_data = array();
				$case_detail = $this->_ci->about_case_model->get_case_detail($id);
				$meta_data['page_title'] 	= '9iCase免費接外包網-'.$case_detail->cd_title;
				$meta_data['meta_desc'] 	= $case_detail->cd_title.mb_substr($case_detail->cd_content,0,50,"UTF-8");
				$meta_data['meta_kw'] 		= $case_detail->cd_title.",免費接外包,外包";
				$meta_data['og_image'] 		= "assets/flat_img/9icase.png";
				break;
			case 'case_cate':
				$meta_data = array();
				$cate_title = $this->_ci->about_case_model->get_case_cate_title($id);
				$meta_data['page_title'] 	= $cate_title.'-9iCase免費接外包網';
				$meta_data['meta_desc'] 	= $cate_title."免費外包兼職,讓你免費接遍各大外包網,免費外包首選第一品牌";
				$meta_data['meta_kw'] 		= $cate_title.",免費接外包,外包";
				$meta_data['og_image'] 		= "assets/flat_img/9icase.png";
				break;			
			default:
				$meta_data = null;
				break;
		}

		if(isset($meta_data))
		{
			
			fuel_set_var('page_title', $meta_data['page_title']);
			fuel_set_var('meta_keywords', $meta_data['meta_kw']);
			fuel_set_var('meta_description', $meta_data['meta_desc']);
			fuel_set_var('og_title', $meta_data['page_title']);
			fuel_set_var('og_desc', $meta_data['meta_desc']);
			fuel_set_var('og_image', base_url().$meta_data['og_image']);

		}
		else
		{
			fuel_set_var('page_title', '9iCase免費接外包網-免費外包首選');
			fuel_set_var('meta_description', '最專業的外包粉絲團，你已經受夠了接案還要付錢嗎？9icase為您即時播報外包需求，外包網首選第一品牌9icase外包網');
			fuel_set_var('meta_keywords', "外包,網站外包,免費接外包");

			fuel_set_var('og_title', '9iCase免費接外包網');
			fuel_set_var('og_desc', '最專業的外包粉絲團，你已經受夠了接案還要付錢嗎？9icase為您即時播報外包需求，外包網首選第一品牌9icase外包網');
			fuel_set_var('og_image', base_url()."assets/flat_img/9icase.png");	
		}


	}

}
