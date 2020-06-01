<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class KetuaRT extends CI_Controller {

        public $id_user;
        public $role;
        public $rt;
        public function __construct(){
            parent::__construct();
            $this->load->model('m_admin');
            $this->load->library('form_validation');
            $this->load->library('pdf');
            $this->load->library('session');

            $this->id_user = $this->session->userdata('id_user');
            $this->role = $this->session->userdata('role');
            $this->rt = $this->session->userdata('rt');

            if(!$this->session->has_userdata('status')){
                redirect('auth/','refresh');
            } else {
                if ($this->session->userdata('role') == 'Warga') {
                    redirect('user/','refresh');
                }else if ($this->session->userdata('role') == 'Bendahara') {
                    redirect('admin/','refresh');
                }else if ($this->session->userdata('role') == 'Ketua RW') {
                    redirect('ketuaRW/','refresh');
                }else if ($this->session->userdata('role') == 'Sekretaris') {
                    redirect('sekretaris/','refresh');
                }
            }
        }

        public function index(){
            $rt = $this->rt;
            $dataPoints = array();
            $dataPoints2 = array();
            $dataPoints3 = array();
            $usulanPoints = $this->m_admin->CountData('surat_undangan', 'status', 0)->result_array();
            $query = $this->m_admin->CountData('warga','valid',0)->result_array();
            $result = $this->m_admin->grafikPendidikanRT($rt)->result();
            $result2 = $this->m_admin->grafikPekerjaanRT($rt)->result();
            $result3 = $this->m_admin->grafikWarga($rt)->result();
            foreach ($result as $row) {
                array_push($dataPoints, array('label' => $row->pendidikan, 'y' => $row->total));
            }
            foreach ($result2 as $row) {
                array_push($dataPoints2, array('label' => $row->pekerjaan, 'y' => $row->total));
            }
            foreach ($result3 as $row) {
                array_push($dataPoints3, array('label' => $row->jk, 'y' => $row->total));
            }
            $data = [
                'content'       => 'admin/dashboardRT',
                'title'         => 'Dashboard',
                'semuaWarga'    => $query,
                'dataPoints'    => $dataPoints,
                'dataPoints2'   => $dataPoints2,
                'dataPoints3'   => $dataPoints3,
                'usulan_points' => $usulanPoints,
                'dataiurank'    => $this->m_admin->tampil_iuran_keluar()->result_array(),
                'rt' => $rt
            ];
            $this->load->view('admin/index', $data);
        }


        public function inputWarga(){
            $rt = $this->rt;
            $data = [
                'content' => 'admin/inputWarga',
                'title' => 'Input Data Warga',
                'set_rt' => $rt
            ];
            // $data['content'] = 'admin/inputWarga';
            // $data['title'] = 'Input Data Warga';
            $this->load->view('admin/index', $data);
        }

        public function insertWarga(){


            $this->form_validation->set_rules([
                [
                    'field' => 'nik',
                    'label' => 'NIK',
                    'rules' => 'trim|required|is_unique[warga.nik]|numeric|min_length[16]|max_length[16]'
                ],
                [
                    'field' => 'nama',
                    'label' => 'Nama Lengkap',
                    'rules' => 'trim|required|regex_match[/^[a-zA-Z ]/]'
                ],
                [
                    'field' => 'tempat_lahir',
                    'label' => 'Tempat Lahir',
                    'rules' => 'trim|required|regex_match[/^[a-zA-Z ]/]'
                ],
                [
                    'field' => 'tanggal_lahir',
                    'label' => 'Tanggal Lahir',
                    'rules' => 'required'
                ],
                [
                    'field' => 'nama_jalan',
                    'label' => 'Nama Jalan',
                    'rules' => 'trim|required|regex_match[/^[a-zA-Z0-9 ]/]'
                ],
                [
                    'field' => 'no_rumah',
                    'label' => 'No Rumah',
                    'rules' => 'trim|numeric|required'
                ]
            ]);

            if ($this->input->post()) {
                $jenis_warga = $this->input->post('jenis_warga');
                $nik = $this->input->post('nik');
                $nama = $this->input->post('nama');
                $tempat_lahir = $this->input->post('tempat_lahir');
                $tanggal_lahir = $this->input->post('tanggal_lahir_submit');
                $pendidikan = $this->input->post('pendidikan');
                $pekerjaan = $this->input->post('pekerjaan');
                $agama = $this->input->post('agama');
                $jk = $this->input->post('jk');
                $status = $this->input->post('status');
                $nama_jalan = $this->input->post('nama_jalan');
                $no_rumah = $this->input->post('no_rumah');
                $gang = $this->input->post('gang');
                $rt = $this->input->post('rt');

                $nokk = $this->input->post('nokk');
                $hub_dlm_kel = $this->input->post('hub_dlm_kel');
                $nohp = $this->input->post('nohp');

                $config['upload_path']          = './assets/foto/warga';
                // $config['file_name']            = $this->input->post('gbr_surat');
                $config['allowed_types']        = 'jpg|png|jpeg';
                $config['max_size']             = 2000; // 1MB

                $this->load->library('upload', $config);

                if ($jenis_warga == "Tetap") {
                    $this->form_validation->set_rules([
                        [
                            'field' => 'nokk',
                            'label' => 'Nomor KK',
                            'rules' => 'trim|required|numeric'
                        ]
                    ]);
                } else {
                    $this->form_validation->set_rules([
                        [
                            'field' => 'nohp',
                            'label' => 'Nomor HP',
                            'rules' => 'trim|required|numeric|is_unique[warga.nohp]'
                        ]
                    ]);
                }

                if ($this->form_validation->run() == TRUE) {
                    if ($this->upload->do_upload('gambar')) {
                        $data_upload = $this->upload->data('file_name');
                        $data = [
                            'jenis_warga' => $jenis_warga,
                            'nik' => $nik,
                            'nama' => $nama,
                            'tempat_lahir' => $tempat_lahir,
                            'tanggal_lahir' => $tanggal_lahir,
                            'pendidikan' => $pendidikan,
                            'pekerjaan' => $pekerjaan,
                            'agama' => $agama,
                            'jk' => $jk,
                            'status' => $status,
                            'nama_jalan' => $nama_jalan,
                            'no_rumah' => $no_rumah,
                            'gang' => $gang,
                            'rt' => $rt,
                            'gambar' => $data_upload
                        ];

                        if($jenis_warga == "Tetap") {
                            $data['hub_dlm_kel'] = $hub_dlm_kel;
                            $data['nokk'] = $nokk;
                        } else {
                            $data['nohp'] = $nohp;
                        }

                        $query = $this->m_admin->input_data('warga', $data);

                        if ($query) {
                            $url = base_url('ketuaRT/inputWarga');

                            $json = [
                                'message' => "Data Warga berhasil diinput..",
                                'url' => $url
                            ];
                        }else {
                            $json['errors'] = "Data Warga gagal diinput..!";
                        }

                    }else {
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
                redirect('ketuaRT/inputWarga','refresh');
            }
        }

        public function tabelDataWarga(){
            $set_rt = $this->rt;
            $table = 'warga';
            $where = ['jenis_warga' => 'sementara','rt' => $set_rt];
            $where2 = ['jenis_warga' => 'tetap','rt' => $set_rt];
            $list_warga_sementara = $this->m_admin->selectWithWhere($table,$where)->result_array();
            $list_warga_tetap = $this->m_admin->selectWithWhere($table,$where2)->result_array();
            $data = [
                'content' => 'admin/tabelDataWarga',
                'title' => 'List Data Warga',
                'list_warga_sementara' => $list_warga_sementara,
                'list_warga_tetap' => $list_warga_tetap
            ];
            $this->load->view('admin/index', $data);
        }

        public function daftarSuratPengantar(){
            $rt = $this->rt;
            $list_surat_pengantar = $this->m_admin->list_surat_pengantar($rt)->result_array();
            $data = [
                'content' => 'admin/daftarSuratPengantar',
                'title' => 'List Surat Pengantar',
                'list_surat_pengantar' => $list_surat_pengantar
            ];
            $this->load->view('admin/index', $data);
        }

        public function daftarKomplain(){
            $rt = $this->rt;
            $list_komplain = $this->m_admin->komplainJoinWargaRT($rt)->result_array();
            $data = [
                'content' => 'admin/daftarKomplain',
                'title' => 'List Komplain',
                'list_komplain' => $list_komplain
            ];
            $this->load->view('admin/index', $data);
        }

        public function inputHasilKomplain($no_komplen){
            $data = [
                'content' => 'admin/inputHasilKomplain',
                'title' => 'Input Hasil Komplain',
                'no_komplen' => $no_komplen,
            ];
            $this->load->view('admin/index', $data);

        }

        public function insertHasilKomplain(){
            $this->form_validation->set_rules([
                [
                    'field' => 'hasil_komplain',
                    'label' => 'Tindak lanjut',
                    'rules' => 'trim|required'
                ]

            ]);

            if ($this->input->post()) {
                $nomor_komplain = $this->input->post('nomor_komplain');
                $hasil_komplain = $this->input->post('hasil_komplain');
                $tanggal = date('Y-m-d');

                $config['upload_path']          = './assets/foto/tindak_lanjut';
                // $config['file_name']            = $this->input->post('gbr_surat');
                $config['allowed_types']        = 'jpg|png|jpeg';
                $config['max_size']             = 2000; // 1MB

                $this->load->library('upload', $config);


                if ($this->form_validation->run() == TRUE) {
                    if ($this->upload->do_upload('gambar')) {
                        $data_upload = $this->upload->data('file_name');
                        $data = [
                            'nomor_komplain' => $nomor_komplain,
                            'hasil_tindak_lanjut' => $hasil_komplain,
                            'tgl_tindak_lanjut' => $tanggal,
                            'gambar' => $data_upload
                        ];
                        $data2 = [
                            'status' => 'selesai'
                        ];

                        $input_hasil = $this->m_admin->input_data('tindak_lanjut',$data);
                        $update_status = $this->m_admin->edit_data('komplain','nomor_komplain',$nomor_komplain,$data2);

                        if ($input_hasil && $update_status) {
                            $url = base_url('ketuaRT/daftarKomplain');

                            $json = [
                                'message' => "Hasil Tindak Lanjut Berhasil Diinput..",
                                'url' => $url
                            ];
                        }else {
                            $json['errors'] = "Hasil Tindak Lanjut Gagal Diinput..!";
                        }
                    } else {
                        $gambar_prob = $this->upload->display_errors('', '');

                        $json = [
                        'pict' => $gambar_prob,
                        ];
                        // redirect('ketuaRT/inputHasilKomplain/'.$no_komplen,'refresh');
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
                redirect('ketuaRT/inputHasilkomplain','refresh');
            }
        }

        public function klik_konfirmasi_surat_pengantar($id){
            $data = [
                'nomor_surat' => $id,
                'status' => 'diterima'
            ];

            $query = $this->m_admin->input_data('status_surat',$data);

            if ($query) {
                $json['message'] = 'Surat Pengantar Berhasil Diapproval';
            }else {
                $json['errors'] = 'Surat Pengantar Gagal Diapproval';
            }
            echo json_encode($json);
        }

        public function detailWarga($id){
            $data  = $this->m_admin->detailWargaById($id)->row();
            echo json_encode($data);
        }

        public function editWarga(){
            $this->form_validation->set_rules([
                [
                    'field' => 'nama',
                    'label' => 'Nama Lengkap',
                    'rules' => 'trim|required|regex_match[/^[a-zA-Z ]/]'
                ],
                [
                    'field' => 'tempat_lahir',
                    'label' => 'Tempat Lahir',
                    'rules' => 'trim|required|regex_match[/^[a-zA-Z ]/]'
                ],
                [
                    'field' => 'tanggal_lahir',
                    'label' => 'Tanggal Lahir',
                    'rules' => 'required'
                ],
                [
                    'field' => 'nama_jalan',
                    'label' => 'Nama Jalan',
                    'rules' => 'trim|required|regex_match[/^[a-zA-Z ]/]'
                ],
                [
                    'field' => 'no_rumah',
                    'label' => 'No Rumah',
                    'rules' => 'trim|numeric|required'
                ]
            ]);

            if ($this->input->post()) {
                $jenis_warga = $this->input->post('jenis_warga');
                $nik = $this->input->post('nik');
                $nama = $this->input->post('nama');
                $tempat_lahir = $this->input->post('tempat_lahir');
                $tanggal_lahir = $this->input->post('tanggal_lahir_submit');
                $pendidikan = $this->input->post('pendidikan');
                $pekerjaan = $this->input->post('pekerjaan');
                $agama = $this->input->post('agama');
                $jk = $this->input->post('jk');
                $status = $this->input->post('status');
                $nama_jalan = $this->input->post('nama_jalan');
                $no_rumah = $this->input->post('no_rumah');
                $gang = $this->input->post('gang');

                $nokk = $this->input->post('nokk');
                $hub_dlm_kel = $this->input->post('hub_dlm_kel');
                $nohp = $this->input->post('nohp');

                $config['upload_path']          = './assets/foto/warga';
                // $config['file_name']            = $this->input->post('gbr_surat');
                $config['allowed_types']        = 'jpg|png|jpeg';
                $config['max_size']             = 2000; // 1MB

                $this->load->library('upload', $config);

                if ($this->form_validation->run() == TRUE) {
                    if ($this->upload->do_upload('gambar')) {
                        $data_upload = $this->upload->data('file_name');
                        $data = [
                            'nama' => $nama,
                            'tempat_lahir' => $tempat_lahir,
                            'tanggal_lahir' => $tanggal_lahir,
                            'pendidikan' => $pendidikan,
                            'pekerjaan' => $pekerjaan,
                            'agama' => $agama,
                            'jk' => $jk,
                            'status' => $status,
                            'nama_jalan' => $nama_jalan,
                            'no_rumah' => $no_rumah,
                            'gang' => $gang,
                            'nokk' => $nokk,
                            'hub_dlm_kel' => $hub_dlm_kel,
                            'nohp' => $nohp,
                            'valid' => 0,
                            'pesan' => '',
                            'gambar' => $data_upload
                        ];
                        $query = $this->m_admin->edit_data('warga','nik',$nik,$data);

                        if ($query) {
                            $url = base_url('ketuaRT/tabelDataWarga');

                            $json = [
                                'message' => "Data Warga berhasil diubah..",
                                'url' => $url
                            ];
                        }else {
                            $json['errors'] = "Data Warga Gagal Diubah";
                        }

                    }else {
                        $gambar_prob = $this->upload->display_errors('', '');

                        $json = [
                        'pict' => $gambar_prob,
                        ];
                        // redirect('ketuaRT/tabelDataWarga','refresh');
                    }

                    // $query = $this->m_admin->edit_data('warga','nik',$nik,$data);

                    // if ($query) {
                    //     $url = base_url('ketuaRT/tabelDataWarga');

                    //     $json = [
                    //         'message' => "Data Warga berhasil diubah..",
                    //         'url' => $url
                    //     ];
                    // }else {
                    //     $json['errors'] = "Data Warga Gagal Diubah";
                    // }
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
                redirect('ketuaRT/editWarga','refresh');
            }
        }

        public function declineSuratPengantar() {
            $this->form_validation->set_rules([
                [
                    'field' => 'pesan',
                    'label' => 'Pesan',
                    'rules' => 'trim|required|regex_match[/^[a-zA-Z ]/]'
                ]
            ]);

            if ($this->input->post()) {
                $nomor_surat = $this->input->post('nomor_surat');
                $pesan = $this->input->post('pesan');

                if ($this->form_validation->run() == TRUE) {
                    $data = [
                        'nomor_surat' => $nomor_surat,
                        'pesan' => $pesan,
                        'status' => 'ditolak'
                    ];
                    $tolak = $this->m_admin->input_data('status_surat',$data);

                    if ($tolak) {
                        $url = base_url('ketuaRT/daftarSuratPengantar');

                        $json = [
                            'message' => "Surat pengantar berhasil ditolak..",
                            'url' => $url
                        ];
                    } else {
                        $json['errors'] = "Surat pengantar gagal ditolak..";
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
                redirect('ketuaRT/daftarSuratPengantar','refresh');
            }
        }

        public function tbl_usulan_ketua(){
            $tabel = 'surat_undangan';
            if ($this->role == 'Ketua RT') {
              $set_rt = 'RT '.$this->rt;
            }else{
              redirect('auth/logout','refresh');
            }
            $where = [
                'status' => 0,
                'rt'     => $set_rt
            ];
            $list_data = $this->m_admin->selectWithWhere($tabel,$where)->result_array();
            $data = [
                'content'   => 'admin/tbl_usul_ketua',
                'title'     => 'Riwayat Usulan Ketua RT',
                'list_data' => $list_data
            ];
            $this->load->view('admin/index', $data);
        }

        public function usul_pembuatan(){
            $id           = 'rapat';
            $id_2         = 'kegiatan';
            $nama_field   = 'no_udg';
            $nama_tabel   = 'surat_undangan';

            if ($this->role == 'Ketua RT') {
              $set_rt = 'RT '.$this->rt;
            }else{
              site_url('auth/logout');
            }

            $generate_id = $this->m_admin->get_id_adapt_sekre($id,$nama_tabel,$set_rt);
            $generate_id2 = $this->m_admin->get_id_adapt_sekre($id_2,$nama_tabel,$set_rt);
            $content = 'admin/form_usulan';
            $title = 'Form Usulan Rapat';
            $data = [
              'generate_id' => $generate_id,
              'generate_id2' => $generate_id2,
              'content'     => $content,
              'title'       => $title
            ];
            $this->load->view('admin/index', $data);

        }

        public function klik_hapus_usulan_rapat($id2){
            $id = array('no_udg' => $id2);
            $query = $this->m_admin->delete_data($id , 'surat_undangan');

            if (!$query) {
                $json['message'] = 'Data Usulan Rapat Berhasil Dihapus';
            }else {
                $json['errors'] = 'Data Usulan Rapat Dihapus';
            }
            echo json_encode($json);
        }

        public function insertUsulanRT(){
          $this->form_validation->set_rules([
              [
                  'field' => 'no_udg',
                  'label' => 'Jenis Surat',
                  'rules' => 'trim|required'
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
                  'field' => 'usul_surat',
                  'label' => 'Usulan Rapat',
                  'rules' => 'trim|required|regex_match[/^[\w]/]|max_length[500]'
              ],

              [
                  'field' => 'tgl_rpt',
                  'label' => 'Tanggal Surat ',
                  'rules' => 'trim|required'
              ],

              [
                  'field' => 'jam_udg',
                  'label' => 'Jam Undangan ',
                  'rules' => 'trim|required'
              ]
          ]);

          if ($this->input->post()) {
            $no_udg       = $this->input->post('no_udg');
            $tujuan_srt   = $this->input->post('tujuan_surat');
            $tempat_udg   = $this->input->post('tempat_udg');
            $usul_surat   = $this->input->post('usul_surat');
            $tgl_rpt      = $this->input->post('tgl_rpt');
            $jam_udg      = $this->input->post('jam_udg');

            if ($this->role == 'Ketua RT') {
              $set_rt = 'RT '.$this->rt;
            }else{
              site_url('auth/logout');
            }


            if ($this->form_validation->run() == TRUE) {
              $data = [
                'no_udg'        => $no_udg,
                'tujuan_surat'  => $tujuan_srt,
                'tempat_udg'    => $tempat_udg,
                'usulan_rpt'    => $usul_surat,
                'tgl_udg'       => $tgl_rpt,
                'jam_udg'       => $jam_udg,
                'rt'            => $set_rt,
                'id_user'       => $this->id_user
              ];

              $query = $this->m_admin->input_data('surat_undangan', $data);

              if ($query) {
                $url = base_url('ketuaRT/tbl_usulan_ketua');

                $json = [
                    'message' => "Data Usulan Pembuatan Surat Undangan berhasil diinput..",
                    'url' => $url
                ];
              } else {
                $json['errors'] = "Data Usulan Pembuatan Surat Undangan gagal diinput..!";
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
            redirect('KetuaRT/usul_pembuatan','refresh');
          }
        }


    }

    /* End of file ketuaRT.php */

?>
