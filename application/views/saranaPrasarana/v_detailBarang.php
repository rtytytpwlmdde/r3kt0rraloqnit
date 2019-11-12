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
                <h3 class="text-muted">Barang</h3>
            </div>
            <div class="col-6 col-md-4">
                <div class="d-flex flex-row-reverse bd-highlight">
                    <?php if($this->session->userdata('status') == 'admin'){ ?>
                    <a class="btn btn-sm btn-primary mb-2"  href="<?php  echo base_url('SaranaPrasarana/updateBarang/'.$u->id_barang); ?>" role="button">Edit Barang</a>
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
                    <label class="t" for="c1"><img src="<?php echo base_url("assets/barang/".$u->foto_barang1);?>"/></label>
                    <input type="radio" id="c2" name="ts"/>
                    <label class="t" for="c2"><img src="<?php echo base_url("assets/barang/".$u->foto_barang2);?>"/></label>
                    <input type="radio" id="c3" name="ts"/>
                    <label class="t" for="c3"><img src="<?php echo base_url("assets/barang/".$u->foto_barang3);?>"/></label>
                    <input type="radio" id="c4" name="ts"/>
                    <label class="t" for="c4"><img src="<?php echo base_url("assets/barang/".$u->foto_barang4);?>"/></label>
                    <input type="radio" id="c5" name="ts"/>
                    <label class="t" for="c5"><img src="<?php echo base_url("assets/barang/".$u->foto_barang5);?>"/></label>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="border p-2">
                    <h3 class=""><?= $u->nama_barang;?></h3>
                </div>
                <div class="border mt-2 p-2">
                    <h5 class=""> Fasilitas</h5>
                    <span><?= $u->deskripsi_barang;?></span><br>
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