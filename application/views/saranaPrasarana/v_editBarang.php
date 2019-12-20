
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
            <h6 class="m-0 font-weight-bold text-white">Edit Data Barang</h6>
        </div>
        <div class="card-body">
        <?php foreach($barang as $u): ?>
        <form class="user" action="<?php echo base_url().'index.php?/SaranaPrasarana/editBarang'; ?>" method="post">
            <div class="form-group">
                <label for="">ID Barang</label>
                <input hidden type="text" name="id_barang" class="form-control form-control-user" value="<?= $u->id_barang; ?>">
                <input disabled type="text" name="" class="form-control " value="<?= $u->id_barang; ?>">
            </div>
            <div class="form-group">
                <label for="">Nama Barang</label>
                <input required type="text" name="nama_barang" class="form-control " value="<?= $u->nama_barang; ?>">
            </div>
            <div class="form-group" >
                <label for="feInputAddress">Jenis Barang</label>
                <select required  name="jenis_barang" id="feInputState" class="form-control">
                <option value="bus" <?php echo ($u->jenis_barang=='bus')?'selected="selected"':''; ?>>Bus</option>
                <option value="minibus" <?php echo ($u->jenis_barang=='minibus')?'selected="selected"':''; ?>>Minibus</option>
                <option value="lain-lain" <?php echo ($u->jenis_barang=='minibus')?'selected="selected"':''; ?>>Minibus</option>
                </select>
            </div>
            
            <div class="form-group">
                    <label for="">Kapasitas</label>
                    <input required type="text" name="kapasitas_barang" class="form-control" value="<?= $u->kapsitas_barang;?>" placeholder="">
                </div> 
                <div class="form-group">
                    <label for="">Usia Barang</label>
                    <input required type="text" name="usia_barang" class="form-control" value="<?= $u->usia_barang;?>" placeholder="">
                </div> 
                <div class="form-group">
                    <label for="">Harga Sewa</label>
                    <input required type="text" name="harga_sewa" class="form-control" value="<?= $u->harga_sewa;?>" placeholder="">
                </div> 
            <div class="form-group" >
                <label for="feInputAddress">Status Barang</label>
                <select required  name="status_barang" id="feInputState" class="form-control">
                <option value="bagus" <?php echo ($u->status_barang=='bagus')?'selected="selected"':''; ?>>Bagus</option>
                <option value="rusak" <?php echo ($u->status_barang=='rusak')?'selected="selected"':''; ?>>Rusak</option>
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
                Edit Barang
            </button>
        <?php endforeach ?>
        </form> 
        </div>
    </div>
   
</div>
</div>