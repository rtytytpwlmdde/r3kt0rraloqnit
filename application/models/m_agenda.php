<?php 

class M_agenda extends CI_Model{
    
	function getDataAgenda(){
				$search = $this->input->get('search');
				$start = $this->input->get('start');
				$end = $this->input->get('end');
				$date = date("Y-m-d");
        $this->db->select('*');
        $this->db->from('peminjaman');
				$this->db->join('waktu','peminjaman.jam_mulai = waktu.id_waktu');
				$this->db->join('sarana_peminjaman','sarana_peminjaman.id_peminjaman = peminjaman.id_peminjaman');
				$this->db->join('ruangan','sarana_peminjaman.id_sarana = ruangan.id_ruangan');
				$this->db->where('peminjaman.validasi_akademik','setuju');
				$this->db->where('peminjaman.jenis_peminjaman','ruangan');
				if($search != null){
					$this->db->like('peminjaman.id_peminjaman',$search);
					$this->db->or_like('peminjaman.id_peminjam', $search);
					$this->db->or_like('peminjaman.penyelenggara', $search);
					$this->db->or_like('peminjaman.keterangan', $search);
					$this->db->or_like('ruangan.nama_ruangan', $search);
					$this->db->or_like('waktu.nama_waktu', $search);
				}	
				if($start != null){
					if($end != null){
						$this->db->where('peminjaman.tanggal_mulai_penggunaan >=',$start);
						$this->db->where('peminjaman.tanggal_mulai_penggunaan <=',$end);
					}else{
						$this->db->where('peminjaman.tanggal_mulai_penggunaan',$start);
					}
				}else{
					$this->db->where('peminjaman.tanggal_mulai_penggunaan >=',$date);
				}
				$query=$this->db->get();
				return $query;
    }
    

}