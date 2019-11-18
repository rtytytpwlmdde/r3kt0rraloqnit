<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_Rekap');
		$this->load->model('M_SaranaPrasarana');
		$this->load->model('M_User');
		$this->load->model('m_peminjaman');
		if($this->session->userdata('logged_in') == FALSE || $this->session->userdata('status') != 'admin'){
				redirect("auth/logout");
		}
	}
    
    function dashboard(){
			$tahun = $this->input->get('tahun');
			if($tahun == NULL){
				$tahun = date("Y");
			}
			$data['tahun'] = $tahun;
			$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
			$data['peminjamanSetujuPerbulan'] = $this->M_Rekap->getDataRekapPeminjamanSetujuPerbulan();
			$data['peminjamanSetujuPertahun'] = $this->M_Rekap->getDataRekapPeminjamanSetujuPertahun();
			$data['peminjamanTerkirimPerbulan'] = $this->M_Rekap->getDataRekapPeminjamanTerkirimPerbulan();
			$data['peminjamanTerkirimPertahun'] = $this->M_Rekap->getDataRekapPeminjamanTerkirimPerTahun();
			$data['peminjamanTolakPerbulan'] = $this->M_Rekap->getDataRekapPeminjamanTolakPerbulan();
			$data['peminjamanTolakPertahun'] = $this->M_Rekap->getDataRekapPeminjamanTolakPertahun();
			
			$data['peminjamanPerBulan'] = $this->M_Rekap->getDataRekapPeminjamanPerbulan();
			$data['peminjamanPertahun'] = $this->M_Rekap->getDataRekapPeminjamanPertahun();
			$data['setuju'] = $this->M_Rekap->getDataRekapPeminjamanSetujuPerbulan();

			$data['jumlahRuangan'] = $this->M_SaranaPrasarana->getJumlahRuangan();
			$data['jumlahBarang'] = $this->M_SaranaPrasarana->getJumlahBarang();
			$data['jumlahMahasiswa'] = $this->M_User->getJumlahMahasiswa();
			$data['jumlahDosen'] = $this->M_User->getJumlahDosen();
			$data['jumlahOperator'] = $this->M_User->getJumlahOperator();
			$data['jumlahLembaga'] = $this->M_User->getJumlahLembaga();
			$data['jumlahUser'] = $this->M_User->getCountUserBaru();
			$data['main_view'] = 'rekap/V_Dashboard';
			$this->load->view('template/template_operator',$data);
		}
		
	function rekapPeminjaman(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$data['tahun'] = $tahun;
		$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
		$data['peminjamanPerBulan'] = $this->M_Rekap->getDataRekapPeminjamanPerbulan();
		$data['peminjamanPertahun'] = $this->M_Rekap->getDataRekapPeminjamanPertahun();
		$data['peminjamanLunasPerBulan'] = $this->M_Rekap->getDataRekapPeminjamanLunasPerbulan();
		$data['peminjamanLunasPertahun'] = $this->M_Rekap->getDataRekapPeminjamanLunasPertahun();
		$data['peminjamanBelumBayarPerBulan'] = $this->M_Rekap->getDataRekapPeminjamanBelumBayarPerbulan();
		$data['peminjamanBelumBayarPertahun'] = $this->M_Rekap->getDataRekapPeminjamanBelumBayarPertahun();
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['main_view'] = 'Rekap/V_RekapPeminjaman';
		$this->load->view('template/template_operator',$data);
	}

	function rekapPemakaianRuangan(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$data['tahun'] = $tahun;
		$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
		$data['ruanganPerBulan'] = $this->M_Rekap->getDataRekapPemakaianRuanganPerBulan();
		$data['ruanganPerTahun'] = $this->M_Rekap->getDataRekapPemakaianRuanganPerTahun();
        $data['ruangan'] = $this->M_SaranaPrasarana->getDataRuangan()->result();
				$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['main_view'] = 'Rekap/V_RekapPemakaianRuangan';
		$this->load->view('template/template_operator',$data);
	}

	function rekapPemakaianBarang(){
		$tahun = $this->input->get('tahun');
		if($tahun == NULL){
			$tahun = date("Y");
		}
		$data['tahun'] = $tahun;
		$data['jumlahPeminjaman'] = $this->m_peminjaman->getCountPeminjamanTerkirim();
		$data['jumlahUser'] = $this->M_User->getCountUserBaru();
		$data['barangPerBulan'] = $this->M_Rekap->getDataRekapPemakaianBarangPerBulan();
		$data['barangPerTahun'] = $this->M_Rekap->getDataRekapPemakaianBarangPerTahun();
        $data['barang'] = $this->M_SaranaPrasarana->getDataBarang();
		$data['main_view'] = 'Rekap/V_RekapPemakaianBarang';
		$this->load->view('template/template_operator',$data);
	}
  
  public function exportHistoryPeminjaman(){
			// Load plugin PHPExcel nya
			include APPPATH.'third_party/PHPExcel/PHPExcel.php';
			
			// Panggil class PHPExcel nya
			$excel = new PHPExcel();
			// Settingan awal fil excel
			$excel->getProperties()->setCreator('My Notes Code')
									->setLastModifiedBy('My Notes Code')
									->setTitle("Data Transaksi")
									->setSubject("Transaksi")
									->setDescription("Laporan Data Transaksi")
									->setKeywords("Data Transaksi");
			// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
			$style_col = array(
				'font' => array('bold' => true), // Set font nya jadi bold
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
				),
				'borders' => array(
					'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
					'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
					'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
					'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
				)
			);
			// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
			$style_row = array(
				'alignment' => array(
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
				),
				'borders' => array(
					'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
					'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
					'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
					'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
				)
			);
			$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA INVOICE TRANSAKSI"); // Set kolom A1 dengan tulisan "DATA SISWA"
			$excel->getActiveSheet()->mergeCells('A1:J1'); // Set Merge Cell pada kolom A1 sampai E1
			$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
			$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
			$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
			// Buat header tabel nya pada baris ke 3
			$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
			$excel->setActiveSheetIndex(0)->setCellValue('B3', "Kode Boking"); // Set kolom B3 dengan tulisan "NIS"
			$excel->setActiveSheetIndex(0)->setCellValue('C3', "NIM NIP"); // Set kolom C3 dengan tulisan "NAMA"
			$excel->setActiveSheetIndex(0)->setCellValue('D3', "TANGGAL PEMINJAMAN"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
			$excel->setActiveSheetIndex(0)->setCellValue('E3', "TANGGAL PENGGUNAAN"); // Set kolom E3 dengan tulisan "ALAMAT"
			$excel->setActiveSheetIndex(0)->setCellValue('F3', "JAM PENGGUNAAN"); // Set kolom E3 dengan tulisan "ALAMAT"
			$excel->setActiveSheetIndex(0)->setCellValue('G3', "RUANGAN"); // Set kolom E3 dengan tulisan "ALAMAT"
			$excel->setActiveSheetIndex(0)->setCellValue('H3', "PENYELENGGARA"); // Set kolom E3 dengan tulisan "ALAMAT"
			$excel->setActiveSheetIndex(0)->setCellValue('I3', "KETERANGAN"); // Set kolom E3 dengan tulisan "ALAMAT"
			$excel->setActiveSheetIndex(0)->setCellValue('J3', "VALIDASI"); // Set kolom E3 dengan tulisan "ALAMAT"
			$excel->setActiveSheetIndex(0)->setCellValue('K3', "CATATAN"); // Set kolom E3 dengan tulisan "ALAMAT"
			// Apply style header yang telah kita buat tadi ke masing-masing kolom header
			$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
			$excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
			// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $waktu = $this->m_peminjaman->getDataWaktu()->result();
			if($this->session->userdata('status') == "staff pelayanan"){
				$peminjaman = $this->m_peminjaman->getDataPeminjaman("nonkelas")->result();
			}else {
				$peminjaman = $this->m_peminjaman->getDataPeminjamanNonKelasBarang()->result();
			}
			$no = 1; // Untuk penomoran tabel, di awal set dengan 1
			$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
			$start = null; $end = null;
			foreach($peminjaman as $data){ // Lakukan looping pada variabel siswa
				$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
				$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->id_peminjaman);
				$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->id_peminjam);
				$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->tanggal_peminjaman);
				$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->tanggal_mulai_penggunaan);
				foreach($waktu as $w){
					if($w->id_waktu == $data->jam_mulai){
							$mulai = explode("-", $w->nama_waktu);
							$start = $mulai[0];
					}
					if($w->id_waktu == $data->jam_selesai){
							$selesai = explode("-", $w->nama_waktu);
							$end = $selesai[1];
					}
				}
				$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $start.'-'.$end);
				$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->nama_ruangan);
				$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->penyelenggara);
				$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->keterangan);
				$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->validasi_akademik);
				$excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->catatan_penolakan);
				
				// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
				$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
				
				$no++; // Tambah 1 setiap kali looping
				$numrow++; // Tambah 1 setiap kali looping
			}
			// Set width kolom
			$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
			$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
			$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
			$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
			$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
			$excel->getActiveSheet()->getColumnDimension('F')->setWidth(30); // Set width kolom E
			$excel->getActiveSheet()->getColumnDimension('G')->setWidth(30); // Set width kolom E
			$excel->getActiveSheet()->getColumnDimension('H')->setWidth(30); // Set width kolom E
			$excel->getActiveSheet()->getColumnDimension('I')->setWidth(30); // Set width kolom E
			$excel->getActiveSheet()->getColumnDimension('J')->setWidth(30); // Set width kolom E
			$excel->getActiveSheet()->getColumnDimension('K')->setWidth(30); // Set width kolom E
			// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
			$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
			// Set orientasi kertas jadi LANDSCAPE
			$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
			// Set judul file excel nya
			$excel->getActiveSheet(0)->setTitle("Laporan Data Peminjaman Ruangan");
			$excel->setActiveSheetIndex(0);
			// Proses file excel
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment; filename="DATA PEMINJAMAN RUANGAN.xlsx"'); // Set nama file excel nya
			header('Cache-Control: max-age=0');
			$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
			$write->save('php://output');
		}

		


}
