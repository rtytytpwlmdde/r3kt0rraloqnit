<div class="container">
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
    
            <div class="mt-4 text-center">
              <div class="card shadow mb-4">
                <div class="card-header py-3 bg-thead text-white">
                  <h6 class="m-0 font-weight-bold  d-flex justify-content-between">Form Cek Peminjaman </h6>
                </div>
                <div class="card-body">
                  <form  action="<?php echo base_url().'index.php?/Peminjaman/cekPeminjaman'; ?>" method="get" >
                    <div class="row">
                      <div class="col-md-12 mb-3">
                        <label for="">Kode Boking</label>
                        <input type="text" required name="id_peminjaman" class="form-control">
                      </div>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block text-white" type="submit" >Cek Peminjaman</button>
                  </form>
                </div>
              </div>
            </div>
          
            
          
            
          </div>