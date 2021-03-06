<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class User extends CI_Controller {

        public $id_user;
        public $role;
        public $rt;
        public $nama;

        public function __construct(){
            parent::__construct();
            $this->load->model('m_admin');
            $this->load->model('m_user');
            $this->load->library('form_validation');

            $this->id_user = $this->session->userdata('id_user');
            $this->role = $this->session->userdata('role');
            $this->rt = $this->session->userdata('rt');
            $this->nama = $this->session->userdata('nama');

            if(!$this->session->has_userdata('status')){
                redirect('auth/','refresh');
            } else {
                if ($this->session->userdata('role') == 'adminMaster') {
                    redirect('admin/','refresh');
                } else if ($this->session->userdata('role') == 'Ketua RT') {
                    redirect('ketuaRT/','refresh');
                } else if ($this->session->userdata('role') == 'Bendahara') {
                    redirect('Bendahara/','refresh');
                }
            }
        }
// ===============================================================================
        public function index(){
            $data = [
                'content' => 'user/home',
                'title' => 'Home'
            ];
            $this->load->view('user/index', $data);
        }

// =========================SEKRETARIS ROLE=======================================
        public function notulensidisplay(){


          // $db = $this->m_user->get_notulensi($set_rt)->result_array();
          $data = [

              // 'fetch'                => $db,
              'content'              => 'user/v_notulensidisplay',
              'title'                => 'Riwayat Notulensi Rapat'
          ];
          $this->load->view('user/index', $data);
        }


        function fetch_notulensidisplay()
        {
          if ($this->role == 'Warga') {
            $set_rt = 'RT '.$this->rt;
          }else {
            site_url('auth/logout');
          }

          $fetch_data = $this->m_user->make_datatables_notulensidisplay($set_rt);
          $data = array();
          foreach($fetch_data as $row)
          {
            $tgl_buat_data = strftime("%d %B %Y",strtotime($row->tgl_buat));
            $no_udg_data = str_replace('-','/',$row->no_udg);
            $tgl_udg_data = strftime("%d %B %Y",strtotime($row->tgl_udg));
            $sub_array2 = array();
            $sub_array2[] =
            '<div class="media position-relative">
              <div class="media-body">
                <div class="col-lg-12 align-self-baseline">
                  <div class="card mb-3" style="max-width: 1200px;">
                    <div class="row no-gutters">
                      <div class="col-md-4">
                        <img height="300px" src="'.base_url('./assets/foto/notulensi/').$row->dokumentasi_rpt.'" class="card-img">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h6 class="card-title text-right">Diunggah '.$tgl_buat_data.' </h6>
                          <h2 class="card-title text-left">Notulensi Rapat dengan undangan rapat nomor '.$no_udg_data.' </h2>
                          <p class="card-text text-justify">'.$row->acara_udg.'</p>
                          <span class="card-text text-left">Rapat telah dilaksanakan pada  tanggal'.$tgl_udg_data.'</span><br>
                          <a href="'.base_url("user/notulensi_rapat/").$row->no_notulen.'" class="stretched-link">Selengkapnya</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>'
            ;
            $data[] = $sub_array2;
          }

          $output = array(
            "draw"                    =>     intval($_POST["draw"]),
            "recordsTotal"            =>      $this->m_user->get_all_data_notulensidisplay($set_rt),
            "recordsFiltered"         =>     $this->m_user->get_filtered_data_notulensidisplay($set_rt),
            "data"                    =>     $data
          );
          echo json_encode($output);
        }


        public function notulensi_rapat(){
          $id     = $this->uri->segment(3);
          if ($this->role == 'Warga') {
            $set_rt = 'RT '.$this->rt;
          }else {
            site_url('auth/logout');
          }

          $array_data = array(
                                'notulensi_rpt.no_notulen' => $id,
                                'notulensi_rpt.rt'         => $set_rt
                              );

          $surat  = $this->m_user->get_detail_notulensi($array_data)->result_array();
          $data['fetch'] = $surat;
          $data['title'] = 'Notulensi Rapat';
          $data['content'] = 'user/v_notulensi_rapat';
          $this->load->view('user/index', $data);
        }

        public function rapatdisplay(){
          if ($this->role == 'Warga') {
            $set_rt = 'RT '.$this->rt;
          }else {
            site_url('auth/logout');
          }
          // $rt_found = array('rt' => $set_rt );

          // $db = $this->m_user->selectWithWhere('surat_undangan', $rt_found)->result_array();
          $data = [

              // 'fetch'                => $db,
              'content'              => 'user/v_rapatdisplay',
              'title'                => 'Riwayat Surat Undangan Rapat'
          ];
          $this->load->view('user/index', $data);
        }

        function fetch_rapatdisplay()
        {
          if ($this->role == 'Warga') {
            $set_rt = 'RT '.$this->rt;
          }else {
            site_url('auth/logout');
          }

          $fetch_data = $this->m_user->make_datatables_rapatdisplay($set_rt);
          $data = array();
          foreach($fetch_data as $row)
          {
            $tgl_buat_data = strftime("%d %B %Y",strtotime($row->tgl_buat));
            $no_udg_data = str_replace('-','/',$row->no_udg);
            $tgl_udg_data = strftime("%d %B %Y",strtotime($row->tgl_udg));
            $sub_array2 = array();
            $sub_array2[] ='<div class="media position-relative">
              <div class="media-body">
                <div class="col-lg-12 align-self-baseline">
                  <div class="card mb-3" style="max-width: 1000px;">
                    <div class="row no-gutters">
                      <div class="col-md-4">
                        <img src="'.base_url('./assets/foto/bandung.jpg') .'" class="card-img img-fluid">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h6 class="card-title text-right">Tanggal Unggah '.$tgl_buat_data.' </h6>
                          <h2 class="card-title text-left">Surat undangan rapat nomor '.$no_udg_data.' </h2>
                          <p class="card-text text-justify">'.$row->acara_udg.'</p>
                          <span class="card-text text-left">Rapat telah dilaksanakan pada  tanggal '.$tgl_udg_data.'</span><br>
                          <a href="'.base_url("user/rapat_detail/").$row->no_udg.'" class="stretched-link">Selengkapnya</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>'
            ;
            $data[] = $sub_array2;
          }

          $output = array(
            "draw"                    =>     intval($_POST["draw"]),
            "recordsTotal"            =>      $this->m_user->get_all_data_rapatdisplay($set_rt),
            "recordsFiltered"         =>     $this->m_user->get_filtered_data_rapatdisplay($set_rt),
            "data"                    =>     $data
          );
          echo json_encode($output);
        }

        public function rapat_detail(){
          $id     = $this->uri->segment(3);

          if ($this->role == 'Warga') {
            $set_rt = 'RT '.$this->rt;
            $ketua  = array(
              'role' => 'Ketua RT',
              'rt'   => $this->rt
            );
            $array_data = array(
                                  'no_udg'     => $id,
                                  'rt'         => $set_rt
                                );
          }else {
            site_url('auth/logout');
          }

          $ketua_rt  = $this->m_user->cek_ketua($ketua)->result_array();
          $db = $this->m_user->selectWithWhere('surat_undangan', $array_data)->result_array();
          $data['fetch'] = $db;
          $data['fetch_ketua'] = $ketua_rt;
          $data['title'] = 'Detail Surat Undangan Rapat';
          $data['content'] = 'user/v_detailrpt';
          $this->load->view('user/index', $data);
        }
// ================================================================================
        public function formSuratPengantar(){
            $id         = 'surat_pengantar';
            $nama_field = 'nomor_surat';
            $nama_tabel = 'surat_pengantar';
            $set_rt = 'RT '.$this->rt;

            $generate_id = $this->m_admin->get_id_adapt($id,$nama_tabel,$set_rt);

            $data = [
                'content' => 'user/formSuratPengantar',
                'title' => 'Surat Pengantar',
                'generate_id' => $generate_id
            ];
            $this->load->view('user/index', $data);
        }
// ================================================================================
        public function insertSuratPengantar(){
            $this->form_validation->set_rules([
                [
                    'field' => 'keperluan',
                    'label' => 'Keperluan',
                    'rules' => 'trim|required|regex_match[/^[a-zA-Z ]/]'
                ]
            ]);

            if ($this->input->post()) {
                $nomor_surat = $this->input->post('nomor_surat');
                $keperluan = $this->input->post('keperluan');
                $nik = $this->m_admin->userJoinWarga($this->session->userdata('id_user'))->result()[0]->nik;
                $set_rt = 'RT '.$this->rt;

                if ($this->form_validation->run() == TRUE) {
                    $data = [
                        'nomor_surat' => $nomor_surat,
                        'keperluan' => $keperluan,
                        'nik' => $nik,
                        'rt' => $set_rt
                    ];
                    $insert_suratnya = $this->m_admin->input_data('surat_pengantar',$data);
                    // $id_surat = $this->m_admin->getNomorSuratPengantar()->row()->nomor_surat;
                    $data_status_surat = [
                        'nomor_surat' => $nomor_surat,
                        'status' => 'pengajuan'
                    ];
                    $insert_ke_status = $this->m_admin->input_data('status_surat',$data_status_surat);

                    if ($insert_ke_status) {
                        $url = base_url('user/riwayatSuratPengantar');

                        $json = [
                            'message' => "Pengajuan Surat Pengantar Berhasil Diinput..",
                            'url' => $url
                        ];
                    }else {
                        $json['errors'] = "Pengajuan Surat Pengantar Gagal Diinput..!";
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
                redirect('user/formSuratPengantar','refresh');
            }
        }
// ================================================================================
        public function formKomplain(){
            $id = 'komplain';
            $nama_field = 'nomor_komplain';
            $nama_tabel = 'komplain';
            $set_rt = 'RT '.$this->rt;

            $generate_id = $this->m_admin->get_id_adapt($id,$nama_tabel,$set_rt);
            $data = [
                'content' => 'user/formKomplain',
                'title' => 'Komplain',
                'generate_id' => $generate_id
            ];
            $this->load->view('user/index', $data);
        }
// ================================================================================
        public function insertKomplain(){
            $this->form_validation->set_rules([
                [
                    'field' => 'lokasi',
                    'label' => 'Lokasi',
                    'rules' => 'trim|regex_match[/^[a-zA-Z0-9 ]/]'
                ],
                [
                    'field' => 'keluhan',
                    'label' => 'Keluhan',
                    'rules' => 'trim|required|regex_match[/^[a-zA-Z ]/]'
                ]
            ]);

            if ($this->input->post()) {
                $nomor_komplain = $this->input->post('nomor_komplain');
                $tanggal_komplain = $this->input->post('tanggal_komplain');
                $lokasi = $this->input->post('lokasi');
                $keluhan = $this->input->post('keluhan');
                $nik = $this->m_admin->userJoinWarga($this->session->userdata('id_user'))->result()[0]->nik;
                $set_rt = 'RT '.$this->rt;

                $config['upload_path']          = './assets/foto/komplain';
                // $config['file_name']            = $this->input->post('gbr_surat');
                $config['allowed_types']        = 'jpg|png|jpeg';
                $config['max_size']             = 2000; // 1MB

                $this->load->library('upload', $config);

                if ($this->form_validation->run() == TRUE) {
                    if ($this->upload->do_upload('gambar')) {
                        $data_upload = $this->upload->data('file_name');
                        $data = [
                            'nomor_komplain' => $nomor_komplain,
                            'tanggal_komplain' => $tanggal_komplain,
                            'lokasi' => $lokasi,
                            'keluhan' => $keluhan,
                            'lingkup' => 'RT',
                            'status' => 'proses',
                            'nik' => $nik,
                            'gambar' => $data_upload,
                            'rt' => $set_rt
                        ];

                        $insertKomplain = $this->m_admin->input_data('komplain', $data);

                        if ($insertKomplain) {
                            $url = base_url('user/riwayatKomplain');

                            $json = [
                                'message' => "Pengaduan berhasil diinput..",
                                'url' => $url
                            ];
                        }else {
                            $json['errors'] = "Pengaduan gagal diinput..!";
                        }

                    } else {
                        $gambar_prob = $this->upload->display_errors('', '');

                        $json = [
                        'pict' => $gambar_prob,
                        ];
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
                redirect('user/formKomplain','refresh');
            }
        }
// ===============================================================================
        public function riwayatSuratPengantar(){
            $riwayatSurat = $this->m_admin->riwayatSuratPengantar($this->session->userdata('id_user'))->result_array();
            $data = [
                'content' => 'user/riwayatSuratPengantar',
                'title' => 'List Surat Pengantar',
                'listSurat' => $riwayatSurat
            ];
            $this->load->view('user/index', $data);
        }

        public function riwayatKomplain(){
            $riwayatKomplain = $this->m_user->riwayatKomplain($this->session->userdata('id_user'))->result_array();
            $data = [
                'content' => 'user/riwayatKomplain',
                'title' => 'List Pengaduan Komplain',
                'listKomplain' => $riwayatKomplain
            ];
            $this->load->view('user/index', $data);

        }

        public function hasilKomplain($nomor_komplain){
            $table = 'tindak_lanjut';
            $where = ['nomor_komplain' => $nomor_komplain];
            $hasilKomplain = $this->m_user->selectWithWhere($table,$where)->row();
            $data = [
                'content' => 'user/hasilKomplain',
                'title' => 'Hasil Komplain',
                'hasilKomplain' => $hasilKomplain
            ];
            $this->load->view('user/index', $data);
        }

// ==================================================================================
        public function editSuratPengantar($id){

                $table = 'surat_pengantar';
                $where = ['nomor_surat' => $id];
                $data_surat = $this->m_admin->selectWithWhere($table,$where)->row();
                $data = [
                    'content' => 'user/editSuratPengantar',
                    'title' => 'Edit Surat Pengantar',
                    'data_surat' => $data_surat
                ];
                $this->load->view('user/index', $data);
        }

        public function updateSuratPengantar(){
            $this->form_validation->set_rules([
                [
                    'field' => 'keperluan',
                    'label' => 'Keperluan',
                    'rules' => 'trim|required|regex_match[/^[a-zA-Z ]/]'
                ]
            ]);

            if ($this->input->post()) {
                $nomor_surat = $this->input->post('nomor_surat');
                $keperluan = $this->input->post('keperluan');


                if ($this->form_validation->run() == TRUE) {
                    $data = [
                        'keperluan' => $keperluan
                    ];
                    $data2 = [
                        'nomor_surat' => $nomor_surat,
                        'status' => 'pengajuan'
                    ];
                    $update_surat_pengantar = $this->m_admin->edit_data('surat_pengantar','nomor_surat',$nomor_surat,$data);
                    $update_status_surat = $this->m_admin->input_data('status_surat',$data2);

                    if ($update_surat_pengantar && $update_surat_pengantar) {
                        $url = base_url('user/riwayatSuratPengantar');

                        $json = [
                            'message' => "Pengajuan Surat Pengantar Berhasil Diinput..",
                            'url' => $url
                        ];
                    }else {
                        $json['errors'] = "Pengajuan Surat Pengantar Gagal Diinput..!";
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
                redirect('user/editSuratPengantar','refresh');
            }
        }
      //  ==============================================================================================================
      public function rekapbulan(){
        // $where = array(
        // 	'nip' => $this->session->userdata('nip')
        // );
        // $data['dataiuran'] = $this->petugas_model->view_data($where,'iuran_masuk')->result();
        $filtertahun = addslashes($this->input->get('tahun'));

        if(!empty($filtertahun)){
            $data['masuk'] = $this->m_admin->iuranmasuk($filtertahun)->result();
        }else{
            $data['masuk'] = $this->m_admin->iuranmasuk()->result();
        }
        $data['content'] = "admin/rekapbulan";
        $data['title'] = 'Tabel Data Rekap';

        $this->load->view('admin/index',$data);
    }

    public function tampilbulanuser(){
      $data['content'] = "user/tampilbulanuser";
      $data['title'] = 'Tabel Data Bulan';
      $rt = $this->session->userdata('rt');
      $data['iuran'] = $this->m_user->tampil_iuran_perbulan($rt)->result();

      $filtertahun = addslashes($this->input->get('tahun'));

      $data['tahun'] = $this->m_user->tampilTahunPembayaran()->result();
      $data['selectedTahun'] = $filtertahun;
      if(!empty($filtertahun)){
          $data['iuranTahun'] = $this->m_user->tampil_iuran_perbulan_pertahun($rt,$filtertahun)->result();
      }

      /*
      print_r($data['iuran']);
      Array ( [0] => stdClass Object ( [no_pembayaran] => 139 [no_rumah] => 15 [tanggal] => 2020-07-22 [jenis_warga] => Sementara [jumlah_iuran] => 58000 ) [1] => stdClass Object ( [no_pembayaran] => 49 [no_rumah] => 20 [tanggal] => 2020-07-12 [jenis_warga] => Sementara [jumlah_iuran] => 310000 ) )

      print_r($data['tahun']);
      Array ( [0] => stdClass Object ( [tahun] => 2018 ) [1] => stdClass Object ( [tahun] => 2019 ) [2] => stdClass Object ( [tahun] => 2020 ) )

      print_r($data['iuranTahun']);
      Array ( [0] => stdClass Object ( [no_pembayaran] => 141 [no_rumah] => 15 [tanggal] => 2020-07-22 [bulan_januari] => Rp. 10.000 [bulan_februari] => Rp. 15.000 [bulan_maret] => 10000 [bulan_april] => 20000 [bulan_mei] => [bulan_juni] => [bulan_juli] => 8000 [bulan_agustus] => [bulan_september] => [bulan_oktober] => [bulan_november] => [bulan_desember] => [jenis_warga] => Sementara [jumlah_iuran] => 38000 [tahun] => 2018 ) [1] => stdClass Object ( [no_pembayaran] => 49 [no_rumah] => 20 [tanggal] => 2020-07-12 [bulan_januari] => 10000 [bulan_februari] => 10000 [bulan_maret] => 10000 [bulan_april] => 10000 [bulan_mei] => 10000 [bulan_juni] => 10000 [bulan_juli] => 10000 [bulan_agustus] => 10000 [bulan_september] => 10000 [bulan_oktober] => 10000 [bulan_november] => 10000 [bulan_desember] => 10000 [jenis_warga] => Sementara [jumlah_iuran] => 120000 [tahun] => 2018 ) )
      */

      $this->load->view('user/index',$data);
  }
public function filteriuranmasuk($bulan,$tahun){
    return $this->db->query("SELECT
      date_format(tanggal,'%m') as 'bulan',
      sum(nominal) as 'nominal'
      from pembayaran
      where date_format(tanggal,'%Y') = $tahun and date_format(tanggal,'%m') = $bulan
      group by 1");
  }
  public function filterPemasukan()
    {
        $bulan = $this->input->get('bulan');
        $where = [
            'pembayaran_bulan' => $bulan
        ];
        if ($bulan == '' || $bulan == null) {
            echo json_encode($this->m_admin->tampil_iuran_masuk()->result());
        } else {
            echo json_encode($this->m_admin->tampil_iuran_masuk($where)->result());
        }
        $this->load->view('user/index',$data);
    }
    // public function filteriuranmasuk($bulan,$tahun){
    //     return $this->db->query("SELECT
    //     date_format(tanggal,'%m') as 'bulan',
    //     sum(nominal) as 'nominal'
    //     from pembayaran
    //     where date_format(tanggal,'%Y') = $tahun and date_format(tanggal,'%m') = $bulan
    //     group by 1");
    // }
    // public function filterPemasukan(){
    //         $bulan = $this->input->get('bulan');
    //         $where = [
    //             'pembayaran_bulan' => $bulan
    //         ];
    //         if ($bulan == '' || $bulan == null) {
    //             echo json_encode($this->m_admin->tampil_iuran_masuk()->result());
    //         } else {
    //             echo json_encode($this->m_admin->tampil_iuran_masuk($where)->result());
    //         }
    // }
    public function tabeldataiurankeluaruser(){
      $data['title'] = 'Tabel Data Keluar';

      $filterbulan = addslashes($this->input->get('bulan'));
      $filtertahun = addslashes($this->input->get('tahun'));
      $rt = $this->session->userdata('rt');

      $dataPengeluaran = array();

      if(!empty($filtertahun)){
            $data['dataiurank'] = $this->m_admin->tampil_iuran_keluar($rt,$filterbulan,$filtertahun)->result_array();
            $resultPengeluaran = $this->m_admin->grafikPengeluaranPerbulanPertahun($rt,$filterbulan,$filtertahun)->result();

            foreach ($resultPengeluaran as $row) {
                array_push($dataPengeluaran, array('label' => $row->tanggal, 'y' => $row->total));
            }
      }else{
            $data['dataiurank'] = $this->m_admin->tampil_iuran_keluar($rt)->result_array();
            $resultPengeluaran = $this->m_admin->grafikPengeluaran($rt)->result();

            foreach ($resultPengeluaran as $row) {
                array_push($dataPengeluaran, array('label' => $row->tahun, 'y' => $row->total));
            }
      }
      $data['jumlahPengeluaran'] = $dataPengeluaran;
        $data['content'] = "user/tabelpengeluaranuser.php";
        $this->load->view('user/index',$data);
    }
    public function tabelpemasukanuser(){
      $data['title'] = 'Tabel Data Pemasukkan';
      $rt = $this->session->userdata('rt');

      $data['dataiuranmsk'] = $this->m_admin->tampil_iuran_masuk($rt)->result_array();

      $filterbulan = addslashes($this->input->get('bulan'));
      $filtertahun = addslashes($this->input->get('tahun'));

      $dataPemasukan = array();

      if(!empty($filtertahun)){
            $data['dataiuranmsk'] = $this->m_admin->tampil_iuran_masuk($rt,$filterbulan,$filtertahun)->result_array();
            $resultPemasukan = $this->m_admin->grafikPemasukanPerbulanPertahun($rt,$filterbulan,$filtertahun)->result();

            foreach ($resultPemasukan as $row) {
                array_push($dataPemasukan, array('label' => $row->tanggal, 'y' => $row->total));
            }
      }else{
            $data['dataiuranmsk'] = $this->m_admin->tampil_iuran_masuk($rt)->result_array();
            $resultPemasukan = $this->m_admin->grafikPemasukan($rt)->result();

            foreach ($resultPemasukan as $row) {
                array_push($dataPemasukan, array('label' => $row->tahun, 'y' => $row->total));
            }
      }

      $data['jumlahPemasukan'] = $dataPemasukan;

      $data['content'] = "user/tabelpemasukankolektor.php";
      $this->load->view('user/index',$data);
  }
    public function detail_iuran_masuk(){
            $data['title'] = 'Detail Iuran Masuk';
            $no_rumah = addslashes($this->input->get('no_rumah'));
            $tahun = addslashes($this->input->get('tahun'));

            $data['detailpembayaran'] = $this->m_user->detail($no_rumah,$tahun)->result();
        // var_dump($this->m_admin->detail($where)->result());
            $data['content']="user/detailpembayaranuser.php";
            $this->load->view('user/index',$data);
    }
}


    /* End of file User.php */

?>
