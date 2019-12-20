<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIBORU - UB</title>
  <link rel="icon" href="<?php echo base_url() ?>/assets/img/ub.png">
  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url() ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url() ?>/assets/css/sb-admin-2.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url() ?>/assets/css/alumni-style.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

  <link href="<?php echo base_url() ?>/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
<?php foreach($peminjaman as $u){?>
  <!-- Page Wrapper -->
  <section class="card">
	<div id="invoice-template" class="card-body">
		<!-- Invoice Company Details -->
		<div id="invoice-company-details" class="row">
			<div class="col-md-6 col-sm-12 text-center text-md-left">
				<div class="media mt-4 pt-4">
					<img src="<?php echo base_url() ?>/assets/img/ub.png" style="width:100px" alt="company logo" class="">
					<div class="media-body">
						<ul class="ml-2 px-0 list-unstyled ">
							<li class="text-bold-800">KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI</li>
							<li>UNIVERSITAS BRAWIJAYA MALANG</li>
							<li>---------------------------------------------------</li>
							<li>SISTEM INFORMASI BOKING RUANGAN UB</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-12 text-center text-md-right">
                <h2>INVOICE PEMINJAMAN</h2>
                <img src="<?php echo base_url() ?>/assets/images/<?= $id_peminjaman;?>.png" style="width:80px" alt="company logo" class="">
				<p class="m-0">Kode Boking : <?= $id_peminjaman;?></p>
        <p class="pb-3">Tgl Peminjaman : <?= date("d-m-Y", strtotime($u->tanggal_peminjaman)); ?></p>
				
			</div>
		</div>
		<!--/ Invoice Company Details -->

		<!-- Invoice Customer Details -->
		<div id="invoice-customer-details" class="row pt-2">
		
			<div class="col-md-5 col-sm-12 text-center text-md-left">
            <table class="table table-borderless table-sm">
                <tbody>
                        <tr>
                            <td>Nama:</td>
                            <td class="text-left">: <?= $u->nama_mahasiswa; ?><?= $u->nama_peminjam; ?></td>
                        </tr>
                        <tr>
                            <td>Username:</td>
                            <td class="text-left">: <?= $u->id_peminjam; ?></td>
                        </tr>
                        <tr>
                            <td>Penyelenggara:</td>
                            <td class="text-left">: <?= $u->penyelenggara; ?></td>
                        </tr>
                        <tr>
                            <td>Tgl Penggunaan:</td>
                            <td class="text-left">:<?= date("d-m-Y", strtotime($u->tanggal_mulai_penggunaan)); ?> s/d
                            <?= date("d-m-Y", strtotime($u->tanggal_selesai_penggunaan)); ?></td>
                        </tr>
                        <tr>
                            <td>Jam:</td>
                            <td class="text-left">:
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
                                ?>
                                
                                <?= $start?> - <?= $end?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-3 col-sm-12 text-center text-md-left">
           
			</div>
			<div class="col-md-4 col-sm-12 text-center text-md-right">
				<p><span class="text-muted m-0 p-0">Status :</span> <?= $u->validasi_akademik?></p>
				<p><span class="text-muted m-0 p-0">Keterangan :</span> <?= $u->keterangan ?></p>
			</div>
		</div>
		<!--/ Invoice Customer Details -->

		<!-- Invoice Items Details -->
		<div id="invoice-items-details" class="pt-2">
			<div class="row">
				<div class="table-responsive col-sm-12">
					<table class="table">
					  <thead>
					    <tr>
					      <th>#</th>
					      <th>Biaya</th>
					      <th>Jumlah</th>
					      <th>Harga Satuan @</th>
					      <th>Total Harga</th>
					    </tr>
					  </thead>
					  <tbody>
            <?php $no=1; $total=0;
                    foreach($tagihan as $t){?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $t->nama_tagihan;?></td>
                        <td><?= $t->jumlah;?></td>
                        <td><?= $t->harga_satuan;?></td>
                        <td>Rp <?= $t->total_tagihan;?></td>
                    </tr>
                    <?php $no++; 
                        $total = $total + $t->total_tagihan;
                     } ?>
                     <tr class="">
                        <td>#</td>
                        <th class=" text-dark" colspan="3">Total Biaya Peminjaman</th>
                        <th class=" text-dark" >Rp <?= $total;?></th>
                     </tr>
					   
					  </tbody>
					</table>
				</div>
			</div>
			
		</div>

		<!-- Invoice Footer -->
		
		<!--/ Invoice Footer -->

	</div>
</section>
<?php break; } ?>
<script>window.print();</script>


  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url()?>/assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url()?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url()?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url()?>/assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url()?>/assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url()?>/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url()?>/assets/js/demo/datatables-demo.js"></script>


</body>

</html>
