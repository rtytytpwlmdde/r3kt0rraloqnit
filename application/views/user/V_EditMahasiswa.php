
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
            <h6 class="m-0 font-weight-bold text-white">Edit Data User</h6>
        </div>
        <div class="card-body">
            <form class="user" action="<?php echo base_url().'User/editUser'; ?>" method="post">
            <?php foreach($mahasiswa as $u): ?>
                <div class="form-group">
                    <label for="">Username</label>
                    <input hidden type="text" name="id_mahasiswa" class="form-control form-control-user" value="<?= $u->id_mahasiswa; ?>">
                    <input disabled type="text" name="" class="form-control " value="<?= $u->id_mahasiswa; ?>">
                </div>
                <div class="form-group">
                    <label for="">Nama</label>
                    <input required type="text" name="nama_mahasiswa" class="form-control " value="<?= $u->nama_mahasiswa; ?>">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input required type="text" name="password" class="form-control " value="<?= $u->password; ?>">
                </div>
                <div class="form-group">
                    <label for="feInputAddress">Status</label>
                    <select required  name="status_mahasiswa" id="feInputState" class="form-control">
                    <option value="valid" <?php echo ($u->status_mahasiswa=='valid')?'selected="selected"':''; ?>>valid</option>
                    <option value="tidak valid" <?php echo ($u->status_mahasiswa=='tidak valid')?'selected="selected"':''; ?>>tidak valid</option>
                    <option value="belum divalidasi" <?php echo ($u->status_mahasiswa=='belum divalidasi')?'selected="selected"':''; ?>>belum divalidasi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Nomor Telpon</label>
                    <input  type="text" name="nomor_telpon" class="form-control " value="<?= $u->nomor_telpon; ?>">
                </div>
                <div class="form-group">
                    <label for="">Alamat</label>
                    <input  type="text" name="alamat" class="form-control " value="<?= $u->alamat; ?>">
                </div>
                <div class="form-group">
                    <label for="">Instansi</label>
                    <input  type="text" name="instansi" class="form-control " value="<?= $u->instansi; ?>">
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Edit Data User
                </button>
            <?php endforeach ?>
            </form> 
        </div>
    </div>
   
</div>
</div>