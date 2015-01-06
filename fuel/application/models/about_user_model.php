<?php
class About_user_model extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }

    public function get_user_basic_info_by_fbid($fbid)
    {
        $sql = @"SELECT cli_title, cli_email, cli_fbid, cli_mobile FROM mod_client WHERE cli_fbid = ?";
        $para = array($fbid);
        $query = $this->db->query($sql, $para);

        if($query->num_rows() > 0)
        {
            $row = $query->row();

            return $row;
        }

        return null;
    }

    public function do_update_cli_email_mobile($cli_email, $cli_mobile, $cli_id)
    {
        $sql = @"UPDATE mod_client SET cli_email=?, cli_mobile=?, modi_time=NOW() WHERE cli_id=?";
        $para = array($cli_email, $cli_mobile, $cli_id);
        $success = $this->db->query($sql, $para);

        if($success)
        {
            return true;
        }

        return;
    }

    public function do_update_cli($update_data, $cli_id)
    {   
        $sql = @"UPDATE mod_client SET 
                                        cli_title   = ?,
                                        cli_email   = ?,
                                        cli_mobile  = ?,
                                        cli_kind    = ?,
                                        cli_intro1  = ?,
                                        cli_intro2  = ?,
                                        cli_intro3  = ?,
                                        agree_edm   = ?,
                                        modi_time   = NOW()
                WHERE cli_id = ?
                ";
        $para = array(
                $update_data['cli_title'],
                $update_data['cli_email'],
                $update_data['cli_mobile'],
                $update_data['cli_kind'],
                $update_data['cli_intro1'],
                $update_data['cli_intro2'],
                $update_data['cli_intro3'],
                $update_data['agree_edm'],
                $cli_id
            );
        $success = $this->db->query($sql, $para);

        if($success)
        {
            return true;
        }

        return;
    }

    public function update_cli_logo($logo_name, $cli_id)
    {
        $sql = @"UPDATE mod_client SET cli_logo=? WHERE cli_id=?";
        $para = array($logo_name, $cli_id);
        $success = $this->db->query($sql, $para);

        if($success)
        {
            return true;
        }

        return;
    }

    public function get_user_all_info_by_id($cli_id)
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

    public function get_code_by_codkind_key($codekind_key)
    {
        $sql = @"SELECT * FROM mod_code WHERE codekind_key=? ORDER BY code_key ASC";
        $para = array($codekind_key);
        $query = $this->db->query($sql, $para);

        if($query->num_rows() > 0)
        {
            $result = $query->result();

            return $result;
        }

        return;
    }

    public function get_cli_intro($cli_id)
    {
        $sql = @"SELECT cli_intro1, cli_intro2, cli_intro3 FROM mod_client WHERE cli_id=?";
        $para = array($cli_id);
        $query = $this->db->query($sql, $para);

        if($query->num_rows() > 0)
        {
            $row = $query->row();

            if(isset($row))
            {
                $cli_array = array();

                if($row->cli_intro1 != "")
                {
                    array_push($cli_array, $row->cli_intro1);
                }

                if($row->cli_intro2 != "")
                {
                    array_push($cli_array, $row->cli_intro2);
                }

                if($row->cli_intro3 != "")
                {
                    array_push($cli_array, $row->cli_intro3);
                }

                return $cli_array;
            }
        }

        return;
    }

    public function get_intro_detail($cli_id, $cli_intro)
    {
        $sql = @"SELECT cli_intro$cli_intro as intro FROM mod_client WHERE cli_id=?";
        $para = array($cli_id);
        $query = $this->db->query($sql, $para);

        if($query->num_rows() > 0)
        {
            $row = $query->row();

            return $row->intro;
        }

        return;
    }

    public function get_reply_total_rows($cli_id)
    {
        $sql = @"SELECT COUNT(*) AS cnt FROM data_case_mail_log m, data_case_help h WHERE m.ch_id=h.ch_id AND h.cli_id=? ORDER BY m.modi_time DESC";
        $para = array($cli_id);
        $query = $this->db->query($sql, $para);

        if($query->num_rows() > 0)
        {
            $row = $query->row();

            return $row->cnt;
        }

        return;        
    }

    public function get_unread_reply_cnt($cli_id)
    {
        $sql = @"SELECT COUNT(*) AS cnt FROM data_case_mail_log m, data_case_help h WHERE m.ch_id=h.ch_id AND h.cli_id=? AND m.is_read=0";
        $para = array($cli_id);
        $query = $this->db->query($sql, $para);

        if($query->num_rows() > 0)
        {
            $row = $query->row();

            return $row->cnt;
        }

        return;
    }

    public function get_reply_list_by_user($cli_id, $dataStart, $dataLen)
    {
        $sql = @"SELECT m.cml_id, m.cml_title, m.cml_content, m.modi_time, h.case_url, m.is_read FROM data_case_mail_log m, data_case_help h WHERE m.ch_id=h.ch_id AND h.cli_id=? ORDER BY m.modi_time DESC LIMIT $dataStart, $dataLen";
        $para = array($cli_id);
        $query = $this->db->query($sql, $para);

        if($query->num_rows() > 0)
        {
            $result = $query->result();

            return $result;
        }

        return;
    }

    public function get_reply_content($cli_id, $cml_id)
    {
        $sql = @"SELECT m.cml_id, m.cml_title, m.cml_content, m.modi_time, h.case_url FROM data_case_mail_log m, data_case_help h WHERE m.ch_id=h.ch_id AND m.ch_id=h.ch_id AND h.cli_id=? AND m.cml_id=?";
        $para = array($cli_id, $cml_id);
        $query = $this->db->query($sql, $para);

        if($query->num_rows() > 0)
        {
            $row = $query->row();

            return $row;
        }

        return;  
    }

    public function set_reply_read($cml_id)
    {
        $sql = @"UPDATE data_case_mail_log SET is_read=1 WHERE cml_id=?";
        $para = array($cml_id);
        $success = $this->db->query($sql, $para);

        if($success)
        {
            return true;
        }

        return;
    }

    public function insert_fb_user_data($cli_fbid, $cli_email, $cli_title)
    {
        $sql = @"INSERT INTO mod_client (cli_fbid, cli_email, cli_title, create_time, modi_time) VALUES (?, ?, ?, NOW(), NOW())";
        $para = array($cli_fbid, $cli_email, $cli_title);
        $success = $this->db->query($sql, $para);

        if($success)
        {
            return true;
        }

        return;
    }

    public function valid_user_by_fbid($fbid)
    {
        $sql = @"SELECT cli_id, cli_title, cli_fbid FROM mod_client WHERE cli_fbid=? LIMIT 1";
        $para = array($fbid);
        $query = $this->db->query($sql, $para);

        if($query->num_rows() > 0)
        {

            return $query->row_array();
        }

        return;
    }

}