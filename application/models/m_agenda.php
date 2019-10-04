<?php 

class M_agenda extends CI_Model{
    
	function getDataAgenda(){
        $this->db->select('*');
        $this->db->from('peminjaman');
		$this->db->join('waktu','peminjaman.jam_mulai = waktu.id_waktu');
		$this->db->join('sarana_peminjaman','sarana_peminjaman.id_peminjaman = peminjaman.id_peminjaman');
		$this->db->join('ruangan','sarana_peminjaman.id_sarana = ruangan.id_ruangan');
		$query=$this->db->get();
		return $query;
    }
    

}