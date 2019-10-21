<?php 

class M_Rekap extends CI_Model{
    
	function getDataRekapPeminjamanKelasPerbulan(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('id_peminjaman ,count(id_peminjaman) as jumPeminjamanKelasPerbulan');
		$this->db->select('date_format(tanggal_peminjaman,"%m") as bulan');
		$this->db->from('peminjaman');
		$this->db->where('peminjaman.jenis_peminjaman','kelas');
		$this->db->group_by('bulan');
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapPeminjamanKelasPertahun(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('id_peminjaman ,count(id_peminjaman) as jumPeminjamanKelasPertahun');
		$this->db->from('peminjaman');
		$this->db->where('peminjaman.jenis_peminjaman','kelas');
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapPeminjamanNonKelasPerbulan(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('id_peminjaman ,count(id_peminjaman) as jumPeminjamanNonKelasPerbulan');
		$this->db->select('date_format(tanggal_peminjaman,"%m") as bulan');
		$this->db->from('peminjaman');
		$this->db->where('peminjaman.jenis_peminjaman','non kelas');
		$this->db->group_by('bulan');
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapPeminjamanNonKelasPertahun(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('id_peminjaman ,count(id_peminjaman) as jumPeminjamanNonKelasPertahun');
		$this->db->from('peminjaman');
		$this->db->where('peminjaman.jenis_peminjaman','non kelas');
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		$query = $this->db->get();
		return $query->result();
	}





	function getDataRekapPeminjamanPerbulan(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('id_peminjaman ,count(id_peminjaman) as jumPeminjamanPerbulan');
		$this->db->select('date_format(tanggal_peminjaman,"%m") as bulan');
		$this->db->from('peminjaman');
		$this->db->group_by('bulan');
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapPeminjamanSetujuPerbulan(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('id_peminjaman ,count(id_peminjaman) as jumPeminjamanPerbulan');
		$this->db->select('date_format(tanggal_peminjaman,"%m") as bulan');
		$this->db->from('peminjaman');
		$this->db->group_by('bulan');
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		$this->db->where('validasi_akademik','setuju');
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapPeminjamanTolakPerbulan(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('id_peminjaman ,count(id_peminjaman) as jumPeminjamanPerbulan');
		$this->db->select('date_format(tanggal_peminjaman,"%m") as bulan');
		$this->db->from('peminjaman');
		$this->db->group_by('bulan');
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		$this->db->where('validasi_akademik','tolak');
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapPeminjamanTerkirimPerbulan(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('id_peminjaman ,count(id_peminjaman) as jumPeminjamanPerbulan');
		$this->db->select('date_format(tanggal_peminjaman,"%m") as bulan');
		$this->db->from('peminjaman');
		$this->db->group_by('bulan');
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		$this->db->where('validasi_akademik','terkirim');
		$query = $this->db->get();
		return $query->result();
	}

	


	

	

	function getDataRekapPeminjamanSetujuPertahun(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('count(peminjaman.id_peminjaman) as jumPeminjamanSetujuPertahun');
		$this->db->from('peminjaman');
		$this->db->where('peminjaman.validasi_akademik','setuju');
		$this->db->where('peminjaman.validasi_kemahasiswaan','setuju');
		$this->db->where('peminjaman.validasi_umum','setuju');
		$this->db->where('YEAR(peminjaman.tanggal_peminjaman)',$tahun);
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapPeminjamanTolakPertahun(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('count(peminjaman.id_peminjaman) as jumPeminjamanTolakPertahun');
		$this->db->from('peminjaman');
		$this->db->where('YEAR(peminjaman.tanggal_peminjaman)',$tahun);
		$this->db->where('peminjaman.validasi_akademik','tolak');
		$this->db->or_where('peminjaman.validasi_kemahasiswaan','tolak');
		$this->db->or_where('peminjaman.validasi_umum','tolak');
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapPeminjamanTerkirimPertahun(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('count(peminjaman.id_peminjaman) as jumPeminjamanTekirimPertahun');
		$this->db->from('peminjaman');
		$this->db->where('YEAR(peminjaman.tanggal_peminjaman)',$tahun);
		$this->db->where('peminjaman.validasi_akademik','terkirim');
		$query = $this->db->get();
		return $query->result();
	}


	
}