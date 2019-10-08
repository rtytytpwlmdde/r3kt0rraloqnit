<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_Auth');
		$this->load->model('M_User');
	}

	function login(){
		$data['main_view'] = 'auth/v_login';
		$this->load->view('template/template_user',$data);
	}

	function formRegister(){
		$data['main_view'] = 'auth/v_register';
		$this->load->view('template/template_user',$data);
	}

	public function register(){
        $id_mahasiswa = $this->input->post('id_mahasiswa');
        $nama_mahasiswa = $this->input->post('nama_mahasiswa');
        $password = $this->input->post('password');
        $status_mahasiswa = 'belum divalidasi';
        
        if($this->M_User->cek_id_mahasiswa() == TRUE){
            $this->session->set_flashdata('notif', "nik $id_mahasiswa sudah terdaftar didatabase");
            redirect('User/formTambahMahasiswa');
        }else{
            $data = array(
                'id_mahasiswa' => $id_mahasiswa,
                'nama_mahasiswa' => $nama_mahasiswa,
                'password' => $password,
                'status_mahasiswa' => $status_mahasiswa
            );
            $this->M_User->tambahUser($data,'mahasiswa');
            $this->session->set_flashdata('notifsukses', "Proses Pendaftaran Akun Telah Terkirim");
            redirect('auth/login');
        }
    }
    
	public function cek_login(){
		if($this->session->userdata('logged_in') == FALSE){
				if($this->M_Auth->cek_user() == TRUE){
					$status = $this->session->userdata('status');
					if($status=='admin'){
						redirect('rekap/dashboard');
					}elseif($status=='sekretariat kuliah'){
						redirect('JadwalKuliah/petaJadwalKuliah');
					}elseif($status=='staff pelayanan'){
						redirect('JadwalKuliah/petaJadwalKuliah');
					}elseif($status=='kasubag akademik'){
						redirect('JadwalKuliah/petaJadwalKuliah');
					}elseif($status=='kasubag kemahasiswaan'){
						redirect('JadwalKuliah/petaJadwalKuliah');
					}elseif($status=='kasubag umum'){
						redirect('JadwalKuliah/petaJadwalKuliah');
					}else{
						redirect('kasubag_akademik/index');
					}
				}else if($this->M_Auth->cek_mahasiswa() == TRUE){
					redirect('agenda');
				}else{
					$this->session->set_flashdata('notifsukses', 'Username atau Password salah');
					redirect('auth/login');
				}
		}else {
			redirect('auth/logout');
		}
	}

	 function logout(){
		$this->session->sess_destroy();
		redirect('auth/login');
	}

	function editPassword(){
		$data['main_view'] = 'v_lupa_password';
		$this->load->view('v_lupa_password', $data);
	}
}
