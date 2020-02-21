<?php

	include'..\connection.php';


	session_start();
	$ID = isset($_SESSION['official_id']) ? $_SESSION['official_id'] : '';



	$today = date('Y-m-d');
	$tm = strtotime('tomorrow');
	$tomorrow = date('Y-m-d',$tm);

	$queryToday = "SELECT * FROM officials as O, client_booking as B WHERE O.ID_NUM='$ID' AND O.LOCATION = B.CENTER AND B.DATE = '$today';";
	$queryMorrow = "SELECT * FROM officials as O, client_booking as B WHERE O.ID_NUM='$ID' AND O.LOCATION = B.CENTER AND B.DATE = '$tomorrow';";
	
	$runToday = mysqli_query($conn, $queryToday);
	$countToday = mysqli_num_rows($runToday);
	$listToday = mysqli_fetch_all($runToday,MYSQLI_ASSOC);
	mysqli_free_result($runToday);


	$runMorrow = mysqli_query($conn,$queryMorrow);
	$countMorrow = mysqli_num_rows($runMorrow);
	$listMorrow = mysqli_fetch_all($runMorrow,MYSQLI_ASSOC);
	mysqli_free_result($runMorrow);


	$countDay = 0;
	$varDay = '';
	//What happens when the check button is clicked
	if(isset($_GET['check'])){
		$varDay = mysqli_real_escape_string($conn, $_GET['day']);
		$varDay = strtotime($varDay);
		$dayDate = date('Y-m-d',$varDay);
		$queryDay = "SELECT * FROM officials as O, client_booking as B WHERE O.ID_NUM='$ID' AND O.LOCATION = B.CENTER AND B.DATE = '$dayDate';";

		//run the query
		$runDay = mysqli_query($conn,$queryDay);
		$countDay = mysqli_num_rows($runDay);
		$listDay = mysqli_fetch_all($runDay,MYSQLI_ASSOC);
		mysqli_free_result($runDay);
	}


?>

