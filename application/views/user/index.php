<div class="jumbotron"></div>

    <div class="katalog">
    <?php
    $id=0;
    foreach ($produk as $val) {    # code...} {?>
            <input type="hidden" id="ket<?= $id ?>" value="<?= $val['keterangan'];?>" />
            <ul>
                <?php $img = $val['gambar'];  ?>
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
<script type="text/javascript">
    $(function(){
      // Selector Tag
      var id,keterangan,imageproduk, namaproduk, hargaproduk;
      var img_card, judul_card, harga_card, deskripsi_card
      $('.btnfo').click(function(){
        id = $(this).children().html();
        keterangan = $('#ket'+id).val();
        imageproduk = $('#imgprod'+id).attr("src");
        namaproduk = $('#namaprod'+id).text();
        hargaproduk = $('#hargapro'+id).text();
        $("#img_card").attr("src", imageproduk);
        $("#judul_card").text(namaproduk);
        $("#harga_card").text(hargaproduk);
        $("#deskripsi_card").text(keterangan);



        
      });
      
    });
</script>
    