<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_Auth');
		$this->load->model('M_User');
		$this->load->model('M_Peminjaman');
	}

	function login(){
		$data['main_view'] = 'Auth/V_login';
		$this->load->view('Template/Template_user',$data);
	}

	function formRegister(){
		$data['main_view'] = 'Auth/V_register';
		$this->load->view('Template/Template_user',$data);
	}

	function profil(){
		$username = $this->session->userdata('username');
		$data['main_view'] = 'Auth/V_profil';
		if($this->session->userdata('status') == 'pengguna'){
			$data['mahasiswa'] = $this->M_User->getDataMahasiswaById($username);
			$this->load->view('Template/Template_user',$data);
		}else{
			$data['jumlahUser'] = $this->M_User->getCountUserBaru();
			$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
			$data['operator'] = $this->M_User->getDataOperatorById($username);
			$this->load->view('Template/Template_operator',$data);
		}
	}

	function editProfil(){
        $id_mahasiswa = $this->input->post('id_mahasiswa');
        $nama_mahasiswa = $this->input->post('nama_mahasiswa');
        $nomor_telpon = $this->input->post('nomor_telpon');
        $alamat = $this->input->post('alamat');
        $instansi = $this->input->post('instansi');
        $password = $this->input->post('password');
        $data = array(
            'id_mahasiswa' => $id_mahasiswa,
            'nama_mahasiswa' => $nama_mahasiswa,
            'nomor_telpon' => $nomor_telpon,
            'alamat' => $alamat,
            'instansi' => $instansi,
            'password' => $password
        );

        $where = array('id_mahasiswa' => $id_mahasiswa);

        $this->M_User->updateUser($where,$data,'mahasiswa');
        $this->session->set_flashdata('notifsukses', "Data  berhasil diubah");
        redirect('index.php?/Auth/profil');
    }

	public function register(){
        $id_mahasiswa = $this->input->post('id_mahasiswa');
        $nama_mahasiswa = $this->input->post('nama_mahasiswa');
        $password = $this->input->post('password');
        $nomor_telpon = $this->input->post('nomor_telpon');
        $alamat = $this->input->post('alamat');
        $instansi = $this->input->post('instansi');
        $status_mahasiswa = 'belum divalidasi';
        
        if($this->M_User->cek_id_mahasiswa() == TRUE){
            $this->session->set_flashdata('notif', "nik $id_mahasiswa sudah terdaftar didatabase");
            redirect('index.php?/User/formTambahMahasiswa');
        }else{
            $data = array(
                'id_mahasiswa' => $id_mahasiswa,
                'nama_mahasiswa' => $nama_mahasiswa,
                'password' => $password,
                'nomor_telpon' => $nomor_telpon,
                'alamat' => $alamat,
                'alamat' => $alamat,
                'status_mahasiswa' => $status_mahasiswa
            );
            $this->M_User->tambahUser($data,'mahasiswa');
            $this->session->set_flashdata('notifsukses', "Proses Pendaftaran Akun Telah Terkirim");
            redirect('index.php?/Auth/login');
        }
    }
    
	public function cek_login(){
		if($this->session->userdata('logged_in') == FALSE){
				if($this->M_Auth->cek_user() == TRUE){
					$status = $this->session->userdata('status');
					if($status=='admin'){
						redirect('index.php?/rekap/dashboard');
					}elseif($status=='staff pelayanan'){
						redirect('index.php?/agenda');
					}else{
						redirect('index.php?/Auth/logout');
					}
				}else if($this->M_Auth->cek_mahasiswa() == TRUE){
					redirect('index.php?/agenda');
				}else{
					$this->session->set_flashdata('notifsukses', 'Username atau Password salah');
					redirect('index.php?/Auth/login');
				}
		}else {
			redirect('index.php?/Auth/logout');
		}
	}

	 function logout(){
		$this->session->sess_destroy();
		redirect('index.php?/Auth/login');
	}

	function editPassword(){
		$data['main_view'] = 'V_lupa_password';
		$this->load->view('V_lupa_password', $data);
	}
}
