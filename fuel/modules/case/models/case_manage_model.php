<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Case_manage_model extends MY_Model {
	
	function __construct()
	{
		$CI =& get_instance();
		$CI->config->module_load(CASE_FOLDER, CASE_FOLDER);
		$tables = $CI->config->item('tables');
		parent::__construct($tables['data_case_detail']); // table name
	}

	public function get_total_rows($filter="")
	{
		$sql = @"SELECT COUNT(*) AS total_rows FROM data_case_detail ".$filter." ORDER BY run_date DESC";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			return $row->total_rows;
		}

		return 0;
	}

	public function get_case_list($dataStart, $dataLen, $filter)
	{
		$sql = @"SELECT * FROM data_case_detail".$filter." ORDER BY run_date DESC LIMIT $dataStart, $dataLen";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;
	}

	public function get_case_detail($cd_id)
	{
		$sql = @"SELECT * FROM data_case_detail WHERE cd_id=?";
		$para = array($cd_id);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			$result = $query->row();

			return $result;
		}

		return;
	}

	public function get_today_data_count($filter)
	{
		$sql = @"SELECT COUNT(*) AS total_rows FROM data_case_detail ".$filter." ORDER BY run_date DESC";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			return $row->total_rows;
		}

		return 0;
	}
	
}