<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_User');
		$this->load->model('m_peminjaman');
        $this->load->model('M_SaranaPrasarana');
        
		if($this->session->userdata('logged_in') == FALSE ){
            redirect("auth/logout");
        }
	}

// operator
	public function operator(){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("auth/logout");
        }
		$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
		$data['operator'] = $this->M_User->getDataOperator()->result();
        $data['ruangan'] = $this->M_SaranaPrasarana->getDataRuangan()->result();
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['main_view'] = 'User/V_ListOperator';
		$this->load->view('template/template_operator', $data);
	}

	public function formTambahOperator(){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("auth/logout");
        }
		$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['main_view'] = 'User/V_TambahOperator';
		$this->load->view('template/template_operator', $data);
	}

	public function tambahOperator(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$status_operator = $this->input->post('status_operator');
		
		if($this->M_User->cek_id_operator() == TRUE){
			$this->session->set_flashdata('notif', "username $username sudah terdaftar didatabase");
			redirect('User/formTambahOperator');
		}else{
			$data = array(
				'username' => $username,
				'status_operator' => $status_operator,
				'password' => $password
			);
			$datas = array(
				'id_mahasiswa' => $username,
				'nama_mahasiswa' => $username,
				'status_mahasiswa' => $status_operator,
				'password' => $password
			);
			$this->M_User->tambahUser($data,'operator');
			$this->M_User->tambahUser($datas,'mahasiswa');
			$this->session->set_flashdata('notifsukses', "Data operator berhasil ditambahkan");
			redirect('User/operator');
		}
	}

	function hapusOperator($username){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("auth/logout");
        }
		$where = array('username' => $username);
		$this->M_User->hapusUser($where,'operator');
		$this->session->set_flashdata('notifsukses', "Data operator berhasil dihapus");
		redirect('User/operator');
	}

	function updateOperator($username){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("auth/logout");
        }
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
		$data['main_view'] = 'User/V_EditOperator';
		$data['operator'] = $this->M_User->getDataOperatorById($username);
		$this->load->view('template/template_operator',$data);
	}

	function editOperator(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$status_operator = $this->input->post('status_operator');
			
		$data = array(
			'username' => $username,
			'password' => $password,
			'status_operator' => $status_operator
		);

		$where = array('username' => $username);

		$this->M_User->updateUser($where,$data,'operator');
		$this->session->set_flashdata('notifsukses', "Data user berhasil diubah");
		redirect('User/operator');
	}
//akhir operator

// dosen
    public function dosen(){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("auth/logout");
        }
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
        $data['dosen'] = $this->M_User->getDataDosen()->result();
        $data['main_view'] = 'User/V_ListDosen';
        $this->load->view('template/template_operator', $data);
    }

    public function formTambahDosen(){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("auth/logout");
        }
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
        $data['main_view'] = 'User/V_TambahDosen';
        $this->load->view('template/template_operator', $data);
    }

    public function tambahDosen(){
        $id_dosen = $this->input->post('id_dosen');
        $nama_dosen = $this->input->post('nama_dosen');
        
        if($this->M_User->cek_id_dosen() == TRUE){
            $this->session->set_flashdata('notif', "nik $id_dosen sudah terdaftar didatabase");
            redirect('User/formTambahDosen');
        }else{
            $data = array(
                'id_dosen' => $id_dosen,
                'nama_dosen' => $nama_dosen
            );
            $this->M_User->tambahUser($data,'dosen');
            $this->session->set_flashdata('notifsukses', "Data dosen berhasil ditambahkan");
            redirect('User/dosen');
        }
    }

    function hapusDosen($id_dosen){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("auth/logout");
        }
        $where = array('id_dosen' => $id_dosen);
        $this->M_User->hapusUser($where,'dosen');
        $this->session->set_flashdata('notifsukses', "Data dosen berhasil dihapus");
        redirect('User/dosen');
    }

    function updateDosen($id_dosen){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("auth/logout");
        }
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
        $data['main_view'] = 'User/V_EditDosen';
        $data['dosen'] = $this->M_User->getDataDosenById($id_dosen);
        $this->load->view('template/template_operator',$data);
    }

    function editDosen(){
        $id_dosen = $this->input->post('id_dosen');
        $nama_dosen = $this->input->post('nama_dosen');
            
        $data = array(
            'id_dosen' => $id_dosen,
            'nama_dosen' => $nama_dosen
        );

        $where = array('id_dosen' => $id_dosen);

        $this->M_User->updateUser($where,$data,'dosen');
        $this->session->set_flashdata('notifsukses', "Data dosen berhasil diubah");
        redirect('User/dosen');
    }
