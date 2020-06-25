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
$sql = "SELECT * FROM news";
$stmt = $conn->prepare($sql);
$stmt->execute();

$news = $stmt->fetchAll(PDO::FETCH_CLASS);

$sql2 = "SELECT * FROM room_details";
$stmt = $conn->prepare($sql2);
$stmt->execute();
$room_details = $stmt->fetchAll(PDO::FETCH_CLASS);

$sql3 = "SELECT * FROM websetting WHERE id = 1";
$stmt = $conn->prepare($sql3);
$stmt->execute();
$setting = $stmt->fetchAll(PDO::FETCH_CLASS);
?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from premiumlayers.net/demo/html/hotelbooking/blog.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Mar 2020 15:33:56 GMT -->

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

<body id="blog_page">


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
                                    </ul>

                                     <?php endif ;?>
                            </div>
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

    <!-- start breadcrumb -->
    <section class="breadcrumb_main_area margin-bottom-80">
        <div class="container-fluid">
            <div class="row">
                <div class="breadcrumb_main nice_title">
                    <h2>News</h2>
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

    <section class="blog_area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="clearfix blog_inner" data-uk-grid>
                            <?php foreach ($news as $n) : ?>
                                <div class="margin-bottom-30 col-md-4 col-sm-6 col-xs-12">
                                    <div class="single_blog_style1">
                                        <div class="style_blog_img_box">
                                            <img src="img/blog-pic1.jpg" alt="img" />
                                            <a class="style_b_link" href="#"><i class="fa fa-link"></i></a>
                                        </div>
                                        <div class="at_love"><i class="fa fa-heart"></i></div>
                                        <div class="blog_text_box">
                                            <h5><?= $n->name ?></h5>
                                            <ul class="clearfix">
                                                <li><a href="#">By Admin |</a></li>
                                                <li><a href="#"><?= $n->created_at ?></a></li>
                                            </ul>
                                            <p><?= $n->short_desc ?></p>
                                            <a href="single-blog.php?id=<?= $n->id ?>">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                       
                    </div>
                </div>
            </div>
        </div>
    </section>

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
    <script src="js/grid.js"></script>
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

<!-- Mirrored from premiumlayers.net/demo/html/hotelbooking/blog.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Mar 2020 15:33:59 GMT -->

</html>