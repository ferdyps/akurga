<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class C_ketuaRT extends CI_Controller {
    
        public function __construct()
        {
            parent::__construct();
            //Do your magic here
        }
        
        public function inputWarga(){
            
            if ($this->input->post()) {
                $nik = $this->input->post('nik');
                $nama = $this->input->post('name');
                $telp = $this->input->post('telp');
                $tempat_lahir = $this->input->post('tempat_lahir');
                $tanggal_lahir = $this->input->post('tanggal_lahir');
                $pendidikan = $this->input->post('pendidikan');
                $agama = $this->input->post('agama');
                
                
            }
            
        }
        
    }
    
    /* End of file C_ketuaRT.php */
    
?>