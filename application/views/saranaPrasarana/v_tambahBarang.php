
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
            <h6 class="m-0 font-weight-bold text-white">Tambah Data Barang</h6>
        </div>
        <div class="card-body">
            <form class="user" action="<?php echo base_url().'SaranaPrasarana/tambahBarang'; ?>" method="post"  enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Nama Barang</label>
                    <input required type="text" name="nama_barang" class="form-control" placeholder="">
                </div> 
                <div class="form-group">
                    <label for="">Jenis Barang</label>
                    <select name="jenis_barang" required class="form-control" id="exampleFormControlSelect1">
                        <option value="">Pilih</option>
                        <option value="minibus">Minibus</option>
                        <option value="bus">Bus</option>
                        <option value="lain-lain">Lain lain</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Kapasitas</label>
                    <input required type="text" name="kapasitas_barang" class="form-control" placeholder="">
                </div> 
                <div class="form-group">
                    <label for="">Usia Barang</label>
                    <input required type="text" name="usia_barang" class="form-control" placeholder="">
                </div> 
                <div class="form-group">
                    <label for="">Harga Sewa</label>
                    <input required type="text" name="harga_barang" class="form-control" placeholder="">
                </div> 
                <div class="form-group">
                    <label for="">Deskripsi Barang</label>
                    <textarea name="deskripsi_barang" id="deskripsi_barang" class="form-control" rows="10" cols="80"></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                      <label for="">Foto 1</label>
                      <input type="file"  required class="form-control" id="inputEmail4" name="foto1">
                    </div>
                    <div class="form-group col">
                      <label for="rd4">Foto 2</label>
                      <input type="file"  required class="form-control" id="inputPassword4" name="foto2">
                    </div>
                    <div class="form-group col">
                      <label for="rd4">Foto 3</label>
                      <input type="file"  required class="form-control" id="inputPassword4" name="foto3">
                    </div>
                    <div class="form-group col">
                      <label for="rd4">Foto 4</label>
                      <input type="file"  required class="form-control" id="inputPassword4" name="foto4">
                    </div>
                    <div class="form-group col">
                      <label for="rd4">Foto 5</label>
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
                    Tambah Barang
                </button>
            </form> 
        </div>
    </div>
    
   
</div>
</div>
<script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'deskripsi_barang' );
            </script>
