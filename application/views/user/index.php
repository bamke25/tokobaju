
<div class="jumbotron"></div>

    <div class="katalog">
    <?php
    $id=0;
    foreach ($produk as $val) {

      # code...} {?>
            <input type="hidden" id="ket<?= $id ?>" value="<?= $val['keterangan'];?>" />
            <input type="hidden" id="id_prod<?= $id ?>" value="<?= $val['id_produk'];?>" >
            <ul>
                <?php $img = "assets/img/produk/".$val['gambar'];  ?>
                <li class="prod"><img id="imgprod<?= $id ?>" src="<?= base_url($img)?>" alt=""></li>
                <li class="prod"><h4 id="namaprod<?= $id ?>"><?= $val['nama_produk'];?></h4></li>
                <li class="pr"><h4 id="hargapro<?= $id ?>">Rp <?= number_format($val['harga'],2,',','.');?></h4></li>
                <li><a class="btnfo" class="viewoption" href="#sideinfo">View option <span style="visibility: hidden"><?= $id ?></span></a></li>
            </ul>
    <?php
    $id++;
    } ?>
    </div>


    <div class="shope">
        <a class="shopenow" href="">shope now</a>
    </div>
