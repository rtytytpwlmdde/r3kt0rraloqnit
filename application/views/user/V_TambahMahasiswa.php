
<div class="col-md-12">
<?php
        $notif = $this->session->flashdata('notif');
        if($notif != NULL){
            echo '
            <div class="alert alert-danger alert-dismissible fade show bg-danger text-white" role="alert">
              <strong>Gagal! </strong> '.$notif.'
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
              <strong>Sukses! </strong> '.$notifsukses.'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            ';
        }
    ?>
    <div class="mt-2">
            <div class="row py-2 ">
                <div class="col-6 col-md-8 ">
                    <h3 class="text-muted">Tambah Data Mahasiswa</h3>
                </div>
                <div class="col-6 col-md-4">
                    <div class="d-flex flex-row-reverse bd-highlight">
                    </div>
                </div>
            </div>
        </div>
    <div class="kotak py-2 px-2 shadow" >
        <form class="user" action="<?php echo base_url().'User/tambahMahasiswa'; ?>" method="post">
            <div class="form-group">
                <label for="">NIM</label>
                <input required type="text" name="id_mahasiswa" class="form-control form-control-user" placeholder="">
            </div>
            <div class="form-group">
                <label for="">Nama</label>
                <input required type="text" name="nama_mahasiswa" class="form-control form-control-user" placeholder="">
            </div>
            
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Tambah Mahasiswa
            </button>
        </form> 
    </div>
</div>