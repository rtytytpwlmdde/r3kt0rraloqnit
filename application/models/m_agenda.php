<?php 

class M_agenda extends CI_Model{
    
	function getDataAgenda(){
        $this->db->select('*');
        $this->db->from('peminjaman');
		$this->db->join('semester','peminjaman.id_semester = semester.id_semester');
		$this->db->join('mahasiswa','peminjaman.id_peminjam = mahasiswa.id_mahasiswa');
		$this->db->join('program_studi','peminjaman.id_program_studi = program_studi.id_program_studi');
		$this->db->join('dosen','peminjaman.id_dosen = dosen.id_dosen');
		$this->db->join('matakuliah','peminjaman.id_matakuliah = matakuliah.id_matakuliah');
		$query=$this->db->get();
		return $query;
    }
    

}