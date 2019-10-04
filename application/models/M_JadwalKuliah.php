<?php 

class M_JadwalKuliah extends CI_Model{
    function getDataSemester(){
			$this->db->select('*');
			$this->db->from('semester');
			$this->db->order_by('id_semester', 'desc');
			$query=$this->db->get();
			return $query;
    }

    function tambahData($data,$tabel){
		$this->db->insert($tabel,$data);
    }
    
    function hapusData($id,$tabel){
		$this->db->where($id);
		$this->db->delete($tabel);
    }	
    
	function updateData($id,$data,$tabel){
		$this->db->where($id);
		$this->db->update($tabel,$data);
    }

    function getDataSemesterById($id){
		$this->db->select('*');
		$this->db->from('semester');
		$this->db->where('id_semester',$id);
		$query=$this->db->get();
		return $query->result();
		}
		
		function getDataSemesterAktif(){
			$this->db->select('*');
			$this->db->from('semester');
			$this->db->where('status_semester','aktif');
			$query=$this->db->get();
			return $query->result();
			}

    function getDataMatakuliah(){
        return $this->db->get('matakuliah');
    }

    function tambahMatakuliah($data,$tabel){
		$this->db->insert($tabel,$data);
    }
    
    function hapusMatakuliah($id,$tabel){
		$this->db->where($id);
		$this->db->delete($tabel);
    }	
    
	function updateMatakuliah($id,$data,$tabel){
		$this->db->where($id);
		$this->db->update($tabel,$data);
    }

	function getDataMatakuliahById($id_matakuliah){
		$this->db->select('*');
		$this->db->from('matakuliah');
		$this->db->where('id_matakuliah',$id_matakuliah);
		$query=$this->db->get();
		return $query->result();
    }

	public function cek_id_matakuliah(){
		$id_matakuliah = $this->input->post('id_matakuliah');
		$query = $this->db->where('id_matakuliah', $id_matakuliah)
						  ->get('matakuliah');
		if($this->db->affected_rows() > 0){
			return TRUE;
		} else{
			return FALSE;
		}
	}

	function getDataJamKuliah(){
		return $this->db->get('jam_kuliah');
	}

	function tambahJamKuliah($data,$tabel){
	$this->db->insert($tabel,$data);
	}

	function hapusJamKuliah($id,$tabel){
		$this->db->where($id);
		$this->db->delete($tabel);
	}	

	function updateJamKuliah($id,$data,$tabel){
		$this->db->where($id);
		$this->db->update($tabel,$data);
	}

	function getDataJamKuliahById($id_jam_kuliah){
		$this->db->select('*');
		$this->db->from('jam_kuliah');
		$this->db->where('id_jam_kuliah',$id_jam_kuliah);
		$query=$this->db->get();
		return $query->result();
	}


	// jadwal kuliah
	function getDataJadwalKuliah($id_semester){
		$this->db->select('*');
		$this->db->select('nama_dosen as dosen2');
		$this->db->from('jadwal_kuliah');
		$this->db->join('jam_kuliah','jadwal_kuliah.id_jam_kuliah = jam_kuliah.id_jam_kuliah');
		$this->db->join('semester','jadwal_kuliah.id_semester = semester.id_semester');
		$this->db->join('ruangan','jadwal_kuliah.id_ruangan = ruangan.id_ruangan');
		$this->db->join('program_studi','jadwal_kuliah.id_program_studi = program_studi.id_program_studi');
		$this->db->join('dosen','jadwal_kuliah.id_dosen1 = dosen.id_dosen');
		$this->db->join('matakuliah','jadwal_kuliah.id_matakuliah = matakuliah.id_matakuliah');
		$this->db->where('jadwal_kuliah.id_semester',$id_semester);
		$query=$this->db->get();
		return $query->result();
	}

	function getDataDosen($id_semester){
		$this->db->select('dosen.nama_dosen, jadwal_kuliah.id_jadwal_kuliah');
		$this->db->from('dosen');
		$this->db->join('jadwal_kuliah','jadwal_kuliah.id_dosen2 = dosen.id_dosen');
		$this->db->where('jadwal_kuliah.id_semester',$id_semester);
		$query=$this->db->get();
		return $query->result();
	}

