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

	public function modify($data, $order_id)
	{
		$sql = @"UPDATE mod_order SET 
				order_vat_number=?, 
				order_invoice_title=?, 
				order_addressee_name=?, 
				order_addressee_mobile=?, 
				order_addressee_addr=?, 
				order_note=?, 
				order_status=?, 
				order_ship_status=?, 
				order_inv_status=?, 
				modi_time=NOW() WHERE id=?";
		$para = array(
				$data['order_vat_number'],
				$data['order_invoice_title'],
				$data['order_addressee_name'],
				$data['order_addressee_mobile'],
				$data['order_addressee_addr'],
				$data['order_note'],		
				$data['order_status'],	
				$data['order_ship_status'],
				$data['order_inv_status'],
				$order_id
			);

		$success = $this->db->query($sql, $para);

		if($success)
		{
			return true;
		}

		return;
	}


	public function get_order_detail($order_id)
	{
		$sql = @"SELECT 
					a.id,
					a.member_id,
					b.member_name,
					a.order_vat_number,
					a.order_invoice_title,
					a.order_addressee_name,
					a.order_addressee_addr,
					a.order_addressee_mobile,
					a.order_status,
					a.order_ship_status,
					a.order_time,
					a.modi_time,
					a.order_note,
					a.order_inv_status,
					a.cash_flow_id 
				FROM mod_order AS a 
				LEFT JOIN mod_member AS b ON a.member_id = b.id 
				WHERE a.id=?";
		$para = array($order_id);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			$result = $query->row();

			return $result;
		}
 
		return;
	}

	public function get_order_pro_detail($order_id)
	{
		$sql = @"SELECT a.id, 
						a.product_id,
						d.pro_name, 
						b.code_name AS pro_size,
						c.code_name AS pro_color,
						a.promo_id,
						e.promo_name, 
						a.product_num,
						a.product_price 
				FROM mod_order_detail AS a 
				LEFT JOIN mod_code AS b ON a.product_size = b.code_id 
				LEFT JOIN mod_code AS c ON a.product_color = c.code_id 
				LEFT JOIN mod_product AS d ON a.product_id = d.id  
				LEFT JOIN mod_promo AS e ON a.promo_id = e.id 
				WHERE a.order_id = ?
				";
		$para = array($order_id);
		$query = $this->db->query($sql, $para);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;
	}

	public function set_order_status($order_id, $status)
	{
		$sql = @"UPDATE mod_order SET order_status=? WHERE id=?";
		$para = array($status, $order_id);

		$success = $this->db->query($sql, $para);

		if($success)
		{
			return true;
		}

		return;
	}

	public function del_detail_item($did)
	{
		$sql = @"DELETE FROM mod_order_detail WHERE id=?";
		$para = array($did);

		$success = $this->db->query($sql, $para);

		if($success)
		{
			return true;
		}

		return;
	}

	public function del($order_id)
	{
		$sql = "DELETE FROM mod_order WHERE id=?";
		$para = array($order_id);
		$success= $this->db->query($sql, $para);

		if($success)
		{
			return true;
		}

		return;
	}

	public function multi_del($order_ids)
	{
		$sql = "DELETE FROM mod_order WHERE id IN ($order_ids)";
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