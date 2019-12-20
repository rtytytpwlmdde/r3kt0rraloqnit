<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_User');
		$this->load->model('M_Peminjaman');
        $this->load->model('M_SaranaPrasarana');
        
		if($this->session->userdata('logged_in') == FALSE ){
            redirect("Auth/logout");
        }
	}

// operator
	public function operator(){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("Auth/logout");
        }
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
		$data['operator'] = $this->M_User->getDataOperator()->result();
        $data['ruangan'] = $this->M_SaranaPrasarana->getDataSemuaRuangan();
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['main_view'] = 'User/V_listOperator';
		$this->load->view('Template/Template_operator', $data);
	}

	public function formTambahOperator(){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("Auth/logout");
        }
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['main_view'] = 'User/V_tambahOperator';
		$this->load->view('Template/Template_operator', $data);
	}

	public function tambahOperator(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$nama_fakultas = $this->input->post('nama_fakultas');
		$nama_operator = $this->input->post('nama_operator');
		$status_operator = $this->input->post('status_operator');
		
		if($this->M_User->cek_id_operator() == TRUE){
			$this->session->set_flashdata('gagal', "username $username sudah terdaftar didatabase");
			redirect('index.php?/User/formTambahOperator');
		}else{
			$data = array(
				'username' => $username,
				'status_operator' => $status_operator,
				'nama_operator' => $nama_operator,
				'nama_fakultas' => $nama_fakultas,
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
			$this->session->set_flashdata('sukses', "Data operator berhasil ditambahkan");
			redirect('index.php?/User/operator');
		}
	}

	function hapusOperator($username){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("Auth/logout");
        }
		$where = array('username' => $username);
		$this->M_User->hapusUser($where,'operator');
		$this->session->set_flashdata('notifsukses', "Data operator berhasil dihapus");
		redirect('index.php?/User/operator');
	}

	function updateOperator($username){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("Auth/logout");
        }
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
		$data['main_view'] = 'User/V_editOperator';
		$data['operator'] = $this->M_User->getDataOperatorById($username);
		$this->load->view('Template/Template_operator',$data);
	}

	function editOperator(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$nama_fakultas = $this->input->post('nama_fakultas');
		$nama_operator = $this->input->post('nama_operator');
		$status_operator = $this->input->post('status_operator');
			
		$data = array(
			'username' => $username,
			'password' => $password,
			'nama_fakultas' => $nama_fakultas,
			'nama_operator' => $nama_operator,
			'status_operator' => $status_operator
		);

		$where = array('username' => $username);

		$this->M_User->updateUser($where,$data,'operator');
		$this->session->set_flashdata('notifsukses', "Data user berhasil diubah");
		redirect('index.php?/User/operator');
	}
//akhir operator

// dosen
    public function dosen(){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("Auth/logout");
        }
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
        $data['dosen'] = $this->M_User->getDataDosen()->result();
        $data['main_view'] = 'User/V_listDosen';
        $this->load->view('Template/Template_operator', $data);
    }

    public function formTambahDosen(){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("Auth/logout");
        }
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
        $data['main_view'] = 'User/V_tambahDosen';
        $this->load->view('Template/Template_operator', $data);
    }

    public function tambahDosen(){
        $id_dosen = $this->input->post('id_dosen');
        $nama_dosen = $this->input->post('nama_dosen');
        
        if($this->M_User->cek_id_dosen() == TRUE){
            $this->session->set_flashdata('notif', "nik $id_dosen sudah terdaftar didatabase");
            redirect('index.php?/User/formTambahDosen');
        }else{
            $data = array(
                'id_dosen' => $id_dosen,
                'nama_dosen' => $nama_dosen
            );
            $this->M_User->tambahUser($data,'dosen');
            $this->session->set_flashdata('notifsukses', "Data dosen berhasil ditambahkan");
            redirect('index.php?/User/dosen');
        }
    }

    function hapusDosen($id_dosen){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("Auth/logout");
        }
        $where = array('id_dosen' => $id_dosen);
        $this->M_User->hapusUser($where,'dosen');
        $this->session->set_flashdata('notifsukses', "Data dosen berhasil dihapus");
        redirect('index.php?/User/dosen');
    }

    function updateDosen($id_dosen){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("Auth/logout");
        }
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
        $data['main_view'] = 'User/V_editDosen';
        $data['dosen'] = $this->M_User->getDataDosenById($id_dosen);
        $this->load->view('Template/Template_operator',$data);
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
        redirect('index.php?/User/dosen');
    }
