<div class="container-fluid mt-4 mb-4">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0 text-gray-800">Penggunaan Ruangan</h1>
            <form class="pr-2 form-inline">
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
                                <?php for ($x = 6; $x <= 21; $x++) {?>
                                <th style="font-size:10px;"><?php 
                                    if($x<10){
                                        echo "0".$x.".00 - 0".$x.".59";
                                    }else{
                                        echo $x.".00 - ".$x.".59";
                                    }
                                    
                                    ?></th>
                                <?php }?>
                        </tr>
                    </thead>
                    <tbody >
                    <?php 
                            foreach ($ruangan as $r){?>
                        <tr>
                            <th><?php echo $r->nama_ruangan?></th>
                            <?php 
                            for ($y = 6; $y <= 21; $y++) {
                                $result = 0;
                            ?>
                            <th style="max-width:120px;" class="text-center">
                                <?php 
                                foreach ($peminjaman as $j){
                                    $start = $j->jam_mulai;
                                    $end = $j->jam_selesai;
                                    for ($jam = $start; $jam <= $end; $jam++) {
                                        if($j->id_ruangan == $r->id_ruangan){
                                            if($y == $jam){
                                                ?> <a class="btn" ><i class="fas fa-times-circle fa-lg text-danger" data-toggle="tooltip" data-placement="top" title="Ruangan Digunakan"></i></a>
                                            <?php
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