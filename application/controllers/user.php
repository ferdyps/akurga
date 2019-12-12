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
            $data = [
                'content' => 'user/home',
                'title' => 'Home'
            ];
            $this->load->view('user/index', $data);
        }
// ================================================================================
        public function formSuratPengantar(){
            $id         = 'surat_pengantar';
            $nama_field = 'nomor_surat';
            $nama_tabel = 'surat_pengantar';
            $generate_id = $this->m_admin->get_id($id,$nama_field,$nama_tabel);
            $data = [
                'content' => 'user/formSuratPengantar',
                'title' => 'Surat Pengantar',
                'generate_id' => $generate_id
            ];
            $this->load->view('user/index', $data);
        }
// ================================================================================
        public function formKomplain(){
            $data['content'] = 'user/formKomplain';
            $data['title'] = 'Komplain';
            $this->load->view('user/index', $data);
            
        }

// ===============================================================================
        public function insertSuratPengantar(){
            $this->form_validation->set_rules([
                [
                    'filed' => 'tanggal_surat',
                    'label' => 'Tanggal Surat',
                    'rules' => 'trim|required'
                ],
                [
                    'filed' => 'keperluan',
                    'label' => 'Keperluan',
                    'rules' => 'trim|required|regex_match[/^[a-zA-Z ]/]'
                ]
            ]);
            if ($this->input->post()) {
                $nomor_surat = $this->input->post('nomor_surat');
                $tanggal_surat = $this->input->post('tanggal_surat');
                $keperluan = $this->input->post('keperluan');
                $nik = $this->m_admin->userJoinWarga($this->session->userdata('id_user'))->get()->nik;
                
                if ($this->form_validation->run() == TRUE) {
                    $data = [
                        'nomor_surat' => $nomor_surat,
                        'tanggal_surat' => $tanggal_surat,
                        'keperluan' => $keperluan,
                        'nik' => $nik
                    ];
                    $insert_suratnya = $this->m_admin->input_data('surat_pengantar',$data);

                    if ($insert_suratnya) {
                        $url = base_url('user/formSuratPengantar');

                        $json = [
                            'message' => "Pengajuan surat berhasil diinput..",
                            'url' => $url
                        ];
                    }else {
                        $json['errors'] = "Pengajuan surat gagal diinput..!";
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
                    redirect('user/formSuratPengantar','refresh');
                }
            }
    }
    
    /* End of file User.php */
    
?>