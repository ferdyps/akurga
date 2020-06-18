<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sekretaris extends CI_Controller {
  public $id_user;
  public $role;
  public $rt;
  public $nama;
  public function __construct(){
    parent::__construct();
    $this->load->model('m_admin');
    $this->load->library('form_validation');
    $this->load->library('pdf');
    $this->load->library('session');

    $this->id_user = $this->session->userdata('id_user');
    $this->role = $this->session->userdata('role');
    $this->rt = $this->session->userdata('rt');
    $this->nama = $this->session->userdata('nama');

    if(!$this->session->has_userdata('status')){
      redirect('auth/','refresh');
    } else {
      if ($this->session->userdata('role') == 'Warga') {
        redirect('user/','refresh');
      }
    }
  }
  // Untuk Front-end

  public function index(){
    if ($this->role == 'Sekretaris RT') {
      $rt = $this->rt;
      $dataPoints = array();
      $dataPoints2 = array();
      $dataPoints3 = array();
      $query = $this->m_admin->CountData('warga','valid',0)->result_array();
      $result = $this->m_admin->grafikPendidikanRT($rt)->result();
      $result2 = $this->m_admin->grafikPekerjaanRT($rt)->result();
      $result3 = $this->m_admin->grafikWarga($rt)->result();

      // $tampil_iuran = $this->m_admin->tampil_iuran_keluar($rt)->result_array();
      foreach ($result as $row) {
        array_push($dataPoints, array('label' => $row->pendidikan, 'y' => $row->total));
      }
      foreach ($result2 as $row) {
        array_push($dataPoints2, array('label' => $row->pekerjaan, 'y' => $row->total));
      }
      foreach ($result3 as $row) {
        array_push($dataPoints3, array('label' => $row->jk, 'y' => $row->total));
      }
      $tampil_iuran = $this->m_admin->tampil_iuran_keluar($rt)->result_array();
      $data = [
        'content'       => 'admin/dashboardRT',
        'title'         => 'Dashboard',
        'semuaWarga'    => $query,
        'dataPoints'    => $dataPoints,
        'dataPoints2'   => $dataPoints2,
        'dataPoints3'   => $dataPoints3,
        'dataiurank'    => $tampil_iuran,
        'rt' => $rt,
        'nama' => $this->nama
      ];
      $this->load->view('admin/index', $data);

    }elseif ($this->role == 'Sekretaris RW') {
      $dataPoints = array();
      $dataPoints2 = array();
      $dataPoints3 = array();
      $query = $this->m_admin->CountData('warga','valid',0)->result_array();
      $result = $this->m_admin->grafikPendidikan()->result();
      $result2 = $this->m_admin->grafikPekerjaan()->result();
      $result3 = $this->m_admin->grafikJumlahWargaPerRT()->result();
      foreach ($result as $row) {
        array_push($dataPoints, array('label' => $row->pendidikan, 'y' => $row->total));
      }
      foreach ($result2 as $row) {
        array_push($dataPoints2, array('label' => $row->pekerjaan, 'y' => $row->total));
      }
      foreach ($result3 as $row) {
        array_push($dataPoints3, array('label' => $row->rt, 'y' => $row->total));
      }
      $data = [
        'content'       => 'admin/dashboardRW',
        'title'         => 'Dashboard',
        'semuaWarga'    => $query,
        'dataPoints'    => $dataPoints,
        'dataPoints2'   => $dataPoints2,
        'dataPoints3'   => $dataPoints3,
        'dataiurank'    => $this->m_admin->tampil_iuran_keluar($this->rt)->result_array()
      ];
      $this->load->view('admin/index', $data);
    }

  }



  // ==========================================================================
  // ==========================================================================
  // Sekretaris
  // ==========================================================================


  public function inputundanganrapat(){
    $id         = 'rapat';
    $id2        = 'kegiatan';
    $nama_field = 'no_udg';
    $nama_tabel = 'surat_undangan';
    $key        = $this->uri->segment(3);

    if ($this->role == 'Sekretaris RT') {
      $set_rt = 'RT '.$this->rt;
    }elseif ($this->role == 'Sekretaris RW') {
      $set_rt = 'RW 01';
    }

    $valid      = array(
      'no_udg' => $key,
      'rt' => $set_rt
    );

    $fetch      = $this->m_admin->selectWithWhere('surat_undangan', $valid)->result_array();
    $data['fetch'] = $fetch;
    $data['content'] = 'admin/v_undangan_rpt';
    $data['title'] = 'Input Surat Undangan Kegiatan';
    $this->load->view('admin/index', $data);
  }

  public function inputundangankegiatan(){
    $id         = 'rapat';
    $id2        = 'kegiatan';
    $nama_field = 'no_udg';
    $nama_tabel = 'surat_undangan';
    $key        = $this->uri->segment(3);

    if ($this->role == 'Sekretaris RT') {
      $set_rt = 'RT '.$this->rt;
    }elseif ($this->role == 'Sekretaris RW') {
      $set_rt = 'RW 01';
    }

    $valid      = array(
      'no_udg' => $key,
      'rt' => $set_rt
    );

    $fetch      = $this->m_admin->selectWithWhere('surat_undangan', $valid)->result_array();
    $data['fetch'] = $fetch;
    $data['content'] = 'admin/v_undangan_kgt';
    $data['title'] = 'Input Surat Undangan Kegiatan';
    $this->load->view('admin/index', $data);
  }

  public function inputnotulensi(){
    $id           = 'notulensi';
    $nama_field   = 'no_notulen';
    $nama_tabel   = 'notulensi_rpt';
    $key          = $this->uri->segment(3);

    $array_check  = array('no_udg' => $key );
    $db_check     = $this->m_admin->selectWithWhere($nama_tabel, $array_check);
    if ($db_check->num_rows() > 0) {
      $data_notulen_check = $db_check->result_array();
      foreach ($data_notulen_check as $data_check) {
      $this->session->set_flashdata('success','Silahkan Lihat di Riwayat Notulensi Rapat Nomor '.$data_check['no_notulen']);
      }
      redirect('sekretaris/riwayat_Undangan','refresh');

      echo json_encode($json);
    }else {
      if ($this->role == 'Sekretaris RT') {
        $set_rt = 'RT '.$this->rt;
      }elseif ($this->role == 'Sekretaris RW') {
        $set_rt = 'RW 01';
      }

      $data['key_no_udg'] = $key;
      $data['generate_id'] = $this->m_admin->get_id_adapt_sekre($id,$nama_tabel,$set_rt); //$this->session->userdata('jabatan')
      $data['content'] = 'admin/v_notulensi';
      $data['title'] = 'Input Notulensi Rapat';
      $this->load->view('admin/index', $data);
    }

  }

  public function input_arsipsurat(){
    $id         = 'arsip';
    $nama_field = 'kd_surat';
    $nama_tabel = 'arsip_surat';

    if ($this->role == 'Sekretaris RT') {
      $set_rt = 'RT '.$this->rt;
    }elseif ($this->role == 'Sekretaris RW') {
      $set_rt = 'RW 01';
    }

    $data['generate_id'] = $this->m_admin->get_id_adapt_sekre($id,$nama_tabel,$set_rt); //$this->session->userdata('jabatan')
    $data['content'] = 'admin/v_arsip_surat';
    $data['title'] = 'Input Arsip Surat';
    $this->load->view('admin/index', $data);
  }

  public function gambar_arsip()
  {
    $id     = $this->uri->segment(3);
    $no     = array('kd_surat' => $id );
    $surat  = $this->m_admin->selectWithWhere('arsip_surat', $no)->result_array();
    $data['fetch'] = $surat;
    $data['title'] = 'Detail Gambar Surat';
    $this->load->view('admin/v_gambar_arsip', $data);
  }



  public function notulensi_rapat(){

    $id     = $this->uri->segment(3);
    $surat  = $this->m_admin->get_detail_notulensi($id)->result_array();
    $data['fetch'] = $surat;
    $data['title'] = 'Notulensi Rapat';
    $this->load->view('admin/v_notulensi_rapat', $data);
  }

  public function riwayat_Undangan(){
    if ($this->role == 'Sekretaris RT') {
      $set_rt = 'RT '.$this->rt;
    }elseif ($this->role == 'Sekretaris RW') {
      $set_rt = 'RW 01';
    }
    $id = array(
      'status' => 1,
      'rt'     => $set_rt
    );
    $data['list_surat_udg'] = $this->m_admin->selectWithWhere('surat_undangan',$id)->result_array();
    $data['content'] = 'admin/tabel_undangan';
    $data['title'] = 'Riwayat Surat Undangan';
    $this->load->view('admin/index', $data);
  }

  public function riwayat_notulensi(){
    if ($this->role == 'Sekretaris RT') {
      $set_rt = 'RT '.$this->rt;
    }elseif ($this->role == 'Sekretaris RW') {
      $set_rt = 'RW 01';
    }

    $rt = array(
      'rt'     => $set_rt,
      'status' => 0
    );
    $data['list_notulen'] = $this->m_admin->selectWithWhere('notulensi_rpt',$rt)->result_array();
    $data['content'] = 'admin/tabel_notulensi';
    $data['title'] = 'Riwayat Notulensi Rapat';
    $this->load->view('admin/index', $data);
  }

  public function riwayat_arsip(){
    if ($this->role == 'Sekretaris RT') {
      $set_rt = 'RT '.$this->rt;
    }elseif ($this->role == 'Sekretaris RW') {
      $set_rt = 'RW 01';
    }

    $rt = array(
      'rt'     => $set_rt
    );

    $data['list_arsip'] = $this->m_admin->selectWithWhere('arsip_surat',$rt)->result_array();
    $data['content'] = 'admin/tabel_arsip';
    $data['title'] = 'Riwayat Arsip Surat';
    $this->load->view('admin/index', $data);

  }

  public function dokumentasi_rapat()
  {
    $id     = $this->uri->segment(3);
    $no     = array('no_notulen' => $id );
    $surat  = $this->m_admin->selectWithWhere('notulensi_rpt', $no)->result_array();
    $data['fetch'] = $surat;
    $data['title'] = 'View Dokumentasi Rapat';
    $this->load->view('admin/v_dokumentasi_rapat', $data);
  }

  public function dokumentasi_presensi()
  {
    $id     = $this->uri->segment(3);
    $no     = array('no_notulen' => $id );
    $surat  = $this->m_admin->selectWithWhere('notulensi_rpt', $no)->result_array();
    $data['fetch'] = $surat;
    $data['title'] = 'View Presensi Warga';
    $this->load->view('admin/v_dokumentasi_presensi', $data);
  }

  public function cetak_undangan()
  {
    $id     = $this->uri->segment(3);
    $no     = array('no_udg' => $id );

    if ($this->role == 'Sekretaris RT') {
      $set_rt   = 'tetangga '.$this->rt;
      $set_rt2  = 'rt '.$this->rt;
      $ketua  = array(
        'role' => 'Ketua RT',
        'rt'   => $this->rt
      );
    }elseif ($this->role == 'Sekretaris RW') {
      $set_rt = 'warga 01';
      $set_rt2  = 'rw 01';
      $ketua  = array(
        'role' => 'Ketua RW'
      );
    }else {
      redirect('auth/logout','refresh');
    }

    $surat  = $this->m_admin->selectWithWhere('surat_undangan', $no)->result_array();
    $ketua_rt  = $this->m_admin->cek_ketua($ketua)->result_array();

    setlocale(LC_ALL, 'IND');

    $pdf = new FPDF('P','mm','A4');
    // membuat halaman baru
    $pdf->AddPage();

    foreach ($surat as $row) {
      // setting jenis font yang akan digunakan
      $pdf->SetFont('Arial','B',16);
      // mencetak string
      $pdf->Cell(190,7,'RUKUN '.strtoupper($set_rt),0,1,'C');
      $pdf->SetFont('Arial','B',12);

      if ($this->role == 'Sekretaris RT') {
        $pdf->Cell(190,7,'RUKUN WARGA 01',0,1,'C');
      }elseif ($this->role == 'Sekretaris RW') {

      }

      $pdf->Cell(190,7,'DESA SUKAPURA KECAMATAN DAYEUHKOLOT',0,1,'C');
      $pdf->Cell(190,7,'KABUPATEN BANDUNG',0,1,'C');
      if ($this->role == 'Sekretaris RT') {
        $pdf->Line(10,40,200,40);
      }elseif ($this->role == 'Sekretaris RW') {
        $pdf->Line(10,33,200,33);
      }
      $pdf->Ln(1.4);
      $pdf->SetFont('Arial','',12);
      $pdf->Cell(190,7,'Sekretariat : Manggadua RT. ' .$this->rt. ' RW. 01 Desa Sukapura Kec. Dayeuhkolot Kab. Bandung -  40267',0,1,'C');
      $pdf->SetLineWidth(1);
      if ($this->role == 'Sekretaris RT') {
        $pdf->Line(10,46,200,46);
      }elseif ($this->role == 'Sekretaris RW') {
        $pdf->Line(10,40,200,40);
      }
      $pdf->Ln(12);
      $pdf->Cell(17);
      $pdf->Cell(5,5,'Nomor',0,0,'L');
      $pdf->Cell(25);
      $pdf->Cell(5,5,':',0,0,'L');
      $pdf->Cell(5,5,str_replace('-','/',$row['no_udg']),0,0,'L');
      $pdf->Cell(60);
      $pdf->Cell(5,5,'Bandung,',0,0,'L');
      $pdf->Cell(15);
      $tgl_buat = strftime("%d %B %Y",strtotime($row['tgl_buat']));
      $pdf->Cell(5,5,$tgl_buat,0,1,'L');
      $pdf->Ln(1);
      $pdf->Cell(17);
      $pdf->Cell(5,5,'Lampiran',0,0,'L');
      $pdf->Cell(25);
      $pdf->Cell(5,5,':',0,0,'L');
      if ($row['lampiran_udg'] == '_') {
        $lampir = '-';
        $pdf->MultiCell(60,5,$lampir,0,'L');
      }else {
        $pdf->MultiCell(60,5,$row['lampiran_udg'],0,'L');
      }

      $pdf->Ln(1);
      $pdf->Cell(17);
      $pdf->Cell(5,5,'Sifat',0,0,'L');
      $pdf->Cell(25);
      $pdf->Cell(5,5,':',0,0,'L');
      $pdf->Cell(5,5,$row['sifat_udg'],0,0,'L');
      $pdf->Cell(60);
      $pdf->Cell(5,5,'Kepada',0,1,'L');
      $pdf->Ln(1);
      $pdf->Cell(17);
      $pdf->Cell(5,5,'Hal',0,0,'L');
      $pdf->Cell(25);
      $pdf->Cell(5,5,':',0,0,'L');
      $pdf->Cell(5,5,$row['perihal_udg'],0,0,'L');
      $pdf->Cell(60);
      $pdf->Cell(5,5,'Yth.',0,0,'L');
      $pdf->Cell(5);
      $pdf->MultiCell(60,5,$row['tujuan_surat'],0,'L');
      $pdf->Cell(117);
      $pdf->Cell(5,7,'Di Tempat',0,1,'L');
      $pdf->Cell(120);
      $pdf->Ln(6);
      $pdf->SetFont('Arial','B',12);
      $pdf->Cell(190,7,'SURAT UNDANGAN',0,1,'C');
      $pdf->SetFont('Arial','',12);
      $pdf->Ln(4);
      $pdf->Cell(17);
      $pdf->MultiCell(160,7,$row['isi_surat'],0,'J');
      $pdf->Ln(6);
      $pdf->Cell(35);
      $pdf->Cell(35,7,'Hari, tanggal',0,'L');
      $pdf->Cell(5,7,':',0,'L');
      $tgl_udg = strftime("%A, %d %B %Y",strtotime($row['tgl_udg']));
      $pdf->MultiCell(100,7,$tgl_udg,0,'L');
      $pdf->Cell(35);
      $pdf->Cell(35,7,'Waktu',0,'L');
      $pdf->Cell(5,7,':',0,'L');
      $jam_udg = strftime("%R",strtotime($row['jam_udg']));
      $pdf->MultiCell(100,7,'Jam '.$jam_udg.' s/d selesai',0,'L');
      $pdf->Cell(35);
      $pdf->Cell(35,7,'Tempat',0,0,'L');
      $pdf->Cell(5,7,':',0,0,'L');
      $pdf->MultiCell(100,7,$row['tempat_udg'],0,'L');
      $pdf->Cell(35);
      $pdf->Cell(35,7,'Agenda',0,0,'L');
      $pdf->Cell(5,7,':',0,0,'L');
      $pdf->MultiCell(100,7,$row['acara_udg'],0,'L');
      $pdf->Ln(6);
      $pdf->Cell(17);
      $pdf->MultiCell(160,7,'Demikian disampaikan untuk dapat dimaklumi, atas kehadirannya diucapkan terima kasih agar menjadi maklum yang berkepentingan mengetahuinya.',0,'L');
      $pdf->Ln(8);

      if ($pdf->GetY() > 230) {
        $pdf->SetY(275);
      }elseif ($pdf->GetY() < 225) {
        $pdf->SetY(215);
      }

      $pdf->MultiCell(170,7,'Salam Hormat',0,'R');
      $pdf->Ln(2);
      $pdf->Cell(27);
      $pdf->Cell(35,7,'Sekretaris '.strtoupper($set_rt2),0,0,'C');
      $pdf->Cell(60);
      $pdf->Cell(35,7,'Ketua '.strtoupper($set_rt2),0,0,'C');
      $pdf->Ln(30);
      $pdf->Cell(27);
      $pdf->Cell(35,7,$this->nama,0,0,'C');
      $pdf->Cell(60);
      foreach ($ketua_rt as $key) {
        $pdf->Cell(35,7,$key['nama'],0,1,'C');
      }
      $pdf->Ln(1);
      $pdf->SetFont('Arial','B'.'U',11);
      $pdf->Cell(19,7,'Tembusan',0,0,'C');
      $pdf->SetFont('Arial','',11);
      $pdf->Cell(3,7,':',0,0,'C');
      if ($row['tembusan'] == '_') {
        $tembus = '-';
        $pdf->MultiCell(177,7,$tembus,0,'L');
      }else {
        $pdf->MultiCell(177,7,$row['tembusan'],0,'L');
      }
      if (substr($row['no_udg'],4,3) == 'KGT') {
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(19,7,'*Catatan',0,0,'C');
        $pdf->Cell(3,7,':',0,0,'C');
      }

      $pdf->MultiCell(177,7,$row['catatan'],0,'L');
      $pdf->Output('Undangan Rapat '.str_replace('-','/',$row['no_udg']).' '.$tgl_buat,'I');
    }
  }

  public function cetak_notulensi()
  {
    $id     = $this->uri->segment(3);

    if ($this->role == 'Sekretaris RT') {
      $set_rt   = 'tetangga '.$this->rt;
      $set_rt2  = 'rt '.$this->rt;
      $ketua  = array(
        'role' => 'Ketua RT',
        'rt'   => $this->rt
      );
    }elseif ($this->role == 'Sekretaris RW') {
      $set_rt = 'warga 01';
      $set_rt2  = 'rw 01';
      $ketua  = array(
        'role' => 'Ketua RW'
      );
    }else {
      redirect('auth/logout','refresh');
    }

    $surat  = $this->m_admin->get_detail_notulensi($id)->result_array();
    $ketua_rt  = $this->m_admin->cek_ketua($ketua)->result_array();

    setlocale(LC_ALL, 'IND');

    $pdf = new FPDF('P','mm','A4');
    // membuat halaman baru
    $pdf->AddPage();

    foreach ($surat as $row) {
      // setting jenis font yang akan digunakan
      $pdf->SetFont('Arial','B',16);
      // mencetak string
      $pdf->Cell(190,7,'RUKUN '.strtoupper($set_rt),0,1,'C');
      $pdf->SetFont('Arial','B',12);

      if ($this->role == 'Sekretaris RT') {
        $pdf->Cell(190,7,'RUKUN WARGA 01',0,1,'C');
      }elseif ($this->role == 'Sekretaris RW') {

      }

      $pdf->Cell(190,7,'DESA SUKAPURA KECAMATAN DAYEUHKOLOT',0,1,'C');
      $pdf->Cell(190,7,'KABUPATEN BANDUNG',0,1,'C');
      if ($this->role == 'Sekretaris RT') {
        $pdf->Line(10,40,200,40);
      }elseif ($this->role == 'Sekretaris RW') {
        $pdf->Line(10,33,200,33);
      }
      $pdf->Ln(1.4);
      $pdf->SetFont('Arial','',12);
      $pdf->Cell(190,7,'Sekretariat : Manggadua RT. ' .$this->rt. ' RW. 01 Desa Sukapura Kec. Dayeuhkolot Kab. Bandung -  40267',0,1,'C');
      $pdf->SetLineWidth(1);
      if ($this->role == 'Sekretaris RT') {
        $pdf->Line(10,46,200,46);
      }elseif ($this->role == 'Sekretaris RW') {
        $pdf->Line(10,40,200,40);
      }
      $pdf->Ln(12);
      $pdf->Cell(17);
      $pdf->Cell(5,5,'Nomor',0,0,'L');
      $pdf->Cell(25);
      $pdf->Cell(5,5,':',0,0,'L');
      $pdf->Cell(5,5,str_replace('-','/',$row['no_notulen']),0,0,'L');
      $pdf->Cell(60);
      $pdf->Cell(5,5,'Bandung,',0,0,'L');
      $pdf->Cell(15);
      $tgl_buat = strftime("%d %B %Y",strtotime($row['tgl_buat']));
      $pdf->Cell(5,5,$tgl_buat,0,1,'L');

      $pdf->Ln(1);
      $pdf->Cell(17);
      $pdf->Cell(5,5,'Perihal',0,0,'L');
      $pdf->Cell(25);
      $pdf->Cell(5,5,':',0,0,'L');
      $pdf->MultiCell(60,5,'Notulensi rapat dari surat undangan '.str_replace('-','/',$row['no_udg']),0,'L');
      // $pdf->Cell(5,5,'Notulensi rapat dari surat undangan no '.str_replace('-','/',$row['no_udg']),0,0,'L');
      $pdf->Ln(1);
      $pdf->Cell(117);
      $pdf->Cell(5,5,'Kepada',0,1,'L');
      $pdf->Ln(1);
      $pdf->Cell(117);
      $pdf->Cell(5,5,'Yth.',0,0,'L');
      $pdf->Cell(5);
      $pdf->MultiCell(60,5,$row['tujuan_surat'],0,'L');
      $pdf->Cell(117);
      $pdf->Cell(5,7,'Di Tempat',0,1,'L');
      $pdf->Cell(120);
      $pdf->Ln(6);
      $pdf->SetFont('Arial','B',12);
      $pdf->Cell(190,7,'NOTULENSI RAPAT',0,1,'C');
      $pdf->SetFont('Arial','',12);
      $pdf->Ln(4);
      $pdf->Cell(15);
      $tgl_udg = strftime("%A, %d %B %Y",strtotime($row['tgl_udg']));
      $pdf->MultiCell(160,7,'Sehubungan dengan hasil pertemuan pengurus '.strtoupper($set_rt2).' dengan warga '.strtoupper($set_rt2).' yang telah diadakan pada hari '.$tgl_udg.' kami selaku pengurus '.strtoupper($set_rt2).' bermaksud untuk menyampaikan hasil pertemuan tersebut.',0,'J');
      $pdf->Cell(15);
      $pdf->Ln(6);
      $pdf->Cell(35);
      $pdf->Cell(35,7,'Waktu',0,'L');
      $pdf->Cell(5,7,':',0,'L');
      $jam_udg = strftime("%R",strtotime($row['jam_udg']));
      $pdf->MultiCell(100,7,'Jam '.$jam_udg.' s/d selesai',0,'L');
      $pdf->Cell(35);
      $pdf->Cell(35,7,'Tempat',0,0,'L');
      $pdf->Cell(5,7,':',0,0,'L');
      $pdf->MultiCell(100,7,$row['tempat_udg'],0,'L');
      foreach ($ketua_rt as $key) {

        $pdf->Cell(35);
        $pdf->Cell(35,7,'Agenda',0,0,'L');
        $pdf->Cell(5,7,':',0,0,'L');
        $pdf->MultiCell(100,7,$row['acara_udg'],0,'L');
        $pdf->Ln(6);
        $pdf->Cell(15);
        $pdf->MultiCell(140,7,'HASIL PERTEMUAN :',0,'L');

        $pdf->Cell(15);
        $pdf->MultiCell(160,7,strip_tags($row['uraian_notulen_cetak']),0,'J');
        $pdf->Cell(15);
        $pdf->Ln(4);
        $pdf->Cell(15);
        $pdf->MultiCell(160,7,'Demikian disampaikan untuk dapat dimaklumi, atas perhatian dan kerjasamanya kami ucapkan terima kasih.',0,'L');
        $pdf->Cell(15);
        $pdf->Ln(8);
        $pdf->SetAutoPageBreak(1, 35);
        $pdf->MultiCell(170,7,'Salam Hormat',0,'R');
        $pdf->Ln(8);
        $pdf->Cell(130);
        $pdf->Cell(35,7,'Ketua '.strtoupper($set_rt2),0,0,'C');
        $pdf->Ln(30);
        $pdf->Cell(130);

        $pdf->Cell(35,7,$key['nama'],0,1,'C');
      }
      $pdf->Ln(10);
      $pdf->SetFont('Arial','B'.'U',11);
      $pdf->Cell(19,7,'Tembusan',0,0,'C');
      $pdf->SetFont('Arial','',11);
      $pdf->Cell(3,7,':',0,0,'C');
      if ($row['tembusan'] == '_') {
        $tembus = '-';
        $pdf->MultiCell(177,7,$tembus,0,'L');
      }else {
        $pdf->MultiCell(177,7,$row['tembusan'],0,'L');
      }

      $pdf->Output('Notulensi Rapat '.$row['no_notulen'].' '.$tgl_buat,'I');
    }
  }

  public function pembuatan_undangan()
  {
    if ($this->role == 'Sekretaris RT') {
      $set_rt = 'RT '.$this->rt;
    }elseif ($this->role == 'Sekretaris RW') {
      $set_rt = 'RW 01';
    }

    $valid     = array(
      'status' => 0,
      'rt' => $set_rt
    );
    $query  = $this->m_admin->selectWithWhere('surat_undangan', $valid)->result_array();
    $data['fetch'] = $query;
    $data['content'] = 'admin/tbl_buat_undangan';
    $data['title'] = 'Tabel Pembuatan Surat Undangan';
    $this->load->view('admin/index', $data);
  }


  // Untuk Back-end
  // ==========================================================================

  // ================================ Insert Sekretaris =====================================
  public function insertUndanganRapat(){
    $this->form_validation->set_rules([
      [
        'field' => 'no_udg',
        'label' => 'Nomor Undangan',
        'rules' => 'trim|required'
      ],

      [
        'field' => 'lampiran',
        'label' => 'Lampiran',
        'rules' => 'trim|required|regex_match[/^[\w]/]|max_length[80]'
      ],

      [
        'field' => 'sifat',
        'label' => 'Sifat',
        'rules' => 'trim|required'
      ],

      [
        'field' => 'hal',
        'label' => 'hal',
        'rules' => 'trim|required|regex_match[/^[\w]/]|max_length[80]'
      ],

      [
        'field' => 'tujuan_surat',
        'label' => 'tujuan surat',
        'rules' => 'trim|required|regex_match[/^[\w]/]|max_length[70]'
      ],

      [
        'field' => 'tempat_udg',
        'label' => 'tempat Undangan',
        'rules' => 'trim|required|regex_match[/^[\w]/]|max_length[250]'
      ],

      [
        'field' => 'isi_surat',
        'label' => 'Isi Surat',
        'rules' => 'trim|required|regex_match[/^[\w]/]'
      ],

      [
        'field' => 'tgl_surat',
        'label' => 'Tanggal Surat ',
        'rules' => 'required'
      ],

      [
        'field' => 'jam_udg',
        'label' => 'Jam Undangan ',
        'rules' => 'trim|required'
      ],

      [
        'field' => 'tembusan',
        'label' => 'Tembusan ',
        'rules' => 'trim|required|regex_match[/^[\w]/]'
      ],

      [
        'field' => 'acara_udg',
        'label' => 'acara Undangan',
        'rules' => 'trim|required|regex_match[/^[\w]/]'
      ]
    ]);

    if ($this->input->post()) {
      $no_udg     = $this->input->post('no_udg');
      $lampiran   = $this->input->post('lampiran');
      $sifat      = $this->input->post('sifat');
      $hal        = $this->input->post('hal');
      $tujuan_srt = $this->input->post('tujuan_surat');
      $tempat_udg = $this->input->post('tempat_udg');
      $tembusan   = $this->input->post('tembusan');
      $isi_surat  = $this->input->post('isi_surat');
      $tgl_srt    = $this->input->post('tgl_surat');
      $jam_udg    = $this->input->post('jam_udg');
      $acara_udg  = $this->input->post('acara_udg');
      $date = date("Y/m/d");

      if ($this->role == 'Sekretaris RT') {
        $set_rt = 'RT '.$this->rt;
      }elseif ($this->role == 'Sekretaris RW') {
        $set_rt = 'RW 01';
      }

      if ($this->form_validation->run() == TRUE) {
        $nama_tabel = 'surat_undangan';
        $array_check = array('tgl_udg' => $tgl_srt,
                              'rt' => $set_rt
                            );
        $db_check     = $this->m_admin->selectWithWhere($nama_tabel, $array_check);
        if ($db_check->num_rows() > 0) {
          $json = [
            'tgl_rpt' => 'Terdapat input undangan dengan tanggal pelaksanaan rapat yang sama',
          ];
        }else {
          $data = [
            'lampiran_udg'    => $lampiran,
            'sifat_udg'       => $sifat,
            'perihal_udg'     => $hal,
            'tujuan_surat'    => $tujuan_srt,
            'tempat_udg'      => $tempat_udg,
            'tembusan'        => $tembusan,
            'isi_surat'       => $isi_surat,
            'tgl_udg'         => $tgl_srt,
            'jam_udg'         => $jam_udg,
            'acara_udg'       => $acara_udg,
            'tgl_buat'        => $date,
            'id_user'         => $this->id_user,
            'status'          => 1
          ];

          $query = $this->m_admin->edit_data('surat_undangan', 'no_udg', $no_udg, $data);

          if ($query) {
            $url = base_url('sekretaris/riwayat_Undangan');

            $json = [
              'message' => "Data Rapat berhasil diinput..",
              'url' => $url
            ];
          } else {
            $json['errors'] = "Data Rapat gagal diinput..!";
          }
        }

      } else {
        $no = 0;
        foreach ($this->input->post() as $key => $value) {
          if (form_error($key) != "") {
            $json['form_errors'][$no]['id'] = $key;
            $json['form_errors'][$no]['msg'] = form_error($key, null, null);
            $no++;
          }
        }
      }
      echo json_encode($json);
    } else {
      redirect('sekretaris/pembuatan_undangan','refresh');
    }
  }


  public function insertUndanganKegiatan(){

    $this->form_validation->set_rules([
      [
        'field' => 'no_udg_kgt',
        'label' => 'No surat',
        'rules' => 'trim|required'
      ],
      [
        'field' => 'hal_kgt',
        'label' => 'Hal',
        'rules' => 'trim|required|regex_match[/^[\w]/]|max_length[80]'
      ],

      [
        'field' => 'lampiran_kgt',
        'label' => 'Lampiran Kegiatan',
        'rules' => 'trim|required|regex_match[/^[\w]/]|max_length[80]'
      ],

      [
        'field' => 'sifat_kgt',
        'label' => 'Sifat Kegiatan',
        'rules' => 'trim|required'
      ],

      [
        'field' => 'tujuan_surat_kgt',
        'label' => 'tujuan surat',
        'rules' => 'trim|required|regex_match[/^[\w]/]|max_length[70]'
      ],

      [
        'field' => 'tempat_udg_kgt',
        'label' => 'tempat Undangan',
        'rules' => 'trim|required|regex_match[/^[\w]/]|max_length[250]'
      ],

      [
        'field' => 'catatan_kgt',
        'label' => 'Catatan Penting',
        'rules' => 'trim|required|regex_match[/^[\w]/]'
      ],

      [
        'field' => 'isi_surat_kgt',
        'label' => 'Isi Surat',
        'rules' => 'trim|required|regex_match[/^[\w]/]'
      ],

      [
        'field' => 'tgl_surat_kgt',
        'label' => 'Tanggal Surat ',
        'rules' => 'trim|required'
      ],

      [
        'field' => 'jam_udg_kgt',
        'label' => 'Jam Undangan ',
        'rules' => 'trim|required'
      ],

      [
        'field' => 'tembusan',
        'label' => 'Tembusan ',
        'rules' => 'trim|required|regex_match[/^[\w]/]'
      ],

      [
        'field' => 'acara_udg_kgt',
        'label' => 'acara Undangan',
        'rules' => 'trim|required|regex_match[/^[\w]/]'
      ]
    ]);

    if ($this->input->post()) {
      $no_udg     = $this->input->post('no_udg_kgt');
      $lampiran   = $this->input->post('lampiran_kgt');
      $sifat      = $this->input->post('sifat_kgt');
      $hal        = $this->input->post('hal_kgt');
      $tujuan_srt = $this->input->post('tujuan_surat_kgt');
      $tempat_udg = $this->input->post('tempat_udg_kgt');
      $catatan    = $this->input->post('catatan_kgt');
      $tembusan   = $this->input->post('tembusan');
      $isi_surat  = $this->input->post('isi_surat_kgt');
      $tgl_srt    = $this->input->post('tgl_surat_kgt');
      $jam_udg    = $this->input->post('jam_udg_kgt');
      $acara_udg  = $this->input->post('acara_udg_kgt');
      $date = date("Y/m/d");

      if ($this->role == 'Sekretaris RT') {
        $set_rt = 'RT '.$this->rt;
      }elseif ($this->role == 'Sekretaris RW') {
        $set_rt = 'RW 01';
      }

      if ($this->form_validation->run() == TRUE) {
        $nama_tabel = 'surat_undangan';
        $array_check = array('tgl_udg' => $tgl_srt,
                              'rt' => $set_rt
                            );
        $db_check     = $this->m_admin->selectWithWhere($nama_tabel, $array_check);
        if ($db_check->num_rows() > 0) {
          $json = [
            'tgl_rpt' => 'Terdapat input undangan dengan tanggal pelaksanaan rapat yang sama',
          ];
        }else {
          $data = [
            'lampiran_udg'    => $lampiran,
            'sifat_udg'       => $sifat,
            'perihal_udg'     => $hal,
            'tujuan_surat'    => $tujuan_srt,
            'tempat_udg'      => $tempat_udg,
            'catatan'         => $catatan,
            'tembusan'        => $tembusan,
            'isi_surat'       => $isi_surat,
            'tgl_udg'         => $tgl_srt,
            'tgl_buat'        => $date,
            'jam_udg'         => $jam_udg,
            'acara_udg'       => $acara_udg,
            'id_user'         => $this->id_user,
            'status'          => 1
          ];

          $query = $this->m_admin->edit_data('surat_undangan', 'no_udg', $no_udg, $data);

          if ($query) {
            $url = base_url('sekretaris/riwayat_Undangan');

            $json = [
              'message' => "Data Kegiatan berhasil diinput..",
              'url' => $url
            ];
          }else {
            $json['errors'] = "Data Kegiatan gagal diinput..!";
          }
        }

      }else {
        $no = 0;
        foreach ($this->input->post() as $key => $value) {
          if (form_error($key) != "") {
            $json['form_errors'][$no]['id'] = $key;
            $json['form_errors'][$no]['msg'] = form_error($key, null, null);
            $no++;
          }
        }
      }
      echo json_encode($json);
    }else {
      redirect('sekretaris/pembuatan_undangan','refresh');
    }
  }

  public function insertNotulen(){
    $this->form_validation->set_rules([
      [
        'field' => 'no_notulen',
        'label' => 'Nomor Notulensi',
        'rules' => 'trim|required'
      ],

      [
        'field' => 'tembusan',
        'label' => 'Tembusan',
        'rules' => 'trim|required|regex_match[/^[\w]/]|max_length[100]'
      ],

      [
        'field' => 'ket_dok_rpt',
        'label' => 'Keterangan Dokumentasi Rapat',
        'rules' => 'trim|required|regex_match[/^[\w]/]|max_length[300]'
      ],

      [
        'field' => 'uraian_notulen_cetak',
        'label' => 'Uraian Notulensi cetak',
        'rules' => 'trim|required|regex_match[/^[\w]/]'
      ],

      [
        'field' => 'uraian_notulen',
        'label' => 'Uraian Notulensi web',
        'rules' => 'trim|required'
      ],
      [
        'field' => 'no_udg',
        'label' => 'No Undangan',
        'rules' => 'trim|required'
      ]
    ]);

    if ($this->input->post()) {
      $no_notulen             = $this->input->post('no_notulen');
      $tembusan               = $this->input->post('tembusan');
      $ket_dok_rpt            = $this->input->post('ket_dok_rpt');
      $uraian_notulen_cetak   = $this->input->post('uraian_notulen_cetak');
      $uraian_notulen         = $this->input->post('uraian_notulen');
      $date                   = date("Y/m/d");
      $no_udg                 = $this->input->post('no_udg');
      $penulis                = $this->role.' '.$this->rt;

      if ($this->role == 'Sekretaris RT') {
        $set_rt = 'RT '.$this->rt;
      }elseif ($this->role == 'Sekretaris RW') {
        $set_rt = 'RW 01';
      }

      $this->load->library('upload');
      // print_r($_FILES);
      $config['upload_path']            = './assets/foto/notulensi';
      // $config['file_name']            = $this->input->post('dokumentasi_rpt');
      $config['allowed_types']          = 'jpg|jpeg|png';
      $config['max_size']               = 2000; // 2MB
      $config['overwrite']              = TRUE;
      // $config['max_width']            = 1024;
      // $config['max_height']           = 768;
      $this->upload->initialize($config);


      if ($this->form_validation->run() == TRUE) {
        if ($this->upload->do_upload('dokumentasi_rpt')){
          $data_upload     = $this->upload->data('file_name');

        } else {

          if ($this->upload->display_errors() != '') {
            $gambar_prob = $this->upload->display_errors('', '');
            $json = [
              'pict' => 'Something Wrong in Field Dokumentasi Rapat. '.$gambar_prob,
            ];
          }
        }

        $config2['upload_path']            = './assets/foto/notulensi/presensi';
        // $config2['file_name']            = $this->input->post('dokumentasi_presensi');
        $config2['allowed_types']          = 'jpg|jpeg|png';
        $config2['max_size']               = 2000; // 2MB
        $config2['overwrite']              = TRUE;
        // $config2['max_width']            = 1024;
        // $config2['max_height']           = 768;
        $this->upload->initialize($config2, true);

        if ($this->upload->do_upload('dokumentasi_presensi')){
          $data_upload2     = $this->upload->data('file_name');

        } else {

          if ($this->upload->display_errors() != '') {
            $gambar_prob = $this->upload->display_errors('', '');
            $json = [
              'pict2' => 'Something Wrong in Field Dokumentasi Presentasi Warga. '.$gambar_prob,
            ];
          }
        }

        if ($this->upload->do_upload('dokumentasi_rpt') && $this->upload->do_upload('dokumentasi_presensi')) {
          $data = [
            'no_notulen'              => $no_notulen,
            'tembusan'                => $tembusan,
            'dokumentasi_rpt'         => $data_upload,
            'keterangan_dokumentasi'  => $ket_dok_rpt,
            'dokumentasi_presensi'    => $data_upload2,
            'uraian_notulen_cetak'    => $uraian_notulen_cetak,
            'uraian_notulen'          => $uraian_notulen,
            'tgl_buat'                => $date,
            'penulis'                 => $penulis,
            'rt'                      => $set_rt,
            'status'                  => 0,
            'no_udg'                  => $no_udg
          ];

          $query = $this->m_admin->input_data('notulensi_rpt', $data);
          if ($query) {
            $url = base_url('sekretaris/riwayat_notulensi');

            $json = [
              'message' => "Data Notulensi berhasil diinput..",
              'url' => $url
            ];
          }else {

            $json['errors'] = "Data Notulensi gagal diinput..!";
          }
        }



      }else {
        $no = 0;
        foreach ($this->input->post() as $key => $value) {
          if (form_error($key) != "") {
            $json['form_errors'][$no]['id'] = $key;
            $json['form_errors'][$no]['msg'] = form_error($key, null, null);
            $no++;
          }
        }

      }
      echo json_encode($json);
    }else {
      redirect('sekretaris/inputnotulensi'.'/'.$no_udg , 'refresh');
    }
  }

  public function insertArsipMasuk(){
    $this->form_validation->set_rules([
      [
        'field' => 'kd_surat',
        'label' => 'Kode Surat',
        'rules' => 'trim|required'
      ],

      [
        'field' => 'no_surat',
        'label' => 'nomor surat',
        'rules' => 'trim|required|regex_match[/^[\w]/]|max_length[50]'
      ],

      [
        'field' => 'pengirim',
        'label' => 'Pengirim',
        'rules' => 'trim|required|regex_match[/^[\w]/]|max_length[100]'
      ],

      [
        'field' => 'tgl_terima',
        'label' => 'Tanggal Terima Surat',
        'rules' => 'trim|required'
      ],


      [
        'field' => 'tgl_surat',
        'label' => 'Tanggal Surat',
        'rules' => 'trim|required'
      ],

      [
        'field' => 'keterangan',
        'label' => 'keterangan',
        'rules' => 'trim|required|regex_match[/^[\w]/]'
      ]
    ]);

    if ($this->input->post()) {
      $kd_surat        = $this->input->post('kd_surat');
      $no_surat        = $this->input->post('no_surat');
      $pengirim        = $this->input->post('pengirim');
      $tgl_terima      = $this->input->post('tgl_terima');
      $tgl_surat       = $this->input->post('tgl_surat');
      $keterangan      = $this->input->post('keterangan');
      $date = date("Y/m/d");

      if ($this->role == 'Sekretaris RT') {
        $set_rt = 'RT '.$this->rt;
      }elseif ($this->role == 'Sekretaris RW') {
        $set_rt = 'RW 01';
      }

      $config['upload_path']          = './assets/foto/arsip';
      // $config['file_name']            = $this->input->post('gbr_surat');
      $config['allowed_types']        = 'jpg|jpeg|png';
      $config['max_size']             = 2000; // 2MB
      // $config['max_width']            = 1024;
      // $config['max_height']           = 768;

      $this->load->library('upload', $config);

      if ($this->form_validation->run() == TRUE) {
        if ($this->upload->do_upload('gbr_surat')){
          $nama_tabel = 'arsip_surat';
          $array_check = array('no_surat' => $no_surat,
                                'rt' => $set_rt
                              );
          $db_check     = $this->m_admin->selectWithWhere($nama_tabel, $array_check);
          if ($db_check->num_rows() > 0) {
            $json = [
              'no_srt' => 'Terdapat input No Surat yang sama, cek kembali No Surat yang telah diinputkan. .',
            ];
          }else {
            $data_upload     = $this->upload->data('file_name');
            $data = [
              'kd_surat'   => $kd_surat,
              'no_surat'   => $no_surat,
              'pengirim'   => $pengirim,
              'keterangan' => $keterangan,
              'gambar_srt' => $data_upload,
              'tgl_terima' => $tgl_terima,
              'tgl_surat'  => $tgl_surat,
              'tgl_buat'   => $date,
              'rt'         => $set_rt,
              'id_user'    => $this->id_user
            ];

            $query = $this->m_admin->input_data('arsip_surat', $data);
            if ($query) {
              $url = base_url('sekretaris/riwayat_arsip');

              $json = [
                'message' => "Data arsip berhasil diinput..",
                'url' => $url
              ];
            }else {
              $json['errors'] = "Data arsip gagal diinput..!";
            }
          }

        }else {
          if ($this->upload->display_errors() != '') {
            $gambar_prob = $this->upload->display_errors('', '');

            $json = [
              'pict' => $gambar_prob,
            ];

          }
        }

      }else {
        $no = 0;
        foreach ($this->input->post() as $key => $value) {
          if (form_error($key) != "") {
            $json['form_errors'][$no]['id'] = $key;
            $json['form_errors'][$no]['msg'] = form_error($key, null, null);
            $no++;
          }
        }
      }
      echo json_encode($json);
    }else {
      redirect('sekretaris/input_arsipsurat','refresh');
    }

  }


  // ================================ End of Insert Sekretaris =====================================

  // ================================ Update Sekretaris =====================================
  public function editRapat(){
    $this->form_validation->set_rules([
      [
        'field' => 'no_udg',
        'label' => 'Nomor Undangan',
        'rules' => 'trim|required'
      ],

      [
        'field' => 'lampiran',
        'label' => 'Lampiran',
        'rules' => 'trim|required|regex_match[/^[\w]/]|max_length[80]'
      ],

      [
        'field' => 'sifat',
        'label' => 'Sifat',
        'rules' => 'trim|required'
      ],

      [
        'field' => 'hal',
        'label' => 'hal',
        'rules' => 'trim|required|regex_match[/^[\w]/]|max_length[80]'
      ],

      [
        'field' => 'tujuan_surat',
        'label' => 'tujuan surat',
        'rules' => 'trim|required|regex_match[/^[\w]/]|max_length[70]'
      ],

      [
        'field' => 'tempat_udg',
        'label' => 'tempat Undangan',
        'rules' => 'trim|required|regex_match[/^[\w]/]|max_length[70]'
      ],

      [
        'field' => 'isi_surat',
        'label' => 'Isi Surat',
        'rules' => 'trim|required|regex_match[/^[\w]/]'
      ],

      // [
      //     'field' => 'tgl_surat',
      //     'label' => 'Tanggal Surat ',
      //     'rules' => 'required'
      // ],
      //
      // [
      //     'field' => 'jam_udg',
      //     'label' => 'Jam Undangan ',
      //     'rules' => 'trim|required'
      // ],

      [
        'field' => 'tembusan',
        'label' => 'Tembusan ',
        'rules' => 'trim|required|regex_match[/^[\w]/]'
      ],

      [
        'field' => 'acara_udg',
        'label' => 'acara Undangan',
        'rules' => 'trim|required|regex_match[/^[\w]/]'
      ]
    ]);

    if ($this->input->post()) {
      $no_udg     = $this->input->post('no_udg');
      $lampiran   = $this->input->post('lampiran');
      $sifat      = $this->input->post('sifat');
      $hal        = $this->input->post('hal');
      $tujuan_srt = $this->input->post('tujuan_surat');
      $tempat_udg = $this->input->post('tempat_udg');
      $tembusan   = $this->input->post('tembusan');
      $isi_surat  = $this->input->post('isi_surat');
      $tgl_srt    = $this->input->post('tgl_surat');
      $jam_udg    = $this->input->post('jam_udg');
      $acara_udg  = $this->input->post('acara_udg');

      if ($this->role == 'Sekretaris RT') {
        $set_rt = 'RT '.$this->rt;
      }elseif ($this->role == 'Sekretaris RW') {
        $set_rt = 'RW 01';
      }


      if ($this->form_validation->run() == TRUE) {
        $nama_tabel = 'surat_undangan';
        $array_check = array('tgl_udg' => $tgl_srt,
                              'rt' => $set_rt
                            );
        $db_check     = $this->m_admin->selectWithWhere($nama_tabel, $array_check);
        if ($db_check->num_rows() > 0) {
          $json = [
            'tgl_rpt' => 'Terdapat input undangan dengan tanggal pelaksanaan rapat yang sama',
          ];
        }else {
          if ($tgl_srt == '' && $jam_udg == '') {
            $data = [
              'no_udg' => $no_udg,
              'lampiran_udg' => $lampiran,
              'sifat_udg' => $sifat,
              'perihal_udg' => $hal,
              'tujuan_surat' => $tujuan_srt,
              'tempat_udg' => $tempat_udg,
              'tembusan' => $tembusan,
              'isi_surat' => $isi_surat,
              'acara_udg' => $acara_udg,
              'id_user' => $this->id_user
            ];
          }elseif ($tgl_srt == '') {
            $data = [
              'no_udg' => $no_udg,
              'lampiran_udg' => $lampiran,
              'sifat_udg' => $sifat,
              'perihal_udg' => $hal,
              'tujuan_surat' => $tujuan_srt,
              'tempat_udg' => $tempat_udg,
              'tembusan' => $tembusan,
              'isi_surat' => $isi_surat,
              'jam_udg' => $jam_udg,
              'acara_udg' => $acara_udg,
              'id_user' => $this->id_user
            ];
          }elseif ($jam_udg == '') {
            $data = [
              'no_udg' => $no_udg,
              'lampiran_udg' => $lampiran,
              'sifat_udg' => $sifat,
              'perihal_udg' => $hal,
              'tujuan_surat' => $tujuan_srt,
              'tempat_udg' => $tempat_udg,
              'tembusan' => $tembusan,
              'isi_surat' => $isi_surat,
              'tgl_udg' => $tgl_srt,
              'acara_udg' => $acara_udg,
              'id_user' => $this->id_user
            ];
          }else {
            $data = [
              'no_udg' => $no_udg,
              'lampiran_udg' => $lampiran,
              'sifat_udg' => $sifat,
              'perihal_udg' => $hal,
              'tujuan_surat' => $tujuan_srt,
              'tempat_udg' => $tempat_udg,
              'tembusan' => $tembusan,
              'isi_surat' => $isi_surat,
              'tgl_udg' => $tgl_srt,
              'jam_udg' => $jam_udg,
              'acara_udg' => $acara_udg,
              'id_user' => $this->id_user
            ];
          }
          $query = $this->m_admin->edit_data('surat_undangan','no_udg', $no_udg,$data);

          if ($query) {
            $url = base_url('sekretaris/riwayat_Undangan');

            $json = [
              'message' => "Data Surat Undangan berhasil diubah..",
              'url' => $url
            ];
          } else {
            $json['errors'] = "Data Surat Undangan gagal diubah..!";
          }
        }


      } else {
        $no = 0;
        foreach ($this->input->post() as $key => $value) {
          if (form_error($key) != "") {
            $json['form_errors'][$no]['id'] = $key;
            $json['form_errors'][$no]['msg'] = form_error($key, null, null);
            $no++;
          }
        }
      }

      echo json_encode($json);
    } else {
      redirect('sekretaris/riwayat_Undangan','refresh');
    }
  }

  public function editKegiatan(){
    $this->form_validation->set_rules([
      [
        'field' => 'no_udg_kgtedit',
        'label' => 'Nomor Undangan',
        'rules' => 'trim|required'
      ],

      [
        'field' => 'hal_kgtedit',
        'label' => 'hal',
        'rules' => 'trim|required|regex_match[/^[\w]/]|max_length[80]'
      ],

      [
        'field' => 'lampiran_kgtedit',
        'label' => 'Lampiran Kegiatan',
        'rules' => 'trim|required|regex_match[/^[\w]/]|max_length[80]'
      ],

      [
        'field' => 'sifat_kgtedit',
        'label' => 'Sifat Kegiatan',
        'rules' => 'trim|required'
      ],

      [
        'field' => 'tujuan_surat_kgtedit',
        'label' => 'tujuan surat',
        'rules' => 'trim|required|regex_match[/^[\w]/]|max_length[70]'
      ],

      [
        'field' => 'tempat_udg_kgtedit',
        'label' => 'tempat Undangan',
        'rules' => 'trim|required|regex_match[/^[\w]/]|max_length[70]'
      ],

      [
        'field' => 'catatan_kgtedit',
        'label' => 'Catatan Penting',
        'rules' => 'trim|required|regex_match[/^[\w]/]'
      ],

      [
        'field' => 'isi_surat_kgtedit',
        'label' => 'Isi Surat',
        'rules' => 'trim|required|regex_match[/^[\w]/]'
      ],

      // [
      //     'field' => 'tgl_surat',
      //     'label' => 'Tanggal Surat ',
      //     'rules' => 'trim|required'
      // ],
      //
      // [
      //     'field' => 'jam_udg',
      //     'label' => 'Jam Undangan ',
      //     'rules' => 'trim|required'
      // ],

      [
        'field' => 'tembusan_kgtedit',
        'label' => 'Tembusan ',
        'rules' => 'trim|required|regex_match[/^[\w]/]'
      ],

      [
        'field' => 'acara_udg_kgtedit',
        'label' => 'acara Undangan',
        'rules' => 'trim|required|regex_match[/^[\w]/]'
      ]
    ]);

    if ($this->input->post()) {
      $no_udg     = $this->input->post('no_udg_kgtedit');
      $lampiran   = $this->input->post('lampiran_kgtedit');
      $sifat      = $this->input->post('sifat_kgtedit');
      $hal        = $this->input->post('hal_kgtedit');
      $tujuan_srt = $this->input->post('tujuan_surat_kgtedit');
      $tempat_udg = $this->input->post('tempat_udg_kgtedit');
      $tembusan   = $this->input->post('tembusan_kgtedit');
      $isi_surat  = $this->input->post('isi_surat_kgtedit');
      $tgl_srt    = $this->input->post('tgl_surat_kgtedit');
      $jam_udg    = $this->input->post('jam_udg_kgtedit');
      $acara_udg  = $this->input->post('acara_udg_kgtedit');
      $catatan    = $this->input->post('catatan_kgtedit');

      if ($this->role == 'Sekretaris RT') {
        $set_rt = 'RT '.$this->rt;
      }elseif ($this->role == 'Sekretaris RW') {
        $set_rt = 'RW 01';
      }

      if ($this->form_validation->run() == TRUE) {
        $nama_tabel = 'surat_undangan';
        $array_check = array('tgl_udg' => $tgl_srt,
                              'rt' => $set_rt
                            );
        $db_check     = $this->m_admin->selectWithWhere($nama_tabel, $array_check);
        if ($db_check->num_rows() > 0) {
          $json = [
            'tgl_rpt' => 'Terdapat input undangan dengan tanggal pelaksanaan rapat yang sama',
          ];
        }else {
          if ($tgl_srt == '' && $jam_udg == '') {
            $data = [
              'no_udg' => $no_udg,
              'lampiran_udg' => $lampiran,
              'sifat_udg' => $sifat,
              'perihal_udg' => $hal,
              'tujuan_surat' => $tujuan_srt,
              'tempat_udg' => $tempat_udg,
              'tembusan' => $tembusan,
              'isi_surat' => $isi_surat,
              'acara_udg' => $acara_udg,
              'catatan'   => $catatan,
              'id_user' => $this->id_user
            ];
          }elseif ($tgl_srt == '') {
            $data = [
              'no_udg' => $no_udg,
              'lampiran_udg' => $lampiran,
              'sifat_udg' => $sifat,
              'perihal_udg' => $hal,
              'tujuan_surat' => $tujuan_srt,
              'tempat_udg' => $tempat_udg,
              'tembusan' => $tembusan,
              'isi_surat' => $isi_surat,
              'jam_udg' => $jam_udg,
              'acara_udg' => $acara_udg,
              'catatan'   => $catatan,
              'id_user' => $this->id_user
            ];
          }elseif ($jam_udg == '') {
            $data = [
              'no_udg' => $no_udg,
              'lampiran_udg' => $lampiran,
              'sifat_udg' => $sifat,
              'perihal_udg' => $hal,
              'tujuan_surat' => $tujuan_srt,
              'tempat_udg' => $tempat_udg,
              'tembusan' => $tembusan,
              'isi_surat' => $isi_surat,
              'tgl_udg' => $tgl_srt,
              'acara_udg' => $acara_udg,
              'catatan'   => $catatan,
              'id_user' => $this->id_user
            ];
          }else {
            $data = [
              'no_udg' => $no_udg,
              'lampiran_udg' => $lampiran,
              'sifat_udg' => $sifat,
              'perihal_udg' => $hal,
              'tujuan_surat' => $tujuan_srt,
              'tempat_udg' => $tempat_udg,
              'tembusan' => $tembusan,
              'isi_surat' => $isi_surat,
              'tgl_udg' => $tgl_srt,
              'jam_udg' => $jam_udg,
              'acara_udg' => $acara_udg,
              'catatan'   => $catatan,
              'id_user' => $this->id_user
            ];
          }

          $query = $this->m_admin->edit_data('surat_undangan','no_udg', $no_udg,$data);

          if ($query) {
            $url = base_url('sekretaris/riwayat_Undangan');

            $json = [
              'message' => "Data Surat Undangan Kegiatan berhasil diubah..",
              'url' => $url
            ];
          } else {
            $json['errors'] = "Data Surat Undangan Kegiatan gagal diubah..!";
          }
        }

      } else {
        $no = 0;
        foreach ($this->input->post() as $key => $value) {
          if (form_error($key) != "") {
            $json['form_errors'][$no]['id'] = $key;
            $json['form_errors'][$no]['msg'] = form_error($key, null, null);
            $no++;
          }
        }
      }

      echo json_encode($json);
    } else {
      redirect('sekretaris/riwayat_Undangan','refresh');
    }
  }

  public function previewRapat(){
    $id     = $this->uri->segment(3);

    if ($this->role == 'Sekretaris RT') {
      $set_rt = 'RT '.$this->rt;
      $ketua  = array(
        'role' => 'Ketua RT',
        'rt'   => $this->rt
      );
      $array_data = array(
        'no_udg'     => $id,
        'rt'         => $set_rt
      );
    }elseif ($this->role == 'Sekretaris RW') {
      $ketua  = array(
        'role' => 'Ketua RW'
      );
      $array_data = array(
        'no_udg'     => $id,
        'rt'         => 'RW 01'
      );
    }else {
      redirect('auth/logout','refresh');
    }



    $ketua_rt  = $this->m_admin->cek_ketua($ketua)->result_array();
    $db = $this->m_admin->selectWithWhere('surat_undangan', $array_data)->result_array();
    $data['fetch'] = $db;
    $data['fetch_ketua'] = $ketua_rt;
    $data['title'] = 'Detail Surat Undangan Rapat';
    $this->load->view('admin/v_detailrpt', $data);
  }

  public function detailRapat($id){
    $tabel = 'surat_undangan';
    $where = [
      'no_udg' => $id
    ];

    $data = $this->m_admin->selectWithWhere($tabel,$where)->row();
    echo json_encode($data);
  }

  public function editdokumen_Notulensi(){

    $id     = $this->uri->segment(3);
    $no     = array('no_notulen' => $id );
    $surat  = $this->m_admin->selectWithWhere('notulensi_rpt', $no)->result_array();
    $data['fetch'] = $surat;
    $data['content'] = 'admin/v_edit_doknotulensi';
    $data['title'] = 'Edit Data Notulensi Rapat';
    $this->load->view('admin/index', $data);
  }

  public function editDokRapatNotulen(){
    $this->form_validation->set_rules([
      [
        'field' => 'no_notulen',
        'label' => 'Nomor Notulensi',
        'rules' => 'trim|required'
      ],
      [
        'field' => 'ket_dok_rpt',
        'label' => 'Keterangan Dokumentasi Rapat',
        'rules' => 'trim|required|regex_match[/^[\w]/]|max_length[300]'
      ],
    ]);

    if ($this->input->post()) {
      $no_notulen     = $this->input->post('no_notulen');
      $ket_dok_rpt     = $this->input->post('ket_dok_rpt');

      $this->load->library('upload');
      // print_r($_FILES);

      $config['upload_path']          = './assets/foto/notulensi';
      // $config['file_name']            = $this->input->post('gbr_surat');
      $config['allowed_types']        = 'jpg|jpeg|png';
      $config['max_size']             = 2000; // 2MB
      // $config['max_width']            = 1024;
      // $config['max_height']           = 768;

      $this->upload->initialize($config);


      if ($this->form_validation->run() == TRUE) {
        if ($this->upload->do_upload('dokumentasi_rpt')){
          $data_upload     = $this->upload->data('file_name');
        } else {
          if ($this->upload->display_errors('', '') == 'You did not select a file to upload.') {

          }else{
            $gambar_prob = $this->upload->display_errors('', '');

            $json = [
              'pict' => 'Something Wrong in Field Dokumentasi Rapat. '.$gambar_prob,
            ];
          }
        }



        $config2['upload_path']            = './assets/foto/notulensi/presensi';
        // $config2['file_name']            = $this->input->post('dokumentasi_presensi');
        $config2['allowed_types']          = 'jpg|jpeg|png';
        $config2['max_size']               = 2000; // 2MB
        $config2['overwrite']              = TRUE;
        // $config2['max_width']            = 1024;
        // $config2['max_height']           = 768;
        $this->upload->initialize($config2, true);

        if ($this->upload->do_upload('dokumentasi_presensi')){
          $data_upload2     = $this->upload->data('file_name');

        } else {
          if ($this->upload->display_errors('', '') == 'You did not select a file to upload.') {

          }else{
            $gambar_prob = $this->upload->display_errors('', '');

            $json = [
              'pict2' => 'Something Wrong in Field Dokumentasi Rapat. '.$gambar_prob,
            ];
          }
        }

        if ($this->upload->do_upload('dokumentasi_rpt') && $this->upload->do_upload('dokumentasi_presensi')) {
          $data = [
            'dokumentasi_rpt'         => $data_upload,
            'dokumentasi_presensi'    => $data_upload2,
            'keterangan_dokumentasi'  => $ket_dok_rpt
          ];

          $query = $this->m_admin->edit_data('notulensi_rpt','no_notulen', $no_notulen, $data);
          if ($query) {
            $url = base_url('sekretaris/riwayat_notulensi');

            $json = [
              'message' => "Data Dokumentasi Rapat Notulensi berhasil diubah..",
              'url' => $url
            ];
          }else {
            $json['errors'] = "Data Dokumentasi Rapat Notulensi gagal diubah..";
          }
        }elseif ($this->upload->do_upload('dokumentasi_rpt')) {
          $data = [
            'dokumentasi_rpt'         => $data_upload,
            'keterangan_dokumentasi'  => $ket_dok_rpt
          ];

          $query = $this->m_admin->edit_data('notulensi_rpt','no_notulen', $no_notulen, $data);
          if ($query) {
            $url = base_url('sekretaris/riwayat_notulensi');

            $json = [
              'message' => "Data Dokumentasi Rapat Notulensi berhasil diubah..",
              'url' => $url
            ];
          }else {
            $json['errors'] = "Data Dokumentasi Rapat Notulensi gagal diubah..";
          }
        }elseif ($this->upload->do_upload('dokumentasi_presensi')) {
          $data = [
            'dokumentasi_presensi'    => $data_upload2,
            'keterangan_dokumentasi'  => $ket_dok_rpt
          ];

          $query = $this->m_admin->edit_data('notulensi_rpt','no_notulen', $no_notulen, $data);
          if ($query) {
            $url = base_url('sekretaris/riwayat_notulensi');

            $json = [
              'message' => "Data Dokumentasi Rapat Notulensi berhasil diubah..",
              'url' => $url
            ];
          }else {
            $json['errors'] = "Data Dokumentasi Rapat Notulensi gagal diubah..";
          }
        }

      }else {
        $no = 0;
        foreach ($this->input->post() as $key => $value) {
          if (form_error($key) != "") {
            $json['form_errors'][$no]['id'] = $key;
            $json['form_errors'][$no]['msg'] = form_error($key, null, null);
            $no++;
          }
        }
      }
      echo json_encode($json);
    }else {
      redirect('sekretaris/editNotulen','refresh');
    }
  }

  public function editUraianNotulen(){
    $this->form_validation->set_rules([
      [
        'field' => 'no_notulen',
        'label' => 'Nomor Notulensi',
        'rules' => 'trim|required'
      ],

      [
        'field' => 'tembusan',
        'label' => 'Tembusan ',
        'rules' => 'trim|required|regex_match[/^[\w]/]'
      ],

      [
        'field' => 'uraian_notulen_cetak',
        'label' => 'Uraian Notulensi Cetak',
        'rules' => 'required|trim|regex_match[/^[\w]/]'
      ],

      [
        'field' => 'uraian_notulen',
        'label' => 'Uraian Notulensi',
        'rules' => 'trim'
      ]
    ]);

    if ($this->input->post()) {
      $no_notulen             = $this->input->post('no_notulen');
      $tembusan               = $this->input->post('tembusan');
      $uraian_notulen_cetak   = $this->input->post('uraian_notulen_cetak');
      $uraian                 = $this->input->post('uraian_notulen');


      if ($this->form_validation->run() == TRUE) {
        if ($uraian == '') {
          $data = [
            'tembusan'             => $tembusan,
            'uraian_notulen_cetak' => $uraian_notulen_cetak
          ];

          $query = $this->m_admin->edit_data('notulensi_rpt','no_notulen', $no_notulen, $data);
          if ($query) {
            $url = base_url('sekretaris/riwayat_notulensi');

            $json = [
              'message' => "Data Notulensi berhasil diubah..",
              'url' => $url
            ];
          }else {
            $json['errors'] = "Data Notulensi gagal diubah..!";
          }
        }else {
          $data = [
            'tembusan'             => $tembusan,
            'uraian_notulen_cetak' => $uraian_notulen_cetak,
            'uraian_notulen'       => $uraian
          ];

          $query = $this->m_admin->edit_data('notulensi_rpt','no_notulen', $no_notulen, $data);
          if ($query) {
            $url = base_url('sekretaris/riwayat_notulensi');

            $json = [
              'message' => "Data Notulensi berhasil diubah..",
              'url' => $url
            ];
          }else {
            $json['errors'] = "Data Notulensi gagal diubah..!";
          }
        }

      }else {
        $no = 0;
        foreach ($this->input->post() as $key => $value) {
          if (form_error($key) != "") {
            $json['form_errors'][$no]['id'] = $key;
            $json['form_errors'][$no]['msg'] = form_error($key, null, null);
            $no++;
          }
        }
      }
      echo json_encode($json);
    }else {
      redirect('sekretaris/riwayat_notulensi','refresh');
    }
  }

  public function detailNotulen($id){
    $tabel = 'notulensi_rpt';
    $where = [
      'no_notulen' => $id
    ];

    $data = $this->m_admin->selectWithWhere($tabel,$where)->row();
    echo json_encode($data);
  }

  public function editArsipMasuk(){
    $this->form_validation->set_rules([
      [
        'field' => 'kd_surat',
        'label' => 'Kode Surat',
        'rules' => 'trim|required'
      ],

      [
        'field' => 'no_surat',
        'label' => 'nomor surat',
        'rules' => 'trim|required|regex_match[/^[\w]/]|max_length[50]'
      ],

      [
        'field' => 'pengirim',
        'label' => 'Pengirim',
        'rules' => 'trim|required|regex_match[/^[\w]/]|max_length[100]'
      ],

      [
        'field' => 'keterangan',
        'label' => 'keterangan',
        'rules' => 'trim|required|regex_match[/^[\w]/]'
      ]
    ]);

    if ($this->input->post()) {
      $kd_surat        = $this->input->post('kd_surat');
      $no_surat        = $this->input->post('no_surat');
      $pengirim        = $this->input->post('pengirim');
      $tgl_terima      = $this->input->post('tgl_terima');
      $tgl_surat       = $this->input->post('tgl_surat');
      $keterangan      = $this->input->post('keterangan');

      $config['upload_path']          = './assets/foto/arsip';
      // $config['file_name']            = $this->input->post('gbr_surat');
      $config['allowed_types']        = 'jpg|jpeg|png';
      $config['max_size']             = 2000; // 2MB
      // $config['max_width']            = 1024;
      // $config['max_height']           = 768;

      $this->load->library('upload', $config);


      if ($this->form_validation->run() == TRUE) {
        if ($this->upload->do_upload('gbr_surat')){

          $data_upload     = $this->upload->data('file_name');
          if ($tgl_surat == '' && $tgl_terima == '') {
            $data = [
              'kd_surat' => $kd_surat,
              'no_surat' => $no_surat,
              'pengirim' => $pengirim,
              'keterangan' => $keterangan,
              'gambar_srt' => $data_upload,
              'id_user' => $this->id_user
            ];
          }elseif ($tgl_surat == '') {
            $data = [
              'kd_surat' => $kd_surat,
              'no_surat' => $no_surat,
              'pengirim' => $pengirim,
              'keterangan' => $keterangan,
              'gambar_srt' => $data_upload,
              'tgl_terima' => $tgl_terima,
              'id_user' => $this->id_user
            ];
          }elseif ($tgl_terima == '') {
            $data = [
              'kd_surat' => $kd_surat,
              'no_surat' => $no_surat,
              'pengirim' => $pengirim,
              'keterangan' => $keterangan,
              'gambar_srt' => $data_upload,
              'tgl_surat' => $tgl_surat,
              'id_user' => $this->id_user
            ];
          }


          $query = $this->m_admin->edit_data('arsip_surat','kd_surat', $kd_surat, $data);
          if ($query) {
            $url = base_url('sekretaris/riwayat_arsip');

            $json = [
              'message' => "Data arsip berhasil diubah..",
              'url' => $url
            ];
          }else {
            $json['errors'] = "Data arsip gagal diubah..!";
          }

        }else{
          if ($this->upload->display_errors('', '') == 'You did not select a file to upload.') {
            if ($tgl_surat == '' && $tgl_terima == '') {
              $data = [
                'kd_surat' => $kd_surat,
                'no_surat' => $no_surat,
                'pengirim' => $pengirim,
                'keterangan' => $keterangan,
                'id_user' => $this->id_user
              ];
            }elseif ($tgl_surat == '') {
              $data = [
                'kd_surat' => $kd_surat,
                'no_surat' => $no_surat,
                'pengirim' => $pengirim,
                'keterangan' => $keterangan,
                'tgl_terima' => $tgl_terima,
                'id_user' => $this->id_user
              ];
            }elseif ($tgl_terima == '') {
              $data = [
                'kd_surat' => $kd_surat,
                'no_surat' => $no_surat,
                'pengirim' => $pengirim,
                'keterangan' => $keterangan,
                'tgl_surat' => $tgl_surat,
                'id_user' => $this->id_user
              ];
            }

            $query = $this->m_admin->edit_data('arsip_surat','kd_surat', $kd_surat, $data);
            if ($query) {
              $url = base_url('sekretaris/riwayat_arsip');

              $json = [
                'message' => "Data arsip berhasil diubah..",
                'url' => $url
              ];
            }else {
              $json['errors'] = "Data arsip gagal diubah..!";
            }

          }else{

            $gambar_prob = $this->upload->display_errors('', '');

            $json = [
              'pict' => $gambar_prob,
            ];
          }
        }


      }else {
        $no = 0;
        foreach ($this->input->post() as $key => $value) {
          if (form_error($key) != "") {
            $json['form_errors'][$no]['id'] = $key;
            $json['form_errors'][$no]['msg'] = form_error($key, null, null);
            $no++;
          }
        }
      }
      echo json_encode($json);
    }else {
      redirect('sekretaris/riwayat_arsip','refresh');
    }

  }

  public function detailArsip($id){
    $tabel = 'arsip_surat';
    $where = [
      'kd_surat' => $id
    ];

    $data = $this->m_admin->selectWithWhere($tabel,$where)->row();
    echo json_encode($data);
  }

}
/* End of file Controllername.php */
?>
