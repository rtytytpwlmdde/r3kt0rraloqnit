<?php 

class M_SaranaPrasarana extends CI_Model{

    function getDataRuangan(){
			$status = $this->input->post('status');
			$this->db->select('*');
			$this->db->from('ruangan');
			if($status != NULL){
				$this->db->where('status_ruangan', $status);
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