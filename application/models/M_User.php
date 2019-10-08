<?php 

class M_User extends CI_Model{


		function getDataProgramStudi(){
			return $this->db->get('program_studi');
		}

    function getDataOperator(){
        return $this->db->get('operator');
		}

    function tambahUser($data,$tabel){
		$this->db->insert($tabel,$data);
    }
    
    function hapusUser($id,$tabel){
		$this->db->where($id);
		$this->db->delete($tabel);
    }	
    
	function updateUser($id,$data,$tabel){
		$this->db->where($id);
		$this->db->update($tabel,$data);
    }

    function getDataOperatorById($username){
		$this->db->select('*');
		$this->db->from('operator');
		$this->db->where('username',$username);
		$query=$this->db->get();
		return $query->result();
    }

    public function cek_id_operator(){
		$username = $this->input->post('username');
		$query = $this->db->where('username', $username)
						  ->get('operator');
		if($this->db->affected_rows() > 0){
			return TRUE;
		} else{
			return FALSE;
		}
		}
		
		public function cekMahasiswa(){
			$id_peminjam = $this->input->post('id_peminjam');
			$query = $this->db->where('id_mahasiswa', $id_peminjam)
								->get('mahasiswa');
			if($this->db->affected_rows() > 0){
				return TRUE;
			} else{
				return FALSE;
			}
			}
    
    function getDataDosen(){
        return $this->db->get('dosen');
    }

    function getDataDosenById($id_dosen){
		$this->db->select('*');
		$this->db->from('dosen');
		$this->db->where('id_dosen',$id_dosen);
		$query=$this->db->get();
		return $query->result();
		}
		
		function getCountUserBaru(){
			$this->db->select('id_mahasiswa ,count(id_mahasiswa) as jumUserBaru');
			$this->db->from('mahasiswa');
			$this->db->where('status_mahasiswa','belum divalidasi');
			$query = $this->db->get();
			return $query->result();
		}

    public function cek_id_dosen(){
		$id_dosen = $this->input->post('id_dosen');
		$query = $this->db->where('id_dosen', $id_dosen)
						  ->get('dosen');
		if($this->db->affected_rows() > 0){
			return TRUE;
		} else{
			return FALSE;
		}
    }
    
    function getDataMahasiswa(){
			$status_mahasiswa = $this->input->post('status_mahasiswa');
			$this->db->select('*');
			$this->db->from('mahasiswa');
			if($status_mahasiswa != null){
				$this->db->where('status_mahasiswa',$status_mahasiswa);
			}
			$query=$this->db->get();
			return $query;
    }

    function getDataMahasiswaById($id_mahasiswa){
			$this->db->select('*');
			$this->db->from('mahasiswa');
			$this->db->where('id_mahasiswa',$id_mahasiswa);
			$query=$this->db->get();
			return $query->result();
    }

    public function cek_id_mahasiswa(){
		$id_mahasiswa = $this->input->post('id_mahasiswa');
		$query = $this->db->where('id_mahasiswa', $id_mahasiswa)
						  ->get('mahasiswa');
		if($this->db->affected_rows() > 0){
			return TRUE;
		} else{
			return FALSE;
		}
	}

	function getDataLembaga(){
		return $this->db->get('lembaga');
	}

	function getDataLembagaById($id_lembaga){
		$this->db->select('*');
		$this->db->from('lembaga');
		$this->db->where('id_lembaga',$id_lembaga);
		$query=$this->db->get();
		return $query->result();
	}

	function getJumlahDosen(){
		$this->db->select('count(id_dosen) as jumDosen');
		$this->db->from('dosen');
		$query = $this->db->get();
		return $query->result();
	}

	function getJumlahMahasiswa(){
		$this->db->select('count(id_mahasiswa) as jumMahasiswa');
		$this->db->from('mahasiswa');
		$query = $this->db->get();
		return $query->result();
	}

	function getJumlahOperator(){
		$this->db->select('count(username) as jumOperator');
		$this->db->from('operator');
		$query = $this->db->get();
		return $query->result();
	}

	function getJumlahLembaga(){
		$this->db->select('count(id_lembaga) as jumLembaga');
		$this->db->from('lembaga');
		$query = $this->db->get();
		return $query->result();
	}
}