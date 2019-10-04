<?php if($this->session->userdata('status') == "pengguna"){ ?>
    <div class="container">
<?php }else{?><div class="">
<?php }?>
  <div class="row mt-4 ml-2">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Pilih Ruangan</span>
        <a  data-toggle="modal" data-target="#modalPanduan"><span class="" title="panduan"><i class="far fa-question-circle"></i></span></a>
      </h4>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0"></h6>
            <small class="text-muted">Ruangan yang dapat dipinjam akan tampil setelah form data peminjaman diisi dan user telah menekan tombol "Lanjut ke proses selanjutnya"</small>
          </div>
          <span class="text-muted"></span>
        </li>
      </ul>

    
    </div>
    <div class="col-md-8 order-md-1 card shadow mb-2 pb-2">
      <h4 class="mb-3">Form Data Peminjaman</h4>
      <form class="user" action="<?php echo base_url().'peminjaman/tambahPeminjaman'; ?>" method="post">
            <div class="form-group">
                <label for="exampleFormControlSelect1">NIM Peminjam</label>
                <input type="text"  required name="id_peminjam" class="form-control " placeholder="masukkan nim/nik sebagai identitas peminjam">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Tanggal Penggunaan</label>
                <input type="date"  required name="tanggal_mulai_penggunaan" class="form-control " placeholder="masukkan nim/nik sebagai identitas peminjam">
            </div>
            <div class="row">
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Jam Mulai</label>
                    <select name="jam_mulai" required class="form-control" id="exampleFormControlSelect1">
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
                    <label for="exampleFormControlSelect1">Jam Selesai</label>
                    <select name="jam_selesai" required class="form-control" id="exampleFormControlSelect1">
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
            <div class="form-group">
                <label for="exampleFormControlSelect1">Penyelenggara</label>
                <input type="text"  required name="penyelenggara" class="form-control " placeholder="masukkan nama lengkap penyelenggara acara">
            </div>
            <div class="form-group">
                <label for="">Keterangan</label>
                <textarea class="form-control"  name="keterangan" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Lanjut ke proses selanjutnya
            </button>
        </form> 
      
    </div>
  </div>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">© 2017-2019 Company Name</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer>
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