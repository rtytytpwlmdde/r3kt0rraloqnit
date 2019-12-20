

<?php if($this->session->userdata('status') == "pengguna" || $this->session->userdata('logged_in') == false){ ?>
    <div class="container">
<?php }else{?><div class="">
<?php }?>
<div class="col-md-12">
    <div class="mt-2">
    <?php
        $gagal = $this->session->flashdata('gagal');
        if($gagal != NULL){
            echo '
            <div class="alert alert-danger alert-dismissible fade show bg-danger text-white" role="alert">
              <strong></strong> '.$gagal.'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            ';
        }
        $sukses = $this->session->flashdata('sukses');
        if($sukses != NULL && $sukses =="PEMINJAMAN BERHASIL DIKIRIM"){
            echo '
            <div class="alert alert-success alert-dismissible fade show bg-success text-white" role="alert">
              <strong></strong> Peminjaman Berhasil Dikirim, <span class="badge badge-danger">Pastikan untuk MENCETAK BUKTI PEMINJAMAN sebagai bukti peminjaman dan untuk pengecekan !!! </span>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            ';
        }elseif($sukses != NULL ){
            echo '
            <div class="alert alert-success alert-dismissible fade show bg-success text-white" role="alert">
              <strong></strong> '.$sukses.'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            ';
        }
    ?>
        <input  hidden type="text" id="sukses" value="<?php echo $sukses = $this->session->flashdata('sukses');?>">

        <div class="row py-2 ">
            <div class="col-6 col-md-6 ">
                <h3 class="text-muted">Detail Peminjaman</h3>
            </div>
            <div class="col-6 col-md-6 d-flex flex-row-reverse">
                <div class="btn-group">
                <?php foreach ($header as $a){
                     $validasi_akademik = $a->validasi_akademik;
                    $nomor_telpon = $a->nomor_telpon;
                    $nama_ruangan = $a->nama_ruangan;
                    $tgl_mulai = $a->tanggal_mulai_penggunaan;
                    $tgl_selesai = $a->tanggal_selesai_penggunaan;
                    $nama_ruangan = $a->nama_ruangan;
                    $id_peminjam = $a->id_peminjam;
                    $jam_mulai = $a->jam_mulai;
                    $jam_selesai = $a->jam_selesai;
                    $operator = $a->operator;
                    $catatan_penolakan = $a->catatan_penolakan;
                    $jenis_peminjaman = $a->jenis_peminjaman;
                    $jenis = $a->jenis_peminjaman;
                    $jenis_ruangan_peminjaman = $a->jenis_ruangan;
                    $alasan_penolakan = $a->alasan_penolakan;
                    foreach($waktu as $w){
                        if($w->id_waktu == $a->jam_mulai){
                            $mulai = explode("-", $w->nama_waktu);
                            $start = $mulai[0];
                        }
                        if($w->id_waktu == $a->jam_selesai){
                            $selesai = explode("-", $w->nama_waktu);
                            $end = $selesai[1];
                        }
                    }
                }?>
                <?php if( $validasi_akademik == 'terkirim' && $this->session->userdata('status') != 'pengguna' && $this->session->userdata('logged_in') == true){ ?>
                    <form action="<?php echo base_url("index.php?/Peminjaman/validasiPeminjaman");?>" method="post">
                        <input hidden type="text" name="id_peminjaman" value="<?= $id_peminjaman;?>">
                        <input hidden type="text" name="jenis_peminjaman" value="<?= $jenis;?>">
                    <?php if( 'admin' == $this->session->userdata('username')){ ?>
                                <input hidden type="text" name="jenis_validasi" value="admin">
                    <?php } ?> 
                        <button type="submit" class="btn btn-success btn-sm" title="Setuju Peminjaman">Setuju</button>
                    <a data-toggle="modal" data-id="<?php echo $id_peminjaman; ?>" data-jenis_peminjaman="<?php echo $jenis_peminjaman; ?>" title="Tolak Peminjaman" class="modalTolakPeminjaman btn btn-outline-danger btn-sm" href="#modalTolakPeminjaman">Tolak</a>
                    <a data-toggle="modal" data-id="<?php echo $id_peminjaman; ?>" data-jenis_peminjaman="<?php echo $jenis_peminjaman; ?>" title="Batalkan Peminjaman" class="modalBatalPeminjaman btn btn-outline-secondary btn-sm" href="#modalBatalPeminjaman">Batal</a>
                    </form>

                    <?php if( 'admin' == $this->session->userdata('username')){ ?>
                    <form action="<?php echo base_url("index.php?/Peminjaman/validasiPeminjaman");?>" method="post">
                        <input hidden type="text" name="id_peminjaman" value="<?= $id_peminjaman;?>">
                        <input hidden type="text" name="jenis_peminjaman" value="<?= $jenis;?>">
                        <input hidden type="text" name="jenis_validasi" value="admin">
                        <button type="submit" class="ml-2 btn btn-dark btn-sm" title="Validasi dengan menekan tombol ini dapat langsung menyetujui semua ruangan yang dipinjam tanpa meminta persetujuan operator ruangan terkait">v</button>
                    </form>

                    <?php } ?> 
                <?php } ?> 
                
                <?php if( $validasi_akademik == 'setuju' && $operator == $this->session->userdata('username')){ ?>
                    <a data-toggle="modal" data-id="<?php echo $id_peminjaman; ?>" data-jenis="<?php echo $jenis_peminjaman; ?>" title="Tolak Peminjaman" class="modalTolakPeminjaman btn btn-outline-danger btn-sm" href="#modalTolakPeminjaman">Tolak</a>
                <?php } ?> 
                <?php if( $validasi_akademik == 'setuju' && $operator == $this->session->userdata('username')){ ?>
                    <a  title="Geser Peminjaman" class="btn btn-info btn-sm" href="<?php echo base_url("index.php?/Peminjaman/geser/".$id_peminjaman);?>">Geser</a>
                <?php } ?> 
                <?php if( $validasi_akademik == 'setuju'){ ?>
                        <a href="https://api.whatsapp.com/send?phone=<?= $nomor_telpon?>&text=Informasi Penggunaan Ruangan :
                                %0AStatus Peminjaman Ruangan <?= $nama_ruangan?> Telah Disetujui.  
                                %0ATanggal : <?= date("d-m-Y", strtotime($tgl_mulai)); ?>s/d<?= date("d-m-Y", strtotime($tgl_selesai)); ?>
                                %0AJam 	: <?= $start ?> - <?= $end ?>
                                %0A%0ATerimakasih
                                %0A%0ATTD 
                                %0A%0A<?= $this->session->userdata('username');?>" 
                            target="_blank"class="btn btn-outline-success btn-sm" title="Kirim Pesan WA"><i class="fab fa-whatsapp"></i></a>
                    <?php }if( $validasi_akademik == 'tolak'){ ?>
                        <a href="https://api.whatsapp.com/send?phone=<?= $nomor_telpon?>&text=Informasi Penggunaan Ruangan :
                                %0AStatus Peminjaman Ruangan <?= $nama_ruangan?> Telah Ditolak.  
                                %0ATanggal : <?= date("d-m-Y", strtotime($tgl_mulai)); ?>s/d<?= date("d-m-Y", strtotime($tgl_selesai)); ?>
                                %0AJam 	: <?= $start ?> - <?= $end ?>
                                %0AAlasan Penolakan 	: <?= $alasan_penolakan ?>
                                %0A%0ATerimakasih
                                %0A%0ATTD 
                                %0A%0A<?= $this->session->userdata('username');?>" 
                            target="_blank"class="btn btn-outline-success btn-sm" title="Kirim Pesan WA"><i class="fab fa-whatsapp"></i></a>
                    
                <?php }?>
                </div>
                
            </div>
        </div>
    </div>
    <div class="card shadow" >
        <table id="tblmatakuliah" class="table table-bordered">
            <tbody>
             <?php $count = 0;
                foreach ($peminjaman as $u){ 
             ?>
                <tr class="bg-thead ">
                    <td class="text-white">Kode Boking</td>
                    <td class="text-white"><?= $u->id_peminjaman; ?> </td>
                </tr>
                <tr>
                    <td>QR Code</td>
                    <td>
                    <div class="btn-group">

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
                    <form action="<?php echo base_url("index.php?/Peminjaman/buktiPeminjaman")?>" method="post">
                        <input type="hidden" name="id_peminjaman" class="form-control text-center"  id="id_peminjaman" value="<?= $u->id_peminjaman; ?>"/>
                        <button type="submit" target="_blank" class="ml-2 btn btn-sm btn-primary " ><i class="fas fa-download fa-sm text-white-50"></i> Bukti Peminjaman</button>
                    </form>
                    </div>
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
                    <td><?= $u->nama_mahasiswa; ?><?= $u->nama_peminjam; ?></td>
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
                <?= date("d-m-Y", strtotime($u->tanggal_mulai_penggunaan)); ?> sd
                <?php
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
                ?><?= ", "?>
            <?= date("d-m-Y", strtotime($u->tanggal_selesai_penggunaan)); ?>
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Selesai Penggunaan</td>
                    <td>
                    <?php
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
                ?><?= ", "?>
            <?= date("d-m-Y", strtotime($u->tanggal_mulai_acara)); ?> sd 
            <?php
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
                ?><?= ", "?>
            <?= date("d-m-Y", strtotime($u->tanggal_selesai_acara)); ?>
                    </td>
                </tr>
                <tr>
                    <td>Sarana</td>
                    <td> <?php  
                        if($u->jenis_peminjaman == 'barang'){
                            foreach ($sarana as $u){ 
                                if($u->status_peminjaman == 'terkirim'){
                                    echo $u->nama_barang."<span class='badge badge-warning'>".$u->status_peminjaman."</span><br>";
                                }else if($u->status_peminjaman == 'setuju'){
                                    echo $u->nama_barang."<span class='badge badge-success'>".$u->status_peminjaman."</span><br>";
                                }else{
                                    echo $u->nama_barang."<span class='badge badge-danger'>".$u->status_peminjaman."</span><br>";
                                }
                            }
                        }else{
                            foreach ($sarana as $u){ 
                                if($u->status_peminjaman == 'terkirim'){
                                    echo $u->nama_ruangan."<span class='badge badge-warning'>".$u->status_peminjaman."</span><br>";
                                }else if($u->status_peminjaman == 'setuju'){
                                    echo $u->nama_ruangan."<span class='badge badge-success'>".$u->status_peminjaman."</span><br>";
                                }else{
                                    echo $u->nama_ruangan."<span class='badge badge-danger'>".$u->status_peminjaman."</span><br>";
                                }                            }
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
                    <td>Jam Acara</td>
                    <td><?php 
                        foreach($waktu as $w){
                            if($w->id_waktu == $u->jam_mulai_acara){
                                $mulai = explode("-", $w->nama_waktu);
                                $start = $mulai[0];
                            }
                            if($w->id_waktu == $u->jam_selesai_acara){
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
                    <td>No Hp / WA</td>
                    <td><?= $u->nomor_telpon; ?></td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td><?= $u->keterangan; ?></td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td><a target="_blank" href="<?php echo base_url("assets/pdfjs/web/viewer.html?file=../../peminjaman/".$u->file_peminjaman);?>"> <i class="fas fa-file-pdf"></i> File</a></td>
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
                <tr>
                    <td>Total Pembayaran</td>
                    <td>
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
                                <td class="text-lrighteft"><?php  echo "Rp " . number_format($t->harga_satuan,0,',','.');?></td>
                                <td class="text-right"><?php  echo "Rp " . number_format($t->total_tagihan,0,',','.');?></td>
                            </tr>
                            <?php $no++; 
                                $total = $total + $t->total_tagihan;
                            } ?>
                            <tr class="bg-info">
                                <td>#</td>
                                <td class=" text-white" colspan="3">Total Biaya Peminjaman</td>
                                <td class="text-right text-white" class=" text-white" ><?php  echo "Rp " . number_format($total,0,',','.');?></td>
                            </tr>
                            </tbody>
                        </table>    
                    </td>
                </tr>
                <tr>
                    <td>Status Pembayaran</td>
                    <?php if($u->status_pembayaran == 'belum bayar'){?>
                        <td class="text-warning"><?= $u->status_pembayaran; ?>
                            <a data-toggle="modal" data-id="<?php echo $id_peminjaman; ?>"  class="modalPembayaran btn btn-outline-info btn-sm" href="#modalPembayaran">Sudah Bayar?</a>
                        </td>
                    <?php }elseif($u->status_pembayaran == 'menunggu validasi'){?>
                        <td class="text-warning">Menunggu proses validasi pembayaran
                            <a class="ml-2" target="_blank" href="<?php echo base_url("assets/buktiPembayaran/".$u->bukti_pembayaran);?>">download</a>
                            <?php if($this->session->userdata('status') == 'admin'){?>
                                <form action="<?php echo base_url("index.php?/Peminjaman/validasiPembayaran/");?>" method="post">        
                                    <input type="hidden" name="id_peminjaman" value="<?= $u->id_peminjaman?>">                             
                                    <input type="hidden" name="jenis" value="<?= $u->jenis_peminjaman?>">                       
                                     <button type="submit" class="ml-2 btn btn-sm btn-outline-info">validasi pembayaran?</button>
                                </form>    
                            <?php }?>
                        </td>
                    <?php }else{ ?>
                        <td class="text-"><?= $u->status_pembayaran; ?>
                            <a class="ml-2" target="_blank" href="<?php echo base_url("assets/buktiPembayaran/".$u->bukti_pembayaran);?>">download</a></td>
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
                        <?php if($this->session->userdata('username') == $u->id_operator){?>
                        <a href="<?php echo base_url("index.php?/Peminjaman/formPengembalianBarang/".$u->id_peminjaman);?>" class="btn btn-sm btn-info">Barang Telah Dikembalikan?</a>
                        <?php }?>
                        </td>
                    <?php }?>
                </tr>
                <tr>
                    <td>Tanggal Pengembalian</td>
                    <td>
                    <?php if($u->status_kembali == 'sudah'){
                            echo date("d-m-Y", strtotime($u->tanggal_pengembalian)); 
                        }else{ 
                            echo "belum dikembalikan";
                        } ?>
                    
                    </td>
                </tr>
                <tr>
                    <td>Jam Pengembalian</td>
                    <td><?php if($u->status_kembali == 'sudah'){
                            echo $u->jam_pengembalian; 
                        }else{ 
                            echo "belum dikembalikan";
                        } ?>
                    </td>

                </tr>
                <tr>
                    <td>Catatan Pengembalian</td>
                    <td><?= $u->catatan_pengembalian; ?></td>
                </tr>
                <?php } ?>
             
            <?php break; } ?>
            </tbody>
        </table>
    </div><br>
</div>


<div class="modal fade" id="modalPengembalianBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form action="<?php echo base_url().'index.php?/Peminjaman/pengembalianBarang'; ?>" method="post">
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
        <form action="<?php echo base_url().'index.php?/Peminjaman/tolakPeminjaman'; ?>" method="post">
        Alasan Penolakan : <br>
        <input type="text"  hidden class="form-control" name="id_peminjaman" id="id_peminjaman" value=""/>
        <input type="text"  hidden class="form-control" name="jenis_peminjaman" id="jenis_peminjaman" value=""/>
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
        <form action="<?php echo base_url().'index.php?/Peminjaman/batalPeminjaman'; ?>" method="post">
        <input type="text"  hidden class="form-control" name="id_peminjaman" id="id_peminjaman" value=""/>
        <input type="text"  hidden class="form-control" name="jenis_peminjaman" id="jenis_peminjaman" value=""/>

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
     var jenis_peminjaman = $(this).data('jenis_peminjaman');
     $(".modal-body #jenis_peminjaman").val( jenis_peminjaman );
     $(".jenis_peminjaman").val( jenis_peminjaman );
});
</script>

