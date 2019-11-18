<div class="">
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
                  <h6 class="m-0 font-weight-bold  d-flex justify-content-between">Tambah Peminjaman </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-6 text-right">
                        <a class="btn btn-outline-secondary" style="width:300px; height:100px;" href="<?php echo base_url("peminjaman/formTambahPeminjaman/ruangan")?>"><i class="fas fa-home fa-3x"></i> <br>Ruangan</a>
                        </div>
                        <div class="col-md-6 text-left">
                        <a class="btn btn-outline-secondary" style="width:300px; height:100px;" href="<?php echo base_url("peminjaman/formTambahPeminjaman/barang")?>"><i class="fas fa-car fa-3x"></i> <br>Barang</a>

                        </div>
                    </div>
                </div>
              </div>
            </div>
          
            
          
            
          </div>