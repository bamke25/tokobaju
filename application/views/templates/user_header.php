<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="<?= base_url('assets/style.css'); ?>">
</head>
<body>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
<script src="<?= base_url('assets/js/jquery.js'); ?>"></script>

<!-- Bagian Account -->

<!-- Bagian Cart -->

<div id="cart">
        <div class="navinfo" id="navinfo">
            <div class="info">
                cart
            </div>
            <div class="close">
                <a href="#"></a>
            </div>
        </div>
        <form action="<?=base_url('user/editKeranjang')?>" class="contentinfo" method="POST">
            <div class="shoppingcart">
                <table>
                    <tr>
                        <th></th>
                        <th>Harga</th>
                        <th>quantity</th>
                        <th>total</th>
                    </tr>

                    <?php
                    $id=0;
                     foreach ($keranjang as $value) {
                     $id_cart =  $value['id'];
                        ?>
                    <tr>
                        <input type="hidden" id="id_produk<?=$id?>">
                        <input type="hidden" name="id[]" value="<?=$id_cart?>">
                        <input type="hidden" name="harga[]" value="<?=$value['harga']?>">

                        <td><img src="<?= base_url($value['gambar'])?>" alt="#"> <a href="<?= base_url('user/delete_cart/'.$id_cart)?>">remove</a>
                        </td>
                        <td id="harga">Rp <?= number_format($value['harga'],2,',','.');?></td>
                        <td><input id="qty<?=$id?>" name="qty[]" type="number" value="<?= $value['quantity'] ?>"/></td>
                        <!-- <td>
                            <select name="" id="">
                                <option value="">M</option>
                                <option value="">L</options>
                                <option value="">XL</option>
                            </select>
                        </td> -->
                        <td>Rp <?= number_format($value['total'],2,',','.');?></td>
                    </tr>
                    <?php
                     } ?>

                </table>
                <div class="keterangan">
                        <select name="kurir" id="kurir">
                            <option value="">Pilih Kurir</option>
                            <option value="">JNE</option>
                            <option value="">JNT</option>
                        </select></td>
                </div>
                <div class="actionbutton">
                    <input id="ganti" class="button" type="submit" value="Update">
                    <input id="ganti" class="button" type="submit" value="Next">
                </div>
            </div>
        </form>
        </div>


<!-- Bagian Login  -->

<div id="login">
        <div class="navinfo" id="navinfo">
            <div class="info">
                login
            </div>
            <div class="close">
                <a href="#"></a>
            </div>
        </div>
        <form method="POST" action="<?= base_url('user/login/');?>" class="contentinfo">
            <div class="boxform">
                <div class="form">
                    <label for="Email">Email</label>
                    <input type="text" name="email" id="email" placeholder="example@gmail.com" required>
                </div>
                <div class="form">
                    <label for="password">password</label>
                    <input type="password" name="password" id="password" placeholder="password" required>
                </div>
                <div class="form">
                    <button type="submit">Login</button>
                </div>
                <div class="form">
                    <a class="register" href="#register">register</a>
                </div>
            </div>
        </form>
</div>

<!-- Bagian register -->

<div id="register">
        <div class="navinfo" id="navinfo">
            <div class="info">
                register
            </div>
            <div class="close">
                <a href="#"></a>
            </div>
        </div>
        <form action="<?php echo base_url('user/register/')?>" method="POST" class="contentinfo">
            <div class="boxform">
                <div class="form">
                    <label for="name">name</label>
                    <input type="text" name="name" id="name" placeholder="enter your name" required>
                </div>
                <div class="form">
                    <label for="regusername">EMAIL</label>
                    <input type="text" name="regemail" id="regusername" placeholder="example@gmail.com" required>
                </div>
                <div class="form">
                    <label for="regpassword">password</label>
                    <input type="password" name="regpassword" id="regpassword" placeholder="type your password" required>
                </div>
                <div class="form">
                    <button type="submit">save</button>
                </div>
            </div>
        </form>
</div>

<!-- Bagian Search -->

