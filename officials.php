<?php
    include'connection.php';
    //Declare variable
	$alert = '';
	$ival = '';
    
    //What should happen when submit button is clicked
    if(isset($_POST['submit'])){
		
		//Declaring variables. It could have also been declared above
		$sid = mysqli_real_escape_string($conn,$_POST['sId']);
		$spin = mysqli_real_escape_string($conn,$_POST['sPin']);

		$ival = $sid;

		
		//Assign queries to be used to variables
		$query = "SELECT * FROM officials WHERE ID_NUM='$sid' AND PIN='$spin';";

		//Run the query
		$rQuery = mysqli_query($conn,$query);

		//Count how many rows are there
		$rows = mysqli_num_rows($rQuery);

		if($rows >= 1){
			session_start();
			$_SESSION['official_id'] = $sid;
			header('Location: officials/index.php');
		}
		else{
			$alert = "Please check details and enter again";
		}
    }

?>
	
	
	<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="img/fav.png">
		<!-- Author Meta -->
		<meta name="author" content="colorlib">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title>Official</title>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="css/linearicons.css">
			<link rel="stylesheet" href="css/font-awesome.min.css">
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/magnific-popup.css">
			<link rel="stylesheet" href="css/jquery-ui.css">				
			<link rel="stylesheet" href="css/nice-select.css">							
			<link rel="stylesheet" href="css/animate.min.css">
			<link rel="stylesheet" href="css/owl.carousel.css">			
			<link rel="stylesheet" href="css/jquery-ui.css">			
			<link rel="stylesheet" href="css/main.css">
			<link rel="stylesheet" href="official.css">
		</head>
		<body>	
		  <header id="header">
	  		<div class="header-top">
	  			<div class="container">
			  		<div class="row align-items-center">
			  			<div class="col-lg-6 col-sm-6 col-4 header-top-left">
			  				<a href="tel:+9530123654896"><span class="lnr lnr-phone-handset"></span> <span class="text"><span class="text">+233 054 365 4896</span></span></a>
				  			<a href="mailto:support@colorlib.com"><span class="lnr lnr-envelope"></span> <span class="text"><span class="text">support@nhis.com</span></span></a>			
			  			</div>
			  			<div class="col-lg-6 col-sm-6 col-8 header-top-right">
							<a href="login.php" class="primary-btn text-uppercase">Book Appointment</a>
			  			</div>
			  		</div>			  					
	  			</div>
			</div>
		    <div class="container main-menu">
		    	<div class="row align-items-center justify-content-between d-flex">
			      <div id="logo">
			        <a href="index.html"><img src="img/logo.png" alt="" title="" /></a>
			      </div>
			      <nav id="nav-menu-container">
			        <ul class="nav-menu">
			          <li><a href="index.php">Home</a></li>
			          
			          <li><a href="#">Clients</a>
					  <ul class="dropdown">
						  <li><a href="login.php">Login</a></li>
							  <li><a href="join.php">Register</a></li>
							  </ul>
							  </li>
					
			          <li><a href="contact.html">Contact</a></li>
			        </ul>
			      </nav><!-- #nav-menu-container -->	    		
		    	</div>
		    </div>
		  </header><!-- #header -->

			<!-- start banner Area -->
			<section class="official-banner relative" id="home">
				<div class="overlay overlay-bg"></div>	
				<div class="container">
					<div class="row fullscreen d-flex align-items-center justify-content-center">
						<div class="banner-content col-lg-8 col-md-12">
							<!--Something can be written here-->
						</div>										
					</div>
				</div>					
			</section>
			<!-- End banner Area -->

			<!-- Start Login Area -->
			<section class="appointment-area">			
				<div class="container">
					<div class="row justify-content-between align-items-center pb-120 appointment-wrap">
						<div class="col-lg-6 col-md-6 appointment-right pt-60 pb-60">
							<form class="form-wrap" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
								<h3 class="pb-20 text-center mb-30">Officials</h3>	
								<?php if($alert != '') : ?>
									<h5 class="pb-5 text-center text-uppercase" style="color: red;"><?php echo $alert; ?></h5>
								<?php endif; ?>		
								<input type="text" class="form-control" name="sId" placeholder="ID Number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'ID Number'" required  value="<?php echo $ival; ?>">
								<input type="password" class="form-control" name="sPin" placeholder="PIN" onfocus="this.placeholder = ''" onblur="this.placeholder = 'PIN'" required>
								<button type="submit" name="submit" class="primary-btn text-uppercase">Login</button>
							</form>
						</div>
					</div>
				</div>	
			</section>
			<!-- End Login Area -->

			<footer class="footer-area section-gap">

					<div class="row footer-bottom d-flex justify-content-between">
						<p class="col-lg-8 col-sm-12 footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved |<a href="https://colorlib.com" target="_blank">EastPoint</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
						<div class="col-lg-4 col-sm-12 footer-social">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-dribbble"></i></a>
							<a href="#"><i class="fa fa-behance"></i></a>
						</div>					
					</div>
				</div>
			</footer>
		
			<script src="js/vendor/jquery-2.2.4.min.js"></script>
			<script src="js/popper.min.js"></script>
			<script src="js/vendor/bootstrap.min.js"></script>			
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
 			<script src="js/jquery-ui.js"></script>					
  			<script src="js/easing.min.js"></script>			
			<script src="js/hoverIntent.js"></script>
			<script src="js/superfish.min.js"></script>	
			<script src="js/jquery.ajaxchimp.min.js"></script>
			<script src="js/jquery.magnific-popup.min.js"></script>	
    		<script src="js/jquery.tabs.min.js"></script>						
			<script src="js/jquery.nice-select.min.js"></script>	
			<script src="js/owl.carousel.min.js"></script>									
			<script src="js/mail-script.js"></script>	
			<script src="js/main.js"></script>	
		</body>
	</html>