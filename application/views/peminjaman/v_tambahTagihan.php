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
        $jenis = null;
        $jam_selesai = null; 
        foreach ($peminjaman as $u){ ?>
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
                                        $jenis = $u->jenis_peminjaman; 
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
                <label for="">Keterangan Pengguna</label>
                <textarea disabled class="form-control"  name="keterangan" rows="3" value=""><?= $u->keterangan; ?></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Ruangan</label>
                <input disabled type="text"  required name="penyelenggara" class="form-control " value="<?= $u->nama_ruangan;?><?= $u->nama_barang;?>">
            </div>
            <hr class="mb-4">
            <h5 class="mb-3">Biaya Yang Harus Dibayarkan</h5>
            <div class="d-block my-3">
               <table class="table table-sm table-striped">
                    <thead>
                    <tr>
                        <td>No</td>
                        <td>Tagihan</td>
                        <td>Jumlah</td>
                        <td>Harga @</td>
                        <td>Total</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no=1; $total=0;
                    foreach($tagihan as $t){?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $t->nama_tagihan;?></td>
                        <td><?= $t->jumlah;?></td>
                        <td><?= $t->harga_satuan;?></td>
                        <td>Rp <?= $t->total_tagihan;?></td>
                    </tr>
                    <?php $no++; 
                        $total = $total + $t->total_tagihan;
                     } ?>
                     <tr class="bg-info">
                        <td>#</td>
                        <td class=" text-white" colspan="3">Total Biaya Peminjaman</td>
                        <td class=" text-white" >Rp <?= $total;?></td>
                     </tr>
                    </tbody>
               </table>                     
            </div>
            <form action="<?php echo base_url("peminjaman/kirimPeminjaman")?>" method="post">
                <input type="hidden" name="id_peminjaman" value="<?= $id?>">
                <input type="hidden" name="total_pembayaran" value="<?= $total?>">
                <input type="hidden" name="jenis" value="<?= $jenis?>">
                <div class="row">
                    <div class="col-md-3"> <a href="<?php echo site_url('Peminjaman/hapusPeminjaman/'.$id); ?>"   type="submit" class="btn btn-user btn-block btn-outline-secondary " title="Batalkan peminjaman">
                        Batalkan Peminjaman
                        </a>
                    </div>
                    <div class="col-md-9"> 
                        <button type="submit" class="btn btn-warning btn-user btn-block">Kirim Peminjaman (3/3)</button>
                    </div>
                </div>
            </form>
                
        <?php } ?>
        </div>
      </div>
    </div>
    
    <div class="col-md-4 order-md-2 mb-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3 bg-thead text-white">
          <h6 class="m-0 font-weight-bold  d-flex justify-content-between">Tambahkan Biaya Peminjaman 
            <a  data-toggle="modal" data-target="#modalPanduan"><span class="" title="panduan"><i class="far fa-question-circle"></i></span></a></h6>
        </div>
        <div class="card-body" >
            <form class="user" action="<?php echo base_url().'peminjaman/tambahTagihan'; ?>" method="post" >
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Biaya</label>                    
                    <input type="hidden" name="id_peminjaman"  value="<?= $id?>">
                    <input type="text" name="nama_tagihan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ex, sewa ruangan">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Jumlah</label>
                    <input type="text" name="jumlah" class="form-control" id="exampleInputPassword1" placeholder="ex, 2">
                </div>
                <div class="form-group ">
                    <label for="exampleInputPassword1">Harga Satuan @</label>
                    <input type="text" name="harga_satuan" class="form-control" id="exampleInputPassword1" placeholder="Ex, 100000">
                </div>
                <div class="btn-group" style="width:100%">
                
                    <button type="submit" class="btn btn-primary">Tambahkan Biaya</button>     
                           
                </div>     
            </form>
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