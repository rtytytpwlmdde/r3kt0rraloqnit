<?php 

class M_Complaint extends CI_Model{
	function tambahComplaint($data,$tabel){
		$this->db->insert($tabel,$data);
	}

	function hapusComplaint($id,$tabel){
		$this->db->where($id);
		$this->db->delete($tabel);
	}	
    
	function updateComplaint($id,$data,$tabel){
		$this->db->where($id);
		$this->db->update($tabel,$data);
	}

	function getDataComplaint(){
		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->join('mahasiswa','complaint.id_pelapor = mahasiswa.id_mahasiswa');
		$this->db->join('program_studi','complaint.id_program_studi = program_studi.id_program_studi');
		$this->db->join('ruangan','complaint.id_ruangan = ruangan.id_ruangan');
		$query=$this->db->get();
		return $query;
	}

	function getDataComplaintById($id){
		$this->db->select('*');
		$this->db->from('complaint');
		$this->db->join('mahasiswa','complaint.id_pelapor = mahasiswa.id_mahasiswa');
		$this->db->join('program_studi','complaint.id_program_studi = program_studi.id_program_studi');
		$this->db->join('ruangan','complaint.id_ruangan = ruangan.id_ruangan');
		$this->db->where('complaint.id_complaint', $id);
		$query=$this->db->get();
		if($this->db->affected_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

}