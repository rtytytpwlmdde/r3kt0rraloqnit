<?php 

class M_Rekap extends CI_Model{
    
	function getDataRekapPeminjamanKelasPerBulan(){
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

	function getDataRekapPeminjamanKelasPerTahun(){
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

	function getDataRekapPeminjamanNonKelasPerBulan(){
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

	function getDataRekapPeminjamanNonKelasPerTahun(){
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

	function getDataRekapPeminjamanBarangPerBulan(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('id_peminjaman ,count(id_peminjaman) as jumPeminjamanBarangPerbulan');
		$this->db->select('date_format(tanggal_peminjaman,"%m") as bulan');
		$this->db->from('peminjaman');
		$this->db->where('peminjaman.jenis_peminjaman','barang');
		$this->db->group_by('bulan');
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapPeminjamanBarangPerTahun(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('id_peminjaman ,count(id_peminjaman) as jumPeminjamanBarangPertahun');
		$this->db->from('peminjaman');
		$this->db->where('peminjaman.jenis_peminjaman','barang');
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapPeminjamanPerBulan(){
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

	function getDataRekapPeminjamanPerTahun(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('id_peminjaman ,count(id_peminjaman) as jumPeminjamanPertahun');
		$this->db->from('peminjaman');
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		$query = $this->db->get();
		return $query->result();
	}


	function getDataRekapPemakaianRuanganPerBulan(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('sarana_peminjaman.id_sarana ,count(sarana_peminjaman.id_sarana) as jumPemakaianRuanganPerbulan');
		$this->db->select('date_format(peminjaman.tanggal_peminjaman,"%m") as bulan');
		$this->db->from('sarana_peminjaman');
		$this->db->join('peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->where('peminjaman.jenis_peminjaman !=','barang');
		$this->db->group_by('bulan');
		$this->db->group_by('sarana_peminjaman.id_sarana');
		$this->db->where('YEAR(peminjaman.tanggal_peminjaman)',$tahun);
		
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapPemakaianRuanganPerTahun(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('sarana_peminjaman.id_sarana , count(sarana_peminjaman.id_sarana) as jumPemakaianRuanganPertahun');
		$this->db->from('sarana_peminjaman');
		$this->db->join('peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->where('peminjaman.jenis_peminjaman !=','barang');
		$this->db->group_by('sarana_peminjaman.id_sarana');
		$this->db->where('YEAR(peminjaman.tanggal_peminjaman)',$tahun);
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapPemakaianBarangPerBulan(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('sarana_peminjaman.id_sarana ,count(sarana_peminjaman.id_sarana) as jumPemakaianBarangPerbulan');
		$this->db->select('date_format(peminjaman.tanggal_peminjaman,"%m") as bulan');
		$this->db->from('sarana_peminjaman');
		$this->db->join('peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->where('peminjaman.jenis_peminjaman','barang');
		$this->db->group_by('bulan');
		$this->db->group_by('sarana_peminjaman.id_sarana');
		$this->db->where('YEAR(peminjaman.tanggal_peminjaman)',$tahun);
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapPemakaianBarangPerTahun(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('sarana_peminjaman.id_sarana , count(sarana_peminjaman.id_sarana) as jumPemakaianBarangPertahun');
		$this->db->from('sarana_peminjaman');
		$this->db->join('peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->where('peminjaman.jenis_peminjaman','barang');
		$this->db->group_by('sarana_peminjaman.id_sarana');
		$this->db->where('YEAR(peminjaman.tanggal_peminjaman)',$tahun);
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

	function getDataRekapPeminjamanGagalPertahun(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('count(peminjaman.id_peminjaman) as jumPeminjamanGagalPertahun');
		$this->db->from('peminjaman');
		$this->db->where('YEAR(peminjaman.tanggal_peminjaman)',$tahun);
		$this->db->where('peminjaman.validasi_akademik','tolak');
		$this->db->or_where('peminjaman.validasi_kemahasiswaan','tolak');
		$this->db->or_where('peminjaman.validasi_umum','tolak');
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapPeminjamanPendingPertahun(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('count(peminjaman.id_peminjaman) as jumPeminjamanPendingPertahun');
		$this->db->from('peminjaman');
		$this->db->where('YEAR(peminjaman.tanggal_peminjaman)',$tahun);
		$this->db->where('peminjaman.validasi_akademik','terkirim');
		$this->db->or_where('peminjaman.validasi_kemahasiswaan','terkirim');
		$this->db->or_where('peminjaman.validasi_umum','terkirim');
		$query = $this->db->get();
		return $query->result();
	}

	function getDataComplaintPerBulan(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('id_complaint ,count(id_complaint) as jumComplaintPerbulan');
		$this->db->select('date_format(tanggal,"%m") as bulan');
		$this->db->from('complaint');
		$this->db->group_by('bulan');
		$this->db->where('YEAR(tanggal)',$tahun);
		$query = $this->db->get();
		return $query->result();
	}

	function getDataComplaintPertahun(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('id_complaint ,count(id_complaint) as jumComplaintPertahun');
		$this->db->from('complaint');
		$this->db->where('YEAR(tanggal)',$tahun);
		$query = $this->db->get();
		return $query->result();
	}

	function getDataComplaintTerkirimPerBulan(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('id_complaint ,count(id_complaint) as jumComplaintTerkirimPerbulan');
		$this->db->select('date_format(tanggal,"%m") as bulan');
		$this->db->from('complaint');
		$this->db->where('status','terkirim');
		$this->db->group_by('bulan');
		$this->db->where('YEAR(tanggal)',$tahun);
		$query = $this->db->get();
		return $query->result();
	}

	function getDataComplaintTerkirimPertahun(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('id_complaint ,count(id_complaint) as jumComplaintTerkirimPertahun');
		$this->db->from('complaint');
		$this->db->where('complaint.status','terkirim');
		$this->db->where('YEAR(tanggal)',$tahun);
		$query = $this->db->get();
		return $query->result();
	}

	function getDataComplaintTinjauPerBulan(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('id_complaint ,count(id_complaint) as jumComplaintTinjauPerbulan');
		$this->db->select('date_format(tanggal,"%m") as bulan');
		$this->db->from('complaint');
		$this->db->where('complaint.status','tinjau');
		$this->db->group_by('bulan');
		$this->db->where('YEAR(tanggal)',$tahun);
		$query = $this->db->get();
		return $query->result();
	}

	function getDataComplaintTinjauPertahun(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('id_complaint ,count(id_complaint) as jumComplaintTinjauPertahun');
		$this->db->from('complaint');
		$this->db->where('complaint.status','tinjau');
		$this->db->where('YEAR(tanggal)',$tahun);
		$query = $this->db->get();
		return $query->result();
	}

	
}