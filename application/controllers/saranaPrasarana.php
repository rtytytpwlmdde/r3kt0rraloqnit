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



// ruangan
    public function ruangan(){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("auth/logout");
        }
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
        $data['ruangan'] = $this->M_SaranaPrasarana->getDataRuangan()->result();
        $data['main_view'] = 'SaranaPrasarana/V_ListRuangan';
        $this->load->view('template/template_operator', $data);
    }

    public function formTambahRuangan(){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("auth/logout");
        }
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
        $alamat_ruangan = $this->input->post('alamat_ruangan');
        $deskripsi_ruangan = $this->input->post('deskripsi_ruangan');
        $link_maps = $this->input->post('link_maps');
        $wifi = $this->input->post('wifi');
        $lcd = $this->input->post('lcd');
        $sound_system = $this->input->post('sound_system');
        $toilet = $this->input->post('toilet');
		$ac = $this->input->post('ac');
		$harga_ruangan = $this->input->post('harga_ruangan');

		
		$rapat = $this->input->post('rapat');
		$terbuka = $this->input->post('terbuka');
		$hall = $this->input->post('hall');
		$auditorium = $this->input->post('auditorium');
		$olahraga_tertutup = $this->input->post('olahraga_tertutup');
		$ruang_kuliah = $this->input->post('ruang_kuliah');

		
		$luas_ruangan = $this->input->post('luas_ruangan');
		$ruang_kelas = $this->input->post('ruang_kelas');
		$ruang_rapat = $this->input->post('ruang_rapat');
		$perjamuan = $this->input->post('perjamuan');
		$teater = $this->input->post('teater');
		$ushape = $this->input->post('ushape');
		
        $foto1 = $this->input->post('foto1');
        $foto2 = $this->input->post('foto2');
        $foto3 = $this->input->post('foto3');
        $foto4 = $this->input->post('foto4');
        $foto5 = $this->input->post('foto5');
		$status_ruangan = 'bagus';
		//
		$config['upload_path']          = './assets/ruangan/';
		$config['allowed_types']        = 'jpg|png';
		$config['max_size']             = 1000;
		$config['max_width']            = 2024;
		$config['max_height']           = 1768;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('foto1') && $foto1 != null){
			$this->session->set_flashdata('gagal', "Gambar 1 tidak sesuai persayaratan, periksa kembali gambar anda, max 1 mb, jpg/png");
			redirect('saranaPrasarana/formTambahRuangan');
		}else{                    	            	
			$file = $this->upload->data();
			$gambar1 = $file['file_name']; 
		}
		if ( ! $this->upload->do_upload('foto2') && $foto2 != null){
			$this->session->set_flashdata('gagal', "Gambar 2 tidak sesuai persayaratan, periksa kembali gambar anda, max 1 mb, jpg/png");
			redirect('saranaPrasarana/formTambahRuangan');
		}else{                    	            	
			$file = $this->upload->data();
			$gambar2 = $file['file_name']; 
		}
		if ( ! $this->upload->do_upload('foto3') && $foto3 != null){
			$this->session->set_flashdata('gagal', "Gambar 3 tidak sesuai persayaratan, periksa kembali gambar anda, max 1 mb, jpg/png");
			redirect('saranaPrasarana/formTambahRuangan');
		}else{                    	            	
			$file = $this->upload->data();
			$gambar3 = $file['file_name']; 
		}
		if ( ! $this->upload->do_upload('foto4') && $foto4 != null){
			$this->session->set_flashdata('gagal', "Gambar 4 tidak sesuai persayaratan, periksa kembali gambar anda, max 1 mb, jpg/png");
			redirect('saranaPrasarana/formTambahRuangan');
		}else{                    	            	
			$file = $this->upload->data();
			$gambar4 = $file['file_name']; 
		}
		if ( ! $this->upload->do_upload('foto5') && $foto5 != null){
			$this->session->set_flashdata('gagal', "Gambar 5 tidak sesuai persayaratan, periksa kembali gambar anda, max 1 mb, jpg/png");
			redirect('saranaPrasarana/formTambahRuangan');
		}else{                    	            	
			$file = $this->upload->data();
			$gambar5 = $file['file_name']; 
		}
		//
		$data = array(
			'jenis_ruangan' => $jenis_ruangan,
			'nama_ruangan' => $nama_ruangan,
			'status_ruangan' => $status_ruangan,
			'kapasitas' => $kapasitas,
			'alamat_ruangan' => $alamat_ruangan,
			'link_maps' => $link_maps,
			'deskripsi_ruangan' => $deskripsi_ruangan,
			'luas_ruangan' => $luas_ruangan,
			'ruang_kelas' => $ruang_kelas,
			'ruang_rapat' => $ruang_rapat,
			'harga_ruangan' => $harga_ruangan,
			'perjamuan' => $perjamuan,
			'teater' => $teater,
			'ushape' => $ushape,
			'foto_ruangan1' => $gambar1,
			'foto_ruangan2' => $gambar2,
			'foto_ruangan3' => $gambar3,
			'foto_ruangan4' => $gambar4,
			'foto_ruangan5' => $gambar5,
			'rapat' => $rapat,
			'terbuka' => $terbuka,
			'hall' => $hall,
			'auditorium' => $auditorium,
			'olahraga_tertutup' => $olahraga_tertutup,
			'ruang_kuliah' => $ruang_kuliah,
			'ac' => $ac,
			'wifi' => $wifi,
			'lcd' => $lcd,
			'sound_system' => $sound_system,
			'toilet' => $toilet,
			'id_operator' => $id_operator
		);
		$this->M_SaranaPrasarana->tambahRuangan($data,'ruangan');
		$this->session->set_flashdata('notifsukses', "Data ruangan berhasil ditambahkan");
		redirect('SaranaPrasarana/ruangan');
    }

    function hapusRuangan($id_ruangan){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("auth/logout");
        }
        $where = array('id_ruangan' => $id_ruangan);
        $this->M_SaranaPrasarana->hapusRuangan($where,'ruangan');
        $this->session->set_flashdata('notifsukses', "Data ruangan berhasil dihapus");
        redirect('SaranaPrasarana/ruangan');
    }

    function updateRuangan($id_ruangan){
        if($this->session->userdata('logged_in') != 'admin' ){
            redirect("auth/logout");
        }
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
		$alamat_ruangan = $this->input->post('alamat_ruangan');
        $deskripsi_ruangan = $this->input->post('deskripsi_ruangan');
        $link_maps = $this->input->post('link_maps');
        $luas_ruangan = $this->input->post('luas_ruangan');
        $ruang_kelas = $this->input->post('ruang_kelas');
        $ruang_rapat = $this->input->post('ruang_rapat');
        $perjamuan = $this->input->post('perjamuan');
        $teater = $this->input->post('teater');
        $ushape = $this->input->post('ushape');
        $wifi = $this->input->post('wifi');
        $ac = $this->input->post('ac');
        $toilet = $this->input->post('toilet');
        $lcd = $this->input->post('lcd');
		$sound_system = $this->input->post('sound_system');
		
		$rapat = $this->input->post('rapat');
		$terbuka = $this->input->post('terbuka');
		$hall = $this->input->post('hall');
		$auditorium = $this->input->post('auditorium');
		$olahraga_tertutup = $this->input->post('olahraga_tertutup');
		$ruang_kuliah = $this->input->post('ruang_kuliah');
		
        $foto1 = $this->input->post('foto1');
        $foto2 = $this->input->post('foto2');
        $foto3 = $this->input->post('foto3');
        $foto4 = $this->input->post('foto4');
        $foto5 = $this->input->post('foto5');
		//
		$config['upload_path']          = './assets/ruangan/';
		$config['allowed_types']        = 'jpg|png';
		$config['max_size']             = 1000;
		$config['max_width']            = 2024;
		$config['max_height']           = 1768;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('foto1') && $foto1 != null){
			$this->session->set_flashdata('gagal', "Gambar 1 tidak sesuai persayaratan, periksa kembali gambar anda, max 1 mb, jpg/png");
			redirect('saranaPrasarana/formTambahRuangan');
		}else{                    	            	
			$file = $this->upload->data();
			$gambar1 = $file['file_name']; 
		}
		if ( ! $this->upload->do_upload('foto2') && $foto2 != null){
			$this->session->set_flashdata('gagal', "Gambar 2 tidak sesuai persayaratan, periksa kembali gambar anda, max 1 mb, jpg/png");
			redirect('saranaPrasarana/formTambahRuangan');
		}else{                    	            	
			$file = $this->upload->data();
			$gambar2 = $file['file_name']; 
		}
		if ( ! $this->upload->do_upload('foto3') && $foto3 != null){
			$this->session->set_flashdata('gagal', "Gambar 3 tidak sesuai persayaratan, periksa kembali gambar anda, max 1 mb, jpg/png");
			redirect('saranaPrasarana/formTambahRuangan');
		}else{                    	            	
			$file = $this->upload->data();
			$gambar3 = $file['file_name']; 
		}
		if ( ! $this->upload->do_upload('foto4') && $foto4 != null){
			$this->session->set_flashdata('gagal', "Gambar 4 tidak sesuai persayaratan, periksa kembali gambar anda, max 1 mb, jpg/png");
			redirect('saranaPrasarana/formTambahRuangan');
		}else{                    	            	
			$file = $this->upload->data();
			$gambar4 = $file['file_name']; 
		}
		if ( ! $this->upload->do_upload('foto5') && $foto5 != null){
			$this->session->set_flashdata('gagal', "Gambar 5 tidak sesuai persayaratan, periksa kembali gambar anda, max 1 mb, jpg/png");
			redirect('saranaPrasarana/formTambahRuangan');
		}else{                    	            	
			$file = $this->upload->data();
			$gambar5 = $file['file_name']; 
		}
		if($gambar1 == null){
			$gambar1 =  $this->input->post('foto_ruangan1');
		}
		if($gambar2 == null){
			$gambar2 =  $this->input->post('foto_ruangan2');
		}
		if($gambar3 == null){
			$gambar3 =  $this->input->post('foto_ruangan3');
		}
		if($gambar4 == null){
			$gambar4 =  $this->input->post('foto_ruangan4');
		}
		if($gambar5 == null){
			$gambar5 =  $this->input->post('foto_ruangan5');
		}
        $data = array(
            'status_ruangan' => $status_ruangan,
            'nama_ruangan' => $nama_ruangan,
            'kapasitas' => $kapasitas,
            'deskripsi_ruangan' => $deskripsi_ruangan,
            'luas_ruangan' => $luas_ruangan,
            'ruang_kelas' => $ruang_kelas,
            'ruang_rapat' => $ruang_rapat,
            'perjamuan' => $perjamuan,
            'teater' => $teater,
            'ushape' => $ushape,
            'foto_ruangan1' => $gambar1,
            'foto_ruangan2' => $gambar2,
            'foto_ruangan3' => $gambar3,
            'foto_ruangan4' => $gambar4,
            'foto_ruangan5' => $gambar5,
			'rapat' => $rapat,
			'terbuka' => $terbuka,
			'hall' => $hall,
			'auditorium' => $auditorium,
			'olahraga_tertutup' => $olahraga_tertutup,
			'ruang_kuliah' => $ruang_kuliah,
			'ac' => $ac,
			'wifi' => $wifi,
			'lcd' => $lcd,
			'sound_system' => $sound_system,
			'toilet' => $toilet,
			'id_operator' => $id_operator
        );

        $where = array('id_ruangan' => $id_ruangan);

        $this->M_SaranaPrasarana->updateRuangan($where,$data,'ruangan');
        $this->session->set_flashdata('notifsukses', "Data ruangan berhasil diubah");
        redirect('SaranaPrasarana/ruangan');
	}
	

