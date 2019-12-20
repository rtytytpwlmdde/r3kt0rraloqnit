<?php 

class M_Peminjaman extends CI_Model{
	function getDataWaktu(){
        return $this->db->get('waktu');
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

	function getDataPeminjamanPending(){
		$date = date("Y/m/d");
        $this->db->select('id_peminjaman');
        $this->db->from('peminjaman');
		$this->db->where('peminjaman.validasi_akademik ','pending');
		$this->db->where('peminjaman.tanggal_peminjaman < ',$date);
		$query=$this->db->get();
		return $query->result();
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
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
			//$this->db->where('ruangan.id_operator',$operator);
		$this->db->where('sarana_peminjaman.status_peminjaman ','terkirim');
		if($this->session->userdata('status') != 'admin'){
			$this->db->where('ruangan.id_operator', $id_operator);
			$this->db->or_where('barang.id_operator', $id_operator);

		}
		$query=$this->db->get();
		return $query->result();
	}

	function getSaranaPeminjamanByIdStatus($id){
        $this->db->select('*');
        $this->db->from('sarana_peminjaman');
		$this->db->where('sarana_peminjaman.id_peminjaman', $id);
		$this->db->where('sarana_peminjaman.status_peminjaman !=', 'setuju');
		$query=$this->db->get();
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	function getDataPeminjamanById($id){
        $this->db->select('*');
        $this->db->from('peminjaman');
		$this->db->where('peminjaman.id_peminjaman', $id);
		$query=$this->db->get();
		return $query->result();
	}

	function getDataPeminjamanByIdTagihan($id){
        $this->db->select('*');
        $this->db->from('peminjaman');
		$this->db->join('mahasiswa','peminjaman.id_peminjam = mahasiswa.id_mahasiswa','left');
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		$this->db->join('waktu','peminjaman.jam_mulai = waktu.id_waktu');
		$this->db->where('peminjaman.id_peminjaman', $id);
		$this->db->where('peminjaman.validasi_akademik', 'pending');
		$this->db->group_by('sarana_peminjaman.id_peminjaman');
		$query=$this->db->get();
		return $query->result();
	}

	function getDataPeminjamanUntukControllerTagihan($id){
        $this->db->select('*');
        $this->db->from('peminjaman');
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		$this->db->where('sarana_peminjaman.id_peminjaman', $id);
		$query=$this->db->get();
		return $query->result();
	}

	function getDataSaranaPeminjamanByIdPeminjaman($id,$jenis){
        $this->db->select('*');
        $this->db->from('peminjaman');
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		$this->db->where('sarana_peminjaman.id_peminjaman', $id);
		$this->db->where('peminjaman.jenis_peminjaman', $jenis);
		$query=$this->db->get();
		return $query->result();
	}
	
	function getDataTagihanByIdPeminjaman($id){
        $this->db->select('*');
        $this->db->from('tagihan');
		$this->db->join('peminjaman','peminjaman.id_peminjaman = tagihan.id_peminjaman');
		$this->db->where('tagihan.id_peminjaman', $id);
		$query=$this->db->get();
		return $query->result();
	}

	function getDataCekPeminjaman(){
		$search = $this->input->get('id_peminjaman');
		$this->db->select('*');       
		 $this->db->from('peminjaman');

		$this->db->join('mahasiswa','peminjaman.id_peminjam = mahasiswa.id_mahasiswa','left');
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman','left');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		$this->db->join('waktu','peminjaman.jam_mulai = waktu.id_waktu');
		if($search != NULL){
			$this->db->where('peminjaman.id_peminjaman', $search);
			$this->db->or_where('peminjaman.id_peminjam', $search);
			$this->db->or_where('peminjaman.penyelenggara', $search);
		}		$this->db->group_by('peminjaman.id_peminjaman');

		$query=$this->db->get();
		if($this->db->affected_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	function getDataPeminjaman($number,$offset){
		$operator = $this->session->userdata('username');
		$search = $this->input->get('search');
		$status = $this->input->get('status');
		$statusa = $this->input->get('statusa');
		$pengguna = $this->input->get('pengguna');
		$bulan = $this->input->get('bulan');
		$tahun = $this->input->get('tahun');
		$penyelenggara = $this->input->get('penyelenggara');
		$jenis = $this->input->get('jenis');
		$tgl_mulai = $this->input->get('tgl_mulai');
		$tgl_selesai = $this->input->get('tgl_selesai');
		$status_pembayaran = $this->input->get('status_pembayaran');
        $this->db->select('*');
		$this->db->join('mahasiswa','peminjaman.id_peminjam = mahasiswa.id_mahasiswa','left');
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman','left');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		$this->db->join('waktu','peminjaman.jam_mulai = waktu.id_waktu');
		$this->db->where('peminjaman.validasi_akademik !=', 'pending');
		if($search != NULL){
			$this->db->like('peminjaman.id_peminjaman', $search);
			$this->db->like('peminjaman.penyelenggara', $search);
			$this->db->like('ruangan.nama_ruangan', $search);
			$this->db->like('barang.nama_barang', $search);
			$this->db->like('waktu.nama_waktu', $search);
			$this->db->like('peminjaman.id_peminjam', $search);
			$this->db->like('mahasiswa.nama_mahasiswa', $search);
			$this->db->like('peminjaman.keterangan', $search);
		}
		if($this->session->userdata('status') == "staff pelayanan" ){
			$this->db->where('ruangan.id_operator',$operator);
			$this->db->or_where('barang.id_operator',$operator);

		}
		
		if($this->session->userdata('status') == "pengguna"){
			$this->db->where('peminjaman.id_peminjam',$this->session->userdata('username'));
		}

		
		if($status != NULL){
			$this->db->where('peminjaman.validasi_akademik',$status);
		}

		
		if($statusa != NULL){
			$this->db->where('peminjaman.validasi_akademik',$statusa);
		}
		
		if($status_pembayaran != NULL){
			$this->db->where('peminjaman.status_pembayaran',$status_pembayaran);
		}
		if($jenis != NULL){
			$this->db->where('peminjaman.jenis_peminjaman',$jenis);
		}
		if($pengguna != NULL){
			$this->db->where('peminjaman.id_peminjam', $search);
			$this->db->or_where('mahasiswa.nama_mahasiswa', $search);
		}
		if($penyelenggara != NULL){
			$this->db->where('peminjaman.penyelenggara',$penyelenggara);
		}
		if($status != NULL){
			$this->db->where('peminjaman.validasi_akademik',$status);
		}
		if($tgl_mulai != null && $tgl_selesai != null ){
			$this->db->where('peminjaman.tanggal_mulai_penggunaan >= ', $tgl_mulai);
			$this->db->where('peminjaman.tanggal_mulai_penggunaan <= ', $tgl_selesai);
		}
		if($tgl_mulai != null && $tgl_selesai == null){
			$this->db->where('peminjaman.tanggal_mulai_penggunaan', $tgl_mulai);
		}

		
		if($bulan != null ){
			$this->db->where('date_format(peminjaman.tanggal_peminjaman,"%m")', $bulan);
		}
		if($tahun != null){
			$this->db->where('YEAR(peminjaman.tanggal_peminjaman)',$tahun);
		}
		$this->db->group_by('peminjaman.id_peminjaman');
		$this->db->order_by('peminjaman.tanggal_peminjaman','desc');
		$this->db->where('peminjaman.validasi_akademik !=', 'pending');
		$query = $this->db->get('peminjaman',$number,$offset);
		return 	$query->result();	
	}

	function getDataDetailPeminjaman($id_peminjaman){
		$operator = $this->session->userdata('username');
        $this->db->select('*');
        $this->db->from('peminjaman');
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman','left');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		$this->db->join('waktu','waktu.id_waktu = peminjaman.jam_mulai','left');

		$this->db->where('peminjaman.id_peminjaman',$id_peminjaman);
		if($this->session->userdata('status') == "staff pelayanan" ){
			$this->db->where('ruangan.id_operator',$operator);
			$this->db->or_where('barang.id_operator',$operator);

		}


		$query=$this->db->get();
		return 	$query->result();	
	}

	function getSaranaPeminjamanByOperator($id,$jenis){
		$operator = $this->session->userdata('username');
        $this->db->select('*');
        $this->db->from('sarana_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		if($jenis == 'ruangan'){
			$this->db->where('ruangan.id_operator', $operator);
		}else{
			$this->db->where('barang.id_operator', $operator);
		}
        $this->db->where('sarana_peminjaman.id_peminjaman', $id);
		$query=$this->db->get();
		return $query->result();
	}

	function jumlahDataPeminjaman(){
		$bulan = $this->input->get('bulan');
		$tahun = $this->input->get('tahun');
		$operator = $this->session->userdata('username');
		$search = $this->input->get('search');
		$status = $this->input->get('status');
		$pengguna = $this->input->get('pengguna');
		$penyelenggara = $this->input->get('penyelenggara');
		$jenis = $this->input->get('jenis');
		$tgl_mulai = $this->input->get('tgl_mulai');
		$tgl_selesai = $this->input->get('tgl_selesai');
		$status_pembayaran = $this->input->get('status_pembayaran');
        $this->db->select('*');
		$this->db->join('mahasiswa','peminjaman.id_peminjam = mahasiswa.id_mahasiswa');
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		$this->db->join('waktu','peminjaman.jam_mulai = waktu.id_waktu');
		if($search != NULL){
			$this->db->like('peminjaman.id_peminjaman', $search);
			$this->db->or_like('peminjaman.penyelenggara', $search);
			$this->db->or_like('peminjaman.keterangan', $search);
			$this->db->or_like('ruangan.nama_ruangan', $search);
			$this->db->or_like('barang.nama_barang', $search);
			$this->db->or_like('waktu.nama_waktu', $search);
			$this->db->or_like('peminjaman.id_peminjam', $search);
			$this->db->or_like('mahasiswa.nama_mahasiswa', $search);
		}
		if($this->session->userdata('status') == "staff pelayanan" || $this->session->userdata('status') == "admin"){
			$this->db->where('ruangan.id_operator',$operator);
			$this->db->or_where('barang.id_operator',$operator);
		}
		
		if($this->session->userdata('status') == "pengguna"){
			$this->db->where('peminjaman.id_peminjam',$this->session->userdata('username'));
		}

		
		if($status_pembayaran != NULL){
			$this->db->where('peminjaman.status_pembayaran',$status_pembayaran);
		}
		if($status != NULL){
			$this->db->where('peminjaman.validasi_akademik',$status);
		}
		if($jenis != NULL){
			$this->db->where('peminjaman.jenis_peminjaman',$jenis);
		}
		if($pengguna != NULL){
			$this->db->or_like('peminjaman.id_peminjam', $search);
			$this->db->or_like('mahasiswa.nama_mahasiswa', $search);
		}
		if($penyelenggara != NULL){
			$this->db->or_like('peminjaman.penyelenggara',$penyelenggara);
		}
		if($status != NULL){
			$this->db->where('peminjaman.validasi_akademik',$status);
		}
		if($tgl_mulai != null && $tgl_selesai != null ){
			$this->db->where('peminjaman.tanggal_mulai_penggunaan >= ', $tgl_mulai);
			$this->db->where('peminjaman.tanggal_mulai_penggunaan <= ', $tgl_selesai);
		}
		if($tgl_mulai != null && $tgl_selesai == null){
			$this->db->where('peminjaman.tanggal_mulai_penggunaan', $tgl_mulai);
		}
		
		$query = $this->db->get('peminjaman');
		if($this->db->affected_rows() > 0){
			return 	$query->num_rows();	
		}else{
			return false;
		}
	}

	function getDataPeminjamanByMahasiswa(){
		$operator = $this->session->userdata('username');
		$search = $this->input->post('search');
		$status = $this->input->post('status');
        $this->db->select('*');
        $this->db->from('peminjaman');
		$this->db->join('mahasiswa','peminjaman.id_peminjam = mahasiswa.id_mahasiswa');
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		$this->db->join('waktu','waktu.id_waktu = peminjaman.jam_mulai');
		$this->db->where('peminjaman.id_peminjam', $operator);
		if($status != NULL){
			$this->db->where('peminjaman.validasi_akademik',$status);
		}
		if($search != NULL){
			$this->db->like('peminjaman.id_peminjaman', $search);
			$this->db->or_like('peminjaman.tanggal_peminjaman', $search);
			$this->db->or_like('peminjaman.tanggal_mulai_penggunaan', $search);
			$this->db->or_like('peminjaman.penyelenggara', $search);
			$this->db->or_like('peminjaman.keterangan', $search);
		}
		$query=$this->db->get();
		return $query;
	}
	
	function getDetailPeminjaman($id_peminjaman){
        $this->db->select('*');
        $this->db->from('peminjaman');
		$this->db->join('mahasiswa','peminjaman.id_peminjam = mahasiswa.id_mahasiswa','left');
		$this->db->join('waktu','peminjaman.jam_mulai = waktu.id_waktu');
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		
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

		if($jenis_peminjaman == 'ruangan'){
			$this->db->join('ruangan','sarana_peminjaman.id_sarana = ruangan.id_ruangan');
		}else{
			$this->db->join('barang','sarana_peminjaman.id_sarana = barang.id_barang');

		}
		$this->db->where('peminjaman.tanggal_mulai_penggunaan <=',$tanggal);
		$this->db->where('peminjaman.tanggal_selesai_penggunaan >=',$tanggal);
		$this->db->where('peminjaman.validasi_akademik !=','tolak');
		$query=$this->db->get();
		return $query->result();
	}

	function getPenggunaanRuanganByRuangan($jenis_peminjaman,$id_ruangan){
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
		$this->db->where('peminjaman.validasi_akademik !=','tolak');
		$this->db->where('ruangan.id_ruangan ',$id_ruangan);
		$query=$this->db->get();
		return $query->result();
	}

	function getPenggunaanBarangByBarang($jenis_peminjaman,$id_barang){
		$tanggal = $this->input->get('tanggal');
		if($tanggal == NULL){
			$tanggal = date("Y-m-d");
		}else{
			$tanggal = $tanggal;
		}
        $this->db->select('*');
        $this->db->from('peminjaman');
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('barang','sarana_peminjaman.id_sarana = barang.id_barang');
		$this->db->where('peminjaman.tanggal_mulai_penggunaan <=',$tanggal);
		$this->db->where('peminjaman.tanggal_selesai_penggunaan >=',$tanggal);
		$this->db->where('peminjaman.validasi_akademik !=','tolak');
		$this->db->where('barang.id_barang ',$id_barang);
		$query=$this->db->get();
		return $query->result();
	}

	function getSaranaPeminjamanById($id_peminjaman, $jenis_peminjaman){
        $this->db->select('*');
        $this->db->from('peminjaman');
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		if($jenis_peminjaman == "kelas"){
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
        $this->db->select('*');
        $this->db->from('peminjaman');
		$this->db->where('id_peminjaman',$id_peminjaman);
		$query=$this->db->get();
		if($this->db->affected_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function getRuanganTersedia($id_peminjam, $tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai){
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
		AND
		((peminjaman.validasi_akademik = 'setuju'))
		OR
		((peminjaman.id_peminjam = '$id_peminjam'))
		)"
		, NULL, FALSE);	
		if($this->session->userdata("logged_in") == false){
			$this->db->where('ruangan.jenis_ruangan','umum');

		}
		$this->db->order_by('ruangan.nama_ruangan');
		$query = $this->db->get();
		return $query->result();
	}

	function getBarangTersedia($id_peminjam, $tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai){
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
		AND
		((peminjaman.validasi_akademik = 'setuju'))
		OR
		((peminjaman.id_peminjam = '$id_peminjam'))
		)"
		, NULL, FALSE);		

		$query = $this->db->get();
		return $query->result();
	}

	function getDataPeminjamanNonKelasByDate($tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai){
		$this->db->select('*');
		$this->db->select('jam_mulai as jmp');
		$this->db->select('jam_selesai as jsp');
		$this->db->select('jam_mulai_acara as jma');
		$this->db->select('jam_selesai_acara as jsa');
        $this->db->from('peminjaman');
		$this->db->join('mahasiswa','peminjaman.id_peminjam = mahasiswa.id_mahasiswa','left');
		$this->db->where('peminjaman.tanggal_mulai_penggunaan',$tanggal_mulai_penggunaan);
		$this->db->where('peminjaman.tanggal_selesai_penggunaan',$tanggal_selesai_penggunaan);
		$this->db->where('peminjaman.jam_mulai',$jam_mulai);
		$this->db->where('peminjaman.jam_selesai',$jam_selesai);
		$query=$this->db->get();
		return $query->result();
	}

	function getRuanganPeminjamanNonKelasByDate($tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai){
		$this->db->select('sarana_peminjaman.id_sarana, ruangan.nama_ruangan, ruangan.id_operator');
        $this->db->from('peminjaman');
		$this->db->join('sarana_peminjaman','sarana_peminjaman.id_peminjaman = peminjaman.id_peminjaman','left');
		$this->db->join('ruangan','sarana_peminjaman.id_sarana = ruangan.id_ruangan','left');
		$this->db->where('peminjaman.tanggal_mulai_penggunaan',$tanggal_mulai_penggunaan);
		$this->db->where('peminjaman.tanggal_selesai_penggunaan',$tanggal_selesai_penggunaan);
		$this->db->where('peminjaman.jam_mulai',$jam_mulai);
		$this->db->where('peminjaman.jam_selesai',$jam_selesai);
		$query=$this->db->get();
		return $query->result();
	}

	function getBarangPeminjamanBarangByDate($tanggal_mulai_penggunaan, $tanggal_selesai_penggunaan, $jam_mulai, $jam_selesai){
		$this->db->select('sarana_peminjaman.id_sarana, barang.nama_barang, barang.id_operator');
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
		$search = $this->input->post('search');
        $this->db->select('*');
		$this->db->from('peminjaman');
		$this->db->join('mahasiswa','peminjaman.id_peminjam = mahasiswa.id_mahasiswa');
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		$this->db->join('waktu','peminjaman.jam_mulai = waktu.id_waktu');
		if($status != NULL){
			$this->db->where('peminjaman.validasi_akademik',$status);
		}if($search != NULL){
			$this->db->like('peminjaman.id_peminjaman', $search);
			$this->db->or_like('peminjaman.tanggal_peminjaman', $search);
			$this->db->or_like('peminjaman.tanggal_mulai_penggunaan', $search);
			$this->db->or_like('peminjaman.penyelenggara', $search);
			$this->db->or_like('peminjaman.keterangan', $search);
		}
		$query=$this->db->get();
		return $query;
	}



	function getDataHargaSewaPeminjaman($id_peminjaman){
        $this->db->select('*');
		$this->db->from('peminjaman');
		$this->db->join('mahasiswa','peminjaman.id_peminjam = mahasiswa.id_mahasiswa');
		$this->db->join('sarana_peminjaman','peminjaman.id_peminjaman = sarana_peminjaman.id_peminjaman');
		$this->db->join('ruangan','ruangan.id_ruangan = sarana_peminjaman.id_sarana','left');
		$this->db->join('barang','barang.id_barang = sarana_peminjaman.id_sarana','left');
		$this->db->join('waktu','peminjaman.jam_mulai = waktu.id_waktu');
		$this->db->where('peminjaman.id_peminjaman',$id_peminjaman);
		$query=$this->db->get();
		return $query->result();

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