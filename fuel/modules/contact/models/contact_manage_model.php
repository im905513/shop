<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contact_manage_model extends MY_Model {
	
	function __construct()
	{
		$CI =& get_instance();
		$CI->config->module_load(CONTACT_FOLDER, CONTACT_FOLDER);
		$tables = $CI->config->item('tables');
		parent::__construct($tables['mod_contact']); // table name
	}

	public function get_total_rows($filter="")
	{
		$sql = @"SELECT COUNT(*) AS total_rows FROM mod_contact $filter ";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			return $row->total_rows;
		}

		return 0;
	}

	public function get_contact_list($dataStart, $dataLen, $filter)
	{
		$sql = @"SELECT * FROM mod_contact $filter ORDER BY id DESC LIMIT $dataStart, $dataLen";
	
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;
	}

	public function get_contact_detail($id )
	{
		$sql = @"SELECT * FROM mod_contact where id = '$id' ";
	
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			return $row;
		}

		return;
	}

	public function get_job_detail($contact_id )
	{
		$sql = @"SELECT * FROM mod_job where contact_id = '$contact_id' ";
	
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			return $row;
		}

		return;
	}

	public function get_skill($job_id,$skill_type)
	{
		$sql = @"SELECT b.code_name FROM mod_skill a left join mod_code b on a.skill_id = b.code_id  where $job_id = ? and skill_type=? ";
		$para = array($job_id,$skill_type);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;
	} 

	public function do_multi_update_status($contact_status,$ids){
		$sql = @"UPDATE mod_contact SET contact_status = ? WHERE id in ($ids) ";

		$para = array($contact_status);
		$success = $this->db->query($sql,$para );

		return $success;
	}
	
}