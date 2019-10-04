<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_User');
	}

// operator
	public function operator(){
		$data['operator'] = $this->M_User->getDataOperator()->result();
		$data['main_view'] = 'User/V_ListOperator';
		$this->load->view('template/template_operator', $data);
	}

	public function formTambahOperator(){
		$data['main_view'] = 'User/V_TambahOperator';
		$this->load->view('template/template_operator', $data);
	}

	public function tambahOperator(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		if($this->M_User->cek_id_operator() == TRUE){
			$this->session->set_flashdata('notif', "username $username sudah terdaftar didatabase");
			redirect('User/formTambahOperator');
		}else{
			$data = array(
				'username' => $username,
				'status_operator' => $status_operator,
				'password' => $password
			);
			$this->M_User->tambahUser($data,'operator');
			$this->session->set_flashdata('notifsukses', "Data operator berhasil ditambahkan");
			redirect('User/operator');
		}
	}

	function hapusOperator($username){
		$where = array('username' => $username);
		$this->M_User->hapusUser($where,'operator');
		$this->session->set_flashdata('notifsukses', "Data operator berhasil dihapus");
		redirect('User/operator');
	}

	function updateOperator($username){
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
        $data['dosen'] = $this->M_User->getDataDosen()->result();
        $data['main_view'] = 'User/V_ListDosen';
        $this->load->view('template/template_operator', $data);
    }

    public function formTambahDosen(){
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
        $where = array('id_dosen' => $id_dosen);
        $this->M_User->hapusUser($where,'dosen');
        $this->session->set_flashdata('notifsukses', "Data dosen berhasil dihapus");
        redirect('User/dosen');
    }

    function updateDosen($id_dosen){
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
    public function mahasiswa(){
        $data['mahasiswa'] = $this->M_User->getDataMahasiswa()->result();
        $data['main_view'] = 'User/V_ListMahasiswa';
        $this->load->view('template/template_operator', $data);
    }

    public function formTambahMahasiswa(){
        $data['main_view'] = 'User/V_TambahMahasiswa';
        $this->load->view('template/template_operator', $data);
    }

    public function tambahMahasiswa(){
        $id_mahasiswa = $this->input->post('id_mahasiswa');
        $nama_mahasiswa = $this->input->post('nama_mahasiswa');
        
        if($this->M_User->cek_id_mahasiswa() == TRUE){
            $this->session->set_flashdata('notif', "nik $id_mahasiswa sudah terdaftar didatabase");
            redirect('User/formTambahMahasiswa');
        }else{
            $data = array(
                'id_mahasiswa' => $id_mahasiswa,
                'nama_mahasiswa' => $nama_mahasiswa
            );
            $this->M_User->tambahUser($data,'mahasiswa');
            $this->session->set_flashdata('notifsukses', "Data mahasiswa berhasil ditambahkan");
            redirect('User/mahasiswa');
        }
    }

    function hapusMahasiswa($id_mahasiswa){
        $where = array('id_mahasiswa' => $id_mahasiswa);
        $this->M_User->hapusUser($where,'mahasiswa');
        $this->session->set_flashdata('notifsukses', "Data mahasiswa berhasil dihapus");
        redirect('User/mahasiswa');
    }

    function updateMahasiswa($id_mahasiswa){
        $data['main_view'] = 'User/V_EditMahasiswa';
        $data['mahasiswa'] = $this->M_User->getDataMahasiswaById($id_mahasiswa);
        $this->load->view('template/template_operator',$data);
    }

    function editMahasiswa(){
        $id_mahasiswa = $this->input->post('id_mahasiswa');
        $nama_mahasiswa = $this->input->post('nama_mahasiswa');
            
        $data = array(
            'id_mahasiswa' => $id_mahasiswa,
            'nama_mahasiswa' => $nama_mahasiswa
        );

        $where = array('id_mahasiswa' => $id_mahasiswa);

        $this->M_User->updateUser($where,$data,'mahasiswa');
        $this->session->set_flashdata('notifsukses', "Data mahasiswa berhasil diubah");
        redirect('User/mahasiswa');
    }
//akhir mahasiswa

public function lembaga(){
    $data['lembaga'] = $this->M_User->getDataLembaga()->result();
    $data['main_view'] = 'User/V_ListLembaga';
    $this->load->view('template/template_operator', $data);
}

public function formTambahLembaga(){
    $data['main_view'] = 'User/V_TambahLembaga';
    $this->load->view('template/template_operator', $data);
}

public function tambahLembaga(){
    $id_lembaga = $this->input->post('id_lembaga');
    $nama_lembaga = $this->input->post('nama_lembaga');
    $data = array(
        'id_lembaga' => $id_lembaga,
        'nama_lembaga' => $nama_lembaga
    );
    $this->M_User->tambahUser($data,'lembaga');
    $this->session->set_flashdata('notifsukses', "Data lembaga berhasil ditambahkan");
    redirect('User/lembaga');
}

function hapusLembaga($id_lembaga){
    $where = array('id_lembaga' => $id_lembaga);
    $this->M_User->hapusUser($where,'lembaga');
    $this->session->set_flashdata('notifsukses', "Data lembaga berhasil dihapus");
    redirect('User/lembaga');
}

function updateLembaga($id_lembaga){
    $data['main_view'] = 'User/V_EditLembaga';
    $data['lembaga'] = $this->M_User->getDataLembagaById($id_lembaga);
    $this->load->view('template/template_operator',$data);
}

function editLembaga(){
    $id_lembaga = $this->input->post('id_lembaga');
    $nama_lembaga = $this->input->post('nama_lembaga');
        
    $data = array(
        'id_lembaga' => $id_lembaga,
        'nama_lembaga' => $nama_lembaga
    );

    $where = array('id_lembaga' => $id_lembaga);

    $this->M_User->updateUser($where,$data,'lembaga');
    $this->session->set_flashdata('notifsukses', "Data lembaga berhasil diubah");
    redirect('User/lembaga');
}
}