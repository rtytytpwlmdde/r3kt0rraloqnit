
<!DOCTYPE html>
<html>
<head>
	<title>INVOICE</title>
    <link href="<?php echo base_url(); ?>/assets/css/print.css" rel="stylesheet"> 
         <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body >
<div class="book">
<?php foreach($invoice as $u){
    
    $date=date_create($u->tanggal_transaksi);
    ?>
    <div class="page">
        <div class="subpage">
            <div id="invoice">
                <div class="invoice overflow-auto">
                    <div style="min-width: 600px">
                        <header>
                            <div class="row">
                                <div class="col">
                                        <img class="logo" src="<?php echo base_url(); ?>/assets/images/ub.png" data-holder-rendered="true" />
                                </div>
                                <div class="col company-details">
                                    <h2 class="name">
                                        FAKULTAS EKONOMI DAN BISNIS
                                        UNIVERSITAS BRAWIJAYA
                                    </h2>
                                    <div>Jl. MT. Haryono No.165, Ketawanggede, Kec. Lowokwaru</div>
                                    <div>Kota Malang, Jawa Timur 65300</div>
                                    <div>(0341) 555000</div>
                                    <div>feb.ub.ac.id</div>
                                </div>
                            </div>
                        </header>
                        <main>
                            <div class="row contacts">
                                <div class="col invoice-to">
                                    <div class="text-gray-light">Kepada:</div>
                                    <h2 class="to"><?= $u->nama; ?></h2>
                                    <div class="address">Jl. <?= $u->jalan;?>, Kota/Kab. <?= $u->kota;?>, Prov. <?= $u->provinsi;?>  </div>
                                    <div class="email "><?= $u->nomor_hp; ?></div>
                                </div>
                                <div class="col invoice-details">
                                    <h1 class="invoice-id text-dark"><?= $u->id_transaksi; ?></h1>
                                    <div class="date">Tgl Pemesanan : <?= date_format($date,"d-m-Y") ; ?></div>
                                </div>
                            </div>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">Produk</th>
                                        <th class="unit text-right">Jumlah</th>
                                        <th class="text-right">Harga @</th>
                                        <th class="unit text-right">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $no = 1;
                                foreach($produk as $i){ 
                                    if($u->id_transaksi == $i->id_transaksi){?>
                                    <tr>
                                        <td class="no"><?= $no++; ?></td>
                                        <td class="text-left"><h3><?= $i->nama_produk; ?></h3></td>
                                        <td class="unit"><?= $i->jumlah_produk; ?></td>
                                        <td class="qty"><?= $i->harga_produk;?></td>
                                        <td class="unit">Rp <?= $i->harga_transaksi ?></td>
                                    </tr>
                                <?php }  } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">SUBTOTAL</td>
                                        <td> <strong>Rp <?= $u->total_harga ?></strong> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">Ongkos Kirim</td>
                                        <td>Rp <?= $u->ongkos_kirim ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">GRAND TOTAL</td>
                                        <td> <strong>Rp <?= $u->total_pembayaran ?></strong> </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="thanks">Thank you!</div>
                        </main>
                        <footer>
                            Invoice was created on a computer and is valid without the signature and seal.
                        </footer>
                    </div>
                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                    <div></div>
                </div>
            </div>
         <!-- -->
         <div id="invoice">
                <div class="invoice overflow-auto">
                    <div style="min-width: 600px">
                        <div>
                            <div class="row"  style="
                                    border-style: solid;
                                    border-width: 2px 10px 4px 20px;
                                    padding-top:5px; padding-bottom:5px;">
                                <div class="col" style="max-width:150px; padding-top:15px;">
                                        <img style="width:120px;" src="<?php echo base_url(); ?>/assets/images/ub.png" data-holder-rendered="true" />
                                </div>
                                <div class="col text-left">
                                    <div class="text-gray-light">Dari:</div>
                                    <h5 class="name">
                                        FAKULTAS EKONOMI DAN BISNIS
                                    </h5>
                                    <h6> UNIVERSITAS BRAWIJAYA</h6>
                                    <div>Jl. MT. Haryono No.165, Ketawanggede, Kec. Lowokwaru</div>
                                    <div>Kota Malang, Jawa Timur 65300</div>
                                    <div>(0341) 555000</div>
                                    <div>feb.ub.ac.id</div>
                                </div>
                                <div class="col invoice-to text-right">
                                    <div class="text-gray-light">Kepada:</div>
                                    <h2 class="to"><?= $u->nama; ?></h2>
                                    <div class="address">Jl. <?= $u->jalan;?> </div>
                                    <div class="address">Kota/Kab. <?= $u->kota;?></div>
                                    <div class="address">Prov. <?= $u->provinsi;?>  </div>
                                    <div class="email "><?= $u->nomor_hp; ?></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                    <div></div>
                </div>
            </div>
        </div>    
    </div>
<?php } ?>
</div>

<script> window.print();
</script>

</body>
</html>
