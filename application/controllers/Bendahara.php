<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Bendahara extends CI_Controller {

        public $id_user;
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
                }else if ($this->session->userdata('role') == 'Ketua RW') {
                    redirect('ketuaRW/','refresh');
                }
            }
        }

        public function index(){
            $dataPoints = array();
            $dataPoints2 = array();
            $dataPemasukan = array();
            $dataPengeluaran = array();
            $dataPemasukan = array();
            $rt = $this->session->userdata('rt');
            $usulanPoints = $this->m_admin->CountData('surat_undangan', 'status', 0)->result_array();
            $query = $this->m_admin->CountData('warga','valid',0)->result_array();
            $result = $this->m_admin->grafikPendidikan()->result();
            $result2 = $this->m_admin->grafikPekerjaan()->result();

            $resultPemasukan = $this->m_admin->grafikPemasukan($rt)->result();
            $resultPengeluaran = $this->m_admin->grafikPengeluaran($rt)->result();
              foreach ($resultPemasukan as $row) {
                  array_push($dataPemasukan, array('label' => $row->tahun, 'y' => $row->total));
              }
              foreach ($resultPengeluaran as $row) {
                  array_push($dataPengeluaran, array('label' => $row->tahun, 'y' => $row->total));
              }

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
                'jumlahPengeluaran' => $dataPengeluaran,
                'jumlahPemasukan' => $dataPemasukan,
                'usulan_points' => $usulanPoints,
                'dataiurank'    => $this->m_admin->tampil_iuran_keluar($rt)->result_array(),
                'dataiuranmsk'  => $this->m_admin->tampil_iuran_masuk($rt)->result_array(),

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
        public function tabelpengeluaran(){
            $data['content'] = "admin/tabelpengeluaran";
            $data['title'] = 'Tabel Data pengeluaran';
            $this->load->view('admin/index',$data);
        }

        public function tabelpengeluaranuser(){
            $data['content'] = "admin/tabelpengeluaranuser";
            $data['title'] = 'Tabel Data pengeluaran';
            $this->load->view('admin/index',$data);
        }
        // public function tabeltarif(){
        //     // $where = array(
        //     // 	'nip' => $this->session->userdata('nip')
        //     // );
        //     // $data['dataiuran'] = $this->petugas_model->view_data($where,'iuran_masuk')->result();
        //     $data['content'] = "admin/tabelpengeluaran";
        //     $data['title'] = 'Tabel Data pengeluaran';
        //     $this->load->view('admin/index',$data);
        // }

        public function rekapbulan(){
            // $where = array(
            // 	'nip' => $this->session->userdata('nip')
            // );
            // $data['dataiuran'] = $this->petugas_model->view_data($where,'iuran_masuk')->result();
            $filtertahun = addslashes($this->input->get('tahun'));
            $rt = $this->session->userdata('rt');

            if(!empty($filtertahun)){
                  $data['masuk'] = $this->m_admin->iuranmasuk($rt,$filtertahun)->result();
            }else{
                  $data['masuk'] = $this->m_admin->iuranmasuk($rt)->result();
            }
            $data['content'] = "admin/rekapbulan";
            $data['title'] = 'Tabel Data Rekap';

            $this->load->view('admin/index',$data);
        }

        public function rekaprt(){

            $data['datart'] = $this->m_admin->datart()->result();
            $data['content'] = "admin/rekaprt";
            $data['title'] = 'Tabel Data RT ';

            $this->load->view('admin/index',$data);
        }

        public function rekapbulanrt(){
            // $where = array(
            // 	'nip' => $this->session->userdata('nip')
            // );
            // $data['dataiuran'] = $this->petugas_model->view_data($where,'iuran_masuk')->result();
            $filtertahun = addslashes($this->input->get('tahun'));
            $rt = addslashes($this->input->get('rt'));

            if(!empty($filtertahun)){
                  $data['masuk'] = $this->m_admin->iuranmasuk($rt,$filtertahun)->result();
            }else{
                  $data['masuk'] = $this->m_admin->iuranmasuk($rt)->result();
            }
            $data['content'] = "admin/rekapbulanrt";
            $data['title'] = 'Tabel Data Rekap';

            $this->load->view('admin/index',$data);
        }

        public function tampilbulan(){
            $data['content'] = "admin/tampilbulan";
            $data['title'] = 'Tabel Data Bulan';
            $rt = $this->session->userdata('rt');
            $data['iuran'] = $this->m_admin->tampil_iuran_perbulan($rt)->result();

            $filtertahun = addslashes($this->input->get('tahun'));

            $data['tahun'] = $this->m_admin->tampilTahunPembayaran()->result();
            $data['selectedTahun'] = $filtertahun;
            if(!empty($filtertahun)){
                $data['iuranTahun'] = $this->m_admin->tampil_iuran_perbulan_pertahun($rt,$filtertahun)->result();
            }

            /*
            print_r($data['iuran']);
            Array ( [0] => stdClass Object ( [no_pembayaran] => 139 [no_rumah] => 15 [tanggal] => 2020-07-22 [jenis_warga] => Sementara [jumlah_iuran] => 58000 ) [1] => stdClass Object ( [no_pembayaran] => 49 [no_rumah] => 20 [tanggal] => 2020-07-12 [jenis_warga] => Sementara [jumlah_iuran] => 310000 ) )

            print_r($data['tahun']);
            Array ( [0] => stdClass Object ( [tahun] => 2018 ) [1] => stdClass Object ( [tahun] => 2019 ) [2] => stdClass Object ( [tahun] => 2020 ) )

            print_r($data['iuranTahun']);
            Array ( [0] => stdClass Object ( [no_pembayaran] => 141 [no_rumah] => 15 [tanggal] => 2020-07-22 [bulan_januari] => Rp. 10.000 [bulan_februari] => Rp. 15.000 [bulan_maret] => 10000 [bulan_april] => 20000 [bulan_mei] => [bulan_juni] => [bulan_juli] => 8000 [bulan_agustus] => [bulan_september] => [bulan_oktober] => [bulan_november] => [bulan_desember] => [jenis_warga] => Sementara [jumlah_iuran] => 38000 [tahun] => 2018 ) [1] => stdClass Object ( [no_pembayaran] => 49 [no_rumah] => 20 [tanggal] => 2020-07-12 [bulan_januari] => 10000 [bulan_februari] => 10000 [bulan_maret] => 10000 [bulan_april] => 10000 [bulan_mei] => 10000 [bulan_juni] => 10000 [bulan_juli] => 10000 [bulan_agustus] => 10000 [bulan_september] => 10000 [bulan_oktober] => 10000 [bulan_november] => 10000 [bulan_desember] => 10000 [jenis_warga] => Sementara [jumlah_iuran] => 120000 [tahun] => 2018 ) )
            */

            $this->load->view('admin/index',$data);
        }
        public function tampilbulanBendahara(){
            $data['content'] = "admin/tampilbulanBendahara";
            $data['title'] = 'Tabel Data Bulan';
            $rt = $this->session->userdata('rt');
            $data['iuran'] = $this->m_admin->tampil_iuran_perbulan($rt)->result();

            $filtertahun = addslashes($this->input->get('tahun'));

            $data['tahun'] = $this->m_admin->tampilTahunPembayaran()->result();
            $data['selectedTahun'] = $filtertahun;
            if(!empty($filtertahun)){
                $data['iuranTahun'] = $this->m_admin->tampil_iuran_perbulan_pertahun($rt,$filtertahun)->result();
            }

            /*
            print_r($data['iuran']);
            Array ( [0] => stdClass Object ( [no_pembayaran] => 139 [no_rumah] => 15 [tanggal] => 2020-07-22 [jenis_warga] => Sementara [jumlah_iuran] => 58000 ) [1] => stdClass Object ( [no_pembayaran] => 49 [no_rumah] => 20 [tanggal] => 2020-07-12 [jenis_warga] => Sementara [jumlah_iuran] => 310000 ) )

            print_r($data['tahun']);
            Array ( [0] => stdClass Object ( [tahun] => 2018 ) [1] => stdClass Object ( [tahun] => 2019 ) [2] => stdClass Object ( [tahun] => 2020 ) )

            print_r($data['iuranTahun']);
            Array ( [0] => stdClass Object ( [no_pembayaran] => 141 [no_rumah] => 15 [tanggal] => 2020-07-22 [bulan_januari] => Rp. 10.000 [bulan_februari] => Rp. 15.000 [bulan_maret] => 10000 [bulan_april] => 20000 [bulan_mei] => [bulan_juni] => [bulan_juli] => 8000 [bulan_agustus] => [bulan_september] => [bulan_oktober] => [bulan_november] => [bulan_desember] => [jenis_warga] => Sementara [jumlah_iuran] => 38000 [tahun] => 2018 ) [1] => stdClass Object ( [no_pembayaran] => 49 [no_rumah] => 20 [tanggal] => 2020-07-12 [bulan_januari] => 10000 [bulan_februari] => 10000 [bulan_maret] => 10000 [bulan_april] => 10000 [bulan_mei] => 10000 [bulan_juni] => 10000 [bulan_juli] => 10000 [bulan_agustus] => 10000 [bulan_september] => 10000 [bulan_oktober] => 10000 [bulan_november] => 10000 [bulan_desember] => 10000 [jenis_warga] => Sementara [jumlah_iuran] => 120000 [tahun] => 2018 ) )
            */

            $this->load->view('admin/index',$data);
        }

        public function filterPemasukan()
        {
            $bulan = $this->input->get('bulan');
            $rt = $this->session->userdata('rt');
            $where = [
                'pembayaran_bulan' => $bulan
            ];
            if ($bulan == '' || $bulan == null) {
                echo json_encode($this->m_admin->tampil_iuran_masuk($rt)->result());
            } else {
                echo json_encode($this->m_admin->tampil_iuran_masuk($rt,$where)->result());
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

            $norumah = addslashes($this->input->get('norumah'));

            if(!empty($norumah)){
                $rt = $this->session->userdata('rt');
                $data['datawarga'] = $this->m_admin->tampilDataWarga($norumah,$rt)->result();

                if($data['datawarga']==null){
                    $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i>No Rumah Tersebut Tidak Cocok dengan RT yang Anda Kelola</div>");
                    redirect('Bendahara/formpemasukan');
                }else{
                    $this->session->set_flashdata("pesan", "<div class=\"alert alert-success\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i>No Rumah Cocok</div>");
                }
            }

            $this->load->view('admin/index',$data);
        }

        // ajax handler
        public function ajaxHandlerTampilTarif(){
            $jenisIuran = $this->input->get("jenis_iuran");
            $tanggal = $this->input->get("tanggal");

            $dataTarif = $this->m_admin->tarifDetail($jenisIuran, $tanggal)->row();
            echo json_encode($dataTarif);
        }

        public function tabelpemasukan(){
            $data['title'] = 'Tabel Data Pemasukkan';
            $rt = $this->session->userdata('rt');

            $data['dataiuranmsk'] = $this->m_admin->tampil_iuran_masuk($rt)->result_array();

            $filterbulan = addslashes($this->input->get('bulan'));
            $filtertahun = addslashes($this->input->get('tahun'));

            $dataPemasukan = array();

            if(!empty($filtertahun)){
                  $data['dataiuranmsk'] = $this->m_admin->tampil_iuran_masuk($rt,$filterbulan,$filtertahun)->result_array();
                  $resultPemasukan = $this->m_admin->grafikPemasukanPerbulanPertahun($rt,$filterbulan,$filtertahun)->result();

                  foreach ($resultPemasukan as $row) {
                      array_push($dataPemasukan, array('label' => $row->tanggal, 'y' => $row->total));
                  }
            }else{
                  $data['dataiuranmsk'] = $this->m_admin->tampil_iuran_masuk($rt)->result_array();
                  $resultPemasukan = $this->m_admin->grafikPemasukan($rt)->result();

                  foreach ($resultPemasukan as $row) {
                      array_push($dataPemasukan, array('label' => $row->tahun, 'y' => $row->total));
                  }
            }

            $data['jumlahPemasukan'] = $dataPemasukan;

            $data['content'] = "admin/tabelpemasukan.php";
            $this->load->view('admin/index',$data);
        }
        public function tabelpemasukankolektor(){
            $data['title'] = 'Tabel Data Pemasukkan';
            $rt = $this->session->userdata('rt');

            $data['dataiuranmsk'] = $this->m_admin->tampil_iuran_masuk($rt)->result_array();

            $filterbulan = addslashes($this->input->get('bulan'));
            $filtertahun = addslashes($this->input->get('tahun'));

            $dataPemasukan = array();

            if(!empty($filtertahun)){
                  $data['dataiuranmsk'] = $this->m_admin->tampil_iuran_masuk($rt,$filterbulan,$filtertahun)->result_array();
                  $resultPemasukan = $this->m_admin->grafikPemasukanPerbulanPertahun($rt,$filterbulan,$filtertahun)->result();

                  foreach ($resultPemasukan as $row) {
                      array_push($dataPemasukan, array('label' => $row->tanggal, 'y' => $row->total));
                  }
            }else{
                  $data['dataiuranmsk'] = $this->m_admin->tampil_iuran_masuk($rt)->result_array();
                  $resultPemasukan = $this->m_admin->grafikPemasukan($rt)->result();

                  foreach ($resultPemasukan as $row) {
                      array_push($dataPemasukan, array('label' => $row->tahun, 'y' => $row->total));
                  }
            }

            $data['jumlahPemasukan'] = $dataPemasukan;

            $data['content'] = "admin/tabelpemasukankolektor.php";
            $this->load->view('admin/index',$data);
        }
        public function tabeltarif(){
            $data['title'] = 'Tabel Data Pemasukan';
            $data['datatarif'] = $this->m_admin->tampil_tarif()->result_array();
            $data['content'] = "admin/tabeltarif.php";
            $this->load->view('admin/index',$data);
        }

        public function tabeldataiurankeluar(){
            $data['title'] = 'Tabel Data Keluar';
            $rt = $this->session->userdata('rt');

            $filterbulan = addslashes($this->input->get('bulan'));
            $filtertahun = addslashes($this->input->get('tahun'));
            $dataPengeluaran = array();

            if(!empty($filtertahun)){
                  $data['dataiurank'] = $this->m_admin->tampil_iuran_keluar($rt,$filterbulan,$filtertahun)->result_array();
                  $resultPengeluaran = $this->m_admin->grafikPengeluaranPerbulanPertahun($rt,$filterbulan,$filtertahun)->result();

                  foreach ($resultPengeluaran as $row) {
                      array_push($dataPengeluaran, array('label' => $row->tanggal, 'y' => $row->total));
                  }
            }else{
                  $data['dataiurank'] = $this->m_admin->tampil_iuran_keluar($rt)->result_array();
                  $resultPengeluaran = $this->m_admin->grafikPengeluaran($rt)->result();

                  foreach ($resultPengeluaran as $row) {
                      array_push($dataPengeluaran, array('label' => $row->tahun, 'y' => $row->total));
                  }
            }

            $data['jumlahPengeluaran'] = $dataPengeluaran;

            $data['content'] = "admin/tabelpengeluaran.php";
            $this->load->view('admin/index',$data);
        }

        public function tabeldataiurankeluaruser(){
            $data['title'] = 'Tabel Data Keluar';

            $filterbulan = addslashes($this->input->get('bulan'));
            $filtertahun = addslashes($this->input->get('tahun'));
            $rt = $this->session->userdata('rt');

            $dataPengeluaran = array();

            if(!empty($filtertahun)){
                  $data['dataiurank'] = $this->m_admin->tampil_iuran_keluar($rt,$filterbulan,$filtertahun)->result_array();
                  $resultPengeluaran = $this->m_admin->grafikPengeluaranPerbulanPertahun($rt,$filterbulan,$filtertahun)->result();

                  foreach ($resultPengeluaran as $row) {
                      array_push($dataPengeluaran, array('label' => $row->tanggal, 'y' => $row->total));
                  }
            }else{
                  $data['dataiurank'] = $this->m_admin->tampil_iuran_keluar($rt)->result_array();
                  $resultPengeluaran = $this->m_admin->grafikPengeluaran($rt)->result();

                  foreach ($resultPengeluaran as $row) {
                      array_push($dataPengeluaran, array('label' => $row->tahun, 'y' => $row->total));
                  }
            }
            $data['jumlahPengeluaran'] = $dataPengeluaran;

            $data['content'] = "admin/tabelpengeluaranuser.php";
            $this->load->view('admin/index',$data);
        }

        public function hapus_iuran_keluar($no_pengeluaran){
            $where = array(
                'no_pengeluaran' => $no_pengeluaran
            );
            // $no_pengeluaran = $this->m_admin->view_data($where,'pengeluaran')->row()->no_pengeluaran;
            $this->m_admin->delete_data_iuran_keluar($where,'pengeluaran');
            redirect('Bendahara/tabeldataiurankeluar');
        }
        public function edit_iuran_keluar($no_pengeluaran)
        {
          $data['title'] = 'Edit iuran keluar';
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
        public function tambah_tarif()
        {
            $data['title'] = 'Tabel Data Tarif';
            $data['content']="admin/tambahdatatarif.php";
            $this->load->view('admin/index',$data);

        }
        function tambah_data_tarif(){
            if($this->input->post('tambah')){
                $jenis_iuran = $this->input->post('jenis_iuran');
                $nominal = preg_replace("/[^0-9]/", "",$this->input->post('nominal'));

                $datatarif = array(
                    'jenis_iuran' => $jenis_iuran,
                    'nominal' => $nominal,
                    'status' => 'Aktif',
                    'tanggal' => date('Y-m-d')
                );
                $this->m_admin->input_data('tarif',$datatarif);
                redirect(base_url('Bendahara/tabeltarif'),'refresh');
            }else {
                redirect(base_url('Bendahara/tambah_tarif'),'refresh');
            }
        }

        function edit_tarif(){
                  $id_tarif = $this->input->get('id_tarif');
                  $status = $this->input->get('status');

                  $datatarif = array(
                      'status' => $status
                  );
                  $where = array(
                      'id_tarif' => $id_tarif
                  );
                  $this->m_admin->update_data($where,$datatarif,'tarif');
                  redirect(base_url('Bendahara/tabeltarif'),'refresh');
        }


        public function detail_iuran_masuk(){
            $data['title'] = 'Detail Iuran Masuk';
            $norumah = addslashes($this->input->get('norumah'));
            $tahun = addslashes($this->input->get('tahun'));

            $data['detailpembayaran'] = $this->m_admin->detail($norumah,$tahun)->result();
            // var_dump($this->m_admin->detail($where)->result());
            $data['content']="admin/detailpembayaran.php";
            $this->load->view('admin/index',$data);
        }

        public function detail_iuran_keluar($no_pengeluaran){
          $data['title'] = 'Detail Iuran Keluar';
            $where = array(
                'no_pengeluaran' => $no_pengeluaran
            );


            $data['detailpengeluaran'] = $this->m_admin->view_detail_pengeluaran($where,'pengeluaran')->result();
            // var_dump($this->m_admin->detail($where)->result());
            $data['content']="admin/detailpengeluaran.php";
            $this->load->view('admin/index',$data);
        }

	function update_data_iuran_keluar(){
		if($this->input->post('edit_keluar')){
      			$no_pengeluaran = $this->session->userdata('no_pengeluaran');
      			$diberikan_kepada = $this->input->post('diberikan_kepada');
      			$tanggal = date("Y-m-d",strtotime($this->input->post('tanggal')));
      			$nominal = preg_replace("/[^0-9]/", "",$this->input->post('nominal'));
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

            if(!empty($gambar)){
        			$dataiurankeluar = array(
                				'no_pengeluaran' => $no_pengeluaran,
                				'diberikan_kepada' => $diberikan_kepada,
                				'tanggal' => $tanggal,
                				'nominal' => $nominal,
                        'digunakan_untuk' => $digunakan_untuk,
                        'gambar' => $gambar

        			);
            }else{
              $dataiurankeluar = array(
                        'no_pengeluaran' => $no_pengeluaran,
                        'diberikan_kepada' => $diberikan_kepada,
                        'tanggal' => $tanggal,
                        'nominal' => $nominal,
                        'digunakan_untuk' => $digunakan_untuk
              );
            }

      			$where = array(
      				'no_pengeluaran' => $no_pengeluaran
      			);

			    $this->m_admin->update_data($where,$dataiurankeluar,'pengeluaran');
          $rt = $this->session->userdata('rt');
          $data['dataiurank'] = $this->m_admin->tampil_iuran_keluar($rt)->result_array();
          $data['content'] = "admin/tabelpengeluaran.php";
          $this->load->view('admin/index',$data);
  		} else {
  			redirect(base_url('Bendahara/editiurankeluar'),'refresh');
  		}
    }
    public function iuranmasuk(){
      $data['title'] = 'Iuran Masuk';
        $tanggal = date("Y-m-d");
        if($this->input->post('submit_masuk')){

            $this->form_validation->set_rules('no_rumah','No Rumah','required');
            // $this->form_validation->set_rules('tahun', 'Tahun', 'required');
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
                $no_rumah = $this->input->post('no_rumah');
                $pembayaran_bulan = substr($this->input->post('bulantahun'),0,-7);
                $tahun = substr($this->input->post('bulantahun'),-4);
                $nominal = $this->input->post('nominal');
                $bulan = $this->m_admin->tampil_bulan_iuran($no_rumah)->result();
                // // print_r($bulan);
                // foreach ($bulan as $value) {
                //     if (($pembayaran_bulan == $value->pembayaran_bulan) && ($tahun == $value->tahun)){
                //         $this->session->set_flashdata('pembayaran', 'maaf user sudah membayar');
                //         redirect("Bendahara/formpemasukan?norumah=$no_rumah");
                //     } else {
                //
                //     }
                // }

                $tanggal = date("Y-m-d",strtotime($tanggal));

                $dataiuranmasuk = array(
                    'no_rumah' => $no_rumah,
                    'pembayaran_bulan'=> $pembayaran_bulan,
                    'tahun' => $tahun,
                    'nominal' => $nominal,
                    'tanggal' => $tanggal,
                    'id_user' => $this->session->userdata('id_user')
                );

                $query = $this->m_admin->isi_data_iuran_masuk($dataiuranmasuk);
                print_r($query);
                $this->session->set_userdata($dataiuranmasuk);
                $rt = $this->session->userdata('rt');

                if($query){
                    ?>
                    <script>
                            alert("Berhasil Isi Data")
                    </script>
                    <?php
                    redirect(base_url('Bendahara/tampilbulan'),'refresh');
                }else{
                    ?>
                    <script>
                            alert("Gagal Isi Data")
                    </script>
                    <?php
                    redirect(base_url('Bendahara/formpemasukan'),'refresh');
                }

        }
    }else{
        $data['tanggal'] = $tanggal;
        $data['content'] = "admin/formpemasukan.php";
        $this->load->view('admin/index',$data);
    }
}

        public function iurankeluar(){
          $data['title'] = 'Tabel Data Keluar';
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
                $nominal = preg_replace("/[^0-9]/", "",$this->input->post('nominal'));
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
                $rt = $this->session->userdata('rt');

                    $dataiurankeluar = array(
                        'diberikan_kepada' => $diberikan_kepada,
                        'tanggal'=> $tanggal,
                        'nominal' => $nominal,
                        'digunakan_untuk' => $digunakan_untuk,
                        'id_user' => $rt = $this->session->userdata('id_user'),
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
                        redirect('Bendahara/tabeldataiurankeluar','refresh');
                    }else{
                        ?>
                        <script>
                                alert("Gagal Isi Data")
                        </script>
                        <?php
                        redirect('Bendahara/formpengeluaran','refresh');
                    }
                }
            }else{
                echo "Hai";
                $data['tanggal'] = $tanggal;
                $data['content'] = "admin/formpengeluaran.php";
                $this->load->view('admin/index',$data);


            }
        }
    }

    ?>
