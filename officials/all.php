<?php

	include'..\connection.php';


	session_start();
	$ID = isset($_SESSION['official_id']) ? $_SESSION['official_id'] : '';

	$today = date('Y-m-d');

	//Past	
	$queryPast = "SELECT * FROM officials as O, client_booking as B WHERE O.ID_NUM='$ID' AND O.LOCATION = B.CENTER AND B.DATE < '$today' ORDER BY B.DATE;";

	$executePast = mysqli_query($conn, $queryPast);
	$countPast = mysqli_num_rows($executePast);

	$listPast = mysqli_fetch_all($executePast,MYSQLI_ASSOC);
	mysqli_free_result($executePast);
	
	//Today
	$queryToday = "SELECT * FROM officials as O, client_booking as B WHERE O.ID_NUM='$ID' AND O.LOCATION = B.CENTER AND B.DATE = '$today' ORDER BY B.BOOKED_ON;";

	$executeToday = mysqli_query($conn, $queryToday);
	$countToday = mysqli_num_rows($executeToday);

	$listToday = mysqli_fetch_all($executeToday,MYSQLI_ASSOC);
	mysqli_free_result($executeToday);

	//Days to come
	$queryFuture = "SELECT * FROM officials as O, client_booking as B WHERE O.ID_NUM='$ID' AND O.LOCATION = B.CENTER AND B.DATE > '$today' ORDER BY B.DATE;";

	$executeFuture = mysqli_query($conn, $queryFuture);
	$countFuture = mysqli_num_rows($executeFuture);

	$listFuture = mysqli_fetch_all($executeFuture,MYSQLI_ASSOC);
	mysqli_free_result($executeFuture);
	
?>

