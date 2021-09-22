    <nav>
        <h1><a href="#">Mascitra.Com</a></h1>
        <input type="checkbox" name="btnnav" id="btnnav">
        <label for="btnnav" class="navbutton">
            <img src="<?= base_url('assets/img/menu.png')?>" alt="">
            
            <img src="<?= base_url('assets/img/close.png') ?>" alt="">
        </label>
        <ul>
            <li><a href="<?= base_url('user');?>">home</a></li>
            <li><a href="<?= base_url('user/shopeall');?>">shope all</a></li>
            <li><a href="#history">history</a></li>
            <li><a href="#serach"><img src="<?= base_url('assets/img/search.png') ?>" alt=""></a></li>
            <li><a href="#login"><img src="assets/img/user.png" alt="">
                <span></span>
            </a></li>
            <li><a href="#login"><img src="<?=base_url('assets/img/user.png')?>" alt=""></a></li>

            <li><a href="#account"><img src="<?= base_url('assets/img/user.png') ?>" alt=""></a></li>
            <?php if ($jumlah > 0) { ?>
            <li><a href="#cart"><img style="color: red" src="<?= base_url('assets/img/store.png') ?>" alt=""><span style="color: red"><?=$jumlah;?></span></a></li>
            <?php }else{ ?>
            <li><a href="#cart"><img src="<?= base_url('assets/img/store.png') ?>" alt=""><span>0</span></a></li>
            <?php } ?>
            
        </ul>
    </nav>