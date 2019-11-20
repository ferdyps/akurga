<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class M_user extends CI_Model {
    
        public function cek_user($data){
            $sql = "SELECT * FROM user WHERE (username = ? OR email = ?) AND password = ?";
            return $this->db->query($sql,array($data['username_email'],$data['username_email'],$data['password']));
        }
// ==================================================================================================================
        public function input_data($table, $data){
            return $this->db->insert($table, $data);
        }
// ================================================================================================================
        public function multiple_select_data($table, $where) {
            $this->db->where($where);
            return $this->db->get($table);
        }
    
    
    }
    
    /* End of file M_user.php */
    
?>