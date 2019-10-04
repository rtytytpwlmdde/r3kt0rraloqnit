<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SaranaPrasarana extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_SaranaPrasarana');
		$this->load->model('M_JadwalKuliah');
		$this->load->model('M_Peminjaman');
		$this->load->model('M_User');
	}

	public function index()
	{
		$data['main_view'] = 'SaranaPrasarana/V_Dashboard';
		$this->load->view('template/template_operator', $data);
	}

// ruangan
    public function ruangan(){
        $data['ruangan'] = $this->M_SaranaPrasarana->getDataRuangan()->result();
        $data['main_view'] = 'SaranaPrasarana/V_ListRuangan';
        $this->load->view('template/template_operator', $data);
    }

    public function formTambahRuangan(){
		$data['operator'] = $this->M_User->getDataOperator()->result();
        $data['main_view'] = 'SaranaPrasarana/V_TambahRuangan';
        $this->load->view('template/template_operator', $data);
    }

    public function tambahRuangan(){
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

// barang
public function barang(){
	$data['barang'] = $this->M_SaranaPrasarana->getDataBarang()->result();
	$data['main_view'] = 'SaranaPrasarana/V_ListBarang';
	$this->load->view('template/template_operator', $data);
}

public function formTambahBarang(){
	$data['main_view'] = 'SaranaPrasarana/V_TambahBarang';
	$this->load->view('template/template_operator', $data);
}

public function tambahBarang(){
	$nama_barang = $this->input->post('nama_barang');
	$status_barang = "bagus";
	$data = array(
		'status_barang' => $status_barang,
		'nama_barang' => $nama_barang
	);
	$this->M_SaranaPrasarana->tambahBarang($data,'barang');
	$this->session->set_flashdata('notifsukses', "Data barang $id_barang berhasil ditambahkan");
	redirect('SaranaPrasarana/barang');
}

function hapusBarang($id_barang){
	$where = array('id_barang' => $id_barang);
	$this->M_SaranaPrasarana->hapusBarang($where,'barang');
	$this->session->set_flashdata('notifsukses', "Data barang $id_barang berhasil dihapus");
	redirect('SaranaPrasarana/barang');
}

function updateBarang($id_barang){
	$data['main_view'] = 'SaranaPrasarana/v_EditBarang';
	$data['barang'] = $this->M_SaranaPrasarana->getDataBarangById($id_barang);
	$this->load->view('template/template_operator',$data);
}

function editBarang(){
	$id_barang = $this->input->post('id_barang');
	$nama_barang = $this->input->post('nama_barang');
	$status_barang = $this->input->post('status_barang');
		
	$data = array(
		'status_barang' => $status_barang,
		'nama_barang' => $nama_barang
	);

	$where = array('id_barang' => $id_barang);

	$this->M_SaranaPrasarana->updateBarang($where,$data,'barang');
	$this->session->set_flashdata('notifsukses', "Data barang $id_barang berhasil diubah");
	redirect('SaranaPrasarana/barang');
}

function petaPenggunaanRuanganKelas(){
	$tanggal = $this->input->get('tanggal');
	if($tanggal == NULL){
		$tanggal = date("Y-m-d");
	}
	$level = $this->session->userdata('status');
	$data['jadwalKuliah'] = $this->M_JadwalKuliah->getJadwalKuliah();
	$data['jam_kuliah'] = $this->M_JadwalKuliah->getDataJamKuliah()->result();
	$data['peminjaman'] = $this->M_Peminjaman->getPeminjaman();
	$data['ruangan'] = $this->M_SaranaPrasarana->getDataRuanganKelas()->result();
	$data['tanggal'] = $tanggal;
	$data['main_view'] = 'SaranaPrasarana/V_PetaPenggunaanRuanganKelas';
	if($level == 'admin'){
		$this->load->view('template/template_operator',$data);
	}else{
		$this->load->view('template/template_user',$data);
	}
}

function penggunaanRuangan(){
	$tanggal = $this->input->get('tanggal');
	if($tanggal == NULL){
		$tanggal = date("Y-m-d");
	}
	$level = $this->session->userdata('status');
	$data['peminjaman'] = $this->M_Peminjaman->getSaranaPeminjaman('non kelas');
	$data['waktu'] = $this->M_Peminjaman->getDataWaktu()->result();
	$data['ruangan'] = $this->M_SaranaPrasarana->getDataRuanganNonKelas();
	$data['tanggal'] = $tanggal;
	$data['main_view'] = 'SaranaPrasarana/v_penggunaanRuangan';
	if($level == 'admin'){
		$this->load->view('template/template_operator',$data);
	}else{
		$this->load->view('template/template_user',$data);
	}
}

function petaPenggunaanBarang(){
	$tanggal = $this->input->get('tanggal');
	if($tanggal == NULL){
		$tanggal = date("Y-m-d");
	}
	$level = $this->session->userdata('status');
	$data['peminjaman'] = $this->M_Peminjaman->getSaranaPeminjaman('barang');
	$data['barang'] = $this->M_SaranaPrasarana->getDataBarang()->result();
	$data['tanggal'] = $tanggal;
	$data['main_view'] = 'SaranaPrasarana/V_PetaPenggunaanBarang';
	if($level == 'admin'){
		$this->load->view('template/template_operator',$data);
	}else{
		$this->load->view('template/template_user',$data);
	}
}

//akhir barang
}