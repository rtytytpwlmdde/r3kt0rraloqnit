<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_SaranaPrasarana');
		$this->load->model('M_JadwalKuliah');
		$this->load->model('M_Peminjaman');
		$this->load->model('M_User');
    }
    

    function historyPeminjaman(){
        if($this->session->userdata('status') == "pengguna"){
            $data['peminjaman'] = $this->M_Peminjaman->getDataPeminjamanByMahasiswa()->result();
        }else if($this->session->userdata('status') == "staff pelayanan"){
            $data['peminjaman'] = $this->M_Peminjaman->getDataPeminjaman("nonkelas")->result();
        }else {
            $data['peminjaman'] = $this->M_Peminjaman->getDataPeminjamanNonKelasBarang()->result();
        }
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
        $data['main_view'] = 'peminjaman/v_historyPeminjaman';
        if($this->session->userdata('status') == "pengguna" ){ 
            $this->load->view('template/template_user',$data);
        }else{
            $this->load->view('template/template_operator',$data);
        }
    }

    function detailPeminjaman($id_peminjaman,$jenis_peminjaman){
        $data['main_view'] = 'peminjaman/v_detailPeminjaman';
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
        $data['waktu'] = $this->M_Peminjaman->getDataWaktu()->result();
        $data['peminjaman'] = $this->M_Peminjaman->getDetailPeminjaman($id_peminjaman,$jenis_peminjaman);
        $data['sarana'] = $this->M_Peminjaman->getSaranaPeminjamanById($id_peminjaman,$jenis_peminjaman);
        if($this->session->userdata('status') == "pengguna" || $this->session->userdata('logged_in') == FALSE){ 
            $this->load->view('template/template_user',$data);
        }else{
            $this->load->view('template/template_operator',$data);
        }
    }

    function formTambahPeminjaman(){
        $data['main_view'] = 'peminjaman/v_tambahPeminjaman';
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
        $data['waktu'] = $this->M_Peminjaman->getDataWaktu()->result();
		$data['mahasiswa'] = $this->M_User->getDataDosen()->result();
        $data['lembaga'] = $this->M_User->getDataLembaga()->result();
        if($this->session->userdata('status') == "pengguna"){ 
            $this->load->view('template/template_user',$data);
        }else{
            $this->load->view('template/template_operator',$data);
        }
    }

    function tambahPeminjaman(){
        $jam_mulai = $this->input->post('jam_mulai');
        $jam_selesai = $this->input->post('jam_selesai');
        if($jam_mulai >= $jam_selesai){
            $this->session->set_flashdata('notifsukses', "Pastikan Jam Peminjaman Telah Sesuai");
            redirect('peminjaman/formTambahPeminjaman/');
        }else{
            $tanggal_mulai_penggunaan = $this->input->post('tanggal_mulai_penggunaan');
            $tanggal_selesai_penggunaan = $this->input->post('tanggal_mulai_penggunaan');
            $id_peminjam = $this->input->post('id_peminjam');
            $id_lembaga = $this->input->post('id_lembaga');
            $penyelenggara = $this->input->post('penyelenggara');
            $jenis_peminjaman = "non kelas";
            $validasi_akademik = 'pending';
            $validasi_kemahasiswaan = 'pending';
            $validasi_umum = 'pending';
            $keterangan = $this->input->post('keterangan');
            
            if($this->M_User->cekMahasiswa() == TRUE){
                $peminjaman = $this->M_Peminjaman->getIdMaxPeminjaman();
                $id = null;
                foreach ($peminjaman as $u){ echo $id=$u->id_peminjaman;}
                if($id != null){
                    $id_peminjaman = $id+1;
                }else{
                    $kode_tgl = str_replace("-","",$tanggal_mulai_penggunaan);
                    $id_peminjaman = "2".$kode_tgl."0001";
                }
                $data = array(
                    'id_peminjaman' => $id_peminjaman,
                    'jenis_peminjaman' => $jenis_peminjaman,
                    'id_peminjam' => $id_peminjam,
                    'tanggal_mulai_penggunaan' => $tanggal_mulai_penggunaan,
                    'tanggal_selesai_penggunaan' => $tanggal_selesai_penggunaan,
                    'jam_mulai' => $jam_mulai,
                    'id_lembaga' => $id_lembaga,
                    'jam_selesai' => $jam_selesai,
                    'penyelenggara' => $penyelenggara,
                    'validasi_akademik' => $validasi_akademik,
                    'validasi_kemahasiswaan' => $validasi_kemahasiswaan,
                    'validasi_umum' => $validasi_umum,
                    'keterangan' => $keterangan
                );
                $this->M_Peminjaman->tambahData($data,'peminjaman');
                $this->session->set_flashdata('notifsukses', "peminjaman non kelas berhasil ditambahkan");
                redirect('peminjaman/formTambahSaranaPeminjaman/nonkelas/'.$tanggal_mulai_penggunaan.'/'.$tanggal_selesai_penggunaan.'/'.$jam_mulai.'/'.$jam_selesai);
            }else{
                $this->session->set_flashdata('notif', "data user tidak ditemukan");
                redirect('peminjaman/formTambahPeminjaman/');
            }
        }
    }

    function formTambahSaranaPeminjaman($jenis, $tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai){
        $data['peminjaman'] = $this->M_Peminjaman->getDataPeminjamanNonKelasByDate($tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai);
        $data['sarana_tersedia'] = $this->M_Peminjaman->getRuanganTersedia($tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai);
        $data['sarana'] = $this->M_Peminjaman->getRuanganPeminjamanNonKelasByDate($tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai);
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
        $data['jenis_peminjaman'] = $jenis;
        $data['waktu'] = $this->M_Peminjaman->getDataWaktu()->result();
        $data['main_view'] = 'peminjaman/v_tambahSaranaPeminjaman'; 
        if($this->session->userdata('status') == "pengguna" ){ 
            $this->load->view('template/template_user',$data);
        }else{
            $this->load->view('template/template_operator',$data);
        }
    }

    function tambahSaranaPeminjaman(){
		$jenis = $this->input->post('jenis');
		$id_peminjaman = $this->input->post('id_peminjaman');
		$tgl_mulai = $this->input->post('tgl_mulai');
		$tgl_selesai = $this->input->post('tgl_selesai');
		$id_sarana = $this->input->post('id_sarana');
		$jam_mulai = $this->input->post('jam_mulai');
		$jam_selesai = $this->input->post('jam_selesai');
        $data = array(
            'id_peminjaman' => $id_peminjaman,
            'id_sarana' => $id_sarana
        );
        $peminjaman = 'sarana_peminjaman';
        $this->M_Peminjaman->tambahData($data,$peminjaman);
        $this->session->set_flashdata('notifsukses', "Data sarana peminjaman berhasil ditambahkan");
        redirect('peminjaman/formTambahSaranaPeminjaman/'.$jenis.'/'.$tgl_mulai.'/'.$tgl_selesai.'/'.$jam_mulai.'/'.$jam_selesai);
    }

    function hapusSaranaPeminjaman($jenis, $id_peminjaman, $id_sarana, $tgl_mulai, $tgl_selesai, $jam_mulai, $jam_selesai){
        
        $where = array('id_peminjaman' => $id_peminjaman,
                        'id_sarana' => $id_sarana);
        $this->M_Peminjaman->hapusData($where,'sarana_peminjaman');
        $this->session->set_flashdata('notifsukses', "Data sarana peminjaman berhasil dihapus");
        redirect('peminjaman/formTambahSaranaPeminjaman/'.$jenis.'/'.$tgl_mulai.'/'.$tgl_selesai.'/'.$jam_mulai.'/'.$jam_selesai);
    }

    function batalPeminjaman(){
        $id_peminjaman = $this->input->post('id_peminjaman');
        $catatan_penolakan = $this->input->post('catatan_penolakan');
        $status = 'batal';
        $id = array('id_peminjaman' => $id_peminjaman);
        $data = array(
            'catatan_penolakan' => $catatan_penolakan,
            'validasi_akademik' => $status
        );
        $this->M_Peminjaman->updateData($id,$data,'peminjaman');
        $this->session->set_flashdata('notifsukses', "Data peminjaman berhasil dibatalkan");
        redirect('peminjaman/historyPeminjaman/');
    }

    function kirimPeminjaman($jenis_peminjaman,$id_peminjaman,$operator){
        if($this->session->userdata('status') == $operator || $this->session->userdata('status') == 'admin'){
            $status = 'setuju';
        }else{
            $status = 'terkirim';
        }
        $data = array(
            'validasi_akademik' => $status,
            'validasi_umum' => $status,
            'validasi_kemahasiswaan' => $status
        );

        $id = array('id_peminjaman' => $id_peminjaman);

        $this->M_Peminjaman->updateData($id,$data,'peminjaman');
        $this->session->set_flashdata('notifsukses', "Peminjaman non kelas berhasil di ditambahkan");
        redirect('peminjaman/detailPeminjaman/'.$id_peminjaman.'/'.$jenis_peminjaman);
    }


    function validasiPeminjaman($id_peminjaman){
        $status = "setuju";
        $operator = $this->session->userdata('status');
        if($operator == 'admin' || $operator == 'staff pelayanan'){
            $data = array(
                'validasi_akademik' => $status,
                'validasi_kemahasiswaan' => $status,
                'validasi_umum' => $status
            );
        }else if($operator == 'kasubag akademik'){
            $data = array(
                'validasi_akademik' => $status
            );
        }else if($operator == 'kasubag kemahasiswaan'){
            $data = array(
                'validasi_kemahasiswaan' => $status
            );
        }else{
            $data = array(
                'validasi_umum' => $status
            );
        }
        $where = array('id_peminjaman' => $id_peminjaman);
        $this->M_Peminjaman->updateData($where,$data,'peminjaman');
        $this->session->set_flashdata('notifsukses', "Data peminjaman telah berhasil disetujui");
        redirect('peminjaman/historyPeminjaman');
    }

    function tolakPeminjaman(){
		$id_peminjaman = $this->input->post('id_peminjaman');
		$jenis = $this->input->post('jenis');
        $catatan_penolakan = $this->input->post('catatan_penolakan');
        $status = "tolak";
        $operator = $this->session->userdata('status');
        if($operator == 'admin' || $operator == 'staff pelayanan'){
            $data = array(
                'validasi_akademik' => $status,
                'validasi_kemahasiswaan' => $status,
                'validasi_umum' => $status,
                'catatan_penolakan' => $catatan_penolakan
            );
        }else if($operator == 'kasubag akademik'){
            $data = array(
                'validasi_akademik' => $status,
                'catatan_penolakan' => $catatan_penolakan
            );
        }else if($operator == 'kasubag kemahasiswaan'){
            $data = array(
                'validasi_kemahasiswaan' => $status,
                'catatan_penolakan' => $catatan_penolakan
            );
        }else{
            $data = array(
                'validasi_umum' => $status,
                'catatan_penolakan' => $catatan_penolakan
            );
        }
        $where = array('id_peminjaman' => $id_peminjaman);
        $this->M_Peminjaman->updateData($where,$data,'peminjaman');
        $this->session->set_flashdata('notifsukses', "Data peminjaman telah berhasil ditolak");
        redirect('peminjaman/historyPeminjaman');
    }

    function formCekPeminjaman(){
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
        $data['main_view'] = 'peminjaman/v_formCekPeminjaman';
        if($this->session->userdata('status') == "pengguna" ){ 
            $this->load->view('template/template_user',$data);
        }else if($this->session->userdata('status') == "admin"){
            $this->load->view('template/template_operator',$data);
        }else if($this->session->userdata('status') == "staff pelayanan"){
            $this->load->view('template/template_operator',$data);
        }else{
            $this->load->view('template/template_user',$data);
        }
    }

    // function cekPeminjaman(){
    //     $id_peminjaman = $this->input->get('id_peminjaman');
    //     $peminjaman = $this->M_Peminjaman->getJenisPeminjaman($id_peminjaman);
    //     $jenis_peminjaman = null;
    //     if($this->M_Peminjaman->getJenisPeminjaman($id_peminjaman) != false){
    //         foreach ($peminjaman as $u){ $jenis_peminjaman = $u->jenis_peminjaman; }
    //         $data['main_view'] = 'peminjaman/v_detailPeminjaman';
    //         $data['peminjaman'] = $this->M_Peminjaman->getDetailPeminjaman($id_peminjaman,$jenis_peminjaman);
    //         $data['sarana'] = $this->M_Peminjaman->getSaranaPeminjamanById($id_peminjaman,$jenis_peminjaman);
    //         $this->load->view('template/template_user',$data);
    //     }else{
    //         $this->session->set_flashdata('notif', "ID peminjaman tidak ditemukan");
    //         redirect('peminjaman/formCekPeminjaman');
    //     }
    // }

    function cekPeminjaman(){
        $id_peminjaman = $this->input->get('id_peminjaman');
        $peminjaman = $this->M_Peminjaman->cekIdPeminjaman($id_peminjaman);
        $jenis_peminjaman = null;
        if($this->M_Peminjaman->cekIdPeminjaman($id_peminjaman) != false){
            foreach ($peminjaman as $u){ $jenis_peminjaman = $u->jenis_peminjaman; }
            
        redirect('peminjaman/detailPeminjaman/'.$id_peminjaman.'/'.$u->jenis_peminjaman);
        }else{
            $this->session->set_flashdata('notif', "ID peminjaman tidak ditemukan");
            redirect('peminjaman/formCekPeminjaman');
        }
    }



}
