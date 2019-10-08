<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_agenda');
		$this->load->model('m_peminjaman');
		$this->load->model('m_user');
	}

	public function index()
	{
		$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
		$data['jumlahUser'] = $this->m_user->getCountUserBaru();
        $data['agenda'] = $this->m_agenda->getDataAgenda()->result();
        $data['waktu'] = $this->m_peminjaman->getDataWaktu()->result();
		$data['main_view'] = 'agenda/v_list_agenda';
		if($this->session->userdata('status') == "pengguna" || $this->session->userdata('logged_in') == FALSE){ 
            $this->load->view('template/template_user',$data);
        }else{
            $this->load->view('template/template_operator',$data);
        }
	}

}