<?php
	include'..\connection.php';

	//Start session and get username from the session after logging in
	session_start();
	$uname = isset($_SESSION['uname']) ? $_SESSION['uname'] : '';

	//Declare variables
	$alert = '';
	$color = '';

	include('check_schedule.php');

	//Get today's date
	$today = date('Y-m-d');

	//CHECK WHETHER THE USER HAS ALREADY BOOKED TODAY
	$query = "SELECT * FROM client_booking WHERE UNAME='$uname' AND BOOKED_ON >= '$today'; ";
	$result = mysqli_query($conn, $query);

	//Count the number of rows
	$numRows = mysqli_num_rows($result);

	//Take results and convet it to an associative array.
	$bookDay = mysqli_fetch_assoc($result);
	// Free result
	mysqli_free_result($result);

	$bkDayTstmp = ($bookDay != '') ? strtotime($bookDay['BOOKED_ON']) : 0;
	$what = ($bookDay != '') ? $results['SERVICE'] : '';
	$where = ($bookDay != '') ? $results['CENTER'] : '';
	

	//	Convert the timestamp to something like 2018-12-23
	$bkDate = date('Y-m-d',$bkDayTstmp);

	//Get user details
	$user = "SELECT * FROM members WHERE UNAME = '$uname';";
	$run = mysqli_query($conn, $user);
	$list = mysqli_fetch_assoc($run);
	mysqli_free_result($run);

	// echo "Num of Rows: ".$numRows."<br>";
	// echo "Book Time: ". $bkDate."<br>";
	// echo "Today: ". $today."<br>";

	
	if(isset($_POST['submit'])){
		$date = mysqli_real_escape_string($conn,$_POST['appointmentDate']);
		$center = mysqli_real_escape_string($conn,$_POST['center']);
		$service = mysqli_real_escape_string($conn,$_POST['serviceType']);

		$query = "INSERT INTO client_booking(uname,date,service,center) VALUES('$uname','$date','$service','$center');";

		$howMany = "SELECT * FROM client_booking WHERE center='$center' AND date='$date'; ";
		$rHowMany = mysqli_query($conn, $howMany);
		$cHowMany = mysqli_num_rows($rHowMany);

		//The user cannot make more than one booking on one day.
		if($numRows >= 1){

			$alert = ucwords('booking failed<br> cannot make more than one booking in a day');
			$color = 'red';

		}
		else if($cHowMany >= 5){
			$alert = ucwords('booking failed<br> we have reached the maximum number of bookings for '. $center.'<br> please book at a different center');
			$color = 'red';
		}
		else{
			
			header('Location: book.php');
			if(mysqli_query($conn,$query)){
				$alert = ucwords('booking successful');
				$color = '#9bdf46';
			}
			else{
				$alert = ucwords('booking failed');
				$color = 'red';
			}
			//header('Refresh:0.01, url=book.php');

		}


	}
    

?>
	


