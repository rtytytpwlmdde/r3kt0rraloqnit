
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
                        <a class="btn btn-sm btn-primary"  href="<?php  echo base_url('SaranaPrasarana/formTambahRuangan'); ?>" role="button">Tambah Ruangan</a>
                    </div>
                </div>
            </div>
        </div>
    <div class="bg-white  shadow" >
        <table class="table table-bordered">
            <thead class="bg-thead text-white">
                <tr>
                <th class="text-center" scope="col">No</th>
                <th class="text-center" scope="col">Kode Ruangan</th>
                <th class="text-center" scope="col">Ruangan</th>
                <th class="text-center" scope="col">Jenis</th>
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
                    <td><?php echo $u->nama_ruangan;?></td>
                    <td><?php echo $u->jenis_ruangan;?></td>
                    <td><?php echo $u->id_operator;?></td>
                    <td><?php echo $u->status_ruangan;?></td>
                    <td >
                        <a href="<?php echo site_url('SaranaPrasarana/updateRuangan/'.$u->id_ruangan); ?>"  class="btn btn-sm btn-warning text-white" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a href="<?php echo site_url('SaranaPrasarana/hapusRuangan/'.$u->id_ruangan); ?>"  class="btn btn-sm btn-danger text-white"  title="Hapus">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>