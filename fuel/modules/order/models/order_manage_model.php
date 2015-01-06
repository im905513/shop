<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Order_manage_model extends MY_Model {
	
	function __construct()
	{
		$CI =& get_instance();
		$CI->config->module_load(ORDER_FOLDER, ORDER_FOLDER);
		$tables = $CI->config->item('tables');
		parent::__construct($tables['mod_order']); // table name
	}

	public function get_total_rows($filter="")
	{
		$sql = @"SELECT COUNT(*) AS total_rows FROM mod_order as a
				LEFT JOIN mod_member as b on a.member_id=b.id ".$filter."";

		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			return $row->total_rows;
		}

		return 0;
	}

	public function get_order_list($dataStart, $dataLen, $filter)
	{
		$sql = @"SELECT 
						a.id,
						a.member_id,
						b.member_name, 
						a.order_status,
						a.order_ship_status,
						a.order_time  
				FROM mod_order as a
				LEFT JOIN mod_member as b on a.member_id=b.id ".$filter."
				ORDER BY a.order_time DESC LIMIT $dataStart, $dataLen";
	
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;
	}

	public function get_code_list($filter)
	{
		$sql = @"SELECT * FROM mod_code $filter ORDER BY modi_time DESC";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;

	}

	public function get_status_list($pro_id)
	{
		$sql = @"SELECT a.regi_id, a.pro_id, a.account, a.drop_date, a.regi_type, b.name, c.event_title FROM mod_register a, mod_resume b, mod_product c WHERE a.pro_id=? AND a.account=b.account AND a.pro_id=c.pro_id";
		$para = array($pro_id);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;
	}

	public function insert($data)
	{
		$sql = @"INSERT INTO mod_product (
				pro_item_no,
				pro_cate,
				pro_name, 
				pro_slogan, 
				pro_desc, 
				pro_format_1, 
				pro_format_2,
				pro_format_3, 
				pro_color,
				pro_size,
				pro_num,
				pro_ship_note, 
				pro_original_price,
				pro_wholesale_price,
				pro_vip_price,
				pro_stime,
				pro_etime,
				pro_order,
				pro_status,
				create_time,
				modi_time,
				seo_title,
				seo_kw,
				seo_desc)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW(), ?, ?, ?)
				";
		$para = array(
				$data['pro_item_no'],
				$data['pro_cate'],
				$data['pro_name'],
				$data['pro_slogan'],
				$data['pro_desc'],
				$data['pro_format_1'],
				$data['pro_format_2'],
				$data['pro_format_3'],
				$data['pro_color'],
				$data['pro_size'],
				$data['pro_num'],
				$data['pro_ship_note'],
				$data['pro_original_price'],
				$data['pro_wholesale_price'],
				$data['pro_vip_price'],
				$data['pro_stime'],
				$data['pro_etime'],
				$data['pro_order'],
				$data['pro_status'],
				$data['seo_title'],
				$data['seo_kw'],
				$data['seo_desc']
			);

		$success = $this->db->query($sql, $para);

		if($success)
		{
			return true;
		}

		return;
	}

	public function modify($data, $pro_id)
	{
		$sql = @"UPDATE mod_product SET 
				pro_item_no=?, 
				pro_cate=?, 
				pro_name=?, 
				pro_slogan=?, 
				pro_desc=?, 
				pro_format_1=?, 
				pro_format_2=?, 
				pro_format_3=?, 
				pro_color=?,
				pro_size=?,
				pro_num=?,
				pro_ship_note=?,
				pro_original_price=?,
				pro_vip_price=?,
				pro_stime=?,
				pro_etime=?,
				pro_order=?,
				pro_status=?,
				seo_title=?,
				seo_kw=?,
				seo_desc=?,
				modi_time=NOW() WHERE id=?";
		$para = array(
				$data['pro_item_no'],
				$data['pro_cate'],
				$data['pro_name'],
				$data['pro_slogan'],
				$data['pro_desc'],
				$data['pro_format_1'],
				$data['pro_format_2'],
				$data['pro_format_3'],
				$data['pro_color'],
				$data['pro_size'],
				$data['pro_num'],
				$data['pro_ship_note'],
				$data['pro_original_price'],
				$data['pro_vip_price'],
				$data['pro_stime'],
				$data['pro_etime'],
				$data['pro_order'],
				$data['pro_status'],
				$data['seo_title'],
				$data['seo_kw'],
				$data['seo_desc'],
				$pro_id
			);

		$success = $this->db->query($sql, $para);

		if($success)
		{
			return true;
		}

		return;
	}

	public function modify_photo_name($file_name, $pro_id)
	{
		$sql = "UPDATE mod_product SET event_photo = ?, update_time = NOW() WHERE pro_id = ?";
		$para = array($file_name, $pro_id);
		$success = $this->db->query($sql, $para);

		if($success)
		{
			return true;
		}

		return;
	}

	public function get_photo_name($pro_id)
	{
		$sql = "SELECT event_photo FROM mod_product WHERE pro_id=?";
		$para = array($pro_id);

		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			return $row->event_photo;
		}

		return;
	}

	public function get_product_detail($pro_id)
	{
		$sql = @"SELECT * FROM mod_product WHERE id=?";
		$para = array($pro_id);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			$result = $query->row();

			return $result;
		}

		return;
	}

	public function del($pro_id)
	{
		$sql = "DELETE FROM mod_product WHERE pro_id=?";
		$para = array($pro_id);
		$success= $this->db->query($sql, $para);

		if($success)
		{
			return true;
		}

		return;
	}

	public function multi_del($pro_ids)
	{
		$sql = "DELETE FROM mod_product WHERE id IN ($pro_ids)";
		$success = $this->db->query($sql);

		if($success)
		{
			return true;
		}

		return;
	}

	public function get_prod_reply_list($pro_id)
	{
		$sql = @"SELECT a.id, a.product_id, a.member_id, b.member_name, a.reply_content, a.reply_status, a.modi_time FROM mod_prod_reply a, mod_member b WHERE a.product_id=? AND a.member_id=b.id ORDER BY a.modi_time DESC";
		$para = array($pro_id);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;
	}

	public function get_reply_content($r_id)
	{
		$sql = @"SELECT a.id, 
						a.product_id, 
						c.pro_name, 
						a.member_id, 
						b.member_name,
						a.reply_type, 
						a.reply_content, 
						a.reply_status,
						a.modi_time 
				FROM mod_prod_reply as a 
				LEFT JOIN mod_member AS b ON a.member_id=b.id 
				LEFT JOIN mod_product AS c ON a.product_id=c.id 
				WHERE a.id=?";
		$para = array($r_id);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			$result = $query->row();

			return $result;
		}

		return;
	}

	public function reply_reply($data)
	{
		$sql = @"INSERT INTO mod_prod_reply (product_id, member_id, reply_content, reply_id, modi_time, create_time)
				VALUES (?, ?, ?, ?, NOW(), NOW())";
		$para = array(
				$data['pro_id'],
				0,
				$data['admin_reply_content'],
				$data['r_id']
			);

		$success = $this->db->query($sql, $para);

		if($success)
		{
			$this->update_reply_status($data['r_id']);
			return true;
		}

		return;
	}

	public function update_reply_status($r_id)
	{
		$sql = @"UPDATE mod_prod_reply SET reply_status=1 WHERE id=?";
		$para = array($r_id);

		$this->db->query($sql, $para);

		return;
	}


	public function modify_reply($data, $r_id)
	{
		$sql = @"UPDATE mod_prod_reply SET reply_content=?, reply_star=?, modi_time=NOW() WHERE id=?";
		$para = array(
				$data['reply_content'],
				$data['reply_star'],
				$r_id
			);
		$success = $this->db->query($sql, $para);

		if($success)
		{
			return true;
		}

		return;
	}

	public function del_reply($r_id)
	{
		$sql = @"DELETE FROM mod_prod_reply WHERE id=?";
		$para = array($r_id);

		$success = $this->db->query($sql, $para);

		if($success)
		{
			return true;
		}

		return;
	}

	public function multi_reply_del($r_ids)
	{
		$sql = "DELETE FROM mod_prod_reply WHERE id IN ($r_ids)";
		$success = $this->db->query($sql);

		if($success)
		{
			return true;
		}

		return;
	}

	public function get_product_export_list()
	{
		$sql = @"SELECT 
						a.pro_item_no,
						b.code_name AS pro_cate, 
						a.pro_name, 
						a.pro_slogan,
						a.pro_desc,
						a.pro_format_1,
						a.pro_format_2,
						a.pro_format_3,
						a.pro_color,
						a.pro_size,
						a.pro_num,
						a.pro_ship_note,
						a.pro_original_price,
						a.pro_wholesale_price,
						a.pro_vip_price,
						a.pro_stime,
						a.pro_etime,
						a.pro_order,
						c.code_name AS pro_status  
				FROM mod_product as a
				LEFT JOIN mod_code as b  on a.pro_cate=b.code_id
				LEFT JOIN mod_code as c on a.pro_status=c.code_id 
				ORDER BY a.modi_time DESC";
	
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;
	}
	
}
?>