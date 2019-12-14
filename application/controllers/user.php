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

            $this->form_validation->set_rules([
                [
                    'field' => 'tanggal_surat',
                    'label' => 'Tanggal Surat',
                    'rules' => 'trim|required'
                ],
                [
                    'field' => 'keperluan',
                    'label' => 'Keperluan',
                    'rules' => 'trim|required|regex_match[/^[a-zA-Z ]/]'
                ]
            ]);
            if ($this->input->post()) {
                $nomor_surat = $this->input->post('nomor_surat');
                $tanggal_surat = $this->input->post('tanggal_surat');
                $keperluan = $this->input->post('keperluan');
                $nik = $this->m_admin->userJoinWarga($this->session->userdata('id_user'))->result()[0]->nik;

                if ($this->form_validation->run() == TRUE) {
                    $data = [
                        'nomor_surat' => $nomor_surat,
                        'tanggal_surat' => $tanggal_surat,
                        'keperluan' => $keperluan,
                        'nik' => $nik
                    ];
                    $insert_suratnya = $this->m_admin->input_data('surat_pengantar',$data);

                    if ($insert_suratnya) {
                        ?>
                        <script>
                            alert('Data Berhasil Diinputkan');
                            location = "<?php base_url('user/formSuratPengantar');?>";
                        </script>
                        <?php
                    }else {
                        ?>
                        <script>
                            alert('Data Gagal Diinputkan');
                            location = "<?php base_url('user/formSuratPengantar');?>";
                        </script>
                        <?php
                    }
                } else {
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
            }else {
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
        }
// ================================================================================
        public function formKomplain(){
            $data = [
                'content' => 'user/formKomplain',
                'title' => 'Komplain'
            ];
            $this->load->view('user/index', $data);
            
        }

// ===============================================================================
    }
    
    /* End of file User.php */
    
?>