<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class M_admin extends CI_Model {
    
        public function input_data($table, $data){
            return $this->db->insert($table, $data);
        }
// =========================================================================
        public function multiple_select_data($table, $where) {
            $this->db->where($where);
            return $this->db->get($table);
        }
    
    }
    
    /* End of file M_admin.php */
    
?>