
<div class="col-md-12">
<?php
        $gagal = $this->session->flashdata('gagal');
        if($gagal != NULL){
            echo '
            <div class="alert alert-danger alert-dismissible fade show bg-danger text-white" role="alert">
              <strong>Gagal! </strong> '.$gagal.'
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
              <strong>Sukses! </strong> '.$sukses.'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            ';
        }
    ?>

<div class="card shadow mb-4 mt-2">
        <div class="card-header bg-thead  py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-white">Tambah Data Lembaga</h6>
        </div>
        <div class="card-body">
            <form class="user" action="<?php echo base_url().'index.php?/User/tambahLembaga'; ?>" method="post">
                <div class="form-group">
                    <label for="">Nama Lembaga</label>
                    <input required type="text" name="nama_lembaga" class="form-control" placeholder="">
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Tambah Lembaga
                </button>
            </form> 
        </div>
    </div>
    