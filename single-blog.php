<?php
require_once "data/db.php";
session_start();
if(isset($_SESSION["auth"])){
    $email=$_SESSION['auth'];
    $sqlk = "SELECT * FROM users WHERE email='$email'";
    $stmt = $conn->prepare($sqlk);
    $stmt->execute();
    $name = $stmt->fetchAll(PDO::FETCH_CLASS);
    };
$id = isset($_GET['id']) ?  $_GET['id'] : '';
$sql = "SELECT * FROM news WHERE id=:id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$news = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM news WHERE id <> $id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$news2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT * FROM room_details";
$stmt = $conn->prepare($sql2);
$stmt->execute();
$room_details = $stmt->fetchAll(PDO::FETCH_CLASS);

$sql3 = "SELECT * FROM websetting WHERE id = 1";
$stmt = $conn->prepare($sql3);
$stmt->execute();
$setting = $stmt->fetchAll(PDO::FETCH_CLASS);

if(isset($_POST['btnSubmit'])) {
    $contents = $_POST['contents'];
    $id_news = $id;
    $id_users = $_SESSION['id'];
    $sql = "INSERT INTO comment SET contents=:contents, id_news =:id_news, id_users=:id_users";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":contents", $contents);
    $stmt->bindParam(":id_news", $id_news);
    $stmt->bindParam(":id_users", $id_users);
    $stmt->execute();
    header('Location:single-blog.php?id='.$id_news);
}


$sql4 = "SELECT news.id, comment.contents, comment.created_at, users.name, users.avatar FROM comment INNER JOIN users ON comment.id_users = users.id INNER JOIN news ON news.id = comment.id_news WHERE id_news = $id";
$stmt = $conn->prepare($sql4);
$stmt->execute();
$comments = $stmt->fetchAll(PDO::FETCH_CLASS);

?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from premiumlayers.net/demo/html/hotelbooking/single-blog.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Mar 2020 15:33:59 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> News detail</title>
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

<body id="single_blog_page">


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
                                <ul class="nav navbar-nav navbar-right">
                                <?php if(!isset($_SESSION['auth'])) :?>
                                    <li class="">
                                        <a class="border-right-dark-4" href="#">login</a></li>
                                    <li role="presentation" class="dropdown">
                                        <a id="drop1" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                                            register
                                            <span class="caret"></span>
                                        </a>

                                    </li>
                                    <?php else :?>
                                    	  <li class="">
                                        <a class="border-right-dark-4" href=""><?php 
                                            foreach ($name as $n){
                                                echo $n->name;
                                            }?></a></li>
                                    <li role="presentation" class="dropdown">
                                        <a id="drop1" href="logout.php" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                                            Logout
                                            <span class="caret"></span>
                                        </a>

                                    </li>

                                     <?php endif ;?>
                                </ul>
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
                    <h2>News Detail</h2>
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

    <!-- start single blog section -->
    <section class="single_blog_area margin-bottom-150">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="single_blog_post_area">
                        <div class="sing_blog_photo">
                            <img src="<?= $news[0]['image'] ?>" alt="">
                            <i class="fa fa-heart top"></i>
                            <i class="fa fa-picture-o bottom"></i>
                        </div>
                        <div class="sing_blog_content">
                            <div class="sing_blog_heading">
                                <h2><?= $news[0]['name'] ?></h2>
                                <ul>
                                    <li>By Admin</li>
                                    <li><?= $news[0]['created_at'] ?></li>
                                </ul>
                            </div>
                            <div class="sing_blog_post_cont">
                                <p><?= $news[0]['contents'] ?></p>
                            </div>
                            <div class="related_post">
                                <h2>Related Post</h2>
                                <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                        <div class="sing_related_post">
                                            <h3><a href="#">Heading title here</a></h3>
                                            <p>In <span>"loremipsum"</span></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="sing_related_post">
                                            <h3><a href="#">Heading title here</a></h3>
                                            <p>In <span>"loremipsum"</span></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="sing_related_post">
                                            <h3><a href="#">Heading title here</a></h3>
                                            <p>In <span>"loremipsum"</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sing_blog_post_nav">
                                <a href="#" class="">Previous post</a>
                                <a href="#" class="floatright">Next post</a>
                            </div>
                            <div class="single_post_author_area">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <div class="author_photo">
                                            <img alt="" src="img/author_photo.jpg">
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <div class="author_details">
                                            <h2>John Deo</h2>
                                            <h3>Author</h3>
                                            <p>Sed et sapien elit. Aliquam laoreet odio nunc, id imperdiet mauris auctor in. Ut eu norem tristique nibh, sit amet euismod felis. Quisq ue aliquet nulla justomauris auctor in. </p>
                                            <ul>
                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                <li><a href="#"><i class="fa fa-tumblr"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_post_comment_area">

                                <ul class="coments">
                                    <?php foreach ($comments as $c) : ?>
                                        <li>
                                            <div class="col-md-2 padding-0 col-sm-2">
                                                <div class="com_author_photo">
                                                    <img src="img/<?=$c->avatar ?>" alt="">
                                                </div>
                                            </div>
                                            <div class="col-md-10 col-sm-10">
                                                <div class="comment_details">
                                                    <h3><?= $c->name ?><span class="comm_time"><?= $c->created_at ?></span></h3>
                                                    <p><?= $c->contents ?></p>

                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>


                                </ul>
                                <div class="comment_form">
                                    <?php  if (isset($_SESSION['auth'])) :?>
                                    <h2>Leave A Reply</h2>
                                    <form action="" method="POST">
                                        <div class="row">

                                            <div class="col-md-12">
                                            <input type="hidden" name="id_users">
                                            <input type="hidden" name="id_news">
                                                <label>Message</label>
                                                <textarea name="contents" cols="30" rows="10"></textarea>
                                                <input type="submit" name="btnSubmit" value="Reply">
                                            </div>
                                        </div>
                                    </form>
                                    <?php endif ;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <aside>
                        <div class="row">
                            <div class="right_sidebar_area">


                                <div class="col-lg-12 col-md-12 col-sm-6">
                                    <div class="blog_recent_post margin-bottom-30">
                                        <div class="single_recent_post">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-xs-4">
                                                    <div class="recent_thumb">
                                                        <img src="<?= $news2[0]['image'] ?>" alt="img">
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-xs-8">
                                                    <div class="recent_post_details">
                                                        <h6>L<?= $news2[0]['short_desc'] ?></h6>
                                                        <p><?= $news2[0]['created_at'] ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- end single blog section -->


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
                        <div class="row">

                        </div>
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

<!-- Mirrored from premiumlayers.net/demo/html/hotelbooking/single-blog.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Mar 2020 15:34:03 GMT -->

</html>