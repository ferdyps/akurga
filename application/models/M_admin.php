<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class m_admin extends CI_Model {

      // ======================== GET ID otomatis ================================
      public function get_id_adapt($input,$table,$rt) {
        if (date("m") == '01') {
          $bln = 'I';
        }elseif (date("m") == '02') {
          $bln = 'II';
        }elseif (date("m") == '03') {
          $bln = 'III';
        }elseif (date("m") == '04') {
          $bln = 'IV';
        }elseif (date("m") == '05') {
          $bln = 'V';
        }elseif (date("m") == '06') {
          $bln = 'VI';
        }elseif (date("m") == '07') {
          $bln = 'VII';
        }elseif (date("m") == '08') {
          $bln = 'VIII';
        }elseif (date("m") == '09') {
          $bln = 'IX';
        }elseif (date("m") == '10') {
          $bln = 'X';
        }elseif (date("m") == '11') {
          $bln = 'XI';
        }elseif (date("m") == '12') {
          $bln = 'XII';
        }

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

        if ($input == 'surat_pengantar') {
          $Char = '-SK-'.$romawi.'-'.$bln.'-'.date("Y");
          $Char2 = '-SK-'.$romawi;
          $atr = 'nomor_surat';
        }elseif ($input == 'komplain') {
          $Char = "-KOMPLAIN-".$romawi."-".date("Y");
          $Char2 = '-KOMPLAIN-'.$romawi;
          $atr = 'nomor_komplain';
        }else {
          echo "Erorr id";
        }

        $this->db->where('rt', $rt);
        $this->db->like( $atr, $Char2, 'both');
        $query = $this->db->get($table)->num_rows();
        // $Kode= $query->num_rows();
          // $noUrut=(int)substr($Kode, 1, 4);
          $query++;

          $newID = sprintf("%03s", $query) . $Char; //. $rtnya
          return $newID;

      }

      public function get_id_adapt_sekre($input,$table,$rt){
        if (date("m") == '01') {
          $bln = 'I';
        }elseif (date("m") == '02') {
          $bln = 'II';
        }elseif (date("m") == '03') {
          $bln = 'III';
        }elseif (date("m") == '04') {
          $bln = 'IV';
        }elseif (date("m") == '05') {
          $bln = 'V';
        }elseif (date("m") == '06') {
          $bln = 'VI';
        }elseif (date("m") == '07') {
          $bln = 'VII';
        }elseif (date("m") == '08') {
          $bln = 'VIII';
        }elseif (date("m") == '09') {
          $bln = 'IX';
        }elseif (date("m") == '10') {
          $bln = 'X';
        }elseif (date("m") == '11') {
          $bln = 'XI';
        }elseif (date("m") == '12') {
          $bln = 'XII';
        }
        if ($rt == 'RT 01') {
          $rt_convert = 'RT.01';
        }elseif ($rt == 'RT 02') {
          $rt_convert = 'RT.02';
        }elseif ($rt == 'RT 03') {
          $rt_convert = 'RT.03';
        }elseif ($rt == 'RT 04') {
          $rt_convert = 'RT.04';
        }elseif ($rt == 'RT 05') {
          $rt_convert = 'RT.05';
        }elseif ($rt == 'RW 01') {
          $rt_convert = 'RW.01';
        }

        if ($input == 'rapat') {
          $Char = "-RPT-".$rt_convert.'-'.$bln.'-'.date("Y");
          $Char2 = '-RPT-'.$rt_convert;
          $atr = 'no_udg';
        }elseif ($input == 'kegiatan') {
          $Char = "-KGT-".$rt_convert.'-'.$bln.'-'.date("Y");
          $Char2 = '-KGT-'.$rt_convert;
          $atr = 'no_udg';
        }elseif ($input == 'notulensi') {
          $Char = "-NOT-".$rt_convert.'-'.$bln.'-'.date("Y");
          $Char2 = '-NOT-'.$rt_convert;
          $atr = 'no_notulen';
        }elseif ($input == 'arsip') {
          $Char = "-ASM-".$rt_convert.'-'.$bln.'-'.date("Y");
          $Char2 = '-ASM-'.$rt_convert;
          $atr = 'kd_surat';
        }else {
          echo "Erorr id";
        }

        $this->db->where('rt', $rt);
        $this->db->like( $atr, $Char2, 'both');
        $query = $this->db->get($table)->num_rows();
        // $Kode= $query->num_rows();
          // $noUrut=(int)substr($Kode, 1, 4);
          $query++;

          $newID = sprintf("%03s", $query) . $Char; //. $rtnya
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

        public function selectWithWhereOrder($table,$where,$orderby,$direction){
            $this->db->where($where);
            $this->db->order_by($orderby,$direction);
            return $this->db->get($table);
        }

        public function delete_data($where, $table){
           $this->db->where($where);
           $this->db->delete($table);
       }

        public function CountData($table, $where){
            $this->db->select('COUNT(*) AS total');
            $this->db->where($where);
            return $this->db->get($table);
        }

        public function notifikasi_jam_udg($where){
            $this->db->select('*');
            $this->db->where($where);
            $this->db->order_by('notif_id', 'DESC');
            $this->db->limit(2);
            return $this->db->get('notifikasi');
        }

        public function get_detail_notulensi($id)
        {
          $this->db->select('surat_undangan.acara_udg, surat_undangan.tujuan_surat, surat_undangan.tgl_udg, surat_undangan.jam_udg, surat_undangan.tempat_udg, notulensi_rpt.no_notulen, notulensi_rpt.no_udg, notulensi_rpt.dokumentasi_rpt, notulensi_rpt.keterangan_dokumentasi,  notulensi_rpt.uraian_notulen, notulensi_rpt.uraian_notulen_cetak, notulensi_rpt.penulis, notulensi_rpt.rt, notulensi_rpt.tembusan, notulensi_rpt.tgl_buat');
          $this->db->from('surat_undangan');
          $this->db->join('notulensi_rpt', 'surat_undangan.no_udg = notulensi_rpt.no_udg');
          $this->db->where('notulensi_rpt.no_notulen', $id);
          return $this->db->get();
        }
        // ================================ sekretaris khusus ==============================
        public function cek_ketua($data){
          $this->db->select('warga.nama, warga.jk');
          $this->db->from('user');
          $this->db->join('warga', 'user.id_user = warga.id_user');
          $this->db->where($data);
          return $this->db->get();
        }
        // ============================================================
        // ==========================RW==================================
        public function tindakLanjutRW(){
          return $this->db->query("SELECT id_tindak_lanjut,hasil_tindak_lanjut,tgl_tindak_lanjut,tl.nomor_komplain,tl.gambar,lingkup
          FROM tindak_lanjut tl JOIN komplain k
          ON tl.nomor_komplain=k.nomor_komplain
          WHERE lingkup = 'rw'
          ORDER BY id_tindak_lanjut DESC");
        }

        // ==========================RW==================================
        // ==========================RT==================================
        public function tindakLanjutRT($rt){
          return $this->db->query("SELECT id_tindak_lanjut,hasil_tindak_lanjut,tgl_tindak_lanjut,tl.nomor_komplain,tl.gambar,lingkup,rt
          FROM tindak_lanjut tl JOIN komplain k
          ON tl.nomor_komplain=k.nomor_komplain
          WHERE lingkup = 'rt' AND rt = '$rt'
          ORDER BY id_tindak_lanjut DESC");
        }
        // ==========================RT==================================


        public function list_surat_pengantar($rt)
        {
            return $this->db->query("SELECT sp.*,w.nama,w.rt,
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
            JOIN warga w ON w.nik=sp.nik
            WHERE w.rt='$rt'
            ORDER BY nomor_surat DESC");
        }

        // public function notif_sp($rt){
        //   return $this->db->query("SELECT COUNT(sp.nomor_surat) AS total,sp.rt,
        //   (
        //       SELECT status
        //       FROM status_surat ss
        //       WHERE ss.nomor_surat = sp.nomor_surat
        //       ORDER BY created_at DESC
        //       LIMIT 1
        //   ) as status
        //   FROM surat_pengantar sp
        //   WHERE sp.rt= '$rt'
        //   HAVING status = 'pengajuan'");
        // }
        public function notif_sp($rt){
          return $this->db->query("SELECT sp.nomor_surat,sp.rt,
          (
              SELECT status
              FROM status_surat ss
              WHERE ss.nomor_surat = sp.nomor_surat
              ORDER BY created_at DESC
              LIMIT 1
          ) as status
          FROM surat_pengantar sp
          WHERE sp.rt= '$rt'
          HAVING status = 'pengajuan'");
        }

        public function list_cetak_sp()
        {
            return $this->db->query("SELECT w.nik, nama, sp.nomor_surat, keperluan, ss.STATUS, ss.expired_date
            FROM surat_pengantar sp
            JOIN warga w ON w.nik=sp.nik
            JOIN status_surat ss ON sp.nomor_surat = ss.nomor_surat
            WHERE ss.STATUS='diterima'
            ORDER BY nomor_surat DESC");
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
        public function grafikPendidikanRT($rt){
            $this->db->select('COUNT(nik) as total, pendidikan');
            $this->db->where('rt',$rt);
            $this->db->group_by('pendidikan');
            return $this->db->get('warga');
        }

        public function grafikPekerjaan(){
            $this->db->select('COUNT(nik) as total, pekerjaan');
            $this->db->group_by('pekerjaan');
            return $this->db->get('warga');
        }
        public function grafikPekerjaanRT($rt){
            $this->db->select('COUNT(nik) as total, pekerjaan');
            $this->db->where('rt',$rt);
            $this->db->group_by('pekerjaan');
            return $this->db->get('warga');
        }

        public function grafikJumlahWargaPerRT(){
            $this->db->select('COUNT(nik) as total, rt');
            $this->db->group_by('rt');
            return $this->db->get('warga');
        }
        public function grafikWarga($rt){
            $this->db->select('COUNT(nik) as total, jk');
            $this->db->where('rt',$rt);
            $this->db->group_by('jk');
            return $this->db->get('warga');
        }

        public function grafikAgama(){
          $this->db->select('COUNT(nik) as total, agama');
          $this->db->group_by('agama');
          return $this->db->get('warga');
        }

        public function grafikAgamaRT($rt){
          $this->db->select('COUNT(nik) as total, agama');
          $this->db->where('rt',$rt);
          $this->db->group_by('agama');
          return $this->db->get('warga');
        }

        public function grafikStatus(){
          $this->db->select('COUNT(nik) as total, status');
          $this->db->group_by('status');
          return $this->db->get('warga');
        }

        public function grafikStatusRT($rt){
          $this->db->select('COUNT(nik) as total, status');
          $this->db->where('rt',$rt);
          $this->db->group_by('status');
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

        public function komplainJoinWargaRT($rt){
            return $this->db->query("SELECT nomor_komplain,w.nik,nama,w.rt,keluhan,lokasi,tanggal_komplain,lingkup,k.status,k.gambar
            FROM komplain k JOIN warga w
            ON w.nik=k.nik
            where lingkup='rt' and w.rt='$rt'
            ORDER BY nomor_komplain DESC");
        }

        public function komplainJoinWargaRW(){
            return $this->db->query("SELECT nomor_komplain,w.nik,nama,keluhan,lokasi,tanggal_komplain,lingkup,k.status,k.gambar
            FROM komplain k
            JOIN warga w
            ON w.nik=k.nik
            where lingkup='rw'
            ORDER BY nomor_komplain DESC");
        }

        public function riwayatSuratPengantar($id_user){
            return $this->db->query("SELECT u.id_user,sp.nomor_surat,sp.keperluan, ss.status, ss.created_at, ss.pesan
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
public function tampil_iuran_keluar($rt,$bulan='',$tahun=''){
$dataquery = "SELECT
  pengeluaran.no_pengeluaran,
  pengeluaran.diberikan_kepada,
  pengeluaran.nominal,
  pengeluaran.digunakan_untuk,
  pengeluaran.tanggal,
  pengeluaran.nominal,
  pengeluaran.gambar,
  pengeluaran.id_user from pengeluaran
  join warga on pengeluaran.id_user=warga.id_user";

  if($tahun != null){
    $where = "where warga.rt = $rt and
    date_format(pengeluaran.tanggal,'%m') = '$bulan'
    and
    date_format(pengeluaran.tanggal,'%Y') = '$tahun'
    order by no_pengeluaran desc";

    $query = $dataquery." ".$where;
  }else{
    $where = "where warga.rt = $rt order by no_pengeluaran desc";

    $query = $dataquery." ".$where;
  }

  return $this->db->query($query);
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
public function edit_data_tarif($where,$table){
return $this->db->get_where($table,$where);
}
function update_data($where,$data,$table){
  $this->db->where($where);
  $this->db->update($table,$data);
}
public function isi_data_iuran_masuk($dataiuranmasuk){
  return $this->db->insert('pembayaran',$dataiuranmasuk);
}
public function tampil_iuran_masuk($rt,$bulan='',$tahun=''){

  $dataquery = "SELECT
    warga.no_rumah,
    pembayaran.no_pembayaran,
    pembayaran.nominal,
    pembayaran.pembayaran_bulan,
    pembayaran.tanggal,
    pembayaran.tahun
    from pembayaran
    join warga on pembayaran.no_rumah=warga.no_rumah";

    if($tahun != null){
      $where = "where warga.rt = $rt and
      date_format(pembayaran.tanggal,'%m') = '$bulan'
      and
      date_format(pembayaran.tanggal,'%Y') = '$tahun'
      order by no_pembayaran desc";

      $query = $dataquery." ".$where;
    }else{
      $where = "where warga.rt = $rt";

      $query = $dataquery." ".$where;
    }

    return $this->db->query($query);
}
public function view_detail_pembayaran($where,$table){
  return $this->db->get_where($table,$where);
}
public function view_detail_pengeluaran($where,$table){
  return $this->db->get_where($table,$where);
}
public function tampil_bulan_iuran($norumah){
  $this->db->where('no_rumah', $norumah);
  return $this->db->get('pembayaran');
}

public function tampil_iuran_perbulan($rt){
  return $this->db->query("SELECT
    `no_pembayaran`,
    p.no_rumah,
    `tanggal`,
    jenis_warga,
    SUM(nominal) AS jumlah_iuran
    FROM `pembayaran` p
    JOIN warga w ON w.no_rumah = p.no_rumah
    Where w.rt = $rt
    GROUP BY p.no_rumah");
}
public function iuranmasuk($rt,$tahun=''){
  $selectmasuk = "(SELECT
    distinct(date_format(tanggal,'%m')) as 'bulan',
    date_format(tanggal,'%Y') as 'tahun'
    from pembayaran
    join warga on warga.no_rumah = pembayaran.no_rumah";
    if($tahun!=null){
      $where = "where date_format(tanggal,'%Y') = $tahun and warga.rt = $rt order by 1)";

      $querymasuk = $selectmasuk." ".$where;
    }else{
      $where = "where warga.rt = $rt order by 1)";

      $querymasuk = $selectmasuk." ".$where;
    }

    $selectkeluar = "(SELECT
    distinct(date_format(tanggal,'%m')) as 'bulan',
    date_format(tanggal,'%Y') as 'tahun'
    from pengeluaran
    join user on user.id_user=pengeluaran.id_user
    join warga on user.id_user=warga.id_user";
    if($tahun!=null){
      $where = "where date_format(tanggal,'%Y') = $tahun and warga.rt = $rt order by 1)";

      $querykeluar = $selectkeluar." ".$where;
    }else{
      $where = "where warga.rt = $rt order by 1)";
      $querykeluar = $selectkeluar." ".$where;
    }

    $query = $querymasuk." union ".$querykeluar;

    return $this->db->query($query);
}

public function filteriuranmasuk($bulan,$tahun,$rt){
  return $this->db->query("SELECT
    date_format(tanggal,'%m') as 'bulan',
    sum(nominal) as 'nominal'
    from pembayaran
    join warga on warga.no_rumah = pembayaran.no_rumah
    where date_format(tanggal,'%Y') = $tahun and date_format(tanggal,'%m') = $bulan and warga.rt = $rt
    group by 1");
}

public function filteriurankeluar($bulan,$tahun,$rt){
  return $this->db->query("SELECT
    date_format(tanggal,'%m') as bulan,
    sum(nominal) as nominal
    from pengeluaran
    join user on user.id_user=pengeluaran.id_user
    join warga on user.id_user=warga.id_user
    where date_format(tanggal,'%Y') = $tahun and date_format(tanggal,'%m') = $bulan and warga.rt = $rt
    group by 1");
}


public function tampilDataWarga($norumah='',$rt=''){
if($norumah!=null){
  $query = "select distinct(no_rumah), jenis_warga from warga where no_rumah = $norumah and rt = $rt";
}else{
  $query = "
  select * from warga";
}
  return $this->db->query($query);
}

public function tampilTarif($where){
  $query = "
  select * from tarif where jenis_iuran = '".$where."' and status = 'Aktif' order by 1 desc LIMIT 1";
  return $this->db->query($query);
}

public function tampil_tarif(){
$query = "
select * from tarif order by 1 desc";
return $this->db->query($query);
}

public function tarifDetail($jenis, $tanggal)
{
$query = '
  SELECT *
  FROM `tarif`
  WHERE tanggal < "'.$tanggal.'"
  AND status = "Aktif"
  AND jenis_iuran = "'.$jenis.'"
  ORDER BY tanggal DESC
  LIMIT 1
';
return $this->db->query($query);
}

public function tampilTahunPembayaran(){
  $query = "
  select distinct(tahun) from pembayaran";
  return $this->db->query($query);
}

public function tampil_iuran_perbulan_pertahun($rt,$tahun){
  return $this->db->query("SELECT
      `no_pembayaran`,
      p.no_rumah,
      `tanggal`,
      (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Januari' and tahun = $tahun) AS bulan_januari,
      (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Februari' and tahun = $tahun) AS bulan_februari,
      (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Maret' and tahun = $tahun) AS bulan_maret,
      (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'April' and tahun = $tahun) AS bulan_april,
      (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Mei' and tahun = $tahun) AS bulan_mei,
      (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Juni' and tahun = $tahun) AS bulan_juni,
      (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Juli' and tahun = $tahun) AS bulan_juli,
      (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Agustus' and tahun = $tahun) AS bulan_agustus,
      (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'September' and tahun = $tahun) AS bulan_september,
      (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Oktober' and tahun = $tahun) AS bulan_oktober,
      (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'November' and tahun = $tahun) AS bulan_november,
      (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Desember' and tahun = $tahun) AS bulan_desember,
      jenis_warga,
      SUM(nominal) AS jumlah_iuran,
      tahun
  FROM `pembayaran` p
  LEFT OUTER JOIN warga w ON w.no_rumah = p.no_rumah
  WHERE w.rt = $rt and tahun = $tahun
  GROUP BY p.no_rumah");
}
public function detailBulan($norumah,$tahun){
$query = "
SELECT
    p.no_rumah,
    (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Januari' and tahun = $tahun) AS bulan_januari,
    (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Februari' and tahun = $tahun) AS bulan_februari,
    (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Maret' and tahun = $tahun) AS bulan_maret,
    (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'April' and tahun = $tahun) AS bulan_april,
    (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Mei' and tahun = $tahun) AS bulan_mei,
    (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Juni' and tahun = $tahun) AS bulan_juni,
    (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Juli' and tahun = $tahun) AS bulan_juli,
    (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Agustus' and tahun = $tahun) AS bulan_agustus,
    (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'September' and tahun = $tahun) AS bulan_september,
    (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Oktober' and tahun = $tahun) AS bulan_oktober,
    (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'November' and tahun = $tahun) AS bulan_november,
    (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Desember' and tahun = $tahun) AS bulan_desember
FROM `pembayaran` p
WHERE p.no_rumah = $norumah
GROUP BY p.no_rumah";
// $this->db->where("p.nik",$where);
return $this->db->query($query);
}

public function getTunggakanPerPeriode($bulan, $tahun, $jenis){
$tanggal = $tahun.'-'.$bulan.'-01';
$query ='
  SELECT *
  FROM `tarif`
  WHERE tanggal < "'.$tanggal.'"
  AND status = "Aktif"
  AND jenis_iuran = "'.$jenis.'"
  ORDER BY tanggal DESC
  LIMIT 1
';
return $this->db->query($query);
}

public function detail($norumah,$tahun){
  $query = "
  SELECT
      `no_pembayaran`,
      p.no_rumah,
      (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Januari' and tahun = $tahun) AS bulan_januari,
      (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Februari' and tahun = $tahun) AS bulan_februari,
      (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Maret' and tahun = $tahun) AS bulan_maret,
      (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'April' and tahun = $tahun) AS bulan_april,
      (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Mei' and tahun = $tahun) AS bulan_mei,
      (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Juni' and tahun = $tahun) AS bulan_juni,
      (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Juli' and tahun = $tahun) AS bulan_juli,
      (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Agustus' and tahun = $tahun) AS bulan_agustus,
      (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'September' and tahun = $tahun) AS bulan_september,
      (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Oktober' and tahun = $tahun) AS bulan_oktober,
      (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'November' and tahun = $tahun) AS bulan_november,
      (SELECT nominal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Desember' and tahun = $tahun) AS bulan_desember,

      (SELECT tanggal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Januari' and tahun = $tahun) AS tanggal_bulan_januari,
      (SELECT tanggal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Februari' and tahun = $tahun) AS tanggal_bulan_februari,
      (SELECT tanggal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Maret' and tahun = $tahun) AS tanggal_bulan_maret,
      (SELECT tanggal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'April' and tahun = $tahun) AS tanggal_bulan_april,
      (SELECT tanggal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Mei' and tahun = $tahun) AS tanggal_bulan_mei,
      (SELECT tanggal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Juni' and tahun = $tahun) AS tanggal_bulan_juni,
      (SELECT tanggal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Juli' and tahun = $tahun) AS tanggal_bulan_juli,
      (SELECT tanggal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Agustus' and tahun = $tahun) AS tanggal_bulan_agustus,
      (SELECT tanggal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'September' and tahun = $tahun) AS tanggal_bulan_september,
      (SELECT tanggal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Oktober' and tahun = $tahun) AS tanggal_bulan_oktober,
      (SELECT tanggal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'November' and tahun = $tahun) AS tanggal_bulan_november,
      (SELECT tanggal FROM pembayaran pb WHERE pb.no_rumah = p.no_rumah AND pembayaran_bulan = 'Desember' and tahun = $tahun) AS tanggal_bulan_desember,
      jenis_warga,
      SUM(nominal) AS jumlah_iuran
  FROM `pembayaran` p
  JOIN warga w ON w.no_rumah = p.no_rumah
  WHERE p.no_rumah = $norumah
  GROUP BY p.no_rumah
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
  JOIN warga ON warga.no_rumah = pembayaran.no_rumah
  GROUP BY pembayaran.no_rumah
  ";
  return $this->db->query($query);
}

public function getJumlahPembayaran(){
// print_r($pengadaan);die();
$from=$this->input->post('from');
$end=$this->input->post('end');
$rt = $this->session->userdata('rt');
$hasil=$this->db->query("SELECT
warga.nik,
warga.nama,
pembayaran.no_pembayaran,
pembayaran.no_rumah,
pembayaran.pembayaran_bulan,
pembayaran.nominal,
pembayaran.tanggal
FROM
warga JOIN pembayaran ON
warga.no_rumah=pembayaran.no_rumah
WHERE(pembayaran.tanggal BETWEEN '$from' AND '$end') and rt ='$rt'
ORDER BY no_pembayaran
")->result();

return $hasil;
}

public function getPakRT($rt){
$query = "
SELECT *
FROM user
JOIN warga ON warga.id_user = user.id_user
where user.role = 'Ketua RT' and warga.rt = $rt";
return $this->db->query($query);
}

public function getJumlahPengeluaran(){
// print_r($pengadaan);die();
$from=$this->input->post('from');
$end=$this->input->post('end');
$rt = $this->session->userdata('rt');
$hasil=$this->db->query("SELECT
pengeluaran.no_pengeluaran,
pengeluaran.diberikan_kepada,
pengeluaran.nominal,
pengeluaran.digunakan_untuk,
pengeluaran.tanggal,
pengeluaran.nominal,
pengeluaran.gambar,
pengeluaran.id_user
FROM
pengeluaran
JOIN warga ON pengeluaran.id_user=warga.id_user
WHERE(pengeluaran.tanggal BETWEEN '$from' AND '$end') and rt='$rt'
ORDER BY no_pengeluaran
")->result();

return $hasil;

}

public function datart(){
return $this->db->query("SELECT distinct(rt) as rt from warga");
}

public function grafikPengeluaran($rt){
$query = "SELECT
date_format(pengeluaran.tanggal,'%Y') as tahun,
sum(pengeluaran.nominal) as total from pengeluaran
join warga on pengeluaran.id_user=warga.id_user
where warga.rt = $rt group by 1";

return $this->db->query($query);
}

public function grafikPemasukan($rt){
$query = "SELECT
date_format(pembayaran.tanggal,'%Y') as tahun,
sum(pembayaran.nominal) as total from pembayaran
join warga on pembayaran.no_rumah=warga.no_rumah
where warga.rt = $rt group by 1";

return $this->db->query($query);
}

public function grafikPengeluaranPerbulanPertahun($rt,$bulan='',$tahun=''){
$dataquery = "SELECT
DATE_FORMAT(pengeluaran.tanggal, '%d-%m-%Y') as tanggal,
sum(pengeluaran.nominal) as total from pengeluaran
join warga on pengeluaran.id_user=warga.id_user";

if($tahun != null){
$where = "where warga.rt = $rt and
date_format(pengeluaran.tanggal,'%m') = '$bulan'

and
date_format(pengeluaran.tanggal,'%Y') = '$tahun'
group by 1
order by 1 desc";

$query = $dataquery." ".$where;
}else{
$where = "where warga.rt = $rt group by 1 order by 1 desc";

$query = $dataquery." ".$where;
}

return $this->db->query($query);
}

public function grafikPemasukanPerbulanPertahun($rt,$bulan='',$tahun=''){
$dataquery = "SELECT
DATE_FORMAT(pembayaran.tanggal, '%d-%m-%Y') as tanggal,
sum(pembayaran.nominal) as total from pembayaran
join warga on pembayaran.no_rumah=warga.no_rumah";

if($tahun != null){
$where = "where warga.rt = $rt and
date_format(pembayaran.tanggal,'%m') = '$bulan'
and
date_format(pembayaran.tanggal,'%Y') = '$tahun'
group by 1
order by 1 desc";

$query = $dataquery." ".$where;
}else{
$where = "where warga.rt = $rt group by 1 order by 1 desc";

$query = $dataquery." ".$where;
}

return $this->db->query($query);
}


}

    /* End of file M_admin.php */

?>