<script>
$(document).on("click", ".modalBatalPeminjaman", function () {
     var peminjaman = $(this).data('id');
     $(".modal-body #id_peminjaman").val( peminjaman );
     $(".peminjaman").val( peminjaman );
     var jenis_peminjaman = $(this).data('jenis_peminjaman');
     $(".modal-body #jenis_peminjaman").val( jenis_peminjaman );
     $(".jenis_peminjaman").val( jenis_peminjaman );
});
</script>

<div class="modal fade" id="gardenImage" tabindex="-1" role="dialog" aria-labelledby="gardenImageLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="<?php echo base_url("index.php?/Peminjaman/buktiPeminjaman")?>" method="post">
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



<div class="modal fade" id="modalPembayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form action="<?php echo base_url().'index.php?/Peminjaman/bayarPeminjaman'; ?>" method="post" enctype="multipart/form-data">
        <input type="hidden"   class="form-control" name="id_peminjaman" id="id_peminjaman" value=""/> 
        <input type="hidden"   class="form-control" name="jenis"  value="<?= $jenis?>"/> 
        <div class="form-group">
            <label for="exampleFormControlSelect1">Bukti Pembayaran</label>
            <input type="file"   name="buktiPembayaran" class="form-control ">
        </div>
        <div class="d-flex flex-row-reverse bd-highlight py-2">
            <div class="px-1"><button type="submit" class="btn btn-primary btn-sm">Simpan</button></div>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
