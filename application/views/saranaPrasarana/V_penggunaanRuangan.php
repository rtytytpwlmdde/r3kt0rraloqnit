<div class="container-fluid mt-4 mb-4">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <div>
            <h1 class="h3 mb-0 text-gray-800">Penggunaan Ruangan</h1>
            <h6 class="text-muted"><?= date("l, d-m-Y", strtotime($tanggal)); ?></h6>
            </div>
            <form class="pr-2 form-inline" action="<?php echo site_url('saranaPrasarana/penggunaanRuangan');?>"  method="get">
                <div class="form-group mb-2">
                    <input type="date" class="form-control-sm " >
                </div>
                <button type="submit" class="btn btn-sm btn-primary mb-2">Search</button>
            </form>
          </div>

          <!-- Content Row -->
          <div class="row px-2 py-2 card shadow">
            <div class="table-responsive ">
                <table class="table table-bordered text-center ">
                    <thead class="bg-thead text-white">
                        <tr>
                                <th>R/J</th>
                                <?php foreach ($waktu as $r){?>
                                <th style="font-size:10px;"><?= $r->nama_waktu?></th>
                                <?php }?>
                        </tr>
                    </thead>
                    <tbody >
                    <?php 
                            foreach ($ruangan as $r){?>
                        <tr>
                            <th><?php echo $r->nama_ruangan?></th>
                            <?php 
                            foreach ($waktu as $w){
                                $result = 0;
                            ?>
                            <th style="max-width:120px;" class="text-center">
                                <?php 
                                foreach ($peminjaman as $j){
                                    $start = $j->jam_mulai;
                                    $end = $j->jam_selesai;
                                    for ($jam = $start; $jam <= $end; $jam++) {
                                        if($j->id_ruangan == $r->id_ruangan){
                                            if($w->id_waktu == $jam){
                                                if($j->validasi_akademik == 'setuju'){
                                                ?> 
                                                    <a data-toggle="modal"  style="cursor: pointer;" data-keterangan="<?= $j->keterangan; ?>" data-ruangan="<?= $r->nama_ruangan; ?>" data-penyelenggara="<?= $j->penyelenggara; ?>"
                                                        class="btn open-modaRuangan text-dark" href="#modaRuangan">
                                                        <i class="fas fa-times-circle fa-lg text-danger"  title="Ruangan Digunakan"></i>
                                                    </a>
                                                <?php }else{?>
                                                    <a data-toggle="modal"  style="cursor: pointer;" data-keterangan="<?= $j->keterangan; ?>" data-ruangan="<?= $r->nama_ruangan; ?>" data-penyelenggara="<?= $j->penyelenggara; ?>"
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
            <div class="position-relative pl-3 my-2 media-body">

                
                <h4 class="fs-0 mb-0"><a href="" ><input id="keterangan"  style="border:none" ></a> </h4>
                <small class="mb-1">Organized by <a class="text-700" ><input id="penyelenggara"  style="border:none" ></a></small><br>
                <p class="text-1000 mb-0">Time: 6:00AM<br>Duration: 6:00AM - 5:00PM</p>
                <p class="mb-0">Place: <input id="ruangan"  style="border:none" ></p>
            </div>
        </div>
        <div class="modal-footer no-border">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
});
</script>