
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
            <div class="col-12 col-md-12 ">
                <h3 class="text-muted">Tambah Ruangan Peminjaman Non Kelas</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 py-2">
            <div class="kotak py-2 px-2 shadow" >
            <div>
                <h6 class="py-1 text-muted" >Data Peminjaman</h6>
            </div>
                <table id="tblmatakuliah" class="table table-bordered">
                    <tbody>  
                    <?php 
                    $id = null;
                    $tgl_mulai = null;
                    $tgl_selesai = null;
                    $jam_mulai = null;
                    $jam_selesai = null;
                    foreach ($peminjaman as $u){ ?>
                        <tr>
                            <td>ID Peminjaman</td>
                            <td><?= $id = $u->id_peminjaman; ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Peminjaman</td>
                            <td><?= $jenis_peminjaman; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Penggunaan</td>
                            <td><?= date("l, d-m-Y", strtotime($u->tanggal_mulai_penggunaan)); ?> - <?= date("l, d-m-Y", strtotime($u->tanggal_selesai_penggunaan)); ?>
                                <?php   $tgl_mulai = $u->tanggal_mulai_penggunaan;
                                        $tgl_selesai = $u->tanggal_selesai_penggunaan; 
                                        $jam_mulai = $u->jam_mulai;
                                        $jam_selesai = $u->jam_selesai;?>
                            </td>
                        </tr>
                        <tr>
                            <td>Jam Penggunaan</td>
                            <td> 
                            <?php 
                            if($u->jam_mulai<10){
                                echo "0".$u->jam_mulai.".00";
                            }else{
                                echo $u->jam_mulai.".00";
                            } ?> 
                            - <?php if($u->jam_selesai<10){
                                echo "0".$u->jam_selesai.".59";
                            }else{
                                echo $u->jam_selesai.".59";
                            }; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Lembaga</td>
                            <td> <?= $u->nama_lembaga; ?></td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td> <?= $u->keterangan; ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td> <?= "pending"; ?></td>
                        </tr>
                        <tr>
                            <td>Sarana </td>
                            <td> <?php 
                             foreach ($sarana as $a){ 
                                 if($jenis_peminjaman == 'barang'){ ?>
                                    <a href="<?php echo site_url('Peminjaman/hapusSaranaPeminjaman/'.$jenis_peminjaman.'/'.$id.'/'.$a->id_sarana.'/'.$tgl_mulai.'/'.$tgl_selesai.'/'.$jam_mulai.'/'.$jam_selesai); ?>"  class="btn btn-danger btn-sm text-white" title="Hapus Ruangan">
                                        <?= $a->nama_barang." "; ?><i class="fas fa-trash"></i>
                                    </a>
                                 <?php }else{ ?>
                                    <a href="<?php echo site_url('Peminjaman/hapusSaranaPeminjaman/'.$jenis_peminjaman.'/'.$id.'/'.$a->id_sarana.'/'.$tgl_mulai.'/'.$tgl_selesai.'/'.$jam_mulai.'/'.$jam_selesai); ?>"  class="btn btn-danger btn-sm text-white" title="Hapus Ruangan">
                                        <?= $a->nama_ruangan." "; ?><i class="fas fa-trash"></i>
                                    </a>
                                <?php }?>
                            <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-right">
                            <a href="<?php echo site_url('Peminjaman/hapusPeminjaman/'.$id); ?>"  class="btn btn-outline-secondary" title="Selesaikan Peminjaman Ruangan">
                                   Batalkan
                            </a>
                            <a href="<?php echo site_url('Peminjaman/kirimPeminjaman/'.$u->jenis_peminjaman.'/'.$id); ?>"  class="btn btn-primary text-white" title="Selesaikan Peminjaman Ruangan">
                                    Selesai
                            </a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div> 
        <div class="col-md-4 py-2">
            <div class="kotak py-2 px-2 shadow" >
            <div>
                <h6 class="py-1 text-muted" >Ruangan yang dapat dipinjam</h6>
            </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th class="text-center" scope="col">No</th>
                        <th class="text-center" scope="col">ID Ruangan</th>
                        <th class="text-center" scope="col">Sarana</th>
                        <th class="text-center" scope="col">Tambahkan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $no = 1;
                        foreach ($sarana_tersedia as $u){ 
                    ?>
                        <tr class="text-center">
                            <td><?php echo $no++ ?></td>
                            <?php if($jenis_peminjaman == 'barang'){ ?>
                                <td><?php echo $u->id_barang ?></td>
                                <td><?php echo $u->nama_barang ?></td>
                                <td >
                                <form action="<?php echo site_url('Peminjaman/tambahSaranaPeminjaman'); ?>" method="post">
                                    <input type="text" hidden name="jenis" value="barang">
                                    <input type="text" hidden name="id_peminjaman" value="<?= $id?>">
                                    <input type="text" hidden name="id_sarana" value="<?= $u->id_barang?>">
                                    <input type="text" hidden name="tgl_mulai" value="<?= $tgl_mulai?>">
                                    <input type="text" hidden name="tgl_selesai" value="<?= $tgl_selesai?>">
                                    <input type="text" hidden name="jam_mulai" value="<?= $jam_mulai?>">
                                    <input type="text" hidden name="jam_selesai" value="<?= $jam_selesai?>">
                                    <button class="btn btn-secondary text-white" title="Tambahkan" type="submit"><i class="fas fa-plus-square"></i> Tambah</button>
                                </form>
                                </td>
                            <?php }else{ ?>
                                <td><?php echo $u->id_ruangan ?></td>
                                <td><?php echo $u->nama_ruangan ?></td>
                                <td >
                                <form action="<?php echo site_url('Peminjaman/tambahSaranaPeminjaman'); ?>" method="post">
                                    <input type="text" hidden name="jenis" value="nonkelas">
                                    <input type="text" hidden name="id_peminjaman" value="<?= $id?>">
                                    <input type="text" hidden name="id_sarana" value="<?= $u->id_ruangan?>">
                                    <input type="text" hidden name="tgl_mulai" value="<?= $tgl_mulai?>">
                                    <input type="text" hidden name="tgl_selesai" value="<?= $tgl_selesai?>">
                                    <input type="text" hidden name="jam_mulai" value="<?= $jam_mulai?>">
                                    <input type="text" hidden name="jam_selesai" value="<?= $jam_selesai?>">
                                    <button class="btn btn-secondary text-white" title="Tambahkan" type="submit"><i class="fas fa-plus-square"></i> Tambah</button>
                                </form>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  <br>
</div>