//akhir dosen

// mahasiswa
    public function user(){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("auth/logout");
        }
		$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
        $data['mahasiswa'] = $this->M_User->getDataMahasiswa()->result();
        $data['main_view'] = 'User/V_ListMahasiswa';
        $this->load->view('template/template_operator', $data);
    }

    public function formTambahUser(){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("auth/logout");
        }
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
        $data['main_view'] = 'User/V_TambahMahasiswa';
        $this->load->view('template/template_operator', $data);
    }

    public function tambahUser(){
        $id_mahasiswa = $this->input->post('id_mahasiswa');
        $nama_mahasiswa = $this->input->post('nama_mahasiswa');
        $alamat = $this->input->post('alamat');
        $instansi = $this->input->post('instansi');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $status_mahasiswa = 'belum divalidasi';
        
        if($this->M_User->cek_id_mahasiswa() == TRUE){
            $this->session->set_flashdata('notif', "nik $id_mahasiswa sudah terdaftar didatabase");
            redirect('User/formTambahMahasiswa');
        }else{
            $data = array(
                'id_mahasiswa' => $id_mahasiswa,
                'nama_mahasiswa' => $nama_mahasiswa,

                'alamat' => $alamat,
                'email' => $email,
                'instansi' => $instansi,
                'password' => $password,
                'status_mahasiswa' => $status_mahasiswa
            );
            $this->M_User->tambahUser($data,'mahasiswa');
            $this->session->set_flashdata('notifsukses', "Data mahasiswa berhasil ditambahkan");
            redirect('User/user');
        }
    }

    function hapusUser(){
        $id_mahasiswa = $this->input->post('username');
        $where = array('id_mahasiswa' => $id_mahasiswa);
        $this->M_User->hapusUser($where,'mahasiswa');
        $this->session->set_flashdata('notifsukses', "Data mahasiswa berhasil dihapus");
        redirect('User/user');
    }

    function updateUser($id){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("auth/logout");
        }
		$data['username'] = $id;
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
        $data['main_view'] = 'User/V_EditMahasiswa';
        $data['mahasiswa'] = $this->M_User->getDataMahasiswaById($id);
        $this->load->view('template/template_operator',$data);
    }

    function editUser(){
        $id_mahasiswa = $this->input->post('id_mahasiswa');
        $nama_mahasiswa = $this->input->post('nama_mahasiswa');
        $password = $this->input->post('password');
        $alamat = $this->input->post('alamat');
        $email = $this->input->post('email');
        $status_mahasiswa = $this->input->post('status_mahasiswa');
        $instansi = $this->input->post('instansi');
        $data = array(
            'id_mahasiswa' => $id_mahasiswa,
            'nama_mahasiswa' => $nama_mahasiswa,
            'password' => $password,
            'alamat' => $alamat,
            'email' => $email,
            'instansi' => $instansi,
            'status_mahasiswa' => $status_mahasiswa
        );

        $where = array('id_mahasiswa' => $id_mahasiswa);

        $this->M_User->updateUser($where,$data,'mahasiswa');
        $this->session->set_flashdata('notifsukses', "Data mahasiswa berhasil diubah");
        redirect('User/user');
    }

    function validasiUser($username){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("auth/logout");
        }
        $status = 'valid';
        $data = array(
            'status_mahasiswa' => $status
        );

        $where = array('id_mahasiswa' => $username);

        $this->M_User->updateUser($where,$data,'mahasiswa');
        $this->session->set_flashdata('notifsukses', "Data user berhasil divalidasi");
        redirect('User/user');
    }

    function tolakUser($username){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("auth/logout");
        }
        $status = 'valid';
        $data = array(
            'status_mahasiswa' => $status
        );

        $where = array('id_mahasiswa' => $username);

        $this->M_User->updateUser($where,$data,'mahasiswa');
        $this->session->set_flashdata('notifsukses', "Data user berhasil divalidasi");
        redirect('User/user');
    }

    function detailUser($id){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("auth/logout");
        }
		$data['username'] = $id;
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
        $data['mahasiswa'] = $this->M_User->getDataMahasiswaById($id);
        $data['main_view'] = 'User/V_DetailUser';
        $this->load->view('template/template_operator', $data);
    }

}