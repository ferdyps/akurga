<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class M_admin extends CI_Model {
    
        public function input_data($table, $data){
            return $this->db->insert($table, $data);
        }
        public function semuaDataWarga(){
            return $this->db->get('warga');
        }
        public function konfirmasiDataWarga(){
            $this->db->where('valid', 0);
            return $this->db->get('warga');
        }
        public function edit_data($table, $pk_field, $id, $data) {
            $this->db->where($pk_field, $id);
            return $this->db->update($table, $data);
        }
// =========================================================================
        public function multiple_select_data($table, $where) {
            $this->db->where($where);
            return $this->db->get($table);
        }
        public function isi_data_iuran_keluar($dataiurankeluar){
            return $this->db->insert('pengeluaran',$dataiurankeluar);
        }
        public function tampil_iuran_keluar(){
            return $this->db->get('pengeluaran');
        }
        public function view_data($where,$table){
            return $this->db->get_where($table,$where);
         }
         public function delete_data_iuran_keluar($where,$table){
            $this->db->where($where);
            $this->db->delete($table);
        }
        
    
    }
    
    
    /* End of file M_admin.php */
    
?>