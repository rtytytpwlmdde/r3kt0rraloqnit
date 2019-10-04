<div class="container">
<?php
        $notif = $this->session->flashdata('notif');
        if($notif != NULL){
            echo '
            <div class="alert alert-danger alert-dismissible fade show bg-danger text-white" role="alert">
              <strong></strong> '.$notif.'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            ';
        }
        $notifsukses = $this->session->flashdata('notifsukses');
        if($notifsukses != NULL){
            echo '
            <div class="alert alert-success alert-dismissible fade show bg-success text-white" role="alert">
              <strong></strong> '.$notifsukses.'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            ';
        }
    ?>
  <div class="row mt-4">
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
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Form Data Peminjaman</h4>
      <form class="user" action="<?php echo base_url().'peminjaman/cekPeminjaman'; ?>" method="get">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Kode Boking</label>
                <input type="text"  required name="id_peminjaman" class="form-control " placeholder="masukkan nim/nik sebagai identitas peminjam">
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Cek Peminjaman
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


