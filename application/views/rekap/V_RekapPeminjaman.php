<div class="col-md-12">
            <div class="mt-2">
                    <div class="row py-2 ">
                        <div class="col-6 col-md-8 ">
                            <h3 class="text-muted">Rekap Jumlah Peminjaman</h3>
                            <h6 class="text-muted">Tahun <?= $tahun; ?></h6 class="text-muted">
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="d-flex flex-row-reverse bd-highlight">
                                <form class="form-inline" action="<?php  echo base_url('Rekap/rekapPeminjaman'); ?>">
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
                            <?php
                            for($i=1; $i<13; $i++){?>
                                <td>
                                    <?php
                                    $result = 0;
                                    foreach($peminjamanPerBulan as $u){
                                        if($i == $u->bulan){ 
                                            $result = $u->jumPeminjamanPerbulan;
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
                            <td>
                            <?php 
                            foreach($peminjamanPertahun as $u){
                                echo $u->jumPeminjamanPertahun;
                            }
                            ?>
                            </td>
                        </tr>
                      
                      
                    </tbody>
                </table>
            </div>
      </div>