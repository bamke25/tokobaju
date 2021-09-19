<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<?php include 'navbar.php'; ?>
    <div class="jumbotron"></div>

    <div class="katalog">
    <?php for ($i = 0; $i < 6; $i++){ ?>
            <ul>
                <li><img src="assets/img/sholat yuuk.jpg" alt=""></li>
                <li><h4>yuk sholat shirts</h4></li>
                <li><h4>30$</h4></li>
                <li><a class="viewoption" href="#sideinfo">View option</a></li>
            </ul>
    <?php } ?>
    </div>

    <div class="shope">    
        <a class="shopenow" href="shopeall.php">SHOPE All</a>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>