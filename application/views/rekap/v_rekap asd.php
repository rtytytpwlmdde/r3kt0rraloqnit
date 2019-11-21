<div class="col-md-12">

            <div class="mt-2">
                    <div class="row py-2 ">
                        <div class="col-6 col-md-8 ">
                            <h3 class="text-muted">Rekap Keuangan</h3>
                            <h6 class="text-muted">Tahun <?= $tahun; ?></h6 class="text-muted">
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="d-flex flex-row-reverse bd-highlight">
                                <form class="form-inline" action="<?php  echo base_url('Rekap/rekapKeuangan'); ?>">
                                    <div class="form-group sm">
                                        <input type="text" name="tahun" class="form-control" value="<?= $tahun; ?>">
                                        <button type="submit" class="btn btn-light"><i class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="card shadow" >
                <table class="table table-bordered">
                    <thead class="bg-thead text-white">
                        <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">Jan</th>
                        <th class="text-center" scope="col">Feb</th>
                        <th class="text-center" scope="col">Mar</th>
                        <th class="text-center" scope="col">Apr</th>
                        <th class="text-center" scope="col">Mei</th>
                        <th class="text-center" scope="col">Jun</th>
                        <th class="text-center" scope="col">Jul</th>
                        <th class="text-center" scope="col">Agu</th>
                        <th class="text-center" scope="col">Sep</th>
                        <th class="text-center" scope="col">Okt</th>
                        <th class="text-center" scope="col">Nov</th>
                        <th class="text-center" scope="col">Des</th>
                        <th class="text-center" scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                        <td class="bg-primary text-white">Total</td>
                            <?php
                            for($i=1; $i<13; $i++){?>
                                <td>
                                    <?php
                                    $result = 0;
                                    foreach($keuanganPerBulan as $u){
                                        if($i == $u->bulan){ 
                                            $result = $u->jumPeminjamanPerbulan;
                                        }
                                    } 
                                    if($result == 0){
                                    echo "Rp 0";
                                    }else{
                                    echo "Rp " . number_format($result,0,',','.');
                                    }
                                ?>
                                </td>
                            <?php
                            }
                            ?>
                            <td>
                            <?php 
                            foreach($keuanganPertahun as $u){
                                echo "Rp " . number_format($u->jumPeminjamanPertahun,0,',','.');
                            }
                            ?>
                            </td>
                        </tr>
                        <tr class="text-center">
                        <td class="bg-warning text-white">Lunas</td>
                            <?php
                            for($i=1; $i<13; $i++){?>
                                <td>
                                    <?php
                                    $lunas = 0;
                                    foreach($keuanganLunasPerBulan as $u){
                                        if($i == $u->bulan){ 
                                            $lunas = $u->jumPeminjamanPerbulan;
                                        }
                                    } 
                                    if($lunas == 0){
                                        echo "Rp 0";
                                    }else{
                                        echo "Rp " . number_format($lunas,0,',','.');
                                    }
                                ?>
                                </td>
                            <?php
                            }
                            ?>
                            <td>
                            <?php 
                            foreach($keuanganLunasPertahun as $u){
                                if($u->jumPeminjamanPertahun == 0){
                                    echo "Rp 0";
                                }else{
                                    echo "Rp " . number_format($u->jumPeminjamanPertahun,0,',','.');
                                }
                            }
                            ?>
                            </td>
                        </tr>
                        <tr class="text-center">
                        <td class="bg-danger text-white">Belum Bayar</td>
                            <?php
                            for($i=1; $i<13; $i++){?>
                                <td>
                                    <?php
                                    $belumBayar = 0;
                                    foreach($keuanganBelumBayarPerBulan as $u){
                                        if($i == $u->bulan){ 
                                            $belumBayar = $u->jumPeminjamanPerbulan;
                                        }
                                    } 
                                    if($belumBayar == 0){
                                        echo "Rp 0";
                                    }else{
                                        echo "Rp " . number_format($belumBayar,0,',','.');
                                    }
                                ?>
                                </td>
                            <?php
                            }
                            ?>
                            <td>
                            <?php 
                            foreach($keuanganBelumBayarPertahun as $u){
                                
                                if($u->jumPeminjamanPertahun == 0){
                                    echo "Rp 0";
                                }else{
                                    echo "Rp " . number_format($u->jumPeminjamanPertahun,0,',','.');
                                }
                            }
                            ?>
                            </td>
                        </tr>
                      
                      
                    </tbody>
                </table>
            </div>
            <div class="row mt-4">
            <div class="col-xl-12 col-lg-7">
              <div class="card shadow mb-4">
                <div class="card-header bg-thead  py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-white">Grafik Keuangan</h6>
                  <div  class="dropdown  no-arrow">
                  </div>
                </div>
                <div class="card-body">
                  <div class="" >
                    <div class="chart" id="columnchart_material"></div>
                  </div>
                </div>
              </div>
            </div>

            

            
          </div>
      </div>
      
<script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Bulan', 'Total Peminjaman','belum bayar','lunas'],
          <?php
                            for($i=1; $i<13; $i++){
                                    $result = 0;
                                    $lunas = 0;
                                    $belumBayar = 0;
                                    foreach($keuanganPerBulan as $u){
                                        if($i == $u->bulan){ 
                                            $result = $u->jumPeminjamanPerbulan;
                                        }
                                    }
                                     
                                    foreach($keuanganLunasPerBulan as $u){
                                      if($i == $u->bulan){ 
                                          $lunas = $u->jumPeminjamanPerbulan;
                                      }
                                    } 
                                    foreach($keuanganBelumBayarPerBulan as $u){
                                      if($i == $u->bulan){ 
                                          $belumBayar = $u->jumPeminjamanPerbulan;
                                      }
                                    } 
                                    if($result == 0){ ?>
                                      [<?= $i;?>,<?= '0';?>,<?= '0';?>,<?= '0';?>], 
                                      <?php
                                    }else{?>
                                      [<?= $i;?>,<?= $result;?>,<?= $belumBayar;?>,<?= $lunas;?>],
                                        <?php 
                                    }
                               
                            }
                            
                            ?>
          
        ]);

        var options = {
          chart: {
            title: 'Grrafik Keuangan',
            subtitle: 'Dalam Perbulan',
          legend: { position: 'bottom' }
          },
          legend: { position: 'bottom' }

        };

        var chart = new google.charts.Line(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Line.convertOptions(options));
      }
    </script>



