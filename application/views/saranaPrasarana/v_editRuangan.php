
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
            <h6 class="m-0 font-weight-bold text-white">Edit Data Ruangan</h6>
        </div>
        <div class="card-body">
        <?php foreach($ruangan as $u): ?>
        <form class="user" action="<?php echo base_url().'SaranaPrasarana/editRuangan'; ?>" method="post">
            <div class="form-group">
                <label for="">ID Ruangan</label>
                <input hidden type="text" name="id_ruangan" class="form-control form-control-user" value="<?= $u->id_ruangan; ?>">
                <input disabled type="text" name="" class="form-control " value="<?= $u->id_ruangan; ?>">
            </div>
            <div class="form-group">
                <label for="">Nama Ruangan</label>
                <input required type="text" name="nama_ruangan" class="form-control " value="<?= $u->nama_ruangan; ?>">
            </div>
            <div class="form-group">
                <label for="">Kapasitas Ruangan</label>
                <input required type="text" name="kapasitas" class="form-control " value="<?= $u->kapasitas; ?>">
            </div>
            <div class="form-group" >
                <label for="feInputAddress">Status Ruangan</label>
                <select required  name="status_ruangan" id="feInputState" class="form-control">
                <option value="bagus" <?php echo ($u->status_ruangan=='bagus')?'selected="selected"':''; ?>>Bagus</option>
                <option value="rusak" <?php echo ($u->status_ruangan=='rusak')?'selected="selected"':''; ?>>Rusak</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Operator</label>
                <select required  name="id_operator" id="feInputState" class="form-control">
                    <?php foreach ($operator as $j) : ?>
                        <option value="<?= $j->username; ?>"
                            <?php if ($u->id_operator == $j->username) :
                                echo "selected=selected";
                            endif; ?>>
                            <?= $j->username; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Edit Ruangan
            </button>
        <?php endforeach ?>
        </form> 
        </div>
    </div>
   
</div>
</div>