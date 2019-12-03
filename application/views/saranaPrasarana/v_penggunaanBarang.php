<div class="container-fluid mt-4 mb-4">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <div>
            <h1 class="h3 mb-0 text-gray-800">Penggunaan Barang</h1>
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
            <form class="pr-2 form-inline" action="<?php echo site_url('saranaPrasarana/penggunaanBarang');?>"  method="get">
                <div class="form-group mb-2">
                    <input type="date" name="tanggal" class="form-control-sm " >
                </div>
                <button type="submit" class="btn btn-sm btn-primary mb-2">Search</button>
            </form>
          </div>

          <!-- Content Row -->
          <div class="row card  shadow">
            <div class="table-responsive div">
                <table class="table table-sm  table-penggunaan-barang  mx-0 text-center table-hover" id="myTable">
                    <thead class="bg-thead text-white" >
                        <tr>
                                <th style="font-size:14px;" class="text-left text-dark headcol">
                                    <input type="text"  class="form-control-sm" placeholder="Cari Barang" id="myInput" onkeyup="myFunction()">
                                </th>
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
                            foreach ($barang as $r){?>
                        <tr>
                        <td class="text-left headcol" style="font-size:14px;"><a href="<?php echo base_url("saranaPrasarana/detailBarang/".$r->id_barang)?>"><?= $r->nama_barang?></a> <br>
                            <?php 
                            foreach ($waktu as $w){
                                $result = 0; $terkirim = 0; $setuju = 0; 
                                $nama_keterangan=null; $nama_waktu=null; $nama_barang=null; $nama_penyelenggara = null;
                            ?>
                            <td  class="text-center table-bordered">
                                <?php 
                                foreach ($peminjaman as $j){

                                    $start = $j->jam_mulai;
                                    $end = $j->jam_selesai;
                                    for ($jam = $start; $jam <= $end; $jam++) {
                                        if($j->id_barang == $r->id_barang){
                                            if($w->id_waktu == $jam){
                                                if($j->validasi_akademik == 'setuju'){
                                                    $setuju = 1;
                                                    $nama_keterangan =$j->keterangan;
                                                    $nama_waktu = $w->nama_waktu;
                                                    $nama_barang = $j->nama_barang;
                                                    $nama_penyelenggara = $j->penyelenggara;
                                                ?> 
                                                <?php }else{
                                                    $terkirim = 1;
                                                    $nama_keterangan =$j->keterangan;
                                                    $nama_waktu = $w->nama_waktu;
                                                    $nama_barang = $j->nama_barang;
                                                    $nama_penyelenggara = $j->penyelenggara;
                                                    ?>
                                                <?php } 
                                                $result=1;
                                            }
                                        }
                                    }
                                }
                                if($result == 0){ ?>
                                    <a class="my-2 pt-2">
                                    <i  class="m-2 pt-2"  title="Barang Tidak Digunakan"></i>
                                    </a> <?php 
                                }else{?>
                                    <?php if($setuju == 1){ ?>
                                            <a data-toggle="modal"  style="cursor: pointer;" data-keterangan="<?= $nama_keterangan; ?>" data-barang="<?= $nama_barang; ?>" data-jam="<?= $nama_waktu; ?>" data-penyelenggara="<?= $nama_penyelenggara; ?>"
                                                class="btn open-modaRuangan text-dark" href="#modaRuangan">
                                                <i class="fas fa-square text-danger"  title="Barang Digunakan" style="font-size:22px"></i>
                                            </a>
                                        <?php }?>
                                    <?php if($terkirim == 1){ ?>
                                            <a data-toggle="modal"  style="cursor: pointer;" data-keterangan="<?= $nama_keterangan; ?>" data-barang="<?= $nama_barang; ?>" data-jam="<?= $nama_waktu; ?>" data-penyelenggara="<?= $nama_penyelenggara; ?>"
                                            class="btn open-modaRuangan text-dark" href="#modaRuangan">
                                            <i class="fas fa-times-circle fa-lg text-warning"  title="Barang Sedang Menungu Proses Validasi Peminjaman"></i>
                                            </a>
                                        <?php }?>
                                <?php }
                                ?> 
                            </td>
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
                <small class="mb-0 text-muted">Barang: <input id="barang"   style="border:none" ></small>
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
     var barang = $(this).data('barang');
     $(".modal-content #barang").val( barang );
     var penyelenggara = $(this).data('penyelenggara');
     $(".modal-content #penyelenggara").val( penyelenggara );
     var jam = $(this).data('jam');
     $(".modal-content #jam").val( jam );
});
</script>

<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>