<?php if($this->session->userdata('status') == "pengguna" || $this->session->userdata('logged_in') == FALSE ){ ?>
    <div class="container">

<?php }else{?><div class="">
<?php }?>
<?php
        $notif = $this->session->flashdata('gagal');
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
        $notifsukses = $this->session->flashdata('sukses');
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
  <div class="row mt-4 ">
    <div class="col-md-8 order-md-1 mb-2 pb-2">
      <div class="card shadow mb-4">
        <div class="card-header py-3 bg-thead text-white">
          <h6 class="m-0 font-weight-bold ">Form Data Geser Ruangan</h6>
        </div>
        <div class="card-body">
        <?php 
        $id = null;
        $tgl_mulai = null;
        $tgl_selesai = null;
        $jam_mulai = null;
        $jam_selesai = null; 
        $jenis_peminjaman = null; 
        foreach ($peminjaman as $u){ 
            $jenis_peminjaman = $u->jenis_peminjaman;?>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Nama</label>
                <input disabled type="text"  required name="id_peminjam" class="form-control " value="<?= $u->nama_mahasiswa; ?> <?= $u->nama_peminjam; ?>">
            </div>
            <div class="shadow-none p-2 mb-3 bg-light rounded">
                <div class="row">
                  <div class="col-md-12 mb-3">
                      <div class="form-group">
                          <h5 class="text-dark">Tanggal Dan Jam Penggunaan</h5>
                      </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="exampleFormControlSelect1">Tanggal Penggunaan</label>
                        <input disabled type="text"  required name="tanggal_mulai_penggunaan" class="form-control " 
                        value="<?php 
                        $day = date("l", strtotime($u->tanggal_mulai_penggunaan));
                        $hari = null;
                        if($day == "Sunday"){
                            echo $hari = "Minggu";
                        }else if($day == "Monday"){
                            echo $hari = "Senin";
                        }else if($day == "Tuesday"){
                            echo $hari = "Selasa";
                        }else if($day == "Wednesday"){
                            echo $hari = "Rabu";
                        }else if($day == "Thursday"){
                            echo $hari = "Kamis";
                        }else if($day == "Friday"){
                            echo $hari = "Jumat";
                        }else if($day == "Saturday"){
                            echo $hari = "Sabtu";
                        }
                        ?><?= ","?>
                    <?= date("d-m-Y", strtotime($u->tanggal_mulai_penggunaan)); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="exampleFormControlSelect1">Tanggal Selesai Penggunaan</label>
                        <input disabled type="text"  required name="tanggal_mulai_penggunaan" class="form-control " 
                        value="<?php 
                        $day = date("l", strtotime($u->tanggal_selesai_penggunaan));
                        $hari = null;
                        if($day == "Sunday"){
                            echo $hari = "Minggu";
                        }else if($day == "Monday"){
                            echo $hari = "Senin";
                        }else if($day == "Tuesday"){
                            echo $hari = "Selasa";
                        }else if($day == "Wednesday"){
                            echo $hari = "Rabu";
                        }else if($day == "Thursday"){
                            echo $hari = "Kamis";
                        }else if($day == "Friday"){
                            echo $hari = "Jumat";
                        }else if($day == "Saturday"){
                            echo $hari = "Sabtu";
                        }
                        ?><?= ","?>
                    <?= date("d-m-Y", strtotime($u->tanggal_selesai_penggunaan)); ?>">
                    </div>
                </div>
                <?php   $tgl_mulai = $u->tanggal_mulai_penggunaan;
                        $id = $u->id_peminjaman;
                                            $tgl_selesai = $u->tanggal_selesai_penggunaan; 
                                            $jam_mulai = $u->jam_mulai;
                                            $jam_selesai = $u->jam_selesai;?>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Jam Mulai Penggunaan</label>
                            <input hidden type="text"  required name="tanggal_mulai_penggunaan" class="form-control " value="
                            <?php foreach ($waktu as $a) { 
                                if($a->id_waktu == $u->jam_mulai){
                                    $pieces = explode("-", $a->nama_waktu);
                                    echo $start = $pieces[0];
                                }
                                        ?>
                                <?php } ?>  ">
                            <input disabled type="text" class="form-control" value="<?= $start;?>">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Jam Selesai Penggunaan</label>
                            <input hidden type="text"  required name="tanggal_mulai_penggunaan" class="form-control " value="
                                <?php foreach ($waktu as $a) { 
                                        if($a->id_waktu == $u->jam_selesai){
                                            $pieces = explode("-", $a->nama_waktu);
                                            echo $end = $pieces[1];
                                            }
                                        ?>
                                <?php } ?>  
                                    ">
                            <input disabled type="text" class="form-control" value="<?= $end;?>">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="shadow-none p-2 mb-3 bg-light rounded">
                <div class="row">
                  <div class="col-md-12 mb-3">
                      <div class="form-group">
                          <h5 class="text-dark">Tanggal Dan Jam Acara</h5>
                      </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="exampleFormControlSelect1">Tanggal Acara</label>
                        <input disabled type="text"  required name="tanggal_mulai_acara" class="form-control " 
                        value="<?php 
                        $day = date("l", strtotime($u->tanggal_mulai_acara));
                        $hari = null;
                        if($day == "Sunday"){
                            echo $hari = "Minggu";
                        }else if($day == "Monday"){
                            echo $hari = "Senin";
                        }else if($day == "Tuesday"){
                            echo $hari = "Selasa";
                        }else if($day == "Wednesday"){
                            echo $hari = "Rabu";
                        }else if($day == "Thursday"){
                            echo $hari = "Kamis";
                        }else if($day == "Friday"){
                            echo $hari = "Jumat";
                        }else if($day == "Saturday"){
                            echo $hari = "Sabtu";
                        }
                        ?><?= ","?>
                    <?= date("d-m-Y", strtotime($u->tanggal_mulai_acara)); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="exampleFormControlSelect1">Tanggal Selesai Acara</label>
                        <input disabled type="text"  required name="tanggal_mulai_penggunaan" class="form-control " 
                        value="<?php 
                        $day = date("l", strtotime($u->tanggal_selesai_acara));
                        $hari = null;
                        if($day == "Sunday"){
                            echo $hari = "Minggu";
                        }else if($day == "Monday"){
                            echo $hari = "Senin";
                        }else if($day == "Tuesday"){
                            echo $hari = "Selasa";
                        }else if($day == "Wednesday"){
                            echo $hari = "Rabu";
                        }else if($day == "Thursday"){
                            echo $hari = "Kamis";
                        }else if($day == "Friday"){
                            echo $hari = "Jumat";
                        }else if($day == "Saturday"){
                            echo $hari = "Sabtu";
                        }
                        ?><?= ","?>
                    <?= date("d-m-Y", strtotime($u->tanggal_selesai_acara)); ?>">
                    </div>
                </div>
                <?php   $tgl_mulai = $u->tanggal_mulai_acara;
                                            $tgl_selesai = $u->tanggal_selesai_acara; 
                                            $jam_mulai = $u->jam_mulai_acara;
                                            $jam_selesai = $u->jam_selesai_acara;?>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Jam Mulai Acara</label>
                            <input hidden type="text"  required name="tanggal_mulai_penggunaan" class="form-control " value="
                            <?php foreach ($waktu as $a) { 
                                if($a->id_waktu == $u->jam_mulai_acara){
                                    $pieces = explode("-", $a->nama_waktu);
                                    echo $start = $pieces[0];
                                }
                                        ?>
                                <?php } ?>  ">
                            <input disabled type="text" class="form-control" value="<?= $start;?>">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Jam Selesai Acara</label>
                            <input hidden type="text"  required name="tanggal_mulai_penggunaan" class="form-control " value="
                                <?php foreach ($waktu as $a) { 
                                        if($a->id_waktu == $u->jam_selesai_acara){
                                            $pieces = explode("-", $a->nama_waktu);
                                            echo $end = $pieces[1];
                                            }
                                        ?>
                                <?php } ?>  
                                    ">
                            <input disabled type="text" class="form-control" value="<?= $end;?>">
                        </div>
                    </div>
                </div>
            </div>
            <hr class="mb-4">
            <h5 class="mb-3">Ruangan yang saat ini digunakan</h5>
            <div class="d-block my-3"><?php $jumRuangan = 0; $operator=null;
                foreach ($sarana as $a){ ?>
                <div class="custom-control custom-radio py-1">
                    <label class="" for="credit"><?= $a->nama_ruangan ?><?php $operator = $a->id_operator;?>
                    <a data-toggle="modal" data-id="<?php echo $u->id_peminjaman; ?>" data-id_ruangan_dipinjam="<?php echo $u->id_sarana_peminjaman; ?>" title="Ganti Ruangan" class="modalTolakPeminjaman btn btn-outline-danger btn-sm" href="#modalTolakPeminjaman">Ganti</a>
                    </label>
                </div>
                <?php $jumRuangan++;} ?>
            </div>
                    <div class="row">
                    <div class="col-md-12"> 
                        <a href="<?php echo site_url('index.php?/Peminjaman/detailPeminjaman/'.$id.'/'.$jenis_peminjaman); ?>"    class="btn btn-user btn-block btn-primary " >
                        Simpan
                        </a>
                    </div>
                </div>
        <?php } ?>
        </div>
      </div>
    </div>
    
    <div class="col-md-4 order-md-2 mb-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3 bg-thead text-white">
          <h6 class="m-0 font-weight-bold  d-flex justify-content-between">Pilih Ruangan 
            <a  data-toggle="modal" data-target="#modalPanduan"><span class="" title="panduan"><i class="far fa-question-circle"></i></span></a></h6>
        </div>
        <div class="card-body" style="height:500px; overflow-y: scroll;">
             Silahkan tekan tombol "Ganti" untuk mengganti ruangan
        </div>
      </div>
    </div>
  </div>

