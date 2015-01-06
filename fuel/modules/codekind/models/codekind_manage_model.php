<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Codekind_manage_model extends MY_Model {
	
	function __construct()
	{
		$CI =& get_instance();
		$CI->config->module_load(CODEKIND_FOLDER, CODEKIND_FOLDER);
		$tables = $CI->config->item('tables');
		parent::__construct($tables['mod_codekind']); // table name
	}

	public function get_total_rows($filter="", $table_name="mod_codekind")
	{
		$sql = @"SELECT COUNT(*) AS total_rows FROM ".$table_name." ".$filter." ORDER BY modi_time DESC";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			return $row->total_rows;
		}

		return 0;
	}

	public function get_codekind_list($dataStart, $dataLen, $filter, $table_name='mod_codekind')
	{
		if($table_name == "mod_codekind")
		{
			$sql = @"SELECT * FROM ".$table_name." ".$filter." ORDER BY modi_time DESC LIMIT $dataStart, $dataLen";
		}
		else
		{
			$sql = @"SELECT * FROM ".$table_name." ".$filter." ORDER BY code_key ASC, modi_time DESC LIMIT $dataStart, $dataLen";
		}
	
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;
	}

	public function get_code_detail_by_parent_id($parent_id)
	{
		$sql = @"SELECT * FROM mod_code WHERE parent_id=? ";
		$para = array($parent_id);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;

	}

	public function get_code_list_for_other_mod($codekind_key)
	{
		$sql = @"SELECT * FROM mod_code WHERE codekind_key=? AND parent_id=-1";
		$para = array($codekind_key);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;

	}

	public function get_codekind_list_for_other_mod()
	{
		$sql = @"SELECT * FROM mod_codekind";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;

	}

	public function get_codekind_detail($codekind_id)
	{
		$sql = @"SELECT * FROM mod_codekind WHERE codekind_id=?";
		$para = array($codekind_id);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			$result = $query->row();

			return $result;
		}

		return;
	}

	public function get_code_detail($code_id)
	{
		$sql = @"SELECT * FROM mod_code WHERE code_id=?";
		$para = array($code_id);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			$result = $query->row();

			return $result;
		}

		return;		
	}

	public function insert($insert_data)
	{
		$sql = @"INSERT INTO mod_codekind (
											codekind_name, 
											codekind_key, 
											codekind_desc, 
											codekind_value1, 
											codekind_value2,
											codekind_value3,
											modi_time,
											lang_code
										) 
				VALUES (?, ?, ?, ?, ?, ?, NOW(), ?)";
		$para = array(
				$insert_data['codekind_name'],
				$insert_data['codekind_key'],
				$insert_data['codekind_desc'],
				$insert_data['codekind_value1'],
				$insert_data['codekind_value2'],
				$insert_data['codekind_value3'],
				$insert_data['lang_code']
			);
		$success = $this->db->query($sql, $para);

		if($success)
		{
			return true;
		}

		return;
	}

	public function update($codekind_id, $update_data)
	{
		$sql = @"UPDATE mod_codekind SET codekind_name 	= ?,
										codekind_key 	= ?,
										codekind_desc 	= ?,
										codekind_value1 = ?,
										codekind_value2	= ?,
										codekind_value3	= ?,
										modi_time		= NOW(),
										lang_code		= ?
				WHERE codekind_id = ?";
		$para = array(
				$update_data['codekind_name'],
				$update_data['codekind_key'],
				$update_data['codekind_desc'],
				$update_data['codekind_value1'],
				$update_data['codekind_value2'],
				$update_data['codekind_value3'],
				$update_data['lang_code'],
				$codekind_id
			);
		$success = $this->db->query($sql, $para);

		if($success)
		{
			return true;
		}

		return;
	}

	public function code_insert($insert_data)
	{
		$sql = @"INSERT INTO mod_code (
											codekind_key,
											code_name, 
											code_key,
											code_value1, 
											code_value2,
											code_value3,
											parent_id,
											modi_time,
											lang_code
										) 
				VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), ?)";
		$para = array(
				$insert_data['codekind_key'],
				$insert_data['code_name'],
				$insert_data['code_key'],
				$insert_data['code_value1'],
				$insert_data['code_value2'],
				$insert_data['code_value3'],
				$insert_data['parent_id'],
				$insert_data['lang_code']
			);
		$success = $this->db->query($sql, $para);

		if($success)
		{
			return true;
		}

		return;
	}

	public function code_update($code_id, $update_data)
	{
		$sql = @"UPDATE mod_code SET 	codekind_key 	= ?,
										code_name 		= ?,
										code_key 		= ?,
										code_value1 	= ?,
										code_value2		= ?,
										code_value3		= ?,
										parent_id	 	= ?,
										modi_time		= NOW(),
										lang_code		= ?
				WHERE code_id = ?";
		$para = array(
				$update_data['codekind_key'],
				$update_data['code_name'],
				$update_data['code_key'],
				$update_data['code_value1'],
				$update_data['code_value2'],
				$update_data['code_value3'],
				$update_data['parent_id'],
				$update_data['lang_code'],
				$code_id
			);
		$success = $this->db->query($sql, $para);

		if($success)
		{
			return true;
		}

		return;
	}

	public function code_del($code_id)
	{
		$sql = @"DELETE FROM mod_code WHERE code_id = ?";
		$para = array($code_id);
		$success = $this->db->query($sql, $para);

		if($success)
		{
			return true;
		}

		return;
	}

	public function del($codekind_id)
	{
		$sql = @"DELETE FROM mod_codekind WHERE codekind_id = ?";
		$para = array($codekind_id);
		$success = $this->db->query($sql, $para);

		if($success)
		{
			return true;
		}

		return;
	}

	public function get_codekind_name($codekind_key)
	{
		$sql = @"SELECT codekind_name FROM mod_codekind WHERE codekind_key=?";
		$para = array($codekind_key);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			return isset($row->codekind_name)?$row->codekind_name:"";
		}

		return;
	}

	public function get_code_name($code_id)
	{
		$sql = @"SELECT code_name FROM mod_code WHERE code_id=?";
		$para = array($code_id);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			return isset($row->code_name)?$row->code_name:"";
		}

		return;		
	}

	public function get_code_key($code_id)
	{
		$this->db->select('code_key');
		$query = $this->db->get_where('mod_code', array('code_id' => $code_id));

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			return $row->code_key;
		}

		return;
	}

	public function get_code_child_key_num($code_id)
	{
		$sql = @"SELECT COUNT(*) AS cnt FROM mod_code WHERE parent_id=?";
		$para = array($code_id);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			$num = (int)$row->cnt + 1;
			$tmp = str_pad($num,4,'0',STR_PAD_LEFT);

			return $tmp;
		}

		return;
	}
	
}