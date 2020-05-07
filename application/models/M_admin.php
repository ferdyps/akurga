<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class m_admin extends CI_Model {

      // ======================== GET ID otomatis ================================
      public function get_id($input,$no,$table,$rt) {
        $this->db->select("MAX($no) as maxId");
        if ($rt == 'RT 01') {
          $romawi = 'I';
        }elseif ($rt == 'RT 02') {
          $romawi = 'II';
        }elseif ($rt == 'RT 03') {
          $romawi = 'III';
        }elseif ($rt == 'RT 04') {
          $romawi = 'IV';
        }elseif ($rt == 'RT 05') {
          $romawi = 'V';
        }elseif ($rt == 'RW 01') {
          $romawi = 'I';
        }
        $query = $this->db->get($table)->row();
        $Kode=$query->maxId;
          $noUrut=(int)substr($Kode, 1, 4);
          $noUrut++;
          if ($input == 'rapat') {
            $Char = "-RPT-".$romawi.'-'.date("Y");
          }elseif ($input == 'kegiatan') {
            $Char = "-KGT-".$romawi.'-'.date("Y");
          }elseif ($input == 'notulensi') {
            $Char = "-NOT-".$romawi.'-'.date("Y");
          }elseif ($input == 'arsip') {
            $Char = "-ASM-".$romawi.'-'.date("Y");
          }elseif ($input == 'surat_pengantar') {
            $Char = '-SK-'.$romawi.'-'.date("Y");
          }elseif ($input == 'komplain') {
            $Char = "-KOMPLAIN-".$romawi."-".date("Y");
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

        public function delete_data($where, $table){
           $this->db->where($where);
           $this->db->delete($table);
       }

        public function CountData($table, $where, $valueNumber){
            $this->db->select('COUNT(*) AS total');
            $this->db->where($where, $valueNumber);
            return $this->db->get($table);
        }

        public function get_detail_notulensi($id)
        {
          $this->db->select('surat_undangan.acara_udg, notulensi_rpt.no_notulen, notulensi_rpt.dokumentasi_rpt,  notulensi_rpt.uraian_notulen, notulensi_rpt.penulis, notulensi_rpt.tgl_acc, notulensi_rpt.rt, notulensi_rpt.tembusan');
          $this->db->from('surat_undangan');
          $this->db->join('notulensi_rpt', 'surat_undangan.no_udg = notulensi_rpt.no_udg');
          $this->db->where('notulensi_rpt.no_notulen', $id);
          return $this->db->get();
        }
        // ================================ sekretaris khusus ==============================
        public function cek_ketua($data){
          $this->db->select('warga.nama');
          $this->db->from('user');
          $this->db->join('warga', 'user.id_user = warga.id_user');
          $this->db->where($data);
          return $this->db->get();
        }
        // ============================================================
        public function list_surat_pengantar()
        {
            return $this->db->query("SELECT sp.*,nama,
            (
                SELECT status
                FROM status_surat ss
                WHERE ss.nomor_surat = sp.nomor_surat
                ORDER BY created_at DESC
                LIMIT 1
            ) as status,
            (
                SELECT pesan
                FROM status_surat ss
                WHERE ss.nomor_surat = sp.nomor_surat
                ORDER BY created_at DESC
                LIMIT 1
            ) as pesan
            FROM surat_pengantar sp
            JOIN warga w ON w.nik=sp.nik");
        }

        public function list_cetak_sp()
        {
            return $this->db->query("SELECT w.nik, nama, sp.nomor_surat, keperluan, tanggal_surat, ss.STATUS
            FROM surat_pengantar sp
            JOIN warga w ON w.nik=sp.nik
            JOIN status_surat ss ON sp.nomor_surat = ss.nomor_surat
            WHERE ss.STATUS='diterima'");
        }

        public function getNomorSuratPengantar(){
            return $this->db->query("SELECT nomor_surat FROM `surat_pengantar` ORDER BY nomor_surat DESC LIMIT 1");
        }

        public function semuaDataWarga(){
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
        // public function suratJoinWarga(){
        //     return $this->db->query("SELECT nomor_surat,keperluan,w.nik,nama,tanggal_surat,s.valid FROM surat_pengantar s JOIN warga w ON w.nik=s.nik");
        // }
        // public function cetakSuratJoinWarga(){
        //     return $this->db->query("SELECT nomor_surat,keperluan,w.nik,nama,tanggal_surat,s.valid FROM surat_pengantar s JOIN warga w ON w.nik=s.nik WHERE s.valid=1");
        // }
        public function detailSuratPengantar($value){
            $this->db->select('*');
            $this->db->from('surat_pengantar');
            $this->db->join('warga', 'surat_pengantar.nik = warga.nik');
            $this->db->where('surat_pengantar.nomor_surat', $value);
            return $this->db->get();
        }

        public function komplainJoinWargaRT(){
            return $this->db->query("SELECT nomor_komplain,w.nik,nama,keluhan,lokasi,tanggal_komplain,lingkup,k.status,k.gambar FROM komplain k JOIN warga w ON w.nik=k.nik where lingkup='rt'
            ");
        }

        public function komplainJoinWargaRW(){
            return $this->db->query("SELECT nomor_komplain,w.nik,nama,keluhan,lokasi,tanggal_komplain,lingkup,k.status,k.gambar FROM komplain k JOIN warga w ON w.nik=k.nik where lingkup='rw'
            ");
        }

        public function riwayatSuratPengantar($id_user){
            return $this->db->query("SELECT u.id_user,sp.nomor_surat,sp.tanggal_surat,sp.keperluan, ss.status, ss.created_at, ss.pesan
            FROM `user` u
            JOIN warga w ON u.id_user=w.id_user
            JOIN surat_pengantar sp ON w.nik=sp.nik
            JOIN
            (
                SELECT max(id) AS max_id ,nomor_surat
                FROM status_surat
                GROUP by nomor_surat
            ) sp_max ON (sp_max.nomor_surat = sp.nomor_surat)
            JOIN status_surat ss ON (ss.id = sp_max.max_id)
            WHERE u.id_user='$id_user'");
        }
        public function riwayatKomplain($id_user)
        {
            return $this->db->query("SELECT u.id_user,w.nik,w.nama,k.nomor_komplain,k.keluhan,k.tanggal_komplain,k.lokasi
            FROM user u
            JOIN warga w
            ON u.id_user=w.id_user
            JOIN komplain k
            ON w.nik=k.nik
            WHERE u.id_user='$id_user'");
        }

        public function list_akun(){
            return $this->db->query("SELECT u.id_user,username,email,nik,nama,role FROM user u JOIN warga w ON w.id_user=u.id_user WHERE u.id_user NOT IN (1,2)");
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
            // return $this->db->get('pengeluaran');
            $this->db->from('pengeluaran');
            $this->db->order_by('no_pengeluaran', 'desc');
            return $this->db->get();
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
        public function tampil_iuran_masuk($where = null){
            $this->db->select('warga.nik,warga.nama, pembayaran.no_pembayaran, pembayaran.pembayaran_bulan,pembayaran.nominal,pembayaran.tanggal');
            $this->db->from('warga');
            $this->db->join('pembayaran','warga.nik=pembayaran.nik');
            $this->db->order_by('no_pembayaran','desc');
            if ($where) {
                $this->db->where($where);
            }
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
          return $this->db->query("SELECT
              `no_pembayaran`,
              w.nik as nik,
              w.nama AS nama_warga,
              `tanggal`,
              (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Januari') AS bulan_januari,
              (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Februari') AS bulan_februari,
              (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Maret') AS bulan_maret,
              (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'April') AS bulan_april,
              (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Mei') AS bulan_mei,
              (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Juni') AS bulan_juni,
              (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Juli') AS bulan_juli,
              (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Agustus') AS bulan_agustus,
              (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'September') AS bulan_september,
              (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Oktober') AS bulan_oktober,
              (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'November') AS bulan_november,
              (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Desember') AS bulan_desember,
              jenis_warga,
              SUM(nominal) AS jumlah_iuran,
              tahun
          FROM `pembayaran` p
          JOIN warga w ON w.nik = p.nik
          GROUP BY p.nik");
        }

        public function tampilDataWarga($where){
            $query = "
            select * from warga where nik = $where";
            return $this->db->query($query);
        }

        public function tampilTarif($where){
            $query = "
            select * from tarif where jenis_iuran = '".$where."'";
            return $this->db->query($query);
        }

        public function tampilTahunPembayaran(){
            $query = "
            select distinct(tahun) from pembayaran";
            return $this->db->query($query);
        }

        public function tampil_iuran_perbulan_pertahun($where){
            return $this->db->query("SELECT
                `no_pembayaran`,
                w.nik as nik,
                w.nama AS nama_warga,
                `tanggal`,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Januari' and tahun = $where) AS bulan_januari,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Februari' and tahun = $where) AS bulan_februari,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Maret' and tahun = $where) AS bulan_maret,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'April' and tahun = $where) AS bulan_april,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Mei' and tahun = $where) AS bulan_mei,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Juni' and tahun = $where) AS bulan_juni,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Juli' and tahun = $where) AS bulan_juli,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Agustus' and tahun = $where) AS bulan_agustus,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'September' and tahun = $where) AS bulan_september,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Oktober' and tahun = $where) AS bulan_oktober,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'November' and tahun = $where) AS bulan_november,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Desember' and tahun = $where) AS bulan_desember,
                jenis_warga,
                SUM(nominal) AS jumlah_iuran,
                tahun
            FROM `pembayaran` p
            JOIN warga w ON w.nik = p.nik
            GROUP BY p.nik");
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
        public function getJumlahPembayaran()
    {
                        // $this->db->from('data_barang d');
                        // $this->db->join('aktivitas_barang b', 'd.kodebarang=b.kodebarang');
                        // $this->db->join('data_supplier t', 'b.kodesupplier=t.kodesupplier');

        // $query = $this->db->get();
        // return $query = $this->db->get('aktivitas_barang',$number,$offset)->result();
                        //  $query = $this->db->get();
                        //     return $query->result();
        // print_r($pengadaan);die();
        $from=$this->input->post('from');
        $end=$this->input->post('end');

        $hasil=$this->db->query("SELECT
        warga.nik,
        warga.nama,
        pembayaran.no_pembayaran,
        pembayaran.pembayaran_bulan,
        pembayaran.nominal,
        pembayaran.tanggal
        FROM
        warga JOIN pembayaran ON
        warga.nik=pembayaran.nik
        WHERE(pembayaran.tanggal BETWEEN '$from' AND '$end')
        ORDER BY no_pembayaran
        ")->result();

        return $hasil;
    }


    }

    /* End of file M_admin.php */

?>
