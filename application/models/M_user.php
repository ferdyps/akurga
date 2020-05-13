<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class M_user extends CI_Model {

        public function cek_user($data){
            $sql = "SELECT user.id_user, user.username, user.role, warga.rt, warga.nama FROM user JOIN warga ON user.id_user = warga.id_user  WHERE (username = ? OR email = ?) AND password = ?";
            return $this->db->query($sql,array($data['username_email'],$data['username_email'],$data['password']));
        }

        public function cek_ketua($data){
          $this->db->select('warga.nama, warga.jk');
          $this->db->from('user');
          $this->db->join('warga', 'user.id_user = warga.id_user');
          $this->db->where($data);
          return $this->db->get();
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
        public function selectWithWhere($table,$where){
            return $this->db->get_where($table,$where);
        }
        public function riwayatKomplain($id_user)
        {
            return $this->db->query("SELECT u.id_user,w.nik,w.nama,k.nomor_komplain,k.keluhan,k.tanggal_komplain,k.lokasi,k.lingkup,k.status
            FROM user u
            JOIN warga w
            ON u.id_user=w.id_user
            JOIN komplain k
            ON w.nik=k.nik
            WHERE u.id_user='$id_user'");
        }
// ====================================================================================================================
        public function update_data($table, $pk_field, $id, $data) {
            $this->db->where($pk_field, $id);
            return $this->db->update($table, $data);
        }

        public function get_notulensi($rt)
        {
          $this->db->select('surat_undangan.acara_udg, surat_undangan.tgl_udg, notulensi_rpt.no_notulen, notulensi_rpt.no_udg, notulensi_rpt.dokumentasi_rpt, notulensi_rpt.tgl_buat, notulensi_rpt.rt,');
          $this->db->from('surat_undangan');
          $this->db->join('notulensi_rpt', 'surat_undangan.no_udg = notulensi_rpt.no_udg');
          $this->db->where('notulensi_rpt.rt',$rt);
          return $this->db->get();
        }

        public function get_detail_notulensi($array_data)
        {
          $this->db->select('surat_undangan.acara_udg, surat_undangan.tujuan_surat, surat_undangan.tgl_udg, surat_undangan.jam_udg, surat_undangan.tempat_udg, notulensi_rpt.no_notulen, notulensi_rpt.no_udg, notulensi_rpt.dokumentasi_rpt,  notulensi_rpt.uraian_notulen, notulensi_rpt.penulis, notulensi_rpt.rt, notulensi_rpt.tembusan, notulensi_rpt.tgl_buat');
          $this->db->from('surat_undangan');
          $this->db->join('notulensi_rpt', 'surat_undangan.no_udg = notulensi_rpt.no_udg');
          $this->db->where($array_data);
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
        public function detail($where){
            $query = "
            SELECT
                `no_pembayaran`,
                w.nik as nik,
                w.nama AS nama_warga,

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

                (SELECT tanggal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Januari' LIMIT 1) AS tanggal_bulan_januari,
                (SELECT tanggal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Februari' LIMIT 1) AS tanggal_bulan_februari,
                (SELECT tanggal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Maret' LIMIT 1) AS tanggal_bulan_maret,
                (SELECT tanggal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'April' LIMIT 1) AS tanggal_bulan_april,
                (SELECT tanggal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Mei' LIMIT 1) AS tanggal_bulan_mei,
                (SELECT tanggal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Juni' LIMIT 1) AS tanggal_bulan_juni,
                (SELECT tanggal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Juli' LIMIT 1) AS tanggal_bulan_juli,
                (SELECT tanggal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Agustus' LIMIT 1) AS tanggal_bulan_agustus,
                (SELECT tanggal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'September' LIMIT 1) AS tanggal_bulan_september,
                (SELECT tanggal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Oktober' LIMIT 1) AS tanggal_bulan_oktober,
                (SELECT tanggal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'November' LIMIT 1) AS tanggal_bulan_november,
                (SELECT tanggal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Desember' LIMIT 1) AS tanggal_bulan_desember,


                jenis_warga,
                SUM(nominal) AS jumlah_iuran
            FROM `pembayaran` p
            JOIN warga w ON w.nik = p.nik
            WHERE p.nik = ".$where['nik']."
            GROUP BY p.nik
            ";
            // $this->db->where("p.nik",$where);
            return $this->db->query($query);
        }

    }

    /* End of file M_user.php */
