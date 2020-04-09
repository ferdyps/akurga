<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class M_user extends CI_Model {

        public function cek_user($data){
            $sql = "SELECT * FROM user WHERE (username = ? OR email = ?) AND password = ?";
            return $this->db->query($sql,array($data['username_email'],$data['username_email'],$data['password']));
        }

        public function selectAllData($table){
            return $this->db->get($table);
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
// ====================================================================================================================
        public function update_data($table, $pk_field, $id, $data) {
            $this->db->where($pk_field, $id);
            return $this->db->update($table, $data);
        }

        public function get_notulensi()
        {
          $this->db->select('surat_undangan.acara_udg, notulensi_rpt.no_notulen, notulensi_rpt.dokumentasi_rpt, notulensi_rpt.penulis, notulensi_rpt.tgl_acc');
          $this->db->from('surat_undangan');
          $this->db->join('notulensi_rpt', 'surat_undangan.no_udg = notulensi_rpt.no_udg');
          return $this->db->get();
        }

        public function get_detail_notulensi($id)
        {
          $this->db->select('surat_undangan.acara_udg, notulensi_rpt.no_notulen, notulensi_rpt.dokumentasi_rpt, notulensi_rpt.uraian_notulen, notulensi_rpt.penulis, notulensi_rpt.tgl_acc, notulensi_rpt.tembusan');
          $this->db->from('surat_undangan');
          $this->db->join('notulensi_rpt', 'surat_undangan.no_udg = notulensi_rpt.no_udg');
          $this->db->where('notulensi_rpt.no_notulen', $id);
          return $this->db->get();
        }

        public function tampil_iuran_perbulan($id_user){
            $query = "
            SELECT
                `no_pembayaran`,
                w.nik as nik,
                w.nama AS nama_warga,
                `tanggal`,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Januari' LIMIT 1) AS bulan_januari,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Februari' LIMIT 1) AS bulan_februari,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Maret' LIMIT 1) AS bulan_maret,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'April' LIMIT 1) AS bulan_april,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Mei' LIMIT 1) AS bulan_mei,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Juni' LIMIT 1) AS bulan_juni,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Juli' LIMIT 1) AS bulan_juli,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Agustus' LIMIT 1) AS bulan_agustus,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'September' LIMIT 1) AS bulan_september,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Oktober' LIMIT 1) AS bulan_oktober,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'November' LIMIT 1) AS bulan_november,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Desember' LIMIT 1) AS bulan_desember,
                jenis_warga,
                SUM(nominal) AS jumlah_iuran
            FROM `pembayaran` p
            JOIN warga w ON w.nik = p.nik
            JOIN user u ON u.id_user = w.id_user
            WHERE u.id_user = $id_user
            GROUP BY p.nik
            ";
            return $this->db->query($query);
        }
        public function tampil_iuran_keluar(){
            // return $this->db->get('pengeluaran');
            $this->db->from('pengeluaran');
            $this->db->order_by('no_pengeluaran', 'desc');
            return $this->db->get();
        }

    }

    /* End of file M_user.php */
