<?php if($this->session->userdata('status') == "pengguna"){ ?>
    <div class="container">
<?php }else{?><div class="">
<?php }?>
  <div class="row mt-4 ">
    <div class="col-md-8 order-md-1 mb-2 pb-2">
      <div class="card shadow mb-4">
        <div class="card-header py-3 bg-thead text-white">
          <h6 class="m-0 font-weight-bold ">Form Data Peminjaman</h6>
        </div>
        <div class="card-body">
        <?php 
        $id = null;
        $tgl_mulai = null;
        $tgl_selesai = null;
        $jam_mulai = null;
        $jam_selesai = null; 
        foreach ($peminjaman as $u){ ?>
        <form class="user" method="post">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Pengguna</label>
                <input disabled type="text"  required name="id_peminjam" class="form-control " value="<?= $id = $u->id_peminjaman; ?>">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Nama</label>
                <input disabled type="text"  required name="id_peminjam" class="form-control " value="<?= $u->nama_mahasiswa; ?>">
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
                                        $tgl_selesai = $u->tanggal_selesai_penggunaan; 
                                        $jam_mulai = $u->jam_mulai;
                                        $jam_selesai = $u->jam_selesai;?>
            <div class="row">
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Jam Mulai</label>
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
                    <label for="exampleFormControlSelect1">Jam Selesai</label>
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
            <div class="form-group">
                <label for="exampleFormControlSelect1">Penyelenggara</label>
                <input disabled type="text"  required name="penyelenggara" class="form-control " value="<?= $u->penyelenggara; ?>">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">No HP / WA</label>
                <input disabled type="text"  required name="penyelenggara" class="form-control " value="<?= $u->nomor_telpon; ?>">
            </div>
            <div class="form-group">
                <label for="">Keterangan Pengguna</label>
                <textarea disabled class="form-control"  name="keterangan" rows="3" value=""><?= $u->keterangan; ?></textarea>
            </div>
            <hr class="mb-4">
            <h5 class="mb-3">Ruangan yang akan dipinjam</h5>
            <div class="d-block my-3"><?php $jumRuangan = 0; $operator=null;
                foreach ($sarana as $a){ ?>
                <div class="custom-control custom-radio py-1">
                    <label class="" for="credit"><?= $a->nama_ruangan ?><?php $operator = $a->id_operator;?>
                    <a href="<?php echo site_url('Peminjaman/hapusSaranaPeminjaman/'.$jenis_peminjaman.'/'.$id.'/'.$a->id_sarana.'/'.$tgl_mulai.'/'.$tgl_selesai.'/'.$jam_mulai.'/'.$jam_selesai); ?>"  class="btn btn-danger btn-sm text-white" title="Hapus Ruangan">
                        <i class="fas fa-trash"></i>
                    </a>
                    </label>
                </div>
                <?php $jumRuangan++;} ?>
            </div>

            <?php if($jumRuangan == 0){ ?>
                <a href="<?php echo site_url('Peminjaman/hapusPeminjaman/'.$id); ?>"   type="submit" class="btn btn-warning btn-user btn-block" title="Selesaikan Peminjaman Ruangan">
                    Batalkan Peminjaman
                </a>
            <?php }else{ ?>
                <a href="<?php echo site_url('Peminjaman/formTambahTagihanPeminjaman/'.$id); ?>"   type="submit" class="btn btn-primary btn-user btn-block" >
                    Lanjut Proses Selanjutnya (2/3)
                </a>
            <?php }?>
        </form> 
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
            <?php if($jumRuangan == 0){ ?>
                <?php 
                $no = 1;
                foreach ($sarana_tersedia as $u){ 
            ?>
            <ul class="list-group mb-1 anyClass" >
                <li class="list-group-item d-flex justify-content-between lh-condensed ">
                <div>
                        <input type="text"  name="id_operator" value="<?= $u->id_operator?>">
                    <h6 class="my-0"><a href="<?php echo base_url("saranaPrasarana/detailRuangan/".$u->id_ruangan)?>"><?php echo $u->nama_ruangan ?></a></h6>
                    <small class="text-muted">Kapasitas <?= $u->kapasitas; ?> orang</small>
                </div>
                <span class="text-muted"> <form action="<?php echo site_url('Peminjaman/tambahSaranaPeminjaman'); ?>" method="post">
                        <input type="text" hidden name="jenis" value="ruangan">
                        <input type="text" hidden name="id_peminjaman" value="<?= $id?>">
                        <input type="text" hidden name="id_sarana" value="<?= $u->id_ruangan?>">
                        <input type="text" hidden name="tgl_mulai" value="<?= $tgl_mulai?>">
                        <input type="text" hidden name="tgl_selesai" value="<?= $tgl_selesai?>">
                        <input type="text" hidden name="jam_mulai" value="<?= $jam_mulai?>">
                        <input type="text" hidden name="jam_selesai" value="<?= $jam_selesai?>">
                        <button class="btn btn-secondary text-white" title="Tambahkan" type="submit"><i class="fas fa-plus-square"></i> </button>
                    </form></span>
                </li>
            </ul>
            <?php } ?>
            <?php }else{ ?>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <small class="text-muted">Ruangan Sudah Ditambahkan</small>
                    </div>
                    </li>
                </ul>
            <?php }?>
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