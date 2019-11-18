<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class C_autentikasi extends CI_Controller {
    
        
        public function __construct(){
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->model('m_user');
        }
//==============================================================================================
        public function index(){
            $this->cek_session();
            $this->load->view('default/login');
        }
//==============================================================================================
        public function login(){
            $username_email = $this->input->post('username_email');
            $password = $this->input->post('password');
            $auth_data = [
                'username_email' => $username_email,
                'password' => $password
            ];
            $user_auth = $this->m_user->cek_user($auth_data)->row();
            if (!empty($user_auth)) {
                $array_auth = [
                    'id_user' => $user_auth->id_user,
                    'username' => $user_auth->username,
                    'role' => $user_auth->role,
                    'status' => 'berhasil'
                ];
                
                $this->session->set_userdata($array_auth);

                if ($user_auth->role == 'adminMaster') {
                    redirect('c_halaman_admin/','refresh');
                }
            }else {
                $this->session->set_flashdata('login_gagal', 'Username atau Password Salah');
                $this->load->view('default/login');
            }
            
        }
//===============================================================================================
        public function dashboard(){
            if(!$this->session->has_userdata('status')){
                redirect('c_autentikasi/','refresh');
            }
            $this->load->view('admin/dashboard');
        }
//===============================================================================================
        public function logout(){
            $this->session->sess_destroy();
            redirect('c_autentikasi/','refresh');
        }
//===============================================================================================
        private function cek_session(){
            if($this->session->has_userdata('status')){
                if ($this->session->userdata('role') == "adminMaster") {
                    redirect('c_halaman_admin/','refresh');
                }
            }
        }
//===============================================================================================
        public function register(){
            $this->load->view('default/registrasi');
        }
    }
    
    /* End of file Controllername.php */
?>