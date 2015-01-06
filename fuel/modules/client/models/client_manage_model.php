<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Client_manage_model extends MY_Model {
	
	function __construct()
	{
		$CI =& get_instance();
		$CI->config->module_load(CLIENT_FOLDER, CLIENT_FOLDER);
		$tables = $CI->config->item('tables');
		parent::__construct($tables['mod_client']); // table name
	}

	public function get_total_rows($filter="")
	{
		$sql = @"SELECT COUNT(*) AS total_rows FROM mod_client ".$filter." ORDER BY modi_time DESC";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			return $row->total_rows;
		}

		return 0;
	}

	public function get_client_list($dataStart, $dataLen, $filter)
	{
		$sql = @"SELECT * FROM mod_client".$filter." ORDER BY modi_time DESC LIMIT $dataStart, $dataLen";

		// echo $sql;
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;
	}

	public function get_client_detail($cli_id)
	{
		$sql = @"SELECT * FROM mod_client WHERE cli_id=?";
		$para = array($cli_id);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			$result = $query->row();

			return $result;
		}

		return;
	}

	public function get_client_detail_row($cli_id)
	{
		$sql = @"SELECT * FROM mod_client WHERE cli_id=?";
		$para = array($cli_id);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			return $row;
		}

		return;
	}

	public function do_add_client($cli_title, $cli_email, $cli_fbid, $cli_logo	,
								  $cli_mobile, $cli_phone_day, $cli_phone_night, $cli_kind, $cli_regi_kind
								  , $cli_skills, $cli_tools, $cli_live_city, $is_index,$cli_intro1,$cli_intro2,$cli_intro3)
	{
		$sql = @"INSERT INTO mod_client (cli_title, 
										cli_email, 
										cli_fbid, 
										cli_logo,
										cli_intro1,
										cli_intro2,
										cli_intro3,
										cli_mobile, 
										cli_phone_day, 
										cli_phone_night, 
										cli_kind, 
										cli_regi_kind, 
										cli_skills, 
										cli_tools, 
										cli_live_city, 
										is_index,  
										create_time,
										modi_time
										) 
							VALUES (?, ?, ?, ?, ?, ?,?,? ?,?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
		$para = array(
						$cli_title, 
						$cli_email,
						$cli_fbid,
						$cli_logo,
						$cli_intro1,
						$cli_intro2,
						$cli_intro3,
						$cli_mobile, 
						$cli_phone_day,						
						$cli_phone_night, 
						$cli_kind, 
						$cli_regi_kind, 
						$cli_skills, 
						$cli_tools, 
						$cli_live_city, 
						$is_index
					);
		$success = $this->db->query($sql, $para);

		if($success)
		{
			$cli_id = $this->db->insert_id();

			return $cli_id;
		}

		return;
	}

	public function do_edit_client($cli_id,$cli_title, $cli_email, $cli_fbid, $cli_logo	,
								  $cli_mobile, $cli_phone_day, $cli_phone_night, $cli_kind, $cli_regi_kind
								  , $cli_skills, $cli_tools, $cli_live_city, $is_index,$cli_intro1,$cli_intro2,$cli_intro3)
	{
		$sql = @"UPDATE mod_client SET cli_title=?,cli_email=?,cli_fbid=?,cli_logo=?, 
			 cli_mobile=?,cli_phone_day=?,cli_phone_night=?,cli_kind=?,cli_regi_kind=?,
		     cli_skills=?,cli_tools=?,cli_live_city=?, is_index=?, modi_time=NOW() ,
		     cli_intro1=?,cli_intro2=?,cli_intro3=? WHERE cli_id=?";

		$para = array($cli_title, $cli_email, $cli_fbid, $cli_logo	,
					  $cli_mobile, $cli_phone_day, $cli_phone_night, $cli_kind, $cli_regi_kind
					  , $cli_skills, $cli_tools, $cli_live_city, $is_index,$cli_intro1,$cli_intro2,$cli_intro3,$cli_id);
		$success = $this->db->query($sql, $para);

		return $success;
	}

	public function do_del_client($cli_id)
	{
		$sql = @"DELETE FROM  mod_client WHERE cli_id=?";

		$para = array($cli_id);
		$success = $this->db->query($sql, $para);

		return $success;
	}

	public function do_multi_del_client($cli_ids)
	{
		$sql = @"DELETE FROM  mod_client WHERE cli_id in (?) ";

		$para = array($cli_ids);
		$success = $this->db->query($sql, $para);

		return $success;
	}

	  

	public function valid_user($cli_id)
	{
		$sql = @"SELECT cli_id, cli_title FROM mod_client WHERE cli_id=? ";
		$para = array($cli_id);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			return $query->row();
		}

		return;
	}
	
}