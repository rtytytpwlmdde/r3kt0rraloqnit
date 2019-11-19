
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
                <div class="card px-2 pt-2 mb-2">
                    <div>
                        <div class="form-group">
                                <input class="form-control m-0" type="text" placeholder="search" name="search" >
                        </div>
                    </div>
                </div>

                <div class="card px-2 pt-2 mb-2">
                    <div>
                        <div class="form-group">
                            <label for="">Kapasitas</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input class="form-control m-0" type="text" placeholder="min" name="minKapasitas" >
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control m-0" type="text" placeholder="max" name="maxKapasitas" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card p-2 mb-2">
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="minibus" name="minibus" >
                            <label class="form-check-label" for="inlineCheckbox1">Minibus</label>
                        </div>
                    </div>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="bus" name="bus" >
                            <label class="form-check-label" for="inlineCheckbox1">Bus</label>
                        </div>
                    </div>
                </div>
                <div class="card p-2 mb-2">
                    <?php $i = 0; 
                    foreach ($operator as $a){ ?>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="<?= $a->username ?>" name="fakultas<?= $i?>" >
                            <label class="form-check-label" for="inlineCheckbox1"><?= $a->nama_fakultas ?></label>
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
                                    <select name="jamMulai" required class="form-control" id="exampleFormControlSelect1">
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
                                    <select name="jamSelesai" required class="form-control" id="exampleFormControlSelect1">
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
                            <span class="text-info m-0 p-0" style="font-size:12px;"><?= $u->nama_fakultas ?> </span><br> 
                            <span class="text-warning">Rp : <?= $u->harga_sewa ?> ,-</span> <br>


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