$(document).on("click", ".modalPembayaran", function () {
     var peminjaman = $(this).data('id');
     $(".modal-body #id_peminjaman").val( peminjaman );
     $(".peminjaman").val( peminjaman );
});
</script>





<script>
    var notifa = document.getElementById("sukses").value;
    if( notifa == "PEMINJAMAN BERHASIL DIKIRIM" ) {
        window.onpageshow = function() {
        if (typeof window.performance != "undefined"
            && window.performance.navigation.type === 0) {
            $('#myModal').modal('show');
        }
        }
    }
</script>
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-body">
      <div class="row text-center">
                <div class="col-md-12">
                    <div class="form-group">
                        <h1 class=""><i class="fas fa-check-circle text-success"></i></h1>
                        <h5 class="" role="alert">
                        <strong>PEMINJAMAN TELAH DIKIRIM</strong> 
                        </h5>
                        <span class="text-dark" >Silahkan tunggu hingga peminjaman divalidasi oleh operator</span><br> <hr> 
                        <span class="text-dark" >Proses validasi paling lama dilakukan 3 hari atau peminjaman akan otomatis ditolak!</span>
                        <br> 
            
                    </div>
                </div>
            </div>  
            <div class="row text-center">
                <div class="col-md-12">
                <form action="<?php echo base_url("index.php?/Peminjaman/buktiPeminjaman")?>" method="post">
                <input type="hidden" name="id_peminjaman" value="<?= $id_peminjaman;?>">
                    <div class="row">
                        <div class="col-sm-3">
                            <button  data-dismiss="modal" style="width:100%" class="btn btn-outline-secondary">Close</button>
                        </div> 
                        <div class="col-sm-9">
                            <button type="submit" style="width:100%" formtarget="_blank" class="btn btn-primary">Cetak Invoice</button>
                        </div> 
                    </div> 
                    </form>
                </div>
            </div>  
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->