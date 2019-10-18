
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
                    <h3 class="text-muted">Data User</h3>
                </div>
                <div class="col-6 col-md-4">
                    <div class="d-flex flex-row-reverse bd-highlight">
                            <a href="<?php echo site_url('user/updateUser/'.$username); ?>"  class="btn  btn-sm btn-warning text-white" title="Edit">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a href="<?php echo site_url('user/hapusUser/'.$username); ?>"  class="btn  btn-sm btn-danger text-white"  title="Hapus">
                                <i class="fas fa-trash"></i>
                            </a>
                            <a href="<?php echo site_url('user/validasiUser/'.$username); ?>"  class="btn  btn-sm btn-outline-primary"  title="Validasi Status User">
                                <i class="fas fa-check"></i>
                            </a>
                            <a href="<?php echo site_url('user/validasiUser/'.$username); ?>"  class="btn  btn-sm btn-outline-danger"  title="Tolak Status User">
                                <i class="fas fa-window-close"></i>
                            </a>
                    </div>
                </div>
            </div>
        </div>
    <div class="bg-white  shadow" >
        <table class="table table-bordered" id="tabel">
           
            <tbody>
            <?php 
                $no = 1;
                foreach ($mahasiswa as $u){ 
            ?>
                
                <tr class="bg-thead text-white">
                    <td class="text-white">Username</td>
                    <td class="text-white"><?php echo $u->id_mahasiswa;?></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><?php echo $u->nama_mahasiswa;?></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><?php echo $u->password;?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td><?php echo $u->status_mahasiswa;?></td>
                </tr>
                <tr>
                    <td>Nomot Telpon</td>
                    <td><?php echo $u->nomor_telpon;?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><?php echo $u->alamat;?></td>
                </tr>
                <tr>
                    <td>Instansi</td>
                    <td><?php echo $u->instansi;?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $('#tabel').DataTable();
</script>