//akhir ruangan

public function barang(){
	if($this->session->userdata('logged_in') != 'admin' ){
		redirect("auth/logout");
	}
	$data['jumlahUser'] = $this->M_User->getCountUserBaru();
	$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
	$data['barang'] = $this->M_SaranaPrasarana->getDataBarang();
	$data['main_view'] = 'SaranaPrasarana/V_ListBarang';
	$this->load->view('template/template_operator', $data);
}

public function formTambahBarang(){
	if($this->session->userdata('logged_in') != 'admin' ){
		redirect("auth/logout");
	}
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
	$deskripsi_barang = $this->input->post('deskripsi_barang');

	
	$kapasitas_barang = $this->input->post('kapasitas_barang');
	$jenis_barang = $this->input->post('jenis_barang');
	$usia_barang = $this->input->post('usia_barang');
	$harga_barang = $this->input->post('harga_barang');
	$status_barang = 'bagus';
	$foto1 = $this->input->post('foto1');
	$foto2 = $this->input->post('foto2');
	$foto3 = $this->input->post('foto3');
	$foto4 = $this->input->post('foto4');
	$foto5 = $this->input->post('foto5');
	//
	$config['upload_path']          = './assets/barang/';
	$config['allowed_types']        = 'jpg|png';
	$config['max_size']             = 1000;
	$config['max_width']            = 2024;
	$config['max_height']           = 1768;

	$this->load->library('upload', $config);

	if ( ! $this->upload->do_upload('foto1') && $foto1 != null){
		$this->session->set_flashdata('gagal', "Gambar 1 tidak sesuai persayaratan, periksa kembali gambar anda, max 1 mb, jpg/png");
		redirect('saranaPrasarana/formTambahBarang');
	}else{                    	            	
		$file = $this->upload->data();
		$foto_barang1 = $file['file_name']; 
	}
	if ( ! $this->upload->do_upload('foto2') && $foto2 != null){
		$this->session->set_flashdata('gagal', "Gambar 2 tidak sesuai persayaratan, periksa kembali gambar anda, max 1 mb, jpg/png");
		redirect('saranaPrasarana/formTambahBarang');
	}else{                    	            	
		$file = $this->upload->data();
		$foto_barang2 = $file['file_name']; 
	}
	if ( ! $this->upload->do_upload('foto3') && $foto3 != null){
		$this->session->set_flashdata('gagal', "Gambar 3 tidak sesuai persayaratan, periksa kembali gambar anda, max 1 mb, jpg/png");
		redirect('saranaPrasarana/formTambahBarang');
	}else{                    	            	
		$file = $this->upload->data();
		$foto_barang3 = $file['file_name']; 
	}
	if ( ! $this->upload->do_upload('foto4') && $foto4 != null){
		$this->session->set_flashdata('gagal', "Gambar 4 tidak sesuai persayaratan, periksa kembali gambar anda, max 1 mb, jpg/png");
		redirect('saranaPrasarana/formTambahBarang');
	}else{                    	            	
		$file = $this->upload->data();
		$foto_barang4 = $file['file_name']; 
	}
	if ( ! $this->upload->do_upload('foto5') && $foto5 != null){
		$this->session->set_flashdata('gagal', "Gambar 5 tidak sesuai persayaratan, periksa kembali gambar anda, max 1 mb, jpg/png");
		redirect('saranaPrasarana/formTambahBarang');
	}else{                    	            	
		$file = $this->upload->data();
		$foto_barang5 = $file['file_name']; 
	}
	$data = array(
		'nama_barang' => $nama_barang,
		'status_barang' => $status_barang,
		'foto_barang1' => $foto_barang1,
		'foto_barang2' => $foto_barang2,
		'foto_barang3' => $foto_barang3,
		'foto_barang4' => $foto_barang4,
		'foto_barang5' => $foto_barang5,
		'kapasitas_barang' => $kapasitas_barang,
		'usia_barang' => $usia_barang,
		'harga_barang' => $harga_barang,
		'jenis_barang' => $jenis_barang,
		'id_operator' => $id_operator
	);
	$this->M_SaranaPrasarana->tambahRuangan($data,'barang');
	$this->session->set_flashdata('notifsukses', "Data barang berhasil ditambahkan");
	redirect('SaranaPrasarana/barang');
}

