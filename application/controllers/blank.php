<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blank extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_Peminjaman');
		$this->load->model('M_User');
	}

	public function index()
	{
		$data['main_view'] = 'template/v_404';
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
		if($this->session->userdata('status') == "pengguna" || $this->session->userdata('logged_in') == FALSE){ 
            $this->load->view('template/template_user',$data);
        }else{
           $this->load->view('template/template_operator',$data);
        }
	}

}