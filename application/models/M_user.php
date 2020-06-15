<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class M_user extends CI_Model {

// data table server side ajax
var $table_notulensidisplay = "surat_undangan";
var $select_notulensidisplay = array("no_notulen", "dokumentasi_rpt", "notulensi_rpt.tgl_buat", "notulensi_rpt.no_udg", "acara_udg", "tgl_udg",);
var $order_notulensidisplay = array("notulensi_rpt.tgl_buat");
var $where_rt = 'notulensi_rpt.rt =';

var $table_rapatdisplay = "surat_undangan";
var $select_rapatdisplay = array("no_udg", "tgl_buat", "acara_udg", "tgl_udg",);
var $order_rapatdisplay = array("tgl_buat");
var $where_rt_rapatdisplay = 'rt =';
var $where_status = 'status =';


//ajax datatable notulensi display
function make_query_notulensidisplay()
{
  $this->db->select($this->select_notulensidisplay);
  $this->db->from($this->table_notulensidisplay);
  $this->db->join('notulensi_rpt', 'surat_undangan.no_udg = notulensi_rpt.no_udg');
  if(isset($_POST["search"]["value"]))
  {
    $this->db->like("notulensi_rpt.no_udg", $_POST["search"]["value"]);
  }
  if(isset($_POST["order"]))
  {
    $this->db->order_by($this->order_notulensidisplay[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
  }
  else
  {
    $this->db->order_by('notulensi_rpt.tgl_buat', 'DESC');
  }
}

function make_datatables_notulensidisplay($set_rt){
  $this->db->where($this->where_rt,$set_rt);
  $this->make_query_notulensidisplay();
  if($_POST["length"] != -1)
  {
    $this->db->limit($_POST['length'], $_POST['start']);
  }
  $query = $this->db->get();
  return $query->result();




}

function get_filtered_data_notulensidisplay($set_rt){
  $this->db->where($this->where_rt,$set_rt);
  $this->make_query_notulensidisplay();
  $query = $this->db->get();
  return $query->num_rows();
}

function get_all_data_notulensidisplay($set_rt)
{
  $this->db->select("*");
  $this->db->where($this->where_rt,$set_rt);
  $this->db->from($this->table_notulensidisplay);
  $this->db->join('notulensi_rpt', 'surat_undangan.no_udg = notulensi_rpt.no_udg');
  return $this->db->count_all_results();
}

//ajax datatable rapat display
function make_query_rapatdisplay()
{
  $this->db->select($this->select_rapatdisplay);
  $this->db->from($this->table_rapatdisplay);
  if(isset($_POST["search"]["value"]))
  {
    $this->db->like("no_udg", $_POST["search"]["value"]);
  }
  if(isset($_POST["order"]))
  {
    $this->db->order_by($this->order_rapatdisplay[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
  }
  else
  {
    $this->db->order_by('tgl_buat', 'DESC');
  }
}

function make_datatables_rapatdisplay($set_rt){
  $this->db->where($this->where_rt_rapatdisplay,$set_rt);
  $this->db->where($this->where_status,'1');
  $this->make_query_rapatdisplay();
  if($_POST["length"] != -1)
  {
    $this->db->limit($_POST['length'], $_POST['start']);
  }
  $query = $this->db->get();
  return $query->result();




}

function get_filtered_data_rapatdisplay($set_rt){
  $this->db->where($this->where_rt_rapatdisplay,$set_rt);
  $this->db->where($this->where_status,'1');
  $this->make_query_rapatdisplay();
  $query = $this->db->get();
  return $query->num_rows();
}

function get_all_data_rapatdisplay($set_rt)
{
  $this->db->select("*");
  $this->db->where($this->where_rt_rapatdisplay,$set_rt);
  $this->db->where($this->where_status,'1');
  $this->db->from($this->table_rapatdisplay);
  return $this->db->count_all_results();
}

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
          $this->db->select('surat_undangan.acara_udg, surat_undangan.tujuan_surat, surat_undangan.tgl_udg, surat_undangan.jam_udg, surat_undangan.tempat_udg, notulensi_rpt.no_notulen, notulensi_rpt.no_udg, notulensi_rpt.dokumentasi_rpt, notulensi_rpt.keterangan_dokumentasi,  notulensi_rpt.uraian_notulen, notulensi_rpt.penulis, notulensi_rpt.rt, notulensi_rpt.tembusan, notulensi_rpt.tgl_buat');
          $this->db->from('surat_undangan');
          $this->db->join('notulensi_rpt', 'surat_undangan.no_udg = notulensi_rpt.no_udg');
          $this->db->where($array_data);
          return $this->db->get();
        }

        public function tampil_iuran_perbulan($id_user){
            return $this->db->query("SELECT
              `no_pembayaran`,
              w.nik as nik,
              w.nama AS nama_warga,
              `tanggal`,
              jenis_warga,
              SUM(nominal) AS jumlah_iuran
              FROM `pembayaran` p
              JOIN warga w ON w.nik = p.nik
              JOIN user u ON u.id_user = w.id_user
              WHERE u.id_user = $id_user
              GROUP BY p.nik");
          }
          public function tampil_iuran_perbulan_pertahun($tahun,$id_user){
            return $this->db->query("SELECT
                `no_pembayaran`,
                w.nik as nik,
                w.nama AS nama_warga,
                `tanggal`,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Januari' and tahun = $tahun and u.id_user = $id_user) AS bulan_januari,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Februari' and tahun = $tahun and u.id_user = $id_user) AS bulan_februari,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Maret' and tahun = $tahun and u.id_user = $id_user) AS bulan_maret,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'April' and tahun = $tahun and u.id_user = $id_user) AS bulan_april,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Mei' and tahun = $tahun and u.id_user = $id_user) AS bulan_mei,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Juni' and tahun = $tahun and u.id_user = $id_user) AS bulan_juni,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Juli' and tahun = $tahun and u.id_user = $id_user) AS bulan_juli,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Agustus' and tahun = $tahun and u.id_user = $id_user) AS bulan_agustus,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'September' and tahun = $tahun and u.id_user = $id_user) AS bulan_september,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Oktober' and tahun = $tahun and u.id_user = $id_user) AS bulan_oktober,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'November' and tahun = $tahun and u.id_user = $id_user) AS bulan_november,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Desember' and tahun = $tahun and u.id_user = $id_user) AS bulan_desember,
                jenis_warga,
                SUM(nominal) AS jumlah_iuran,
                tahun
            FROM `pembayaran` p
            LEFT OUTER JOIN warga w ON w.nik = p.nik
            JOIN user u ON u.id_user = w.id_user
            where tahun = $tahun and u.id_user = $id_user
            GROUP BY p.nik");
        }
        public function tampil_iuran_keluar(){
            // return $this->db->get('pengeluaran');
            $this->db->from('pengeluaran');
            $this->db->order_by('no_pengeluaran', 'desc');
            return $this->db->get();
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
        public function detail($nik,$tahun){
            $query = "
            SELECT
                `no_pembayaran`,
                w.nik as nik,
                w.nama AS nama_warga,

                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Januari' and tahun = $tahun) AS bulan_januari,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Februari' and tahun = $tahun) AS bulan_februari,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Maret' and tahun = $tahun) AS bulan_maret,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'April' and tahun = $tahun) AS bulan_april,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Mei' and tahun = $tahun) AS bulan_mei,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Juni' and tahun = $tahun) AS bulan_juni,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Juli' and tahun = $tahun) AS bulan_juli,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Agustus' and tahun = $tahun) AS bulan_agustus,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'September' and tahun = $tahun) AS bulan_september,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Oktober' and tahun = $tahun) AS bulan_oktober,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'November' and tahun = $tahun) AS bulan_november,
                (SELECT nominal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Desember' and tahun = $tahun) AS bulan_desember,

                (SELECT tanggal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Januari' and tahun = $tahun) AS tanggal_bulan_januari,
                (SELECT tanggal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Februari' and tahun = $tahun) AS tanggal_bulan_februari,
                (SELECT tanggal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Maret' and tahun = $tahun) AS tanggal_bulan_maret,
                (SELECT tanggal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'April' and tahun = $tahun) AS tanggal_bulan_april,
                (SELECT tanggal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Mei' and tahun = $tahun) AS tanggal_bulan_mei,
                (SELECT tanggal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Juni' and tahun = $tahun) AS tanggal_bulan_juni,
                (SELECT tanggal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Juli' and tahun = $tahun) AS tanggal_bulan_juli,
                (SELECT tanggal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Agustus' and tahun = $tahun) AS tanggal_bulan_agustus,
                (SELECT tanggal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'September' and tahun = $tahun) AS tanggal_bulan_september,
                (SELECT tanggal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Oktober' and tahun = $tahun) AS tanggal_bulan_oktober,
                (SELECT tanggal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'November' and tahun = $tahun) AS tanggal_bulan_november,
                (SELECT tanggal FROM pembayaran pb WHERE pb.nik = p.nik AND pembayaran_bulan = 'Desember' and tahun = $tahun) AS tanggal_bulan_desember,


                jenis_warga,
                SUM(nominal) AS jumlah_iuran
            FROM `pembayaran` p
            JOIN warga w ON w.nik = p.nik
            WHERE p.nik = $nik
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

    /* End of file M_user.php */
