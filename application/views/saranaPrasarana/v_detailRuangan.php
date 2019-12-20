
<div class="

<?php 
if($this->session->userdata('status') == "pengguna" || $this->session->userdata('logged_in') == FALSE){
    echo "container";
}
?>">
<div class="col-md-12">
<?php
        $gagal = $this->session->flashdata('gagal');
        if($gagal != NULL){
            echo '
            <div class="alert alert-danger alert-dismissible fade show bg-danger text-white" role="alert">
              <strong></strong> '.$gagal.'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            ';
        }
        $sukses = $this->session->flashdata('sukses');
        if($sukses != NULL){
            echo '
            <div class="alert alert-success alert-dismissible fade show bg-success text-white" role="alert">
              <strong></strong> '.$sukses.'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            ';
        }
    ?>
    <?php foreach($ruangan as $u){?>
    <div class="mt-2">
        <div class="row py-2 ">
            <div class="col-6 col-md-8 ">
            </div>
            <div class="col-6 col-md-4">
                <div class="d-flex flex-row-reverse bd-highlight">
                    <?php if($this->session->userdata('status') == 'admin'){ ?>
                    <a class="btn btn-sm btn-primary mb-2"  href="<?php  echo base_url('index.php?/SaranaPrasarana/updateRuangan/'.$u->id_ruangan); ?>" role="button">Edit Ruangan</a>
                        <?php }?>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white   p-2" >
        <div class="row py-2 ">
            <div class="col-md-8">
                <div class="px-2">
                    <h5 class="font-weight-bold m-0 text-dark"><?= $u->nama_ruangan;?></h5>
                    <h6 ><i class="fa fa-map-marker" aria-hidden="true"></i> <?= $u->nama_lokasi;?></h6>
                </div>
            </div>
            <div class="col-md-4">
                <div class="px-2 ">
                  <div class="d-flex flex-row-reverse bd-highlight">
                      <h5 class="btn btn-warning"><?php  echo "Rp " . number_format($u->harga_ruangan,0,',','.');?></h5>
                  </div>
                </div>
            </div>
        </div>
        <div class="row py-2 ">
            <div class="col-md-12">
                <div class="border-bottom px-2">
                  <div class="row border py-2">
                      <div class="col-md-9 ">
                          <div class="swiper-container main-slider " style="width:100%">
                          <div class="swiper-wrapper">
                            <div class="swiper-slide">
                              <figure class="slide-bgimg" style="background-image:url(<?php echo base_url("assets/ruangan/".$u->foto_ruangan1);?>)">
                                <?php if($u->foto_ruangan1 == null){?>                               
                                  <img src="<?php echo base_url("assets/img/ub.png");?>" style="width:450px; heigh:60%; padding-left:200px;"   class=" pt-4 ml-4 pl-4 entity-img" />
                                <?php }else{ ?>
                                  <img src="<?php echo base_url("assets/ruangan/".$u->foto_ruangan1);?>" style="width:100%; heigh:100%;" class="entity-img" />
                                  <?php } ?>
                              </figure>
                              <div class="content">
                                <p class="title"></p>
                                <span class="caption"></span>
                              </div>
                            </div>
                            <div class="swiper-slide">
                              <figure class="slide-bgimg" style="background-image:url(<?php echo base_url("assets/ruangan/".$u->foto_ruangan2);?>)">
                              <?php if($u->foto_ruangan2 == null){?>                               
                                  <img src="<?php echo base_url("assets/img/ub.png");?>" style="width:450px; heigh:60%; padding-left:200px;"   class=" pt-4 ml-4 pl-4 entity-img" />
                                <?php }else{ ?>
                                  <img src="<?php echo base_url("assets/ruangan/".$u->foto_ruangan2);?>" style="width:100%; heigh:100%;" class="entity-img" />
                                  <?php } ?>                              
                                </figure>
                              <div class="content">
                                <p class="title"></p>
                                <span class="caption"></span>
                              </div>
                            </div>
                            <div class="swiper-slide">
                              <figure class="slide-bgimg" style="background-image:url(<?php echo base_url("assets/ruangan/".$u->foto_ruangan3);?>)">
                              <?php if($u->foto_ruangan3 == null){?>                               
                                  <img src="<?php echo base_url("assets/img/ub.png");?>" style="width:450px; heigh:60%; padding-left:200px;"   class=" pt-4 ml-4 pl-4 entity-img" />
                                <?php }else{ ?>
                                  <img src="<?php echo base_url("assets/ruangan/".$u->foto_ruangan3);?>" style="width:100%; heigh:100%;" class="entity-img" />
                                  <?php } ?>
                              </figure>
                              <div class="content">
                                <p class="title"></p>
                                <span class="caption"></span>
                              </div>
                            </div>
                            <div class="swiper-slide">
                              <figure class="slide-bgimg" style="background-image:url(<?php echo base_url("assets/ruangan/".$u->foto_ruangan4);?>)">
                              <?php if($u->foto_ruangan4 == null){?>                               
                                  <img src="<?php echo base_url("assets/img/ub.png");?>" style="width:450px; heigh:60%; padding-left:200px;"   class=" pt-4 ml-4 pl-4 entity-img" />
                                <?php }else{ ?>
                                  <img src="<?php echo base_url("assets/ruangan/".$u->foto_ruangan4);?>" style="width:100%; heigh:100%;" class="entity-img" />
                                  <?php } ?>
                              </figure>
                              <div class="content">
                                <p class="title"></p>
                                <span class="caption"></span>
                              </div>
                            </div>
                            <div class="swiper-slide">
                              <figure class="slide-bgimg" style="background-image:url(<?php echo base_url("assets/ruangan/".$u->foto_ruangan5);?>)">
                              <?php if($u->foto_ruangan5 == null){?>                               
                                  <img src="<?php echo base_url("assets/img/ub.png");?>" style="width:450px; heigh:60%; padding-left:200px;"   class=" pt-4 ml-4 pl-4 entity-img" />
                                <?php }else{ ?>
                                  <img src="<?php echo base_url("assets/ruangan/".$u->foto_ruangan5);?>" style="width:100%; heigh:100%;" class="entity-img" />
                                  <?php } ?>
                              </figure>
                              <div class="content">
                                <p class="title"></p>
                                <span class="caption"></span>
                              </div>
                            </div>
                          </div>
                          <!-- If we need navigation buttons -->
                          <div class="swiper-button-prev swiper-button-white"></div>
                          <div class="swiper-button-next swiper-button-white"></div>
                        </div>
                      </div>
                      <div class="col-md-3">

                        <!-- Thumbnail navigation -->
                        <div class="swiper-container nav-slider loading">
                          <div class="swiper-wrapper" role="navigation">
                            <div class="swiper-slide">
                              <figure class="slide-bgimg" style="heigh:5px; width:20px; background-image:url(<?php echo base_url("assets/ruangan/".$u->foto_ruangan1);?>)">
                                <?php if($u->foto_ruangan1 == null){?>                               
                                  <img style="width:70px;" src="<?php echo base_url("assets/img/ub.png");?>" class="entity-img" />
                                <?php }else{ ?>
                                  <img src="<?php echo base_url("assets/ruangan/".$u->foto_ruangan1);?>" class="entity-img" />
                                  <?php } ?>
                              </figure>
                            </div>
                            <div class="swiper-slide">
                              <figure class="slide-bgimg" style="heigh:5px; width:20px; background-image:url(<?php echo base_url("assets/ruangan/".$u->foto_ruangan2);?>)">
                              <?php if($u->foto_ruangan2 == null){?>                               
                                  <img style="width:70px;" src="<?php echo base_url("assets/img/ub.png");?>" class="entity-img" />
                                <?php }else{ ?>
                                  <img src="<?php echo base_url("assets/ruangan/".$u->foto_ruangan2);?>" class="entity-img" />
                                  <?php } ?>
                              </figure>
                            </div>
                            <div class="swiper-slide">
                              <figure class="slide-bgimg" style="heigh:5px; width:20px; background-image:url(<?php echo base_url("assets/ruangan/".$u->foto_ruangan3);?>)">
                              <?php if($u->foto_ruangan3 == null){?>                               
                                  <img style="width:70px;" src="<?php echo base_url("assets/img/ub.png");?>" class="entity-img" />
                                <?php }else{ ?>
                                  <img src="<?php echo base_url("assets/ruangan/".$u->foto_ruangan3);?>" class="entity-img" />
                                  <?php } ?>
                              </figure>
                            </div>
                            <div class="swiper-slide">
                              <figure class="slide-bgimg" style="heigh:5px; width:20px; background-image:url(<?php echo base_url("assets/ruangan/".$u->foto_ruangan4);?>)">
                              <?php if($u->foto_ruangan4 == null){?>                               
                                  <img style="width:70px;" src="<?php echo base_url("assets/img/ub.png");?>" class="entity-img" />
                                <?php }else{ ?>
                                  <img src="<?php echo base_url("assets/ruangan/".$u->foto_ruangan4);?>" class="entity-img" />
                                  <?php } ?>
                              </figure>
                            </div>
                            <div class="swiper-slide">
                              <figure class="slide-bgimg" style="heigh:5px; width:20px; background-image:url(<?php echo base_url("assets/ruangan/".$u->foto_ruangan5);?>)">
                              <?php if($u->foto_ruangan5 == null){?>                               
                                  <img style="width:70px;" src="<?php echo base_url("assets/img/ub.png");?>" class="entity-img" />
                                <?php }else{ ?>
                                  <img src="<?php echo base_url("assets/ruangan/".$u->foto_ruangan5);?>" class="entity-img" />
                                  <?php } ?>
                              </figure>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  
                
                </div>
            </div>
        </div>
        <div class="border  text-center">
          <div class="row py-2">
            <?php if($u->ac == 'ya'){?>
              <div class="col">
                <h5><i style="font-size:45px" class="text-primary fas fa-wind"></i></h5>
                <h6>AC</h6>
              </div>
            <?php } ?>
            <?php if($u->wifi == 'ya'){?>
              <div class="col">
                <h5><i style="font-size:45px" class="text-primary fas fa-wifi"></i></h5>
                <h6>Wifi</h6>
              </div>
            <?php } ?>
            <?php if($u->sound_system == 'ya'){?>
              <div class="col">
                <h5><i style="font-size:45px" class="text-primary fas fa-microphone-alt"></i></h5>
                <h6>Sound System</h6>
              </div>
            <?php } ?>
            <?php if($u->lcd == 'ya'){?>
              <div class="col">
                <h5><i style="font-size:45px" class="text-primary fas fa-projector"></i></h5>
                <h6>Projector</h6>
              </div>
            <?php } ?>
            <?php if($u->toilet == 'ya'){?>
              <div class="col">
                <h5><i style="font-size:45px" class="text-primary fas fa-toilet"></i></h5>
                <h6>Toilet</h6>
              </div>
            <?php } ?>
          </div>
        </div>
        <div class="row py-2 ">
            <div class="col-md-6 ">
                <div class=" border px-2">
                    <h5 class="font-weight-bold m-0 text-dark">Deskripsi Ruangan</h5>
                      <?php if($u->rapat == 'ya'){?>
                        <span class="badge badge-info">Ruangan Rapat</span>
                      <?php } ?>
                      <?php if($u->hall == 'ya'){?>
                        <span class="badge badge-info">Hall</span>
                      <?php } ?>
                      <?php if($u->terbuka == 'ya'){?>
                        <span class="badge badge-info">Ruangan Terbuka</span>
                      <?php } ?>
                      <?php if($u->auditorium == 'ya'){?>
                        <span class="badge badge-info">Auditorium</span>
                      <?php } ?>
                      <?php if($u->olahraga_tertutup == 'ya'){?>
                        <span class="badge badge-info">Olahraga</span>
                      <?php } ?>
                      <?php if($u->ruang_kuliah == 'ya'){?>
                        <span class="badge badge-info">Ruang Kuliah</span>
                      <?php } ?>
                    <span><?= $u->deskripsi_ruangan;?></span>
                </div>
            </div>
            <div class="col-md-6 ">
              <div class="  px-2">
                <h5 class="font-weight-bold m-0 text-dark">Fasilitas</h5>
                <div class="row">
                  <div class="col-md-6">
                    <div class="bg-primary text-white p-2 mb-1">
                      <span>Luas Ruangan</span><br>
                      <span><?= $u->luas_ruangan?> m  <sub>2</sub> </span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="bg-primary text-white p-2 mb-1">
                        <span>Teater</span><br>
                        <span><?= $u->teater?></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="bg-primary text-white p-2 mb-1">
                      <span>Ruang Kelas</span><br>
                      <span><?= $u->ruang_kelas?></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="bg-primary text-white p-2 mb-1">
                      <span>Ruang Rapat</span><br>
                      <span><?= $u->ruang_rapat?></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="bg-primary text-white p-2">
                      <span>Perjamuan</span><br>
                      <span><?= $u->perjamuan?></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="bg-primary text-white p-2">
                      <span>Berbentuk U</span><br>
                      <span><?= $u->ushape?></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>

        <div class="row py-2 ">
            <div class="col-md-12 ">
                <div class=" border px-2">
                    <h5 class="font-weight-bold m-0 text-dark">Penggunaan Ruangan</h5>
                    <table class="table table-sm table-striped">
                      <thead>
                        <tr>
                          <td>Tgl</td>
                          <td>Jam</td>
                          <td>Penyelenggara</td>
                          <td>Acara</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($penggunaanRuangan as $p){ ?>
                        <tr>
                          <td><?= $p->tanggal_mulai_penggunaan?></td>
                          <td>
                          <?php foreach ($waktu as $r){?>
                            <?php if($r->id_waktu == $p->jam_mulai){?>
                            <?php 
                             $mulai = explode("-", $r->nama_waktu);
                             $start = $mulai[0];
                             ?><?= $start?> - 
                             <?php }?>
                             <?php if($r->id_waktu == $p->jam_selesai){?>
                            <?php 
                             $mulai = explode("-", $r->nama_waktu);
                             $start = $mulai[1];
                             ?><?= $start?> 
                             <?php }?>
                          <?php }?>
                          </td>
                          <td><?= $p->penyelenggara?></td>
                          <td><?= $p->keterangan?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                </div>
            </div>
           
        </div>
    </div>
        
    </div>
    
    <?php } ?>
</div>

<script>
// Params
let mainSliderSelector = '.main-slider',
    navSliderSelector = '.nav-slider',
    interleaveOffset = 0.5;

// Main Slider
let mainSliderOptions = {
      loop: true,
      speed:1000,
      autoplay:{
        delay:3000
      },
      loopAdditionalSlides: 10,
      grabCursor: true,
      watchSlidesProgress: true,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      on: {
        init: function(){
          this.autoplay.stop();
        },
        imagesReady: function(){
          this.el.classList.remove('loading');
          this.autoplay.start();
        },
        slideChangeTransitionEnd: function(){
          let swiper = this,
              captions = swiper.el.querySelectorAll('.caption');
          for (let i = 0; i < captions.length; ++i) {
            captions[i].classList.remove('show');
          }
          swiper.slides[swiper.activeIndex].querySelector('.caption').classList.add('show');
        },
        progress: function(){
          let swiper = this;
          for (let i = 0; i < swiper.slides.length; i++) {
            let slideProgress = swiper.slides[i].progress,
                innerOffset = swiper.width * interleaveOffset,
                innerTranslate = slideProgress * innerOffset;
           
            swiper.slides[i].querySelector(".slide-bgimg").style.transform =
              "translateX(" + innerTranslate + "px)";
          }
        },
        touchStart: function() {
          let swiper = this;
          for (let i = 0; i < swiper.slides.length; i++) {
            swiper.slides[i].style.transition = "";
          }
        },
        setTransition: function(speed) {
          let swiper = this;
          for (let i = 0; i < swiper.slides.length; i++) {
            swiper.slides[i].style.transition = speed + "ms";
            swiper.slides[i].querySelector(".slide-bgimg").style.transition =
              speed + "ms";
          }
        }
      }
    };
let mainSlider = new Swiper(mainSliderSelector, mainSliderOptions);

// Navigation Slider
let navSliderOptions = {
      loop: true,
      loopAdditionalSlides: 10,
      speed:1000,
      spaceBetween: 5,
      slidesPerView: 5,
      centeredSlides : true,
      touchRatio: 0.2,
      slideToClickedSlide: true,
      direction: 'vertical',
      on: {
        imagesReady: function(){
          this.el.classList.remove('loading');
        },
        click: function(){
          mainSlider.autoplay.stop();
        }
      }
    };
let navSlider = new Swiper(navSliderSelector, navSliderOptions);

// Matching sliders
mainSlider.controller.control = navSlider;
navSlider.controller.control = mainSlider;
</script>