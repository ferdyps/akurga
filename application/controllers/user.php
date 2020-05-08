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
                if ($this->session->userdata('role') == 'adminMaster' || $this->session->userdata('role') == 'Ketua RT' || $this->session->userdata('role') == 'Bendahara') {
                    redirect('admin/','refresh');
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
              'title'                => 'Daftar Notulensi Rapat'
          ];
          $this->load->view('user/index', $data);
        }

        public function notulensi_rapat(){
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

// ================================================================================
        public function formSuratPengantar(){

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

                if ($this->form_validation->run() == TRUE) {
                    $data = [
                        'nomor_surat' => $nomor_surat,
                        'keperluan' => $keperluan,
                        'nik' => $nik
                    ];
                    $insert_suratnya = $this->m_admin->input_data('surat_pengantar',$data);
                    $id_surat = $this->m_admin->getNomorSuratPengantar()->row()->nomor_surat;
                    $data_status_surat = [
                        'nomor_surat' => $id_surat,
                        'status' => 'pengajuan'
                    ];
                    $insert_ke_status = $this->m_admin->input_data('status_surat',$data_status_surat);


                    if ($insert_suratnya && $insert_ke_status) {
                        ?>
                        <script>
                            alert('Data Berhasil Diinputkan');
                            location = "<?php base_url('user/riwayatSuratPengantar');?>";
                        </script>
                        <?php
                    }else {
                        ?>
                        <script>
                            alert('Data Gagal Diinputkan');
                            location = "<?php base_url('user/riwayatSuratPengantar');?>";
                        </script>
                        <?php
                    }
                } else {
                    $id         = 'surat_pengantar';
                    $nama_field = 'nomor_surat';
                    $nama_tabel = 'surat_pengantar';
                    $set_rt = 'RT '.$this->rt;

                    $generate_id = $this->m_admin->get_id($id,$nama_field,$nama_tabel,$set_rt);
                    $data = [
                        'content' => 'user/formSuratPengantar',
                        'title' => 'Surat Pengantar',
                        'generate_id' => $generate_id
                    ];
                    $this->load->view('user/index', $data);
                }
            }else {
                $id         = 'surat_pengantar';
                $nama_field = 'nomor_surat';
                $nama_tabel = 'surat_pengantar';
                $set_rt = 'RT '.$this->rt;

                $generate_id = $this->m_admin->get_id($id,$nama_field,$nama_tabel,$set_rt);

                $data = [
                    'content' => 'user/formSuratPengantar',
                    'title' => 'Surat Pengantar',
                    'generate_id' => $generate_id
                ];
                $this->load->view('user/index', $data);
            }
        }
// ================================================================================
        public function formKomplain(){
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
                            'gambar' => $data_upload
                        ];
                    } else {
                        echo "gagal";
                        // redirect('user/formkomplain','refresh');
                    }

                    $insertKomplain = $this->m_admin->input_data('komplain', $data);

                    if ($insertKomplain) {
                        ?>
                        <script>
                            alert('Komplain Berhasil Diinputkan');
                            location = "<?php base_url('user/riwayatKomplain');?>";
                        </script>
                        <?php
                    }else {
                        ?>
                        <script>
                            alert('Komplain Gagal Diinputkan');
                            location = "<?php base_url('user/riwayatKomplain');?>";
                        </script>
                        <?php
                    }
                } else {
                    $id = 'komplain';
                    $nama_field = 'nomor_komplain';
                    $nama_tabel = 'komplain';
                    $set_rt = 'RT '.$this->rt;

                    $generate_id = $this->m_admin->get_id($id,$nama_field,$nama_tabel,$set_rt);
                    $data = [
                        'content' => 'user/formKomplain',
                        'title' => 'Komplain',
                        'generate_id' => $generate_id
                    ];
                    $this->load->view('user/index', $data);
                }
            } else {
                $id = 'komplain';
                $nama_field = 'nomor_komplain';
                $nama_tabel = 'komplain';
                $set_rt = 'RT '.$this->rt;

                $generate_id = $this->m_admin->get_id($id,$nama_field,$nama_tabel,$set_rt);
                $data = [
                    'content' => 'user/formKomplain',
                    'title' => 'Komplain',
                    'generate_id' => $generate_id
                ];
                $this->load->view('user/index', $data);
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
            $this->form_validation->set_rules('keperluan', 'Keperluan', 'trim|required|regex_match[/^[a-zA-Z ]/]');

            if ($this->input->post()) {
                $keperluan = $this->input->post('keperluan');


                if ($this->form_validation->run() == TRUE) {
                    $data = [
                        'keperluan' => $keperluan
                    ];
                    $update_surat_pengantar = $this->m_admin->edit_data('surat_pengantar','nomor_surat',$id,$data);
                    $data2 = [
                        'nomor_surat' => $id,
                        'status' => 'pengajuan'
                    ];
                    $update_status_surat = $this->m_admin->input_data('status_surat',$data2);

                    if ($update_status_surat && $update_surat_pengantar) {
                        ?>
                        <script>
                            alert('Surat Pengantar berhasil diupdate');
                            location = "<?php base_url('user/riwayatSuratPengantar');?>";
                        </script>
                        <?php
                    }else {
                        ?>
                        <script>
                            alert('Surat Pengantar gagal diupdate');
                            location = "<?php base_url('user/riwayatSuratPengantar');?>";
                        </script>
                        <?php
                    }

                } else {
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

            } else {
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


        }

      //  ==============================================================================================================

    public function tampilbulan(){
        $id_user = $this->session->userdata('id_user');
        $data['content'] = "user/tampilbulan";
        $data['title'] = 'Tabel Data Bulan';
        $data['iuran'] = $this->m_user->tampil_iuran_perbulan($id_user)->result();
        $this->load->view('user/index',$data);
    }
    public function tabeldataiurankeluaruser(){
        $data['title'] = 'Tabel Data Keluar';
        $data['dataiurank'] = $this->m_user->tampil_iuran_keluar()->result_array();
        $data['content'] = "user/tabelpengeluaranuser.php";
        $this->load->view('user/index',$data);
    }
    public function detail_iuran_masuk($nik){
        $where = array(
            'nik' => $nik
        );

        $data['detailpembayaran'] = $this->m_user->detail($where)->result();
        // var_dump($this->m_admin->detail($where)->result());
        $data['content']="user/detailpembayaranuser.php";
        $this->load->view('user/index',$data);
    }
}

    /* End of file User.php */

?>
