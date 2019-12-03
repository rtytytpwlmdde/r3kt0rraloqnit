
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
                    <div class="form-group col">
                      <label for="inputEmail4">AC</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="ac">
                        <option value="">Pilih</option>
                        <option>ya</option>
                        <option>tidak</option>
                      </select>
                    </div>
                    <div class="form-group col">
                      <label for="inputPassword4">Wifi</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="wifi">
                        <option value="">Pilih</option>
                        <option>ya</option>
                        <option>tidak</option>
                      </select>
                    </div>
                    <div class="form-group col">
                      <label for="inputPassword4">lcd</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="lcd">
                        <option value="">Pilih</option>
                        <option>ya</option>
                        <option>tidak</option>
                      </select>
                    </div>
                    <div class="form-group col">
                      <label for="inputPassword4">Sound System</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="sound_system">
                        <option value="">Pilih</option>
                        <option>ya</option>
                        <option>tidak</option>
                      </select>
                    </div>
                    <div class="form-group col">
                      <label for="inputPassword4">Toiled</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="toilet">
                        <option value="">Pilih</option>
                        <option>ya</option>
                        <option>tidak</option>
                      </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                      <label for="inputEmail4">Ruang Rapat</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="rapat">
                        <option value="">Pilih</option>
                        <option>ya</option>
                        <option>tidak</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="inputPassword4">Hall</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="hall">
                        <option value="">Pilih</option>
                        <option>ya</option>
                        <option>tidak</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="inputPassword4">Terbuka</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="terbuka">
                        <option value="">Pilih</option>
                        <option>ya</option>
                        <option>tidak</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="inputPassword4">Auditorium</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="auditorium">
                        <option value="">Pilih</option>
                        <option>ya</option>
                        <option>tidak</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="inputPassword4">Olahraga</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="olahraga_tertutup">
                        <option value="">Pilih</option>
                        <option>ya</option>
                        <option>tidak</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="inputPassword4">Ruang Kuliah</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="ruang_kuliah">
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
                    <input  type="text" name="alamat_ruangan" class="form-control " placeholder="">
                </div>
                <div class="form-group">
                    <label for="">Link </label>
                    <input  type="text" name="link_maps" class="form-control " placeholder="link alamat dari google maps dapat di pastekan disini">
                </div>
                <div class="form-row">
                    <div class="form-group col">
                      <img class="image-preview" id="image-preview1"/>   
                      <label for="inputEmail4">Foto 1</label>                   
                      <input type="file"  required class="form-control" id="image-source1" onchange="previewImage1();" name="foto1">
                    </div>
                    <div class="form-group col">
                      <img class="image-preview" id="image-preview2"/>   
                      <label for="inputPassword4">Foto 2</label>
                      <input type="file"  required class="form-control" id="image-source2" onchange="previewImage2();" name="foto2">
                    </div>
                    <div class="form-group col">
                      <img class="image-preview" id="image-preview3"/>   
                      <label for="inputPassword4">Foto 3</label>
                      <input type="file"  required class="form-control" id="image-source3" onchange="previewImage3();" name="foto3">
                    </div>
                    <div class="form-group col">
                      <img class="image-preview" id="image-preview4"/>   
                      <label for="inputPassword4">Foto 4</label>
                      <input type="file"  required class="form-control" id="image-source4" onchange="previewImage4();" name="foto4">
                    </div>
                    <div class="form-group col">
                      <img class="image-preview" id="image-preview5"/>   
                      <label for="inputPassword4">Foto 5</label>
                      <input type="file" required  class="form-control" id="image-source5" onchange="previewImage5();" name="foto5">
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
        CKEDITOR.replace( 'deskripsi_ruangan' );
</script>


<script>
  function previewImage1() {
      document.getElementById("image-preview1").style.display = "block";
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("image-source1").files[0]);
  
      oFReader.onload = function(oFREvent) {
        document.getElementById("image-preview1").src = oFREvent.target.result;
      };
    };
</script>

<script>
  function previewImage2() {
      document.getElementById("image-preview2").style.display = "block";
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("image-source2").files[0]);
  
      oFReader.onload = function(oFREvent) {
        document.getElementById("image-preview2").src = oFREvent.target.result;
      };
    };
</script>

<script>
  function previewImage3() {
      document.getElementById("image-preview3").style.display = "block";
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("image-source3").files[0]);
  
      oFReader.onload = function(oFREvent) {
        document.getElementById("image-preview3").src = oFREvent.target.result;
      };
    };
</script>

<script>
  function previewImage4() {
      document.getElementById("image-preview4").style.display = "block";
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("image-source4").files[0]);
  
      oFReader.onload = function(oFREvent) {
        document.getElementById("image-preview4").src = oFREvent.target.result;
      };
    };
</script>

<script>
  function previewImage5() {
      document.getElementById("image-preview5").style.display = "block";
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("image-source5").files[0]);
  
      oFReader.onload = function(oFREvent) {
        document.getElementById("image-preview5").src = oFREvent.target.result;
      };
    };
</script>
