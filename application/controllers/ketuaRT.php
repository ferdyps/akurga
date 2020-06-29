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
            $this->nama = $this->session->userdata('nama');

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
            $dataAgama = array();
            $dataStatus = array();
            $usulanPoints = $this->m_admin->CountData('surat_undangan', 'status', 0)->result_array();
            $query = $this->m_admin->CountData('warga',['valid'=>0])->result_array();
            $result = $this->m_admin->grafikPendidikanRT($rt)->result();
            $result2 = $this->m_admin->grafikPekerjaanRT($rt)->result();
            $result3 = $this->m_admin->grafikWarga($rt)->result();
            $agama = $this->m_admin->grafikAgamaRT($rt)->result();
            $status = $this->m_admin->grafikStatusRT($rt)->result();

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
            foreach ($agama as $row) {
                array_push($dataAgama, array('label' => $row->agama, 'y' => $row->total));
            }
            foreach ($status as $row) {
                array_push($dataStatus, array('label' => $row->status, 'y' => $row->total));
            }
            $tampil_iuran = $this->m_admin->tampil_iuran_keluar($rt)->result_array();

            //notifikasi surat undangan
            $val_notif_jam_udg = array(
                                        'rt' => 'RT '.$this->rt,
                                        'notif_for' => 'Ketua', );
                                        $notifikasi_jam_udg_num = $this->m_admin->notifikasi_jam_udg($val_notif_jam_udg)->num_rows();
            $notifikasi_jam_udg = $this->m_admin->notifikasi_jam_udg($val_notif_jam_udg)->result_array();
            $whos = 'Ketua RT';
            //end of notifikasi surat undangan

            $data = [
                'content'       => 'admin/dashboardRT',
                'title'         => 'Dashboard',
                'semuaWarga'    => $query,
                'dataPoints'    => $dataPoints,
                'dataPoints2'   => $dataPoints2,
                'dataPoints3'   => $dataPoints3,
                'dataAgama'     => $dataAgama,
                'dataStatus'    => $dataStatus,
                'usulan_points' => $usulanPoints,
                'dataiurank'    => $tampil_iuran,
                'rt' => $rt,
                'whos' => $whos,
                'notifikasi_jam_udg_num' => $notifikasi_jam_udg_num,
                'notifikasi_jam_udg' => $notifikasi_jam_udg,
                'nama' => $this->nama
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
                            'rules' => 'trim|required|numeric|min_length[16]|max_length[16]'
                        ]
                    ]);
                } else {
                    $this->form_validation->set_rules([
                        [
                            'field' => 'nohp',
                            'label' => 'Nomor HP',
                            'rules' => 'trim|required|numeric|is_unique[warga.nohp]|min_length[11]|max_length[12]'
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
            $orderby = 'timestamp';
            $direction = 'DESC';
            $list_warga_sementara = $this->m_admin->selectWithWhereOrder($table,$where,$orderby,$direction)->result_array();
            $list_warga_tetap = $this->m_admin->selectWithWhereOrder($table,$where2,$orderby,$direction)->result_array();
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
            // $set_rt = $this->rt;
            $rt = 'RT '.$this->rt;
            $list_komplain = $this->m_admin->komplainJoinWargaRT($this->rt)->result_array();
            $list_hasil = $this->m_admin->tindakLanjutRT($rt)->result_array();
            $data = [
                'content' => 'admin/daftarKomplain',
                'title' => 'List Komplain',
                'list_komplain' => $list_komplain,
                'list_hasil' => $list_hasil
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
            $pengurus = $this->nama;
            $masa_berlaku = strtotime("+2 Days");
            $kadaluarsa = date('Y-m-d',$masa_berlaku);

            $data = [
                'nomor_surat' => $id,
                'status' => 'diterima',
                'expired_date' => $kadaluarsa
            ];
            $data2 = [
                'pengurus' => $pengurus
            ];

            $query = $this->m_admin->input_data('status_surat',$data);
            $query2 = $this->m_admin->edit_data('surat_pengantar','nomor_surat',$id,$data2);

            if ($query && $query2) {
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
                        if ($tanggal_lahir == '') {
                            $data = [
                                'nama' => $nama,
                                'tempat_lahir' => $tempat_lahir,
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
                            ];
                        } else {
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
                            ];
                        }
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


                        // $gambar_prob = $this->upload->display_errors('', '');

                        // $json = [
                        // 'pict' => $gambar_prob,
                        // ];
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
                  'rules' => 'trim|required|regex_match[/^[\w]/]|max_length[250]'
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
              $nama_tabel = 'surat_undangan';
              $array_check = array('tgl_udg' => $tgl_rpt,
                                    'rt' => $set_rt
                                  );
              $db_check     = $this->m_admin->selectWithWhere($nama_tabel, $array_check);
              if ($db_check->num_rows() > 0) {
                $json = [
                  'tgl_rpt' => 'Terdapat input undangan dengan tanggal pelaksanaan rapat yang sama',
                ];
              }else {
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

        public function riwayat_Undangan(){
          if ($this->role == 'Ketua RT') {
            $set_rt = 'RT '.$this->rt;
          }else {
            redirect('auth/logout','refresh');
          }

          $id = array(
            'status' => 1,
            'rt'     => $set_rt
          );

          $data['list_surat_udg'] = $this->m_admin->selectWithWhere('surat_undangan',$id)->result_array();
          $data['content'] = 'admin/tabel_undangan_ketuart';
          $data['title'] = 'Riwayat Surat Undangan';
          $this->load->view('admin/index', $data);
        }

        public function previewRapat(){
          $id     = $this->uri->segment(3);

          if ($this->role == 'Ketua RT') {
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

        public function riwayat_notulensi(){
          if ($this->role == 'Ketua RT') {
            $set_rt = 'RT '.$this->rt;
          }else {
            redirect('auth/logout','refresh');
          }

          $rt = array(
            'rt'     => $set_rt,
            'status' => 0
          );
          $data['list_notulen'] = $this->m_admin->selectWithWhere('notulensi_rpt',$rt)->result_array();
          $data['content'] = 'admin/tabel_notulensi_ketuart';
          $data['title'] = 'Riwayat Notulensi Rapat';
          $this->load->view('admin/index', $data);
        }

        public function dokumentasi_rapat()
        {
          $id     = $this->uri->segment(3);
          $no     = array('no_notulen' => $id );
          $surat  = $this->m_admin->selectWithWhere('notulensi_rpt', $no)->result_array();
          $data['fetch'] = $surat;
          $data['title'] = 'Detail Dokumentasi Rapat';
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

        public function notulensi_rapat(){

          $id     = $this->uri->segment(3);
          $surat  = $this->m_admin->get_detail_notulensi($id)->result_array();
          $data['fetch'] = $surat;
          $data['title'] = 'Notulensi Rapat';
          $this->load->view('admin/v_notulensi_rapat', $data);
        }

        public function riwayat_arsip(){
          if ($this->role == 'Ketua RT') {
            $set_rt = 'RT '.$this->rt;
          }else {
            redirect('auth/logout','refresh');
          }

          $rt = array(
            'rt'     => $set_rt
          );

          $data['list_arsip'] = $this->m_admin->selectWithWhere('arsip_surat',$rt)->result_array();
          $data['content'] = 'admin/tabel_arsip_ketuart';
          $data['title'] = 'Riwayat Arsip Surat';
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

        public function klik_komplain_RW($id){
            $data['lingkup'] = 'RW';

            $query = $this->m_admin->edit_data('komplain','nomor_komplain',$id,$data);



            if ($query) {
                $json['message'] = 'Komplain Berhasil Diteruskan Kepada RW';
            }else {
                $json['errors'] = 'Komplain Gagal Diteruskan Kepada RW';
            }
            echo json_encode($json);
        }


    }

    /* End of file ketuaRT.php */

?>
