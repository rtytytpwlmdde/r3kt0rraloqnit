
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
            <h6 class="m-0 font-weight-bold text-white">Edit Data Operator</h6>
        </div>
        <div class="card-body">
            <form class="user" action="<?php echo base_url().'User/editOperator'; ?>" method="post">
            <?php foreach($operator as $u): ?>
                <div class="form-group">
                    <label for="">Username</label>
                    <input hidden type="text" name="username" class="form-control form-control-user" value="<?= $u->password; ?>">
                    <input disabled type="text" name="" class="form-control " value="<?= $u->password; ?>">
                </div>
                <div class="form-group">
                    <label for="">Nama Operator</label>
                    <input required type="text" name="nama_operator" class="form-control " value="<?= $u->nama_operator; ?>">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input required type="text" name="password" class="form-control " value="<?= $u->password; ?>">
                </div>
                <div class="form-group">
                    <label for="">Nama Fakultas</label>
                    <input required type="text" name="nama_fakultas" class="form-control " value="<?= $u->nama_fakultas; ?>">
                </div>
                <div class="form-group">
                    <label for="feInputAddress">Status</label>
                    <select required  name="status_operator" id="feInputState" class="form-control">
                    <option value="admin" <?php echo ($u->status_operator=='admin')?'selected="selected"':''; ?>>admin</option>
                    <option value="staff pelayanan" <?php echo ($u->status_operator=='staff pelayanan')?'selected="selected"':''; ?>>staff pelayanan</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Edit Data Operator
                </button>
            <?php endforeach ?>
            </form> 
        </div>
    </div>
   
</div>
</div>