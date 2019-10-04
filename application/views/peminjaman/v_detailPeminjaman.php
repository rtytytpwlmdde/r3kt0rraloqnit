

<?php if($this->session->userdata('status') == "pengguna"){ ?>
    <div class="container">
<?php }else{?><div class="">
<?php }?>
<div class="col-md-12">
    <div class="mt-2">
        <div class="row py-2 ">
            <div class="col-12 col-md-12 ">
                <h3 class="text-muted">Detail Peminjaman</h3>
            </div>
        </div>
    </div>
    <div class="card py-2 px-2 shadow" >
        <table id="tblmatakuliah" class="table table-bordered">
            <tbody>
             <?php 
                foreach ($peminjaman as $u){ 
             ?>
                <tr>
                    <td>Kode Peminjaman</td>
                    <td><?= $u->id_peminjaman; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Peminjaman</td>
                    <td><?= date("l, d-m-Y", strtotime($u->tanggal_peminjaman)); ?></td>
                </tr>
                <tr>
                    <td>Nama Peminjam</td>
                    <td><?= $u->nama_mahasiswa; ?></td>
                </tr>
                <tr>
                    <td>NIM/NIP</td>
                    <td><?= $u->id_peminjam; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Penggunaan</td>
                    <td><?= date("l, d-m-Y", strtotime($u->tanggal_mulai_penggunaan)); ?> sd <?= date("l, d-m-Y", strtotime($u->tanggal_selesai_penggunaan)); ?></td>
                </tr>
                <tr>
                    <td>Ruangan</td>
                    <td> <?php  
                        foreach ($sarana as $u){ 
                            echo $u->nama_ruangan."<br>";
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


</div>