<div id="serach">
        <div class="navinfo" id="navinfo">
            <div class="info">
                search
            </div>
            <div class="close">
                <a href="#"></a>
            </div>
        </div>
        <form action="<?= base_url().'user/search_katalog'?>" class="contentinfo" method="GET">
            <div class="boxform">
                <div class="form">

                    <a href="#search"><img src="<?= base_url('assets/img/search.png')?>" alt=""></a>
                    <input type="text" name="search" id="search" placeholder="search">
                </div>
            </div>
        </form>
</div>

<!-- Bagian Side view option  -->

       <div id="sideinfo">
        <div class="navinfo" id="navinfo">
            <div class="info">
                view
            </div>
            <div class="close">
                <a href="#"></a>
            </div>
        </div>
        <form class="contentinfo" method="post" action="<?=base_url("user/cart")?>">
            <input name="id_produk" type="hidden" value="" id="id_produk">
            <ul>
                <li><img id="img_card" src="" alt=""></li>
                <li><h4 id="judul_card"></h4></li>
                <li><h4 id="harga_card"></h4></li>
                <li><h5 id="deskripsi_card">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tempore, adipisci! Ut corporis autem quisquam suscipit delectus cumque, consequatur maxime nobis, sit deleniti atque quibusdam voluptas omnis excepturi rerum numquam corrupti tenetur nam beatae quia minima odio iusto! Officiis, incidunt nihil voluptatum soluta corrupti, enim qui dolorem quas quidem, culpa quasi!</h5></li>
                <li>
                    <div class="number">
                        <span>quantity</span>
                        <input name="quantity" type="number" value="1"/>
                    </div>
                </li>
                <!-- <li>
                    <div class="size">
                        <span>Size</span>
                        <select name="" id="">
                            <option value="">M</option>
                            <option value="">L</option>
                            <option value="">XL</option>
                        </select>
                    </div>
                </li> -->
                <li>
                    <input type="submit" class="btnsumbit" value="Add Cart">
                </li>
            </ul>
        </form>
        </div>

<!-- Shoppe All -->



<div id="history">
        <div class="navinfo" id="navinfo">
            <div class="info">
                history
            </div>
            <div class="close">
                <a href="#"></a>
            </div>
        </div>
        <form action="" class="contentinfo">
            <div class="shoppingcart">
                <table>
                    <tr>
                        <th>tanggal</th>
                        <th>proses</th>
                        <th>status</th>
                        <th>no resi</th>
                        <th>aksi</th>
                    </tr>

                    <?php for ($i = 0; $i < 1; $i++){ ?>
                    <tr>
                        <td>9/19/2021</td>
                        <td>sudah di proses</td>
                        <td>lunas</td>
                        <td>728829299282</td>
                        <td><a class="button" style="color: white;" href="#checkout">checkout</a></td>
                    </tr>
                    <?php } ?>

                </table>
            </div>
        </form>
        </div>

