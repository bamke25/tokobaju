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
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

<!-- Bagian Account -->

<div id="account">
        <div class="navinfo" id="navinfo">
            <div class="info">
                account
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
                        <td><img src="<?= base_url('assets/img/sholat yuuk.jpg')?>" alt="#">
                        </td>
                        <td>30$</td>
                        <td>3</td>
                        <td>L</td>
                        <td>30$</td>
                    </tr>
                    <?php } ?>

                </table>
                <h4 style="text-align: center;"><span>Subtotal</span>60$</h4>
                <h4>
                    BNI: 01910191018 <br> Mandiri: 0101009101101 <br> BCA:0109201910
                </h4>
                <label for="file">upload bukti transfer</label>
                <input type="file" name="file" id="file" class="inputfile" />
            </div>
        </form>
</div>

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

                        <td><img src="<?= base_url('assets/img/sholat yuuk.jpg')?>" alt="#"> <a href="">remove</a>
                        </td>
                        <td>30$</td>
                        <td><input type="number" value="1"/></td>
                        <td>L</td>
                        <td>30$</td>
                    </tr>
                    <?php } ?>

                </table>
                <h4 style="float: right;margin-right:10px;"><span>Subtotal</span>30$</h4>
                <button>checkout</button>
                <a class="update" href="#">Update</a>
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
                    <input type="text" name="email" id="email" placeholder="example@gmail.com">
                </div>
                <div class="form">
                    <label for="password">password</label>
                    <input type="password" name="password" id="password" placeholder="password">
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
                    <input type="text" name="name" id="name" placeholder="enter your name">
                </div>
                <div class="form">
                    <label for="regusername">Username</label>
                    <input type="text" name="regemail" id="regusername" placeholder="example@gmail.com">
                </div>
                <div class="form">
                    <label for="regpassword">password</label>
                    <input type="password" name="regpassword" id="regpassword" placeholder="password">
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
        <form action="" class="contentinfo">
            <ul>
                <li><img id="img_card" src="" alt=""></li>
                <li><h4 id="judul_card"></h4></li>
                <li><h4 id="harga_card"></h4></li>
                <li><h5 id="deskripsi_card">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tempore, adipisci! Ut corporis autem quisquam suscipit delectus cumque, consequatur maxime nobis, sit deleniti atque quibusdam voluptas omnis excepturi rerum numquam corrupti tenetur nam beatae quia minima odio iusto! Officiis, incidunt nihil voluptatum soluta corrupti, enim qui dolorem quas quidem, culpa quasi!</h5></li>
                <li>
                    <div class="number">
                        <span>quantity</span>
                        <input type="number" value="1"/>
                    </div>
                </li>
                <li>
                    <div class="size">
                        <span>Size</span>
                        <select name="" id="">
                            <option value="">M</option>
                            <option value="">L</option>
                            <option value="">XL</option>
                        </select>
                    </div>
                </li>
                <li>
                    <button class="btnsumbit">Add Cart</button>
                </li>
            </ul>
        </form>
        </div>

<!-- Shoppe All -->

