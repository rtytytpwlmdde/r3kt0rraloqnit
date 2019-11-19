
<div class="col-md-12">

    
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
            <h6 class="m-0 font-weight-bold text-white">Tambah Data Ruangan</h6>
        </div>
        <div class="card-body">
            <form class="user" action="<?php echo base_url().'SaranaPrasarana/tambahRuangan'; ?>" method="post" enctype="multipart/form-data" >
                <div class="form-group">
                    <label for="">Nama Ruangan</label>
                    <input required type="text" name="nama_ruangan" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Kapasitas Ruangan</label>
                    <input required type="text" name="kapasitas" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Harga Sewa</label>
                    <input required type="text" name="harga_ruangan" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Deskripsi </label>
                    <textarea name="deskripsi_ruangan" id="deskripsi_ruangan" class="form-control" rows="10" cols="80"></textarea>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="inputEmail4">AC</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="ac">
                        <option value="">Pilih</option>
                        <option>ya</option>
                        <option>tidak</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="inputPassword4">Wifi</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="wifi">
                        <option value="">Pilih</option>
                        <option>ya</option>
                        <option>tidak</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="inputPassword4">lcd</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="lcd">
                        <option value="">Pilih</option>
                        <option>ya</option>
                        <option>tidak</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="inputPassword4">Sound System</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="sound_system">
                        <option value="">Pilih</option>
                        <option>ya</option>
                        <option>tidak</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="inputPassword4">Toiled</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="toilet">
                        <option value="">Pilih</option>
                        <option>ya</option>
                        <option>tidak</option>
                      </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="inputEmail4">Luas Ruangan</label>
                      <input type="text"  required class="form-control" id="inputEmail4" name="luas_ruangan">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputPassword4">Ruang Kelas</label>
                      <input type="text"  required class="form-control" id="inputEmail4" name="ruang_kelas">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputPassword4">Ruang Rapat</label>
                      <input type="text"  required class="form-control" id="inputEmail4" name="ruang_rapat">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="inputPassword4">Perjamuan</label>
                      <input type="text"  required class="form-control" id="inputEmail4" name="perjamuan">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputPassword4">Teater</label>
                      <input type="text"  required class="form-control" id="inputEmail4" name="teater">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputPassword4">Berbentuk U</label>
                      <input type="text"  required class="form-control" id="inputEmail4" name="ushape">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Alamat Ruangan</label>
                    <input  type="text" name="alamat_ruangan" class="form-control ">
                </div>
                <div class="form-group">
                    <label for="">Link </label>
                    <input  type="text" name="link_maps" class="form-control " >
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="inputEmail4">Foto 1</label>
                      <input type="file"  required class="form-control" id="inputEmail4" name="foto1">
                    </div>
                    <div class="form-group col-md-2">
                      <label for="inputPassword4">Foto 2</label>
                      <input type="file"  required class="form-control" id="inputPassword4" name="foto2">
                    </div>
                    <div class="form-group col-md-2">
                      <label for="inputPassword4">Foto 3</label>
                      <input type="file"  required class="form-control" id="inputPassword4" name="foto3">
                    </div>
                    <div class="form-group col-md-2">
                      <label for="inputPassword4">Foto 4</label>
                      <input type="file"  required class="form-control" id="inputPassword4" name="foto4">
                    </div>
                    <div class="form-group col-md-2">
                      <label for="inputPassword4">Foto 5</label>
                      <input type="file" required  class="form-control" id="inputPassword4" name="foto5">
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Operator</label>
                    <select name="id_operator" required class="form-control" id="exampleFormControlSelect1">
                        <option value="">Pilih</option>
                        <?php foreach($operator as $u): ?>
                            <option value="<?= $u->username ?>"><?= $u->username ?></option>
                        <?php endforeach;?>         
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Tambah Ruangan
                </button>
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
