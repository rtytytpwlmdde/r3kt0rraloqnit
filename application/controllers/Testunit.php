<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestUnit extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('unit_test');
		$this->load->model('M_JadwalKuliah');
		$this->load->model('M_Peminjaman');
		$this->load->model('M_User');
    }

    private function hasilPengujianTambahJadwalKuliah($id_semester, $id_dosen1, $id_dosen2, $id_jam_kuliah, $id_ruangan, $id_matakuliah, $hari, $id_program_studi, $kelas, $status_jadwal_kuliah){
        if($this->M_JadwalKuliah->cekJadwalKuliah() == TRUE){
            $actual_result = "jadwal kuliah gagal ditambahkan, jadwal ada yang bertabrakan";
            return $actual_result;
		}else{
			$data = array(
				'id_semester' => $id_semester,
				'id_dosen1' => $id_dosen1,
				'id_dosen2' => $id_dosen2,
				'id_jam_kuliah' => $id_jam_kuliah,
				'id_matakuliah' => $id_matakuliah,
				'id_ruangan' => $id_ruangan,
				'hari' => $hari,
				'id_program_studi' => $id_program_studi,
				'kelas' => $kelas,
				'status_jadwal_kuliah' => $status_jadwal_kuliah
			);
            $this->M_JadwalKuliah->tambahData($data,'jadwal_kuliah');
            $actual_result = "Data jadwal kuliah berhasil ditambahkan";
            return $actual_result;
		}
    }


	public function pengujianTambahJadwalKuliahJalur1()
	{
		$id_semester = '2';
		$id_dosen1 = '195108251979031004';
		$id_dosen2 = '195409251980031002';
		$id_jam_kuliah = '3';
		$id_ruangan = '13';
		$id_matakuliah = 'HKA4002';
		$hari = 'Senin';
		$id_program_studi = '2';
        $kelas = 'A';
		$status_jadwal_kuliah = 'aktif';
        
        $test = $this->hasilPengujianTambahJadwalKuliah($id_semester, $id_dosen1, $id_dosen2, $id_jam_kuliah, $id_ruangan, $id_matakuliah, $hari, $id_program_studi, $kelas, $status_jadwal_kuliah);
        $expected_result = "Data jadwal kuliah berhasil ditambahkan";
        $test_name = "Pengujian unit method tambahJadwalKuliah() Jalur 1";
        echo $this->unit->run($test,$expected_result,$test_name);
    }
    
    public function pengujianTambahJadwalKuliahJalur2()
	{
		$id_semester = '2';
		$id_dosen1 = '195108251979031004';
		$id_dosen2 = '195409251980031002';
		$id_jam_kuliah = '1';
		$id_ruangan = '1';
		$id_matakuliah = 'HKA4002';
		$hari = 'Senin';
		$id_program_studi = '2';
        $kelas = 'A';
		$status_jadwal_kuliah = 'aktif';
        
        $test = $this->hasilPengujianTambahJadwalKuliah($id_semester, $id_dosen1, $id_dosen2, $id_jam_kuliah, $id_ruangan, $id_matakuliah, $hari, $id_program_studi, $kelas, $status_jadwal_kuliah);
        $expected_result = "Data jadwal kuliah berhasil ditambahkan";
        $test_name = "jadwal kuliah gagal ditambahkan, jadwal ada yang bertabrakan";
        echo $this->unit->run($test,$expected_result,$test_name);
    }


    private function hasilPengujianCekPeminjaman($id_peminjaman){
        $peminjaman = $this->M_Peminjaman->getJenisPeminjaman($id_peminjaman);
        $jenis_peminjaman = null;
        if($this->M_Peminjaman->getJenisPeminjaman($id_peminjaman) != false){
            foreach ($peminjaman as $u){ $jenis_peminjaman = $u->jenis_peminjaman; }
            $data['peminjaman'] = $this->M_Peminjaman->getDetailPeminjaman($id_peminjaman,$jenis_peminjaman);
            $data['sarana'] = $this->M_Peminjaman->getSaranaPeminjamanById($id_peminjaman,$jenis_peminjaman);
            $actual_result = "menampilkan halaman detail peminjaman";
            return $actual_result;
        }else{
            $actual_result = "ID peminjaman tidak ditemukan";
            return $actual_result;
        }
    }
    
    public function pengujianCekPeminjamanJalur1()
	{
        $id_peminjaman = '1201906280006';
        $test = $this->hasilPengujianCekPeminjaman($id_peminjaman);
        $expected_result = "menampilkan halaman detail peminjaman";
        $test_name = "Pengujian unit method cekPeminjaman() Jalur 1";
        echo $this->unit->run($test,$expected_result,$test_name);
    }
    
    public function pengujianCekPeminjamanJalur2()
	{
        $id_peminjaman = '123';
        $test = $this->hasilPengujianCekPeminjaman($id_peminjaman);
        $expected_result = "ID peminjaman tidak ditemukan";
        $test_name = "Pengujian unit method cekPeminjaman() Jalur 1";
        echo $this->unit->run($test,$expected_result,$test_name);
    }

    ///////////////////////////

    private function hasilPengujianFromTambahPeminjamanKelas($tanggal, $id_ruangan, $id_jam_kuliah){
        $data['hari'] = date('l', strtotime($tanggal));
        $hari = date('l', strtotime($tanggal));
        if($this->M_Peminjaman->cekPenggunaanRuanganDiJadwalKuliah($hari, $id_ruangan, $id_jam_kuliah) == FALSE){
            if($this->M_Peminjaman->cekPenggunaanRuanganDiPeminjaman($tanggal, $id_ruangan, $id_jam_kuliah) == FALSE){
                $actual_result = "menampilkan halaman tambah peminjaman kelas";
                return $actual_result;
            }else{
                $actual_result = "Ruangan tidak dapat dipinjam karena dipinjam";
                return $actual_result;
            }
        }else{
            $actual_result = "Ruangan tidak dapat dipinjam ada jadwal kuliah";
            return $actual_result;
        }
    }

    public function hasilPengujianFromTambahPeminjamanKelasJalur1(){
        $tanggal = "2019-06-11";
        $id_ruangan = 2;
        $id_jam_kuliah = 4;
        $test = $this->hasilPengujianFromTambahPeminjamanKelas($tanggal,$id_ruangan,$id_jam_kuliah);
        $expected_result = "menampilkan halaman tambah peminjaman kelas";
        $test_name = "Pengujian unit method formTambahPeminjamanKelas() Jalur 1";
        echo $this->unit->run($test,$expected_result,$test_name);
    }

    public function hasilPengujianFromTambahPeminjamanKelasJalur2(){
        $tanggal = "2019-06-11";
        $id_ruangan = 1;
        $id_jam_kuliah = 4;
        $test = $this->hasilPengujianFromTambahPeminjamanKelas($tanggal,$id_ruangan,$id_jam_kuliah);
        $expected_result = "Ruangan tidak dapat dipinjam karena dipinjam";
        $test_name = "Pengujian unit method formTambahPeminjamanKelas() Jalur 2";
        echo $this->unit->run($test,$expected_result,$test_name);
    }

    public function hasilPengujianFromTambahPeminjamanKelasJalur3(){
        $tanggal = "2019-06-11";
        $id_ruangan = 1;
        $id_jam_kuliah = 3;
        $test = $this->hasilPengujianFromTambahPeminjamanKelas($tanggal,$id_ruangan,$id_jam_kuliah);
        $expected_result = "Ruangan tidak dapat dipinjam ada jadwal kuliah";
        $test_name = "Pengujian unit method formTambahPeminjamanKelas() Jalur 2";
        echo $this->unit->run($test,$expected_result,$test_name);
    }

}