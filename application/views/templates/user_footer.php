    <footer>
        <ul class="info">
            <li>more info</li>
            <li><a href="">search</a></li>
            <li><a href="">faq</a></li>
            <li><a href="">returm & exchange</a></li>
            <li><a href="">policy</a></li>
            <li><a href="">contact</a></li>
            <li><a href="">privacy policy</a></li>
        </ul>
        <ul class="info">
            <li>social media</li>
            <li><a href="">facebook</a></li>
            <li><a href="">instagram</a></li>
            <li><a href="">whatsapp</a></li>
            <li><a href="">youtube</a></li>
        </ul>
        <ul class="info">
            <li><img src="<?= base_url('assets/img/mascitra merc.png')?>" alt=""></li>
        </ul>
        <div class="copyright"><a href="">© 2021, Mascitra.Merch</a></div>
    </footer>
<script type="text/javascript">
    $(".notif").show();
    $(document).ready(function(){
      $('.btnfo').click(function(){
        var id,keterangan,imageproduk, namaproduk, hargaproduk,id_produk;
        id = $(this).children().html();
        keterangan = $('#ket'+id).val();
        id_produk = $('#id_prod'+id).val();
        imageproduk = $('#imgprod'+id).attr("src");
        namaproduk = $('#namaprod'+id).text();
        hargaproduk = $('#hargapro'+id).text();
        $("#img_card").attr("src", imageproduk);
        $("#judul_card").text(namaproduk);
        $("#harga_card").text(hargaproduk);
        $("#deskripsi_card").text(keterangan)
        $("#id_produk").val(id_produk);
      });   
      $("#provinsi").change(function(){ // Ketika user mengganti atau memilih data provinsi
                var hasil = $("#provinsi").val().split(".");
                $.ajax({
                    type: "POST", // Method pengiriman data bisa dengan GET atau POST
                    url: "<?php echo base_url("user/get_kota"); ?>", // Isi dengan url/path file php yang dituju
                    data: {id_provinsi : hasil[0]}, // data yang akan dikirim ke file yang dituju
                    dataType: "json",
                    beforeSend: function(e) {
                        if(e && e.overrideMimeType) {
                                e.overrideMimeType("application/json;charset=UTF-8");
                        }
                    },
                    success: function(response){ // Ketika proses pengiriman berhasil
                      // Sembunyikan loadingnya
 
                        // set isi dari combobox kota
                        // lalu munculkan kembali combobox kotanya
                        $("#kota").html(response.get_city).show();
                    },
                    error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                    }
                });
            });

    });
</script>
</body>
</html>