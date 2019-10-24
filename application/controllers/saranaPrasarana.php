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
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("auth/logout");
        }
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
        $jenis_ruangan = 'ruangan';
        $id_operator = $this->input->post('id_operator');
        $kapasitas = $this->input->post('kapasitas');
        $status_ruangan = 'bagus';
		$data = array(
			'jenis_ruangan' => $jenis_ruangan,
			'nama_ruangan' => $nama_ruangan,
			'status_ruangan' => $status_ruangan,
			'kapasitas' => $kapasitas,
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
        $status_ruangan = $this->input->post('status_ruangan');
        $id_operator = $this->input->post('id_operator');
        $kapasitas = $this->input->post('kapasitas');
            
        $data = array(
            'status_ruangan' => $status_ruangan,
            'nama_ruangan' => $nama_ruangan,
            'kapasitas' => $kapasitas,
			'id_operator' => $id_operator
        );

        $where = array('id_ruangan' => $id_ruangan);

        $this->M_SaranaPrasarana->updateRuangan($where,$data,'ruangan');
        $this->session->set_flashdata('notifsukses', "Data ruangan berhasil diubah");
        redirect('SaranaPrasarana/ruangan');
	}
	

//akhir ruangan

public function barang(){
	$data['jumlahUser'] = $this->M_User->getCountUserBaru();
	$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
	$data['barang'] = $this->M_SaranaPrasarana->getDataBarang();
	$data['main_view'] = 'SaranaPrasarana/V_ListBarang';
	$this->load->view('template/template_operator', $data);
}

public function formTambahBarang(){
	$data['jumlahUser'] = $this->M_User->getCountUserBaru();
	$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
	$data['operator'] = $this->M_User->getDataOperator()->result();
	$data['main_view'] = 'SaranaPrasarana/V_TambahBarang';
	$this->load->view('template/template_operator', $data);
}

public function tambahBarang(){
	$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
	$nama_barang = $this->input->post('nama_barang');
	$id_operator = $this->input->post('id_operator');
	$status_barang = 'bagus';
	$data = array(
		'nama_barang' => $nama_barang,
		'status_barang' => $status_barang,
		'id_operator' => $id_operator
	);
	$this->M_SaranaPrasarana->tambahRuangan($data,'barang');
	$this->session->set_flashdata('notifsukses', "Data barang berhasil ditambahkan");
	redirect('SaranaPrasarana/barang');
}

function hapusBarang($id_barang){
	$where = array('id_barang' => $id_barang);
	$this->M_SaranaPrasarana->hapusRuangan($where,'barang');
	$this->session->set_flashdata('notifsukses', "Data barang berhasil dihapus");
	redirect('SaranaPrasarana/barang');
}

function updateBarang($id_barang){
	$data['jumlahUser'] = $this->M_User->getCountUserBaru();
	$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
	$data['main_view'] = 'SaranaPrasarana/v_EditBarang';
	$data['operator'] = $this->M_User->getDataOperator()->result();
	$data['barang'] = $this->M_SaranaPrasarana->getDataBarangById($id_barang);
	$this->load->view('template/template_operator',$data);
}

function editBarang(){
	$id_barang = $this->input->post('id_barang');
	$nama_barang = $this->input->post('nama_barang');
	$status_barang = $this->input->post('status_barang');
	$id_operator = $this->input->post('id_operator');
	$kapasitas = $this->input->post('kapasitas');
		
	$data = array(
		'status_barang' => $status_barang,
		'nama_barang' => $nama_barang,
		'id_operator' => $id_operator
	);

	$where = array('id_barang' => $id_barang);

	$this->M_SaranaPrasarana->updateRuangan($where,$data,'barang');
	$this->session->set_flashdata('notifsukses', "Data barang berhasil diubah");
	redirect('SaranaPrasarana/barang');
}//



function penggunaanRuangan(){
	$tanggal = $this->input->get('tanggal');
	if($tanggal == NULL){
		$tanggal = date("Y-m-d");
	}
	$level = $this->session->userdata('status');
	$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
	$data['peminjaman'] = $this->m_peminjaman->getSaranaPeminjaman('ruangan');
	$data['waktu'] = $this->m_peminjaman->getDataWaktu()->result();
	$data['ruangan'] = $this->M_SaranaPrasarana->getDataRuanganNonKelas();
	$data['tanggal'] = $tanggal;
	$data['jumlahUser'] = $this->M_User->getCountUserBaru();
	$data['main_view'] = 'SaranaPrasarana/v_penggunaanRuangan';
	if($level == 'admin'){
		$this->load->view('template/template_operator',$data);
	}else if($level == 'staff pelayanan'){
		$this->load->view('template/template_operator',$data);
	}else{
		$this->load->view('template/template_user',$data);
	}
}

function penggunaanBarang(){
	$tanggal = $this->input->get('tanggal');
	if($tanggal == NULL){
		$tanggal = date("Y-m-d");
	}
	$level = $this->session->userdata('status');
	$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
	$data['peminjaman'] = $this->m_peminjaman->getSaranaPeminjaman('barang');
	$data['waktu'] = $this->m_peminjaman->getDataWaktu()->result();
	$data['barang'] = $this->M_SaranaPrasarana->getDataBarang();
	$data['tanggal'] = $tanggal;
	$data['jumlahUser'] = $this->M_User->getCountUserBaru();
	$data['main_view'] = 'SaranaPrasarana/v_penggunaanBarang';
	if($level == 'admin'){
		$this->load->view('template/template_operator',$data);
	}else if($level == 'staff pelayanan'){
		$this->load->view('template/template_operator',$data);
	}else{
		$this->load->view('template/template_user',$data);
	}
}


//akhir barang
}