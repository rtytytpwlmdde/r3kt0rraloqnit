
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
    <div class="mt-2">
            <div class="row py-2 ">
                <div class="col-6 col-md-8 ">
                    <h3 class="text-muted">Edit Data Mata Kuliah</h3>
                </div>
                <div class="col-6 col-md-4">
                    <div class="d-flex flex-row-reverse bd-highlight">
                    </div>
                </div>
            </div>
        </div>
    <div class="kotak py-2 px-2 shadow" >
        <?php foreach($operator as $u): ?>
        <form class="user" action="<?php echo base_url().'User/editOperator'; ?>" method="post">
            <div class="form-group">
                <label for="">Username</label>
                <input hidden type="text" name="username" class="form-control form-control-user" value="<?= $u->password; ?>">
                <input disabled type="text" name="" class="form-control form-control-user" value="<?= $u->password; ?>">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input required type="text" name="password" class="form-control form-control-user" value="<?= $u->password; ?>">
            </div>
            <div class="form-group">
                <label for="feInputAddress">Status</label>
                <select required  name="status_operator" id="feInputState" class="form-control">
                <option value="admin" <?php echo ($u->status_operator=='admin')?'selected="selected"':''; ?>>admin</option>
                <option value="staff pelayanan" <?php echo ($u->status_operator=='staff pelayanan')?'selected="selected"':''; ?>>staff pelayanan</option>
                <option value="sekretariat kuliah" <?php echo ($u->status_operator=='sekretariat kuliah')?'selected="selected"':''; ?>>sekretariat kuliah</option>
                <option value="kasubag akademik" <?php echo ($u->status_operator=='kasubag akademik')?'selected="selected"':''; ?>>kasubag akademik</option>
                <option value="kasubag kemahasiswaan" <?php echo ($u->status_operator=='kasubag kemahasiswaan')?'selected="selected"':''; ?>>kasubag kemahasiswaan</option>
                <option value="kasubag umum" <?php echo ($u->status_operator=='kasubag umum')?'selected="selected"':''; ?>>kasubag umum</option>
                <option value="wakil dekan" <?php echo ($u->status_operator=='wakil dekan')?'selected="selected"':''; ?>>wakil dekan</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Edit Matakuliah
            </button>
        <?php endforeach ?>
        </form> 
    </div>
</div>
</div>