
<div class="

<?php 
if($this->session->userdata('status') == "pengguna"){
    echo "container";
}
?>">
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
                <div class="col-6 col-md-6 ">
                    <h3 class="text-muted">History Peminjaman</h3>
                </div>
                <div class="col-6 col-md-6">
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <?php if($this->session->userdata('status') != "pengguna"){?>
                        <a class="btn btn-sm btn-success text-white mb-2 ml-1" href="<?php echo base_url("rekap/exportHistoryPeminjaman");?>"><i class="fas fa-file-excel"></i>  </a>
                        <?php } ?>
                        <button class="btn btn-sm btn-secondary dropdown-toggle mb-2" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-filter"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <form action="<?php  echo base_url('peminjaman/historyPeminjaman'); ?>" method="post"><input hidden name="status" value="setuju">
                                <button class="dropdown-item text-success" type="submit">Setuju</button>
                            </form>
                            <form action="<?php  echo base_url('peminjaman/historyPeminjaman'); ?>" method="post"><input hidden name="status" value="tolak">
                                <button class="dropdown-item text-danger" type="submit">Tolak</button>
                            </form>
                            <form action="<?php  echo base_url('peminjaman/historyPeminjaman'); ?>" method="post"><input hidden name="status" value="terkirim">
                                <button class="dropdown-item text-warning" type="submit">Terkirim</button>
                            </form>
                        </div>
                        <form class="pr-2 form-inline" action="<?php echo base_url("peminjaman/historyPeminjaman")?>" method="post">
                            <div class="form-group mb-2">
                                <input type="text" name="search" class="form-control-sm " placeholder="search">
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary mb-2">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <div class="bg-white  shadow" >
        <table id="tblPeminjaman" class="table table-bordered">
            <thead class="bg-thead text-white">
                <tr>
                <th class="text-center" scope="col">No</th>
                <th class="text-center" scope="col">Kode Booking</th>
                <th class="text-center" scope="col">Peminjam</th>
                <th class="text-center" scope="col">Tgl Penggunaan</th>
                <th class="text-center" scope="col">Ruangan</th>
                <th class="text-center" scope="col">Jam Mulai</th>
                <th class="text-center" scope="col">Validasi</th>
                <?php if($this->session->userdata('status') == 'staff pelayanan' || $this->session->userdata('status') == 'admin') { ?>
                    <th class="text-center" scope="col">Aksi</th>
                <?php }?>
                </tr>
            </thead>
            <tbody>
            <?php 
                $no = 1;
                foreach ($peminjaman as $u){ 
            ?>
                <tr class="text-center">
                    <td><?php echo $no++; ?></td>
                    <td><a href="<?php echo site_url('Peminjaman/detailPeminjaman/'.$u->id_peminjaman.'/'.$u->jenis_peminjaman); ?>"><?php echo $u->id_peminjaman; ?></a></td>
                    <?php if($u->nama_mahasiswa == 'dosen'){ ?>
                        <td><?php echo $u->nama_mahasiswa; ?></td>
                    <?php }else{ ?>
                        <td><?php echo $u->nama_mahasiswa; ?></td>
                    <?php } ?>
                    <td><?= date("d-m-Y", strtotime($u->tanggal_mulai_penggunaan)); ?></td>
                    <td><?php echo $u->nama_ruangan; ?></td>
                    <td><?php $mulai = explode("-", $u->nama_waktu);
                                echo $start = $mulai[0]; ?></td>
                    <td
                    <?php
                        if($u->validasi_akademik == 'setuju'){ ?>
                            class="text-success"
                        <?php }else if($u->validasi_akademik == 'terkirim'){ ?>
                            class="text-warning"
                        <?php }else if($u->validasi_akademik == 'pending'){ ?>
                            class="text-darik"
                        <?php }else{ ?>
                            class="text-danger"
                        <?php }
                    ?>><?= $u->validasi_akademik;?>
                    </td>
                    <?php if($this->session->userdata('status') == 'staff pelayanan' || $this->session->userdata('status') == 'admin' ) { ?>
                        <th class="text-center">
                        <?php if( $u->validasi_akademik == 'terkirim'){ ?>
                            <a href="<?php echo site_url('Peminjaman/validasiPeminjaman/'.$u->id_peminjaman); ?>"  class="btn btn-success btn-sm" title="Setuju Peminjaman">Setuju</a>
                            <a data-toggle="modal" data-id="<?php echo $u->id_peminjaman; ?>" title="Tolak Peminjaman" class="modalTolakPeminjaman btn btn-outline-danger btn-sm" href="#modalTolakPeminjaman">Tolak</a>
                            <a href="https://api.whatsapp.com/send?phone=<?= $u->nomor_telpon?>&text=Hi%20Peminjaman%20Ruangan%20Telah%20Selesai%20Diproses.%20 Terimakasih" 
                            target="_blank"class="btn btn-outline-success btn-sm" title="Kirim Pesan WA"><i class="fab fa-whatsapp"></i></a>
                           
                        <?php } ?> 
                        <?php if( $u->validasi_akademik == 'setuju'){ ?>
                           <?php if( $u->id_peminjam == $this->session->userdata('username') || $this->session->userdata('username') == 'admin'){ ?>
                                <a data-toggle="modal" data-id="<?php echo $u->id_peminjaman; ?>" title="Batalkan Peminjaman" class="modalBatalPeminjaman btn btn-outline-secondary btn-sm" href="#modalBatalPeminjaman">Batal</a>
                            <?php } ?> 
                        <?php } ?> 
                        </th>
                    <?php }?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $('#tblPeminjaman').DataTable();
</script>

<div class="modal fade" id="modalBatal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        Peminjaman yang sudah di proses oleh kasubag tidak bisa dibatalkan <br>
        <div class="col-6 col-md-8 ">
        </div>
        <div class="col-6 col-md-12">
            <div class="d-flex flex-row-reverse bd-highlight">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalTolakPeminjaman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form action="<?php echo base_url().'Peminjaman/tolakPeminjaman'; ?>" method="post">
        Alasan Penolakan : <br>
        <input type="text"  hidden class="form-control" name="id_peminjaman" id="id_peminjaman" value=""/>
        <input type="text"  hidden class="form-control" name="jenis"  value="non kelas"/>
        <textarea class="form-control"  name="catatan_penolakan" rows="3"></textarea>
            <div class="d-flex flex-row-reverse bd-highlight py-2">
                <div class="px-1"><button type="submit" class="btn btn-primary btn-sm">Tolak Peminjaman</button></div>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalBatalPeminjaman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div>
            <h6>Silahkan Isi Alasan Pembatalan</h6>
        </div>
        <form action="<?php echo base_url().'Peminjaman/batalPeminjaman'; ?>" method="post">
        <input type="text"  hidden class="form-control" name="id_peminjaman" id="id_peminjaman" value=""/>
        <textarea class="form-control"  name="catatan_penolakan" rows="3"></textarea>
            <div class="d-flex flex-row-reverse bd-highlight py-2">
                <div class="px-1"><button type="submit" class="btn btn-primary btn-sm">Batalkan Peminjaman</button></div>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>



<script>
$(document).on("click", ".modalTolakPeminjaman", function () {
     var peminjaman = $(this).data('id');
     $(".modal-body #id_peminjaman").val( peminjaman );
     $(".peminjaman").val( peminjaman );
});
</script>

<script>
$(document).on("click", ".modalBatalPeminjaman", function () {
     var peminjaman = $(this).data('id');
     $(".modal-body #id_peminjaman").val( peminjaman );
     $(".peminjaman").val( peminjaman );
});
</script>

