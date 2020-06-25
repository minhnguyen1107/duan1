<?php
require_once "data/db.php";
session_start();    
$sql = "SELECT * FROM room_details LIMIT 0,4";
$stmt = $conn->prepare($sql);
$stmt->execute();
$details = $stmt->fetchAll(PDO::FETCH_CLASS);

$sql7 = "SELECT * FROM room_details";
$stmt = $conn->prepare($sql7);
$stmt->execute();
$room_details = $stmt->fetchAll(PDO::FETCH_CLASS);
if(isset($_SESSION["auth"])){
$email=$_SESSION['auth'];
$sqlk = "SELECT * FROM users WHERE email='$email'";
$stmt = $conn->prepare($sqlk);
$stmt->execute();
$name = $stmt->fetchAll(PDO::FETCH_CLASS);
}
$sql1 = "SELECT * FROM services WHERE id=1";
//Chuẩn bị
$stmt = $conn->prepare($sql1);
//Thực thi
$stmt->execute();
//Lấy dữ liệu
$services1 = $stmt->fetchAll(PDO::FETCH_CLASS);

$sql2 = "SELECT * FROM services WHERE id=2";
//Chuẩn bị
$stmt = $conn->prepare($sql2);
//Thực thi
$stmt->execute();
//Lấy dữ liệu
$services2 = $stmt->fetchAll(PDO::FETCH_CLASS);

$sql3 = "SELECT * FROM services WHERE id=3";
//Chuẩn bị
$stmt = $conn->prepare($sql3);
//Thực thi
$stmt->execute();
//Lấy dữ liệu
$services3 = $stmt->fetchAll(PDO::FETCH_CLASS);

$sql4 = "SELECT * FROM services WHERE id=4";
//Chuẩn bị
$stmt = $conn->prepare($sql4);
//Thực thi
$stmt->execute();
//Lấy dữ liệu
$services4 = $stmt->fetchAll(PDO::FETCH_CLASS);

$sql5 = "SELECT * FROM services WHERE id=5";
//Chuẩn bị
$stmt = $conn->prepare($sql5);
//Thực thi
$stmt->execute();
//Lấy dữ liệu
$services5 = $stmt->fetchAll(PDO::FETCH_CLASS);

$sql6 = "SELECT * FROM news ORDER BY id LIMIT 0,3";
$stmt = $conn->prepare($sql6);
$stmt->execute();

$news = $stmt->fetchAll(PDO::FETCH_CLASS);

$sql8 = "SELECT * FROM websetting WHERE id = 1";
$stmt = $conn->prepare($sql8);
$stmt->execute();
$setting = $stmt->fetchAll(PDO::FETCH_CLASS);

// $sql9 = "SELECT * FROM silde WHERE id = 1"; 
// $stmt = $conn->prepare($sql10);
// $stmt->execute();
// $silde1 = $stmt->fetchAll(PDO::FETCH_ASSOC);


// $sql10 = "SELECT * FROM silde WHERE id = 2"; 
// $stmt = $conn->prepare($sql10);
// $stmt->execute();
// $silde2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql11 = "SELECT * FROM image_hotel";
$stmt = $conn->prepare($sql11);
$stmt->execute();
$img_hotel = $stmt->fetchAll(PDO::FETCH_CLASS);

$sql12 = "SELECT * FROM feedback WHERE id = 1";
$stmt = $conn->prepare($sql12);
$stmt->execute();
$feedback = $stmt->fetchAll(PDO::FETCH_CLASS);

$sql13 = "SELECT * FROM feedback WHERE id != 1";
$stmt = $conn->prepare($sql13);
$stmt->execute();
$feedback2 = $stmt->fetchAll(PDO::FETCH_CLASS);


