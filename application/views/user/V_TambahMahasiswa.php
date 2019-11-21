
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

    
<div class="card shadow mb-4 mt-2">
        <div class="card-header bg-thead  py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-white">Tambah Data User</h6>
        </div>
        <div class="card-body">
        <form class="user" action="<?php echo base_url().'User/tambahUser'; ?>" method="post">
            <div class="form-group">
                <label for="">Username</label>
                <input required type="text" name="id_mahasiswa" class="form-control " placeholder="">
            </div>
            <div class="form-group">
                <label for="">Nama</label>
                <input required type="text" name="nama_mahasiswa" class="form-control " placeholder="">
            </div>
            
            <div class="form-group">
                <label for="">Alamat</label>
                <input required type="text" name="alamat" class="form-control " >
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input required type="text" name="email" class="form-control " >
            </div>
            <div class="form-group">
                <label for="">Instansi</label>
                <input required type="text" name="instansi" class="form-control " >
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input required type="text" name="password" class="form-control " >
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Tambah User
            </button>
        </form> 
        </div>
    </div>
    