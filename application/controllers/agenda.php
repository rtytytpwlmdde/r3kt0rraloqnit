<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_Agenda');
		$this->load->model('M_Peminjaman');
		$this->load->model('M_User');
	}

	public function index()
	{
		$data['search'] = $this->input->get('search');
		$data['start'] = $this->input->get('start');
		$data['end'] = $this->input->get('end');
		$data['jumlahPeminjaman'] = $this->M_Peminjaman->getCountPeminjamanTerkirim();
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
        $data['agenda'] = $this->M_Agenda->getDataAgenda()->result();
        $data['waktu'] = $this->M_Peminjaman->getDataWaktu()->result();
		$data['main_view'] = 'Agenda/V_list_agenda';
		if($this->session->userdata('status') == "pengguna" || $this->session->userdata('logged_in') == FALSE){ 
            $this->load->view('Template/Template_user',$data);
        }else{
           $this->load->view('Template/Template_operator',$data);
        }
	}

}