</div>



<div class="modal fade" id="modalPanduan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Panduan Meminjam Ruangan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>Tahapan peminjaman</div>
        <div>
            <p>1. Mengisi form data peminjaman dan menekan tombol Lanjut ke proses selanjutnya</p>
            <p>2. Sistem kemudian menampilkan ruangan yang boleh dipinjamkan</p>
            <p>2. User dapat memilih ruangan dengan menekan tombol plus yang berada disamping nama ruangan</p>
            <p>4. User kemudian menekan tombol kirim peminjaman untuk menyelesaikan proses peminjaman</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modalTolakPeminjaman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
      <div class="card shadow mb-4">
        <div class="card-header py-3 bg-thead text-white">
          <h6 class="m-0 font-weight-bold  d-flex justify-content-between">Pilih Ruangan 
            <a  data-toggle="modal" data-target="#modalPanduan"><span class="" title="panduan"><i class="far fa-question-circle"></i></span></a></h6>
        </div>
        <div class="card-body" style="height:500px; overflow-y: scroll;">
                <?php 
                $no = 1;
                foreach ($sarana_tersedia as $u){ 
            ?>
            <ul class="list-group mb-1 anyClass" >
                <li class="list-group-item d-flex justify-content-between lh-condensed ">
                <div>
                    <h6 class="my-0"><a href="<?php echo base_url("index.php?/saranaPrasarana/detailRuangan/".$u->id_ruangan)?>"><?php echo $u->nama_ruangan ?></a></h6>
                    <small class="text-muted">Kapasitas <?= $u->kapasitas; ?> orang</small>
                </div>
                <span class="text-muted"> 
                <form action="<?php echo base_url('index.php?/Peminjaman/geserRuangan'); ?>" method="post">
                        <input type="text" hidden name="jenis" value="ruangan">
                        <input type="text" hidden name="id_peminjaman" value="<?= $id?>">
                        <input type="text" hidden name="id_sarana" value="<?= $u->id_ruangan?>">
                        <input type="text" hidden name="id_operator" value="<?= $u->id_operator?>">
                        
                        <input type="text"   class="form-control" name="id_ruangan_dipinjam" id="id_ruangan_dipinjam"  value=""/>
                        <button class="btn btn-secondary text-white" title="Tambahkan" type="submit"><i class="fas fa-plus-square"></i> </button>
                    </form>
                </span>
                </li>
            </ul>
            <?php } ?>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>

<script>
$(document).on("click", ".modalTolakPeminjaman", function () {
     var id_ruangan_dipinjam = $(this).data('id_ruangan_dipinjam');
     $(".modal-body #id_ruangan_dipinjam").val( id_ruangan_dipinjam );
     $(".id_ruangan_dipinjam").val( id_ruangan_dipinjam );
});
</script>