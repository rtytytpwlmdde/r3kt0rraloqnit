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
  <link href="<?php echo base_url() ?>/assets/css/user-style.css" rel="stylesheet" type="text/css">
  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   
</head>

<body>

    <div class="">
        <nav class="navbar navbar-expand-lg navbar-light bg-biru shadow">
          <div class="container">
            <a class="navbar-brand text-white " href="<?php echo base_url('agenda'); ?>"><img src="<?php echo base_url(); ?>/assets/img/ub.png" width="35" height="35" alt=""> Siboru <sup>UB</sup></a>
            <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-white"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto ml-3">
                <li class="nav-item active">
                    <a class="nav-link text-white" href="<?php echo base_url('saranaPrasarana/penggunaanRuangan'); ?>">Ruangan <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" 
                    <?php if($this->session->userdata('logged_in') == FALSE){ ?>
                      href="<?php echo base_url('auth/login'); ?>"
                      <?php }else{ ?>
                      href="<?php echo base_url('peminjaman/formTambahPeminjaman'); ?>"
                      <?php }?>
                    
                    >Peminjaman Baru</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?php echo base_url('peminjaman/formCekPeminjaman'); ?>">Cek Peminjaman</a>
                </li>
               <?php
                if($this->session->userdata('status') == "pengguna" ){ ?>
                  <li class="nav-item">
                      <a class="nav-link text-white" href="<?php echo base_url('peminjaman/historyPeminjaman'); ?>">History Peminjaman</a>
                  </li>
                <?php
                }
               ?>
                </ul>
                <form class="form-inline my-2 my-lg-0 ">
                <?php if($this->session->userdata('logged_in') == FALSE){ ?>
                    <a class="my-2 my-sm-0 text-white" href="<?php echo base_url('auth/login') ?>">Login</a>
                      <?php }else{ ?>
                        <div class="btn-group">
                          <a  class="dropdown-toggle text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= $this->session->userdata('nama')?>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="my-2 my-sm-0  dropdown-item" href="<?php echo base_url('auth/profil') ?>" >Profil</a>
                            <a class="my-2 my-sm-0  text-danger dropdown-item" data-toggle="modal" data-target="#logoutModal" >Logout</a>
                          </div>
                        </div>
                    
                      <?php }?>
                </form>
            </div>
          </div>
        </nav>
    </div>

    <div class="">
        <?php $this->load->view($main_view); ?>
    </div>


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
  <script src="<?php echo base_url()?>/assets/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url()?>/assets/js/demo/chart-area-demo.js"></script>
  <script src="<?php echo base_url()?>/assets/js/demo/chart-pie-demo.js"></script>

</body>

</html>