?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from premiumlayers.net/demo/html/hotelbooking/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Mar 2020 15:32:38 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hotel Booking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="img/favicon.ico" sizes="16x16">

    <!-- fonts -->
    <link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,700,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Karla:700,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700' rel='stylesheet' type='text/css'>

    <!-- fontawesome -->
    <link rel="stylesheet" href="css/font-awesome.css" />

    <!-- bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- uikit -->
    <link rel="stylesheet" href="css/uikit.min.css" />

    <!-- animate -->
    <link rel="stylesheet" href="css/animate.css" />
    <link rel="stylesheet" href="css/datepicker.css" />
    <!-- Owl carousel 2 css -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <!-- rev slider -->
    <link rel="stylesheet" href="css/rev-slider/settings.css" />
    <!-- lightslider -->
    <link rel="stylesheet" href="css/lightslider.css">
    <!-- Theme -->
    <link rel="stylesheet" href="css/reset.css">

    <!-- custom css -->
    <link rel="stylesheet" href="style.css" />
    <!-- responsive -->
    <link rel="stylesheet" href="css/responsive.css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!-- This Template Is Fully Coded By Aftab Zaman from swiftconcept.com -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body id="home_one">

    <!-- start preloader -->
    <div id="loader-wrapper">
        <div class="logo"><a href="#"><span>Hotel</span>-Booking</a></div>
        <div id="loader">
        </div>
    </div>
    <!-- end preloader -->

    <!-- start header -->
    <header class="header_area">

        <!-- start main header -->
        <div class="main_header_area">
            <div class="container">
                <!-- start mainmenu & logo -->
                <div class="mainmenu">
                    <div id="nav">
                        <nav class="navbar navbar-default">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <div class="site_logo fix">
                                    <a id="brand" class="clearfix navbar-brand border-right-whitesmoke" href="index.php"><img src="img/site-logo.png" alt="Trips"></a>
                                    <div class="header_login floatleft">
                                        <?php if(!isset($_SESSION['auth'])) :?>
                                        <ul>
                                            <li><a href="login.php">Login</a></li>
                                            <li><a href="register.php">Register</a></li>
                                        </ul>
                                        <?php else :?>
                                            <ul>
                                            <li><a href="#"><?php foreach ($name as $n){echo $n->name;}?></a></li>
                                            <li><a href="logout.php">Logout</a></li>
                                        </ul>
                                    <?php endif ;?>
                                    </div>
                                </div>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php">HOME</a></li>
                                    <li><a href="accomodation.php">Accomodation</a></li>
                                    <li role="presentation" class="dropdown">
                                        <a id="drop2" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                                            GALlERY
                                        </a>
                                        <ul id="menu2" class="dropdown-menu" role="menu">
                                            <?php foreach ($room_details as $r) : ?>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="gallery.php?id=<?= $r->id ?>"><?= $r->name ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                    <li role="presentation" class="dropdown">
                                        <a id="drop2" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                                            Features
                                        </a>
                                        <ul id="menu2" class="dropdown-menu" role="menu">
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="about-us.php">About US</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="booking.php">Booking</a></li>

                                        </ul>
                                    </li>
                                    <li><a href="blog.php">News</a></li>
                                    <li><a href="contact-us.php">Contacts</a></li>
                                </ul>
                                <div class="emergency_number">
                                    <?php foreach ($setting as $s) : ?>
                                        <a href="tel:1234567890"><img src="img/call-icon.png" alt=""><?= $s->phone_number ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <!-- /.navbar-collapse -->
                        </nav>
                    </div>
                </div>
                <!-- end mainmenu and logo -->
            </div>
        </div>
        <!-- end main header -->

    </header>
    <!-- end header -->

    <!-- start main slider -->
    <div class="main_slider_area">
        <div class="main_slider" id="slider_rev">
            <!-- start hotel booking -->
            <div class="hotel_booking_area">
                <div class="container">
                    <div class="hotel_booking">
                        <form id="form1" role="form" method="post" action="postbooking.php" class="">
                            <div class="col-lg-2 col-md2- col-sm-2">
                                <div class="room_book border-right-dark-1">
                                    <h6>Book Your</h6>
                                    <p>Rooms</p>
                                </div>
                            </div>
                            <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                <div class="input-group border-bottom-dark-2">
                                    <input class="date-picker" id="datepicker" name="checkin_date" placeholder="Arrival" type="text" />
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <div class="form-group col-lg-2 col-md-2 col-sm-2">
                                <div class="input-group border-bottom-dark-2">
                                    <input class="date-picker" id="datepicker1"  name="checkout_date" placeholder="Departure" type="text" />
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="row">
                                    <div class="form-group col-lg-3 col-md-3 col-sm-3 icon_arrow">
                                        <div class="input-group border-bottom-dark-2">
                                            <select class="form-control" name="quantity" id="room">
                                                <option selected="selected" disabled="disabled">Rooms</option>
                                                <option value="1">1 Room</option>
                                                <option value="2">2 Room</option>
                                                <option value="3">3 Room</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-3 col-sm-3 icon_arrow">
                                        <div class="input-group border-bottom-dark-2">
                                            <select class="form-control" name="room" id="bed">
                                                <option selected="selected" disabled="disabled">TYPESROOM</option>
                                                <?php foreach ($room_details as $r) :?>
                                                <option value="<?=$r->id?>"><?=$r->name?></option>
                                                <?php endforeach ;?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <input name="btnBook" type="submit" class="btn btn-primary floatright" value="book">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- special offer start -->
                        <div class="special_offer_main">
                            <img src="img/special-offer-main.png" alt="">
                        </div>
                        <!-- end offer start -->
                    </div>
                </div>
            </div>
            <!-- end hotel booking -->
            <div class="fullwidthbanner-container">
                <div class="fullwidth_home_banner">
                    <ul>

                        <li data-transition="random" data-slotamount="7" data-masterspeed="1000">
                            <!-- <img src="<?=$slide1[0]['image']?>">; -->
                            <img src="img/rev-slider/slider-one.jpg" alt="slide">
                            <div class="tp-caption large_black sfr" data-x="105" data-y="197" data-speed="1200" data-start="1100" data-easing="easeInOutBack" style="font-family: 'Playfair Display', serif; font-size: 48px;color: #131e2a; margin-bottom: 23px; text-transform: uppercase; line-height: 40px;">
                                A brand New Hotel
                            </div>
                            <div class="tp-caption large_black sfr" data-x="105" data-y="255" data-speed="1500" data-start="1400" data-easing="easeInOutBack" style="font-family: 'Playfair Display', serif; font-size: 48px;color: #131e2a; margin-bottom: 23px; text-transform: uppercase; line-height: 40px;">
                                Beyond Ordinary
                            </div>
                            <div class="tp-caption lfb carousel-caption-inner" data-x="105" data-y="313" data-speed="1300" data-start="1700" data-easing="easeInOutBack" style="background: #f7c411; padding: 10px; cursor: pointer;">
                                <a href="#" class="" style="background: #f7c411; border-radius: 0; color: #313a45; display: inline-block;  font-size: 18px; padding: 8px 34px; text-transform: uppercase; border: 1px solid #9e811a;">Explore IT</a>
                            </div>
                        </li>

                        <li data-transition="random" data-slotamount="7" data-masterspeed="1000">
                            <!-- <img src="<?=$slide2[0]['image']?>">; -->
                            <img src="img/rev-slider/slider-one.jpg" alt="slide">
                            <div class="tp-caption large_black sfr" data-x="105" data-y="197" data-speed="1200" data-start="1100" data-easing="easeInOutBack" style="font-family: 'Playfair Display', serif; font-size: 48px;color: #131e2a; margin-bottom: 23px; text-transform: uppercase; line-height: 40px;">
                                Book Your Summer Holidays
                            </div>
                            <div class="tp-caption large_black sfr" data-x="105" data-y="255" data-speed="1500" data-start="1400" data-easing="easeInOutBack" style="font-family: 'Playfair Display', serif; font-size: 48px;color: #131e2a; margin-bottom: 23px; text-transform: uppercase; line-height: 40px;">
                                With HOTEL BOOKING Template
                            </div>
                            <div class="tp-caption lfb carousel-caption-inner" data-x="105" data-y="313" data-speed="1300" data-start="1700" data-easing="easeInOutBack" style="background: #f7c411; padding: 10px; cursor: pointer;">
                                <a href="#" class="" style="background: #f7c411; border-radius: 0; color: #313a45; display: inline-block;  font-size: 18px; padding: 8px 34px; text-transform: uppercase; border: 1px solid #9e811a;">Explore IT</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end main slider -->

    <!-- start welcome section -->
    <section class="welcome_area">
        <div class="container">
            <div class="welcome">
                <div class="section_title nice_title content-center">
                    <h3>Welcome To Hotel</h3>
                </div>
                <div class="section_description">
                    <p> Semper ac dolor vitae accumsan. Cras interdum hendrerit lacinia. Phasellus accumsan urna vitae molestie interdum. Nam sed placerat libero, non eleifend dolor. </p>
                </div>
                <div class="row">
                    <?php foreach ($details as $r) : ?>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="single_room_wrapper clearfix">
                                <figure class="uk-overlay uk-overlay-hover">
                                    <div class="room_media">
                                        <a href="room-details.php?id=<?= $r->id ?>"><img src="<?= $r->image ?>" alt=""></a>
                                    </div>
                                    <div class="room_title border-bottom-whitesmoke clearfix">
                                        <div class="left_room_title floatleft">
                                            <h6><?= $r->name ?></h6>
                                            <p><?= $r->prices ?>/ <span>night</span></p>
                                        </div>
                                        <div class="left_room_title floatright">
                                            <a href="room-details.php?id=<?= $r->id ?>" class="btn">DETAILS</a>
                                        </div>
                                    </div>
                                </figure>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <!-- end welcome section -->

    <!-- start Hotel Facilities section -->
    <section class="hotel_facilities_area margin-top-115 margin-bottom-100">
        <div class="container">
            <div class="hotel_facilities">
                <div class="section_title nice_title content-center">
                    <h3>Hotel facilties</h3>
                </div>
                <div class="hotel_facilities_content">
                    <div role="tabpanel">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#restaurant" aria-controls="restaurant" role="tab" data-toggle="tab"><img src="img/home-facilities-icon-eleven.png" alt="restaurant"><span>restaurant</span></a>
                            </li>
                            <li role="presentation">
                                <a href="#sports-club" aria-controls="sports-club" role="tab" data-toggle="tab"><img src="img/home-facilities-icon-seven.png" alt="sports-club"><span>sports-club</span></a>
                            </li>
                            <li role="presentation">
                                <a href="#pick-up" aria-controls="pick-up" role="tab" data-toggle="tab"><img src="img/home-facilities-icon-eight.png" alt="pick-up"><span>pick-up</span></a>
                            </li>
                            <li role="presentation">
                                <a href="#bar" aria-controls="bar" role="tab" data-toggle="tab"><img src="img/home-facilities-icon-nine.png" alt="bar"><span>bar</span></a>
                            </li>
                            <li role="presentation">
                                <a href="#gym" aria-controls="gym" role="tab" data-toggle="tab"><img src="img/home-facilities-icon-ten.png" alt="gym"><span>gym</span></a>
                            </li>
                        </ul>


                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="restaurant">
                                <div class="single-tab-content">
                                    <div class="row">
                                        <div class="co-lg-5 col-md-5 col-sm-6">
                                            <div class="single-tab-image">
                                                <a href="#"><img src="img/hotel-facility-one.jpg" alt=""></a>
                                            </div>
                                        </div>
                                        <?php foreach ($services1 as $s1) : ?>
                                            <div class="co-lg-7 col-md-7 col-sm-6">
                                                <div class="single-tab-details">
                                                    <h6><?= $s1->quality ?></h6>
                                                    <h3><?= $s1->title ?></h3>
                                                    <p>
                                                        <?= $s1->short_desc ?>
                                                    </p>
                                                    <div class="our_services">
                                                        <a href="#" class="margin-right-33"><?= $s1->service_hours ?></a>
                                                        <a href="#"><?= $s1->service_charge ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="sports-club">
                                <div class="single-tab-content">
                                    <div class="row">
                                        <div class="co-lg-5 col-md-5">
                                            <div class="single-tab-image">
                                                <a href="#"><img src="img/hotel-facility-three.jpg" alt=""></a>
                                            </div>
                                        </div>
                                        <?php foreach ($services2 as $s2) : ?>
                                            <div class="co-lg-7 col-md-7">
                                                <div class="single-tab-details">
                                                    <h6><?= $s2->quality ?></h6>
                                                    <h3><?= $s2->title ?></h3>
                                                    <p>
                                                        <?= $s2->short_desc ?>
                                                    </p>
                                                    <div class="our_services">
                                                        <a href="#" class="margin-right-33"><?= $s2->service_hours ?></a>
                                                        <a href="#"><?= $s2->service_charge ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="pick-up">
                                <div class="single-tab-content">
                                    <div class="row">

                                        <div class="co-lg-5 col-md-5">
                                            <div class="single-tab-image">
                                                <a href="#"><img src="img/hotel-facility-one.jpg" alt=""></a>
                                            </div>
                                        </div>

                                        <?php foreach ($services3 as $s3) : ?>
                                            <div class="co-lg-7 col-md-7">
                                                <div class="single-tab-details">
                                                    <h6><?= $s3->quality ?></h6>
                                                    <h3><?= $s3->title ?></h3>
                                                    <p>
                                                        <?= $s3->short_desc ?>
                                                    </p>
                                                    <div class="our_services">
                                                        <a href="#" class="margin-right-33"><?= $s3->service_hours ?></a>
                                                        <a href="#"><?= $s3->service_charge ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="bar">
                                <div class="single-tab-content">
                                    <div class="row">
                                        <div class="co-lg-5 col-md-5">
                                            <div class="single-tab-image">
                                                <a href="#"><img src="img/hotel-facility-three.jpg" alt=""></a>
                                            </div>
                                        </div>
                                        <?php foreach ($services4 as $s4) : ?>
                                            <div class="co-lg-7 col-md-7">
                                                <div class="single-tab-details">
                                                    <h3><?= $s4->title ?></h3>
                                                    <p>
                                                        <?= $s4->short_desc ?>
                                                    </p>
                                                    <div class="our_services">
                                                        <a href="#" class="margin-right-33"><?= $s4->service_hours ?></a>
                                                        <a href="#"><?= $s4->service_charge ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="gym">
                                <div class="single-tab-content">
                                    <div class="row">
                                        <div class="co-lg-5 col-md-5">
                                            <div class="single-tab-image">
                                                <a href="#"><img src="img/hotel-facility-one.jpg" alt=""></a>
                                            </div>
                                        </div>
                                        <?php foreach ($services5 as $s5) : ?>
                                            <div class="co-lg-7 col-md-7">
                                                <div class="single-tab-details">
                                                    <h3><?= $s5->title ?></h3>
                                                    <p>
                                                        <?= $s5->short_desc ?>
                                                    </p>
                                                    <div class="our_services">
                                                        <a href="#" class="margin-right-33"><?= $s5->service_hours ?></a>
                                                        <a href="#"><?= $s5->service_charge ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end Hotel Facilities section -->

    <!-- start About Us section -->
    <section class="about_us_area margin-bottom-128">
        <div class="container">
            <div class="about_us clearfix">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 padding-left-0">
                    <div class="news">
                        <div class="section_title margin-bottom-50">
                            <h5>News</h5>
                        </div>
                        <div class="section_description">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php foreach ($news as $n) : ?>
                                        <div class="single_content clearfix border-bottom-whitesmoke">
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-4 padding-left-0">
                                                <div class="post_media">
                                                    <a href="single-blog.php?id=<?= $n->id ?>"><img src="<?= $n->image ?>" alt=""></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-8 padding-left-0">
                                                <div class="post_title clearfix">
                                                    <a href="single-blog.php?id=<?= $n->id ?>"><?= $n->name ?></a>
                                                </div>
                                                <div class="post_content  margin-bottom-10">
                                                    <p><?= $n->short_desc ?></p>
                                                </div>
                                                <div class="post_content  margin-bottom-35">
                                                    <p><?= $n->created_at ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="showcase">
                        <div class="section_title margin-bottom-50">
                            <h5>Hotel Showcase</h5>
                        </div>
                        <div class="section_description">
                            <div class="clearfix demo" style="">
                                <ul id="vertical" class="gallery list-unstyled">
                                    <?php foreach ($img_hotel as $i) :?>
                                    <li data-thumb="<?=$i->image?>">
                                        <img alt="slider" src="<?=$i->image?>" />
                                    </li>
                                    <?php endforeach ;?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="customer_says">
                        <div class="section_title margin-bottom-50">
                            <h5>Customer Says</h5>
                        </div>
                        <div class="section_description">
                            <div id="customer_says_slider" class="carousel slide" data-ride="carousel" data-pause="none">
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                    <?php foreach ($feedback as $f) :?>
                                    <div class="item active">
                                        <div class="single_says">
                                            <div class="customer_comment">
                                                <p>
                                                <?=$f->messages?>
                                                </p>
                                            </div>
                                            <div class="customer_detail clearfix">
                                                <div class="customer_pic alignleft-20">
                                                    <a href="#"><img src="<?=$f->avatar?>" alt=""></a>
                                                </div>
                                                <div class="customer_identity floatleft">
                                                    <h6><?=$f->name?></h6>
                                                  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach ;?>
                                    <?php foreach ($feedback2 as $f2) :?>
                                    <div class="item">
                                        <div class="single_says">
                                       
                                            <div class="customer_comment">
                                                <p>
                                                <?=$f2->messages?>
                                                </p>
                                            </div>
                                            <div class="customer_detail clearfix">
                                                <div class="customer_pic alignleft-20">
                                                    <a href="#"><img src="<?=$f2->avatar?>" alt=""></a>
                                                </div>
                                                <div class="customer_identity floatleft">
                                                <h6><?=$f2->name?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div>

                                      <?php endforeach ;?>
                                </div>
                                <!-- Controls -->
                                <a class="slider_says left" href="#customer_says_slider" role="button" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="slider_says right" href="#customer_says_slider" role="button" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end About Us section -->

    <!-- start contact us area -->
    <section class="contact_us_area content-left">
        <div class="container">
            <div class="contact_us clearfix">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="call clearfix">
                        <h6>Call Us</h6>
                        <?php foreach ($setting as $s) : ?>
                            <p><?= $s->phone_number ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="email_us clearfix">
                        <h6>Email us</h6>
                        <?php foreach ($setting as $s) : ?>
                            <p><?= $s->email ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="news_letter clearfix">
                        <input type="text" placeholder="Enter ID  for News Letter">
                        <a href="#" class="btn btn-blue">go</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="social_icons clearfix">
                        <ul>
                            <?php foreach ($setting as $s) : ?>
                                <li><a href="<?= $s->facebook_url ?>"><i class="fa fa-facebook"></i></a></li>
                            <?php endforeach; ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end contact us area -->

    <!-- start footer -->
    <footer class="footer_area">
        <div class="container">
            <div class="footer">
                <div class="footer_top padding-top-80 clearfix">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="footer_widget">
                            <div class="footer_logo">
                                <a href="#"><img src="img/footer-logo-one.png" alt=""></a>
                            </div>
                            <p>Lorem ipsum dolor sit amet, conser adipiscing elit. In consectetur tincidunt dolor.</p>
                            <ul>
                                <?php foreach ($setting as $s) : ?>
                                    <li>
                                        <P><i class="fa fa-map-marker"></i><?= $s->address ?></P>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">

                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="footer_widget">
                            <h5>We Are Global</h5>
                            <div class="footer_map">
                                <a href="#"><img src="img/footer-map-two.jpg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="container">
                        <div class="footer_copyright margin-tb-50 content-center">
                            <p>© 2015 <a href="#">Hotelbooking</a>. All rights reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->



    <!-- jquery library -->
    <script src="js/vendor/jquery-1.11.2.min.js"></script>
    <!-- bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- rev slider -->
    <script src="js/rev-slider/rs-plugin/jquery.themepunch.plugins.min.js"></script>
    <script src="js/rev-slider/rs-plugin/jquery.themepunch.revolution.js"></script>
    <script src="js/rev-slider/rs.home.js"></script>
    <!-- uikit -->
    <script src="js/uikit.min.js"></script>
    <!-- easing -->
    <script src="js/jquery.easing.1.3.min.js"></script>
    <script src="js/datepicker.js"></script>
    <!-- scroll up -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- owlcarousel -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- lightslider -->
    <script src="js/lightslider.js"></script>

    <!-- wow Animation -->
    <script src="js/wow.min.js"></script>
    <!--Activating WOW Animation only for modern browser-->
    <!--[if !IE]><!-->
    <script type="text/javascript">
        new WOW().init();
    </script>
    <!--<![endif]-->

    <!--Oh Yes, IE 9+ Supports animation, lets activate for IE 9+-->
    <!--[if gte IE 9]>
            <script type="text/javascript">new WOW().init();</script>
        <![endif]-->

    <!--Opacity & Other IE fix for older browser-->
    <!--[if lte IE 8]>
            <script type="text/javascript" src="js/ie-opacity-polyfill.js"></script>
        <![endif]-->



    <!-- my js -->
    <script src="js/main.js"></script>

</body>

<!-- Mirrored from premiumlayers.net/demo/html/hotelbooking/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Mar 2020 15:33:03 GMT -->

</html>