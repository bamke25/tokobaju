<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shopeall</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<?php include 'navbar.php'; ?>
    <div class="katalogtitle">
        <h1>SHOPE ALL</h1>
    </div>
    <div class="katalog">
    <?php for ($i = 0; $i < 20; $i++){ ?>
            <ul>
                <li><img src="assets/img/sholat yuuk.jpg" alt=""></li>
                <li><h4>yuk sholat shirts</h4></li>
                <li><h4>30$</h4></li>
                <li><a class="viewoption" href="#sideinfo">View option</a></li>
            </ul>
    <?php } ?>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>