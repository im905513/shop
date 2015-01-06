<?php
class About_email_model extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }

    public function set_ch_done($ch_id)
    {
        $sql = @"UPDATE data_case_help SET ch_done=1, ch_done_time=NOW() WHERE ch_id=?";
        $para = array($ch_id);
        $success = $this->db->query($sql, $para);

        if($success)
        {
            return true;
        }

        return false;
        
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

}