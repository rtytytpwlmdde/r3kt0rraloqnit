
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
        <form class="user" action="<?php echo base_url().'index.php?/SaranaPrasarana/editRuangan'; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">ID Ruangan</label>
                <input hidden type="text" name="id_ruangan" class="form-control form-control-user" value="<?= $u->id_ruangan; ?>">
                <input disabled type="text" name="" class="form-control " value="<?= $u->id_ruangan; ?>">
            </div>
            <div class="form-group">
                <label for="">Nama Ruangan</label>
                <input required type="text" name="nama_ruangan" class="form-control " value="<?= $u->nama_ruangan; ?>">
            </div>
            <div class="form-row">
              <div class="form-group col">
                  <label for="">Kapasitas Ruangan</label>
                  <input required type="text" name="kapasitas" class="form-control " value="<?= $u->kapasitas; ?>">
              </div> 
              <div class="form-group col">
                <label for="inputEmail4">Jenis Ruangan</label>
                <select class="form-control" id="exampleFormControlSelect1" name="jenis_ruangan">
                  <option value="eksklusif" <?php echo ($u->jenis_ruangan=='eksklusif')?'selected="selected"':''; ?>>eksklusif</option>
                  <option value="umum" <?php echo ($u->jenis_ruangan=='umum')?'selected="selected"':''; ?>>umum</option>
                </select>
              </div>             
            </div>

            <div class="form-group">
                <label for="">Deskripsi Ruangan </label>
                <textarea name="deskripsi_ruangan" id="deskripsi_ruangan" class="form-control"   rows="3"><?= $u->deskripsi_ruangan; ?></textarea>
            </div>
            <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="inputEmail4">AC</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="ac">
                        <option value="ya" <?php echo ($u->ac=='ya')?'selected="selected"':''; ?>>ya</option>
                        <option value="tidak" <?php echo ($u->ac=='tidak')?'selected="selected"':''; ?>>tidak</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="inputPassword4">Wifi</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="wifi">
                        <option value="ya" <?php echo ($u->wifi=='ya')?'selected="selected"':''; ?>>ya</option>
                        <option value="tidak" <?php echo ($u->wifi=='tidak')?'selected="selected"':''; ?>>tidak</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="inputPassword4">lcd</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="lcd">
                        <option value="ya" <?php echo ($u->lcd=='ya')?'selected="selected"':''; ?>>ya</option>
                        <option value="tidak" <?php echo ($u->lcd=='tidak')?'selected="selected"':''; ?>>tidak</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="inputPassword4">Sound System</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="speaker">
                        <option value="ya" <?php echo ($u->sound_system=='ya')?'selected="selected"':''; ?>>ya</option>
                        <option value="tidak" <?php echo ($u->sound_system=='tidak')?'selected="selected"':''; ?>>tidak</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="inputPassword4">Toiled</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="toilet">
                        <option value="ya" <?php echo ($u->toilet=='ya')?'selected="selected"':''; ?>>ya</option>
                        <option value="tidak" <?php echo ($u->toilet=='tidak')?'selected="selected"':''; ?>>tidak</option>
                      </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                      <label for="inputEmail4">Ruang Rapat</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="rapat">
                        <option value="ya" <?php echo ($u->toilet=='ya')?'selected="selected"':''; ?>>ya</option>
                        <option value="tidak" <?php echo ($u->toilet=='tidak')?'selected="selected"':''; ?>>tidak</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="inputPassword4">Tall</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="hall">
                        <option value="ya" <?php echo ($u->toilet=='ya')?'selected="selected"':''; ?>>ya</option>
                        <option value="tidak" <?php echo ($u->toilet=='tidak')?'selected="selected"':''; ?>>tidak</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="inputPassword4">Terbuka</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="terbuka">
                        <option value="ya" <?php echo ($u->toilet=='ya')?'selected="selected"':''; ?>>ya</option>
                        <option value="tidak" <?php echo ($u->toilet=='tidak')?'selected="selected"':''; ?>>tidak</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="inputPassword4">Audatorium</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="audatorium">
                        <option value="ya" <?php echo ($u->toilet=='ya')?'selected="selected"':''; ?>>ya</option>
                        <option value="tidak" <?php echo ($u->toilet=='tidak')?'selected="selected"':''; ?>>tidak</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="inputPassword4">Olahraga</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="olahraga_tertutup">
                        <option value="ya" <?php echo ($u->toilet=='ya')?'selected="selected"':''; ?>>ya</option>
                        <option value="tidak" <?php echo ($u->toilet=='tidak')?'selected="selected"':''; ?>>tidak</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="inputPassword4">Ruang Kuliah</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="ruang_kuliah">
                        <option value="ya" <?php echo ($u->toilet=='ya')?'selected="selected"':''; ?>>ya</option>
                        <option value="tidak" <?php echo ($u->toilet=='tidak')?'selected="selected"':''; ?>>tidak</option>
                      </select>
                    </div>
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
            
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Lokasi Ruangan</label>
                    <select required  name="alamat_ruangan" id="feInputState" class="form-control">
                    <?php foreach ($lokasi as $j) : ?>
                        <option value="<?= $j->id_lokasi; ?>"
                            <?php if ($u->alamat_ruangan == $j->id_lokasi) :
                                echo "selected=selected";
                            endif; ?>>
                            <?= $j->nama_lokasi; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                </div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="inputEmail4">Foto 1</label>
                    <input type="file"   class="form-control" id="inputEmail4"   value="<?= $u->foto_ruangan1; ?>" name="foto1">
                </div>
                <div class="form-group col">
                    <label for="inputPassword4">Foto 2</label>
                    <input type="file"   class="form-control" id="inputPassword4"   value="<?= $u->foto_ruangan2; ?>" name="foto2">
                </div>
                <div class="form-group col">
                    <label for="inputPassword4">Foto 3</label>
                    <input type="file"   class="form-control" id="inputPassword4"   value="<?= $u->foto_ruangan3; ?>" name="foto3">
                </div>
                <div class="form-group col">
                    <label for="inputPassword4">Foto 4</label>
                    <input type="file"   class="form-control" id="inputPassword4"   value="<?= $u->foto_ruangan4; ?>" name="foto4">
                </div>
                <div class="form-group col">
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
