<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class M_user extends CI_Model {
    
        public function cek_user($data){
            $sql = "SELECT * FROM user WHERE username = ? AND password = ?";
            return $this->db->query($sql,array($data['username'],$data['password']));
        }
    
    
    }
    
    /* End of file M_user.php */
    
?>