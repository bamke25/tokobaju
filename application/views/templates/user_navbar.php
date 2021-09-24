    <nav>
        <h1><a href="index.php">Mascitra.Com</a></h1>
        <input type="checkbox" name="btnnav" id="btnnav">
        <label for="btnnav" class="navbutton">
            <img src="<?= base_url('assets/img/menu.png')?>" alt="">
            
            <img src="<?= base_url('assets/img/close.png') ?>" alt="">
        </label>
        <ul>
            <li><a href="index.php">home</a></li>
            <li><a href="shopeall.php">shope all</a></li>
            <li><a href="#history">history</a></li>
            <li><a href="#serach"><img src="<?= base_url('assets/img/search.png') ?>" alt=""></a></li>

            <li><a href="#login"><img src="<?=base_url('assets/img/user.png')?>" alt="">
                <span><?php echo $this->session->userdata('name');?></span>
            </a></li>
            <li><a href="<?php echo base_url('User/logout/')?>"><span>Logout</span></a>
            </li>

            <li><a href="#account"><img src="<?= base_url('assets/img/user.png') ?>" alt=""></a></li>
            <?php if ($jumlah > 0) { ?>
            <li><a href="#cart"><img style="color: red" src="<?= base_url('assets/img/store.png') ?>" alt=""><span style="color: red"><?=$jumlah;?></span></a></li>
            <?php }else{ ?>
            <li><a href="#cart"><img src="<?= base_url('assets/img/store.png') ?>" alt=""><span>0</span></a></li>
            <?php } ?>
            
        </ul>
    </nav>