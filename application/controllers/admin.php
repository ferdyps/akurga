<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Admin extends CI_Controller {
      public $id_user;
        public function __construct(){
            parent::__construct();
            $this->load->model('m_admin');
            $this->load->library('form_validation');
            $this->load->library('pdf');

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
        public function konfirmasiDataWarga()
        {
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
        function list_akun(){
            $list_akun = $this->m_admin->list_akun()->result_array();
            $data = [
                'content' => 'admin/daftarAkun',
                'title' => 'List Akun',
                'list_akun' => $list_akun
            ];
            $this->load->view('admin/index', $data);
        }
        public function edit_role($id_user)
        {
            if ($this->input->post()) {
                $role = $this->input->post('role');
                $data = ['role' => $role];
                $update_role = $this->m_admin->edit_data('user', 'id_user',$id_user,$data);

                if ($update_role) {
                    ?>
                    <script>
                        alert('Role berhasil diupdate');
                        location = "<?php base_url('admin/list_akun');?>";
                    </script>
                    <?php
                }else{
                    ?>
                    <script>
                        alert('Role gagal diupdate');
                        location = "<?php base_url('admin/list_akun');?>";
                    </script>
                    <?php
                }

            }
        }


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
                'title'     => 'Input Usulan Rapat',
                'list_data' => $list_data
            ];
            $this->load->view('admin/index', $data);
        }
// -------------------------------------------------------------------------
        public function inputWarga(){
            $data['content'] = 'admin/inputWarga';
            $data['title'] = 'Input Data Warga';
            $this->load->view('admin/index', $data);
        }
// -------------------------------------------------------------------------
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
// -------------------------------------------------------------------------
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
            $list_komplain = $this->m_admin->komplainJoinWarga()->result_array();
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

// -------------------------------------------------------------------------
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
            $data['title'] = 'Tabel Data pengeluaran';
            $this->load->view('admin/index',$data);
        }
        public function rekapbulan(){
            // $where = array(
            // 	'nip' => $this->session->userdata('nip')
            // );
            // $data['dataiuran'] = $this->petugas_model->view_data($where,'iuran_masuk')->result();
            $data['content'] = "admin/rekapbulan";
            $data['title'] = 'Tabel Data Rekap';
            $this->load->view('admin/index',$data);
        }

        public function tampilbulan(){
            $data['content'] = "admin/tampilbulan";
            $data['title'] = 'Tabel Data Bulan';
            $data['iuran'] = $this->m_admin->tampil_iuran_perbulan()->result();
            $this->load->view('admin/index',$data);
        }

        public function tabelpemasukan(){
            $data['title'] = 'Tabel Data Keluar';
            $data['dataiuranmsk'] = $this->m_admin->tampil_iuran_masuk()->result_array();
            $data['content'] = "admin/tabelpemasukan.php";
            $this->load->view('admin/index',$data);
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
        }
        public function formpengeluaran(){
            // $where = array(
            // 	'nip' => $this->session->userdata('nip')
            // );
            // $data['dataiuran'] = $this->petugas_model->view_data($where,'iuran_masuk')->result();
            $nik="";
            $data['title'] = 'Input Pengeluaran';
            $data['tanggal'] = date('Y-m-d');
            $data['content'] = "admin/formpengeluaran";
            $this->load->view('admin/index',$data);

        }


        public function formpemasukan(){
            // $where = array(
            // 	'nip' => $this->session->userdata('nip')
            // );
           // $data['dataiuran'] = $this->petugas_model->view_data($where,'iuran_masuk')->result();
            $data['title'] = 'Input Pemasukan';
            $data['tanggal'] = date('Y-m-d');
            $data['content'] = "admin/formpemasukan";
            $data['bulan'] = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            $this->load->view('admin/index',$data);
        }
        public function tabeldataiurankeluar(){
            $data['title'] = 'Tabel Data Keluar';
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
        public function edit_iuran_masuk($no_pembayaran)
        {
            $where = array(
                'no_pembayaran' => $no_pembayaran
            );
            $this->session->set_userdata($where);

            $data['pembayaran'] = $this->m_admin->edit_data_iuran_masuk($where,'pembayaran')->result();
            $data['content']="admin/editiuranmasuk.php";
            $this->load->view('admin/index',$data);
        }
        public function detail_iuran_masuk($nik){
            $where = array(
                'nik' => $nik
            );

            $data['detailpembayaran'] = $this->m_admin->detail($where)->result();
            // var_dump($this->m_admin->detail($where)->result());
            $data['content']="admin/detailpembayaran.php";
            $this->load->view('admin/index',$data);
        }
        public function detail_iuran_keluar($no_pengeluaran){
            $where = array(
                'no_pengeluaran' => $no_pengeluaran
            );

            $data['detailpengeluaran'] = $this->m_admin->view_detail_pengeluaran($where,'pengeluaran')->result();
            // var_dump($this->m_admin->detail($where)->result());
            $data['content']="admin/detailpengeluaran.php";
            $this->load->view('admin/index',$data);
        }
        function update_data_iuran_masuk(){
            if($this->input->post('edit_masuk')){
                $no_pengeluaran = $this->session->userdata('no_pemasukan');
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
    public function iuranmasuk(){
        $tanggal = date("Y-m-d");
        if($this->input->post('submit_masuk')){

            $this->form_validation->set_rules('nik','Nik','required');
            $this->form_validation->set_rules('pembayaran_bulan', 'Pembayaran Bulan', 'required');
            $this->form_validation->set_rules('nominal', 'Nominal', 'required');
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
            // $id_iuran_keluar = $this->input->post('id_iuran_keluar');
            if ($this->form_validation->run()==false){
                $data['content']="admin/formpemasukan";
                $data['tanggal'] = date('Y-m-d');
                $data['bulan'] = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

                $this->load->view('admin/index',$data);
                // $this->load->view('admin/formpengeluaran');
            } else {
                $nik = $this->input->post('nik');
                $pembayaran_bulan = $this->input->post('pembayaran_bulan');
                $nominal = $this->input->post('nominal');
                $bulan = $this->m_admin->tampil_bulan_iuran($nik)->result();
                // print_r($bulan);
                foreach ($bulan as $bulan) {
                    if ($pembayaran_bulan == $bulan->pembayaran_bulan) {
                        $this->session->set_flashdata('pembayaran', 'maaf user sudah membayar');
                        redirect("admin/formpemasukan");
                    } else {

                    }
                }

                $tanggal = date("Y-m-d",strtotime($tanggal));
            // $gambar = $_FILES['gambar']['name'];

            // $config['max_size'] =0;
            // $config['max_width']=0;
            // $config['max_height']=0;
            // $config['allowed_types'] = "png|jpg|jpeg|gif";
            // $config['upload_path']='./uploads/gambar';

            // $this->load->library('upload');
            // $this->upload->initialize($config);

            // $this->upload->do_upload('gambar');
            // $data_image=$this->upload->data('file_name');
            // $gambar = $data_image;

            // if(!$this->upload->do_upload('gambar')){
            //     echo "gambar gak masook";
            //     $error = array
            //     ('error'=>$this->upload->display_errors());
            //     $this->load->view('admin/tabelpengeluaran',$error);
            // }else{
            //     $data = array(
            //         'upload_data'=>$this->upload->data()
            //     );
            //     $file = $this->upload->data();
            //     $gambar=$file['file_name'];
            //     $gambar="gambar.jpg";
            // }

                $dataiuranmasuk = array(
                    'nik' => $nik,
                    'pembayaran_bulan'=> $pembayaran_bulan,
                    'nominal' => $nominal,
                    'tanggal' => $tanggal,

                );

                $query = $this->m_admin->isi_data_iuran_masuk($dataiuranmasuk);
                print_r($query);
                $this->session->set_userdata($dataiuranmasuk);

                if($query){
                    ?>
                    <script>
                            alert("Berhasil Isi Data")
                    </script>
                    <?php
                    $data['dataiuranmsk'] = $this->m_admin->tampil_iuran_masuk()->result_array();
                    $data['content'] = "admin/tabelpemasukan.php";
                    $this->load->view('admin/index',$data);
                }else{
                    ?>
                    <script>
                            alert("Gagal Isi Data")
                    </script>
                    <?php
                    $data['content'] = "admin/formpemasukan.php";
                    $this->load->view('admin/index',$data);
                }

        }
    }else{
        $data['tanggal'] = $tanggal;
        $data['content'] = "admin/formpemasukan.php";
        $this->load->view('admin/index',$data);
    }
}

        public function iurankeluar(){
            $tanggal = date("Y-m-d");
            if($this->input->post('submit')){
                $this->form_validation->set_rules('diberikan_kepada','Kelompok Anggaran','required');
                $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
                $this->form_validation->set_rules('nominal', 'Nominal', 'required');
                $this->form_validation->set_rules('digunakan_untuk', 'Keterangan', 'required');
                // $id_iuran_keluar = $this->input->post('id_iuran_keluar');
                if ($this->form_validation->run()==false){
                    $data['content']="admin/formpengeluaran";
                    $this->load->view('admin/index',$data);
                    // $this->load->view('admin/formpengeluaran');
                } else {
                $diberikan_kepada = $this->input->post('diberikan_kepada');
                $tanggal = date("Y-m-d",strtotime($tanggal));
                $nominal = $this->input->post('nominal');
                $digunakan_untuk = $this->input->post('digunakan_untuk');
                $gambar = $_FILES['gambar']['name'];

                $config['max_size'] =0;
                $config['max_width']=0;
                $config['max_height']=0;
                $config['allowed_types'] = "png|jpg|jpeg|gif";
                $config['upload_path']='./uploads/gambar';

                $this->load->library('upload');
                $this->upload->initialize($config);

                $this->upload->do_upload('gambar');
                $data_image=$this->upload->data('file_name');
                $gambar = $data_image;

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
                    // $gambar="gambar.jpg";


                    $dataiurankeluar = array(
                        'diberikan_kepada' => $diberikan_kepada,
                        'tanggal'=> $tanggal,
                        'nominal' => $nominal,
                        'digunakan_untuk' => $digunakan_untuk,
                        'gambar' => $gambar,
                    );

                    $query = $this->m_admin->isi_data_iuran_keluar($dataiurankeluar);
                    print_r($query);
                    $this->session->set_userdata($dataiurankeluar);

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
                }
            }else{
                echo "Hai";
                $data['tanggal'] = $tanggal;
                $data['content'] = "admin/formpengeluaran.php";
                $this->load->view('admin/index',$data);


            }
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
            $data['generate_id'] = $this->m_admin->get_id($id,$nama_field,$nama_tabel); //$this->session->userdata('jabatan')
            $data['generate_id2'] = $this->m_admin->get_id($id2,$nama_field,$nama_tabel); //$this->session->userdata('jabatan')
            $data['content'] = 'admin/v_undangan';
            $data['title'] = 'Input Surat Undangan Kegiatan';
            $this->load->view('admin/index', $data);
        }

        public function inputnotulensi(){
            $id         = 'notulensi';
            $nama_field = 'no_notulen';
            $nama_tabel = 'notulensi_rpt';
            $data['key_no_udg'] = $this->uri->segment(3);
            $data['generate_id'] = $this->m_admin->get_id($id,$nama_field,$nama_tabel); //$this->session->userdata('jabatan')
            $data['content'] = 'admin/v_notulensi';
            $data['title'] = 'Input Notulensi Rapat';
            $this->load->view('admin/index', $data);
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

        public function cetak_undangan()
        {
            $test = 'Warga RT 01 as,dbadjbasdb kjasbdkasbd kabsksbak baslasdaab ajlsbdlasn lasn alsn alsn sanlasn d;lasnlasan';
          $pdf = new FPDF('P','mm','A4');
          // membuat halaman baru
          $pdf->AddPage();
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
          $pdf->Cell(5,5,'RT01/RPT/001',0,0,'L');
          $pdf->Cell(60);
          $pdf->Cell(5,5,'Bandung,',0,0,'L');
          $pdf->Cell(15);
          $pdf->Cell(5,5,'13 November 2020',0,1,'L');
          $pdf->Ln(1);
          $pdf->Cell(17);
          $pdf->Cell(5,5,'Lampiran',0,0,'L');
          $pdf->Cell(25);
          $pdf->Cell(5,5,':',0,0,'L');
          $pdf->Cell(5,5,'1 lembar',0,1,'L');
          $pdf->Ln(1);
          $pdf->Cell(17);
          $pdf->Cell(5,5,'Sifat',0,0,'L');
          $pdf->Cell(25);
          $pdf->Cell(5,5,':',0,0,'L');
          $pdf->Cell(5,5,'Penting',0,0,'L');
          $pdf->Cell(60);
          $pdf->Cell(5,5,'Kepada',0,1,'L');
          $pdf->Ln(1);
          $pdf->Cell(17);
          $pdf->Cell(5,5,'Hal',0,0,'L');
          $pdf->Cell(25);
          $pdf->Cell(5,5,':',0,0,'L');
          $pdf->Cell(5,5,'Undangan Rapat',0,0,'L');
          $pdf->Cell(60);
          $pdf->Cell(5,5,'Yth.',0,0,'L');
          $pdf->Cell(5);
          $pdf->MultiCell(60,5,'Warga RT 01 as,dbadjbasdb kjasbdkasbd kabsksbak baslasdaab',0,'L');
          $pdf->Cell(117);
          $pdf->Cell(5,7,'Di Tempat',0,1,'L');
          $pdf->Cell(120);
          $pdf->Ln(6);
          $pdf->SetFont('Arial','B',12);
          $pdf->Cell(190,7,'SURAT UNDANGAN',0,1,'C');
          $pdf->SetFont('Arial','',12);
          $pdf->Ln(4);
          $pdf->Cell(17);
          $pdf->MultiCell(160,7,'Berdasarkan '.$test.', maka dengan ini kami mengundang Saudara/Bapak/Ibu untuk hadir pada',0,'L');
          $pdf->Ln(6);
          $pdf->Cell(35);
          $pdf->Cell(35,7,'Hari tanggal',0,'L');
          $pdf->Cell(5,7,':',0,'L');
          $pdf->MultiCell(100,7,'14 november 2019',0,'L');
          $pdf->Cell(35);
          $pdf->Cell(35,7,'Waktu',0,'L');
          $pdf->Cell(5,7,':',0,'L');
          $pdf->MultiCell(100,7,'Jam '.'19.00'.' s/d selesai',0,'L');
          $pdf->Cell(35);
          $pdf->Cell(35,7,'Tempat',0,0,'L');
          $pdf->Cell(5,7,':',0,0,'L');
          $pdf->MultiCell(100,7,'Masjid Al-huda',0,'L');
          $pdf->Cell(35);
          $pdf->Cell(35,7,'Acara',0,0,'L');
          $pdf->Cell(5,7,':',0,0,'L');
          $pdf->MultiCell(100,7,'Penyampaian susunan pengurus RT yang baru',0,'L');
          $pdf->Ln(6);
          $pdf->Cell(17);
          $pdf->MultiCell(160,7,'Demikian disampaikan untuk dapat dimaklumi, atas kehadirannya diucapkan terima kasih agar menjadi maklum yang berkepentingan mengetahuinya.',0,'L');
          $pdf->Ln(4);
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
          $pdf->Ln(8);
          $pdf->SetFont('Arial','B'.'U',11);
          $pdf->Cell(19,7,'Tembusan',0,0,'C');
          $pdf->SetFont('Arial','',11);
          $pdf->Cell(3,7,':',0,0,'C');
          $pdf->MultiCell(177,7,'1. Yth. Rukun Warga 01',0,'L');


          $pdf->Output('Undangan Rapat','I');
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
            $nama_field = 'no_udg';
            $nama_tabel = 'surat_undangan';
            $generate_id = $this->m_admin->get_id($id,$nama_field,$nama_tabel); //$this->session->userdata('jabatan')
            $content = 'admin/form_usulan';
            $title = 'Form Usulan Rapat';
            $data = [
              'generate_id' => $generate_id,
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

        public function klik_konfirmasi_usulan_rapat($id2){
            $data['status'] = 1;
            $query = $this->m_admin->edit_data('surat_undangan','no_udg',$id2,$data);

            if ($query) {
                $json['message'] = 'Data Usulan Rapat Berhasil Dikonfirmasi';
            }else {
                $json['errors'] = 'Data Usulan Rapat Dikonfirmasi';
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

        public function declineSuratPengantar($id_surat)
        {
            $this->form_validation->set_rules('pesan', 'Pesan', 'regex_match[/^[a-zA-Z ]/]');
            if ($this->input->post()) {
                $pesan = $this->input->post('pesan');

                if ($this->form_validation->run() == TRUE) {
                    $data = [
                        'nomor_surat' => $id_surat,
                        'pesan' => $pesan,
                        'status' => 'ditolak'
                    ];
                    $tolak = $this->m_admin->input_data('status_surat',$data);
                    if($tolak){
                        ?>
                        <script>
                            alert('Penolakan Berhasil');
                            location = "<?php base_url('admin/daftarSuratPengantar');?>";
                        </script>
                        <?php
                    }else{
                        ?>
                        <script>
                            alert('Penolakan Gagal');
                            location = "<?php base_url('admin/daftarSuratPengantar');?>";
                        </script>
                        <?php
                    }
                //     if ($tolak) {
                //         $url = base_url('admin/daftarSuratPengantar');

                //         $json = [
                //             'message' => "Surat pengantar berhasil ditolak..",
                //             'url' => $url
                //         ];
                //     } else {
                //         $json['errors'] = "Surat pengantar gagal ditolak..";
                //     }

                // } else {
                //     $no = 0;
                //     foreach ($this->input->post() as $key => $value) {
                //         if (form_error($key) != "") {
                //             $json['form_errors'][$no]['id'] = $key;
                //             $json['form_errors'][$no]['msg'] = form_error($key, null, null);
                //             $no++;
                //         }
                //     }
                // }
                // echo json_encode($json);
            }else {
                ?>
                <script>
                    location = "<?php base_url('admin/daftarSuratPengantar');?>";
                </script>
                <?php
            }

        }
    }

    public function declineWarga($nik)
    {
        $this->form_validation->set_rules('pesan', 'Pesan', 'regex_match[/^[a-zA-Z ]/]');

        if ($this->input->post()) {
            $pesan = $this->input->post('pesan');

            if ($this->form_validation->run() == TRUE) {
                $data = [
                    'nik' => $nik,
                    'pesan'=>$pesan
                ];

                $data2['valid'] = 2;

                $insert = $this->m_admin->input_data('decline_warga',$data);
                $update = $this->m_admin->edit_data('warga','nik',$nik,$data2);

                if ($insert && $update) {
                    $url = base_url('admin/konfirmasiDataWarga');
                    $json = [
                        'message' => 'Data Warga Berhasil Dibatalkan',
                        'url' => $url  
                    ];
                }else {
                    $json['errors'] = 'Data Warga Gagal Dibatalkan';
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
        }else {
            redirect('admin/konfirmasiDataWarga','refresh');
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
                'tgl_buat' => $date,
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
                  'field' => 'lampiran',
                  'label' => 'lampiran',
                  'rules' => 'required'
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
            $no_notulen     = $this->input->post('no_notulen');
            $lampiran       = $this->input->post('lampiran');
            $tembusan       = $this->input->post('tembusan');
            $uraian_notulen = $this->input->post('uraian_notulen');
            $date = date("Y/m/d");
            $no_udg       = $this->input->post('no_udg');

            if ($this->form_validation->run() == TRUE) {
              $data = [
                'no_notulen'      => $no_notulen,
                'lampiran'        => $lampiran,
                'tembusan'        => $tembusan,
                'uraian_notulen'  => $uraian_notulen,
                'tgl_buat'        => $date,
                'no_udg'          => $no_udg
              ];

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
            redirect('admin/v_notulensi','refresh');
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
                $url = base_url('admin/riwayat_arsip');

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
             redirect('admin/riwayat_arsip','refresh');
          }

        }

        public function insertUsulanPengurus(){
          $this->form_validation->set_rules([
              [
                  'field' => 'no_udg',
                  'label' => 'Nomor Surat',
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
            $no_udg = $this->input->post('no_udg');
            $tujuan_srt = $this->input->post('tujuan_surat');
            $tempat_udg = $this->input->post('tempat_udg');
            $usul_surat  = $this->input->post('usul_surat');
            $tgl_rpt    = $this->input->post('tgl_rpt');
            $jam_udg    = $this->input->post('jam_udg');

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
                $url = base_url('admin/index');

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
                  'field' => 'lampiran',
                  'label' => 'lampiran',
                  'rules' => 'required'
              ],

              [
                  'field' => 'uraian_notulen',
                  'label' => 'Uraian Notulensi',
                  'rules' => 'trim|required'
              ]
          ]);

          if ($this->input->post()) {
            $no_notulen     = $this->input->post('no_notulen');
            $lampiran       = $this->input->post('lampiran');
            $tembusan       = $this->input->post('tembusan');
            $uraian_notulen = $this->input->post('uraian_notulen');


            if ($this->form_validation->run() == TRUE) {
              $data = [
                'no_notulen' => $no_notulen,
                'lampiran' => $lampiran,
                'tembusan' => $tembusan,
                'uraian_notulen' => $uraian_notulen
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
            redirect('admin/editNotulen','refresh');
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
                  'field' => 'tgl_terima',
                  'label' => 'Tanggal Terima Surat',
                  'rules' => 'required'
              ],


              // [
              //     'field' => 'tgl_surat',
              //     'label' => 'Tanggal Surat',
              //     'rules' => 'required'
              // ],

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
                $url = base_url('admin/riwayat_arsip');

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
             redirect('admin/riwayat_arsip','refresh');
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
