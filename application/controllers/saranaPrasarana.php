<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SaranaPrasarana extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_SaranaPrasarana');
		$this->load->model('M_JadwalKuliah');
		$this->load->model('m_peminjaman');
		$this->load->model('M_User');
	}

	public function index()
	{
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
		$data['main_view'] = 'SaranaPrasarana/V_Dashboard';
		$this->load->view('template/template_operator', $data);
	}

// ruangan
    public function ruangan(){
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
        $data['ruangan'] = $this->M_SaranaPrasarana->getDataRuangan()->result();
        $data['main_view'] = 'SaranaPrasarana/V_ListRuangan';
        $this->load->view('template/template_operator', $data);
    }

    public function formTambahRuangan(){
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
		$data['operator'] = $this->M_User->getDataOperator()->result();
        $data['main_view'] = 'SaranaPrasarana/V_TambahRuangan';
        $this->load->view('template/template_operator', $data);
    }

    public function tambahRuangan(){
		$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
        $nama_ruangan = $this->input->post('nama_ruangan');
        $jenis_ruangan = $this->input->post('jenis_ruangan');
        $id_operator = $this->input->post('id_operator');
		$data = array(
			'jenis_ruangan' => $jenis_ruangan,
			'nama_ruangan' => $nama_ruangan,
			'id_operator' => $id_operator
		);
		$this->M_SaranaPrasarana->tambahRuangan($data,'ruangan');
		$this->session->set_flashdata('notifsukses', "Data ruangan berhasil ditambahkan");
		redirect('SaranaPrasarana/ruangan');
    }

    function hapusRuangan($id_ruangan){
        $where = array('id_ruangan' => $id_ruangan);
        $this->M_SaranaPrasarana->hapusRuangan($where,'ruangan');
        $this->session->set_flashdata('notifsukses', "Data ruangan berhasil dihapus");
        redirect('SaranaPrasarana/ruangan');
    }

    function updateRuangan($id_ruangan){
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
        $data['main_view'] = 'SaranaPrasarana/v_EditRuangan';
		$data['operator'] = $this->M_User->getDataOperator()->result();
        $data['ruangan'] = $this->M_SaranaPrasarana->getDataRuanganById($id_ruangan);
        $this->load->view('template/template_operator',$data);
    }

    function editRuangan(){
        $id_ruangan = $this->input->post('id_ruangan');
        $nama_ruangan = $this->input->post('nama_ruangan');
        $jenis_ruangan = $this->input->post('jenis_ruangan');
        $id_operator = $this->input->post('id_operator');
            
        $data = array(
            'jenis_ruangan' => $jenis_ruangan,
            'nama_ruangan' => $nama_ruangan,
			'id_operator' => $id_operator
        );

        $where = array('id_ruangan' => $id_ruangan);

        $this->M_SaranaPrasarana->updateRuangan($where,$data,'ruangan');
        $this->session->set_flashdata('notifsukses', "Data ruangan berhasil diubah");
        redirect('SaranaPrasarana/ruangan');
    }
//akhir ruangan



function penggunaanRuangan(){
	$tanggal = $this->input->get('tanggal');
	if($tanggal == NULL){
		$tanggal = date("Y-m-d");
	}
	$level = $this->session->userdata('status');
	$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
	$data['peminjaman'] = $this->m_peminjaman->getSaranaPeminjaman('non kelas');
	$data['waktu'] = $this->m_peminjaman->getDataWaktu()->result();
	$data['ruangan'] = $this->M_SaranaPrasarana->getDataRuanganNonKelas();
	$data['tanggal'] = $tanggal;
	$data['jumlahUser'] = $this->M_User->getCountUserBaru();
	$data['main_view'] = 'SaranaPrasarana/v_penggunaanRuangan';
	if($level == 'admin'){
		$this->load->view('template/template_operator',$data);
	}else{
		$this->load->view('template/template_user',$data);
	}
}


//akhir barang
}