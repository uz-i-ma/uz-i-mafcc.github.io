<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Denvis Bookshop | Home</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<?php include 'includes/session.php'; ?>
<?php
  $where = '';
  if(isset($_GET['category'])){
    $catid = $_GET['category'];
    $where = 'WHERE category_id ='.$catid;
  }

?>
<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        
        <div class="humberger__menu__cart">
            <ul>
			<?php
              if(isset($_SESSION['user'])){
                  $ui = $user['id'];
                  $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM message where status=0 and receiver_id=$ui");
                  $stmt->execute();
                  $urow =  $stmt->fetch();
                  if($urow['numrows'] > 0){
                    echo "
                      <li class='dropdown messages-menu'>
                      <!-- Menu toggle button -->
                      <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
                        <i class='fa fa-bell-o'></i>
                        <span class='label label-danger'>".$urow['numrows']."</span>
                      </a>
                      <ul class='dropdown-menu'>
                        <li class='header'>You have <span>".$urow['numrows']."</span> unread message(s)</li>
                        <li>
                          <ul class='menu' id='message_menu'>
                          </ul>
                        </li>
                        <li class='footer'><a href='contact.php'><i class='fa fa-paper-plane'></i>Go to Contact Center</a></li>
                      </ul>
                    </li>
                    ";
                  }
              }
          ?>
                <li><a href="#"><i class="fa fa-shopping-cart"></i> <span style="background-color:green;">1</span></a></li>
                <li><a href="#"><i class="fa fa-bell-o"></i> <span style="background-color:red;">3</span></a></li>
            </ul>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__auth">
                <a href="#"><i class="fa fa-user"></i> Sign In</a>
            </div>
            <div class="header__top__right__auth">
                <a href="#"><i class="fa fa-user"></i> Sign Up</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.html">Home</a></li>
                <li><a href="./shop.php">Shop</a></li>
                <li><a href="./blog.html">Blog</a></li>
                <li><a href="./contact.html">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-whatsapp"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><a href="mailto:dennisluyali@gmail.com"><i class="fa fa-envelope"></i> info@denvisbookshop.co.ke</a></li>
                <li>Proud To Be Your Education Patner</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><a style="color: #ffffff;" href="mailto:dennisluyali@gmail.com"><i class="fa fa-envelope"></i> info@denvisbookshop.co.ke</a></li>
                                <li>Proud To Be Your Education Patner</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-whatsapp"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                            <div class="header__top__right__social">
								<?php
									if(isset($_SESSION['user'])){
									$image = (!empty($user['photo'])) ? 'images/'.$user['photo'] : 'images/profile.jpg';
									echo '
										<li class="dropdown user user-menu">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">
												<img src="'.$image.'" class="user-image" alt="User Image">
												<span class="hidden-xs">'.$user['firstname'].' '.$user['lastname'].'</span>
											</a>
											<ul class="dropdown-menu">
												<!-- User image -->
												<li class="user-header">
												<img src="'.$image.'" class="img-circle" alt="User Image">

												<p>
													'.$user['firstname'].' '.$user['lastname'].'
													<small>Member since '.date('M. Y', strtotime($user['created_on'])).'</small>
												</p>
												</li>
												<li class="user-footer">
												<div class="pull-left">
													<a href="profile.php" class="btn btn-default btn-flat">Profile</a>
												</div>
												<div class="pull-right">
													<a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
												</div>
												</li>
											</ul>
										</li>
									';
									}
									else{
									echo "
									<div class='header__top__right__language'>
											<a href='signup.php'><i class='fa fa-user'></i> Signup</a>
										</div>
										<div class='header__top__right__auth'>
											<a href='login.php'><i class='fa fa-user'></i> Login</a>
										</div>
										";
									}
								?>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <span class="header-logo navbar-brand logo-mini" style="padding-top:25px; color: black;"><b style="color:tomato;">Denvis</b>Bookshop</span>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="./index.html">Home</a></li>
                            <li><a href="./shop-grid.php">Shop</a></li>
                            <li><a href="./blog.html">Blog</a></li>
                            <li><a href="./contact.html">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
							<li><a href="#"><i class="fa fa-shopping-cart"></i> <span style="background-color:light-green;">1</span></a></li>
                			<li><a href="#"><i class="fa fa-bell-o"></i> <span style="background-color:red;">3</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Today's Top</span>
                        </div>
                        <ul id="trending">
							<?php
								$now = date('Y-m-d');
								$conn = $pdo->open();
								$stmt = $conn->prepare("SELECT * FROM products WHERE date_view=:now ORDER BY counter DESC LIMIT 10");
								$stmt->execute(['now'=>$now]);
								foreach($stmt as $row){
									echo "<li><a href='product.php?product=".$row['slug']."'><i class='fa fa-check-square-o'></i>  ".$row['name']."</a></li>";
								}
								$pdo->close();
							?>
						</ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
							<form method="POST" action="search.php">
                                <input type="text" name="keyword" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <a href="tel:+25471162548">
                            <div class="hero__search__phone">
                                <div class="hero__search__phone__icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="hero__search__phone__text">
                                    <h5>+25471162548</h5>
                                    <span>support 24/7 time</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Contact Us</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Contact Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_phone"></span>
                        <h4>Phone</h4>
                        <p>+25471162548</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_pin_alt"></span>
                        <h4>Address</h4>
                        <p>P.O. BOX 82-50309, TIRIKI</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_clock_alt"></span>
                        <h4>Open time</h4>
                        <p>10:00 am to 23:00 pm</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_mail_alt"></span>
                        <h4>Email</h4>
                        <p><a style="color: black;" href="mailto:info@denvisbookshop.co.ke">info@denvisbookshop.co.ke</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Map Begin -->
    <div class="map">
        <iframe
        src="https://maps.google.com/maps?q=KCB%20Serem&t=&z=13&ie=UTF8&iwloc=&output=embed" 
        height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0">
        </iframe>
    </div>
    <!--div class="box box-success mapouter">
        <div class="gmap_canvas">
            <iframe width="1080" height="300" id="gmap_canvas" 
                frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
            </iframe><a href="https://fmovies2.org">fmovies</a><br><style>.mapouter{position:relative;text-align:right;height:300px;width:100%}</style><a href="https://www.embedgooglemap.net">embedgooglemap.net</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:300px;width:1080px;}</style></div></div>

    <!-- Map End -->

    <footer>
        <div class="footer text-center">
            <p style="color: black;"><b>&copy;<script>document.write(new Date().getFullYear());</script>  | <a style="color: white;" href="https://muse.co.ke" target="_blank">The Muse</a>  |  All rights reserved</b></p>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>



</body>

</html>