//akhir dosen

// mahasiswa
    public function user(){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("Auth/logout");
        }
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
        $data['mahasiswa'] = $this->M_User->getDataMahasiswa()->result();
        $data['main_view'] = 'User/V_listMahasiswa';
        $this->load->view('Template/Template_operator', $data);
    }

    public function formTambahUser(){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("Auth/logout");
        }
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
        $data['main_view'] = 'User/V_tambahMahasiswa';
        $this->load->view('Template/Template_operator', $data);
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
            redirect('index.php?/User/formTambahMahasiswa');
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
            redirect('index.php?/User/user');
        }
    }

    function hapusUser(){
        $id_mahasiswa = $this->input->post('username');
        $where = array('id_mahasiswa' => $id_mahasiswa);
        $this->M_User->hapusUser($where,'mahasiswa');
        $this->session->set_flashdata('notifsukses', "Data mahasiswa berhasil dihapus");
        redirect('index.php?/User/user');
    }

    function updateUser($id){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("Auth/logout");
        }
		$data['username'] = $id;
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
        $data['main_view'] = 'User/V_editMahasiswa';
        $data['mahasiswa'] = $this->M_User->getDataMahasiswaById($id);
        $this->load->view('Template/Template_operator',$data);
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
        redirect('index.php?/User/user');
    }

    function validasiUser($username){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("Auth/logout");
        }
        $status = 'valid';
        $data = array(
            'status_mahasiswa' => $status
        );

        $where = array('id_mahasiswa' => $username);

        $this->M_User->updateUser($where,$data,'mahasiswa');
        $this->session->set_flashdata('notifsukses', "Data user berhasil divalidasi");
        redirect('index.php?/User/user');
    }

    function tolakUser($username){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("Auth/logout");
        }
        $status = 'valid';
        $data = array(
            'status_mahasiswa' => $status
        );

        $where = array('id_mahasiswa' => $username);

        $this->M_User->updateUser($where,$data,'mahasiswa');
        $this->session->set_flashdata('notifsukses', "Data user berhasil divalidasi");
        redirect('index.php?/User/user');
    }

    function detailUser($id){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("Auth/logout");
        }
		$data['username'] = $id;
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
        $data['mahasiswa'] = $this->M_User->getDataMahasiswaById($id);
        $data['main_view'] = 'User/V_detailUser';
        $this->load->view('Template/Template_operator', $data);
    }

    //
    public function lembaga(){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("Auth/logout");
        }
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
		$data['lembaga'] = $this->M_User->getDataLembaga()->result();
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['main_view'] = 'User/V_listLembaga';
		$this->load->view('Template/Template_operator', $data);
	}

	public function formTambahLembaga(){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("Auth/logout");
        }
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['main_view'] = 'User/V_tambahLembaga';
		$this->load->view('Template/Template_operator', $data);
	}

	public function tambahLembaga(){
		$nama_lembaga = $this->input->post('nama_lembaga');
		
			$data = array(
				'nama_lembaga' => $nama_lembaga
			);
			$this->M_User->tambahUser($data,'lembaga');
			$this->session->set_flashdata('sukses', "Data lembaga berhasil ditambahkan");
			redirect('index.php?/User/lembaga');
		
	}

	function hapusLembaga($id_lembaga){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("Auth/logout");
        }
		$where = array('id_lembaga' => $id_lembaga);
		$this->M_User->hapusUser($where,'lembaga');
		$this->session->set_flashdata('sukses', "Data lembaga berhasil dihapus");
		redirect('index.php?/User/lembaga');
	}

	function updateLembaga($id_lembaga){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("Auth/logout");
        }
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
		$data['main_view'] = 'User/V_editLembaga';
		$data['lembaga'] = $this->M_User->getDataLembagaById($id_lembaga);
		$this->load->view('Template/Template_operator',$data);
	}

	function editLembaga(){
		$id_lembaga = $this->input->post('id_lembaga');
		$nama_lembaga = $this->input->post('nama_lembaga');
			
		$data = array(
			'nama_lembaga' => $nama_lembaga
		);

		$where = array('id_lembaga' => $id_lembaga);

		$this->M_User->updateUser($where,$data,'lembaga');
		$this->session->set_flashdata('sukses', "Data lembaga berhasil diubah");
		redirect('index.php?/User/lembaga');
	}

}