<?php if($this->session->userdata('name') != null) { ?>
<div id="tujuan">
        <div class="navinfo" id="navinfo">
            
            <div class="info">
                alamat tujuan
            </div>
            <div class="close">
                <a href="#"></a>
            </div>
        </div>
        <form action="<?=base_url('user/update_alamat')?>" method="post" class="contentinfo">
            <div class="boxform">
              <?php if ($this->session->flashdata('notifal') != null ):?>
                    <div class="form notif">
                        <div class="notif" style="background: #9b59b6;text-align: center;padding: 10px 15px;font-weight: bolder;color: white">
                            BERHASIL
                        </div>
                    </div>
                    <script>setTimeout(function(){ $('.notif').hide('slideup') }, 2000);</script>
                    <?php
                    $this->session->unset_userdata('notifal');
                    endif
                    ?>
                    <div class="form">
                        <label for="name">nama</label>
                        <input type="text"  value="<?= $name;?>" name="nama" id="name" placeholder="masukan nama anda" readonly>
                    </div>
                    <div class="form">
                        <label for="tlp">No telepon</label>
                        <input type="text" id="no_tlp" value="<?php if($alamat['no_hp'] == null){echo "";}else{echo $alamat['no_hp'];}?>" name="no_tlp" placeholder="masukan no telepon">
                    </div>
                    <div class="form">
                      <label for="lahir">Tempat Lahir</label>
                        <input type="text"  id="lahir" name="lahir" value="<?php if($alamat['tempat_lahir'] == null){echo "";}else{echo $alamat['tempat_lahir'];}?>" placeholder="masukan tempat lahir">
                    </div>
                    <div class="form">
                        <label for="provinsi">provinsi</label> <br>
                        <select name="provinsi" id="provinsi">
                            <option value="">Silahkan dipilih</option>
                            <?php 
                                foreach ($provinsi as $val) {
                                    if ($alamat['kota_id'] == null) {
                                       echo "<option value='".$val['provinsi_id'].".".$val['nama_provinsi']."'>".$val['nama_provinsi']."</option>";
                                    } else {
                                        if ($dataalamat['nama_provinsi'] == $val['nama_provinsi']) {
                                           echo "<option selected value='".$val['provinsi_id'].".".$val['nama_provinsi']."'>".$val['nama_provinsi']."</option>";
                                        } else {
                                            echo "<option value='".$val['provinsi_id'].".".$val['nama_provinsi']."'>".$val['nama_provinsi']."</option>";
                                        }


                                    }


                                }
                             ?>
                        </select>
                    </div>
                    <div class="form">
                        <label for="kota">Kota</label><br>
                        <select name="kota" id="kota">
                                    <?php if ($alamat['kota_id'] == null) {
                                echo "<option value=''>Kota Atau Kabupaten</option>";
                            }else{
                                echo "<option  value='".$dataalamat['kota_id']."'>".$dataalamat['nama_kota']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form">
                        <label for="alamat">alamat</label>
<<<<<<< Updated upstream
                        <textarea name="alamat" id="alamat" cols="38" rows="5"><?php if($alamat['alamat_lengkap'] == null){echo "";}else{echo $alamat['alamat_lengkap'];}?></textarea>
=======
                        <textarea name="alamat" id="alamat" cols="38" rows="5"></textarea>
                    </div>
                    <div class="form notif">
                        <div class="notif" style="background: #9b59b6;text-align: center;padding: 10px 15px;font-weight: bolder;color: white">
                            BERHASIL 
                        </div>
>>>>>>> Stashed changes
                    </div>

                    <div class="form">
                        <button id="save" type="submit">save</button>
                        <a class="button" href="#history">kirim</a>
                    </div>
                    
            </div>
        </form>
</div>
<?php } ?>
<div id="checkout">
        <div class="navinfo" id="navinfo">
            <div class="info">
                checkout
            </div>
            <div class="close">
                <a href="#"></a>
            </div>
        </div>
        <form action="" class="contentinfo">
            <div class="shoppingcart">
                <table>
                    <tr>
                        <th></th>
                        <th>price</th>
                        <th>quantity</th>
                        <th>size</th>
                        <th>total</th>
                    </tr>

                    <?php for ($i = 0; $i < 2; $i++){ ?>
                    <tr>
                        <td><img src="assets/img/sholat yuuk.jpg" alt="#">
                        </td>
                        <td>30$</td>
                        <td>3</td>
                        <td>L</td>
                        <td>30$</td>
                    </tr>
                    <?php } ?>

                </table>
                <div class="keterangan">
                    <h4>Total: <span>70$</span></h4>
                    <h4>
                        Send To: <br>
                        BNI: 01910191018 <br> Mandiri: 0101009101101 <br> BCA:0109201910
                    </h4>
                </div>
                <div class="actionbutton">
                    <input style="display: none;" class="button" type="file" name="file" id="file" class="inputfile" />
                    <label style="padding: 0 10px 0 10px;" class="button" for="file">upload bukti transfer</label>
                    <button>save</button>
                </div>              
            </div>
        </form>
        </div>