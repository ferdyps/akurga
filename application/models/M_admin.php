<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class M_admin extends CI_Model {

      // ======================== GET ID otomatis ================================
      public function get_id($input) { //$jabatan
        $this->db->select("MAX(no_udg) as maxId");
        $query = $this->db->get('surat_undangan')->row();
        $Kode=$query->maxId;
          // $rtnya = substr($jabatan, 11, 6);
          $noUrut=(int)substr($Kode, 1, 4);
          $noUrut++;
          if ($input == 'rapat') {
            $Char = "/RPT/";
          }elseif ($input == 'kegiatan') {
            $Char = "/KGT/";
          }elseif ($input == 'notulensi') {
            $Char = "/NOT/";
          }elseif ($input == 'arsip') {
            $Char = "/ASM/";
          }else {
            echo "Erorr id";
          }

          $newID = sprintf("%04s", $noUrut) . $Char; //. $rtnya
          return $newID;

      }

      // ======================== END GET ID otomatis ================================

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
        public function edit_data_iuran_keluar($where,$table){
            return $this->db->get_where($table,$where);
        }
        function update_data($where,$data,$table){
            $this->db->where($where);
            $this->db->update($table,$data);
        }


    }


    /* End of file M_admin.php */

?>