function hapusBarang($id_barang){
	if($this->session->userdata('logged_in') != 'admin' ){
		redirect("auth/logout");
	}
	$where = array('id_barang' => $id_barang);
	$this->M_SaranaPrasarana->hapusRuangan($where,'barang');
	$this->session->set_flashdata('notifsukses', "Data barang berhasil dihapus");
	redirect('SaranaPrasarana/barang');
}

function updateBarang($id_barang){
	if($this->session->userdata('logged_in') != 'admin' ){
		redirect("auth/logout");
	}
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
	$data['barang'] = $this->M_SaranaPrasarana->getDataSemuaBarang();
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

function detailRuangan($id_ruangan){
	$jenis = 'ruangan';
	$data['jumlahUser'] = $this->M_User->getCountUserBaru();
	$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
	$data['ruangan'] = $this->M_SaranaPrasarana->getDataRuanganById($id_ruangan);
	$data['waktu'] = $this->m_peminjaman->getDataWaktu()->result();
	$data['penggunaanRuangan'] = $this->m_peminjaman->getPenggunaanRuanganByRuangan($jenis,$id_ruangan);
	$level = $this->session->userdata('status');
	$data['main_view'] = 'SaranaPrasarana/v_detailRuangan';
	if($level == 'admin'){
		$this->load->view('template/template_operator',$data);
	}else if($level == 'staff pelayanan'){
		$this->load->view('template/template_operator',$data);
	}else{
		$this->load->view('template/template_user',$data);
	}
}


function detailBarang($id_barang){
	$jenis = 'barang';
	$data['jumlahUser'] = $this->M_User->getCountUserBaru();
	$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
	$data['penggunaanBarang'] = $this->m_peminjaman->getPenggunaanBarangByBarang($jenis,$id_barang);
	$data['barang'] = $this->M_SaranaPrasarana->getDataBarangById($id_barang);
	$level = $this->session->userdata('status');
	$data['main_view'] = 'SaranaPrasarana/v_detailBarang';
	if($level == 'admin'){
		$this->load->view('template/template_operator',$data);
	}else if($level == 'staff pelayanan'){
		$this->load->view('template/template_operator',$data);
	}else{
		$this->load->view('template/template_user',$data);
	}
}

function saranaPrasarana(){
	$jenis = $this->input->get('jenis');
	$data['tglMulai'] = $this->input->get('tglMulai');
	$data['tglSelesai'] = $this->input->get('tglSelesai');
	$data['jamMulai'] = $this->input->get('jamMulai');
	$data['jamSelesai'] = $this->input->get('jamSelesai');
	$data['jenis'] = $jenis;
	$data['jumlahUser'] = $this->M_User->getCountUserBaru();
	$data['operator'] = $this->M_User->getDataOperator()->result();
	$data['waktu'] = $this->m_peminjaman->getDataWaktu()->result();
	$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
	if($jenis == 'ruangan' || $jenis == null){
		//
		$this->load->database();
		$jumlahRuangan = $this->M_SaranaPrasarana->jumlahDataSaranaRuangan();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'/saranaPrasarana/saranaPrasarana/';
		$config['total_rows'] = $jumlahRuangan;
		$config['per_page'] = 10;
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-left"><nav><ul class="pagination justify-content-right">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);	
		//
        $data['sarana'] = $this->M_SaranaPrasarana->getDataSaranaRuangan($config['per_page'],$from);
		$data['main_view'] = 'SaranaPrasarana/v_saranaPrasarana';
	}else{
		//
		$this->load->database();
		$jumlahBarang = $this->M_SaranaPrasarana->jumlahDataSaranaBarang();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'/saranaPrasarana/saranaPrasarana/';
		$config['total_rows'] = $jumlahBarang;
		$config['per_page'] = 10;
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-left"><nav><ul class="pagination justify-content-right">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);	
		//
        $data['sarana'] = $this->M_SaranaPrasarana->getDataSaranaBarang($config['per_page'],$from);
		$data['main_view'] = 'SaranaPrasarana/v_saranaBarang';
	}
	$level = $this->session->userdata('status');
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