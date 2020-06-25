<?php
session_start();
require_once "data/db.php";
if(isset($_SESSION["auth"])){
    $email=$_SESSION['auth'];
    $sqlk = "SELECT * FROM users WHERE email='$email'";
    $stmt = $conn->prepare($sqlk);
    $stmt->execute();
    $name = $stmt->fetchAll(PDO::FETCH_CLASS);
    }
$sql2 = "SELECT * FROM room_details";
$stmt = $conn->prepare($sql2);
$stmt->execute();
$room_details = $stmt->fetchAll(PDO::FETCH_CLASS);
$sql3 = "SELECT * FROM websetting WHERE id = 1";
$stmt = $conn->prepare($sql3);
$stmt->execute();
$setting = $stmt->fetchAll(PDO::FETCH_CLASS);
if(isset($_SESSION['auth'])){
$conga=$_SESSION['auth'];
$sql5= "SELECT  * FROM  users WHERE email='$conga'";
$stmt = $conn->prepare($sql5);
$stmt->execute();
$book2 = $stmt->fetchAll(PDO::FETCH_CLASS);
}
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $soluong=$_GET['soluong'];
    $sql4="SELECT*FROM room_details where id=$id";
    $stmt = $conn->prepare($sql4);
    $stmt->execute();
    $book = $stmt->fetchAll(PDO::FETCH_CLASS);
    $date1 =  $_GET['date1'];
    $date2 = $_GET["date2"];
    $diff = abs(strtotime($date1) - strtotime($date2));
    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
    foreach($book as $b){
        $tong=$days*$b->prices*$soluong;
    }
    $phantram=$tong/10;
    $total= $tong+$phantram;
}
if(isset($_POST['gui'])){

    $name=$_POST['name'];
    $phonenumber=$_POST['phonenumber'];
    $address=$_POST['address'];
    if($name=="" || $address=="" || $phonenumber==""){
        $message="bạn chưa nhập đủ thông tin";
}
else{
$data = "INSERT INTO booking SET name=:name, phonenumber=:phonenumber, address=:address, id_room=:id, checkin_date=:checkin_date,checkout_date=:checkout_date,quantity=:quantity, total=:total";

    $stmt = $conn->prepare($data);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":phonenumber", $phonenumber);
    $stmt->bindParam(":address", $address);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":quantity", $soluong);
    $stmt->bindParam(":checkin_date", $date2);
    $stmt->bindParam(":checkout_date", $date1);
    $stmt->bindParam(":quantity", $soluong);
    $stmt->bindParam(":total", $tong);
    $stmt->execute();
     if($stmt->rowCount()>0){
        $message ="bạn đã book phòng thành công";
           }
          else{
            echo "không thể cập nhật";
           }
}
}

?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from premiumlayers.net/demo/html/hotelbooking/booking.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Mar 2020 15:33:32 GMT -->

