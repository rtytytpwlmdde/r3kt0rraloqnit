
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
                    <h3 class="text-muted">Edit Data Ruangan</h3>
                </div>
                <div class="col-6 col-md-4">
                    <div class="d-flex flex-row-reverse bd-highlight">
                    </div>
                </div>
            </div>
        </div>
    <div class="kotak py-2 px-2 shadow" >
        <?php foreach($ruangan as $u): ?>
        <form class="user" action="<?php echo base_url().'SaranaPrasarana/editRuangan'; ?>" method="post">
            <div class="form-group">
                <label for="">ID Ruangan</label>
                <input hidden type="text" name="id_ruangan" class="form-control form-control-user" value="<?= $u->id_ruangan; ?>">
                <input disabled type="text" name="" class="form-control form-control-user" value="<?= $u->id_ruangan; ?>">
            </div>
            <div class="form-group">
                <label for="">Nama Ruangan</label>
                <input required type="text" name="nama_ruangan" class="form-control form-control-user" value="<?= $u->nama_ruangan; ?>">
            </div>
            <div class="form-group">
                <label for="feInputAddress">Jenis Ruangan</label>
                <select required  name="jenis_ruangan" id="feInputState" class="form-control">
                <option value="kelas" <?php echo ($u->jenis_ruangan=='kelas')?'selected="selected"':''; ?>>kelas</option>
                <option value="non kelas" <?php echo ($u->jenis_ruangan=='non kelas')?'selected="selected"':''; ?>>non kelas</option>
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