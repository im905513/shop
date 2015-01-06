<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Com_manage_model extends MY_Model {
	
	function __construct()
	{
		$CI =& get_instance();
		$CI->config->module_load(COM_FOLDER, COM_FOLDER);
		$tables = $CI->config->item('tables');
		parent::__construct($tables['mod_company']); // table name
	}

	public function get_total_rows($filter="")
	{
		$sql = @"SELECT COUNT(*) AS total_rows FROM mod_company ".$filter;
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			return $row->total_rows;
		}

		return 0;
	}

	public function get_com_list($dataStart, $dataLen, $filter)
	{
		$sql = @"SELECT * FROM mod_company".$filter." ORDER BY modi_time DESC LIMIT $dataStart, $dataLen";

		// echo $sql;
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;
	}

	public function get_com_detail($com_id)
	{
		$sql = @"SELECT * FROM mod_company WHERE com_id=?";
		$para = array($com_id);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			$result = $query->row();

			return $result;
		}

		return;
	}

	public function get_com_detail_row($com_id)
	{
		$sql = @"SELECT * FROM mod_company WHERE com_id=?";
		$para = array($com_id);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			return $row;
		}

		return;
	}

	public function do_add_com($com_title, $com_email, $com_mobile	,$com_phone_day, $com_phone_night)
	{
		$sql = @"INSERT INTO mod_company (com_cli_id, 
										com_title, 
										com_email, 
										com_mobile,
										com_phone_day,
										com_phone_night,
										modi_time,
										create_time
										) 
							VALUES ('0', ?, ?, ?, ?, ?, NOW(), NOW())";
		$para = array(
						$com_title, 
						$com_email,
						$com_mobile,
						$com_phone_day,
						$com_phone_night
					);
		$success = $this->db->query($sql, $para);

		if($success)
		{
			$com_id = $this->db->insert_id();

			return $com_id;
		}

		return;
	}

	public function do_edit_com($com_id,$com_title, $com_email, $com_mobile	,$com_phone_day, $com_phone_night)
	{
		$sql = @"UPDATE mod_company SET com_title=?,com_email=?,com_mobile=?, 
			 com_phone_day=?,com_phone_night=?  WHERE com_id=?";

		$para = array($com_cli_id, $com_title, $com_email	,
					  $com_mobile, $com_phone_day, $com_phone_night,$com_id);
		$success = $this->db->query($sql, $para);

		return $success;
	}

	public function do_del_com($com_id)
	{
		$sql = @"DELETE FROM  mod_company WHERE com_id=?";

		$para = array($com_id);
		$success = $this->db->query($sql, $para);

		return $success;
	}

	public function do_multi_del_com($com_ids)
	{
		$sql = @"DELETE FROM  mod_company WHERE com_id in (?) ";

		$para = array($com_ids);
		$success = $this->db->query($sql, $para);

		return $success;
	}

	  

	public function valid_user($com_id)
	{
		$sql = @"SELECT com_id, com_title FROM mod_company WHERE com_id=? ";
		$para = array($com_id);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			return $query->row();
		}

		return;
	}
	
}