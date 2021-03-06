<?php
require_once "data/db.php";
session_start();
if(isset($_SESSION["auth"])){
    $email=$_SESSION['auth'];
    $sqlk = "SELECT * FROM users WHERE email='$email'";
    $stmt = $conn->prepare($sqlk);
    $stmt->execute();
    $name = $stmt->fetchAll(PDO::FETCH_CLASS);
    }

$id = isset($_GET['id']) ?  $_GET['id'] : '';

$sql = "SELECT * FROM room_details WHERE id=:id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$room_details = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT * FROM room_details WHERE id <> $id LIMIT 0,4";
$stmt = $conn->prepare($sql2);
$stmt->execute();
$room_sugesst = $stmt->fetchAll(PDO::FETCH_CLASS);

$sql3 = "SELECT room_details.id, gallery.image FROM room_details INNER JOIN gallery ON room_details.id = gallery.id_room WHERE id_room=$id";
$stmt = $conn->prepare($sql3);
$stmt->execute();
$img_room = $stmt->fetchAll(PDO::FETCH_CLASS);

$sql4 = "SELECT * FROM room_details";
$stmt = $conn->prepare($sql4);
$stmt->execute();
$room_details2 = $stmt->fetchAll(PDO::FETCH_CLASS);

$sql5 = "SELECT * FROM websetting WHERE id = 1";
$stmt = $conn->prepare($sql5);
$stmt->execute();
$setting = $stmt->fetchAll(PDO::FETCH_CLASS);

$sql6 = "SELECT * FROM room_services WHERE id IN (1, 2)";
$stmt = $conn->prepare($sql6);
$stmt->execute();
$room_services = $stmt->fetchAll(PDO::FETCH_CLASS);

$sql7 = "SELECT * FROM room_services WHERE id IN (3, 4)";
$stmt = $conn->prepare($sql7);
$stmt->execute();
$room_services2 = $stmt->fetchAll(PDO::FETCH_CLASS);

$sql8 = "SELECT * FROM room_services WHERE id IN (5, 6)";
$stmt = $conn->prepare($sql8);
$stmt->execute();
$room_services3 = $stmt->fetchAll(PDO::FETCH_CLASS);

$sql9 = "SELECT * FROM room_services WHERE id IN (7, 8)";
$stmt = $conn->prepare($sql9);
$stmt->execute();
$room_services4 = $stmt->fetchAll(PDO::FETCH_CLASS);

$sql10 = "SELECT * FROM feedback WHERE id = 1";
$stmt = $conn->prepare($sql10);
$stmt->execute();
$feedback = $stmt->fetchAll(PDO::FETCH_CLASS);

$sql11 = "SELECT * FROM feedback WHERE id != 1";
$stmt = $conn->prepare($sql11);
$stmt->execute();
$feedback2 = $stmt->fetchAll(PDO::FETCH_CLASS);






?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from premiumlayers.net/demo/html/hotelbooking/room-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Mar 2020 15:33:49 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $room_details[0]['name'] ?></title>
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

