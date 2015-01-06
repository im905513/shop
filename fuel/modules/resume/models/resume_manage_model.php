<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Resume_manage_model extends MY_Model {
	
	function __construct()
	{
		$CI =& get_instance();
		$CI->config->module_load(RESUME_FOLDER, RESUME_FOLDER);
		$tables = $CI->config->item('tables');
		parent::__construct($tables['mod_resume']); // table name
	}

	public function get_total_rows($filter="")
	{
		$sql = @"SELECT COUNT(*) AS total_rows FROM mod_resume $filter ";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			return $row->total_rows;
		}

		return 0;
	}

	public function get_resume_list($dataStart, $dataLen, $filter)
	{
		$sql = @"SELECT * FROM mod_resume $filter ORDER BY create_time DESC LIMIT $dataStart, $dataLen";
	
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;
	}
	public function get_resume_export_list()
	{
		$sql = @"SELECT 
name as 'Last Name',
'' as 'First Name',
'' as 'Middle Name',
name as 'Alias',
(SELECT company_name FROM mod_exp WHERE r.account = account ORDER BY job_start_date DESC LIMIT 1) AS 'Company',
(SELECT job_title FROM mod_exp WHERE r.account = account ORDER BY job_start_date DESC LIMIT 1) AS 'Designation',
contact_tel as 'Mobile No',
contact_tel as 'Office No',
'' as 'Office Ext',
contact_mail as 'Personal Email',
contact_mail as 'Work Email',
contact_tel as 'Home No',
sex as 'Gender',
birth as 'DateOfBirth',
'' as 'Industry-Sector',
'' as 'Function-SkillSet',
about_self as 'Remarks',
address as 'Address',
address_zip as 'ZipCode',
(SELECT (SELECT code_name FROM mod_code WHERE codekind_key = 'school' AND s.school_id = code_id ) FROM mod_school s WHERE r.account = s.account ORDER BY is_attend,is_grad DESC LIMIT 1) AS 'education',
(SELECT CONCAT(IFNULL(company_name,''),'-', IFNULL(job_title,'')) FROM mod_exp WHERE r.account = account ORDER BY job_start_date DESC LIMIT 1) AS 'work-experence',
fb_account as 'FBID' 
FROM `mod_resume` AS r ";
	
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;
	}


	public function get_resume_option($col)
	{
		$sql = @"SELECT distinct $col FROM mod_resume where $col <> '' ";
	
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;
	}

	public function get_resume_skill($account)
	{
		$sql = @"SELECT b.code_name FROM mod_skill a left join mod_code b on a.skill_id = b.code_id  where account=?";
		$para = array($account);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;
	}

	public function get_resume_school($account)
	{
		$sql = @"SELECT b.code_name ,a.attend_date,a.grad_date,a.is_grad,a.is_attend FROM mod_school a left join mod_code b on a.school_id = b.code_id  where account=?";
		$para = array($account);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;
	}

	public function get_resume_exp($account)
	{
		$sql = @"SELECT * FROM mod_exp  where account=?";
		$para = array($account);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;
	}

	 public function get_resume_detail($account)
	{
		$sql = @"SELECT * FROM mod_resume WHERE account=?";
		$para = array($account);
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
		$sql = @"INSERT INTO mod_resume (
											account, 
											password,
											name, 
											birth, 
											contact_tel, 
											contact_mail,
											address_city,
											address_area,
											address_zip,
											address,
											job_status,
											about_self,
											exclude_cate,
											job_location,
											fb_account,
											note,
											create_time
										) 
				VALUES (?, MD5('$password') ,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,NOW())";
				$password=$insert_data['password'];
		$para = array(
				$insert_data['account'], 
				$insert_data['name'],
				$insert_data['birth'],
				$insert_data['contact_tel'],
				$insert_data['contact_mail'],
				$insert_data['address_city'],
				$insert_data['address_area'],
				$insert_data['address_zip'],
				$insert_data['address'],
				$insert_data['job_status'],
				$insert_data['about_self'], 
				$insert_data['exclude_cate'],
				$insert_data['job_location'],
				$insert_data['note'],
				$insert_data['fb_account']
			);
		$success = $this->db->query($sql, $para);

		if($success)
		{
			return true;
		}

		return;
	}

	public function update($update_data)
	{
		$sql = @"UPDATE mod_resume SET name 	= ?,
										birth 	= ?,
										contact_tel 	= ?,
										contact_mail = ?,
									 	sex = ?,
										job_status		= ?,
										about_self		= ?,
										exclude_cate		= ?,
										job_location		= ?,
										fb_account		= ?,
										note		= ?
				WHERE account = ?";
		$para = array(
				$update_data['name'],
				$update_data['birth'],
				$update_data['contact_tel'],
				$update_data['contact_mail'],
				$update_data['sex'],
				// $update_data['address_area'],
				// $update_data['address_zip'],
				// $update_data['address'],
				$update_data['job_status'],
				$update_data['about_self'],
				$update_data['exclude_cate'],
				$update_data['job_location'],
				$update_data['fb_account'],
				$update_data['note'],
				$update_data['account']
			);
		$success = $this->db->query($sql, $para);
 
		if (array_key_exists("password",$update_data)) { 
			$password = $update_data['password'];
			$sql = @"UPDATE mod_resume SET password = MD5('$password') 
				WHERE account = ? ";
			 $para = array(
				$update_data['account']
			);
			$success = $this->db->query($sql, $para); 
		}

		if($success)
		{
			return true;
		}

		return;
	} 

	public function del($account)
	{
		$sql = @"DELETE FROM mod_resume WHERE account = ?";
		 
		$para = array($account);
		$success = $this->db->query($sql, $para);

		if($success)
		{
			return true;
		}

		return;
	} 
	  
	
}