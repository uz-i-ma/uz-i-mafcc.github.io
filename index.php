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
                      <ul class='header__menu__dropdown dropdown-menu'>
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
                <li class="active"><a href="./">Home</a></li>
                <li><a href="./shop.php">Shop</a></li>
                <li><a href="./blog.html">Blog</a></li>
                <li><a href="./contactus.php">Contact</a></li>
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
										<div class="header__top__right__language">
											<a href="#" class="dropdown" data-toggle="dropdown">
												<img src="'.$image.'" style="height:25px; width:25px; border-radius: 50%;" alt="User Image">
												<span class="hidden-xs">'.$user['firstname'].' '.$user['lastname'].'</span>
											</a>
										</div>
										<div class="header__top__right__auth">
											<small style="color:white;"	>Member since '.date('M. Y', strtotime($user['created_on'])).'</small>
										</div>
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
                <div class="col-lg-7">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="./">Home</a></li>
                            <li><a href="./shop-grid.php">Shop</a></li>
                            <li><a href="./blog.html">Blog</a></li>
                            <li><a href="./contactus.php">Contact</a></li>
							<?php
								if(isset($_SESSION['user'])){
								$image = (!empty($user['photo'])) ? 'images/'.$user['photo'] : 'images/profile.jpg';
								echo '
									<li><a href="profile.php">Profile</a></li>
									<li><a href="logout.php">Signout</a></li>
								';
								}
							?>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-2">
                    <div class="header__cart">
                        <ul>
							<?php
								if(isset($_SESSION['user'])){
									$ui = $user['id'];
									$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM message where status=0 and receiver_id=$ui");
									$stmt->execute();
									$urow =  $stmt->fetch();
									if($urow['numrows'] > 0){
									echo '
										<li><a href="contact.php"><i class="fa fa-bell-o"></i> <span style="background-color:red;">'.$urow["numrows"].'</span></a></li>
									';
									}
								}
							?>
							<li><a href="cart_view.php"><i class="fa fa-shopping-cart"></i> <span style="background-color:light-green;" class="cart_count">1</span></a></li>
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
    <section class="hero">
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
                    <div id="carousel-example-generic" data-ride="carousel" class="carousel slide">
                        <div class="carousel-inner">
                            <div class="carousel-item active" style="background-color: #f3f6fa;">
                                <div class="row">
                                    <div class="hero__text text-center col-md-5" style="padding-top: 5%;">
                                        <span class="badge" style="color:red;">BONIFIED MEMBERS OF THE</span>
                                        <h2>Kenya Booksellers <br/> Association</h2>
                                        <p style="color:red;">We Are Denvisbookshop</p>
                                        <a href="#" class="jumbotron primary-btn">SHOP NOW</a>
                                    </div>
                                    <div class="col-md-5" style="padding-top: 5%;">
                                        <img src="img/hero/Untitled.jpg">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item" style="background-color: #f3f6fa;">
                                <div class="row">
                                    <div class="hero__text text-center col-md-5" style="padding-top: 5%;">
                                        <span class="badge ">EDUCATION PATNER</span>
                                        <h2>A Brand <br />For Kenya</h2>
                                        <p>Free Pickup and Delivery Available</p>
                                        <a href="#" class="jumbotron primary-btn " style="background-color:red;">SHOP NOW</a>
                                    </div>
                                    <div class="col-md-5" style="padding-top: 5%;">
                                        <img src="img/hero/ke.jpeg">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item" style="background-color: #f3f6fa;">
                                <div class="row">
                                    <div class="hero__text text-center col-md-5" style="padding-top: 5%;">
                                        <span class="badge ">EDUCATION PATNER</span>
                                        <h2 style="color:red;">All Stationery <br />100% Quality</h2>
                                        <p>Free Pickup and Delivery Available</p>
                                        <a href="#" class="jumbotron primary-btn" style="background-color:black; color:white;">SHOP NOW</a>
                                    </div>
                                    <div class="col-md-5" style="padding-top: 5%;">
                                        <img src="img/hero/Untitled.jpg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
	<!-- Featured Section Begin -->
	<section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>About Us</h2>
                    </div>
					<div class="text-center">
						<p style="color: #0f0f0f;;">Hello there..!! :) Denvis Bookshop deals in all kinds of office supplies, books, lab equipment, sports wear, uniforms, computer assecories, exams, printing services, to mention just but a few. Our Head office is located at Serem, Vihiga County. We are proud of the several satisfied clients, who range from various public and private institutions, schools to individuals, that we have on our side all over Kenya's western region. We believe that we are your Education Patner. Chosen by you and for you. Take a look at the fun facts below and our client testimonials below. To learn much about us, the projects we do and generally who we are, take a moment to visit <a href="blog.php" style="color:green;"><u><i> the blog page</i></u></a>. Thanks a lot for your time.</p>
					</div>
                </div>
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

 <!-- Blog Section Begin -->
 <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>Meet The Team</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-2.jpg" alt="">
                        </div>
                        <div class="blog__item__text text-center">
                            <ul>
                                <li><i class="fa fa-instagram"></i></li>
                                <li><i class="fa fa-twitter"></i></li>
                                <li><i class="fa fa-facebook"></i></li>
                            </ul>
                            <h5><a href="#">Dennis Luyali</a></h5>
                            <p>Chief Executive Officer</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-2.jpg" alt="">
                        </div>
                        <div class="blog__item__text text-center">
                            <ul>
                                <li><i class="fa fa-instagram"></i></li>
                                <li><i class="fa fa-twitter"></i></li>
                                <li><i class="fa fa-facebook"></i></li>
                            </ul>
                            <h5><a href="#">Uzima Samuel</a></h5>
                            <p>Lead Developer</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-3.jpg" alt="">
                        </div>
                        <div class="blog__item__text text-center">
                            <ul>
                                <li><i class="fa fa-instagram"></i></li>
                                <li><i class="fa fa-twitter"></i></li>
                                <li><i class="fa fa-facebook"></i></li>
                            </ul>
                            <h5><a href="#">Uzima Samuel</a></h5>
                            <p>Lead Developer</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-3.jpg" alt="">
                        </div>
                        <div class="blog__item__text text-center">
                            <ul>
                                <li><i class="fa fa-instagram"></i></li>
                                <li><i class="fa fa-twitter"></i></li>
                                <li><i class="fa fa-facebook"></i></li>
                            </ul>
                            <h5><a href="#">Uzima Samuel</a></h5>
                            <p>Lead Developer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

	
    <!--==========================
      Facts Section
    ============================-->
    <section id="facts"  class="wow fadeIn">
      <div class="container">

	  <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>Fan Facts</h2>
                    </div>
                </div>
            </div>
        <div class="row counters">

  				<div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">274</span>
            <p>Clients</p>
  				</div>

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">421</span>
            <p>Projects</p>
  				</div>

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">1,364</span>
            <p>Hours Of Support</p>
  				</div>

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">18</span>
            <p>Hard Workers</p>
  				</div>

  			</div>

        <div class="facts-img">
          <img src="img/facts-img.png" alt="" class="img-fluid">
        </div>

      </div>
    </section><!-- #facts -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="section-title text-center">
                <h2> Product Categories</h2>
            </div>
            <div class="row">
                
                <div class="categories__slider owl-carousel">
					<?php
						$conn = $pdo->open();
						$stmt = $conn->prepare("SELECT * FROM category ORDER BY name");
						$stmt->execute();
						foreach($stmt as $row){
							echo "
                    			<div class='col-lg-3'>
                        			<div class='categories__item set-bg' data-setbg='img/categories/".$row['photo']."'>
										<h5><a href='category.php?category=".$row['name']."'>".$row['name']."</a></h5>
			                        </div>
            			        </div>
							";
						}
						$pdo->close();
					?>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

   						

	<!-- Footer Section Begin -->
    <footer>
        <div class="footer text-center">
            <p style="color: black;"><b>&copy;<script>document.write(new Date().getFullYear());</script>  | <a style="color: white;" href="https://muse.co.ke" target="_blank">The Muse</a>  |  All rights reserved</b></p>
        </div>
    </footer>
    <!-- Footer Section End -->
	<?php include 'includes/scripts.php'; ?>

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>



</body>

</html>