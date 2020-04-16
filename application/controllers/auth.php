<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Auth extends CI_Controller {


        public function __construct(){
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->model('m_user');
        }
//==============================================================================================
        public function index(){
            $this->cek_session();
            $this->load->view('auth/login');
        }
//==============================================================================================
        public function login(){
            $this->form_validation->set_rules([
                [
                    'field' => 'username_email',
                    'label' => 'Username/Email',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'trim|required'
                ]
            ]);
            if ($this->input->post()) {
                $username_email = $this->input->post('username_email');
                $password = $this->input->post('password');

                if ($this->form_validation->run() == TRUE) {
                    $auth_data = [
                        'username_email' => $username_email,
                        'password' => md5($password)
                    ];
                    $user_auth = $this->m_user->cek_user($auth_data)->row();
                    if (!empty($user_auth)) {
                        $array_auth = [
                            'id_user'   => $user_auth->id_user,
                            'username'  => $user_auth->username,
                            'role'      => $user_auth->role,
                            'rt'        => $user_auth->rt,
                            'status'    => 'berhasil'
                        ];

                        $this->session->set_userdata($array_auth);

                        if ($user_auth->role == 'adminMaster' ) {
                            $url = base_url('admin/index');

                            $json = [
                                'message' => "Login Akun Berhasil",
                                'url' => $url
                            ];
                        } elseif ($user_auth->role == 'Warga') {
                            $url = base_url('user/index');

                            $json = [
                                'message' => "Login Akun Berhasil",
                                'url' => $url
                            ];
                        }elseif ($user_auth->role == 'Ketua RW') {
                            $url = base_url('ketuaRW/index');

                            $json = [
                                'message' => "Login Akun Berhasil",
                                'url' => $url
                            ];
                        }elseif ($user_auth->role == 'Ketua RT') {
                            $url = base_url('ketuaRT/index');

                            $json = [
                                'message' => "Login Akun Berhasil",
                                'url' => $url
                            ];

                        }elseif ( $user_auth->role == 'Bendahara' ) {
                            $url = base_url('Bendahara/index');

                            $json = [
                                'message' => "Login Akun Berhasil",
                                'url' => $url
                            ];
                        }elseif ( $user_auth->role == 'Kolektor Iuran' ) {
                            $url = base_url('Bendahara/index');

                            $json = [
                                'message' => "Login Akun Berhasil",
                                'url' => $url
                            ]; 

                        }elseif ($user_auth->role == 'Sekretaris RT' || $user_auth->role == 'Sekretaris RW') {
                            $url = base_url('sekretaris/index');

                            $json = [
                                'message' => "Registrasi Akun Berhasil",
                                'url' => $url
                            ];
                          }

                    } else {
                        $json['errors'] = "Akun Tidak Ditemukan";
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
                redirect('auth/login','refresh');
            }

        }
//===============================================================================================
        public function dashboard(){
            if(!$this->session->has_userdata('status')){
                redirect('auth/','refresh');
            }
            $this->load->view('admin/dashboard');
        }
//===============================================================================================
        public function logout(){
            $this->session->sess_destroy();
            redirect('auth/','refresh');
        }
//===============================================================================================
        private function cek_session(){
            if($this->session->has_userdata('status')){
                if ($this->session->userdata('role') == "adminMaster") {
                    redirect('admin/','refresh');
                }elseif ($this->session->userdata('role') == "Warga") {
                    redirect('user/','refresh');
                }elseif ($this->session->userdata('role') == "Ketua RT") {
                    redirect('ketuaRT/','refresh');
                }elseif ($this->session->userdata('role') == "Bendahara") {
                    redirect('Bendahara/','refresh');
                }elseif ($this->session->userdata('role') == "Kolektor Iuran") {
                    redirect('Bendahara/','refresh');
                }elseif ($this->session->userdata('role') == "Ketua RW") {
                    redirect('ketuaRW/','refresh');
                }elseif ($this->session->userdata('role') == "Sekretaris") {
                    redirect('sekretaris/','refresh');
                }
            }
        }
//===============================================================================================
        public function register(){
            $this->load->view('auth/registrasi');
        }
// ============================================================================================
        public function insert_register(){
            $this->form_validation->set_rules([
                [
                    'field' => 'nik',
                    'label' => 'NIK',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'username',
                    'label' => 'Username',
                    'rules' => 'trim|required|is_unique[user.username]'
                ],
                [
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'trim|valid_email|required|is_unique[user.email]'
                ],
                [
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'trim|required|max_length[12]'
                ],
                [
                    'field' => 'konfirmasi_password',
                    'label' => 'Konfirmasi Password',
                    'rules' => 'trim|required|matches[password]'
                ]
            ]);

            $this->form_validation->set_message('is_unique','{field} Sudah Terdaftar');

            $json = null;

            if ($this->input->post()) {
                $nik = $this->input->post('nik');
                $username = $this->input->post('username');
                $email = $this->input->post('email');
                $password = $this->input->post('password');

                if ($this->form_validation->run() == TRUE) {
                    $cek = $this->m_user->multiple_select_data('warga', ['nik' => $nik, 'valid' => 1])->num_rows();
                    if ($cek != 0) {
                        $data = [
                            'username' => $username,
                            'email' => $email,
                            'password' => md5($password),
                            'role' => 'Warga'
                        ];
                        $inputRegistrasi = $this->m_user->input_data('user',$data);

                        $data_user = $this->m_user->multiple_select_data('user', ['username' => $data['username'], 'password' => $data['password']])->row();
                        $id_user = $data_user->id_user;

                        $query = $this->m_user->update_data('warga', 'nik', $nik, ['id_user' => $id_user]);

                        if ($inputRegistrasi && $query) {
                            $url = base_url('auth/index');

                            $json = [
                                'message' => "Registrasi Akun Berhasil",
                                'url' => $url
                            ];
                        }else {
                            $json['errors'] = "Registrasi Akun Gagal";
                        }
                    }else {
                        $json['errors'] = "NIK Belum Valid";
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
                redirect('auth/registrasi','refresh');
            }
        }
    }

    /* End of file Controllername.php */
?>