	function tambahJadwalKuliah($data,$tabel){
	$this->db->insert($tabel,$data);
	}

	function hapusJadwalKuliah($id,$tabel){
		$this->db->where($id);
		$this->db->delete($tabel);
	}	

	function updateJadwalKuliah($id,$data,$tabel){
		$this->db->where($id);
		$this->db->update($tabel,$data);
	}

	function getDataJadwalKuliahById($id_jadwal_kuliah){
		$this->db->select('*');
		$this->db->from('jadwal_kuliah');
		$this->db->join('jam_kuliah','jadwal_kuliah.id_jam_kuliah = jam_kuliah.id_jam_kuliah');
		$this->db->join('semester','jadwal_kuliah.id_semester = semester.id_semester');
		$this->db->join('ruangan','jadwal_kuliah.id_ruangan = ruangan.id_ruangan');
		$this->db->join('program_studi','jadwal_kuliah.id_program_studi = program_studi.id_program_studi');
		$this->db->join('dosen','jadwal_kuliah.id_dosen1 = dosen.id_dosen');
		$this->db->join('matakuliah','jadwal_kuliah.id_matakuliah = matakuliah.id_matakuliah');
		$this->db->where('jadwal_kuliah.id_jadwal_kuliah',$id_jadwal_kuliah);
		$query=$this->db->get();
		return $query->result();
	}
	
	public function cekJadwalKuliah(){
		$id_jadwal_kuliah = $this->input->post('id_jadwal_kuliah');
		$id_semester = $this->input->post('id_semester');
		$id_dosen = $this->input->post('id_dosen');
		$id_jam_kuliah = $this->input->post('id_jam_kuliah');
		$id_ruangan = $this->input->post('id_ruangan');
		$hari = $this->input->post('hari');
		$query = $this->db->where('id_semester', $id_semester)
							->where('id_jam_kuliah', $id_jam_kuliah)
							->where('id_ruangan', $id_ruangan)
							->where('hari', $hari)
							->where('id_jadwal_kuliah !=', $id_jadwal_kuliah)
						  ->get('jadwal_kuliah');
		if($this->db->affected_rows() > 0){
			return TRUE;
		} else{
			return FALSE;
		}
	}

	public function plotingJadwalAktif($id_semester){
		$status = "aktif";
		$data = array('status_jadwal_kuliah' => $status);
		$this->db->where('id_semester', $id_semester);
		$this->db->update('jadwal_kuliah', $data);
	}

	public function plotingJadwalNonAktif($id_semester){
		$status = "tidak aktif";
		$data = array('status_jadwal_kuliah' => $status);
		$this->db->where('id_semester !=', $id_semester);
		$this->db->update('jadwal_kuliah', $data);
	}

	public function plotingSemesterAktif($id_semester){
		$status = "aktif";
		$data = array('status_semester' => $status);
		$this->db->where('id_semester', $id_semester);
		$this->db->update('semester', $data);
	}

	public function plotingSemesterNonAktif($id_semester){
		$status = "tidak aktif";
		$data = array('status_semester' => $status);
		$this->db->where('id_semester !=', $id_semester);
		$this->db->update('semester', $data);
	}

