<div class="col-md-12">
            <div class="mt-2">
                <div class="row py-2 ">
                    <div class="col-6 col-md-8 ">
                        <h3 class="text-muted">Rekap Pemakaian Ruangan</h3>
                        <h6 class="text-muted">Tahun <?= $tahun; ?></h6 class="text-muted">
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="d-flex flex-row-reverse bd-highlight">
                            <form class="form-inline" action="<?php  echo base_url('index.php?/Rekap/rekapPemakaianRuangan'); ?>">
                                <div class="form-group ">
                                    <input type="text" name="tahun" class="form-control-sm" value="<?= $tahun; ?>">
                                    <button type="submit" class="btn btn-sm btn-light"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow p-2" >
                <table class="table table-bordered" id="dataTable">
                    <thead class="bg-thead text-white">
                        <tr>
                        <th class="text-center" scope="col">Ruangan</th>
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
                        <?php 
                        foreach($ruangan as $r){ 
                        ?>
                            <tr class="text-left">
                                <td><?= $r->nama_ruangan; ?></td>
                                <?php
                                for($i=1; $i<13; $i++){?>
                                    <td class="text-center">
                                        <?php
                                        $result = 0;
                                        foreach($ruanganPerBulan as $u){
                                            if($i == $u->bulan){ 
                                                if($r->id_ruangan == $u->id_sarana){
                                                $result = $u->jumPemakaianRuanganPerbulan;
                                                }
                                            }
                                        } 
                                        if($result == 0){
                                            echo "0";
                                        }else{
                                            echo $result;
                                        }
                                    ?>
                                    </td>
                                <?php
                                }
                                ?>
                                <td class="text-center">
                                <?php 
                                $result = 0;
                                foreach($ruanganPerTahun as $u){
                                    if($r->id_ruangan == $u->id_sarana){
                                        $result = $u->jumPemakaianRuanganPertahun;
                                    }
                                }
                                if($result == 0){
                                    echo "0";
                                }else{
                                    echo $result;
                                }
                                ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
      </div><br>
