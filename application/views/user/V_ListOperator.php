
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
                    <h3 class="text-muted">Data Operator</h3>
                </div>
                <div class="col-6 col-md-4">
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <a class="btn btn-sm btn-primary"  href="<?php  echo base_url('User/formTambahOperator'); ?>" role="button">Tambah Operator</a>
                    </div>
                </div>
            </div>
        </div>
    <div class="bg-white  shadow" >
        <table class="table table-bordered">
            <thead class="bg-thead text-white">
                <tr>
                <th class="text-center" scope="col">No</th>
                <th class="text-center" scope="col">Username</th>
                <th class="text-center" scope="col">Password</th>
                <th class="text-center" scope="col">Fakultas</th>
                <th class="text-center" scope="col">Status</th>
                <th class="text-center" scope="col">Ruangan</th>
                <th class="text-left" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $no = 1;
                foreach ($operator as $u){ 
            ?>
                <tr class="text-center">
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $u->username; ?></td>
                    <td><?php echo $u->password;?></td>
                    <td><?php echo $u->nama_fakultas;?></td>
                    <td><?php echo $u->status_operator;?></td>
                    <td class="text-left">
                    <?php 
                    $i= 1;
                    foreach($ruangan as $r){
                        if($r->id_operator == $u->username){
                            echo $i++.")".$r->nama_ruangan."<br>";
                        }
                    }
                    ?>
                
                    </td>
                    <td >
                        <a href="<?php echo site_url('user/updateOperator/'.$u->username); ?>"  class="btn btn-sm btn-warning text-white" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a href="<?php echo site_url('user/hapusOperator/'.$u->username); ?>"  class="btn btn-sm btn-danger text-white"  title="Hapus">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>