<body id="room_detail_page">


    <!-- start header -->
    <header class="header_area">

        <!-- start header top -->
        <div class="header_top_area">
            <div class="container">
                <div class="row">
                    <div class="header_top clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="left_header_top">
                                <ul>
                                    <li>
                                        <a href="#"><img src="img/temp-icon.png" alt="temp-icon">London dc, GR 17°C</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 floatright">
                            <div class="right_header_top clearfix floatright">
                            <?php if(!isset($_SESSION['auth'])) :?>
                                        <ul class="nav navbar-nav navbar-right">
                                        <li class="">
                                        <a class="border-right-dark-4" href="login.php">login</a>
                                    </li>
                                    <li class="">
                                        <a class="border-right-dark-4" href="register.php">register</a>
                                    </li>
                                    <ul>
                                    <?php else :?>
                                        <ul class="nav navbar-nav navbar-right">
                                    	<li class="">
                                        <a class="border-right-dark-4" href="login.php"><?php foreach ($name as $n){ echo $n->name;}?></a>
                                    	</li>
                                        <li class="">
                                        <a class="border-right-dark-4" href="logout.php">logout</a>
                                    </li>
                                    <ul>

                                     <?php endif ;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end header top  -->

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
                                    <a id="brand" class="clearfix navbar-brand" href="index.php"><img src="img/site-logo.png" alt="Trips"></a>
                                    <!-- <div class="header_login floatleft">
                                          <ul>
                                              <li><a href="#">Login</a></li>
                                              <li><a href="#">Register</a></li>
                                          </ul>
                                      </div>   -->
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
                                            <?php foreach ($room_details2 as $r) : ?>
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

    <!-- start breadcrumb -->
    <section class="breadcrumb_main_area margin-bottom-80">
        <div class="container-fluid">
            <div class="row">
                <div class="breadcrumb_main nice_title">
                    <h2><?= $room_details[0]['name'] ?></h2>
                    <!-- special offer start -->
                    <div class="special_offer_main">
                        <div class="container">
                            <div class="special_offer_sub">
                                <img src="img/special-offer-yellow-main.png" alt="imf">
                            </div>
                        </div>
                    </div>
                    <!-- end offer start -->
                </div>
            </div>
        </div>
    </section>
    <!-- end breadcrunb -->

    <div class="room_detail_main margin-bottom-55">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9">
                    <div class="deluxe_room_detail">
                        <div class="section_title content-left margin-bottom-5">
                            <h5><?= $room_details[0]['name'] ?> Detail <span class="price floatright"><?= $room_details[0]['prices'] ?></span> <br> <span class="day floatright">/ night</span></h5>
                        </div>
                        <div class="section_content">
                            <p>Checkout the latest deal</p>
                            <div class="showcase">
                                <div class="section_description">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="clearfix" style="">
                                                <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                                                    <!-- <ul id="vertical" class="gallery list-unstyled"> -->
                                                    <?php foreach ($img_room as $img) : ?>

                                                        <li data-thumb="<?= $img->image ?>">
                                                            <img alt="slider" src="<?= $img->image ?>" />
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="facilities_name clearfix margin-bottom-40 margin-top-65">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="section_title margin-bottom-35 padding-bottom-25 border-bottom-whitesmoke">
                                                    <h5>Room Fecilities</h5>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 no-padding-left">
                                                <ul class="single_facilities_name clearul">
                                                    <?php foreach ($room_services as $r) : ?>
                                                        <li>
                                                            <img src="img/home-facilities-icon-one.png" alt="">
                                                            <p><?= $r->name ?></p>
                                                        </li>
                                                    <?php endforeach; ?>

                                                </ul>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                                <ul class="single_facilities_name clearul">
                                                    <?php foreach ($room_services2 as $r) : ?>
                                                        <li>
                                                            <img src="img/home-facilities-icon-one.png" alt="">
                                                            <p><?= $r->name ?></p>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                                <ul class="single_facilities_name clearul">
                                                    <?php foreach ($room_services as $r) : ?>
                                                        <li>
                                                            <img src="img/home-facilities-icon-one.png" alt="">
                                                            <p><?= $r->name ?></p>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                                <ul class="single_facilities_name clearul">
                                                    <?php foreach ($room_services as $r) : ?>
                                                        <li>
                                                            <img src="img/home-facilities-icon-one.png" alt="">
                                                            <p><?= $r->name ?></p>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="room_facilities_des padding-top-50 padding-bottom-50 border-bottom-whitesmoke border-top-whitesmoke">
                                                <p><?= $room_details[0]['short_desc'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- start welcome section -->
                                        <section class="welcome_area">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="welcome">
                                                    <div class="section_title content-left margin-top-50 margin-bottom-30">
                                                        <h5>You may Also like</h5>
                                                    </div>
                                                    <div class="row">
                                                        <?php foreach ($room_sugesst as $r) : ?>
                                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                                <div class="single_room_wrapper clearfix">
                                                                    <div class="room_wrapper">
                                                                        <div class="room_media">
                                                                            <a href="#"><img src="<?= $r->image ?>" alt=""></a>
                                                                        </div>
                                                                        <div class="room_title clearfix">
                                                                            <div class="left_room_title floatleft">
                                                                                <h6><?= $r->name ?></h6>
                                                                                <p><?= $r->prices ?>/ <span>night</span></p>
                                                                            </div>
                                                                            <div class="left_room_title floatright">
                                                                                <a href="room-details.php?id=<?= $r->id ?>" class="btn">DETAILS</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <!-- end welcome section -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <!-- start hotel booking -->
                    <div class="col-lg-12 col-md-12 col-sm-4">
                        <div class="hotel_booking_area clearfix">
                            <div class="hotel_booking">
                                <form id="form1" role="form" method="post" action="postbooking1.php" class="">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="room_book">
                                            <h6>Book Your</h6>
                                            <p>Rooms</p>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12">
                                        <div class="input-group border-bottom-dark-2">
                                            <input class="date-picker" id="datepicker" placeholder="Arrival" name="checkin_date" type="text" />
                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12">
                                        <div class="input-group border-bottom-dark-2">
                                            <input class="date-picker" id="datepicker1" placeholder="Departure" name="checkout_date" type="text" />
                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="row">
                                            <div class="form-group col-lg-6 col-md-6 icon_arrow">
                                                <div class="input-group border-bottom-dark-2">
                                                    <select class="form-control" name="quantity" id="">
                                                        <option selected="selected" disabled="disabled">1 Room</option>
                                                        <option value="1">1 Room</option>
                                                        <option value="2">2 Room</option>
                                                        <option value="3">3 Room</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                           <input type="hidden" name="room" value="<?=$_GET['id']?>">
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <input class="btn btn-warning btn-md floatright" name="btnBook" type="submit" value="Book">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end hotel booking -->
                    <!-- start client says slider -->
                    <div class="col-lg-12 col-md-12 col-sm-4">
                        <div class="customer_says margin-top-65">
                            <div class="section_title margin-bottom-30">
                                <h5>Customer Review</h5>
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
                    <!-- end client says slider -->
                </div>
            </div>
        </div>
    </div>

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
                                <a href="#"><img src="img/footer-logo-one.png" alt="img"></a>
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
                                <a href="#"><img src="img/footer-map-two.jpg" alt="img"></a>
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

<!-- Mirrored from premiumlayers.net/demo/html/hotelbooking/room-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Mar 2020 15:33:53 GMT -->

</html>