<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo isset($uname) ? $uname : 'NHIS'; ?></title>
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
												<a href="../logout.php" class="btn btn-danger btn-send-message btn-md" >Logout</a>
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
									<li class="active"><a href="../index.php">Home</a></li>
									<!--li class="has-dropdown">
										<a href="doctors.html">Doctors</a>
										<ul class="dropdown">
											<li><a href="doctors-single.html">Single Doctor</a></li>
										</ul>
									</li-->
									<!--li><a href="services.html">Services</a></li-->
									<!--li class="has-dropdown">
										<a href="departments.html">Departments</a>
										<ul class="dropdown">
											<li><a href="departments-single.html">Plasetic Surgery Department</a></li>
											<li><a href="departments-single.html">Dental Department</a></li>
											<li><a href="departments-single.html">Psychological Department</a></li>
										</ul>
									</li-->
									<li><a href="contact.html" target="_blank">Contact</a></li>
									
									<li><a href="#">
											<span class="icon"><i class="flaticon-healthy-1"></i></span>
											<!--Get user full name-->
											<?php 
												echo $list['FNAME'].' '.$list['LNAME'];
											?></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</nav>
	
	<aside id="colorlib-hero">
		<div class="flexslider">
			<ul class="slides">
		   	<li style="background-image: url(images/img_bg_1.jpg);">
		   		<div class="overlay"></div>
		   		<div class="container">
		   			<div class="row">
			   			<div class="col-md-8 col-md-offset-2 col-md-pull-2 slider-text">
			   				<div class="slider-text-inner">
			   					<h1><?php echo "Dear ". ucwords($list['FNAME']).','; ?> <strong><br><?php echo $day == '' ? ucwords("you have no scheduled appointment") : ucwords("you have an appointment $day."); ?></strong></h1>
									<h2><?php echo $day == '' ? "You can book at anytime" : "You are expected to make your NHIS card ". $what ." at ". $where.". "; ?></h2>
									<!--p><a class="btn btn-primary btn-lg btn-learn" href="#">Make an Appointment</a></p-->
			   				</div>
			   			</div>
			   		</div>
		   		</div>
		   	</li>
		   	<!--<li style="background-image: url(images/img_bg_5.jpg);">
		   		<div class="overlay"></div>
		   		<div class="container">
		   			<div class="row">
			   			<div class="col-md-8 col-md-offset-2 col-md-pull-2 slider-text">
			   				<div class="slider-text-inner">
			   					<h1>We help you <strong>to find the best doctor around you</strong></h1>
									<h2>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</h2>
									<!--p><a class="btn btn-primary btn-lg btn-learn" href="#">Make an Appointment</a></p-->
			   				<!--</div>
			   			</div>
			   		</div>
		   		</div>
		   	</li>-->
		   	<!--li style="background-image: url(chocolate.jpeg);">
		   		<div class="overlay"></div>
		   		<div class="container">
		   			<div class="row">
			   			<div class="col-md-8 col-md-offset-2 col-md-pull-2 slider-text">
			   				<div class="slider-text-inner">
			   					<h1>Guaranted <strong>safe &amp; potent</strong> Medicine</h1>
									<h2>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</h2>
									<!--p><a class="btn btn-primary btn-lg btn-learn" href="#">Make an Appointment</a></p-->
			   				<!--/div>
			   			</div>
			   		</div>
		   		</div>
		   	</li-->
		   	<!--li style="background-image: url(images/img_bg_2.jpg);">
		   		<div class="overlay"></div>
		   		<div class="container">
		   			<div class="row">
			   			<div class="col-md-8 col-md-offset-2 col-md-pull-2 slider-text">
			   				<div class="slider-text-inner">
			   					<h1>Helping to improve <strong>quality stimulate</strong> innovation</h1>
									<h2>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</h2>
									<!--p><a class="btn btn-primary btn-lg btn-learn" href="#">Make an Appointment</a></p-->
			   				<!--/div>
			   			</div>
			   		</div>
		   		</div>
		   	</li-->		   	
		  	</ul>
	  	</div>
	</aside>

	

	

	<div id="colorlib-choose">
		<div class="container-fluid">
			<div class="row">
				<div class="choose">
					<div class="half img-bg" style="background-image: url(images/cover_bg_1.jpg);"></div>
					<div class="half features-wrap">
						<div class="features-services animate-box">
							<div class="colorlib-heading animate-box">
								<h2>Book Appointment</h2>

								<?php if($alert != ''): ?>
									<br>
									<h3 style="color: <?php echo $color; ?>"> 
									<?php echo $alert; ?> 
									</h3>
								<?php endif; ?>

							</div>

							<!--Begin form-->
							
							<form class="contact-form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

								<div class="row">
									<div class="col-md-6">

										<div class="features animate-box">
											<span class="icon text-center"><i class="flaticon-healthy-1"></i></span>
											<div class="desc">
											
												<div class="form-group">
													<label for="username" class="sr-only">Username</label>
													<input type="name" class="form-control" id="username" placeholder="Username" value="<?php echo $uname; ?>" name="uname" required>
												</div>

											</div>
										</div>

										<div class="features animate-box">
											<span class="icon text-center"><i class="flaticon-stethoscope"></i></span>
											<div class="desc">
												
												<div class="form-group">
													<label for="service" class="sr-only">Service Type</label>
													<select id="service" class="form-control" name="serviceType" required>  
													<option value="Registration">Registration </option> 
													<option value="Renewal">Renewal </option>
													<option value="Replacement">Replacement </option>  
													</select>

												</div>

											</div>
										</div>

										
									</div>

									<div class="col-md-6">
										<div class="features animate-box">
											<span class="icon text-center"><i class="flaticon-medical-1"></i></span>
											<div class="desc">
												<div class="form-group">
													<label for="date" class="sr-only">Appointment Date</label>
													<input type="date" class="form-control" id="message" placeholder="Appointment Date" name="appointmentDate" required>
												</div>


											</div>
										</div>

										<div class="features animate-box">
											<span class="icon"><i class="icon-location"></i></span>
											<div class="desc">
												<div class="form-group">
													<label for="center" class="sr-only">Center</label>

													<select id="center" class="form-control" name="center" required>
													
													<option value="Ablekuma">Ablekuma </option>
												    <option value="Ashiedu Keteke">Ashiedu Keteke </option>  
													<option value="Ayawaso">Ayawaso </option>
													<option value="Dangme-East">Dangme-East </option>
													<option value="Dangme-West">Dangme-West </option>
													<option value="Ga District">Ga District </option>
													<option value="Kpeshie">Kpeshie </option>
													<option value="Okaikoi">Okaikoi </option>
													<option value="Osu-Klottey">Osu-Klottey </option>
													<option value="Tema">Tema </option>

											

													</select>
												</div>

												</div>


											</div>
										</div>
										
									</div>

									<div class="features animate-box">
										<div class="desc">
											
											<div class="form-group">
												<input type="submit" name="submit" id="btn-submit" class="btn btn-primary btn-send-message btn-md" value="Confirm Booking">
											</div>
										</div>
									</div>
								</div>
							</form>

							<!--end form-->

						</div>
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
								<li><a href="#">Home</a></li>
								<li><a href="http://www.nhis.gov.gh">NHIS</a></li>
								<li><a href="http://www.nhis.gov.gh/districts.aspx" target="_blank">District Offices</a></li>
								
							</ul>
						</p>
					</div>

					
			</div>
		</div>
		<div class="row copyright">
			<div class="col-md-12 text-center">
				<p>
					<small class="block">&copy; <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | EastPoint
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

