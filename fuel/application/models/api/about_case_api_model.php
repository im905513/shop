<?php
class About_case_api_model extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }

    public function get_unproccess_reply()
    {
        $sql = @"SELECT a.ch_id, a.case_url ,a.cli_id,b.cli_email FROM data_case_help a inner join 
                                  mod_client b on a.cli_id = b.cli_id WHERE a.ch_done = 0";
        $query = $this->db->query($sql, $para);

        if($query->num_rows() > 0)
        {
            $result = $query->result_array();
            return $result;
        }

        return false;
        
    }

    public function get_new_case_title($dataStart)
    {
        $sql = @"SELECT cd_id, cd_title, cd_content FROM data_case_detail WHERE board='518case' ORDER BY cd_id DESC LIMIT $dataStart, 10";
        $query = $this->db->query($sql);

        if($query->num_rows() > 0)
        {
            $result = $query->result();
            return $result;
        }

        return;
    }

    public function get_sub_cate_list($code_id)
    {
        $sql = @"SELECT code_id, code_name, parent_id FROM mod_code WHERE codekind_key='case_cate_group' AND parent_id=?";
        $para = array($code_id);
        $query = $this->db->query($sql, $para);

        if($query->num_rows() > 0)
        {
            $result = $query->result_array();

            return $result;
        }

        return array();
    }

    public function get_all_cate_list()
    {
        $all_cate_result = array();

        $sql = @"SELECT code_id, code_name, parent_id FROM mod_code WHERE codekind_key='case_cate_group' AND parent_id=-1";
        $query = $this->db->query($sql);

        if($query->num_rows() > 0)
        {
            $result = $query->result();

            foreach ($result as $key => $row) 
            {
                $all_cate_result[$key]["code_id"]   = $row->code_id;
                $all_cate_result[$key]["code_name"] = $row->code_name;
                $all_cate_result[$key]["parent_id"] = $row->parent_id;
                $all_cate_result[$key]["sub_cate"]  = $this->get_sub_cate_list($row->code_id);
            }

            return $all_cate_result;
        }

        return array();
    }

    public function get_case_total_rows($filter="")
    {
        $sql = @"SELECT COUNT(*) AS total_rows FROM data_case_detail WHERE board='518case' ".$filter." ORDER BY cd_id DESC";
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
        $sql = @"SELECT cd_id, cd_title, board, cd_url, cd_content, run_date FROM data_case_detail WHERE board='518case' ".$filter." ORDER BY cd_id DESC LIMIT $dataStart, $dataLen";
        $query = $this->db->query($sql);

        if($query->num_rows() > 0)
        {
            $result = $query->result_array();

            return $result;
        }

        return;
    }

    public function get_new_case_list()
    {
        $sql = @"SELECT cd_id, cd_title, cd_url, cd_content, run_date FROM data_case_detail WHERE board='518case' ORDER BY cd_id DESC LIMIT 0, 5";
        $query = $this->db->query($sql);

        if($query->num_rows() > 0)
        {
            $result = $query->result_array();

            return $result;
        }

        return;

    }

    public function get_case_detail($cd_id)
    {
        $sql = @"SELECT a.cd_id, a.cd_title, a.board, a.cd_url, a.cd_content, a.run_date, b.code_name FROM data_case_detail a, mod_code b WHERE a.real_cate=b.code_id AND a.cd_id=?";
        $para = array($cd_id);
        $query = $this->db->query($sql, $para);

        if($query->num_rows() > 0)
        {
            $row = $query->row_array();

            return $row;
        }

        return;
    }

}