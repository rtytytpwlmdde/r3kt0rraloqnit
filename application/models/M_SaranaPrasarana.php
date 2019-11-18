<?php 

class M_SaranaPrasarana extends CI_Model{

    function getDataRuangan(){
			$status = $this->input->post('status');
			$search = $this->input->get('search');
			$ac = $this->input->get('ac');
			$wifi = $this->input->get('wifi');
			$lcd = $this->input->get('lcd');
			$toilet = $this->input->get('toilet');
			$sound_system = $this->input->get('sound_system');
			$maxKapasitas = $this->input->get('maxKapasitas');
			$minKapasitas = $this->input->get('minKapasitas');
			$maxLuasRuangan = $this->input->get('maxLuasRuangan');
			$minLuasRuangan = $this->input->get('minLuasRuangan');
			$maxRuangKelas = $this->input->get('maxRuangKelas');
			$minRuangKelas = $this->input->get('minRuangKelas');
			$maxPertemuan = $this->input->get('maxPertemuan');
			$minPertemuan = $this->input->get('minPertemuan');
			$maxTeater = $this->input->get('maxTeater');
			$minTeater = $this->input->get('minTeater');
			$maxUshape = $this->input->get('maxUshape');
			$minUshape = $this->input->get('minUshape');
			$this->db->select('*');
			$this->db->from('ruangan');
			if($search != NULL){
				$this->db->like('nama_ruangan', $search);
				$this->db->or_like('deskripsi_ruangan', $search);
			}
			if($ac != NULL){
				$this->db->where('ac', 'ya');
			}
			if($wifi != NULL){
				$this->db->where('wifi', 'ya');
			}
			if($lcd != NULL){
				$this->db->where('lcd', 'ya');
			}
			if($toilet != NULL){
				$this->db->where('toilet', 'ya');
			}
			if($sound_system != NULL){
				$this->db->where('sound_system', 'ya');
			}
			if($minKapasitas != NULL || $maxKapasitas != NULL){
				if($minKapasitas != NULL && $maxKapasitas != NULL){
					$this->db->where('kapasitas >=', $minKapasitas);
					$this->db->where('kapasitas <=', $maxKapasitas);
				}elseif($minKapasitas != NULL && $maxKapasitas == NULL){
					$this->db->where('kapasitas >=', $minKapasitas);
				}elseif($minKapasitas == NULL && $maxKapasitas != NULL){
					$this->db->where('kapasitas <=', $maxKapasitas);
				}
			}
			if($minLuasRuangan != NULL || $maxLuasRuangan != NULL){
				if($minLuasRuangan != NULL && $maxLuasRuangan != NULL){
					$this->db->where('luas_ruangan >=', $minLuasRuangan);
					$this->db->where('luas_ruangan <=', $maxLuasRuangan);
				}elseif($minLuasRuangan != NULL && $maxLuasRuangan == NULL){
					$this->db->where('luas_ruangan >=', $minLuasRuangan);
				}elseif($minLuasRuangan == NULL && $maxLuasRuangan != NULL){
					$this->db->where('luas_ruangan <=', $maxLuasRuangan);
				}
			}
			if($minRuangKelas != NULL || $maxRuangKelas != NULL){
				if($minRuangKelas != NULL && $maxRuangKelas != NULL){
					$this->db->where('ruang_kelas >=', $minRuangKelas);
					$this->db->where('ruang_kelas <=', $maxRuangKelas);
				}elseif($minRuangKelas != NULL && $maxRuangKelas == NULL){
					$this->db->where('ruang_kelas >=', $minRuangKelas);
				}elseif($minRuangKelas == NULL && $maxRuangKelas != NULL){
					$this->db->where('ruang_kelas <=', $maxRuangKelas);
				}
			}
			if($minPertemuan != NULL || $maxPertemuan != NULL){
				if($minPertemuan != NULL && $maxPertemuan != NULL){
					$this->db->where('perjamuan >=', $minPertemuan);
					$this->db->where('perjamuan <=', $maxPertemuan);
				}elseif($minPertemuan != NULL && $maxPertemuan == NULL){
					$this->db->where('perjamuan >=', $minPertemuan);
				}elseif($minPertemuan == NULL && $maxPertemuan != NULL){
					$this->db->where('perjamuan <=', $maxPertemuan);
				}
			}
			if($minTeater != NULL || $maxTeater != NULL){
				if($minTeater != NULL && $maxTeater != NULL){
					$this->db->where('teater >=', $minTeater);
					$this->db->where('teater <=', $maxTeater);
				}elseif($minTeater != NULL && $maxTeater == NULL){
					$this->db->where('teater >=', $minTeater);
				}elseif($minTeater == NULL && $maxTeater != NULL){
					$this->db->where('teater <=', $maxTeater);
				}
			}
			if($minUshape != NULL || $maxUshape != NULL){
				if($minUshape != NULL && $maxUshape != NULL){
					$this->db->where('ushape >=', $minUshape);
					$this->db->where('ushape <=', $maxUshape);
				}elseif($minUshape != NULL && $maxUshape == NULL){
					$this->db->where('ushape >=', $minUshape);
				}elseif($minUshape == NULL && $maxUshape != NULL){
					$this->db->where('ushape <=', $maxUshape);
				}
			}
			$this->db->order_by("jenis_ruangan", "asc");
			$this->db->order_by("nama_ruangan", "asc");
			$query=$this->db->get();
			return $query;
		}
		
		function getDataRuanganKelas(){
			$this->db->select('*');
			$this->db->from('ruangan');
			$this->db->where('jenis_ruangan','kelas');
			$query=$this->db->get();
			return $query;
		}

		function getDataRuanganNonKelas(){
			$this->db->select('*');
			$this->db->from('ruangan');
			$this->db->where('jenis_ruangan','ruangan');
			$this->db->order_by("ruangan.nama_ruangan", "asc");
			$query=$this->db->get();
			return $query->result();
		}

    function tambahRuangan($data,$tabel){
		$this->db->insert($tabel,$data);
    }
    
    function hapusRuangan($id,$tabel){
		$this->db->where($id);
		$this->db->delete($tabel);
    }	
    
	function updateRuangan($id,$data,$tabel){
		$this->db->where($id);
		$this->db->update($tabel,$data);
    }

    function getDataRuanganById($id_ruangan){
		$this->db->select('*');
		$this->db->from('ruangan');
		$this->db->where('id_ruangan',$id_ruangan);
		$query=$this->db->get();
		return $query->result();
    }
    /// barang
    function getDataBarang(){
			$this->db->select('*');
			$this->db->from('barang');
			$this->db->order_by("barang.nama_barang", "asc");
			$query=$this->db->get();
			return $query->result();
    }

    function tambahBarang($data,$tabel){
		$this->db->insert($tabel,$data);
    }
    
    function hapusBarang($id,$tabel){
		$this->db->where($id);
		$this->db->delete($tabel);
    }	
    
		function updateBarang($id,$data,$tabel){
			$this->db->where($id);
			$this->db->update($tabel,$data);
    }

    function getDataBarangById($id_barang){
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->where('id_barang',$id_barang);
		$query=$this->db->get();
		return $query->result();
		}

		function getJumlahBarang(){
			$this->db->select('count(id_barang) as jumBarang');
			$this->db->from('barang');
			$query = $this->db->get();
			return $query->result();
		}

		function getJumlahRuangan(){
			$this->db->select('count(id_ruangan) as jumRuangan');
			$this->db->from('ruangan');
			$query = $this->db->get();
			return $query->result();
		}
		

}