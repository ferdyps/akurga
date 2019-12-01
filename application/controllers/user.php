<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class User extends CI_Controller {
    
        
        public function __construct(){
            parent::__construct();
            $this->load->model('m_admin');
            $this->load->library('form_validation');

            if(!$this->session->has_userdata('status')){
                redirect('auth/','refresh');
            } else {
                if ($this->session->userdata('role') == 'adminMaster') {
                    redirect('admin/','refresh');
                }
            }
        }
// ===============================================================================
        public function index(){
            $data['content'] = 'user/home';
            $data['title'] = 'Home';
            $this->load->view('user/index', $data);
        }
    
    }
    
    /* End of file User.php */
    
?>