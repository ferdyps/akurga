<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class sekretaris extends CI_Controller {
      public $id_user;
      public $role;
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
                }
            }
        }
// Untuk Front-end

// =========================================================================

// Ketua RT
// -------------------------------------------------------------------------
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
                'title'     => 'Riwayat Usulan Ketua RT/RW',
                'list_data' => $list_data
            ];
            $this->load->view('admin/index', $data);
        }

// ==========================================================================
// ==========================================================================
// Sekretaris
// ==========================================================================


        public function inputundangan(){
            $id         = 'rapat';
            $id2        = 'kegiatan';
            $nama_field = 'no_udg';
            $nama_tabel = 'surat_undangan';
            $key        = $this->uri->segment(3);
            $valid      = array('no_udg' => $key );

            $fetch      = $this->m_admin->selectWithWhere('surat_undangan', $valid)->result_array();
            $data['fetch'] = $fetch;
            $data['content'] = 'admin/v_undangan';
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

              $this->session->set_flashdata('success','silahkan lihat di Riwayat Notulensi Rapat');
              redirect('sekretaris/riwayat_Undangan','refresh');

              echo json_encode($json);
            }else {
              $data['key_no_udg'] = $key;
              $data['generate_id'] = $this->m_admin->get_id($id,$nama_field,$nama_tabel); //$this->session->userdata('jabatan')
              $data['content'] = 'admin/v_notulensi';
              $data['title'] = 'Input Notulensi Rapat';
              $this->load->view('admin/index', $data);
            }

        }

        public function input_arsipsurat(){
            $id         = 'arsip';
            $nama_field = 'kd_surat';
            $nama_tabel = 'arsip_surat';
            $data['generate_id'] = $this->m_admin->get_id($id,$nama_field,$nama_tabel); //$this->session->userdata('jabatan')
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

        public function editData_Notulensi(){

          $id     = $this->uri->segment(3);
          $no     = array('no_notulen' => $id );
          $surat  = $this->m_admin->selectWithWhere('notulensi_rpt', $no)->result_array();
          $data['fetch'] = $surat;
          $data['content'] = 'admin/v_edit_notulensi';
          $data['title'] = 'Edit Data Notulensi Rapat';
          $this->load->view('admin/index', $data);
        }

        public function notulensi_rapat(){

          $id     = $this->uri->segment(3);
          $surat  = $this->m_admin->get_detail_notulensi($id)->result_array();
          $data['fetch'] = $surat;
          $data['title'] = 'Notulensi Rapat';
          $this->load->view('admin/v_notulensi_rapat', $data);
        }

        public function riwayat_Undangan(){
            $id = array('status' => 1 );
            $data['list_surat_udg'] = $this->m_admin->selectWithWhere('surat_undangan',$id)->result_array();
            $data['content'] = 'admin/tabel_undangan';
            $data['title'] = 'Riwayat Surat Undangan';
            $this->load->view('admin/index', $data);
        }

        public function riwayat_notulensi(){
            $data['list_notulen'] = $this->m_admin->selectAllData('notulensi_rpt')->result_array();
            $data['content'] = 'admin/tabel_notulensi';
            $data['title'] = 'Riwayat Notulensi Rapat';
            $this->load->view('admin/index', $data);
        }

        public function riwayat_arsip(){
            $data['list_arsip'] = $this->m_admin->selectAllData('arsip_surat')->result_array();
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
          $data['title'] = 'Detail Dokumentasi Rapat';
          $this->load->view('admin/v_dokumentasi_rapat', $data);
        }

        public function cetak_undangan()
        {
          $id     = $this->uri->segment(3);
          $no     = array('no_udg' => $id );
          $surat  = $this->m_admin->selectWithWhere('surat_undangan', $no)->result_array();

          setlocale(LC_ALL, 'IND');

          $pdf = new FPDF('P','mm','A4');
          // membuat halaman baru
          $pdf->AddPage();

          foreach ($surat as $row) {
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
          $pdf->Ln(12);
          $pdf->Cell(17);
          $pdf->Cell(5,5,'Nomor',0,0,'L');
          $pdf->Cell(25);
          $pdf->Cell(5,5,':',0,0,'L');
          $pdf->Cell(5,5,$row['no_udg'],0,0,'L');
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
          $pdf->Cell(5,5,$row['lampiran_udg'],0,1,'L');
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
          $pdf->MultiCell(160,7,$row['isi_surat'],0,'L');
          $pdf->Ln(6);
          $pdf->Cell(35);
          $pdf->Cell(35,7,'Hari tanggal',0,'L');
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
          $pdf->Cell(35,7,'Acara',0,0,'L');
          $pdf->Cell(5,7,':',0,0,'L');
          $pdf->MultiCell(100,7,$row['acara_udg'],0,'L');
          $pdf->Ln(6);
          $pdf->Cell(17);
          $pdf->MultiCell(160,7,'Demikian disampaikan untuk dapat dimaklumi, atas kehadirannya diucapkan terima kasih agar menjadi maklum yang berkepentingan mengetahuinya.',0,'L');
          $pdf->Ln(8);
          $pdf->MultiCell(177,7,'Salam Hormat',0,'R');
          $pdf->Ln(8);
          $pdf->Cell(27);
          $pdf->Cell(35,7,'Sekretaris',0,0,'C');
          // $pdf->Cell(35,7,'Sekretaris',0,'C');
          $pdf->Cell(60);
          $pdf->Cell(35,7,'Ketua RT 01 RW 01',0,0,'C');
          // $pdf->Cell(35,7,'Ketua RT 01 RW 01',0,'C');
          $pdf->Ln(40);
          $pdf->Cell(27);
          $pdf->Cell(35,7,'Iwan Setiawan ',0,0,'C');
          $pdf->Cell(60);
          $pdf->Cell(35,7,'Moch Toha',0,1,'C');
          $pdf->Ln(12);
          $pdf->SetFont('Arial','B'.'U',11);
          $pdf->Cell(19,7,'Tembusan',0,0,'C');
          $pdf->SetFont('Arial','',11);
          $pdf->Cell(3,7,':',0,0,'C');
          $pdf->MultiCell(177,7,$row['tembusan'],0,'L');
          }

          $pdf->Output('Undangan Rapat','I');
        }

        public function pembuatan_undangan()
        {
          $valid     = array('status' => 0 );
          $query  = $this->m_admin->selectWithWhere('surat_undangan', $valid)->result_array();
          $data['fetch'] = $query;
          $data['content'] = 'admin/tbl_buat_undangan';
          $data['title'] = 'Tabel Pembuatan Surat Undangan';
          $this->load->view('admin/index', $data);
        }
        // ==========================================================================
        // ==========================================================================
        // END OF SEKRETARIS
        // ==========================================================================

        // ==========================================================================
        // ==========================================================================
        // Pengurus
        // ==========================================================================

        public function usul_pengurus(){
            $id         = 'rapat';
            $id_2        = 'kegiatan';
            $nama_field = 'no_udg';
            $nama_tabel = 'surat_undangan';

            $generate_id = $this->m_admin->get_id($id,$nama_field,$nama_tabel); //$this->session->userdata('jabatan')
            $generate_id2 = $this->m_admin->get_id($id_2,$nama_field,$nama_tabel);
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

        // ==========================================================================
        // ==========================================================================
        // END OF Pengurus
        // ==========================================================================

// Untuk Back-end
// ==========================================================================
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

        public function detailWarga($id){
            $data  = $this->m_admin->detailWargaById($id)->row();
            echo json_encode($data);
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
                  'label' => 'Tanggal Surat ',
                  'rules' => 'required'
              ],

              [
                  'field' => 'jam_udg',
                  'label' => 'Jam Undangan ',
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
            $date = date("Y/m/d");

            if ($this->form_validation->run() == TRUE) {
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


        public function insertUndanganKegiatan(){
          $this->form_validation->set_rules([
              [
                  'field' => 'no_udg_kgt',
                  'label' => 'Nomor Undangan',
                  'rules' => 'trim|required'
              ],

              [
                  'field' => 'hal_kgt',
                  'label' => 'hal',
                  'rules' => 'trim|required'
              ],

              [
                  'field' => 'tujuan_surat_kgt',
                  'label' => 'tujuan surat',
                  'rules' => 'trim|required'
              ],

              [
                  'field' => 'tempat_udg_kgt',
                  'label' => 'tempat Undangan',
                  'rules' => 'trim|required'
              ],

              [
                  'field' => 'isi_surat_kgt',
                  'label' => 'Isi Surat',
                  'rules' => 'trim|required'
              ],

              [
                  'field' => 'tgl_surat_kgt',
                  'label' => 'Tanggal Surat ',
                  'rules' => 'required'
              ],

              [
                  'field' => 'jam_udg_kgt',
                  'label' => 'Jam Undangan ',
                  'rules' => 'trim|required'
              ],

              [
                  'field' => 'acara_udg_kgt',
                  'label' => 'acara Undangan',
                  'rules' => 'trim|required'
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

            if ($this->form_validation->run() == TRUE) {
              $data = [
                'no_udg' => $no_udg,
                'lampiran_udg' => $lampiran,
                'sifat_udg' => $sifat,
                'perihal_udg' => $hal,
                'tujuan_surat' => $tujuan_srt,
                'tempat_udg' => $tempat_udg,
                'catatan' => $catatan,
                'tembusan' => $tembusan,
                'isi_surat' => $isi_surat,
                'tgl_udg' => $tgl_srt,
                'tgl_buat' => $date,
                'jam_udg' => $jam_udg,
                'acara_udg' => $acara_udg,
                'id_user' => $this->id_user
              ];
              $query = $this->m_admin->input_data('surat_undangan', $data);

              if ($query) {
                $url = base_url('admin/riwayat_Undangan');

                $json = [
                    'message' => "Data Kegiatan berhasil diinput..",
                    'url' => $url
                ];
              }else {
                $json['errors'] = "Data Kegiatan gagal diinput..!";
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
            redirect('admin/v_kegiatan','refresh');
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
                  'rules' => 'trim|required'
              ],

              [
                  'field' => 'uraian_notulen',
                  'label' => 'Uraian Notulensi',
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
            $uraian_notulen         = $this->input->post('uraian_notulen');
            $date                   = date("Y/m/d");
            $no_udg                 = $this->input->post('no_udg');

            $config['upload_path']          = './assets/foto/notulensi';
            // $config['file_name']            = $this->input->post('gbr_surat');
            $config['allowed_types']        = 'jpg|png';
            $config['max_size']             = 1024; // 1MB
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);

            if ($this->form_validation->run() == TRUE) {
              if ($this->upload->do_upload('dokumentasi_rpt')){
                     // $error = array('error' => $this->upload->display_errors());
                      $data_upload     = $this->upload->data('file_name');
                      $data = [
                        'no_notulen'      => $no_notulen,
                        'dokumentasi_rpt' => $data_upload,
                        'tembusan'        => $tembusan,
                        'uraian_notulen'  => $uraian_notulen,
                        'tgl_buat'        => $date,
                        'penulis'         => $this->role,
                        'status'          => 0,
                        'no_udg'          => $no_udg
                      ];
              }else {
                redirect('admin/inputnotulensi','refresh');
              }


              $query = $this->m_admin->input_data('notulensi_rpt', $data);
              if ($query) {
                $url = base_url('admin/riwayat_notulensi');

                $json = [
                    'message' => "Data Notulensi berhasil diinput..",
                    'url' => $url
                ];
              }else {
                $json['errors'] = "Data Notulensi gagal diinput..!";
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
            redirect('admin/inputnotulensi','refresh');
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
                  'rules' => 'required'
              ],

              [
                  'field' => 'pengirim',
                  'label' => 'Pengirim',
                  'rules' => 'trim|required'
              ],

              [
                  'field' => 'tgl_terima',
                  'label' => 'Tanggal Terima Surat',
                  'rules' => 'required'
              ],


              [
                  'field' => 'tgl_surat',
                  'label' => 'Tanggal Surat',
                  'rules' => 'required'
              ],

              [
                  'field' => 'keterangan',
                  'label' => 'keterangan',
                  'rules' => 'required'
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
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024; // 1MB
            // $config['max_width']            = 1024;
		        // $config['max_height']           = 768;

            $this->load->library('upload', $config);


            if ($this->form_validation->run() == TRUE) {
              if ($this->upload->do_upload('gbr_surat')){
  			             // $error = array('error' => $this->upload->display_errors());
                      $data_upload     = $this->upload->data('file_name');
                      $data = [
                        'kd_surat' => $kd_surat,
                        'no_surat' => $no_surat,
                        'pengirim' => $pengirim,
                        'keterangan' => $keterangan,
                        'gambar_srt' => $data_upload,
                        'tgl_terima' => $tgl_terima,
                        'tgl_surat' => $tgl_surat,
                        'id_user' => $this->id_user
                      ];
  		        }else {
                $data = [
                  'kd_surat' => $kd_surat,
                  'no_surat' => $no_surat,
                  'pengirim' => $pengirim,
                  'keterangan' => $keterangan,
                  'tgl_terima' => $tgl_terima,
                  'tgl_surat' => $tgl_surat,
                  'id_user' => $this->id_user
                ];
              }


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

        public function insertUsulanPengurus(){
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

            if ($this->form_validation->run() == TRUE) {
              $data = [
                'no_udg' => $no_udg,
                'tujuan_surat' => $tujuan_srt,
                'tempat_udg' => $tempat_udg,
                'usulan_rpt' => $usul_surat,
                'tgl_udg' => $tgl_rpt,
                'jam_udg' => $jam_udg,
                'id_user' => $this->id_user
              ];

              $query = $this->m_admin->input_data('surat_undangan', $data);

              if ($query) {
                $url = base_url('sekretaris/tbl_usulan_ketua');

                $json = [
                    'message' => "Data Usulan Rapat berhasil diinput..",
                    'url' => $url
                ];
              } else {
                $json['errors'] = "Data Usulan Rapat gagal diinput..!";
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
            redirect('admin/index','refresh');
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

              $query = $this->m_admin->edit_data('surat_undangan','no_udg', $no_udg,$data);

              if ($query) {
                $url = base_url('admin/riwayat_Undangan');

                $json = [
                    'message' => "Data Surat Undangan berhasil diubah..",
                    'url' => $url
                ];
              } else {
                $json['errors'] = "Data Surat Undangan gagal diubah..!";
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
            redirect('admin/editRapat','refresh');
          }
        }
        public function detailRapat($id){
            $tabel = 'surat_undangan';
            $where = [
                'no_udg' => $id
            ];

            $data = $this->m_admin->selectWithWhere($tabel,$where)->row();
            echo json_encode($data);
        }

        public function editNotulen(){
          $this->form_validation->set_rules([
              [
                  'field' => 'no_notulen',
                  'label' => 'Nomor Notulensi',
                  'rules' => 'trim|required'
              ],

              [
                  'field' => 'tembusan',
                  'label' => 'Tembusan',
                  'rules' => 'trim|required'
              ]
          ]);

          if ($this->input->post()) {
            $no_notulen     = $this->input->post('no_notulen');
            $tembusan       = $this->input->post('tembusan');

            $config['upload_path']          = './assets/foto/notulensi';
            // $config['file_name']            = $this->input->post('gbr_surat');
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024; // 1MB
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);


            if ($this->form_validation->run() == TRUE) {

              if ($this->upload->do_upload('dokumentasi_rpt')){
                     // $error = array('error' => $this->upload->display_errors());
                      $data_upload     = $this->upload->data('file_name');
                      $data = [
                        'no_notulen'      => $no_notulen,
                        'tembusan'        => $tembusan,
                        'dokumentasi_rpt' => $data_upload
                      ];
              }else {
                $data = [
                  'no_notulen' => $no_notulen,
                  'tembusan' => $tembusan
                ];
              }


              $query = $this->m_admin->edit_data('notulensi_rpt','no_notulen', $no_notulen, $data);
              if ($query) {
                $url = base_url('admin/riwayat_notulensi');

                $json = [
                    'message' => "Data Notulensi berhasil diubah..",
                    'url' => $url
                ];
              }else {
                $json['errors'] = "Data Notulensi gagal diubah..!";
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
            redirect('admin/editNotulen','refresh');
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
                  'field' => 'uraian_notulen',
                  'label' => 'Uraian Notulensi',
                  'rules' => 'required'
              ]
          ]);

          if ($this->input->post()) {
            $no_notulen     = $this->input->post('no_notulen');
            $uraian         = $this->input->post('uraian_notulen');


            if ($this->form_validation->run() == TRUE) {
                $data = [
                  'uraian_notulen' => $uraian
                ];

              $query = $this->m_admin->edit_data('notulensi_rpt','no_notulen', $no_notulen, $data);
              if ($query) {
                $url = base_url('admin/riwayat_notulensi');

                $json = [
                    'message' => "Data Notulensi berhasil diubah..",
                    'url' => $url
                ];
              }else {
                $json['errors'] = "Data Notulensi gagal diubah..!";
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
            redirect('admin/editData_Notulensi','refresh');
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
                  'rules' => 'required'
              ],

              [
                  'field' => 'pengirim',
                  'label' => 'Pengirim',
                  'rules' => 'trim|required'
              ],

              [
                  'field' => 'keterangan',
                  'label' => 'keterangan',
                  'rules' => 'required'
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
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024; // 1MB
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);


            if ($this->form_validation->run() == TRUE) {
              if ($this->upload->do_upload('gbr_surat')){
                      $data_upload     = $this->upload->data('file_name');
                      // $error = array('error' => $this->upload->display_errors());
                      $data = [
                        'kd_surat' => $kd_surat,
                        'no_surat' => $no_surat,
                        'pengirim' => $pengirim,
                        'keterangan' => $keterangan,
                        'gambar_srt' => $data_upload,
                        'tgl_terima' => $tgl_terima,
                        'tgl_surat' => $tgl_surat,
                        'id_user' => $this->id_user
                      ];
              }else{
                $data = [
                  'kd_surat' => $kd_surat,
                  'no_surat' => $no_surat,
                  'pengirim' => $pengirim,
                  'keterangan' => $keterangan,
                  'tgl_terima' => $tgl_terima,
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
