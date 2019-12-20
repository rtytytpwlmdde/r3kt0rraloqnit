<?php if($this->session->userdata('status') == "pengguna"){ ?>
    <div class="container">
<?php }else{?><div class="">
<?php }?>
  <div class="row mt-4 ">
    <div class="col-md-8 order-md-1 mb-2 pb-2">
      <div class="card shadow mb-4">
        <div class="card-header py-3 bg-thead text-white">
          <h6 class="m-0 font-weight-bold ">Form Pengembalian Barang</h6>
        </div>
        <div class="card-body">
        <?php 
        $id = null;
        $tgl_mulai = null;
        $tgl_selesai = null;
        $jam_mulai = null;
        $jam_selesai = null; 
        ?>
         <form class="user" action="<?php echo base_url().'index.php?/Peminjaman/tambahPengembalianBarang'; ?>" method="post">
          
          <div class="form-group">
              <label for="exampleFormControlSelect1">Kode Boking</label>
              
              <input type="text"  hidden name="id_peminjaman" class="form-control " value="<?= $id_peminjaman?>">
              <input type="text"  disabled name="" class="form-control " value="<?= $id_peminjaman?>">
          </div>
          <div class="form-group">
              <label for="exampleFormControlSelect1">Tanggal Pengembalian</label>
              <input type="date"  required name="tanggal_pengembalian" class="form-control ">
          </div>
          <div class="form-group">
              <label for="exampleFormControlSelect1">Jam Pengembalian</label>
              <input type="time"  required name="jam_pengembalian" class="form-control ">
              <small>Format 24 jam</small>
          </div>
          <div class="form-group">
              <label for="">Catatan</label>
              <textarea class="form-control"  name="catatan_pengembalian" rows="3"></textarea>
          </div>
          
          <button type="submit" class="btn btn-primary btn-user btn-block">
                Submit
            </button>
        </form> 
        </div>
      </div>
    </div>
    
    <div class="col-md-4 order-md-2 mb-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3 bg-thead text-white">
          <h6 class="m-0 font-weight-bold  d-flex justify-content-between">Detail Peminjaman 
        </div>
        <div class="card-body" >
            <table id="tblmatakuliah" class="table table-bordered">
                <tbody>
                <?php 
                    foreach ($peminjaman as $u){ 
                ?>
                    <tr class=" ">
                        <td >Kode Boking</td>
                        <td ><?= $u->id_peminjaman; ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Peminjaman</td>
                        <td><?= $u->jenis_peminjaman; ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Peminjaman</td>
                        <td> 
                        <?php $tanggal = $u->tanggal_peminjaman;
                    $day = date("l", strtotime($tanggal));
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
                    ?><?= ", "?>
                <?= date("d-m-Y", strtotime($tanggal)); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Nama Peminjam</td>
                        <td><?= $u->nama_mahasiswa; ?></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><?= $u->id_peminjam; ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Penggunaan</td>
                        <td>
                        <?php
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
                    ?><?= ", "?>
                <?= date("d-m-Y", strtotime($u->tanggal_mulai_penggunaan)); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Ruangan</td>
                        <td> <?php  
                            if($u->jenis_peminjaman == 'barang'){
                                foreach ($sarana as $u){ 
                                    echo $u->nama_barang."<br>";
                                }
                            }else{
                                foreach ($sarana as $u){ 
                                    echo $u->nama_ruangan."<br>";
                                }
                            }
                            ?> 
                        </td>
                    </tr>
                    <tr>
                        <td>Jam Penggunaan</td>
                        <td><?php 
                            foreach($waktu as $w){
                                if($w->id_waktu == $u->jam_mulai){
                                    $mulai = explode("-", $w->nama_waktu);
                                    $start = $mulai[0];
                                }
                                if($w->id_waktu == $u->jam_selesai){
                                    $selesai = explode("-", $w->nama_waktu);
                                    $end = $selesai[1];
                                }
                            }
                            ?>
                            
                            <?= $start?> - <?= $end?>
                        </td>
                    </tr>
                    <tr>
                        <td>Penyelenggara</td>
                        <td><?= $u->penyelenggara; ?></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td><?= $u->keterangan; ?></td>
                    </tr>
                    <tr>
                        <td>Status Validasi</td>
                        <?php if($u->validasi_akademik == 'terkirim'){?>
                            <td class="text-warning"><?= $u->validasi_akademik; ?></td>
                        <?php }else if($u->validasi_akademik == 'setuju'){?>
                            <td class="text-success"><?= $u->validasi_akademik; ?></td>
                        <?php }else{ ?>
                            <td class="text-danger"><?= $u->validasi_akademik; ?></td>
                        <?php }?>
                    </tr>
                    <?php 
                        if($u->validasi_akademik == 'tolak' || $u->validasi_umum == 'tolak' || $u->validasi_kemahasiswaan == 'tolak'){ ?>
                            <tr>
                                <td>Catatan Penolakan</td>
                                <td><?= $u->catatan_penolakan; ?></td>
                            </tr>
                    <?php } ?>
                
                <?php } ?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">© 2017-2019 Company Name</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer>
</div>



<div class="modal fade" id="modalPanduan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Panduan Meminjam Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>Tahapan peminjaman</div>
        <div>
            <p>1. Mengisi form data peminjaman dan menekan tombol Lanjut ke proses selanjutnya</p>
            <p>2. Sistem kemudian menampilkan barang yang boleh dipinjamkan</p>
            <p>2. User dapat memilih barang dengan menekan tombol plus yang berada disamping nama barang</p>
            <p>4. User kemudian menekan tombol kirim peminjaman untuk menyelesaikan proses peminjaman</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>