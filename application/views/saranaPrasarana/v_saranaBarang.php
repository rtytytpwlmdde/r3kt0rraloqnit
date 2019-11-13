
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
                            <form method="get" action="<?php echo base_url("saranaPrasarana/saranaPrasarana")?>">
                                <input type="hidden" name="jenis" value="ruangan">
                                <button class="btn btn-outline-primary"><i class="fas fa-home"></i> <br>Ruangan</button>
                            </form>
                        </div>
                        <div class="col-md-6 text-left">
                            <form method="get" action="<?php echo base_url("saranaPrasarana/saranaPrasarana")?>">
                                <input type="hidden" name="jenis" value="barang">
                                <button class="btn btn-outline-primary"><i class="fas fa-car"></i> <br>Barang</button>
                            </form>
                        </div>
                    </div>
                </div>
                    <form method="get" action="<?php echo base_url("saranaPrasarana/saranaPrasarana")?>">
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
                    <input type="hidden" name="jenis" value="<?= $jenis?>">
                    <button class="btn btn-primary">FILTER</button>
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                <?php foreach($sarana as $u){?>
                <div class="card p-2 mb-2">
                    <div class="row" style="heigh:146px">
                        <div class="col-md-4 text-center">
                            <?php if($u->foto_barang1 == null){ ?>
                            <img src="<?php echo base_url("assets/img/ruangan-default.jpg");?>" alt="" style="max-width:206px; heigh:143px" >
                            <?php }else{ ?>
                            <img src="<?php echo base_url("assets/barang/".$u->foto_barang1);?>" alt="" style="max-width:206px; heigh:143px" >
                            <?php }?>
                        </div>
                        <div class="col-md-8">
                            <h4 class="font-weight-bold text-dark m-0"><?= $u->nama_barang;?></h4>
                            <span><?php substr("Hello world",0,10) ?></span>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

