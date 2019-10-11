
<div class="">
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
            <h6 class="m-0 font-weight-bold text-white">Profil</h6>
        </div>
        <div class="card-body">
            
            <?php 
            if($this->session->userdata('status') == 'pengguna'){?>
                <?php foreach($mahasiswa as $u): ?>
                <form class="user" action="<?php echo base_url().'auth/editProfil'; ?>" method="post">
                    <div class="form-group">
                        <label for="">Username</label>
                        <input hidden type="text" name="id_mahasiswa" class="form-control " value="<?= $u->id_mahasiswa; ?>">
                        <input disabled type="text" name="" class="form-control " value="<?= $u->id_mahasiswa; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input required type="text" name="nama_mahasiswa" class="form-control " value="<?= $u->nama_mahasiswa; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Nomor Telpon</label>
                        <input required type="text" name="nomor_telpon" class="form-control " value="<?= $u->nomor_telpon; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <input required type="text" name="alamat" class="form-control " value="<?= $u->alamat; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Instansi</label>
                        <input required type="text" name="instansi" class="form-control " value="<?= $u->instansi; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Status user</label>
                        <input disabled type="text" name="status_mahasiswa" class="form-control " value="<?= $u->status_mahasiswa; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input required type="text" name="password" class="form-control " value="<?= $u->password; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Edit Profil
                    </button>
                <?php endforeach ?>
                </form> 
            <?php }else{ ?>
                <form class="user" action="<?php echo base_url().'User/editOperator'; ?>" method="post">
                <?php foreach($operator as $u): ?>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input hidden type="text" name="username" class="form-control " value="<?= $u->username; ?>">
                        <input disabled type="text" name="" class="form-control " value="<?= $u->username; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input required type="text" name="password" class="form-control " value="<?= $u->password; ?>">
                    </div>
                    <div class="form-group">
                        <label for="feInputAddress">Status</label>
                        <input disabled type="text" name="" class="form-control " value="<?= $u->status_operator; ?>">
                        <input hidden type="text" name="password" class="form-control " value="<?= $u->status_operator; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Edit Profil
                    </button>
                <?php endforeach ?>
                </form> 
            <?php } ?>
            
        </div>
    </div>

</div>
</div>