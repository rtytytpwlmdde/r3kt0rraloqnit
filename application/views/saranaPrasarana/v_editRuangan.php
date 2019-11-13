
<div class="">
<div class="col-md-12">
<?php
        $gagal = $this->session->flashdata('gagal');
        if($gagal != NULL){
            echo '
            <div class="alert alert-danger alert-dismissible fade show bg-danger text-white" role="alert">
              <strong>Gagal! </strong> '.$gagal.'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            ';
        }
        $sukses = $this->session->flashdata('sukses');
        if($sukses != NULL){
            echo '
            <div class="alert alert-success alert-dismissible fade show bg-success text-white" role="alert">
              <strong>Sukses! </strong> '.$sukses.'
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
        <form class="user" action="<?php echo base_url().'SaranaPrasarana/editRuangan'; ?>" method="post" enctype="multipart/form-data">
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
            <div class="form-group">
                <label for="">Deskripsi Ruangan </label>
                <textarea name="deskripsi_ruangan" id="deskripsi_ruangan" class="form-control"   rows="3"><?= $u->deskripsi_ruangan; ?></textarea>
            </div>
            <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="inputEmail4">Luas Ruangan</label>
                      <input type="text"  required class="form-control" id="inputEmail4" name="luas_ruangan" value="<?= $u->luas_ruangan?>">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputPassword4">Ruang Kelas</label>
                      <input type="text"  required class="form-control" id="inputEmail4" name="ruang_kelas" value="<?= $u->ruang_kelas?>">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputPassword4">Ruang Rapat</label>
                      <input type="text"  required class="form-control" id="inputEmail4" name="ruang_rapat" value="<?= $u->ruang_rapat?>">
                    </div>
                </div>
            <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="inputPassword4">Perjamuan</label>
                      <input type="text"  required class="form-control" id="inputEmail4" name="perjamuan" value="<?= $u->perjamuan?>">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputPassword4">Teater</label>
                      <input type="text"  required class="form-control" id="inputEmail4" name="teater"value="<?= $u->teater?>">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputPassword4">Berbentuk U</label>
                      <input type="text"  required class="form-control" id="inputEmail4" name="ushape" value="<?= $u->ushape?>">
                    </div>
                </div>
            
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="inputEmail4">Foto 1</label>
                    <input type="file"   class="form-control" id="inputEmail4"   value="<?= $u->foto_ruangan1; ?>" name="foto1">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputPassword4">Foto 2</label>
                    <input type="file"   class="form-control" id="inputPassword4"   value="<?= $u->foto_ruangan2; ?>" name="foto2">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputPassword4">Foto 3</label>
                    <input type="file"   class="form-control" id="inputPassword4"   value="<?= $u->foto_ruangan3; ?>" name="foto3">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputPassword4">Foto 4</label>
                    <input type="file"   class="form-control" id="inputPassword4"   value="<?= $u->foto_ruangan4; ?>" name="foto4">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputPassword4">Foto 5</label>
                    <input type="file"   class="form-control" id="inputPassword4"   value="<?= $u->foto_ruangan5; ?>" name="foto5">
                </div>
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
                    <input type="hidden"   class="form-control" id="inputEmail4"   value="<?= $u->foto_ruangan1; ?>" name="foto_ruangan1">
                    <input type="hidden"   class="form-control" id="inputEmail4"   value="<?= $u->foto_ruangan2; ?>" name="foto_ruangan2">
                    <input type="hidden"   class="form-control" id="inputEmail4"   value="<?= $u->foto_ruangan3; ?>" name="foto_ruangan3">
                    <input type="hidden"   class="form-control" id="inputEmail4"   value="<?= $u->foto_ruangan4; ?>" name="foto_ruangan4">
                    <input type="hidden"   class="form-control" id="inputEmail4"   value="<?= $u->foto_ruangan5; ?>" name="foto_ruangan5">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Edit Ruangan
            </button>
        <?php endforeach ?>
        </form> 
        </div>
    </div>
   
</div>
</div>
<script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'deskripsi_ruangan' );
            </script>
