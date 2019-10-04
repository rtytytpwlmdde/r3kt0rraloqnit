<?php 

class M_Auth extends CI_Model{
    public function cek_user(){
		$u = $this->input->post('username');
		$p = $this->input->post('password');

		$query = $this->db->where('username', $u)
						  ->where('password', $p)
						  ->get('operator');
		if($this->db->affected_rows() > 0){
			$data_login = $query->row();
			$data_session = array(
									'logged_in' => TRUE,
									'username' => $data_login->username,
									'status' => $data_login->status_operator,
								);
			$this->session->set_userdata($data_session);
			return TRUE;
		} else{
			return FALSE;
		}
	}

	public function cek_mahasiswa(){
		$u = $this->input->post('username');
		$p = $this->input->post('password');

		$query = $this->db->where('id_mahasiswa', $u)
						  ->where('password', $p)
						  ->get('mahasiswa');
		if($this->db->affected_rows() > 0){
			$data_login = $query->row();
			$data_session = array(
									'logged_in' => TRUE,
									'username' => $data_login->id_mahasiswa,
									'nama' => $data_login->nama_mahasiswa,
									'status' => 'pengguna',
								);
			$this->session->set_userdata($data_session);
			return TRUE;
		} else{
			return FALSE;
		}
	}
}