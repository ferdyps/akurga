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
          if ($this->role == 'Warga') {
            $set_rt = 'RT '.$this->rt;
          }else {
            site_url('auth/logout');
          }

          $db = $this->m_user->get_notulensi($set_rt)->result_array();
          $data = [

              'fetch'                => $db,
              'content'              => 'user/v_notulensidisplay',
              'title'                => 'Riwayat Notulensi Rapat'
          ];
          $this->load->view('user/index', $data);
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
          $rt_found = array('rt' => $set_rt );

          $db = $this->m_user->selectWithWhere('surat_undangan', $rt_found)->result_array();
          $data = [

              'fetch'                => $db,
              'content'              => 'user/v_rapatdisplay',
              'title'                => 'Riwayat Surat Undangan Rapat'
          ];
          $this->load->view('user/index', $data);
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

        public function tampilbulan(){
            $id_user = $this->session->userdata('id_user');
            $data['content'] = "user/tampilbulan";
            $data['title'] = 'Tabel Data Bulan';
            $data['iuran'] = $this->m_user->tampil_iuran_perbulan($id_user)->result();

            $filtertahun = addslashes($this->input->get('tahun'));

        $data['tahun'] = $this->m_admin->tampilTahunPembayaran()->result();
        if(!empty($filtertahun)){
            $data['iuranTahun'] = $this->m_user->tampil_iuran_perbulan_pertahun($filtertahun,$id_user)->result();
        }
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
            $data['dataiurank'] = $this->m_user->tampil_iuran_keluar()->result_array();
            $data['content'] = "user/tabelpengeluaranuser.php";
            $this->load->view('user/index',$data);
        }
        public function detail_iuran_masuk(){
                $data['title'] = 'Detail Iuran Masuk';
                $nik = addslashes($this->input->get('nik'));
                $tahun = addslashes($this->input->get('tahun'));

                $data['detailpembayaran'] = $this->m_user->detail($nik,$tahun)->result();
            // var_dump($this->m_admin->detail($where)->result());
            $data['content']="user/detailpembayaranuser.php";
            $this->load->view('user/index',$data);
        }
}

    /* End of file User.php */

?>
