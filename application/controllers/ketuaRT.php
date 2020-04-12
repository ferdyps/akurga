<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class KetuaRT extends CI_Controller {
    
        public $id_user;
        public function __construct(){
            parent::__construct();
            $this->load->model('m_admin');
            $this->load->library('form_validation');
            $this->load->library('pdf');
            $this->load->library('session');

            $this->id_user = $this->session->userdata('id_user');
            $this->role = $this->session->userdata('role');

            if(!$this->session->has_userdata('status')){
                redirect('auth/','refresh');
            } else {
                if ($this->session->userdata('role') == 'Warga') {
                    redirect('user/','refresh');
                }else if ($this->session->userdata('role') == 'Bendahara') {
                    redirect('admin/','refresh');
                }else if ($this->session->userdata('role') == 'Ketua RW') {
                    redirect('ketuaRW/','refresh');
                }
            }
        }

        public function index(){
            $dataPoints = array();
            $dataPoints2 = array();
            $usulanPoints = $this->m_admin->CountData('surat_undangan', 'status', 0)->result_array();
            $query = $this->m_admin->CountData('warga','valid',0)->result_array();
            $result = $this->m_admin->grafikPendidikan()->result();
            $result2 = $this->m_admin->grafikPekerjaan()->result();
            foreach ($result as $row) {
                array_push($dataPoints, array('label' => $row->pendidikan, 'y' => $row->total));
            }
            foreach ($result2 as $row) {
                array_push($dataPoints2, array('label' => $row->pekerjaan, 'y' => $row->total));
            }
            $data = [
                'content'       => 'admin/dashboard',
                'title'         => 'Dashboard',
                'semuaWarga'    => $query,
                'dataPoints'    => $dataPoints,
                'dataPoints2'   => $dataPoints2,
                'usulan_points' => $usulanPoints,
                'dataiurank'    => $this->m_admin->tampil_iuran_keluar()->result_array(),
            ];
            $this->load->view('admin/index', $data);
        }

        public function tbl_usulan_ketua(){
            $tabel = 'surat_undangan';
            $where = [
                'status' => 0
            ];
            $list_data = $this->m_admin->selectWithWhere($tabel,$where)->result_array();
            $data = [
                'content'   => 'admin/tbl_usul_ketua',
                'title'     => 'Input Usulan Rapat',
                'list_data' => $list_data
            ];
            $this->load->view('admin/index', $data);
        }

        public function inputWarga(){
            $data['content'] = 'admin/inputWarga';
            $data['title'] = 'Input Data Warga';
            $this->load->view('admin/index', $data);
        }

        public function insertWarga(){
            $this->form_validation->set_rules([
                [
                    'field' => 'nik',
                    'label' => 'NIK',
                    'rules' => 'trim|required|is_unique[warga.nik]|numeric'
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
                        'gang' => $gang
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
            $table = 'warga';
            $where = ['jenis_warga' => 'sementara'];
            $where2 = ['jenis_warga' => 'tetap'];
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
            $list_surat_pengantar = $this->m_admin->list_surat_pengantar()->result_array();
            $data = [
                'content' => 'admin/daftarSuratPengantar',
                'title' => 'List Surat Pengantar',
                'list_surat_pengantar' => $list_surat_pengantar
            ];
            $this->load->view('admin/index', $data);
        }
        public function daftarKomplain(){
            $list_komplain = $this->m_admin->komplainJoinWargaRT()->result_array();
            $data = [
                'content' => 'admin/daftarKomplain',
                'title' => 'List Komplain',
                'list_komplain' => $list_komplain
            ];
            $this->load->view('admin/index', $data);
        }
        public function cetakSuratPengantar($id){
            $cetak_surat_pengantar = $this->m_admin->detailSuratPengantar($id)->row();
            $data = [
                'title' => 'Cetak Surat Pengantar',
                'cetak_surat_pengantar' => $cetak_surat_pengantar
            ];
            $this->load->view('cetakSuratPengantar', $data);
        }
        public function listCetakSuratPengantar(){
            $list_cetak_surat_pengantar = $this->m_admin->list_cetak_sp()->result_array();
            $data = [
                'content' => 'admin/listCetakSuratPengantar',
                'title' => 'List Cetak Surat Pengantar',
                'list_cetak_surat_pengantar' => $list_cetak_surat_pengantar
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
            $nomor_komplain = $this->input->post('nomor_komplain');
            $hasil_komplain = $this->input->post('hasil_komplain');
            $tanggal = date('Y-m-d');
            if ($this->input->post()) {
                $data = [
                    'nomor_komplain' => $nomor_komplain,
                    'tindak_lanjut' => $hasil_komplain,
                    'tgl_tindak_lanjut' => $tanggal
                ];
                $data2 = [
                    'status' => 'selesai'
                ];
                $input_hasil = $this->m_admin->input_data('hasil_komplain',$data);
                $update_status = $this->m_admin->edit_data('komplain','nomor_komplain',$nomor_komplain,$data2);

                if($input_hasil && $update_status){
                    ?>
                    <script>
                        alert('Tindak Lanjut Komplain Berhasil Diinput');
                        location = "<?php echo base_url('ketuaRT/daftarKomplain');?>";
                    </script>
                    <?php
                }else{
                    ?>
                    <script>
                        alert('Tindak Lanjut Komplain Gagal Diinput');
                        location = "<?php echo base_url('ketuaRT/daftarKomplain');?>";
                    </script>
                    <?php
                }

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

                if ($this->form_validation->run() == TRUE) {
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
                        'valid' => 0
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
            $this->form_validation->set_rules('pesan', 'Pesan', 'regex_match[/^[a-zA-Z ]/]');
            if ($this->input->post()) {
                $nomor_surat = $this->input->post('nomor_surat');
                $pesan = $this->input->post('pesan');

                // if ($this->form_validation->run() == TRUE) {
                    $data = [
                        'nomor_surat' => $nomor_surat,
                        'pesan' => $pesan,
                        'status' => 'ditolak'
                    ];
                    $tolak = $this->m_admin->input_data('status_surat',$data);
                    if($tolak){
                        ?>
                        <script>
                            alert('Surat Pengantar Ditolak');
                            location = "<?php echo base_url('ketuaRT/daftarSuratPengantar');?>";
                        </script>
                        <?php
                    }else{
                        ?>
                        <script>
                            alert('Surat Pengantar Gagal Ditolak');
                            location = "<?php echo base_url('ketuaRT/daftarSuratPengantar');?>";
                        </script>
                        <?php
                    }
                    // if ($tolak) {
                    //     $url = base_url('admin/daftarSuratPengantar');

                    //     $json = [
                    //         'message' => "Surat pengantar berhasil ditolak..",
                    //         'url' => $url
                    //     ];
                    // } else {
                    //     $json['errors'] = "Surat pengantar gagal ditolak..";
                    // }

                // } else {
                    // $no = 0;
                    // foreach ($this->input->post() as $key => $value) {
                    //     if (form_error($key) != "") {
                    //         $json['form_errors'][$no]['id'] = $key;
                    //         $json['form_errors'][$no]['msg'] = form_error($key, null, null);
                    //         $no++;
                    //     }
                    // }
                // }
                // echo json_encode($json);
            /*}else {
                ?>
                <script>
                    location = "<?php base_url('admin/daftarSuratPengantar');?>";
                </script>
                <?php
            }*/

            }
        }

    
    }
    
    /* End of file ketuaRT.php */
    
?>




