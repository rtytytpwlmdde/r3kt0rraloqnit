<?php 

class M_Peminjaman extends CI_Model{
	function getDataWaktu(){
        return $this->db->get('waktu');
    }
	function getDataSemuaPeminjaman(){
        $this->db->select('*');
        $this->db->from('peminjaman');
		$this->db->join('jam_kuliah','peminjaman.id_jam_kuliah = jam_kuliah.id_jam_kuliah');
		$this->db->join('semester','peminjaman.id_semester = semester.id_semester');
		$this->db->join('mahasiswa','peminjaman.id_peminjam = mahasiswa.id_mahasiswa');
		$this->db->join('program_studi','peminjaman.id_program_studi = program_studi.id_program_studi');
		$this->db->join('dosen','peminjaman.id_dosen = dosen.id_dosen');
		$this->db->join('matakuliah','peminjaman.id_matakuliah = matakuliah.id_matakuliah');
		$query=$this->db->get();
		return $query;
    }
    
    function getPeminjaman(){
		$tanggal = $this->input->get('tanggal');
		if($tanggal == NULL){
			$tanggal = date("Y-m-d");
		}else{
			$tanggal = $tanggal;
		}
		$this->db->select('peminjaman.validasi_akademik, program_studi.nama_program_studi, dosen.nama_dosen, matakuliah.nama_matakuliah, peminjaman.id_semester,
        jam_kuliah.id_jam_kuliah, ruangan.id_ruangan, ruangan.nama_ruangan, dosen.id_dosen, program_studi.id_program_studi, matakuliah.id_matakuliah, peminjaman.kelas ');
        $this->db->from('peminjaman');
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('jam_kuliah','peminjaman.id_jam_kuliah = jam_kuliah.id_jam_kuliah');
		$this->db->join('semester','peminjaman.id_semester = semester.id_semester');
		$this->db->join('ruangan','sarana_peminjaman.id_sarana = ruangan.id_ruangan');
		$this->db->join('mahasiswa','peminjaman.id_peminjam = mahasiswa.id_mahasiswa');
		$this->db->join('program_studi','peminjaman.id_program_studi = program_studi.id_program_studi');
		$this->db->join('dosen','peminjaman.id_dosen = dosen.id_dosen');
		$this->db->join('matakuliah','peminjaman.id_matakuliah = matakuliah.id_matakuliah');
        $this->db->where('peminjaman.tanggal_mulai_penggunaan', $tanggal);
        $this->db->where('peminjaman.validasi_akademik', 'setuju');
		$query=$this->db->get();
		return $query->result();
	}

	function getIdMaxPeminjaman(){
		$this->db->select_max('id_peminjaman');
        $this->db->from('peminjaman');
		$query=$this->db->get();
		return $query->result();
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
	
	function getDataPeminjamanTerkirim(){
		$operator = $this->session->userdata('status');
        $this->db->select('*');
        $this->db->from('peminjaman');
		$this->db->join('mahasiswa','peminjaman.id_peminjam = mahasiswa.id_mahasiswa');
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana');
		if($operator == "admin"){
		}else{
			$this->db->where('ruangan.id_operator', $operator);
		}
		$this->db->where('peminjaman.validasi_akademik ','terkirim');
		$query=$this->db->get();
		return $query;
	}

	function getCountPeminjamanTerkirim(){
		$operator = $this->session->userdata('status');
		$id_operator = $this->session->userdata('username');
		$this->db->select('peminjaman.id_peminjaman ,count(peminjaman.id_peminjaman) as jumPeminjamanTerkirim');
        $this->db->from('peminjaman');
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana');
		if($operator == "admin"){
		}else{
			//$this->db->where('ruangan.id_operator',$operator);
			$this->db->where('ruangan.id_operator', $id_operator);
		}
		$this->db->where('validasi_akademik ','terkirim');
		$query=$this->db->get();
		return $query->result();
	}
	
	function getDataPeminjaman($jenis_peminjaman){
		$status = $this->input->post('status');
		$operator = $this->session->userdata('username');
        $this->db->select('*');
		$this->db->from('peminjaman');
		$this->db->join('mahasiswa','peminjaman.id_peminjam = mahasiswa.id_mahasiswa');
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana');
		$this->db->join('waktu','peminjaman.jam_mulai = waktu.id_waktu');
		if($status != NULL){
			$this->db->where('peminjaman.validasi_akademik',$status);
		}
		$this->db->where('ruangan.id_operator',$operator);
		$query=$this->db->get();
		return $query;
	}

	function getDataPeminjamanByMahasiswa(){
		$operator = $this->session->userdata('username');
        $this->db->select('*');
        $this->db->from('peminjaman');
		$this->db->join('mahasiswa','peminjaman.id_peminjam = mahasiswa.id_mahasiswa');
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana');
		$this->db->where('peminjaman.id_peminjam', $operator);;
		$query=$this->db->get();
		return $query;
	}
	
	function getDetailPeminjaman($id_peminjaman, $jenis_peminjaman){
        $this->db->select('*');
        $this->db->from('peminjaman');
		$this->db->join('mahasiswa','peminjaman.id_peminjam = mahasiswa.id_mahasiswa');
		$this->db->join('waktu','peminjaman.jam_mulai = waktu.id_waktu');
		if($jenis_peminjaman == "kelas"){
			$this->db->join('jam_kuliah','peminjaman.id_jam_kuliah = jam_kuliah.id_jam_kuliah');
			$this->db->join('semester','peminjaman.id_semester = semester.id_semester');
			$this->db->join('program_studi','peminjaman.id_program_studi = program_studi.id_program_studi');
			$this->db->join('dosen','peminjaman.id_dosen = dosen.id_dosen');
			$this->db->join('matakuliah','peminjaman.id_matakuliah = matakuliah.id_matakuliah');
        }else{
			
        }
        $this->db->where('peminjaman.id_peminjaman', $id_peminjaman);
		$query=$this->db->get();
		return $query->result();
	}

	function getSaranaPeminjaman($jenis_peminjaman){
		$tanggal = $this->input->get('tanggal');
		if($tanggal == NULL){
			$tanggal = date("Y-m-d");
		}else{
			$tanggal = $tanggal;
		}
        $this->db->select('*');
        $this->db->from('peminjaman');
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','sarana_peminjaman.id_sarana = ruangan.id_ruangan');
		$this->db->where('peminjaman.tanggal_mulai_penggunaan <=',$tanggal);
		$this->db->where('peminjaman.tanggal_selesai_penggunaan >=',$tanggal);
		$where = "validasi_akademik='terkirim'  OR validasi_akademik='setuju'";
		$this->db->where($where);
		$query=$this->db->get();
		return $query->result();
	}

	function getSaranaPeminjamanById($id_peminjaman, $jenis_peminjaman){
        $this->db->select('*');
        $this->db->from('peminjaman');
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		if($jenis_peminjaman == "kelas"){
			$this->db->join('ruangan','sarana_peminjaman.id_sarana = ruangan.id_ruangan');
			$this->db->join('jam_kuliah','peminjaman.id_jam_kuliah = jam_kuliah.id_jam_kuliah');
			$this->db->join('semester','peminjaman.id_semester = semester.id_semester');
			$this->db->join('mahasiswa','peminjaman.id_peminjam = mahasiswa.id_mahasiswa');
			$this->db->join('program_studi','peminjaman.id_program_studi = program_studi.id_program_studi');
			$this->db->join('dosen','peminjaman.id_dosen = dosen.id_dosen');
			$this->db->join('matakuliah','peminjaman.id_matakuliah = matakuliah.id_matakuliah');
        }else if($jenis_peminjaman == "barang"){
			$this->db->join('barang','sarana_peminjaman.id_sarana = barang.id_barang');
        }else{
			$this->db->join('ruangan','sarana_peminjaman.id_sarana = ruangan.id_ruangan');
        }
		$this->db->where('peminjaman.id_peminjaman',$id_peminjaman);
		$query=$this->db->get();
		return $query->result();
	}

	function getJenisPeminjaman($id_peminjaman){
        $this->db->select('jenis_peminjaman');
        $this->db->from('peminjaman');
		$this->db->where('id_peminjaman',$id_peminjaman);
		$query=$this->db->get();
		if($this->db->affected_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function getRuanganTersedia($tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai){
		$this->db->select('*');
		$this->db->from('ruangan');
		$this->db->where("id_ruangan NOT IN 
		(
			SELECT id_sarana  
			FROM sarana_peminjaman  
			JOIN peminjaman ON (sarana_peminjaman.id_peminjaman = peminjaman.id_peminjaman)
			WHERE (((tanggal_mulai_penggunaan <= '$tanggal_mulai_penggunaan') and ('$tanggal_mulai_penggunaan' <= tanggal_selesai_penggunaan)) 
			OR ((tanggal_mulai_penggunaan <= '$tanggal_selesai_penggunaan') and ('$tanggal_selesai_penggunaan' <= tanggal_selesai_penggunaan))
		OR (('$tanggal_mulai_penggunaan' <= tanggal_mulai_penggunaan) and (tanggal_mulai_penggunaan <= '$tanggal_selesai_penggunaan')) 
			OR (('$tanggal_mulai_penggunaan' <= tanggal_selesai_penggunaan) and (tanggal_selesai_penggunaan <= '$tanggal_selesai_penggunaan')))
		AND
		(((jam_mulai <= '$jam_mulai') and ('$jam_mulai' <= jam_selesai)) 
			OR ((jam_mulai <= '$jam_selesai') and ('$jam_selesai' <= jam_selesai))
		OR (('$jam_mulai' <= jam_mulai) and (jam_mulai <= '$jam_selesai')) 
			OR (('$jam_mulai' <= jam_selesai) and (jam_selesai <= '$jam_selesai')))
		)"
		, NULL, FALSE);
		$this->db->where('jenis_ruangan','non kelas');
		$operator = $this->session->userdata('status');
		$id_operator = $this->session->userdata('username');
		if($operator == 'staff pelayanan'){
			$this->db->where('id_operator',$id_operator);
		}
		$this->db->order_by('ruangan.nama_ruangan');
		$query = $this->db->get();
		return $query->result();
	}

	function getBarangTersedia($tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai){
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->where("id_barang NOT IN 
		(
			SELECT id_sarana  
			FROM sarana_peminjaman  
			JOIN peminjaman ON (sarana_peminjaman.id_peminjaman = peminjaman.id_peminjaman)
			WHERE (((tanggal_mulai_penggunaan <= '$tanggal_mulai_penggunaan') and ('$tanggal_mulai_penggunaan' <= tanggal_selesai_penggunaan)) 
			OR ((tanggal_mulai_penggunaan <= '$tanggal_selesai_penggunaan') and ('$tanggal_selesai_penggunaan' <= tanggal_selesai_penggunaan))
		OR (('$tanggal_mulai_penggunaan' <= tanggal_mulai_penggunaan) and (tanggal_mulai_penggunaan <= '$tanggal_selesai_penggunaan')) 
			OR (('$tanggal_mulai_penggunaan' <= tanggal_selesai_penggunaan) and (tanggal_selesai_penggunaan <= '$tanggal_selesai_penggunaan')))
		AND
		(((jam_mulai <= '$jam_mulai') and ('$jam_mulai' <= jam_selesai)) 
			OR ((jam_mulai <= '$jam_selesai') and ('$jam_selesai' <= jam_selesai))
		OR (('$jam_mulai' <= jam_mulai) and (jam_mulai <= '$jam_selesai')) 
			OR (('$jam_mulai' <= jam_selesai) and (jam_selesai <= '$jam_selesai')))
		)"
		, NULL, FALSE);
		$query = $this->db->get();
		return $query->result();
	}

	function getDataPeminjamanNonKelasByDate($tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai){
		$this->db->select('*');
        $this->db->from('peminjaman');
		$this->db->join('mahasiswa','peminjaman.id_peminjam = mahasiswa.id_mahasiswa');
		$this->db->where('peminjaman.tanggal_mulai_penggunaan',$tanggal_mulai_penggunaan);
		$this->db->where('peminjaman.tanggal_selesai_penggunaan',$tanggal_selesai_penggunaan);
		$this->db->where('peminjaman.jam_mulai',$jam_mulai);
		$this->db->where('peminjaman.jam_selesai',$jam_selesai);
		$query=$this->db->get();
		return $query->result();
	}

	function getRuanganPeminjamanNonKelasByDate($tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai){
		$this->db->select('sarana_peminjaman.id_sarana, ruangan.nama_ruangan');
        $this->db->from('peminjaman');
		$this->db->join('sarana_peminjaman','sarana_peminjaman.id_peminjaman = peminjaman.id_peminjaman');
		$this->db->join('ruangan','sarana_peminjaman.id_sarana = ruangan.id_ruangan');
		$this->db->where('peminjaman.tanggal_mulai_penggunaan',$tanggal_mulai_penggunaan);
		$this->db->where('peminjaman.tanggal_selesai_penggunaan',$tanggal_selesai_penggunaan);
		$this->db->where('peminjaman.jam_mulai',$jam_mulai);
		$this->db->where('peminjaman.jam_selesai',$jam_selesai);
		$query=$this->db->get();
		return $query->result();
	}

	function getBarangPeminjamanBarangByDate($tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai){
		$this->db->select('sarana_peminjaman.id_sarana, barang.nama_barang');
        $this->db->from('peminjaman');
		$this->db->join('sarana_peminjaman','sarana_peminjaman.id_peminjaman = peminjaman.id_peminjaman');
		$this->db->join('barang','sarana_peminjaman.id_sarana = barang.id_barang');
		$this->db->where('peminjaman.tanggal_mulai_penggunaan',$tanggal_mulai_penggunaan);
		$this->db->where('peminjaman.tanggal_selesai_penggunaan',$tanggal_selesai_penggunaan);
		$this->db->where('peminjaman.jam_mulai',$jam_mulai);
		$this->db->where('peminjaman.jam_selesai',$jam_selesai);
		$query=$this->db->get();
		return $query->result();
	}

	function getDataPeminjamanNonKelasBarang(){
		$status = $this->input->post('status');
        $this->db->select('*');
		$this->db->from('peminjaman');
		$this->db->join('mahasiswa','peminjaman.id_peminjam = mahasiswa.id_mahasiswa');
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana');
		$this->db->join('waktu','peminjaman.jam_mulai = waktu.id_waktu');
		if($status != NULL){
			$this->db->where('peminjaman.validasi_akademik',$status);
		}
		$query=$this->db->get();
		return $query;
	}
	
	function cekJadwalKuliah($hari, $id_ruangan, $id_jam_kuliah){
		if($hari == "Monday"){$hari = "SENIN";
		}else if($hari == "Tuesday"){$hari = "SELASA";
		}else if($hari == "Wednesday"){$hari = "RABU";
		}else if($hari == "Thursday"){$hari = "KAMIS";
		}else if($hari == "Friday"){$hari = "JUMAT";
		}else if($hari == "Saturday"){$hari = "SAPTU";
		}else{ $hari = "Minggu";}
		
        $this->db->select('id_jadwal_kuliah');
		$this->db->from('jadwal_kuliah');
		$this->db->where('hari',$hari);
		$this->db->where('id_ruangan',$id_ruangan);
		$this->db->where('id_jam_kuliah',$id_jam_kuliah);
		$query=$this->db->get();
		if($this->db->affected_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	function cekPeminjaman($tanggal_penggunaan, $id_ruangan, $id_jam_kuliah){
        $this->db->select('sarana_peminjaman.id_peminjaman');
		$this->db->from('peminjaman');
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->where('peminjaman.tanggal_mulai_penggunaan',$tanggal_penggunaan);
		$this->db->where('sarana_peminjaman.id_sarana',$id_ruangan);
		$this->db->where('peminjaman.id_jam_kuliah',$id_jam_kuliah);
		$query=$this->db->get();
		if($this->db->affected_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

function cekIdPeminjaman($id_peminjaman){
	$this->db->select('jenis_peminjaman');
        $this->db->from('peminjaman');
		$this->db->where('id_peminjaman',$id_peminjaman);
		$query=$this->db->get();
		if($this->db->affected_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
}

	


}