<head>
  <?php
  if (isset($message)) {
        echo $message;
    }
  ?>
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
    <!-- <link rel="stylesheet" href="css/uikit.min.css" /> -->
    <!-- <link rel="stylesheet" href="css/uikit.docs.min.css" /> -->

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

  <body id="booking_page">


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
                                        <a class="border-right-dark-4" href="logout.php">logout</a>
                                    </li>
                                    <ul>

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
                    <h2>Booking</h2>
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

    <form method="post" action="">
        <section class="booking_area">
            <div class="container">
                <div class="booking">

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="booking_info">
                            <div class="booking_info_area">
                                <div class="facilities_name clearfix margin-bottom-150 margin-top-70">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-5">
                                            <img src="<?php
                                            foreach($book as $b){
                                                echo $b->image;
                                            }

                                            ?>img/booking-step-one.jpg" alt="">
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-7">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                   <?php
                                                   if(isset($_GET['id'])){
                                                       foreach($book as $b){
                                                        echo $b->name;
                                                    }
                                                }?>
                                                <div class="section_title clearfix margin-bottom-5">
                                                    <h5 class="floatleft"> <span class="price floatright margin-left-15">(   <?php
                                                       if(isset($_GET['id'])){

                                                        foreach($book as $b){
                                                            echo $b->prices;
                                                        }
                                                    }

                                                    ?> <sup class="day">/night</sup>)</span></h5>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="star margin-bottom-20">
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star"></i></a>
                                                    <a href="#"><i class="fa fa-star-o"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 no-padding-left">
                                                <ul class="single_facilities_name clearul">
                                                    <li>
                                                        <img src="img/home-facilities-icon-one.png" alt="">
                                                        <p>Breakfast</p>
                                                    </li>
                                                    <li>
                                                        <img src="img/home-facilities-icon-four.png" alt="">
                                                        <p>Room service</p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                                <ul class="single_facilities_name clearul">
                                                    <li>
                                                        <img src="img/home-facilities-icon-two.png" alt="">
                                                        <p>Air conditioning</p>
                                                    </li>
                                                    <li>
                                                        <img src="img/home-facilities-icon-ten.png" alt="">
                                                        <p>GYM fecility</p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                                <ul class="single_facilities_name clearul">
                                                    <li>
                                                        <img src="img/home-facilities-icon-eight.png" alt="">
                                                        <p>Free Parking</p>
                                                    </li>
                                                    <li>
                                                        <img src="img/home-facilities-icon-five.png" alt="">
                                                        <p>TV LCD</p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                                <ul class="single_facilities_name clearul">
                                                    <li>
                                                        <img src="img/home-facilities-icon-three.png" alt="">
                                                        <p>Pet allowed</p>
                                                    </li>
                                                    <li>
                                                        <img src="img/home-facilities-icon-twelve.png" alt="">
                                                        <p>Wi-fi service</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                              <div class="form-group">
                                <label for="exampleFormControlInput1">Name</label>
                                <?php
                                $logedInUsername = "";
                                if(isset($_SESSION['auth'])){
                                    foreach($book2 as $b){
                                        $logedInUsername = $b->name;
                                    }
                                }
                                ?>
                                <input type="text" value="<?= $logedInUsername ?>" name="name" class="form-control" id="exampleFormControlInput1" placeholder="EnterName">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">PhoneNumber</label>
                                <input type="text" value="<?php
                                if(isset($_SESSION['auth'])){
                                    foreach($book2 as $b){
                                        echo $b->phonenumber;
                                    }
                                }?>"name="phonenumber" class="form-control" id="exampleFormControlInput1" placeholder="Enter Phonnenumber">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Address</label>
                                <input type="text" name="address" value="
                                <?php
                                if(isset($_SESSION['auth'])){
                                    foreach($book2 as $b){
                                        echo $b->address;
                                    }
                                }
                                ?>" class="form-control" id="exampleFormControlInput1" placeholder="Enter Address">
                            </div>
                            <div class="row">
                                <div class="about_booking_room clearfix margin-top-30">
                                    <div class="col-lg-7 col-md-7 col-sm-6">
                                        <div class="booking_room_details">
                                         <?php
                                         if(isset($_GET['id'])){

                                             foreach($book as $b){
                                                 echo $b->short_desc;
                                             }}
                                             ?>
                                         </div>
                                     </div>
                                     <div class="col-lg-5 col-md-5 col-sm-6">
                                        <div class="room_cost">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <tr class="room_table">
                                                                <td class=""><span class="imp_table_text"><?php 
                                                                if(isset($_GET['id'])){
                                                                    echo $soluong; }?> Room</span> <br></td>
                                                                    <td class=""><span class="imp_table_text"><?php
                                                                    if(isset($_GET['id'])){

                                                                        foreach($book as $b){
                                                                            echo $b->prices;
                                                                        }
                                                                    }
                                                                    ?></span> <br> price</td>
                                                                    <td class>                            <?php
                                                                    if(isset($_GET['id'])){
                                                                       echo $days; }
                                                                       ?>
                                                                       <br>night</td>
                                                                       <td class=""><span class="imp_table_text">
                                                                        <?php                                               if(isset($_GET['id'])){

                                                                         echo $tong;
                                                                     }?>$</span></td>
                                                                 </tr>
                                                                 <tr class="tax_table">
                                                                    <td class=""><span class="imp_table_text">tax</span> <br></ 10% on booking valuetd>
                                                                        <!-- <td class=""></td>
                                                                            <td class=""></td> -->
                                                                            <td class="" colspan="3"><span class="imp_table_text"><?php                                                if(isset($_GET['id'])){
                                                                             echo $phantram;}?>$</span></td>
                                                                         </tr>
                                                                         <tr class="total_table">
                                                                            <td class=""><span class="imp_table_text">total</span></td>
                                                                        <!-- <td class=""></td>
                                                                            <td class=""></td> -->
                                                                            <td class="" colspan="3"><span class="imp_table_text"><?php                                                if(isset($_GET['id'])){

                                                                                echo $total;}?>$</span></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="booking_next_btn padding-top-30 margin-top-20 clearfix border-top-whitesmoke">
                                                    </div>
                                                                                                                        <input type="submit" class="btn btn-submit" value="book" name="gui">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="personal_info">
                                <div class="personal_info_area">
                                    <div class="hotel_booking_area">
                                        <div class="hotel_booking margin-top-70 margin-bottom-125">

                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>

                    </div>
                </div>
            </section>

        </form>
        <!-- end other detect room section -->


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
    <!--
        <script src="js/uikit.min.js"></script>
        <script src="js/uikit-modal.js"></script>
        <script src="js/uikit-lightbox.js"></script>
    -->
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

    <!-- Mirrored from premiumlayers.net/demo/html/hotelbooking/booking.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 20 Mar 2020 15:33:37 GMT -->

    </html>