<?php 
    session_start();
    require_once 'classes/RetrieveSQL.php';
    require_once 'classes/UpdateSQL.php';
    date_default_timezone_set("Asia/Tokyo");
    $retrieve = new RetrieveSQLStatements();
    $update = new UpdateSQLStatements();
    $date = date('Y-m-d');
    $update->deactivateCouponByExpiration($date);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Hotel Template">
    <meta name="keywords" content="Hotel, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AROCK</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="container-fluid">
            <div class="inner-header">
                <div class="logo">
                    <a href="./index.php"><img src="img/logo.png" alt=""></a>
                </div>
                <div class="nav-right">
                    <a href="login.php" class="primary-btn">Make a Reservation</a>
                </div>
                <nav class="main-menu mobile-menu">
                    <ul>
                        <li class="active"><a href="./index.php">Home</a></li>
                        <li><a href="./about-us.php">About</a></li>
                        <li><a href="services.php">Services</a><!--change list of service-->
                            <ul class="drop-menu">
                            <?php foreach($retrieve->getAllServices() as $row) : ?>
                            <?php if($row['service_status'] == "A") : ?>
                                <li><a href="services.php"><?= $row['service_name']; ?></a></li>
                            <?php endif ; ?>
                            <?php endforeach ; ?>
                                <!-- <li><a href="services.php">Cut</a></li>
                                <li><a href="services.php">Color</a></li>
                                <li><a href="services.php">Perm</a></li>
                                <li><a href="services.php">Rebond</a></li>
                                <li><a href="services.php">Shampoo & Blow</a></li>
                                <li><a href="services.php">Treatment</a></li>
                                <li><a href="services.php">Head Supa</a></li> -->
                            </ul>
                        </li>
                        <li><a href="rooms.php">Staff</a></li><!---change staff page-->
                        <li><a href="./blog.php">News</a></li><!--Blog or news-->
                        <li><a href="#footer">Contact</a></li>
                        <?php if(isset($_SESSION['login_id'])) : ?>
                            <li><a href="logout.php">Log out</a></li>
                        <?php endif ; ?>
                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>
    <!-- Header End -->