	function getJadwalKuliah(){
		$tanggal = $this->input->get('tanggal');
		$hari = '';
		if($tanggal == ''){
			$date = date("Y-m-d");
			$hari = date('l', strtotime($date));
		}else{
			$hari = date('l', strtotime($tanggal));
		}

		if($hari == "Monday"){$hari = "SENIN";
		}else if($hari == "Tuesday"){$hari = "SELASA";
		}else if($hari == "Wednesday"){$hari = "RABU";
		}else if($hari == "Thursday"){$hari = "KAMIS";
		}else if($hari == "Friday"){$hari = "JUMAT";
		}else if($hari == "Saturday"){$hari = "SAPTU";
		}else{ $hari = "Minggu";}
		$this->db->select('jadwal_kuliah.id_jadwal_kuliah, jadwal_kuliah.status_jadwal_kuliah, program_studi.nama_program_studi, dosen.nama_dosen, matakuliah.nama_matakuliah, jadwal_kuliah.id_semester, jadwal_kuliah.id_dosen2,
		                 jam_kuliah.id_jam_kuliah, ruangan.id_ruangan, dosen.id_dosen, program_studi.id_program_studi, matakuliah.id_matakuliah, jadwal_kuliah.kelas ');
		$this->db->from('jadwal_kuliah');
		$this->db->join('jam_kuliah','jadwal_kuliah.id_jam_kuliah = jam_kuliah.id_jam_kuliah');
		$this->db->join('semester','jadwal_kuliah.id_semester = semester.id_semester');
		$this->db->join('ruangan','jadwal_kuliah.id_ruangan = ruangan.id_ruangan');
		$this->db->join('program_studi','jadwal_kuliah.id_program_studi = program_studi.id_program_studi');
		$this->db->join('dosen','jadwal_kuliah.id_dosen1 = dosen.id_dosen');
		$this->db->join('matakuliah','jadwal_kuliah.id_matakuliah = matakuliah.id_matakuliah');
		$this->db->where('jadwal_kuliah.status_jadwal_kuliah', 'aktif');
		$this->db->where('jadwal_kuliah.hari', $hari);
		$query=$this->db->get();
		return $query->result();
	}

	function getDataDosenByDate(){
		$tanggal = $this->input->get('tanggal');
		$hari = '';
		if($tanggal == ''){
			$date = date("Y-m-d");
			$hari = date('l', strtotime($date));
		}else{
			$hari = date('l', strtotime($tanggal));
		}

		if($hari == "Monday"){$hari = "SENIN";
		}else if($hari == "Tuesday"){$hari = "SELASA";
		}else if($hari == "Wednesday"){$hari = "RABU";
		}else if($hari == "Thursday"){$hari = "KAMIS";
		}else if($hari == "Friday"){$hari = "JUMAT";
		}else if($hari == "Saturday"){$hari = "SAPTU";
		}else{ $hari = "Minggu";}
		$this->db->select('jadwal_kuliah.id_jadwal_kuliah, dosen.nama_dosen');
		$this->db->from('jadwal_kuliah');
		$this->db->join('dosen','jadwal_kuliah.id_dosen2 = dosen.id_dosen');
		$this->db->where('jadwal_kuliah.status_jadwal_kuliah', 'aktif');
		$this->db->where('jadwal_kuliah.hari', $hari);
		$query=$this->db->get();
		return $query->result();
	}


	function get_subkategori_matakuliah($id){
		$hasil=$this->db->query("SELECT nama_matakuliah, id_matakuliah FROM matakuliah  ORDER BY nama_matakuliah ASC");
		return $hasil->result();
	}

	function get_subkategori_ruang($id){
		$hasil=$this->db->query("SELECT id_ruangan, nama_ruangan FROM ruangan ORDER BY nama_ruangan ASC");
		return $hasil->result();
	}

	function get_subkategori_dosen($id){
		$hasil=$this->db->query("SELECT id_dosen, nama_dosen FROM dosen ORDER BY nama_dosen ASC");
		return $hasil->result();

	}

	function get_subkategori_prodi($id){
		$hasil=$this->db->query("SELECT nama_program_studi, id_program_studi FROM program_studi ORDER BY nama_program_studi ASC");
		return $hasil->result();
	}

	public function view(){
		return $this->db->get('jadwal_kuliah')->result(); 
	}
	
	// Fungsi untuk melakukan proses upload file
	public function uploadFile($filename){
		$this->load->library('upload'); // Load librari upload
		
		$config['upload_path'] = './excel/';
		$config['allowed_types'] = 'xlsx';
		$config['max_size']	= '2048';
		$config['overwrite'] = true;
		$config['file_name'] = $filename;
	
		$this->upload->initialize($config); // Load konfigurasi uploadnya
		if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
			// Jika berhasil :
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		}else{
			// Jika gagal :
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}
	
	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insertDataImport($data){
		$this->db->insert_batch('jadwal_kuliah', $data);
	}

}