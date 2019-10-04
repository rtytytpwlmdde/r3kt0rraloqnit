<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/style/navbar.css">

    <!-- date picker-->
    
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    
    <!-- date table sxport-->



    
    
    
    
    




    <title>Ruang FH</title>
  </head>
  <body>
    <nav class="shadow  navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url('JadwalKuliah/petaJadwalKuliah'); ?>">Ruang FH</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="container collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class=" navbar-nav mr-auto">
                    
                    <li class="nav-item ">
                        <a class="nav-link" href="<?php echo base_url('JadwalKuliah/petaJadwalKuliah'); ?>">Jadwal Kuliah <span class="sr-only">(current)</span></a>
                    </li>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Sarana Prasarana
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="nav-link" href="<?php echo base_url('SaranaPrasarana/petaPenggunaanRuanganKelas'); ?>">Ruangan Kelas</a>
                                <a class="nav-link" href="<?php echo base_url('SaranaPrasarana/petaPenggunaanRuanganNonKelas'); ?>">Ruangan Non Kelas</a>
                                <a class="nav-link" href="<?php echo base_url('SaranaPrasarana/petaPenggunaanBarang'); ?>">Barang</a>
                            </li>
                        </ul>
                    </div>
                    <?php if($this->session->userdata('logged_in') == FALSE){ ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('Complaint/formTambahComplaint'); ?>">Complain</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('Peminjaman/formCekPeminjaman'); ?>">Cek Peminjaman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('Complaint/formCekComplaint'); ?>">Cek Complaint</a>
                        </li>
                    <?php } ?>
                    <?php if($this->session->userdata('status_operator') == "staff pelayanan"){ ?>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Peminjaman
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="nav-link" href="<?php echo base_url('Peminjaman/formTambahPeminjamanNonKelas'); ?>">Peminjaman Non Kelas</a>
                                <a class="nav-link" href="<?php echo base_url('Peminjaman/formTambahPeminjamanBarang'); ?>">Peminjaman Barang</a>
                            </li>
                        </ul>
                    </div>
                    <li class="nav-item ">
                        <a class="nav-link" href="<?php echo base_url('Complaint/complaint'); ?>">Complaint </a>
                    </li>
                    <?php }?>
                    
                    <?php if($this->session->userdata('logged_in') == TRUE){ ?>
                    <li class="nav-item ">
                        <a class="nav-link" href="<?php echo base_url('Peminjaman/historyPeminjaman'); ?>">History Peminjaman </a>
                    </li>
                    <?php }?>
                    
                    
                    </ul>
                    <?php if($this->session->userdata('logged_in') == FALSE){ ?>
                    <form class="form-inline my-2 my-lg-0">
                        <a  href="<?php echo base_url('auth/login'); ?>" class=" my-2 my-sm-0 text-muted" >Sign in</a>
                    </form>
                    <?php }else{ ?>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                                <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?=  $this->session->userdata('username')?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Update Password</a>
                                    <a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>">Logout</a>
                                </li>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
        </div>
      </nav>

        <div>
            <?php $this->load->view($main_view); ?>
        </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <script type="text/javascript" src="<?php echo base_url().'assets/select/js/jquery-2.2.3.min.js'?>"></script>
</body>
</html>