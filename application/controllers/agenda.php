<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_agenda');
	}

	public function index()
	{
        $data['agenda'] = $this->m_agenda->getDataAgenda()->result();
		$data['main_view'] = 'agenda/v_list_agenda';
		if($this->session->userdata('status') == "pengguna" || $this->session->userdata('logged_in') == FALSE){ 
            $this->load->view('template/template_user',$data);
        }else{
            $this->load->view('template/template_operator',$data);
        }
	}

}