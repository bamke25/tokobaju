    <nav>
        <h1><a href="#">Mascitra.Merch</a></h1>
        <input type="checkbox" name="btnnav" id="btnnav">
        <label for="btnnav" class="navbutton">
            <img src="assets/img/menu.png" alt="">
            <img src="assets/img/close.png" alt="">
        </label>

        <ul>
            <li><a href="index.php">home</a></li>
            <li><a href="shopeall.php">shope all</a></li>
            <li><a href="#history">history</a></li>
            <li><a href="#serach"><img src="assets/img/search.png" alt=""></a></li>
            <!-- <li><a href="#login"><img src="assets/img/user.png" alt=""></a></li> -->
            <li><a href="account.php"><img src="assets/img/user.png" alt=""></a></li>
            <li><a href="#cart"><img src="assets/img/store.png" alt=""><span>0</span></a></li>
        </ul>
    </nav>
<?php include 'cart.php'; ?>
<?php include 'login.php'; ?>
<?php include 'register.php'; ?>
<?php include 'serach.php'; ?>
<?php include 'checkout.php'; ?>
<?php include 'sidebarviewoption.php'; ?>
<?php include 'history.php'; ?>
<?php include 'tujuan.php'; ?>