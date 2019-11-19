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
        $peminjaman = $this->M_Peminjaman->getDataPeminjamanPending();
        foreach ($peminjaman as $u){
            $id = $u->id_peminjaman;
            $where = array('id_peminjaman' => $id);
            $this->M_User->hapusUser($where,'peminjaman');
        }
        if($this->session->userdata('logged_in') == FALSE){
            redirect("auth/logout");
        }
		$this->load->database();
        $jumlah_data = $this->M_Peminjaman->jumlahDataPeminjaman();
        $this->load->library('pagination');
		$config['base_url'] = base_url().'/peminjaman/historyPeminjaman/';
		$config['total_rows'] = $jumlah_data;
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
        $data['peminjaman'] = $this->M_Peminjaman->getDataPeminjaman($config['per_page'],$from);
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
        if($this->session->userdata('logged_in') == FALSE){
            redirect("auth/logout");
        }
        $data['main_view'] = 'peminjaman/v_detailPeminjaman';
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
        $data['id_peminjaman'] = $id_peminjaman;
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
        $data['waktu'] = $this->M_Peminjaman->getDataWaktu()->result();
        $data['peminjaman'] = $this->M_Peminjaman->getDetailPeminjaman($id_peminjaman);
        $data['tagihan'] = $this->M_Peminjaman->getDataTagihanByIdPeminjaman($id_peminjaman);
        $data['sarana'] = $this->M_Peminjaman->getSaranaPeminjamanById($id_peminjaman,$jenis_peminjaman);
        if($this->session->userdata('status') == "pengguna" || $this->session->userdata('logged_in') == FALSE){ 
            $this->load->view('template/template_user',$data);
        }else{
            $this->load->view('template/template_operator',$data);
        }
    }

    function pilihPeminjaman(){
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
        $data['main_view'] = 'peminjaman/v_pilihJenisPeminjaman';
        if($this->session->userdata('status') == "pengguna"){ 
            $this->load->view('template/template_user',$data);
        }else{
            $this->load->view('template/template_operator',$data);
        }
    }

    function formTambahPeminjaman($jenis_peminjaman){
        $id = null;
        $peminjaman = $this->M_Peminjaman->getDataPeminjamanPending();
        foreach ($peminjaman as $u){
            $id = $u->id_peminjaman;
            $where = array('id_peminjaman' => $id);
            $this->M_User->hapusUser($where,'peminjaman');
        }
    
        $data['jenis_peminjaman'] = $jenis_peminjaman;
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
        $jenis_peminjaman = $this->input->post('jenis_peminjaman');
        $tanggal_mulai_penggunaan = $this->input->post('tanggal_mulai_penggunaan');
        $tanggal_selesai_penggunaan = $this->input->post('tanggal_selesai_penggunaan');
        $jam_mulai = $this->input->post('jam_mulai');
        $jam_selesai = $this->input->post('jam_selesai');
        $file_peminjaman = $this->input->post('file_peminjaman');
        if($jam_mulai >= $jam_selesai || $tanggal_mulai_penggunaan >= $tanggal_selesai_penggunaan){
            $this->session->set_flashdata('notifsukses', "Pastikan Jam / Tanggal Peminjaman Telah Sesuai");
            redirect('peminjaman/formTambahPeminjaman/'.$jenis_peminjaman);
        }else{
            $config['upload_path']          = './assets/peminjaman/';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 1000;
            $config['max_width']            = 2024;
            $config['max_height']           = 1768;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('file_peminjaman')){
                $this->session->set_flashdata('gagal', "File tidak sesuai persayaratan, periksa kembali file anda, max 1 mb, pdf");
                redirect('peminjaman/formTambahPeminjaman/'.$jenis_peminjaman);
            }else{                    	            	
                $file = $this->upload->data();
                $pdf = $file['file_name']; 
            }
            $id_peminjam = $this->input->post('id_peminjam');
            $id_lembaga = $this->input->post('id_lembaga');
            $penyelenggara = $this->input->post('penyelenggara');
            $jenis_peminjaman = $this->input->post('jenis_peminjaman');
            $validasi_akademik = 'pending';
            $validasi_kemahasiswaan = 'pending';
            $validasi_umum = 'pending';
            $status_kembali = 'belum';
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
                if($jenis_peminjaman == 'barang'){
                    $data = array(
                        'id_peminjaman' => $id_peminjaman,
                        'jenis_peminjaman' => $jenis_peminjaman,
                        'id_peminjam' => $id_peminjam,
                        'status_kembali' => $status_kembali,
                        'tanggal_mulai_penggunaan' => $tanggal_mulai_penggunaan,
                        'tanggal_selesai_penggunaan' => $tanggal_selesai_penggunaan,
                        'jam_mulai' => $jam_mulai,
                        'id_lembaga' => $id_lembaga,
                        'jam_selesai' => $jam_selesai,
                        'penyelenggara' => $penyelenggara,
                        'file_peminjaman' => $pdf,
                        'validasi_akademik' => $validasi_akademik,
                        'validasi_kemahasiswaan' => $validasi_kemahasiswaan,
                        'validasi_umum' => $validasi_umum,
                        'keterangan' => $keterangan
                    );
                   
                }else {
                    $data = array(
                        'id_peminjaman' => $id_peminjaman,
                        'jenis_peminjaman' => $jenis_peminjaman,
                        'id_peminjam' => $id_peminjam,
                        'tanggal_mulai_penggunaan' => $tanggal_mulai_penggunaan,
                        'tanggal_selesai_penggunaan' => $tanggal_selesai_penggunaan,
                        'jam_mulai' => $jam_mulai,
                        'id_lembaga' => $id_lembaga,
                        'jam_selesai' => $jam_selesai,
                        'file_peminjaman' => $pdf,
                        'penyelenggara' => $penyelenggara,
                        'validasi_akademik' => $validasi_akademik,
                        'validasi_kemahasiswaan' => $validasi_kemahasiswaan,
                        'validasi_umum' => $validasi_umum,
                        'keterangan' => $keterangan
                    );
                }
                $this->M_Peminjaman->tambahData($data,'peminjaman');
                $this->session->set_flashdata('notifsukses', "peminjaman berhasil ditambahkan");                
                redirect('peminjaman/formTambahSaranaPeminjaman/'.$jenis_peminjaman.'/'.$tanggal_mulai_penggunaan.'/'.$tanggal_selesai_penggunaan.'/'.$jam_mulai.'/'.$jam_selesai);
            }else{
                $this->session->set_flashdata('notif', "data user tidak ditemukan");
                redirect('peminjaman/formTambahPeminjaman/'.$jenis_peminjaman);
            }
        }
    }

    function formTambahSaranaPeminjaman($jenis, $tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai){
        if($this->session->userdata('logged_in') == FALSE){
            redirect("auth/logout");
        }
        $data['peminjaman'] = $this->M_Peminjaman->getDataPeminjamanNonKelasByDate($tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai);
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
        $data['jenis_peminjaman'] = $jenis;
        $data['waktu'] = $this->M_Peminjaman->getDataWaktu()->result();
        if($jenis == "ruangan" ){ 
            $data['main_view'] = 'peminjaman/v_tambahSaranaPeminjaman'; 
            $data['sarana'] = $this->M_Peminjaman->getRuanganPeminjamanNonKelasByDate($tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai);
            $data['sarana_tersedia'] = $this->M_Peminjaman->getRuanganTersedia($tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai);
        }else{
            $data['main_view'] = 'peminjaman/v_tambahSaranaPeminjamanBarang'; 
            $data['sarana'] = $this->M_Peminjaman->getBarangPeminjamanBarangByDate($tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai);
            $data['sarana_tersedia'] = $this->M_Peminjaman->getBarangTersedia($tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai);
        }
        if($this->session->userdata('status') == "pengguna" ){ 
            $this->load->view('template/template_user',$data);
        }else{
            $this->load->view('template/template_operator',$data);
        }
    }

    function formTambahTagihanPeminjaman($id_peminjaman){
        if($this->session->userdata('logged_in') == FALSE){
            redirect("auth/logout");
        }
        $data['peminjaman'] = $this->M_Peminjaman->getDataPeminjamanByIdTagihan($id_peminjaman);
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
        $data['tagihan'] = $this->M_Peminjaman->getDataTagihanByIdPeminjaman($id_peminjaman);
        $data['harga_sewa'] = $this->M_Peminjaman->getDataHargaSewaPeminjaman($id_peminjaman);
      
        $data['waktu'] = $this->M_Peminjaman->getDataWaktu()->result();
        $data['main_view'] = 'peminjaman/v_tambahTagihan'; 
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
        if($this->session->userdata('logged_in') == FALSE){
            redirect("auth/logout");
        }
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

    function tambahTagihan(){
        $id_peminjaman = $this->input->post('id_peminjaman');
        $nama_tagihan = $this->input->post('nama_tagihan');
        $jumlah = $this->input->post('jumlah');
        $harga_satuan = $this->input->post('harga_satuan');
        $total_tagihan = $jumlah*$harga_satuan;
        $data = array(
            'id_peminjaman' => $id_peminjaman,
            'nama_tagihan' => $nama_tagihan,
            'jumlah' => $jumlah,
            'harga_satuan' => $harga_satuan,
            'total_tagihan' => $total_tagihan
        );
        $this->M_Peminjaman->tambahData($data,'tagihan');
        redirect('peminjaman/formTambahTagihanPeminjaman/'.$id_peminjaman);
    }

    function kirimPeminjaman(){
        $id_peminjaman = $this->input->post('id_peminjaman');
        $jenis_peminjaman = $this->input->post('jenis');
        $total_pembayaran = $this->input->post('total_pembayaran');
        $status_pembayaran = 'belum bayar';
        if($this->session->userdata('logged_in') == FALSE){
            redirect("auth/logout");
        }
        
            $status = 'terkirim';
            $nama_kode = base_url().'peminjaman/detailPeminjaman/'.$id_peminjaman.'/'.$jenis_peminjaman;
            $this->load->library('ciqrcode'); //pemanggilan library QR CODE

            $config['cacheable']	= true; //boolean, the default is true
            $config['cachedir']		= './assets/'; //string, the default is application/cache/
            $config['errorlog']		= './assets/'; //string, the default is application/logs/
            $config['imagedir']		= './assets/images/'; //direktori penyimpanan qr code
            $config['quality']		= true; //boolean, the default is true
            $config['size']			= '1024'; //interger, the default is 1024
            $config['black']		= array(224,255,255); // array, default is array(255,255,255)
            $config['white']		= array(70,130,180); // array, default is array(0,0,0)
            $this->ciqrcode->initialize($config);

            $image_name=$id_peminjaman.'.png'; //buat name dari qr code sesuai dengan nim

            $params['data'] = $nama_kode; //data yang akan di jadikan QR CODE
            $params['level'] = 'H'; //H=High
            $params['size'] = 10;
            $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
            $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        
        $data = array(
            'qr_code' => $image_name,
            'total_pembayaran' => $total_pembayaran,
            'status_pembayaran' => $status_pembayaran,
            'validasi_akademik' => $status,
            'validasi_umum' => $status,
            'validasi_kemahasiswaan' => $status
        );

        $id = array('id_peminjaman' => $id_peminjaman);

        $this->M_Peminjaman->updateData($id,$data,'peminjaman');
        $this->session->set_flashdata('sukses', "Peminjaman telah dikirim, silahkan menunggu validasi dari validator");
        redirect('peminjaman/detailPeminjaman/'.$id_peminjaman.'/'.$jenis_peminjaman);
    }


    function validasiPeminjaman(){
        $id_peminjaman = $this->input->post("id_peminjaman");
        $jenis_peminjaman = $this->input->post("jenis_peminjaman");
        $status_pembayaran = 'lunas';
        $nama_kode = base_url().'peminjaman/detailPeminjaman/'.$id_peminjaman.'/'.$jenis_peminjaman;
		$this->load->library('ciqrcode'); //pemanggilan library QR CODE

		$config['cacheable']	= true; //boolean, the default is true
		$config['cachedir']		= './assets/'; //string, the default is application/cache/
		$config['errorlog']		= './assets/'; //string, the default is application/logs/
		$config['imagedir']		= './assets/images/'; //direktori penyimpanan qr code
		$config['quality']		= true; //boolean, the default is true
		$config['size']			= '1024'; //interger, the default is 1024
		$config['black']		= array(224,255,255); // array, default is array(255,255,255)
		$config['white']		= array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config);

		$image_name=$id_peminjaman.'.png'; //buat name dari qr code sesuai dengan nim

		$params['data'] = $nama_kode; //data yang akan di jadikan QR CODE
		$params['level'] = 'H'; //H=High
		$params['size'] = 10;
		$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
		$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        
        //
        $status = "setuju";
        $operator = $this->session->userdata('status');
        if($operator == 'admin' || $operator == 'staff pelayanan'){
            $data = array(
                'qr_code' => $image_name,
                'validasi_akademik' => $status,
                'status_pembayaran' => $status_pembayaran,
                'validasi_kemahasiswaan' => $status,
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

    function formPengembalianBarang($id_peminjaman){
        $data['main_view'] = 'peminjaman/v_tambahPengembalianBarang';
        $jenis_peminjaman = 'barang';
		$data['jenis_peminjaman'] = 'barang';
		$data['id_peminjaman'] = $id_peminjaman;
        $data['peminjaman'] = $this->M_Peminjaman->getDetailPeminjaman($id_peminjaman);
        $data['sarana'] = $this->M_Peminjaman->getSaranaPeminjamanById($id_peminjaman,$jenis_peminjaman);
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

    function tambahPengembalianBarang(){
        
        $id_peminjaman = $this->input->post('id_peminjaman');
        $tanggal_pengembalian = $this->input->post('tanggal_pengembalian');
        $jam_pengembalian = $this->input->post('jam_pengembalian');
        $catatan_pengembalian = $this->input->post('catatan_pengembalian');
        $status_kembali = 'sudah';
        $data = array(
            'tanggal_pengembalian' => $tanggal_pengembalian,
            'jam_pengembalian' => $jam_pengembalian,
            'catatan_pengembalian' => $catatan_pengembalian,
            'status_kembali' => $status_kembali
        );

        $id = array('id_peminjaman' => $id_peminjaman);

        $this->M_Peminjaman->updateData($id,$data,'peminjaman');
        $this->session->set_flashdata('notifsukses', "Pengembalian barang telah disimpan");
        redirect('peminjaman/detailPeminjaman/'.$id_peminjaman.'/barang');
    }

    function bayarPeminjaman(){
        $id_peminjaman = $this->input->post('id_peminjaman');
        $buktiPembayaran = $this->input->post('buktiPembayaran');
        $jenis = $this->input->post('jenis');
        $status_pembayaran = 'lunas';
        $config['upload_path']          = './assets/buktiPembayaran/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 1500;
        $config['max_width']            = 2024;
        $config['max_height']           = 1768;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('buktiPembayaran')){
            $this->session->set_flashdata('gagal', "File tidak sesuai persayaratan, periksa kembali file anda, max 1 mb, png, jpg");
            redirect('peminjaman/detailPeminjaman/'.$id_peminjaman.'/'.$jenis);
        }else{                    	            	
            $file = $this->upload->data();
            $image = $file['file_name']; 
        }
        $data = array(
            'id_peminjaman' => $id_peminjaman,
            'bukti_pembayaran' => $image,
            'status_pembayaran' => $status_pembayaran
        );

        $id = array('id_peminjaman' => $id_peminjaman);

        $this->M_Peminjaman->updateData($id,$data,'peminjaman');
        $this->session->set_flashdata('sukses', "status peminjaman telah diubah menjadi lunas");
        redirect('peminjaman/detailPeminjaman/'.$id_peminjaman.'/'.$jenis);
    }

    function qrcode($id_peminjaman,$jenis_peminjaman){
        $nama_kode = base_url().'peminjaman/detailPeminjaman/'.$id_peminjaman.'/'.$jenis_peminjaman;
		$this->load->library('ciqrcode'); //pemanggilan library QR CODE

		$config['cacheable']	= true; //boolean, the default is true
		$config['cachedir']		= './assets/'; //string, the default is application/cache/
		$config['errorlog']		= './assets/'; //string, the default is application/logs/
		$config['imagedir']		= './assets/images/'; //direktori penyimpanan qr code
		$config['quality']		= true; //boolean, the default is true
		$config['size']			= '1024'; //interger, the default is 1024
		$config['black']		= array(224,255,255); // array, default is array(255,255,255)
		$config['white']		= array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config);

		$image_name=$id_peminjaman.'.png'; //buat name dari qr code sesuai dengan nim

		$params['data'] = $nama_kode; //data yang akan di jadikan QR CODE
		$params['level'] = 'H'; //H=High
		$params['size'] = 10;
		$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
		$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $data = array(
            'qr_code' => $image_name
        );

        $id = array('id_peminjaman' => $id_peminjaman);

        $this->M_Peminjaman->updateData($id,$data,'peminjaman');
		redirect('peminjaman/historyPeminjaman'); //redirect ke mahasiswa usai simpan data
    }

    function buktiPeminjaman(){
        
        $data['waktu'] = $this->M_Peminjaman->getDataWaktu()->result();
        $id_peminjaman = $this->input->post('id_peminjaman');
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
        $data['peminjaman'] = $this->M_Peminjaman->getDetailPeminjaman($id_peminjaman);
        $data['tagihan'] = $this->M_Peminjaman->getDataTagihanByIdPeminjaman($id_peminjaman);
        $data['id_peminjaman'] = $id_peminjaman;

        $this->load->view('peminjaman/v_buktiPeminjaman',$data);
  }




}
