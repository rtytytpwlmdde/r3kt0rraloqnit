

<?php if($this->session->userdata('status') == "pengguna"){ ?>
    <div class="container mt-4 mb-4 ">
<?php }else{?><div class="">
<?php }?>

        <!-- DataTales Example -->
    <div class="mb-3 mb-lg-0 card ">
        <div class="bg-light card-header d-sm-flex  align-items-center justify-content-between">
            <h5 class="mb-0">Events</h5>
                <form class="pr-2 form-inline" action="<?php echo site_url('agenda');?>"  method="get">
                    <div class="form-group mb-2">
                        <input type="text" name="search" class="form-control-sm" placeholder="search" value="<?= $search?>">
                        <div class="form-group">
                        <input type="date" title="tgl mulai" name="start" class="form-control-sm  ml-2" value="<?= $start?>"> s/d
                        </div>
                        <input type="date" title="tgl selesai" name="end" class="form-control-sm" value="<?= $end?>" >
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary mb-2"><i class="fas fa-search"></i> </button>
                </form>
           
        </div>
        <div class="fs--1 card-body">
            <?php foreach($agenda as $u){?>
            <div class="media">
                <div class="calendar">
                    <span class="calendar-month mt-0">
                    <?php
                        $date=date_create($u->tanggal_mulai_penggunaan);
                        echo date_format($date,"M");
                    ?>
                    </span>
                    <span class="calendar-day">
                    <?php
                        $date=date_create($u->tanggal_mulai_penggunaan);
                        echo date_format($date,"d");
                    ?>
                    </span>
                </div>
                <div class="position-relative pl-3 media-body">
                    <h4 class="fs-0 mb-0"><a class=""><?= $u->keterangan?></a> </h4>
                    <span class="mb-1">Penyelenggara <a class="text-700" ><?= $u->penyelenggara?></a></span> <i class="fas fa-clock text-warning ml-2"> </i>
                    <span class="text-1000 mb-0">
                    <?php 
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
                        ?><?= $start?> - <?= $end?></span>
                    <span class="mb-0 ml-2"><i class="fas fa-map-marker-alt text-warning"></i> <?= $u->nama_ruangan?></span>
                    <hr class="border-dashed border-bottom-0">
                </div>
            </div>
            <?php } ?>
            
        </div>
    </div>
</div>