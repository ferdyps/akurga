<?php
class laporanpdf extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->library('pdf');
        $this->load->model('m_admin','pembayarancetak');
        // $this->load->model('pengembalian_model','pengembaliancetak');
        // $this->load->model('permintaan_model','permintaancetak');
    }
    
    function pembayaran(){
        $pdf = new FPDF('l','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(190,7,'REPORT IURAN WARGA',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'TRANSAKSI PEMBAYARAN IURAN WARGA',0,1,'C');
        $pdf->Cell(190,7,'PERIODE '. $this->input->post('from') . ' - ' . $this->input->post('end'),0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        // $pdf->Cell(30,6,'No',1,0);
        $pdf->Cell(45,6,'NIK',1,0);
        $pdf->Cell(40,6,'Nama ',1,0);
        $pdf->Cell(45,6,'Pembayaran Bulan',1,0);
        $pdf->Cell(35,6,'Nominal',1,0);
        $pdf->Cell(35,6,'Tanggal',1,1);
        // $pdf->Cell(30,6,'JUMLAH BELI',1,0);
        // $pdf->Cell(30,6,'HARGA BELI',1,0);
        // $pdf->Cell(25,6,'TOTAL',1,1);
        // $pdf->SetFont('Arial','',10);
        
        $data_pembayaran = $this->pembayarancetak->getJumlahPembayaran();
        $total=0;
        // $this->db->get('pengadaan_barang')->result();
        foreach ($data_pembayaran as $row){
            $pdf->Cell(45,6,$row->nik,1,0);
            $pdf->Cell(40,6,$row->nama,1,0); 
            $pdf->Cell(45,6,$row->pembayaran_bulan,1,0);
            $pdf->Cell(35,6,$row->nominal,1,0);
            $pdf->Cell(35,6,$row->tanggal,1,1);
            $total=$total + $row->nominal;
            // $pdf->Cell(35,6,$row->jumlahbeli,1,1);
            // $pdf->Cell(30,6,$row->jumlahbeli,1,0);
            // $pdf->Cell(30,6,$row->hargabeli,1,0);  
            // $pdf->Cell(25,6,$row->total,1,1); 
        }
        $pdf->Cell(190,7,'Total:',0,1,);
        $pdf->Cell(35,6,$total,1,1);
        $pdf->Output();
    }

    // function permintaan(){
    //     $id_permintaan = $_GET['id_permintaan'];
    //     $pdf = new FPDF('l','mm','A4');
    //     // membuat halaman baru
    //     $pdf->AddPage();
    //     // setting jenis font yang akan digunakan
    //     $pdf->SetFont('Arial','B',16);
    //     // mencetak string 
    //     $pdf->Cell(190,7,'PERMINTAAN BARANG',0,1,'C');
    //     $pdf->SetFont('Arial','B',12);
    //     $pdf->Cell(190,7,'TRANSAKSI PERMINTAAN BARANG',0,1,'C');
    //     // Memberikan space kebawah agar tidak terlalu rapat
    //     $pdf->Cell(10,7,'',0,1);
    //     $pdf->SetFont('Arial','B',10);
    //     $pdf->Cell(30,6,'ID PERMINTAAN',1,0);
    //     $pdf->Cell(45,6,'TGL PERMINTAAN ',1,0);
    //     $pdf->Cell(50,6,'NAMA BARANG',1,0);
    //     $pdf->Cell(50,6,'NAMA SUPPLIER',1,0);
        
    //     $pdf->Cell(50,6,'JUMLAH PERMINTAAN',1,1);
    //     // $pdf->Cell(30,6,'HARGA BELI',1,0);
    //     // $pdf->Cell(32,6,'TOTAL',1,1);
    //     $pdf->SetFont('Arial','',10);
    //     $data_permintaan = $this->permintaancetak->getJumlahPermintaanById($id_permintaan);
    //     // $this->db->get('pengadaan_barang')->result();
    //     foreach ($data_permintaan as $row){
    //         $pdf->Cell(30,6,$row->id_permintaan,1,0);
    //         $pdf->Cell(45,6,$row->tgl_permintaan,1,0);
    //         $pdf->Cell(50,6,$row->nama_barang,1,0); 
    //         $pdf->Cell(50,6,$row->nama_supplier,1,0);
            
    //         $pdf->Cell(50,6,$row->jumlah_permintaan,1,1);
    //         // $pdf->Cell(30,6,$row->hargabeli,1,0);  
    //         // $pdf->Cell(32,6,$row->total,1,1); 
    //     }
    //     $pdf->Output();
    // }


    // function pengembalian(){
    //     $pdf = new FPDF('l','mm','A4');
    //     // membuat halaman baru
    //     $pdf->AddPage();
    //     // setting jenis font yang akan digunakan
    //     $pdf->SetFont('Arial','B',16);
    //     // mencetak string 
    //     $pdf->Cell(190,7,'REPORT PENGEMBALIAN BARANG',0,1,'C');
    //     $pdf->SetFont('Arial','B',12);
    //     $pdf->Cell(190,7,'PENGEMBALIAN BARANG KE SUPPLIER',0,1,'C');
    //     $pdf->Cell(190,7,'PERIODE '. $this->input->post('from') . ' - ' . $this->input->post('end'),0,1,'C');
    //     // Memberikan space kebawah agar tidak terlalu rapat
    //     $pdf->Cell(10,7,'',0,1);
    //     $pdf->SetFont('Arial','B',10);
    //     $pdf->Cell(37,6,'No',1,0);
    //     $pdf->Cell(45,6,'Tanggal Pengembalian',1,0);
    //     $pdf->Cell(50,6,'Jumlah Pengembalian',1,0);
    //     $pdf->Cell(45,6,'Alasan Pengembalian',1,0);
    //     $pdf->Cell(48,6,'Nama Barang',1,0);
    //     $pdf->Cell(48,6,'Nama Supplier',1,1);
    //     $pdf->SetFont('Arial','',10);
    //     $data_pengembalian = $this->pengembaliancetak->getJumlahPengembalian();
    //     // $this->db->get('pengadaan_barang')->result();
    //     foreach ($data_pengembalian as $row){
    //         $pdf->Cell(37,6,$row->id_pengembalian,1,0);
    //         $pdf->Cell(45,6,$row->tglaktivitas,1,0); 
    //         $pdf->Cell(50,6,$row->jumlah_pengembalian,1,0);
    //         $pdf->Cell(45,6,$row->alasan_pengembalian,1,0);
    //         $pdf->Cell(48,6,$row->nama_barang,1,0);
    //         $pdf->Cell(48,6,$row->nama_supplier,1,1);  
            
    //     }
    //     $pdf->Output();
    // }

    // function customers(){
    //     $pdf = new FPDF('p','mm','A4');
    //     // membuat halaman baru
    //     $pdf->AddPage();
    //     // setting jenis font yang akan digunakan
    //     $pdf->SetFont('Arial','B',16);
    //     // mencetak string 
    //     $pdf->Cell(190,7,'REPORT DATA CUSTOMERS',0,1,'C');
    //     $pdf->SetFont('Arial','B',12);
    //     $pdf->Cell(190,7,'MEMBER BPTP YOGYAKARTA',0,1,'C');
    //     // Memberikan space kebawah agar tidak terlalu rapat
    //     $pdf->Cell(10,7,'',0,1);
    //     $pdf->SetFont('Arial','B',10);
    //     $pdf->Cell(30,6,'ID CUSTOMERS',1,0);
    //     $pdf->Cell(40,6,'Nama Lengkap ',1,0);
    //     $pdf->Cell(50,6,'ALAMAT CUSTOMERS',1,0);
    //     $pdf->Cell(30,6,'NO TELP.',1,1);
        
    //     $pdf->SetFont('Arial','',10);
    //     $data_customers = $this->db->get('customers')->result();
    //     foreach ($data_customers as $row){
    //         $pdf->Cell(30,6,$row->idcustomers,1,0);
    //         $pdf->Cell(40,6,$row->namalengkap,1,0);
    //         $pdf->Cell(50,6,$row->alamatcustomers,1,0);
    //         $pdf->Cell(30,6,$row->notelp,1,1); 
            
    //     }
    //     $pdf->Output();
    // }

    // function supplier(){
    //     $pdf = new FPDF('l','mm','A4');
    //     // membuat halaman baru
    //     $pdf->AddPage();
    //     // setting jenis font yang akan digunakan
    //     $pdf->SetFont('Arial','B',16);
    //     // mencetak string 
    //     $pdf->Cell(190,7,'LAPORAN DATA SUPPLIER',0,1,'C');
    //     $pdf->SetFont('Arial','B',12);
    //     $pdf->Cell(190,7,'LIST SUPPLIER BARANG',0,1,'C');
    //     // Memberikan space kebawah agar tidak terlalu rapat
    //     $pdf->Cell(10,7,'',0,1);
    //     $pdf->SetFont('Arial','B',10);
    //     $pdf->Cell(30,6,'ID SUPPLIER',1,0);
    //     $pdf->Cell(50,6,'NAMA SUPPLIER',1,0);
    //     $pdf->Cell(50,6,'TELP SUPPLIER',1,0);
    //     $pdf->Cell(70,6,'EMAIL SUPPLIER ',1,0);
    //     $pdf->Cell(50,6,'ALAMAT SUPPLIER',1,1);
    //     // $pdf->Cell(30,6,'HARGA BELI',1,0);
    //     // $pdf->Cell(32,6,'TOTAL',1,1);
    //     $pdf->SetFont('Arial','',10);
    //     $supplier = $this->db->get('supplier')->result();
       
    //     foreach ($supplier as $row){
    //         $pdf->Cell(30,6,$row->id_supplier,1,0);
    //         $pdf->Cell(50,6,$row->nama_supplier,1,0); 
    //         $pdf->Cell(50,6,$row->telp_supplier,1,0);
    //         $pdf->Cell(70,6,$row->email_supplier,1,0);
    //         $pdf->Cell(50,6,$row->alamat_supplier,1,1);
    //         // $pdf->Cell(30,6,$row->hargabeli,1,0);  
    //         // $pdf->Cell(32,6,$row->total,1,1); 
    //     }
    //     $pdf->Output();
    }


