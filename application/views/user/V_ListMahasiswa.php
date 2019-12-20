
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
                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Filter
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <form action="<?php  echo base_url('index.php?/User/user'); ?>" method="post"><input hidden name="status_mahasiswa" value="valid">
                            <button class="dropdown-item text-success" type="submit">Valid</button>
                        </form>
                        <form action="<?php  echo base_url('index.php?/User/user'); ?>" method="post"><input hidden name="status_mahasiswa" value="tidak valid">
                            <button class="dropdown-item text-danger" type="submit">Tidak Valid</button>
                        </form>
                        <form action="<?php  echo base_url('index.php?/User/user'); ?>" method="post"><input hidden name="status_mahasiswa" value="belum divalidasi">
                            <button class="dropdown-item text-warning" type="submit">Belum Divalidasi</button>
                        </form>
                      
                    </div>
                        <a class="btn btn-sm btn-primary"  href="<?php  echo base_url('index.php?/User/formTambahUser'); ?>"><i class="fas fa-plus"></i> User</a>
                    </div>
                </div>
            </div>
        </div>
    <div class="bg-white  shadow" >
        <table class="table table-bordered" id="dataTable">
            <thead class="bg-thead text-white">
                <tr>
                <th class="text-center" scope="col">No</th>
                <th class="text-center" scope="col">Username</th>
                <th class="text-center" scope="col">Nama</th>
                <th class="text-center" scope="col">Password</th>
                <th class="text-center" scope="col">Status</th>
                <th class="text-center" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $no = 1;
                foreach ($mahasiswa as $u){ 
            ?>
                <tr class="text-center">
                    <td><?php echo $no++; ?></td>
                    <td><a href="<?php echo site_url('index.php?/User/detailUser/'.$u->id_mahasiswa); ?>" ><?= $u->id_mahasiswa; ?></a></td>
                    <td><?php echo $u->nama_mahasiswa;?></td>
                    <td><?php echo $u->password;?></td>
                    <td><?php echo $u->status_mahasiswa;?></td>
                    <td >
                        <a href="<?php echo site_url('index.php?/User/updateUser/'.$u->id_mahasiswa); ?>"  class="btn  btn-sm btn-warning text-white" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a data-toggle="modal" data-id="<?php echo $u->id_mahasiswa; ?>" title="Hapus User" class="modalHapusUser btn btn-sm btn-danger" href="#modalHapusUser"><i class="fas fa-trash"></i></a>
                        <a href="<?php echo site_url('index.php?/User/validasiUser/'.$u->id_mahasiswa); ?>"  class="btn  btn-sm btn-outline-primary"  title="Validasi Status User">
                            <i class="fas fa-check"></i>
                        </a>
                        <a data-toggle="modal" data-id="<?php echo $u->id_mahasiswa; ?>" title="Tolak User" class="modalTolakUser btn btn-sm btn-outline-danger" href="#modalTolakUser"><i class="fas fa-window-close"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $('#tabel').DataTable();
</script>

<div class="modal fade" id="modalTolakUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div>
            <h6>Silahkan Isi Alasan Penolakan</h6>
        </div>
        <form action="<?php echo base_url().'index.php?/Peminjaman/tolakUser'; ?>" method="post">
        <input type="text"   hidden class="form-control" name="username" id="username" value=""/>
        <textarea class="form-control"  name="catatan_penolakan" rows="3"></textarea>
            <div class="d-flex flex-row-reverse bd-highlight py-2">
                <div class="px-1"><button type="submit" class="btn btn-primary btn-sm">Tolak</button></div>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>



<script>
$(document).on("click", ".modalTolakUser", function () {
     var peminjaman = $(this).data('id');
     $(".modal-body #username").val( peminjaman );
     $(".peminjaman").val( peminjaman );
});
</script>

<div class="modal fade" id="modalHapusUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div>
            <h6>Konfirmasi Hapus User</h6>
        </div>
        <form action="<?php echo base_url().'index.php?/User/hapusUser'; ?>" method="post">
        <input type="text"   hidden class="form-control" name="username" id="username" value=""/>
            <div class="d-flex flex-row-reverse bd-highlight py-2">
                <div class="px-1"><button type="submit" class="btn btn-danger btn-sm">Hapus</button></div>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>



<script>
$(document).on("click", ".modalHapusUser", function () {
     var peminjaman = $(this).data('id');
     $(".modal-body #username").val( peminjaman );
     $(".peminjaman").val( peminjaman );
});
</script>