<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class KetuaRW extends CI_Controller {

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
                }else if ($this->session->userdata('role') == 'ketuaRT') {
                    redirect('ketuaRT/','refresh');
                }else if ($this->session->userdata('role') == 'Sekretaris') {
                    redirect('sekretaris/','refresh');
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

        public function konfirmasiDataWarga(){
            $table = 'warga';
            $where = [
                'jenis_warga' => 'sementara',
                'valid' => 0
            ];
            $where2 = [
                'jenis_warga' => 'tetap',
                'valid' => 0
            ];
            $wargaSementara = $this->m_admin->selectWithWhere($table,$where)->result_array();
            $wargaTetap = $this->m_admin->selectWithWhere($table,$where2)->result_array();
            $data = [
                'content' => 'admin/konfirmasiDataWarga',
                'title' => 'Konfirmasi Data Warga',
                'list_warga_belum_valid_sementara' => $wargaSementara,
                'list_warga_belum_valid_tetap' => $wargaTetap
            ];
            $this->load->view('admin/index', $data);
        }

        public function list_akun(){
            $list_akun = $this->m_admin->list_akun()->result_array();
            $data = [
                'content' => 'admin/daftarAkun',
                'title' => 'List Akun',
                'list_akun' => $list_akun
            ];
            $this->load->view('admin/index', $data);
        }

        public function edit_role($id_user){
            if ($this->input->post()) {
                $role = $this->input->post('role');
                $data = ['role' => $role];
                $update_role = $this->m_admin->edit_data('user', 'id_user',$id_user,$data);

                if ($update_role) {
                    ?>
                    <script>
                        alert('Role berhasil diupdate');
                        location = "<?php echo base_url('ketuaRW/list_akun');?>";
                    </script>
                    <?php
                }else{
                    ?>
                    <script>
                        alert('Role gagal diupdate');
                        location = "<?php echo base_url('ketuaRW/list_akun');?>";
                    </script>
                    <?php
                }

            }
        }

        public function daftarKomplainRW(){
            $list_komplain = $this->m_admin->komplainJoinWargaRW()->result_array();
            $data = [
                'content' => 'admin/daftarKomplainRW',
                'title' => 'List Komplain',
                'list_komplain' => $list_komplain
            ];
            $this->load->view('admin/index', $data);
        }

        public function inputHasilKomplainRW($no_komplen){
            $this->form_validation->set_rules([
                [
                    'field' => 'hasil_komplain',
                    'label' => 'Tindak lanjut',
                    'rules' => 'trim|required'
                ]

            ]);

            if ($this->input->post()) {
                $nomor_komplain = $no_komplen;
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

                    } else {
                        redirect('ketuaRW/inputHasilKomplainRW/'.$no_komplen,'refresh');
                    }

                    $input_hasil = $this->m_admin->input_data('tindak_lanjut',$data);
                    $update_status = $this->m_admin->edit_data('komplain','nomor_komplain',$nomor_komplain,$data2);

                    if($input_hasil && $update_status){
                        ?>
                        <script>
                            alert('Tindak Lanjut Komplain Berhasil Diinput');
                            location = "<?php echo base_url('ketuaRW/daftarKomplainRW');?>";
                        </script>
                        <?php
                    }else{
                        ?>
                        <script>
                            alert('Tindak Lanjut Komplain Gagal Diinput');
                            location = "<?php echo base_url('ketuaRW/daftarKomplainRW');?>";
                        </script>
                        <?php
                    }

                } else {
                    $data = [
                        'content' => 'admin/inputHasilKomplainRW',
                        'title' => 'Input Hasil Komplain RW',
                        'no_komplen' => $no_komplen,
                    ];
                    $this->load->view('admin/index', $data);
                }

            }else {

                $data = [
                    'content' => 'admin/inputHasilKomplainRW',
                    'title' => 'Input Hasil Komplain RW',
                    'no_komplen' => $no_komplen,
                ];
                $this->load->view('admin/index', $data);
            }

        }

        public function insertHasilKomplainRW(){
            $nomor_komplain = $this->input->post('nomor_komplain');
            $hasil_komplain = $this->input->post('hasil_komplain');
            $tanggal = date('Y-m-d');
            if ($this->input->post()) {
                $data = [
                    'nomor_komplain' => $nomor_komplain,
                    'hasil_tindak_lanjut' => $hasil_komplain,
                    'tgl_tindak_lanjut' => $tanggal
                ];
                $data2 = [
                    'status' => 'selesai'
                ];
                $input_hasil = $this->m_admin->input_data('tindak_lanjut',$data);
                $update_status = $this->m_admin->edit_data('komplain','nomor_komplain',$nomor_komplain,$data2);

                if($input_hasil && $update_status){
                    ?>
                    <script>
                        alert('Tindak Lanjut Komplain Berhasil Diinput');
                        location = "<?php echo base_url('ketuaRW/daftarKomplainRW');?>";
                    </script>
                    <?php
                }else{
                    ?>
                    <script>
                        alert('Tindak Lanjut Komplain Gagal Diinput');
                        location = "<?php echo base_url('ketuaRW/daftarKomplainRW');?>";
                    </script>
                    <?php
                }

            }

        }

        public function klik_konfirmasi_data_warga($id){
            // $data['valid'] = 1;
            $data = [
                'valid' => 1,
                'pesan' => ''
            ];

            $query = $this->m_admin->edit_data('warga','nik',$id,$data);

            if ($query) {
                $json['message'] = 'Data Warga Berhasil Dikonfirmasi';
            }else {
                $json['errors'] = 'Data Warga Gagal Dikonfirmasi';
            }
            echo json_encode($json);
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

        public function declineWarga(){

            // $this->form_validation->set_rules('pesan', 'Pesan', 'regex_match[/^[a-zA-Z ]/]');

            if ($this->input->post()) {
                $pesan = $this->input->post('pesan');
                $nik = $this->input->post('nik');

                // if ($this->form_validation->run() == TRUE) {
                    $data = [
                        // 'nik' => $nik,
                        'valid' => 2,
                        'pesan'=>$pesan
                    ];

                    // $data2['valid'] = 2;

                    // $insert = $this->m_admin->input_data('decline_warga',$data);
                    // $update = $this->m_admin->edit_data('warga','nik',$nik,$data2);
                    $update = $this->m_admin->edit_data('warga','nik',$nik,$data);

                    if ($update) {
                        ?>
                        <script>
                            alert('Berhasil Ditolak');
                            location = "<?php echo base_url('ketuaRW/konfirmasiDataWarga');?>";
                        </script>
                        <?php
                    }else{
                        ?>
                        <script>
                            alert('Gagal Ditolak');
                            location = "<?php echo base_url('ketuaRW/konfirmasiDataWarga');?>";
                        </script>
                        <?php
                    }
            //             $url = base_url('admin/konfirmasiDataWarga');
            //             $json = [
            //                 'message' => 'Data Warga Berhasil Dibatalkan',
            //                 'url' => $url
            //             ];
            //         }else {
            //             $json['errors'] = 'Data Warga Gagal Dibatalkan';
            //         }

            //     } else {
            //         $no = 0;
            //         foreach ($this->input->post() as $key => $value) {
            //             if (form_error($key) != "") {
            //                 $json['form_errors'][$no]['id'] = $key;
            //                 $json['form_errors'][$no]['msg'] = form_error($key, null, null);
            //                 $no++;
            //             }
            //         }
            //     }
            //     echo json_encode($json);
            // }else {
            //     redirect('admin/konfirmasiDataWarga','refresh');
            // }
            }
        }

        public function cetak_surat_pengantar() {
            $id     = $this->uri->segment(3);
            $surat  = $this->m_admin->detailSuratPengantar($id)->row();

            setlocale(LC_ALL, 'IND');

            $pdf = new FPDF('P','mm','A4');
            // membuat halaman baru
            $pdf->AddPage();

            $row = $surat;
            // foreach ($surat as $row) {
            // setting jenis font yang akan digunakan
            $pdf->SetFont('Arial','B',16);
            // mencetak string
            $pdf->Cell(190,7,'RUKUN TETANGGA 01',0,1,'C');
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(190,7,'RUKUN WARGA 01',0,1,'C');
            $pdf->Cell(190,7,'DESA SUKAPURA KECAMATAN DAYEUHKOLOT',0,1,'C');
            $pdf->Cell(190,7,'KABUPATEN BANDUNG',0,1,'C');
            $pdf->Line(10,40,200,40);
            $pdf->Ln(1.4);
            $pdf->SetFont('Arial','',12);
            $pdf->Cell(190,7,'Sekretariat : Manggadua RT. 01 RW. 01 Desa Sukapura Kec. Dayeuhkolot Kab. Bandung -  40267',0,1,'C');
            $pdf->SetLineWidth(1);
            $pdf->Line(10,46,200,46);
            $pdf->Ln(10);
            $pdf->SetFont('Arial','B',16);
            $pdf->Cell(0,10,'SURAT PENGANTAR',0,1,'C');
            $pdf->SetLineWidth(0.5);
            $pdf->Line(77,64,133,64);
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(0,1,'No :'.str_replace('-','/',$row->nomor_surat),0,1,'C');
            $pdf->Ln(15);
            $pdf->SetFont('Arial','',12);
            $pdf->Cell(0,0,'Saya yang bertanda tangan di bawah ini Ketua RT 01/ RW 01, Desa Sukapura Kecamatan',0,1,'J');
            $pdf->Cell(0,13,'Dayeuhkolot Kabupaten Bandung, dengan ini menerangkan bahwa:',0,1,'L');
            $pdf->Ln(10);
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(15);
            $pdf->Cell(47,0,'Nama',0,0,'L');
            $pdf->Cell(3,0,':',0,0,'L');
            $pdf->Cell(47,0,ucwords($row->nama),0,1,'L');
            $pdf->Cell(15);
            $pdf->Cell(47,13,'Tempat/ Tanggal Lahir',0,0,'L');
            $pdf->Cell(3,13,':',0,0,'L');
            $pdf->Cell(47,13,ucwords($row->tempat_lahir).'/ '. strftime("%d %B %Y",strtotime($row->tanggal_lahir)),0,1,'L');
            $pdf->Cell(15);
            $pdf->Cell(47,0,'No. KTP/ KK',0,0,'L');
            $pdf->Cell(3,0,':',0,0,'L');
            $pdf->Cell(47,0,$row->nik,0,1,'L');
            $pdf->Cell(15);
            $pdf->Cell(47,13,'Pekerjaan',0,0,'L');
            $pdf->Cell(3,13,':',0,0,'L');
            $pdf->Cell(47,13,ucwords($row->pekerjaan),0,1,'L');
            $pdf->Cell(15);
            $pdf->Cell(47,0,'Agama',0,0,'L');
            $pdf->Cell(3,0,':',0,0,'L');
            $pdf->Cell(47,0,ucwords($row->agama),0,1,'L');
            $pdf->Cell(15);
            $pdf->Cell(47,13,'Kewarganegaraan',0,0,'L');
            $pdf->Cell(3,13,':',0,0,'L');
            $pdf->Cell(47,13,'Indonesia',0,1,'L');
            $pdf->Cell(15);
            $pdf->Cell(47,0,'Status Perkawinan',0,0,'L');
            $pdf->Cell(3,0,':',0,0,'L');
            $pdf->Cell(47,0,ucwords($row->status),0,1,'L');
            $pdf->Cell(15);
            $pdf->Cell(47,13,'Alamat',0,0,'L');
            $pdf->Cell(3,13,':',0,0,'L');
            $pdf->Cell(47,13,ucwords($row->nama_jalan).', '.ucwords($row->gang).', No. '.ucwords($row->no_rumah).', ',0,1,'L');
            $pdf->Cell(65);
            $pdf->Cell(47,2,'RT. 01 RW. 01, Babakan Ciamis, Kabupaten Bandung',0,1,'L');
            $pdf->Ln(10);
            $pdf->Cell(0,0,'Adalah benar warga kami.',0,1,'L');
            $pdf->Ln(7);
            $pdf->Cell(0,0,'Surat keterangan ini diberikan untuk dipergunakan '.$row->keperluan.'.',0,1,'L');
            $pdf->Ln(20);
            $pdf->Cell(0,0,'Manggadua, '.strftime("%d %B %Y",strtotime(date("d-m-Y"))),0,1,'R');
            $pdf->Ln(7);
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(0,0,'Hormat Kami,',0,1,'R');
            $pdf->Ln(7);
            $pdf->Cell(160,20,'KETUA RT. 01',0,0,'R');
            $pdf->Cell(-100,20,'KETUA RW. 01',0,1,'R');
            $pdf->Ln(20);
            $pdf->SetFont('Arial','B',12);
            // $pdf->Cell(0,20,'KETUA RW. 01',0,1,'L');


            // }
            $pdf->Output('Surat Pengantar','I');
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

        public function tbl_usulan_ketuaRW(){
            $tabel = 'surat_undangan';
            if ($this->role == 'Ketua RW') {
              $set_rt = 'RW 01';
            }else {
              site_url('auth/logout');
            }

            $where = [
                'status' => 0,
                'rt'     => $set_rt
            ];
            $list_data = $this->m_admin->selectWithWhere($tabel,$where)->result_array();
            $data = [
                'content'   => 'admin/tbl_usul_ketua_rw',
                'title'     => 'Riwayat Usulan Ketua RW',
                'list_data' => $list_data
            ];
            $this->load->view('admin/index', $data);
        }

        public function usul_pembuatanRW(){
            $id           = 'rapat';
            $id_2         = 'kegiatan';
            $nama_field   = 'no_udg';
            $nama_tabel   = 'surat_undangan';

            if ($this->role == 'Ketua RW') {
              $set_rt = 'RW 01';
            }else {
              site_url('auth/logout');
            }

            $generate_id = $this->m_admin->get_id_adapt_sekre($id,$nama_tabel,$set_rt);
            $generate_id2 = $this->m_admin->get_id_adapt_sekre($id_2,$nama_tabel,$set_rt);
            $content = 'admin/form_usulan_rw';
            $title = 'Form Usulan Rapat';
            $data = [
              'generate_id' => $generate_id,
              'generate_id2' => $generate_id2,
              'content'     => $content,
              'title'       => $title
            ];
            $this->load->view('admin/index', $data);

        }

        public function klik_hapus_usulan_rapatRW($id2){
            $id = array('no_udg' => $id2);
            $query = $this->m_admin->delete_data($id , 'surat_undangan');

            if (!$query) {
                $json['message'] = 'Data Usulan Rapat Berhasil Dihapus';
            }else {
                $json['errors'] = 'Data Usulan Rapat Dihapus';
            }
            echo json_encode($json);
        }

        public function insertUsulanRW(){
          $this->form_validation->set_rules([
              [
                  'field' => 'no_udg',
                  'label' => 'Jenis Surat',
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
                  'field' => 'usul_surat',
                  'label' => 'Isi Surat',
                  'rules' => 'trim|required'
              ],

              [
                  'field' => 'tgl_rpt',
                  'label' => 'Tanggal Surat ',
                  'rules' => 'required'
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

            if ($this->role == 'Ketua RW') {
              $set_rt = 'RW 01';
            }else {
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
                $url = base_url('ketuaRW/tbl_usulan_ketuaRW');

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
            redirect('KetuaRW/usul_pembuatanRW','refresh');
          }
        }

    }

    /* End of file KetuaRW.php */

?>
