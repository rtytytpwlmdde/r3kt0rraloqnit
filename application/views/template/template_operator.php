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
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> 
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url() ?>/assets/css/sb-admin-2.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url() ?>/assets/css/alumni-style.css" rel="stylesheet" type="text/css">  
  <link href="<?php echo base_url() ?>/assets/css/image-css.scss" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.11.2/css/pro.min.css">  

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

  <link href="<?php echo base_url() ?>/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src="https://cdn.ckeditor.com/4.13.0/full/ckeditor.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css">  
  <script scr="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/js/swiper.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.css">
<link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">

<script src="https://unpkg.com/swiper/js/swiper.js"></script>
<script src="https://unpkg.com/swiper/js/swiper.min.js"></script>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-lighst sidebar sidebar-light accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand  d-flex align-items-center justify-content-center bg-biru" href="<?php echo base_url('saranaPrasarana/saranaPrasarana')?>">
        <div class="sidebar-brand-icon ">
          <img src="<?php echo base_url(); ?>/assets/img/ub.png" width="35" height="35" alt="">
        </div>
        <div class="sidebar-brand-text mx-3 text-light">Siboru <sup>UB</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

     

    <?php if($this->session->userdata('status') == "admin"){ ?>
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('rekap/dashboard'); ?>">
        <i class="fas fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('agenda'); ?>">
        <i class="fas fa-calendar-week"></i>
          <span>Agenda</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('peminjaman/historyPeminjaman'); ?>">
            <i class="fas fa-circle-notch"></i>
          <span>History Peminjaman</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('saranaPrasarana/saranaPrasarana'); ?>">
            <i class="fas fa-building"></i>
          <span>Sarana Prasarana</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('saranaPrasarana/penggunaanRuangan'); ?>">
            <i class="fas fa-building"></i>
          <span>Penggunaan Ruangan</span></a>
      </li>
      <li  class="nav-item">
        <a class="nav-link" href="<?php echo base_url('saranaPrasarana/penggunaanBarang'); ?>">
          <i class="fas fa-laptop"></i>
          <span>Penggunaan Barang</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('peminjaman/formTambahPeminjaman/ruangan'); ?>">
        <i class="far fa-plus-square"></i>
          <span>Tambah Peminjaman Ruangan</span></a>
      </li>
      <li  class="nav-item">
        <a class="nav-link" href="<?php echo base_url('peminjaman/formTambahPeminjaman/barang'); ?>">
        <i class="far fa-plus-square"></i>
          <span>Tambah Peminjaman Barang</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-database"></i>
          <span>Master Data</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url('user/operator'); ?>">Operator</a>
            <a class="collapse-item" href="<?php echo base_url('saranaPrasarana/ruangan'); ?>">Ruangan</a>
            <a  class="collapse-item" href="<?php echo base_url('saranaPrasarana/barang'); ?>">Barang</a>
            <a class="collapse-item" href="<?php echo base_url('user/user'); ?>">User</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwos" aria-expanded="true" aria-controls="collapseTwo">
            <i class="far fa-chart-bar"></i>
          <span>Rekap</span>
        </a>
        <div id="collapseTwos" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url('peminjaman/historyPeminjaman'); ?>">History Peminjaman</a>
            <a class="collapse-item" href="<?php echo base_url('rekap/rekapPeminjaman'); ?>">Rekap Peminjaman</a>
            <a class="collapse-item" href="<?php echo base_url('rekap/rekapPemakaianRuangan'); ?>">Rekap Penggunaan Ruangan</a>
            <a class="collapse-item" href="<?php echo base_url('rekap/rekapPemakaianBarang'); ?>">Rekap Penggunaan Barang</a>
          </div>
        </div>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('peminjaman/formCekPeminjaman'); ?>">
        <i class="fas fa-search"></i>
          <span>Kode Boking</span></a>
      </li>
    <?php }else{ ?>
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('peminjaman/historyPeminjaman'); ?>">
            <i class="fas fa-circle-notch"></i>
          <span>History Peminjaman</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('saranaPrasarana/penggunaanRuangan'); ?>">
            <i class="fas fa-building"></i>
          <span>Penggunaan Ruangan</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('peminjaman/formTambahPeminjaman'); ?>">
        <i class="far fa-plus-square"></i>
          <span>Tambah Peminjaman</span></a>
      </li>
    <?php } ?>


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-biru topbar mb-2 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars text-light"></i>
          </button>

          
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1"><?php foreach($jumlahPeminjaman as $u){ $jumPeminjaman =  $u->jumPeminjamanTerkirim; } $a = $jumPeminjaman?>
              <a class="nav-link dropdown-toggle text-white" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                title="Terdapat <?= $jumPeminjaman?> Peminjaman Yang Belum Di Proses" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <?php if($a > 0){ ?>
                <span class="badge badge-danger badge-counter" > <?= $jumPeminjaman?> </span>
                <?php } ?>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header"> Terdapat <?= $jumPeminjaman?> Peminjaman Baru</h6> 
                <form class="dropdown-item" action="<?php  echo base_url('peminjaman/historyPeminjaman'); ?>" method="post"><input hidden name="status" value="terkirim">
                    <button class="text-center small text-gray-800" type="submit">Tampilkan Semua</button>
                </form>
              </div>
            </li>
            <?php if($this->session->userdata('status') == "admin"){ ?>
            <li class="nav-item dropdown no-arrow mx-1"><?php foreach($jumlahUser as $u){ $jumUser =  $u->jumUserBaru; }?>
              <a class="nav-link dropdown-toggle text-white" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                title="Terdapat <?= $jumUser?> User Baru Yang Belum Divalidasi" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i>
                <!-- Counter - Alerts -->
                <?php if($jumUser > 0){ ?>
                <span class="badge badge-danger badge-counter" > <?= $jumUser?> </span>
                <?php } ?>
              </a>
              <!-- Dropdown - Alerts -->
             
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header"> Terdapat <?= $jumUser?> User Baru</h6>
                <form class="dropdown-item" action="<?php  echo base_url('user/user'); ?>" method="post"><input hidden name="status_mahasiswa" value="belum divalidasi">
                    <button class="text-center small text-gray-800" type="submit">Tampilkan Semua</button>
                </form>
              </div>
            </li>
            <?php } ?>

         

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-200 small"><?php echo $this->session->userdata('username'); ?></span>
               
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
               
                
                <a class="dropdown-item" href="<?php echo base_url('auth/profil') ?>" >Profil</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="#" data-toggle="modal" data-target="#logoutModal">
                  
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="m-2">
            <?php $this->load->view($main_view); ?>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer ">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Siboru UB</span>
            <span>2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Logout dari sistem?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Pilih "Logout" untuk keluar dari sistem.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?php echo base_url('auth/logout'); ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

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
  <script type="text/javascript" src="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>

</body>

</html>
