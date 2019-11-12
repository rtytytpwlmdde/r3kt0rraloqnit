
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
                            <form action="<?php  echo base_url('saranaPrasarana/barang'); ?>" method="post"><input hidden name="status" value="bagus">
                                <button class="dropdown-item text-success" type="submit">Bagus</button>
                            </form>
                            <form action="<?php  echo base_url('saranaPrasarana/barang'); ?>" method="post"><input hidden name="status" value="rusak">
                                <button class="dropdown-item text-danger" type="submit">Rusak</button>
                            </form>
                        </div>
                        <a class="btn btn-sm btn-primary mb-2"  href="<?php  echo base_url('SaranaPrasarana/formTambahBarang'); ?>" role="button">Tambah Barang</a>
                    </div>
                </div>
            </div>
        </div>
    <div class="bg-white  shadow p-2" >
        <table class="table table-bordered" id="dataTable">
            <thead class="bg-thead text-white">
                <tr>
                <th class="text-center" scope="col">No</th>
                <th class="text-center" scope="col">Kode Barang</th>
                <th class="text-center" scope="col">Barang</th>
                <th class="text-center" scope="col">Operator</th>
                <th class="text-center" scope="col">Status</th>
                <th class="text-center" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $no = 1;
                foreach ($barang as $u){ 
            ?>
                <tr class="text-center">
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $u->id_barang; ?></td>
                    <td><a href="<?php echo site_url('SaranaPrasarana/detailBarang/'.$u->id_barang); ?>" >
                        <?php echo $u->nama_barang;?>  
                        </a></td>
                    <td><?php echo $u->id_operator;?></td>
                    <td><?php echo $u->status_barang;?></td>
                    <td >
                        <a href="<?php echo site_url('SaranaPrasarana/updateBarang/'.$u->id_barang); ?>"  class="btn btn-sm btn-warning text-white" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a href="<?php echo site_url('SaranaPrasarana/hapusBarang/'.$u->id_barang); ?>"  class="btn btn-sm btn-danger text-white"  title="Hapus">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>