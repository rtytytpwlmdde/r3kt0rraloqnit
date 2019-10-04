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
            <div class="py-5 text-center">
              <h2>Cek Peminjaman</h2>
              <p class="lead">Silahkan isi form berikut mengetahui status peminjaman.</p>
            </div>
          
            <div class="row">
              <div class="col-md-12 order-md-1">
                <form  action="<?php echo base_url().'Peminjaman/cekPeminjaman'; ?>" method="get" >
                  <div class="row">
                    <div class="col-md-12 mb-3">
                      <label for="">ID Peminjaman</label>
                      <input type="text" required name="id_peminjaman" class="form-control">
                    </div>
                  </div>
                  <hr class="mb-4">
                  <button class="btn btn-primary btn-lg btn-block text-white" type="submit" >Cek Peminjaman</button>
                </form>
              </div>
            </div>
          
            
          </div>