<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo isset($ID) ? $ID : 'Official'; ?></title>
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


	<style>

		th,tr{
			text-align: center;
		}

		table{
			border-collapse: seperate; 
			border-spacing: 10%; 
			cellspacing: 3px; 
			cellpadding: 3px;
		}

	</style>

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
									<div id="colorlib-logo"><a href="#">NHIS<span>Booking</span></a></div>
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
									<li class="active"><a href="index.php">Home</a></li>
									
									<li ><a href="all.php">Appointments</a></li>

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
			   					<h1><strong>Ghana</strong> thanks you for your <strong>Services</strong></h1>
			   				</div>
			   			</div>
			   		</div>
		   		</div>
		   	</li>
		  	</ul>
	  	</div>
	</aside>


	<div id="colorlib-about">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-push-6 animate-box">
					<img class="img-responsive about-img" src="about.png" alt="">
				</div>
				<div class="col-md-6 col-md-pull-6 animate-box">
					<h2>Your Schedule</h2>
					<p>
						You can view the pending appointments here.
					</p>
						<div class="fancy-collapse-panel">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                     <div class="panel panel-default">
                         <div class="panel-heading" role="tab" id="headingOne">
                             <h4 class="panel-title">
                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Today
                                 </a>
                             </h4>
                         </div>
                         <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                             <div class="panel-body">
                                 <div class="row">
												
									<!--php code today-->
									<?php if($countToday >= 1): ?>
											<h2><a href="#">Appointments for today</a></h2>
											<?php foreach($listToday as $people): ?>
												<?php 

													$uname = $people['UNAME'];
													$nameGen = "SELECT * FROM members WHERE UNAME='$uname'; ";
													$run = mysqli_query($conn,$nameGen);
													$details = mysqli_fetch_assoc($run);
													mysqli_free_result($run);

													$first = $details['FNAME'];
													$last = $details['LNAME'];
													$phone = $details['PHONE'];

													$service = $people['SERVICE'];
												?>
												
												<div class="department-wrap animate-box">
													<div class="grid-2 col-md-6">
														<div class="desc">
															<div class="department-info">
																<div class="block">
																	<h2><a href="#"><?php echo ucwords($first).' '.ucwords($last); ?></a></h2>
																	<span><?php echo $service; ?></span>
																</div>
															</div>
														</div>
													</div>
												</div>
											<?php endforeach; ?>

										<?php else: ?>
											<div class="department-wrap animate-box">
													<div class="grid-2 col-md-6">
														<div class="desc">
															<p>You have no appointment for <strong>today</strong>.</p>
														</div>
													</div>
											</div>
										<?php endif; ?>

									<!--end php code today-->
												

								      	</div>
                             </div>
                         </div>
                     </div>
                     <div class="panel panel-default">
                         <div class="panel-heading" role="tab" id="headingTwo">
                             <h4 class="panel-title">
                                 <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Tomorrow
                                 </a>
                             </h4>
                         </div>
                         <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                             <div class="panel-body">
								<!--php code tomorrow-->
									<?php if($countMorrow >= 1): ?>
										<h2><a href="#">Appointments for tomorrow</a></h2>
										<?php foreach($listMorrow as $people): ?>
											<?php 

												$uname = $people['UNAME'];
												$nameGen = "SELECT * FROM members WHERE UNAME='$uname'; ";
												$run = mysqli_query($conn,$nameGen);
												$details = mysqli_fetch_assoc($run);
												mysqli_free_result($run);

												$first = $details['FNAME'];
												$last = $details['LNAME'];
												$phone = $details['PHONE'];

												$service = $people['SERVICE'];
											?>
											
											<div class="department-wrap animate-box">
												<div class="grid-2 col-md-6">
													<div class="desc">
														<div class="department-info">
															<div class="block">
																<h2><a href="#"><?php echo ucwords($first).' '.ucwords($last); ?></a></h2>
																<span><?php echo $service; ?></span>
															</div>
														</div>
													</div>
												</div>
											</div>
										<?php endforeach; ?>

									<?php else: ?>
										<div class="department-wrap animate-box">
												<div class="grid-2 col-md-6">
													<div class="desc">
														<p>You have no appointment for <strong>tomorrow</strong>.</p>
													</div>
												</div>
										</div>
									<?php endif; ?>
								<!--end php code tomorrow-->
											
                             </div>
                         </div>
                     </div>

                     <div class="panel panel-default">
                         <div class="panel-heading" role="tab" id="headingThree">
                             <h4 class="panel-title">
                                 <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Choose Day
                                 </a>
                             </h4>
                         </div>
                         <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                             <div class="panel-body">
                                 <!--select day-->

								 	<div class="colorlib-widget">
										<form class="contact-form" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
											<div class="form-group">
												<label for="day" class="sr-only">Day</label>
												<input type="date"  name="day" class="form-control" id="day" placeholder="Enter Date" required>
											</div>
											<div class="form-group">
												<input type="submit" name="check" id="btn-submit" class="btn btn-primary btn-send-message btn-md" value="Check">
											</div>
										</form>
									</div>

								 <!--end select day-->	

								 <!--php code for selected day-->
								 <?php if($countDay >= 1): ?>
											<h2><a href="#">Appointments on <?php echo date('jS M, Y',$varDay);?></a></h2>
											<?php foreach($listDay as $people): ?>
												<?php 

													$uname = $people['UNAME'];
													$nameGen = "SELECT * FROM members WHERE UNAME='$uname'; ";
													$run = mysqli_query($conn,$nameGen);
													$details = mysqli_fetch_assoc($run);
													mysqli_free_result($run);

													$first = $details['FNAME'];
													$last = $details['LNAME'];
													$phone = $details['PHONE'];

													$service = $people['SERVICE'];
												?>
												
												<div class="department-wrap animate-box">
													<div class="grid-2 col-md-6">
														<div class="desc">
															<div class="department-info">
																<div class="block">
																	<h2><a href="#"><?php echo ucwords($first).' '.ucwords($last); ?></a></h2>
																	<span><?php echo $service; ?></span>
																</div>
															</div>
														</div>
													</div>
												</div>
											<?php endforeach; ?>

										<?php else: ?>
											<div class="department-wrap animate-box">
													<div class="grid-2 col-md-6">
														<div class="desc">
															<?php if(!empty($varDay)): ?>
															<p>You have no appointment on <strong><?php echo date('jS M, Y',$varDay);?></strong>.</p>
															<?php endif; ?>
														</div>
													</div>
											</div>
										<?php endif; ?>

								 <!--end php code for selected day-->

                             </div>
                         </div>
                     </div>
                  </div>
               </div>
				</div>
			</div>
		</div>
	</div>


	<div class="colorlib-doctor">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-6 col-md-offset-3 text-center colorlib-heading">
					<h2>Advertisements</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 animate-box">
					<div class="row row-pb-lg">
						<div class="owl-carousel2">
							<div class="item">
								<div class="col-md-6">
									<div class="doctor-desc">
										<h3><a href="https://www.goldentreeghana.com" target="_blank">Kingsbite Chocolate</a></h3>
										<p>We process only the choicest premium Ghana cocoa beans without any blending. Cocoa Processing Company is probably the only factory in the world which can make such a claim. Through intensive research and product development, we turn out products, which meet international quality standards and also consumer satisfaction.</p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="doctor-img" style="background-image: url(chocolate.jpg);">
									</div>
								</div>
							</div>
							<div class="item">
								<div class="col-md-6">
									<div class="doctor-desc">
										<h3><a href="https://www.nestle.com" target="_blank">Milo</a></h3>
										<p>Tasty and trusted, Milo brand is the world’s leading chocolate malt beverage that can be prepared with hot or cold milk or water. It offers essential vitamins and minerals to meet the nutrition and energy demands of young bodies and minds. Launched in Australia in the early 1930s, the Milo brand takes kids' development seriously. It has long been known as an energy beverage strongly associated with sports and good health.</p>

										<p>Essential vitamins and minerals in Milo products include: calcium for strong teeth and bones iron to carry oxygen to the body’s cells vitamin A for healthy eye sight
										vitamins B1 and B2 to help release energy from foods
										vitamin C to keep skin and gums in good shape.
										</p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="doctor-img" style="background-image: url(milo.jpg);">
									</div>
								</div>
							</div>
							<div class="item">
								<div class="col-md-6">
									<div class="doctor-desc">
										<h3><a href="https://www.vodafone.com.gh">Vodafone</a></h3>
										<p>Vodafone in Ghana is an operating company of Vodafone Group Plc – the world’s leading mobile telecommunications company, with a significant presence in Europe, the Middle East, Africa, Asia Pacific and the United States.</p>
										<p>Vodafone is the only total communications solutions provider – mobile, fixed lines, internet, voice and data – and is currently the telecom company of choice for Ghanaians. It’s is the second-ranked operator in terms of market share in the sector.</p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="doctor-img" style="background-image: url(vodafone.jpg);">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">		
												
					</div>
				</div>
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
								<li><a href="index.php">Home</a></li>
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

