<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_Auth');
	}

	function login(){
		$data['main_view'] = 'auth/v_login';
		$this->load->view('template/template_user',$data);
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
