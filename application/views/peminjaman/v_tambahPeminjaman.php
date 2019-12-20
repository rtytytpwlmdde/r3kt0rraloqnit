<?php if($this->session->userdata('status') == "pengguna" || $this->session->userdata('logged_in') == FALSE){ ?>
    <div class="container">
<?php }else{?><div class="">
<?php }?>
<?php
        $gagal = $this->session->flashdata('gagal');
        if($gagal != NULL){
            echo '
            <div class="alert alert-danger alert-dismissible fade show bg-danger text-white" role="alert">
              <strong></strong> '.$gagal.'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            ';
        }
        $sukses = $this->session->flashdata('sukses');
        if($sukses != NULL){
            echo '
            <div class="alert alert-success alert-dismissible fade show bg-success text-white" role="alert">
              <strong></strong> '.$sukses.'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            ';
        }
    ?>
  <div class="row mt-4 ">
    


    <div class="col-md-4 order-md-2 mb-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3 bg-thead text-white">
          <h6 class="m-0 font-weight-bold  d-flex justify-content-between">Pilih <?= $jenis_peminjaman?> 
            <a  data-toggle="modal" data-target="#modalPanduan"><span class="" title="panduan"><i class="far fa-question-circle"></i></span></a></h6>
        </div>
        <div class="card-body">
          <small class="text-muted">Ruangan yang dapat dipinjam akan tampil setelah form data peminjaman diisi dan user telah menekan tombol "Lanjut ke proses selanjutnya"</small>
        </div>
      </div>
    </div>
    


    <div class="col-md-8 order-md-1 mb-2 pb-2">
      <div class="card shadow mb-4">
        <div class="card-header py-3 bg-thead text-white">
          <h6 class="m-0 font-weight-bold ">Form Data Peminjaman</h6>
        </div>
        <div class="card-body">
          <form class="user" action="<?php echo base_url().'index.php?/Peminjaman/tambahPeminjaman'; ?>" method="post" enctype="multipart/form-data">
          
                <?php if($this->session->userdata('logged_in') == FALSE){ ?>
                  <div class="form-group">
                  <label for="exampleFormControlSelect1">Pengguna</label>
                  <input type="text"   name="nama_peminjam" class="form-control " value="">
                  </div>
                <?php }else{ ?>
                  <div class="form-group">
                    <label for="exampleFormControlSelect1">Pengguna</label>                    
                    <input type="text"  hidden name="nama_peminjam" class="form-control " value="<?= $this->session->userdata('username')?>">

                    <input type="text"  disabled name="" class="form-control " value="<?= $this->session->userdata('username')?>">
                    <input type="text"  hidden name="id_peminjam" class="form-control " value="<?= $this->session->userdata('username')?>">
                  </div>
                <?php }?>
              <input type="text"   hidden name="jenis_peminjaman" class="form-control " value="<?= $jenis_peminjaman?>">
              <div class="form-group">
                  <label for="exampleFormControlSelect1">NIM/NIK/NIP</label>
                  <input type="text"   name="id_peminjam" class="form-control " value="">
                  <small>Silahkan isi dengan tanda "-" tanpa kutip, jika tidak mempunyai</small>
                </div>

            <div class="shadow-none p-3 mb-3 bg-light rounded ">
            
                <div class="row">
                  <div class="col-md-12 mb-3">
                      <div class="form-group">
                          <h5 class="text-dark">Tanggal Dan Jam Penggunaan Ruangan</h5>
                          <small>Input tanggal dan jam berapa ruangan akan digunakan</small>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                      <div class="form-group">
                          <label for="exampleFormControlSelect1">Tanggal Mulai Penggunaan Ruangan</label>
                          <input type="date" class="form-control" name="tanggal_mulai_penggunaan">
                      </div>
                  </div>
                  <div class="col-md-6 mb-3">
                      <div class="form-group">
                          <label for="exampleFormControlSelect1">Tanggal Selesai Penggunaan Ruangan</label>
                          <input type="date" class="form-control" name="tanggal_selesai_penggunaan">
                      </div>
                  </div>
                </div>
                
              <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Jam Mulai Penggunaan Ruangan</label>
                        <select name="jam_mulai_penggunaan" required class="form-control" id="exampleFormControlSelect1">
                                <?php foreach ($waktu as $u) { 
                                  $pieces = explode("-", $u->nama_waktu);
                                  $start = $pieces[0];
                                  $end = $pieces[1];
                                  ?>
                                <option value="<?= $u->id_waktu ?>">
                                <?= $start?>
                                </option>
                            <?php } ?>         
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Jam Selesai Penggunaan Ruangan</label>
                        <select name="jam_selesai_penggunaan" required class="form-control" id="exampleFormControlSelect1">
                          <?php foreach ($waktu as $u) { 
                                  $pieces = explode("-", $u->nama_waktu);
                                  $start = $pieces[0];
                                  $end = $pieces[1];
                                  ?>
                                <option value="<?= $u->id_waktu ?>">
                                <?= $end?>
                                </option>
                            <?php } ?>        
                        </select>
                    </div>
                </div>
              </div>
            </div>

            
            <div class="shadow-none p-3 mb-3 bg-light rounded ">
            
                <div class="row">
                  <div class="col-md-12 mb-3">
                      <div class="form-group">
                          <h5 class="text-dark">Tanggal Dan Jam Acara</h5>
                          <small>Input tanggal dan jam berapa pelaksanaan acara saat menggunakan ruangan</small>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                      <div class="form-group">
                          <label for="exampleFormControlSelect1">Tanggal Mulai Acara</label>
                          <input type="date" class="form-control" name="tanggal_mulai_acara">
                      </div>
                  </div>
                  <div class="col-md-6 mb-3">
                      <div class="form-group">
                          <label for="exampleFormControlSelect1">Tanggal Selesai Acara</label>
                          <input type="date" class="form-control" name="tanggal_selesai_acara">
                      </div>
                  </div>
                </div>
                
              <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Jam Mulai Acara</label>
                        <select name="jam_mulai_acara" required class="form-control" id="exampleFormControlSelect1">
                                <?php foreach ($waktu as $u) { 
                                  $pieces = explode("-", $u->nama_waktu);
                                  $start = $pieces[0];
                                  $end = $pieces[1];
                                  ?>
                                <option value="<?= $u->id_waktu ?>">
                                <?= $start?>
                                </option>
                            <?php } ?>         
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Jam Selesai Acara</label>
                        <select name="jam_selesai_acara" required class="form-control" id="exampleFormControlSelect1">
                          <?php foreach ($waktu as $u) { 
                                  $pieces = explode("-", $u->nama_waktu);
                                  $start = $pieces[0];
                                  $end = $pieces[1];
                                  ?>
                                <option value="<?= $u->id_waktu ?>">
                                <?= $end?>
                                </option>
                            <?php } ?>        
                        </select>
                    </div>
                </div>
              </div>
            </div>


            <div class="form-group">
                <label for="exampleFormControlSelect1">Nama Instanasi</label>
                <select name="penyelenggara" required class="form-control" id="exampleFormControlSelect1">
                          <option value="">Pilih.. </option>
                          <?php foreach ($lembaga as $u) { ?>
                                <option value="<?= $u->nama_lembaga ?>">
                                <?= $u->nama_lembaga?>
                                </option>
                            <?php } ?>        
                        </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">No Hp / WA</label>
                <input type="text"  required name="nomor_telpon" class="form-control " placeholder="ex: 081358xxxx">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Nama Kegiatan</label>
                <input type="text"  required name="keterangan" class="form-control ">
            </div>
            <div class="form-group">
                <label for="">Lampiran surat tugas atau surat peminjaman</label>
                <input type="file"  required name="file_peminjaman" class="form-control " >          
               <?php if($this->session->userdata('logged_in') == FALSE){?>
                <input type="hidden"  required name="jenis_sarana" class="pinjam">
              <?php }else{ ?>
                <input type="hidden"  required name="jenis_sarana" class="sewa">
              <?php }?>
            </div>
            <?php if($this->session->userdata('status_validasi') == 'belum divalidasi' || $this->session->userdata('status_validasi') == 'tidak valid'){?>
              <a href="#" class="btn btn-secondary btn-user btn-block">
                  Peminjaman tidak dapat dilakukan, Silahkan validasi akun anda terlebih dahulu dengan menghubungi operator
              </a>
             <?php }else{ ?>
              <button type="submit" class="btn btn-primary btn-user btn-block">
                  Lanjut ke proses selanjutnya
              </button>
            <?php }?>
          </form> 
        </div>
      </div>
    </div>
  </div>

</div>



<div class="modal fade" id="modalPanduan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Panduan Meminjam Ruangan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>Tahapan peminjaman</div>
        <div>
            <p>1. Mengisi form data peminjaman dan menekan tombol Lanjut ke proses selanjutnya</p>
            <p>2. Sistem kemudian menampilkan ruangan yang boleh dipinjamkan</p>
            <p>2. User dapat memilih ruangan dengan menekan tombol plus yang berada disamping nama ruangan</p>
            <p>4. User kemudian menekan tombol kirim peminjaman untuk menyelesaikan proses peminjaman</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>