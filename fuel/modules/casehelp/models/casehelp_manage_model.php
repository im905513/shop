<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Casehelp_manage_model extends MY_Model {
	
	function __construct()
	{
		$CI =& get_instance();
		$CI->config->module_load(CASEHELP_FOLDER, CASEHELP_FOLDER);
		$tables = $CI->config->item('tables');
		parent::__construct($tables['data_case_help']); // table name
	}

	public function get_total_rows($filter="")
	{
		$sql = @"SELECT COUNT(*) AS total_rows FROM data_case_help a left join data_case_detail b on a.cd_id = b.cd_id"
			   ." left join mod_client c on a.cli_id = c.cli_id WHERE 1=1 "
			   .$filter." ORDER BY a.modi_time DESC";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			return $row->total_rows;
		}

		return 0;
	}

	public function get_casehelp_detail($ch_id)
	{
		$sql = @" SELECT * FROM data_case_help WHERE ch_id=? ";
		$para = array($ch_id);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			$result = $query->row();

			return $result;
		}

		return;
	}

	public function get_client_detail($ch_id)
	{
		$sql = @"SELECT * FROM mod_client WHERE cli_id IN (SELECT cli_id FROM data_case_help WHERE ch_id=?)";
		$para = array($ch_id);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			$result = $query->row();

			return $result;
		}

		return;
	}

	public function do_add_log($ch_id, $cml_title, $cml_content)
	{
		$sql = @"INSERT INTO data_case_mail_log (ch_id, 
										cml_title, 
										cml_content, 
										modi_time 
										) 
							VALUES (?, ?, ?, NOW())";
		$para = array(
						$ch_id, 
						$cml_title,
						$cml_content 
					);
		$success = $this->db->query($sql, $para);

		if($success)
		{
			$cml_id = $this->db->insert_id();

			return $cml_id;
		}

		return;
	}

	public function get_casehelp_list_winform()
	{
		/*$sql = @"SELECT * FROM data_case_help a left join data_case_detail b on a.cd_id = b.cd_id"
			   ." left join mod_client c on a.cli_id = c.cli_id WHERE 1=1 "
			   .$filter." ORDER BY a.modi_time DESC LIMIT $dataStart, $dataLen";*/
		$sql = @"SELECT a.ch_id, a.case_url FROM data_case_help a  WHERE a.ch_done = 0";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;
	} 

	public function get_casehelp_list($dataStart, $dataLen, $filter)
	{
		/*$sql = @"SELECT * FROM data_case_help a left join data_case_detail b on a.cd_id = b.cd_id"
			   ." left join mod_client c on a.cli_id = c.cli_id WHERE 1=1 "
			   .$filter." ORDER BY a.modi_time DESC LIMIT $dataStart, $dataLen";*/
		$sql = @"SELECT a.ch_id, a.case_url, a.modi_time, a.ch_done_time, c.cli_id, c.cli_fbid, c.cli_title, c.cli_email, c.cli_mobile FROM data_case_help a, mod_client c WHERE a.cli_id=c.cli_id ".$filter." ORDER BY a.modi_time DESC LIMIT $dataStart, $dataLen";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;
	} 

	public function do_batch($ch_ids)
	{
		$sql = @"UPDATE data_case_help SET ch_done='1',ch_done_time=NOW() WHERE ch_id IN ($ch_ids)";
		$success = $this->db->query($sql);

		return $success;
	}

	public function get_today_data_count()
	{
		$sql = @"SELECT COUNT(*) AS total_rows FROM data_case_help WHERE DATE(NOW()) = DATE(`modi_time`) ";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			return $row->total_rows;
		}

		return 0;
	}

	public function get_replyed_total_row()
	{
		$sql = @"SELECT COUNT(*) AS total_rows FROM data_case_help a left join data_case_detail b on a.cd_id = b.cd_id"
			   ." left join mod_client c on a.cli_id = c.cli_id WHERE a.ch_done=1 ORDER BY a.modi_time DESC";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			return $row->total_rows;
		}

		return 0;
	}
	
	public function get_replyed_list($dataStart, $dataLen)
	{
		$sql = @"SELECT c.cli_id, c.cli_fbid, c.cli_title, c.cli_email, c.cli_mobile, m.cml_id, m.cml_title, m.cml_content, h.modi_time, h.case_url, h.ch_done_time, m.is_read FROM data_case_mail_log m, data_case_help h, mod_client c WHERE m.ch_id=h.ch_id AND h.cli_id=c.cli_id ORDER BY m.modi_time DESC LIMIT $dataStart, $dataLen";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;
	}

    public function get_reply_content($cml_id)
    {
        $sql = @"SELECT c.cli_email, m.cml_id, m.cml_title, m.cml_content, m.modi_time, h.case_url FROM data_case_mail_log m, data_case_help h, mod_client c WHERE m.ch_id=h.ch_id AND m.ch_id=h.ch_id AND h.cli_id=c.cli_id AND m.cml_id=?";
        $para = array($cml_id);
        $query = $this->db->query($sql, $para);

        if($query->num_rows() > 0)
        {
            $row = $query->row();

            return $row;
        }

        return;  
    }
}