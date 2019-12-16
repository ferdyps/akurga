<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class M_admin extends CI_Model {

      // ======================== GET ID otomatis ================================
      public function get_id($input,$no,$table) { //$jabatan
        $this->db->select("MAX($no) as maxId");
        $query = $this->db->get($table)->row();
        $Kode=$query->maxId;
          // $rtnya = substr($jabatan, 11, 6);
          $noUrut=(int)substr($Kode, 1, 4);
          $noUrut++;
          if ($input == 'rapat') {
            $Char = "-RPT-";
          }elseif ($input == 'kegiatan') {
            $Char = "-KGT-";
          }elseif ($input == 'notulensi') {
            $Char = "-NOT-";
          }elseif ($input == 'arsip') {
            $Char = "-ASM-";
          }elseif ($input == 'surat_pengantar') {
            $Char = "-SPT-";
          }elseif ($input == 'komplain') {
            $Char = "-KOMPLAIN";
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
        public function edit_data($table, $pk_field, $id, $data) {
            $this->db->where($pk_field, $id);
            return $this->db->update($table, $data);
        }
        public function selectAllData($table){
            return $this->db->get($table);
        }
        public function selectWithWhere($table,$where){
            return $this->db->get_where($table,$where);
        }

        public function CountData($table, $where, $valueNumber){
            $this->db->select('COUNT(*) AS total');
            $this->db->where($where, $valueNumber);
            return $this->db->get($table);
        }

        // ============================================================
        public function semuaDataWarga(){
            return $this->db->get('warga');
        }
        public function konfirmasiDataWarga(){
            $this->db->where('valid', 0);
            return $this->db->get('warga');
        }

        public function detailWargaById($nik){
            $this->db->where('nik', $nik);
            return $this->db->get('warga');
        }
        public function grafikPendidikan(){
            $this->db->select('COUNT(nik) as total, pendidikan');
            $this->db->group_by('pendidikan');
            return $this->db->get('warga');
        }
        public function grafikPekerjaan(){
            $this->db->select('COUNT(nik) as total, pekerjaan');
            $this->db->group_by('pekerjaan');
            return $this->db->get('warga');
        }
        public function userJoinWarga($id_user){
            return $this->db->query("SELECT * FROM user u JOIN warga w ON u.id_user=w.id_user WHERE u.id_user = '$id_user'");
        }
        public function suratJoinWarga(){
            return $this->db->query("SELECT nomor_surat,keperluan,w.nik,nama,tanggal_surat FROM surat_pengantar s JOIN warga w ON w.nik=s.nik");
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
        public function isi_data_iuran_masuk($dataiuranmasuk){
            return $this->db->insert('pembayaran',$dataiuranmasuk);
        }
        public function tampil_iuran_masuk(){
            $this->db->select('warga.nik,warga.nama, pembayaran.no_pembayaran, pembayaran.pembayaran_bulan,pembayaran.nominal,pembayaran.tanggal');
            $this->db->from('warga');
            $this->db->join('pembayaran','warga.nik=pembayaran.nik');
            // $this->db->where($where);
            return $this->db->get();
        }
        public function view_detail_pembayaran($where,$table){
            return $this->db->get_where($table,$where);
        }
        public function view_detail_pengeluaran($where,$table){
            return $this->db->get_where($table,$where);
        }
        public function tampil_bulan_iuran($nik){
            $this->db->where('nik', $nik);
            return $this->db->get('pembayaran');
        }
        public function tampil_iuran_perbulan(){
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
            GROUP BY p.nik
            ";
            return $this->db->query($query);
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

        public function get_jumlah_iuran(){
            $query = "
            SELECT
                nama,
                SUM(nominal) AS jumlah_iuran,
                jenis_warga
            FROM `pembayaran`
            JOIN warga ON warga.nik = pembayaran.nik
            GROUP BY pembayaran.nik
            ";
            return $this->db->query($query);
        }


    }

    /* End of file M_admin.php */

?>
