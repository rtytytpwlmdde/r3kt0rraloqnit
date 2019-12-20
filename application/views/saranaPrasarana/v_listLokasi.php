
<div class="col-md-12">
<?php
        $gagal = $this->session->flashdata('gagal');
        if($gagal != NULL){
            echo '
            <div class="alert alert-danger alert-dismissible fade show bg-danger text-white" role="alert">
              <strong></strong> '.$gagal.'
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
              <strong></strong> '.$sukses.'
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
                    <h3 class="text-muted">Data Lokasi</h3>
                </div>
                <div class="col-6 col-md-4">
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <a class="btn btn-primary"  href="<?php  echo base_url('index.php?/SaranaPrasarana/formTambahLokasi'); ?>" role="button">Tambah Lokasi</a>
                    </div>
                </div>
            </div>
        </div>
    <div class="bg-white shadow" >
        <table class="table table-bordered" id="tblmatakuliah">
            <thead class="bg-thead text-white">
                <tr>
                <th class="text-center" scope="col">No</th>
                <th class="text-center" scope="col">ID Lokasi</th>
                <th class="text-center" scope="col">Nama Lokasi</th>
                <th class="text-center" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $no = 1;
                foreach ($lokasi as $u){ 
            ?>
                <tr class="text-center">
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $u->id_lokasi; ?></td>
                    <td><?php echo $u->nama_lokasi;?></td>
                    <td >
                        <a href="<?php echo site_url('index.php?/SaranaPrasarana/updateLokasi/'.$u->id_lokasi); ?>"  class="btn btn-warning text-white" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a href="<?php echo site_url('index.php?/SaranaPrasarana/hapusLokasi/'.$u->id_lokasi); ?>"  class="btn btn-danger text-white"  title="Hapus">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $('#tblmatakuliah').DataTable();
</script>