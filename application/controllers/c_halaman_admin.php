<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class C_halaman_admin extends CI_Controller {

        public function __construct(){
            parent::__construct();
            $this->load->model('m_admin');
            $this->load->library('form_validation');

            if(!$this->session->has_userdata('status')){
                redirect('c_autentikasi/','refresh');
            } else {
                if ($this->session->userdata('role') == 'warga') {
                    redirect('c_halaman_warga/','refresh');
                }
            }
        }
// Untuk Front-end
// Ketua RW
// =========================================================================
        public function konfirmasiDataWarga(){
            $data['list_warga_belum_valid'] = $this->m_admin->konfirmasiDataWarga()->result_array();
            $data['content'] = 'admin/konfirmasiDataWarga';
            $data['title'] = 'Konfirmasi Data Warga';
            $this->load->view('admin/index', $data);
        }
// =========================================================================

// Ketua RT
// =========================================================================
        public function index(){
            $data['content'] = 'admin/dashboard';
            $data['title'] = 'Dashboard';
            $this->load->view('admin/index', $data);
        }
// =========================================================================
        public function inputWarga(){
            $data['content'] = 'admin/inputWarga';
            $data['title'] = 'Input Data Warga';
            $this->load->view('admin/index', $data);
        }
// ==========================================================================
        public function tabelDataWarga(){
            $data['list_warga_semua'] = $this->m_admin->semuaDataWarga()->result_array();
            $data['content'] = 'admin/tabelDataWarga';
            $data['title'] = 'Tabel Data Warga';
            $this->load->view('admin/index', $data);
        }
// ==========================================================================
        public function inputHasilKomplain(){
            $data['content'] = 'admin/inputHasilKomplain';
            $data['title'] = 'Input Hasil Komplain';
            $this->load->view('admin/index', $data);
        }
// ==========================================================================
// Bendahara
// ==========================================================================
        public function tabelpengeluaran(){
            // $where = array(
            // 	'nip' => $this->session->userdata('nip')
            // );
            // $data['dataiuran'] = $this->petugas_model->view_data($where,'iuran_masuk')->result();
            $data['content'] = "admin/tabelpengeluaran";
            $this->load->view('admin/index',$data);
        }

        public function tabelpemasukan(){
            // $where = array(
            // 	'nip' => $this->session->userdata('nip')
            // );
            // $data['dataiuran'] = $this->petugas_model->view_data($where,'iuran_masuk')->result();
            $data['content'] = "admin/tabelpemasukan";
            $this->load->view('admin/index',$data);
        }
        public function formpengeluaran(){
            // $where = array(
            // 	'nip' => $this->session->userdata('nip')
            // );
            // $data['dataiuran'] = $this->petugas_model->view_data($where,'iuran_masuk')->result();
            $data['content'] = "admin/formpengeluaran";
            $this->load->view('admin/index',$data);
        }
        public function formpemasukan(){
            // $where = array(
            // 	'nip' => $this->session->userdata('nip')
            // );
            // $data['dataiuran'] = $this->petugas_model->view_data($where,'iuran_masuk')->result();
            $data['content'] = "admin/formpemasukan";
            $this->load->view('admin/index',$data);
        }
        public function tabeldataiurankeluar(){
            $data['dataiurank'] = $this->m_admin->tampil_iuran_keluar()->result();
            $data['content'] = "admin/tabelpengeluaran.php";
             $this->load->view('admin/index',$data);
        }
        public function iurankeluar(){
            // $this->form_validation->set_rules([
            //     [
            //         'field' => 'diberikan_kepada',
            //         'label' => 'Diberikan Kepada',
            //         'rules' => 'trim|required'
            //     ],
            //     [
            //         'field' => 'nominal',
            //         'label' => 'Nominal',
            //         'rules' => 'trim|numeric'
            //     ],
            // ]);

            if($this->input->post('submit')){
                // $id_iuran_keluar = $this->input->post('id_iuran_keluar');
                $diberikan_kepada = $this->input->post('diberikan_kepada');
                $tanggal = $this->input->post('tanggal');
                $nominal = $this->input->post('nominal');
                $digunakan_untuk = $this->input->post('digunakan_untuk');

                $config['max_size'] =0;
                $config['max_width']=0;
                $config['max_height']=0;
                $config['allowed_types'] = "png|jpg|jpeg|gif";
                $config['upload_path']='./upload/gambar';

                $this->load->library('upload',$config);

                // if(!$this->upload->do_upload('gambar')){
                //     echo "gambar gak masook";
                //     $error = array
                //     ('error'=>$this->upload->display_errors());
                //     $this->load->view('admin/tabelpengeluaran',$error);
                // }else{
                    // $data = array(
                    //     'upload_data'=>$this->upload->data()
                    // );
                    // $file = $this->upload->data();
                    // $gambar=$file['file_name'];
                    $gambar="gambar.jpg";


                    $dataiurankeluar = array(
                        'diberikan_kepada' => $diberikan_kepada,
                        'tanggal'=> $tanggal,
                        'nominal' => $nominal,
                        'digunakan_untuk' => $digunakan_untuk,
                        'gambar' => $gambar,
                    );

                    $query = $this->m_admin->isi_data_iuran_keluar($dataiurankeluar);
                    if($query){
                        ?>
                        <script>
                                alert("Berhasil Isi Data")
                        </script>
                        <?php
                        $data['content'] = "admin/tabelpengeluaran";
                        $this->load->view('admin/index',$data);
                    }else{
                        ?>
                        <script>
                                alert("Gagal Isi Data")
                        </script>
                        <?php
                        $data['content'] = "admin/formpengeluaran.php";
                        $this->load->view('admin/index',$data);
                    }
                // }
            }else{
                echo "Hai";
                $data['content'] = "admin/formpengeluaran.php";
                $this->load->view('admin/index',$data);
            }
        }


// ==========================================================================
// ==========================================================================
// Sekretaris
// ==========================================================================
        public function inputrapat(){
            $data['content'] = 'admin/v_rapat';
            $data['title'] = 'Input Rapat';
            $this->load->view('admin/index', $data);
        }

        public function inputkegiatan(){
            $data['content'] = 'admin/v_kegiatan';
            $data['title'] = 'Input Surat Undangan Kegiatan';
            $this->load->view('admin/index', $data);
        }

        public function inputnotulensi(){
            $data['content'] = 'admin/v_notulensi';
            $data['title'] = 'Input Notulensi Rapat';
            $this->load->view('admin/index', $data);
        }

// Untuk Back-end
// ==========================================================================
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
                    'field' => 'no_rumah',
                    'label' => 'No Rumah',
                    'rules' => 'trim|numeric|required'
                ]
            ]);

            $json = null;

            if ($this->input->post()) {
                $jenis_warga = $this->input->post('jenis_warga');
                $nik = $this->input->post('nik');
                $nama = $this->input->post('nama');
                $tempat_lahir = $this->input->post('tempat_lahir');
                $tanggal_lahir = $this->input->post('tanggal_lahir');
                $pendidikan = $this->input->post('pendidikan');
                $pekerjaan = $this->input->post('pekerjaan');
                $agama = $this->input->post('agama');
                $jk = $this->input->post('jk');
                $status = $this->input->post('status');
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
                        $url = base_url('c_halaman_admin/inputWarga');

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
                redirect('c_halaman_admin/inputWarga','refresh');
            }
        }
// ======================================================================================
        public function klik_konfirmasi_data_warga($id){
            $data['valid'] = 1;

            $query = $this->m_admin->edit_data('warga','nik',$id,$data);

            if ($query) {
                $json['message'] = 'Data Warga Berhasil Dikonfirmasi';
            }else {
                $json['errors'] = 'Data Warga Gagal Dikonfirmasi';
            }
            echo json_encode($json);
        }
    }

    /* End of file Controllername.php */

?>
