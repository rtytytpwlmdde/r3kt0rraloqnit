
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
    <?php foreach($barang as $u){?>
    <div class="mt-2">
        <div class="row py-2 ">
            <div class="col-6 col-md-8 ">
            </div>
            <div class="col-6 col-md-4">
                <div class="d-flex flex-row-reverse bd-highlight">
                    <?php if($this->session->userdata('status') == 'admin'){ ?>
                    <a class="btn btn-sm btn-primary mb-2"  href="<?php  echo base_url('index.php?/SaranaPrasarana/updateBarang/'.$u->id_barang); ?>" role="button">Edit Barang</a>
                        <?php }?>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white   p-2" >
        <div class="row py-2 ">
            <div class="col-md-8">
                <div class="px-2">
                    <h5 class="font-weight-bold m-0 text-dark"><?= $u->nama_barang;?></h5>
                    <h6 ><i class="fa fa-map-marker" aria-hidden="true"></i> Universitas Brawijaya Malang</h6>
                </div>
            </div>
            <div class="col-md-4">
                <div class="px-2 ">
                  <div class="d-flex flex-row-reverse bd-highlight">
                      <h5 class="btn btn-warning"><?php  echo "Rp " . number_format($u->harga_barang,0,',','.');?></h5>
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
                              <figure class="slide-bgimg" style="background-image:url(<?php echo base_url("assets/barang/".$u->foto_barang1);?>)">
                                <img src="<?php echo base_url("assets/barang/".$u->foto_barang1);?>" style="width:100%; heigh:100%;" class="entity-img" />
                              </figure>
                              <div class="content">
                                <p class="title"></p>
                                <span class="caption"></span>
                              </div>
                            </div>
                            <div class="swiper-slide">
                              <figure class="slide-bgimg" style="background-image:url(<?php echo base_url("assets/barang/".$u->foto_barang2);?>)">
                                <img src="<?php echo base_url("assets/barang/".$u->foto_barang2);?>" style="width:100%; heigh:100%;" class="entity-img" />
                              </figure>
                              <div class="content">
                                <p class="title"></p>
                                <span class="caption"></span>
                              </div>
                            </div>
                            <div class="swiper-slide">
                              <figure class="slide-bgimg" style="background-image:url(<?php echo base_url("assets/barang/".$u->foto_barang3);?>)">
                                <img src="<?php echo base_url("assets/barang/".$u->foto_barang3);?>" style="width:100%; heigh:100%;" class="entity-img" />
                              </figure>
                              <div class="content">
                                <p class="title"></p>
                                <span class="caption"></span>
                              </div>
                            </div>
                            <div class="swiper-slide">
                              <figure class="slide-bgimg" style="background-image:url(<?php echo base_url("assets/barang/".$u->foto_barang4);?>)">
                                <img src="<?php echo base_url("assets/barang/".$u->foto_barang4);?>" style="width:100%; heigh:100%;" class="entity-img" />
                              </figure>
                              <div class="content">
                                <p class="title"></p>
                                <span class="caption"></span>
                              </div>
                            </div>
                            <div class="swiper-slide">
                              <figure class="slide-bgimg" style="background-image:url(<?php echo base_url("assets/barang/".$u->foto_barang5);?>)">
                                <img src="<?php echo base_url("assets/barang/".$u->foto_barang5);?>" style="width:100%; heigh:100%;" class="entity-img" />
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
                              <figure class="slide-bgimg" style="heigh:5px; width:20px; background-image:url(<?php echo base_url("assets/barang/".$u->foto_barang1);?>)">
                                <img src="<?php echo base_url("assets/barang/".$u->foto_barang1);?>" class="entity-img" />
                              </figure>
                            </div>
                            <div class="swiper-slide">
                              <figure class="slide-bgimg" style="heigh:5px; width:20px; background-image:url(<?php echo base_url("assets/barang/".$u->foto_barang2);?>)">
                                <img src="<?php echo base_url("assets/barang/".$u->foto_barang2);?>" class="entity-img" />
                              </figure>
                            </div>
                            <div class="swiper-slide">
                              <figure class="slide-bgimg" style="heigh:5px; width:20px; background-image:url(<?php echo base_url("assets/barang/".$u->foto_barang3);?>)">
                                <img src="<?php echo base_url("assets/barang/".$u->foto_barang3);?>" class="entity-img" />
                              </figure>
                            </div>
                            <div class="swiper-slide">
                              <figure class="slide-bgimg" style="heigh:5px; width:20px; background-image:url(<?php echo base_url("assets/barang/".$u->foto_barang4);?>)">
                                <img src="<?php echo base_url("assets/barang/".$u->foto_barang4);?>" class="entity-img" />
                              </figure>
                            </div>
                            <div class="swiper-slide">
                              <figure class="slide-bgimg" style="heigh:5px; width:20px; background-image:url(<?php echo base_url("assets/barang/".$u->foto_barang5);?>)">
                                <img src="<?php echo base_url("assets/barang/".$u->foto_barang5);?>" class="entity-img" />
                              </figure>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  
                
                </div>
            </div>
        </div>
        <div class="row py-2 ">
            <div class="col-md-6 ">
                <div class=" border px-2">
                    <h5 class="font-weight-bold m-0 text-dark">Deskripsi Ruangan</h5>
                    <span><?= $u->deskripsi_barang;?></span>
                </div>
            </div>
            <div class="col-md-6 ">
              <div class="  px-2">
                <h5 class="font-weight-bold m-0 text-dark">Fasilitas</h5>
                <div class="row">
                  <div class="col-md-6">
                    <div class="bg-primary text-white p-2 mb-1">
                      <span>Kapasitas</span><br>
                      <span><?= $u->kapasitas_barang?> m  <sub>2</sub> </span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="bg-primary text-white p-2 mb-1">
                        <span>Usia Barang</span><br>
                        <span><?= $u->usia_barang?></span>
                    </div>
                  </div>
                </div>
               
              </div>
            </div>
        </div>

        <div class="row py-2 ">
            <div class="col-md-12 ">
                <div class=" border px-2">
                    <h5 class="font-weight-bold m-0 text-dark">Penggunaan Barang</h5>
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
                        <?php foreach($penggunaanBarang as $p){ ?>
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