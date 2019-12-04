<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Admin extends CI_Controller {
      public $id_user;
        public function __construct(){
            parent::__construct();
            $this->load->model('m_admin');
            $this->load->library('form_validation');

            $this->id_user = $this->session->userdata('id_user');

            if(!$this->session->has_userdata('status')){
                redirect('auth/','refresh');
            } else {
                if ($this->session->userdata('role') == 'Warga') {
                    redirect('user/','refresh');
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
            $data['dataiurank'] = $this->m_admin->tampil_iuran_keluar()->result_array();
            $data['content'] = "admin/tabelpengeluaran.php";
             $this->load->view('admin/index',$data);
        }
        public function hapus_iuran_keluar($no_pengeluaran){
            $where = array(
                'no_pengeluaran' => $no_pengeluaran
            );
            // $no_pengeluaran = $this->m_admin->view_data($where,'pengeluaran')->row()->no_pengeluaran;
            $this->m_admin->delete_data_iuran_keluar($where,'pengeluaran');
            redirect('admin/tabeldataiurankeluar');
        }
        public function edit_iuran_keluar($no_pengeluaran)
        {
            $where = array(
                'no_pengeluaran' => $no_pengeluaran
            );
            $this->session->set_userdata($where);

            $data['pengeluaran'] = $this->m_admin->edit_data_iuran_keluar($where,'pengeluaran')->result();
            $data['content']="admin/editiurankeluar.php";
            $this->load->view('admin/index',$data);
        }
	function update_data_iuran_keluar(){
		if($this->input->post('edit_keluar')){
			$no_pengeluaran = $this->session->userdata('no_pengeluaran');
			$diberikan_kepada = $this->input->post('diberikan_kepada');
			$tanggal = $this->input->post('tanggal');
			$nominal = $this->input->post('nominal');
            $digunakan_untuk = $this->input->post('digunakan_untuk');
            $gambar = $this->input->post('gambar');

			$dataiurankeluar = array(
				'no_pengeluaran' => $no_pengeluaran,
				'diberikan_kepada' => $diberikan_kepada,
				'tanggal' => $tanggal,
				'nominal' => $nominal,
                'digunakan_untuk' => $digunakan_untuk,
                'gambar' => $gambar

			);

			$where = array(
				'no_pengeluaran' => $no_pengeluaran
			);

			$this->m_admin->update_data($where,$dataiurankeluar,'pengeluaran');
			redirect(base_url('admin/tabeldataiurankeluar'),'refresh');
		} else {
			redirect(base_url('admin/editiurankeluar'),'refresh');
		}
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
                        $data['dataiurank'] = $this->m_admin->tampil_iuran_keluar()->result_array();
                        $data['content'] = "admin/tabelpengeluaran.php";
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
            $data['generate_id'] = $this->m_admin->get_id('rapat'); //$this->session->userdata('jabatan')
            $data['content'] = 'admin/v_rapat';
            $data['title'] = 'Input Rapat';
            $this->load->view('admin/index', $data);
        }

        public function inputkegiatan(){
            $data['generate_id'] = $this->m_admin->get_id('kegiatan'); //$this->session->userdata('jabatan')
            $data['content'] = 'admin/v_kegiatan';
            $data['title'] = 'Input Surat Undangan Kegiatan';
            $this->load->view('admin/index', $data);
        }

        public function inputnotulensi(){
            $data['generate_id'] = $this->m_admin->get_id('notulensi'); //$this->session->userdata('jabatan')
            $data['content'] = 'admin/v_notulensi';
            $data['title'] = 'Input Notulensi Rapat';
            $this->load->view('admin/index', $data);
        }

        public function input_arsipsurat(){
            $data['generate_id'] = $this->m_admin->get_id('arsip'); //$this->session->userdata('jabatan')
            $data['content'] = 'admin/v_arsip_surat';
            $data['title'] = 'Input Notulensi Rapat';
            $this->load->view('admin/index', $data);
        }

        public function riwayat_Undangan(){
            $data['content'] = 'admin/tabel_undangan';
            $data['title'] = 'Riwayat Surat Undangan';
            $this->load->view('admin/index', $data);
        }

        public function riwayat_notulensi(){
            $data['content'] = 'admin/tabel_notulensi';
            $data['title'] = 'Riwayat Notulensi Rapat';
            $this->load->view('admin/index', $data);
        }

        public function riwayat_arsip(){
            $data['content'] = 'admin/tabel_arsip';
            $data['title'] = 'Riwayat Arsip Surat';
            $this->load->view('admin/index', $data);

        }

        // ==========================================================================
        // ==========================================================================
        // END OF SEKRETARIS
        // ==========================================================================

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
                        $url = base_url('admin/inputWarga');

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
                redirect('admin/inputWarga','refresh');
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

        public function detailWarga($id){
            $data = $this->m_admin->detailWargaById($id)->row();
            echo json_encode($data);
        }

        public function editWarga(){
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
                        'no_rumah' => $no_rumah,
                        'gang' => $gang,
                        'nokk' => $nokk,
                        'hub_dlm_kel' => $hub_dlm_kel,
                        'nohp' => $nohp
                    ];

                    $query = $this->m_admin->edit_data('warga','nik',$nik,$data);

                    if ($query) {
                        $url = base_url('admin/tabelDataWarga');

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
                redirect('admin/editWarga','refresh');
            }
    }

        // ================================ Insert Sekretaris =====================================
        public function insertUndanganRapat(){
          $this->form_validation->set_rules([
              [
                  'field' => 'no_udg',
                  'label' => 'Nomor Undangan',
                  'rules' => 'trim|required'
              ],

              [
                  'field' => 'hal',
                  'label' => 'hal',
                  'rules' => 'trim|required'
              ],

              [
                  'field' => 'tujuan_surat',
                  'label' => 'tujuan surat',
                  'rules' => 'trim|required'
              ],

              [
                  'field' => 'tempat_udg',
                  'label' => 'tempat Undangan',
                  'rules' => 'trim|required'
              ],

              [
                  'field' => 'isi_surat',
                  'label' => 'Isi Surat',
                  'rules' => 'trim|required'
              ],

              [
                  'field' => 'tgl_surat',
                  'label' => 'Tanggal Surat',
                  'rules' => 'trim|required'
              ],

              [
                  'field' => 'jam_udg',
                  'label' => 'Jam Undangan',
                  'rules' => 'trim|required'
              ],

              [
                  'field' => 'acara_udg',
                  'label' => 'acara Undangan',
                  'rules' => 'trim|required'
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

            if ($this->form_validation->run() == TRUE) {
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

              $query = $this->m_admin->input_data('surat_undangan', $data);

              if ($query) {
                $url = base_url('admin/riwayat_Undangan');

                $json = [
                    'message' => "Data Rapat berhasil diinput..",
                    'url' => $url
                ];
              } else {
                $json['errors'] = "Data Rapat gagal diinput..!";
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
            redirect('admin/v_rapat','refresh');
          }
        }
    }

    /* End of file Controllername.php */
?>
