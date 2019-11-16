<?php 
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class C_halaman_admin extends CI_Controller {
 
        public function __construct(){
            parent::__construct();
            //Do your magic here
        }
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
    }
    
    /* End of file Controllername.php */
    
?>