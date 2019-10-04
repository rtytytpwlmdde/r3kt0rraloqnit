
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
                    <h3 class="text-muted">Edit Data Barang</h3>
                </div>
                <div class="col-6 col-md-4">
                    <div class="d-flex flex-row-reverse bd-highlight">
                    </div>
                </div>
            </div>
        </div>
    <div class="kotak py-2 px-2 shadow" >
        <?php foreach($barang as $u): ?>
        <form class="user" action="<?php echo base_url().'SaranaPrasarana/editBarang'; ?>" method="post">
            <div class="form-group">
                <label for="">ID Barang</label>
                <input hidden type="text" name="id_barang" class="form-control form-control-user" value="<?= $u->id_barang; ?>">
                <input disabled type="text" name="" class="form-control form-control-user" value="<?= $u->id_barang; ?>">
            </div>
            <div class="form-group">
                <label for="">Nama Barang</label>
                <input required type="text" name="nama_barang" class="form-control form-control-user" value="<?= $u->nama_barang; ?>">
            </div>
            <div class="form-group">
                <label for="feInputAddress">Status Barang</label>
                <select required  name="status_barang" id="feInputState" class="form-control">
                <option value="bagus" <?php echo ($u->status_barang=='bagus')?'selected="selected"':''; ?>>bagus</option>
                <option value="rusak" <?php echo ($u->status_barang=='rusak')?'selected="selected"':''; ?>>rusak</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Edit Barang
            </button>
        <?php endforeach ?>
        </form> 
    </div>
</div>
</div>