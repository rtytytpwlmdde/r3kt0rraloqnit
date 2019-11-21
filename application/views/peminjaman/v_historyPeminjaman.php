
<div class="

<?php 
if($this->session->userdata('status') == "pengguna"){
    echo "container";
}
?>">
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
        if($sukses != NULL){
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
                        <button class="btn btn-sm btn-secondary mb-2" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fas fa-filter"></i>
                        </button>
                        <form class="pr-2 form-inline" action="<?php echo base_url("peminjaman/historyPeminjaman")?>" method="get">
                            <div class="form-group mb-2">
                                <input type="text" name="search" class="form-control-sm " placeholder="quick search">
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary mb-2">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="collapse my-2" id="collapseExample">
            <div class="p-2 bg-white shadow">
                <div class="">
                    <h6>FILTER DATA PEMINJAMAN</h6>
                </div>
            <form action="<?php echo base_url("peminjaman/historyPeminjaman");?>" method="get">
                <div class="form-group">
                    <label for="exampleInputEmail1">Pengguna</label>
                    <input type="text" class="form-control" name="pengguna" placeholder="username / nama pengguna">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Penyelenggara</label>
                    <input type="text" class="form-control" name="penyelenggara">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Jenis Peminjaman</label>
                    <select name="jenis"  class="form-control">
                            <option value="">Pilih</option>
                            <option value="ruangan">Ruangan</option>
                            <option value="barang">Barang</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Status Peminjaman</label>
                    <select name="status"  class="form-control">
                            <option value="">Pilih</option>
                            <option value="setuju">Setuju</option>
                            <option value="terkirim">Terkirim</option>
                            <option value="tolak">Tolak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Status Pembayaran</label>
                    <select name="status_pembayaran"  class="form-control">
                            <option value="">Pilih</option>
                            <option value="lunas">Lunas</option>
                            <option value="belum bayar">Belum Bayar</option>
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Tanggal Mulai</label>
                    <input type="date" name="tgl_mulai" class="form-control" placeholder="First name">
                    </div>
                    <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Tanggal Selesai</label>
                    <input type="date" name="tgl_selesai" class="form-control" placeholder="Last name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-3">
                        <button type="hide" style="width:100%;" class="btn btn-outline-secondary">Cancel</button>
                    </div>
                    <div class="col-md-9">
                        <button type="submit" style="width:100%;" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    <div class="bg-white  shadow" >
        <table id="tblPeminjaman" class="table table-bordered">
            <thead class="bg-thead text-white">
                <tr>
                <th class="text-center" scope="col">No</th>
                <th class="text-center" scope="col">QR CODE</th>
                <th class="text-center" scope="col">Kode Booking</th>
                <th class="text-center" scope="col">Pengguna</th>
                <th class="text-center" scope="col">Tgl Penggunaan</th>
                <th class="text-center" scope="col">Ruangan</th>
                <th class="text-center" scope="col">Jam Mulai</th>
                <th class="text-center" scope="col">Validasi</th>
                <th class="text-center" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $no = (int)$this->uri->segment('3') + 1;
                foreach ($peminjaman as $u){ 
            ?>
                <tr class="text-center">
                    <td><?php echo $no++; ?></td>						
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

                    <td><a href="<?php echo site_url('Peminjaman/detailPeminjaman/'.$u->id_peminjaman.'/'.$u->jenis_peminjaman); ?>"><?php echo $u->id_peminjaman; ?></a></td>
                    
                    <td><?php echo $u->nama_mahasiswa; ?></td>
                    <td><?= date("d-m-Y", strtotime($u->tanggal_mulai_penggunaan)); ?></td>
                    <td><?php echo $u->nama_ruangan; ?><?php echo $u->nama_barang; ?></td>
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
                        <td class="text-center">
                        <?php if( $u->validasi_akademik == 'terkirim'){ ?>
                            <form action="<?php echo base_url("peminjaman/validasiPeminjaman");?>" method="post">
                                <input hidden type="text" name="id_peminjaman" value="<?= $u->id_peminjaman;?>">
                                <input hidden type="text" name="jenis_peminjaman" value="<?= $u->jenis_peminjaman;?>">
                                <button type="submit" class="btn btn-success btn-sm" title="Setuju Peminjaman">Setuju</button>
                            </form>
                            <a data-toggle="modal" data-id="<?php echo $u->id_peminjaman; ?>" title="Tolak Peminjaman" class="modalTolakPeminjaman btn btn-outline-danger btn-sm" href="#modalTolakPeminjaman">Tolak</a>
                            <a data-toggle="modal" data-id="<?php echo $u->id_peminjaman; ?>" title="Batalkan Peminjaman" class="modalBatalPeminjaman btn btn-outline-secondary btn-sm" href="#modalBatalPeminjaman">Batal</a>

                        <?php } ?> 
                        <?php if( $u->validasi_akademik == 'setuju'){ ?>
                           <?php if( $u->id_peminjam == $this->session->userdata('username') || $this->session->userdata('username') == 'admin'){ ?>
                                <a href="https://api.whatsapp.com/send?phone=<?= $u->nomor_telpon?>&text=Hi%20Peminjaman%20Ruangan%20<?=$u->nama_ruangan;?>%20Telah%20Disetujui.%20 Terimakasih" 
                            target="_blank"class="btn btn-outline-success btn-sm" title="Kirim Pesan WA"><i class="fab fa-whatsapp"></i></a>
                            <?php } ?> 
                        <?php } ?>  
                           <?php if($u->validasi_akademik == 'tolak'){ ?>
                            <a href="https://api.whatsapp.com/send?phone=<?= $u->nomor_telpon?>&text=Hi%20Peminjaman%20Ruangan%20<?=$u->nama_ruangan;?>%20Telah%20Ditolak.%20 Dengan alasan penolakan <?= $u->catatan_penolakan?>Terimakasih" 
                            target="_blank"class="btn btn-outline-success btn-sm" title="Kirim Pesan WA"><i class="fab fa-whatsapp"></i></a>
                           
                           <?php } ?>
                        </td>
                    <?php } ?>
                    
                    <?php if($this->session->userdata('status') == 'pengguna' && $u->validasi_akademik == 'terkirim' ) { ?>
                        <td class="text-center">
                        <a data-toggle="modal" data-id="<?php echo $u->id_peminjaman; ?>" title="Batalkan Peminjaman" class="modalBatalPeminjaman btn btn-outline-secondary btn-sm" href="#modalBatalPeminjaman">Batal</a>

                        </td>
                    <?php } ?>
                    
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div> 
    <div class="d-flex flex-row-reverse bd-highlight">
    <?php echo $this->pagination->create_links(); ?>
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