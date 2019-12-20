

    
       
    <div class="container">
    <?php
        $notif = $this->session->flashdata('notif');
        if($notif != NULL){
            echo '
            <div class="alert alert-danger alert-dismissible fade show bg-danger text-white" role="alert">
              <strong>Info!</strong> '.$notif.'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            ';
        }
        $notifsukses = $this->session->flashdata('notifsukses');
        if($notifsukses != NULL){
            echo '
            <div class="alert alert-success alert-dismissible fade show bg-success text-white" role="alert">
              <strong>Info!</strong> '.$notifsukses.'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            ';
        }
    ?>
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0 ">
            <div class="row ">
              <div class="col-lg-6 d-none d-lg-block bg-login-images bg-primary">
              <div class="p-5 my-3 text-center">
              <img class="d-block mx-auto mb-4" src="<?php echo base_url('assets/img/ub.png'); ?>" alt="" width="90" height="90">
              <h5 class="text-white">UNIVERSITAS BRAWIJAYA</h5>
            </div>
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Gazebo UB</h1>
                  </div>
                  <form class="user" action="<?php echo base_url().'index.php?/Auth/register'; ?>" method="post">
                    <div class="form-group">
                      <input required type="text" name="id_mahasiswa" class="form-control form-control-user" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <input required type="text" name="nama_mahasiswa" class="form-control form-control-user" placeholder="Nama">
                    </div>
                    
                    <div class="form-group">
                        <input required type="text" name="nomor_telpon" class="form-control form-control-user" placeholder="Nomor Telpon">
                    </div>
                    <div class="form-group">
                        <input required type="text" name="alamat" class="form-control form-control-user" placeholder="Alamat">
                    </div>
                    <div class="form-group">
                        <input required type="text" name="instansi" class="form-control form-control-user" placeholder="Instansi">
                    </div>
                    <div class="form-group">
                      <input required type="password" name="password" class="form-control form-control-user" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <input required type="password" name="passwsord" class="form-control form-control-user" placeholder="Masukkan Password Anda Sekali Lagi">
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Daftar
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Lupa Password?</a>
                    <a class="small ml-2" href="<?php echo base_url().'index.php?/Auth/login'; ?>">Login</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  