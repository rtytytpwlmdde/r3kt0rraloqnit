<?php 

class M_Rekap extends CI_Model{
    

	function getDataRekapPeminjamanLunasPerbulan(){
		$operator = $this->session->userdata('username');
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('peminjaman.id_peminjaman ,count(peminjaman.id_peminjaman) as jumPeminjamanPerbulan');
		$this->db->select('date_format(tanggal_peminjaman,"%m") as bulan');
		$this->db->select('tanggal_peminjaman');
		$this->db->from('peminjaman');
		//
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		//
		$this->db->group_by('bulan');
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		$this->db->where('status_pembayaran','lunas');
		/////
		$this->db->where('ruangan.id_operator',$operator);
		$this->db->or_where('barang.id_operator',$operator);
		////
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapPeminjamanLunasPertahun(){
		$tahun = $this->input->get('tahun');
		$operator = $this->session->userdata('username');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('peminjaman.id_peminjaman ,count(peminjaman.id_peminjaman) as jumPeminjamanPertahun');
		$this->db->select('date_format(tanggal_peminjaman,"%m") as bulan');
		$this->db->select('tanggal_peminjaman');
		$this->db->from('peminjaman');
		//
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		//
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		$this->db->where('status_pembayaran','lunas');
		/////
		$this->db->where('ruangan.id_operator',$operator);
		$this->db->or_where('barang.id_operator',$operator);
		////
		$query = $this->db->get();
		return $query->result();
	}

	//
	function getDataRekapPeminjamanBelumBayarPerbulan(){
		$tahun = $this->input->get('tahun');
		$operator = $this->session->userdata('username');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('peminjaman.id_peminjaman ,count(peminjaman.id_peminjaman) as jumPeminjamanPerbulan');
		$this->db->select('date_format(tanggal_peminjaman,"%m") as bulan');
		$this->db->select('tanggal_peminjaman');
		$this->db->from('peminjaman');
		//
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		//
		$this->db->group_by('bulan');
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		$this->db->where('status_pembayaran','belum bayar');
		/////
		$this->db->where('ruangan.id_operator',$operator);
		$this->db->or_where('barang.id_operator',$operator);
		////
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapPeminjamanBelumBayarPertahun(){
		$tahun = $this->input->get('tahun');
		$operator = $this->session->userdata('username');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('peminjaman.id_peminjaman ,count(peminjaman.id_peminjaman) as jumPeminjamanPertahun');
		$this->db->select('date_format(tanggal_peminjaman,"%m") as bulan');
		$this->db->select('tanggal_peminjaman');
		$this->db->from('peminjaman');
		//
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		//
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		$this->db->where('status_pembayaran','belum bayar');
		/////
		$this->db->where('ruangan.id_operator',$operator);
		$this->db->or_where('barang.id_operator',$operator);
		////
		$query = $this->db->get();
		return $query->result();
	}

	//


	function getDataRekapPeminjamanPerbulan(){
		$tahun = $this->input->get('tahun');
		$operator = $this->session->userdata('username');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('peminjaman.id_peminjaman ,count(peminjaman.id_peminjaman) as jumPeminjamanPerbulan');
		$this->db->select('date_format(tanggal_peminjaman,"%m") as bulan');
		$this->db->from('peminjaman');
		//
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		//
		$this->db->group_by('bulan');
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		/////
		$this->db->where('ruangan.id_operator',$operator);
		$this->db->or_where('barang.id_operator',$operator);
		////
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapPeminjamanPertahun(){
		$tahun = $this->input->get('tahun');
		$operator = $this->session->userdata('username');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('peminjaman.id_peminjaman ,count(peminjaman.id_peminjaman) as jumPeminjamanPertahun');
		$this->db->select('date_format(tanggal_peminjaman,"%m") as bulan');
		$this->db->from('peminjaman');
		//
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		//
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		/////
		$this->db->where('ruangan.id_operator',$operator);
		$this->db->or_where('barang.id_operator',$operator);
		////
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapPeminjamanSetujuPerbulan(){
		$tahun = $this->input->get('tahun');
		$operator = $this->session->userdata('username');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('peminjaman.id_peminjaman ,count(peminjaman.id_peminjaman) as jumPeminjamanSetujuPerbulan');
		$this->db->select('date_format(tanggal_peminjaman,"%m") as bulan');
		$this->db->from('peminjaman');
		//
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		//
		$this->db->group_by('bulan');
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		$this->db->where('validasi_akademik','setuju');
		/////
		$this->db->where('ruangan.id_operator',$operator);
		$this->db->or_where('barang.id_operator',$operator);
		////
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapPeminjamanTolakPerbulan(){
		$tahun = $this->input->get('tahun');
		$operator = $this->session->userdata('username');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('peminjaman.id_peminjaman ,count(peminjaman.id_peminjaman) as jumPeminjamanTolakPerbulan');
		$this->db->select('date_format(tanggal_peminjaman,"%m") as bulan');
		$this->db->from('peminjaman');
		//
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		//
		$this->db->group_by('bulan');
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		$this->db->where('validasi_akademik','tolak');
		/////
		$this->db->where('ruangan.id_operator',$operator);
		$this->db->or_where('barang.id_operator',$operator);
		////
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapPeminjamanTerkirimPerbulan(){
		$tahun = $this->input->get('tahun');
		$operator = $this->session->userdata('username');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('peminjaman.id_peminjaman ,count(peminjaman.id_peminjaman) as jumPeminjamanTerkirimPerbulan');
		$this->db->select('date_format(tanggal_peminjaman,"%m") as bulan');
		$this->db->from('peminjaman');
		//
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		//
		$this->db->group_by('bulan');
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		$this->db->where('validasi_akademik','terkirim');
		/////
		$this->db->where('ruangan.id_operator',$operator);
		$this->db->or_where('barang.id_operator',$operator);
		////
		$query = $this->db->get();
		return $query->result();
	}

	

	function getDataRekapPemakaianRuanganPerBulan(){
		$operator = $this->session->userdata('username');
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('sarana_peminjaman.id_sarana ,count(sarana_peminjaman.id_sarana) as jumPemakaianRuanganPerbulan');
		$this->db->select('date_format(peminjaman.tanggal_peminjaman,"%m") as bulan');
		$this->db->from('sarana_peminjaman');
		$this->db->join('peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana');
		$this->db->where('peminjaman.jenis_peminjaman !=','barang');
		$this->db->group_by('bulan');
		$this->db->group_by('sarana_peminjaman.id_sarana');
		$this->db->where('YEAR(peminjaman.tanggal_peminjaman)',$tahun);
		$this->db->where('ruangan.id_operator',$operator);
		
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapPemakaianRuanganPerTahun(){
		$operator = $this->session->userdata('username');
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('sarana_peminjaman.id_sarana , count(sarana_peminjaman.id_sarana) as jumPemakaianRuanganPertahun');
		$this->db->from('sarana_peminjaman');
		$this->db->join('peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana');
		$this->db->where('peminjaman.jenis_peminjaman !=','barang');
		$this->db->group_by('sarana_peminjaman.id_sarana');
		$this->db->where('YEAR(peminjaman.tanggal_peminjaman)',$tahun);
		$this->db->where('ruangan.id_operator',$operator);
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapPemakaianBarangPerBulan(){
		$operator = $this->session->userdata('username');
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('sarana_peminjaman.id_sarana ,count(sarana_peminjaman.id_sarana) as jumPemakaianBarangPerbulan');
		$this->db->select('date_format(peminjaman.tanggal_peminjaman,"%m") as bulan');
		$this->db->from('sarana_peminjaman');
		$this->db->join('peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		$this->db->where('peminjaman.jenis_peminjaman','barang');
		$this->db->group_by('bulan');
		$this->db->group_by('sarana_peminjaman.id_sarana');
		$this->db->where('YEAR(peminjaman.tanggal_peminjaman)',$tahun);
		$this->db->where('barang.id_operator',$operator);
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapPemakaianBarangPerTahun(){
		$operator = $this->session->userdata('username');
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('sarana_peminjaman.id_sarana , count(sarana_peminjaman.id_sarana) as jumPemakaianBarangPertahun');
		$this->db->from('sarana_peminjaman');
		$this->db->join('peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana');
		$this->db->where('peminjaman.jenis_peminjaman','barang');
		$this->db->group_by('sarana_peminjaman.id_sarana');
		$this->db->where('YEAR(peminjaman.tanggal_peminjaman)',$tahun);
		$this->db->where('barang.id_operator',$operator);
		$query = $this->db->get();
		return $query->result();
	}
	

	

	function getDataRekapPeminjamanSetujuPertahun(){
		$tahun = $this->input->get('tahun');
		$operator = $this->session->userdata('username');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('count(peminjaman.id_peminjaman) as jumPeminjamanSetujuPertahun');
		$this->db->from('peminjaman');
		//
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		//
		$this->db->where('peminjaman.validasi_akademik','setuju');
		$this->db->where('peminjaman.validasi_kemahasiswaan','setuju');
		$this->db->where('peminjaman.validasi_umum','setuju');
		$this->db->where('YEAR(peminjaman.tanggal_peminjaman)',$tahun);
		/////
		$this->db->where('ruangan.id_operator',$operator);
		$this->db->or_where('barang.id_operator',$operator);
		////
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapPeminjamanTolakPertahun(){
		$tahun = $this->input->get('tahun');
		$operator = $this->session->userdata('username');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('count(peminjaman.id_peminjaman) as jumPeminjamanTolakPertahun');
		$this->db->from('peminjaman');
		//
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		//
		$this->db->where('YEAR(peminjaman.tanggal_peminjaman)',$tahun);
		$this->db->where('peminjaman.validasi_akademik','tolak');
		$this->db->or_where('peminjaman.validasi_kemahasiswaan','tolak');
		$this->db->or_where('peminjaman.validasi_umum','tolak');
		/////
		$this->db->where('ruangan.id_operator',$operator);
		$this->db->or_where('barang.id_operator',$operator);
		////
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapPeminjamanTerkirimPertahun(){
		$operator = $this->session->userdata('username');
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('count(peminjaman.id_peminjaman) as jumPeminjamanTekirimPertahun');
		$this->db->from('peminjaman');
		//
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		//
		$this->db->where('YEAR(peminjaman.tanggal_peminjaman)',$tahun);
		$this->db->where('peminjaman.validasi_akademik','terkirim');
		/////
		$this->db->where('ruangan.id_operator',$operator);
		$this->db->or_where('barang.id_operator',$operator);
		////
		$query = $this->db->get();
		return $query->result();
	}


	function getDataRekapKeuanganPerbulan(){
		$tahun = $this->input->get('tahun');
		$operator = $this->session->userdata('username');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('peminjaman.id_peminjaman ,sum(peminjaman.total_pembayaran) as jumPeminjamanPerbulan');
		$this->db->select('date_format(tanggal_peminjaman,"%m") as bulan');
		$this->db->from('peminjaman');
		//
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		//
		$this->db->group_by('bulan');
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		/////
		$this->db->where('ruangan.id_operator',$operator);
		$this->db->or_where('barang.id_operator',$operator);
		////
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapKeuanganPertahun(){
		$tahun = $this->input->get('tahun');
		$operator = $this->session->userdata('username');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('peminjaman.id_peminjaman ,sum(peminjaman.total_pembayaran) as jumPeminjamanPertahun');
		$this->db->select('date_format(tanggal_peminjaman,"%m") as bulan');
		$this->db->from('peminjaman');
		//
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		//
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		/////
		$this->db->where('ruangan.id_operator',$operator);
		$this->db->or_where('barang.id_operator',$operator);
		////
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapKeuanganLunasPerbulan(){
		$operator = $this->session->userdata('username');
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('peminjaman.id_peminjaman ,sum(peminjaman.total_pembayaran) as jumPeminjamanPerbulan');
		$this->db->select('date_format(tanggal_peminjaman,"%m") as bulan');
		$this->db->select('tanggal_peminjaman');
		$this->db->from('peminjaman');
		//
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		//
		$this->db->group_by('bulan');
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		$this->db->where('status_pembayaran','lunas');
		/////
		$this->db->where('ruangan.id_operator',$operator);
		$this->db->or_where('barang.id_operator',$operator);
		////
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapKeuanganLunasPertahun(){
		$tahun = $this->input->get('tahun');
		$operator = $this->session->userdata('username');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('peminjaman.id_peminjaman ,sum(peminjaman.total_pembayaran) as jumPeminjamanPertahun');
		$this->db->select('date_format(tanggal_peminjaman,"%m") as bulan');
		$this->db->select('tanggal_peminjaman');
		$this->db->from('peminjaman');
		//
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		//
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		$this->db->where('status_pembayaran','lunas');
		/////
		$this->db->where('ruangan.id_operator',$operator);
		$this->db->or_where('barang.id_operator',$operator);
		////
		$query = $this->db->get();
		return $query->result();
	}

	//
	function getDataRekapKeuanganBelumBayarPerbulan(){
		$tahun = $this->input->get('tahun');
		$operator = $this->session->userdata('username');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('peminjaman.id_peminjaman ,count(peminjaman.total_pembayaran) as jumPeminjamanPerbulan');
		$this->db->select('date_format(tanggal_peminjaman,"%m") as bulan');
		$this->db->select('tanggal_peminjaman');
		$this->db->from('peminjaman');
		//
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		//
		$this->db->group_by('bulan');
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		$this->db->where('status_pembayaran','belum bayar');
		/////
		$this->db->where('ruangan.id_operator',$operator);
		$this->db->or_where('barang.id_operator',$operator);
		////
		$query = $this->db->get();
		return $query->result();
	}

	function getDataRekapKeuanganBelumBayarPertahun(){
		$tahun = $this->input->get('tahun');
		$operator = $this->session->userdata('username');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$this->db->select('peminjaman.id_peminjaman ,sum(peminjaman.total_pembayaran) as jumPeminjamanPertahun');
		$this->db->select('date_format(tanggal_peminjaman,"%m") as bulan');
		$this->db->select('tanggal_peminjaman');
		$this->db->from('peminjaman');
		//
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		//
		$this->db->where('YEAR(tanggal_peminjaman)',$tahun);
		$this->db->where('status_pembayaran','belum bayar');
		/////
		$this->db->where('ruangan.id_operator',$operator);
		$this->db->or_where('barang.id_operator',$operator);
		////
		$query = $this->db->get();
		return $query->result();
	}

	//


	
}