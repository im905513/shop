<?php
class About_case_model extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }

    public function get_total_rows($filter="")
    {
        $sql = @"SELECT COUNT(*) AS total_rows FROM data_case_detail ".$filter." ORDER BY post_date DESC";
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
        $sql = @"SELECT * FROM data_case_detail ".$filter." ORDER BY cd_id DESC LIMIT $dataStart, $dataLen";
        $query = $this->db->query($sql);
        //echo $sql;exit;
        if($query->num_rows() > 0)
        {
            $result = $query->result();

            return $result;
        }

        return false;
    }

    public function get_case_detail($cd_id)
    {
        $sql = @"SELECT * FROM data_case_detail WHERE cd_id=?";
        $para = array($cd_id);
        $query = $this->db->query($sql, $para);

        if($query->num_rows() > 0)
        {
            $row = $query->row();

            return $row;
        }

        return;
    }

    public function get_case_url($cd_id)
    {
        $sql = @"SELECT cd_url FROM data_case_detail WHERE cd_id=?";
        $para = array($cd_id);
        $query = $this->db->query($sql, $para);

        if($query->num_rows() > 0)
        {
            $row = $query->row();

            return $row->cd_url;
        }

        return;
    }

    public function do_insert_help($insert_data)
    {
        $sql = @"INSERT INTO data_case_help (cd_id, cli_id, case_url, cli_intro, modi_time) VALUES (?, ?, ?, ?, NOW())";
        $para = array(
                $insert_data['cd_id'],
                $insert_data['cli_id'],
                $insert_data['case_url'],
                $insert_data['cli_intro']
            );
        $success = $this->db->query($sql, $para);

        if($success)
        {
            return true;
        }

        return;
    }

    public function get_case_help_by_cli_id($insert_data)
    {
        $sql = @"SELECT ch_id FROM data_case_help WHERE cli_id=? AND case_url=?";
        $para = array($insert_data['cli_id'], $insert_data['case_url']);
        $query = $this->db->query($sql, $para);

        if($query->num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }

        return;
    }

    public function get_case_cate_code()
    {
        $sql = @"SELECT * FROM mod_code WHERE codekind_key='case_cate_group' AND parent_id='-1'";
        $query = $this->db->query($sql);

        if($query->num_rows() > 0)
        {
            $result = $query->result();

            return $result;
        }

        return;
    }

    public function get_case_sub_cate($parent_id)
    {
        $sql = @"SELECT * FROM mod_code WHERE codekind_key='case_cate_group' AND parent_id=?";
        $para = array($parent_id);
        $query = $this->db->query($sql, $para);
        
        if($query->num_rows() > 0)
        {
            $result = $query->result();

            return $result;
        }

        return;
    }

    public function get_parent_id($code_id)
    {
        $sql = @"SELECT parent_id FROM mod_code WHERE codekind_key='case_cate_group' AND code_id=?";
        $para = array($code_id);
        $query = $this->db->query($sql, $para);

        if($query->num_rows() > 0)
        {
            $row = $query->row();

            return $row->parent_id;
        }

        return;
    }

    public function get_case_cate_sub_ids($code_id)
    {
        $tmp = array();
        $sql = @"SELECT code_id FROM mod_code WHERE codekind_key='case_cate_group' AND parent_id=?";
        $para = array($code_id);
        $query = $this->db->query($sql, $para);

        if($query->num_rows() > 0)
        {
            $result = $query->result();

            foreach ($result as $key => $row) 
            {
                array_push($tmp, $row->code_id);
            }

            $txt = implode(",", $tmp);

            return $txt;
        }

        return;
    }

    public function get_relation_case($filter, $cd_id)
    {
        $sql = @"SELECT cd_id, cd_title FROM data_case_detail ".$filter." AND cd_id<>'$cd_id' ORDER BY run_date DESC LIMIT 0, 5";
        $query = $this->db->query($sql);

        if($query->num_rows() > 0)
        {
            $result = $query->result();

            return $result;
        }

        return;
    }

    public function get_case_cate_title($code_id)
    {
        $sql = @"SELECT code_name FROM mod_code WHERE code_id=?";
        $para = array($code_id);
        $query = $this->db->query($sql, $para);

        if($query->num_rows() > 0)
        {
            $row = $query->row();

            return $row->code_name;
        }

        return;
    }

}