<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>All Appointments</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

  <!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">
	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<!-- Flexslider  -->
	<link rel="stylesheet" href="css/flexslider.css">
	<!-- Flaticons  -->
	<link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
		
	<div class="colorlib-loader"></div>
	
	<div id="page">
	<nav class="colorlib-nav" role="navigation">
		<div class="top-menu">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="top">
							<div class="row">
								<div class="col-md-6">
									<div id="colorlib-logo"><a href="index.php">NHIS<span>Booking</span></a></div>
								</div>
								<div class="col-md-3">
									<div class="num">
										<span class="icon"><i class="icon-phone"></i></span>
										<p><a href="#">support@nhis.com</a><br><a href="#">054-099-2422</a></p>
									</div>
								</div>
								<div class="col-md-3">
									<!--div class="loc">
										<span class="icon"><i class="flaticon-healthy-1"></i></span>
										<p><a href="#">88 Route West 21th Street, Suite 721 New York NY 10016</a></p>
									</div-->

									<div class="col-md-3 colorlib-widget">
											<div class="form-group">
												<a href="signout.php" class="btn btn-danger btn-send-message btn-md" >Logout</a>
											</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="menu-wrap">
				<div class="container">
					<div class="row">
						<div class="col-xs-8">
							<div class="menu-1">
								<ul>
									<li><a href="index.php">Home</a></li>
									
									<li class="active"><a href="all.php">Appointments</a></li>
									
									<li><a href="contact.html">Contact</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</nav>
	
	<aside id="colorlib-hero" class="breadcrumbs">
		<div class="flexslider">
			<ul class="slides">
		   	<li style="background-image: url(img_bg.png);">
		   		<div class="overlay"></div>
		   		<div class="container">
		   			<div class="row">
			   			<div class="col-md-8 col-md-offset-2 col-md-pull-2 slider-text">
			   				<div class="slider-text-inner">
			   					<h1>All <strong>Appointments</strong></h1>
			   				</div>
			   			</div>
			   		</div>
		   		</div>
		   	</li>
		  	</ul>
	  	</div>
	</aside>


	<div id="colorlib-services">
		<div class="container">
			<div class="row">

			<!--php code for list -->
				<!--Past-->
				<?php if($countPast >= 1): ?>
				<div class="blog-entry">
						<div class="desc">
								<span><a href="#">Before</a></span>
								<span>today,</span>
								<span><a href="#"><?php echo date('jS M, Y',strtotime($today));?></a></span>
						</div>
					</div>
				<div class="container">
					<?php foreach($listPast as $ppl): ?>
						<?php 

							$uname = $ppl['UNAME'];
							$service = $ppl['SERVICE'];
							$date = date('j-M-Y',strtotime($ppl['DATE']));
							$rowId = $ppl['ID'];

							$nameGen = "SELECT * FROM members WHERE UNAME='$uname'; ";
							$run = mysqli_query($conn,$nameGen);
							$details = mysqli_fetch_assoc($run);
							mysqli_free_result($run);

							$first = $details['FNAME'];
							$last = $details['LNAME'];
							$phone = $details['PHONE'];

						?>				
						<div class="col-md-4 animate-box">
							<div class="services-2">
								<span class="icon">
									<i class="flaticon-healthy-1"></i>
								</span>
								<div class="desc">
									<h3><a href="#"><?php echo  ucwords($first).' '.ucwords($last); ?></a></h3>
									<p>Phone: <?php echo $phone; ?></p>
									<p>Appointment Date: <?php echo $date; ?></p>
									<p>Appointment Reason: <?php echo $service; ?></p>
								</div>
								<div class="desc">
									<form action="delete.php" method="POST">
										
										<input type="hidden"  name="delRow" value="<?php echo $rowId; ?>">
										<div class="form-group">
											<input type="submit" name="check" id="btn-submit" class="btn btn-danger btn-send-message btn-md" value="Delete">
										</div>
									</form>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
				<!--end past-->


				<!--today-->
				<?php if($countToday >= 1): ?>
				<div class="blog-entry">
						<div class="desc">
								<span><a href="#">Today,</a></span>
								<span><a href="#"><?php echo date('jS M, Y',strtotime($today));?></a></span>
						</div>
					</div>
				<div class="container">
					<?php foreach($listToday as $ppl): ?>
						<?php 

							$uname = $ppl['UNAME'];
							$service = $ppl['SERVICE'];
							$date = date('j-M-Y',strtotime($ppl['DATE']));
							$rowId = $ppl['ID'];

							$nameGen = "SELECT * FROM members WHERE UNAME='$uname'; ";
							$run = mysqli_query($conn,$nameGen);
							$details = mysqli_fetch_assoc($run);
							mysqli_free_result($run);

							$first = $details['FNAME'];
							$last = $details['LNAME'];
							$phone = $details['PHONE'];

						?>				
						<div class="col-md-4 animate-box">
							<div class="services-2">
								<span class="icon">
									<i class="flaticon-healthy-1"></i>
								</span>
								<div class="desc">
									<h3><a href="#"><?php echo  ucwords($first).' '.ucwords($last); ?></a></h3>
									<p>Phone: <?php echo $phone; ?></p>
									<p>Appointment Date: <?php echo $date; ?></p>
									<p>Appointment Reason: <?php echo $service; ?></p>
								</div>
								<div class="desc">
									<form action="delete.php" method="POST">
										
										<input type="hidden"  name="delRow" value="<?php echo $rowId; ?>">
										<div class="form-group">
											<input type="submit" name="check" id="btn-submit" class="btn btn-danger btn-send-message btn-md" value="Delete">
										</div>
									</form>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
				<!--end today-->


				<!--days to come-->
				<?php if($countFuture >= 1): ?>
				<div class="blog-entry">
						<div class="desc">
								<span><a href="#">After</a></span>
								<span>today,</span>
								<span><a href="#"><?php echo date('jS M, Y',strtotime($today));?></a></span>
						</div>
					</div>
				<div class="container">
					<?php foreach($listFuture as $ppl): ?>
						<?php 

							$uname = $ppl['UNAME'];
							$service = $ppl['SERVICE'];
							$date = date('j-M-Y',strtotime($ppl['DATE']));
							$rowId = $ppl['ID'];

							$nameGen = "SELECT * FROM members WHERE UNAME='$uname'; ";
							$run = mysqli_query($conn,$nameGen);
							$details = mysqli_fetch_assoc($run);
							mysqli_free_result($run);

							$first = $details['FNAME'];
							$last = $details['LNAME'];
							$phone = $details['PHONE'];

						?>				
						<div class="col-md-4 animate-box">
							<div class="services-2">
								<span class="icon">
									<i class="flaticon-healthy-1"></i>
								</span>
								<div class="desc">
									<h3><a href="#"><?php echo  ucwords($first).' '.ucwords($last); ?></a></h3>
									<p>Phone: <?php echo $phone; ?></p>
									<p>Appointment Date: <?php echo $date; ?></p>
									<p>Appointment Reason: <?php echo $service; ?></p>
								</div>
								<div class="desc">
									<form action="delete.php" method="POST">
										
										<input type="hidden"  name="delRow" value="<?php echo $rowId; ?>">
										<div class="form-group">
											<input type="submit" name="check" id="btn-submit" class="btn btn-danger btn-send-message btn-md" value="Delete">
										</div>
									</form>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
				<!--end days to come-->

				<?php if($countFuture==0 && $countPast==0 && $countToday==0): ?>
					<div class="blog-entry">
						<div class="desc">
							<span><a href="#">There are no pending appointments</a></span>
						</div>
					</div>
				<?php endif; ?>


			<!--end php code for list-->
				
			</div>
		</div>
	</div>


<footer id="colorlib-footer" role="contentinfo">
		<div class="overlay"></div>
		<div class="container">
			<div class="row row-pb-md">
				
					<div class="col-md-2 colorlib-widget">
						<h3>Useful Links</h3>
						<p>
						<ul class="colorlib-footer-links">
								<li><a href="#">Home</a></li>
								<li><a href="http://www.nhis.gov.gh">NHIS</a></li>
								<li><a href="http://www.nhis.gov.gh/districts.aspx" target="_blank">District Offices</a></li>
								
							</ul>
						</p>
					</div>

					

				<div class="col-md-3 colorlib-widget">
					
						<div class="form-group">
							<a href="signout.php" class="btn btn-primary btn-send-message btn-md" >Logout</a>
						</div>
				</div>
			</div>
		</div>
		<div class="row copyright">
			<div class="col-md-12 text-center">
				<p>
					<small class="block">&copy; <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <a href="#">EastPoint</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></small> 
					
				</p>
			</div>
		</div>
	</footer>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<!-- countTo -->
	<script src="js/jquery.countTo.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Sticky Kit -->
	<script src="js/sticky-kit.min.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>

	</body>
</html>

