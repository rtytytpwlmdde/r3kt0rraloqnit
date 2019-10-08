<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_Rekap');
		$this->load->model('M_SaranaPrasarana');
		$this->load->model('M_User');
		$this->load->model('m_peminjaman');
    }
    
    function dashboard(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$data['tahun'] = $tahun;
		$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
		$data['peminjamanKelasPerBulan'] = $this->M_Rekap->getDataRekapPeminjamanKelasPerBulan();
		$data['peminjamanKelasPertahun'] = $this->M_Rekap->getDataRekapPeminjamanKelasPerTahun();
		$data['peminjamanNonKelasPerBulan'] = $this->M_Rekap->getDataRekapPeminjamanNonKelasPerBulan();
		$data['peminjamanNonKelasPertahun'] = $this->M_Rekap->getDataRekapPeminjamanNonKelasPerTahun();
		$data['peminjamanBarangPerBulan'] = $this->M_Rekap->getDataRekapPeminjamanBarangPerBulan();
		$data['peminjamanBarangPertahun'] = $this->M_Rekap->getDataRekapPeminjamanBarangPerTahun();
		$data['peminjamanPerBulan'] = $this->M_Rekap->getDataRekapPeminjamanPerBulan();
		$data['peminjamanPertahun'] = $this->M_Rekap->getDataRekapPeminjamanPerTahun();
		
		$data['complaintPerBulan'] = $this->M_Rekap->getDataComplaintPerBulan();
		$data['complaintPertahun'] = $this->M_Rekap->getDataComplaintPertahun();
		$data['complaintTinjauPerBulan'] = $this->M_Rekap->getDataComplaintTinjauPerBulan();
		$data['complaintTinjauPertahun'] = $this->M_Rekap->getDataComplaintTinjauPertahun();
		$data['complaintTerkirimPerBulan'] = $this->M_Rekap->getDataComplaintTerkirimPerBulan();
		$data['complaintTerkirimPertahun'] = $this->M_Rekap->getDataComplaintTerkirimPertahun();

		$data['jumlahRuangan'] = $this->M_SaranaPrasarana->getJumlahRuangan();
		$data['jumlahBarang'] = $this->M_SaranaPrasarana->getJumlahBarang();
		$data['jumlahMahasiswa'] = $this->M_User->getJumlahMahasiswa();
		$data['jumlahDosen'] = $this->M_User->getJumlahDosen();
		$data['jumlahOperator'] = $this->M_User->getJumlahOperator();
		$data['jumlahLembaga'] = $this->M_User->getJumlahLembaga();
		$data['peminjamanSetujuPertahun'] = $this->M_Rekap->getDataRekapPeminjamanSetujuPertahun();
		$data['peminjamanGagalPertahun'] = $this->M_Rekap->getDataRekapPeminjamanGagalPertahun();
		$data['peminjamanPendingPertahun'] = $this->M_Rekap->getDataRekapPeminjamanPendingPertahun();
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['main_view'] = 'rekap/V_Dashboard';
		$this->load->view('template/template_operator',$data);
	}
		
	function rekapPeminjaman(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$data['tahun'] = $tahun;
		$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
		$data['peminjamanKelasPerBulan'] = $this->M_Rekap->getDataRekapPeminjamanKelasPerBulan();
		$data['peminjamanKelasPertahun'] = $this->M_Rekap->getDataRekapPeminjamanKelasPerTahun();
		$data['peminjamanNonKelasPerBulan'] = $this->M_Rekap->getDataRekapPeminjamanNonKelasPerBulan();
		$data['peminjamanNonKelasPertahun'] = $this->M_Rekap->getDataRekapPeminjamanNonKelasPerTahun();
		$data['peminjamanBarangPerBulan'] = $this->M_Rekap->getDataRekapPeminjamanBarangPerBulan();
		$data['peminjamanBarangPertahun'] = $this->M_Rekap->getDataRekapPeminjamanBarangPerTahun();
		$data['peminjamanPerBulan'] = $this->M_Rekap->getDataRekapPeminjamanPerBulan();
		$data['peminjamanPertahun'] = $this->M_Rekap->getDataRekapPeminjamanPerTahun();
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['main_view'] = 'Rekap/V_RekapPeminjaman';
		$this->load->view('template/template_operator',$data);
	}

	function rekapPemakaianRuangan(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$data['tahun'] = $tahun;
		$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
		$data['ruanganPerBulan'] = $this->M_Rekap->getDataRekapPemakaianRuanganPerBulan();
		$data['ruanganPerTahun'] = $this->M_Rekap->getDataRekapPemakaianRuanganPerTahun();
        $data['ruangan'] = $this->M_SaranaPrasarana->getDataRuangan()->result();
				$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['main_view'] = 'Rekap/V_RekapPemakaianRuangan';
		$this->load->view('template/template_operator',$data);
	}


}
