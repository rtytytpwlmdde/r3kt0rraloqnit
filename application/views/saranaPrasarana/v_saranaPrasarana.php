
<div class="

<?php 
if($this->session->userdata('status') == "pengguna" || $this->session->userdata('logged_in') == FALSE){
    echo "container";
}
?>">
<div class="col-md-12">
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
            <div class="col-6 col-md-8 ">
                <h3 class="text-muted">Sarana Prasarana</h3>
            </div>
            <div class="col-6 col-md-4">
                <div class="d-flex flex-row-reverse bd-highlight">
                    <?php if($this->session->userdata('status') == 'admin'){ ?>
                        <?php }?>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white  shadow p-2" >
        <div class="row py-2 ">
            <div class="col-md-3">
                <div class="card p-2 mb-2">
                    <div class="row">
                        <div class="col-md-6 text-right">
                            <form method="get" action="<?php echo base_url("index.php?/SaranaPrasarana/saranaPrasarana")?>">
                                <input type="hidden" name="jenis" value="ruangan">
                                <button class="btn btn-outline-primary"><i class="fas fa-home"></i> <br>Ruangan</button>
                            </form>
                        </div>
                        <div class="col-md-6 text-left">
                            <form method="get" action="<?php echo base_url("index.php?/SaranaPrasarana/saranaPrasarana")?>">
                                <input type="hidden" name="jenis" value="barang">
                                <button class="btn btn-outline-primary"><i class="fas fa-car"></i> <br>Barang</button>
                            </form>
                        </div>
                    </div>
                </div>
                    <form method="get" action="<?php echo base_url("index.php?/SaranaPrasarana/saranaPrasarana")?>">
                <div class="card px-2 pt-2 mb-2">
                    <div class="row">
                        <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="search" class="form-control" placeholder="search..">
                                </div>
                        </div>
                    </div>
                </div>
                <div class="card p-2 mb-2">
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="1" name="ac" >
                            <label class="form-check-label" for="inlineCheckbox1">AC</label>
                        </div>
                    </div>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="1" name="wifi" >
                            <label class="form-check-label" for="inlineCheckbox1">Wifi</label>
                        </div>
                    </div>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="1" name="lcd" >
                            <label class="form-check-label" for="inlineCheckbox1">Lcd</label>
                        </div>
                    </div>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="1" name="sound_system" >
                            <label class="form-check-label" for="inlineCheckbox1">Sound System</label>
                        </div>
                    </div>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="1" name="toilet" >
                            <label class="form-check-label" for="inlineCheckbox1">Toilet</label>
                        </div>
                    </div>
                </div>
                <div class="card p-2 mb-2">
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="1" name="rapat" >
                            <label class="form-check-label" for="inlineCheckbox1">Ruang Rapat</label>
                        </div>
                    </div>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="1" name="terbuka" >
                            <label class="form-check-label" for="inlineCheckbox1">Terbuka</label>
                        </div>
                    </div>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="1" name="hall" >
                            <label class="form-check-label" for="inlineCheckbox1">Hall</label>
                        </div>
                    </div>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="1" name="auditorium" >
                            <label class="form-check-label" for="inlineCheckbox1">Auditorium</label>
                        </div>
                    </div>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="1" name="olahraga_tertutup" >
                            <label class="form-check-label" for="inlineCheckbox1">Olahraga</label>
                        </div>
                    </div>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="1" name="ruang_kuliah" >
                            <label class="form-check-label" for="inlineCheckbox1">Ruang Kuliah</label>
                        </div>
                    </div>
                </div>
                <div class="card p-2 mb-2">
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" data-toggle="collapse" data-target="#collapseExample" >
                            <label class="form-check-label" for="inlineCheckbox1">Kapasitas</label>
                        </div>
                        <div class="row collapse" id="collapseExample">
                            <div class="col-md-6">
                                <input type="text" name="minKapasitas" class="form-control form-control-sm" placeholder="Min"> 
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="maxKapasitas" class="form-control form-control-sm" placeholder="Max">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" data-toggle="collapse" data-target="#colLuas" >
                            <label class="form-check-label" for="inlineCheckbox1">Luas</label>
                        </div>
                        <div class="row collapse" id="colLuas">
                            <div class="col-md-6">
                                <input type="text" name="minLuasRuangan" class="form-control form-control-sm" placeholder="Min"> 
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="maxLuasRuangan" class="form-control form-control-sm" placeholder="Max">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" data-toggle="collapse" data-target="#colRuangKelas" >
                            <label class="form-check-label" for="inlineCheckbox1">Ruang Kelas</label>
                        </div>
                        <div class="row collapse" id="colRuangKelas">
                            <div class="col-md-6">
                                <input type="text" name="minRuangKelas" class="form-control form-control-sm" placeholder="Min"> 
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="maxRuangKelas" class="form-control form-control-sm" placeholder="Max">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" data-toggle="collapse" data-target="#colRuangPertemuan" >
                            <label class="form-check-label" for="inlineCheckbox1">Ruang Pertemuan</label>
                        </div>
                        <div class="row collapse" id="colRuangPertemuan">
                            <div class="col-md-6">
                                <input type="text" name="minPertemuan" class="form-control form-control-sm" placeholder="Min"> 
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="maxPertemuan" class="form-control form-control-sm" placeholder="Max">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" data-toggle="collapse" data-target="#collapseTeater" >
                            <label class="form-check-label" for="inlineCheckbox1">Teater</label>
                        </div>
                        <div class="row collapse" id="collapseTeater">
                            <div class="col-md-6">
                                <input type="text" name="minTeater" class="form-control form-control-sm" placeholder="Min"> 
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="maxTeater" class="form-control form-control-sm" placeholder="Max">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" data-toggle="collapse" data-target="#colapseUshape" >
                            <label class="form-check-label" for="inlineCheckbox1">Berbentuk U</label>
                        </div>
                        <div class="row collapse" id="colapseUshape">
                            <div class="col-md-6">
                                <input type="text" name="minUshape" class="form-control form-control-sm" placeholder="Min"> 
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="maxUshape" class="form-control form-control-sm" placeholder="Max">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card p-2 mb-2">
                    <?php $i = 0; 
                    foreach ($lokasi as $a){ ?>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="<?= $a->id_lokasi ?>" name="fakultas<?= $i?>" >
                            <label class="form-check-label" for="inlineCheckbox1"><?= $a->nama_lokasi ?></label>
                        </div>
                    </div>
                    <?php $i++;} ?>
                    <input type="hidden" name="jumlahFakultas" class="form-control" value=<?= $i?>>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card p-2 mb-2">
                    <div class="row mx-1">
                        <div class="col-md-6 ">
                            <div class="row">
                                <div class="col-md-6 px-1 m-0">
                                    <small>Tgl Mulai</small>
                                    <input type="date" class="form-control" name="tglMulai" value="<?= $tglMulai;?>">
                    <input type="hidden" name="jenis" value="<?= $jenis?>">
                                </div>
                                <div class="col-md-6 px-1 m-0">
                                    <small>Tgl Selesai</small>
                                    <input type="date" class="form-control" name="tglSelesai" value="<?= $tglSelesai;?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6 px-1 m-0">
                                    <small>Jam Mulai</small>
                                    <select name="jamMulai"  class="form-control" id="exampleFormControlSelect1">
                                    <option value="">Pilih</option>
                                    <?php foreach ($waktu as $u) : ?>
                                        <option value="<?= $u->id_waktu; ?>"
                                            <?php if ($jamMulai == $u->id_waktu) {
                                                echo "selected=selected";
                                            } ?>>
                                            <?php 
                                            $pieces = explode("-", $u->nama_waktu);
                                            $start = $pieces[0];
                                            $end = $pieces[1];
                                            ?>
                                            <?= $start; ?>
                                        </option>
                                    <?php endforeach; ?>       
                                    </select>
                                </div>
                                <div class="col-md-6 px-1 m-0">
                                    <small>Jam Selesai</small>
                                    <select name="jamSelesai"  class="form-control" id="exampleFormControlSelect1">
                                    <option value="">Pilih</option>
                                    <?php foreach ($waktu as $u) : ?>
                                        <option value="<?= $u->id_waktu; ?>"
                                            <?php if ($jamSelesai == $u->id_waktu) {
                                                echo "selected=selected";
                                            } ?>>
                                            <?php 
                                            $pieces = explode("-", $u->nama_waktu);
                                            $start = $pieces[0];
                                            $end = $pieces[1];
                                            ?>
                                            <?= $end; ?>
                                        </option>
                                    <?php endforeach; ?>       
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-2 ">
                            <div class="row">
                                <button type="submit" class="btn btn-warning mt-4" style="width:100%">FILTER</button>
                            </div></form>
                        </div>
                    </div>
                </div>
                <?php 
            $no = (int)$this->uri->segment('3') + 1;
            foreach($sarana as $u){?>
                <div id="demo" class="card p-2 mb-2">
                    <div class="row" style="heigh:146px">
                        <div class="col-md-4 text-center">
                            <?php if($u->foto_ruangan1 == null){ ?>
                            <img src="<?php echo base_url("assets/img/ruangan-default.jpg");?>" alt="" style="max-width:206px; heigh:143px" >
                            <?php }else{ ?>
                            <img src="<?php echo base_url("assets/ruangan/".$u->foto_ruangan1);?>" alt="" style="max-width:206px; heigh:143px" >
                            <?php }?>
                        </div>
                        <div class="col-md-8">
                            <a href="<?php echo base_url("index.php?/SaranaPrasarana/detailRuangan/".$u->id_ruangan);?>"><h4 class="font-weight-bold text-dark m-0" style="font-size: 20px !important; font-family: 'Roboto', sans-serif;" ><?= $u->nama_ruangan;?></h4></a>
                            <span class="text-info m-0 p-0" style="font-size:12px;"><?= $u->nama_fakultas ?> </span><br> 
                            <span style="font-size:14px;">Kapasitas : <?= $u->kapasitas ?> orang</span> <br>
                            <span style="font-size:14px;">Luas : <?= $u->luas_ruangan ?> </span><br>
                            <span class="text-warning"><?php  echo "Rp " . number_format($u->harga_ruangan,0,',','.');?></span> <br>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="d-flex flex-row-reverse bd-highlight">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
