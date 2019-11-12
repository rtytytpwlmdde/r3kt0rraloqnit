
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
                <h3 class="text-muted">Ruangan</h3>
            </div>
            <div class="col-6 col-md-4">
                <div class="d-flex flex-row-reverse bd-highlight">
                    <?php if($this->session->userdata('status') == 'admin'){ ?>
                    <a class="btn btn-sm btn-primary mb-2"  href="<?php  echo base_url('SaranaPrasarana/updateRuangan/'.$u->id_ruangan); ?>" role="button">Edit Ruangan</a>
                        <?php }?>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white  shadow p-2" >
        <div class="row py-2 ">
            <div class="col-md-4">
            <div class="w">
                <div class="ts">
                    <input type="radio" id="c1" name="ts" checked="checked"/>
                    <label class="t" for="c1"><img src="<?php echo base_url("assets/ruangan/".$u->foto_ruangan1);?>"/></label>
                    <input type="radio" id="c2" name="ts"/>
                    <label class="t" for="c2"><img src="<?php echo base_url("assets/ruangan/".$u->foto_ruangan2);?>"/></label>
                    <input type="radio" id="c3" name="ts"/>
                    <label class="t" for="c3"><img src="<?php echo base_url("assets/ruangan/".$u->foto_ruangan3);?>"/></label>
                    <input type="radio" id="c4" name="ts"/>
                    <label class="t" for="c4"><img src="<?php echo base_url("assets/ruangan/".$u->foto_ruangan4);?>"/></label>
                    <input type="radio" id="c5" name="ts"/>
                    <label class="t" for="c5"><img src="<?php echo base_url("assets/ruangan/".$u->foto_ruangan5);?>"/></label>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="border p-2">
                    <h3 class=""><?= $u->nama_ruangan;?></h3>
                    <h6><i class="fa fa-map-marker" aria-hidden="true"></i> <?= $u->alamat_ruangan;?></h6>
                </div>
                <div class="border mt-2 p-2">
                    <h5 class=""> Fasilitas</h5>
                    <span>Kapasitas : <?= $u->kapasitas;?> orang</span><br>
                </div>
                
                <div class="border mt-2 p-2">
                    <h5 class=""> Map</h5>
                        <iframe src="<?=$u->link_maps?>" width="100%" height="300px" frameborder="0" style="border:0"></iframe>
                    </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<script>
const els = document.querySelectorAll("[type='radio']");
for (const el of els)
  el.addEventListener("input", e => reorder(e.target, els));
reorder(els[0], els);

function reorder(targetEl, els) {
  const nItems = els.length;
  let processedUncheck = 0;
  for (const el of els) {
    const containerEl = el.nextElementSibling;
    if (el === targetEl) {//checked radio
      containerEl.style.setProperty("--w", "100%");
      containerEl.style.setProperty("--l", "0");
    }
    else {//unchecked radios
      containerEl.style.setProperty("--w", `${100/(nItems-1)}%`);
      containerEl.style.setProperty("--l", `${processedUncheck * 100/(nItems-1)}%`);
      processedUncheck += 1;
    }
  }
}
</script>