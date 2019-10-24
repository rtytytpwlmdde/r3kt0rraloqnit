

<?php if($this->session->userdata('status') == "pengguna"){ ?>
    <div class="container">
<?php }else{?><div class="">
<?php }?>
<div class="col-md-12">
    <div class="mt-2">
        <div class="row py-2 ">
            <div class="col-6 col-md-6 ">
                <h3 class="text-muted">Detail Peminjaman</h3>
            </div>
            <div class="col-6 col-md-6 d-flex flex-row-reverse">
                <div class="btn-group">
                <?php foreach ($peminjaman as $a){
                    $validasi_akademik = $a->validasi_akademik;
                    $nomor_telpon = $a->nomor_telpon;
                    $nama_ruangan = $a->nama_ruangan;
                    $id_peminjam = $a->id_peminjam;
                    $catatan_penolakan = $a->catatan_penolakan;
                    $jenis = $a->jenis_peminjaman;
                }?>
                <?php if( $validasi_akademik == 'terkirim'){ ?>
                    <form action="<?php echo base_url("peminjaman/validasiPeminjaman");?>" method="post">
                        <input hidden type="text" name="id_peminjaman" value="<?= $id_peminjaman;?>">
                        <input hidden type="text" name="jenis_peminjaman" value="<?= $jenis;?>">
                        <button type="submit" class="btn btn-success btn-sm" title="Setuju Peminjaman">Setuju</button>
                    </form>
                    <a data-toggle="modal" data-id="<?php echo $id_peminjaman; ?>" title="Tolak Peminjaman" class="modalTolakPeminjaman btn btn-outline-danger btn-sm" href="#modalTolakPeminjaman">Tolak</a>
                    <a data-toggle="modal" data-id="<?php echo $id_peminjaman; ?>" title="Batalkan Peminjaman" class="modalBatalPeminjaman btn btn-outline-secondary btn-sm" href="#modalBatalPeminjaman">Batal</a>

                <?php } ?> 
                <?php if( $validasi_akademik == 'setuju'){ ?>
                    <?php if( $id_peminjam == $this->session->userdata('username') || $this->session->userdata('username') == 'admin'){ ?>
                        <a href="https://api.whatsapp.com/send?phone=<?= $nomor_telpon?>&text=Hi%20Peminjaman%20Ruangan%20<?=$nama_ruangan;?>%20Telah%20Disetujui.%20 Terimakasih" 
                    target="_blank"class="btn btn-outline-success btn-sm" title="Kirim Pesan WA"><i class="fab fa-whatsapp"></i></a>
                    <?php } ?> 
                <?php } ?>  
                    <?php if($validasi_akademik == 'tolak'){ ?>
                    <a href="https://api.whatsapp.com/send?phone=<?= $nomor_telpon?>&text=Hi%20Peminjaman%20Ruangan%20<?=$nama_ruangan;?>%20Telah%20Ditolak.%20 Dengan alasan penolakan <?= $catatan_penolakan?>Terimakasih" 
                    target="_blank"class="btn btn-outline-success btn-sm" title="Kirim Pesan WA"><i class="fab fa-whatsapp"></i></a>
                    
                <?php } ?>
                </div>
                
            </div>
        </div>
    </div>
    <div class="card shadow" >
        <table id="tblmatakuliah" class="table table-bordered">
            <tbody>
             <?php 
                foreach ($peminjaman as $u){ 
             ?>
                <tr class="bg-thead ">
                    <td class="text-white">Kode Boking</td>
                    <td class="text-white"><?= $u->id_peminjaman; ?></td>
                </tr>
                <tr>
                    <td>QR Code</td>
                    <td>
                    <?php 
                        if($u->qr_code == null){ ?>
                            <a class="btn btn-sm btn-secondary" href="<?php echo site_url('Peminjaman/qrcode/'.$u->id_peminjaman.'/'.$u->jenis_peminjaman); ?>" title="tampilkan QR CODE"> Generate QR CODE</a>
                        <?php }else{?>
                           
                            <a href="#gardenImage" data-id="<?php echo base_url().'assets/images/'.$u->qr_code;?>" data-peminjaman="<?= $u->id_peminjaman; ?>" class="openImageDialog thumbnail" data-toggle="modal">
                                <img style="width: 30px;" src="<?php echo base_url().'assets/images/'.$u->qr_code;?>">
                            </a>
                            <?php
                        }
                    ?>
                    </td>
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
                <?php if($u->jenis_peminjaman == 'barang'){ ?>
                <tr>
                    <td>Status Pengembalian</td>
                    <?php if($u->status_kembali == 'sudah'){?>
                        <td class="text-success"><?= $u->status_kembali; ?></td>
                    <?php }else{ ?>
                        <td class="text-danger"><?= $u->status_kembali; ?>
                        <a href="<?php echo base_url("peminjaman/formPengembalianBarang/".$u->id_peminjaman);?>" class="btn btn-sm btn-info">Barang Telah Dikembalikan?</a>
                        </td>
                    <?php }?>
                </tr>
                <tr>
                    <td>Tanggal Pengembalian</td>
                    <td><?= date("d-m-Y", strtotime($u->tanggal_pengembalian)); ?></td>
                </tr>
                <tr>
                    <td>Jam Pengembalian</td>
                    <td><?= $u->jam_pengembalian; ?></td>
                </tr>
                <tr>
                    <td>Catatan Pengembalian</td>
                    <td><?= $u->catatan_pengembalian; ?></td>
                </tr>
                <?php } ?>
             
            <?php } ?>
            </tbody>
        </table>
    </div><br>
</div>


<div class="modal fade" id="modalPengembalianBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form action="<?php echo base_url().'Peminjaman/pengembalianBarang'; ?>" method="post">
        Catatan pengembalian barang : <br>
        <input type="text"  hidden class="form-control" name="id_peminjaman" id="id_peminjaman" value=""/>
        <input type="text"  hidden class="form-control" name="status_kembali"  value="sudah dikembalikan"/>
        <textarea class="form-control"  name="catatan_pengembalian" rows="3"></textarea>
            <div class="d-flex flex-row-reverse bd-highlight py-2">
                <div class="px-1"><button type="submit" class="btn btn-primary btn-sm">Barang telah dikembalikan</button></div>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
$(document).on("click", ".modalPengembalianBarang", function () {
     var peminjaman = $(this).data('id');
     $(".modal-body #id_peminjaman").val( peminjaman );
     $(".peminjaman").val( peminjaman );
});
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

<div class="modal fade" id="gardenImage" tabindex="-1" role="dialog" aria-labelledby="gardenImageLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="<?php echo base_url("peminjaman/buktiPeminjaman")?>" method="post">
                <div class="modal-body text-center">
                    <img id="myImage" style="width: 300px;" class="img-responsive" src="" alt="">
                    <h6><input type="text" name="id_peminjaman" class="form-control text-center" style="border-width:0px; border:none;" id="id_peminjaman" value=""/></h6>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary center-block" ><i class="fas fa-download fa-sm text-white-50"></i> Bukti Peminjaman</button>
            </form>
                    <button type="button" class="btn btn-sm btn-danger center-block" data-dismiss="modal">close</button>
                </div>
        </div>
    </div>
</div>

<script>
$(document).on("click", ".openImageDialog", function () {
    var myImageId = $(this).data('id');
    $(".modal-body #myImage").attr("src", myImageId);
});
</script>
<script>
$(document).on("click", ".openImageDialog", function () {
     var peminjaman = $(this).data('peminjaman');
     $(".modal-body #id_peminjaman").val( peminjaman );
});
</script>




