<div class="container-fluid mt-4 mb-4">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <div>
            <h1 class="h3 mb-0 text-gray-800">Penggunaan Ruangan</h1>
            <h6 class="text-muted">
                <?php 
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
        
        </h6>
            </div>
            <form class="pr-2 form-inline" action="<?php echo site_url('saranaPrasarana/penggunaanRuangan');?>"  method="get">
                <div class="form-group mb-2">
                    <input type="date" name="tanggal" class="form-control-sm " >
                </div>
                <button type="submit" class="btn btn-sm btn-primary mb-2">Search</button>
            </form>
          </div>

          <!-- Content Row -->
          <div class="row card  shadow">
            <div class="table-responsive div">
                <table class="table table-sm  table-penggunaan-ruangan  mx-0 text-center table-hover" >
                    <thead class="bg-thead text-white" >
                        <tr>
                                <th style="font-size:14px;" class="text-left text-dark headcol">R/J</th>
                                <?php foreach ($waktu as $r){?>
                                <th style="font-size:10px;">
                            <?php 
                             $mulai = explode("-", $r->nama_waktu);
                             $start = $mulai[0];
                             ?><?= $start?>
                                </th>
                                <?php }?>
                        </tr>
                    </thead>
                    <tbody >
                    <?php 
                            foreach ($ruangan as $r){?>
                        <tr>
                            <th class="text-left headcol" style="font-size:14px;"><?php echo $r->nama_ruangan?> <br>
                            <small>Kapasitas <?= $r->kapasitas;?></small> </th>
                            <?php 
                            foreach ($waktu as $w){
                                $result = 0;
                            ?>
                            <th  class="text-center table-bordered">
                                <?php 
                                foreach ($peminjaman as $j){
                                    $start = $j->jam_mulai;
                                    $end = $j->jam_selesai;
                                    for ($jam = $start; $jam <= $end; $jam++) {
                                        if($j->id_ruangan == $r->id_ruangan){
                                            if($w->id_waktu == $jam){
                                                if($j->validasi_akademik == 'setuju'){
                                                ?> 
                                                    <a data-toggle="modal"  style="cursor: pointer;" data-keterangan="<?= $j->keterangan; ?>" data-ruangan="<?= $r->nama_ruangan; ?>" data-jam="<?= $w->nama_waktu; ?>" data-penyelenggara="<?= $j->penyelenggara; ?>"
                                                        class="btn open-modaRuangan text-dark" href="#modaRuangan">
                                                        <i class="fas fa-times-circle fa-lg text-danger"  title="Ruangan Digunakan"></i>
                                                    </a>
                                                <?php }else{?>
                                                    <a data-toggle="modal"  style="cursor: pointer;" data-keterangan="<?= $j->keterangan; ?>" data-ruangan="<?= $r->nama_ruangan; ?>" data-jam="<?= $w->nama_waktu; ?>" data-penyelenggara="<?= $j->penyelenggara; ?>"
                                                    class="btn open-modaRuangan text-dark" href="#modaRuangan">
                                                    <i class="fas fa-times-circle fa-lg text-warning"  title="Ruangan Sedang Menungu Proses Validasi Peminjaman"></i>
                                                    </a>
                                                <?php } 
                                                $result=1;
                                            }
                                        }
                                    }
                                }
                                if($result == 0){ ?>
                                    <a class="btn">
                                    <i class="fas fa-check-circle fa-lg text-primary"  title="Ruangan Tidak Digunakan"></i>
                                    </a> <?php 
                                }
                                ?> 
                            </th>
                            <?php } ?>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
          </div>
        </div>


<div class="modal fade" id="modaRuangan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div>
            <div class="position-relative pl-3 mt-2 media-body">

                
                <h4 class="fs-0 mb-0"><a href="" ><input id="keterangan"  style="border:none" ></a> </h4>
                <small class="mb-1">Penyelenggara <a class="text-700" ><input id="penyelenggara"  style="border:none" ></a></small>
                <small class="">Jam :<a class="text-700" ><input id="jam"  style="border:none" ></a></small>
                <small class="mb-0 text-muted">Ruangan: <input id="ruangan"   style="border:none" ></small>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        </form>
        </div>
      </div>
    </div>
  </div>
<script>
$(document).on("click", ".open-modaRuangan", function () {
     var keterangan = $(this).data('keterangan');
     $(".modal-content #keterangan").val( keterangan );
     var ruangan = $(this).data('ruangan');
     $(".modal-content #ruangan").val( ruangan );
     var penyelenggara = $(this).data('penyelenggara');
     $(".modal-content #penyelenggara").val( penyelenggara );
     var jam = $(this).data('jam');
     $(".modal-content #jam").val( jam );
});
</script>