
<div class="col-md-12">
<?php
        $notif = $this->session->flashdata('notif');
        if($notif != NULL){
            echo '
            <div class="alert alert-danger alert-dismissible fade show bg-danger text-white" role="alert">
              <strong></strong> '.$notif.'
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
              <strong></strong> '.$notifsukses.'
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
                    <h3 class="text-muted">Data Ruangan</h3>
                </div>
                <div class="col-6 col-md-4">
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <button class="btn btn-sm btn-secondary dropdown-toggle mb-2" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Filter
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <form action="<?php  echo base_url('index.php?/SaranaPrasarana/ruangan'); ?>" method="post"><input hidden name="status" value="bagus">
                                <button class="dropdown-item text-success" type="submit">Bagus</button>
                            </form>
                            <form action="<?php  echo base_url('index.php?/SaranaPrasarana/ruangan'); ?>" method="post"><input hidden name="status" value="rusak">
                                <button class="dropdown-item text-danger" type="submit">Rusak</button>
                            </form>
                        </div>
                        <a class="btn btn-sm btn-primary mb-2"  href="<?php  echo base_url('index.php?/SaranaPrasarana/formTambahRuangan'); ?>" role="button">Tambah Ruangan</a>
                    </div>
                </div>
            </div>
        </div>
    <div class="bg-white  shadow p-2" >
        <table class="table table-bordered" id="dataTable">
            <thead class="bg-thead text-white">
                <tr>
                <th class="text-center" scope="col">No</th>
                <th class="text-center" scope="col">Kode Ruangan</th>
                <th class="text-center" scope="col">Ruangan</th>
                <th class="text-center" scope="col">Kapasitas</th>
                <th class="text-center" scope="col">Operator</th>
                <th class="text-center" scope="col">Status</th>
                <th class="text-center" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $no = 1;
                foreach ($ruangan as $u){ 
            ?>
                <tr class="text-center">
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $u->id_ruangan; ?></td>
                    <td><a href="<?php echo site_url('index.php?/SaranaPrasarana/detailRuangan/'.$u->id_ruangan); ?>" >
                        <?php echo $u->nama_ruangan;?>  
                        </a></td>
                    <td><?php echo $u->kapasitas;?></td>
                    <td><?php echo $u->id_operator;?></td>
                    <td><?php echo $u->status_ruangan;?></td>
                    <td >
                        <a href="<?php echo site_url('index.php?/SaranaPrasarana/updateRuangan/'.$u->id_ruangan); ?>"  class="btn btn-sm btn-warning text-white" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a onclick="return confirm('Apakah anda benar benar ingin menghapus data ini?');" href="<?php echo site_url('index.php?/SaranaPrasarana/hapusRuangan/'.$u->id_ruangan); ?>"  class="btn btn-sm btn-danger text-white"  title="Hapus">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>