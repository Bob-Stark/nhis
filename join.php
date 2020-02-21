<?php
    include'connection.php';
    //Declare variable
	$alert = '';
	$fval = '';
	$lval = '';
	$uval = '';
	$phval = '';
    
    //What should happen when submit button is clicked
    if(isset($_POST['submit'])){
		
		//Declaring variables. It could have also been declared above
		$fname = mysqli_real_escape_string($conn,$_POST["fname"]);
		$lname = mysqli_real_escape_string($conn,$_POST["lname"]);
		$uname = mysqli_real_escape_string($conn,$_POST["uname"]);
		$phone = mysqli_real_escape_string($conn,$_POST["phone"]);
		$pswd = mysqli_real_escape_string($conn,$_POST["pswd"]);
		$cpswd = mysqli_real_escape_string($conn,$_POST["cpswd"]);

		//Assign queries
		$query = "INSERT INTO members(FNAME,LNAME,UNAME,PHONE,PSWD)
				VALUES('$fname','$lname','$uname','$phone','$pswd');";
		$dUname = "SELECT * FROM members WHERE uname='$uname';";
		$dPhone = "SELECT * FROM members WHERE phone='$phone'";
		
		
        //Check if Passwords Match      
        if($pswd == $cpswd){
			//If no required field is empty, run query.
			if(mysqli_query($conn,$query)){
				//If we are able to insert details into the table, go to login.php
            	   header('Location: login.php');
			}
			else{
				$dUquery = mysqli_query($conn,$dUname);
				$dPquery = mysqli_query($conn,$dPhone);

				$dUrows = mysqli_num_rows($dUquery);
				$dProws = mysqli_num_rows($dPquery);			
				if($dUrows >= 1){
					//Check if there is a username like that in the table
					$alert = ucwords('username has already been taken');
					$fval = $fname;
					$lval = $lname;
					$uval = $uname;
					$phval = $phone;
				}
				elseif($dProws >=1){
					//Check if someone has registered with that phone number
					$alert = ucwords('this phone number has already been used');
					$fval = $fname;
					$lval = $lname;
					$uval = $uname;
					$phval = $phone;
				}
				else{
					$alert = "something went wrong!";
					$fval = $fname;
					$lval = $lname;
					$uval = $uname;
					$phval = $phone;
				}
			}

		}
		else{
			$alert = ucwords("Passwords Do not Match");
			$fval = $fname;
			$lval = $lname;
			$uval = $uname;
			$phval = $phone;
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
		<title>Register</title>

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
			<link rel="stylesheet" href="css/join.css">
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
			          <li><a href="officials.php">Officials</a></li>
			          <li><a href="login.php">Login</a></li>
					
			          <li><a href="contact.html">Contact</a></li>
			        </ul>
			      </nav><!-- #nav-menu-container -->		    		
		    	</div>
		    </div>
		  </header><!-- #header -->

			<!-- start banner Area -->
			<section class="join-banner relative" id="home">
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

			<!-- Start appointment Area -->
			<section class="appointment-area">			
				<div class="container">
					<div class="row justify-content-between align-items-center pb-120 appointment-wrap">
						<div class="col-lg-5 col-md-6 appointment-left">
							<h1>
								Working Hours
							</h1>
							<ul class="time-list">
								<li class="d-flex justify-content-between">
									<span>Monday-Friday</span>
									<span>08.00 am - 05.00 pm</span>
								</li>
								<li class="d-flex justify-content-between">
									<span>Saturday</span>
									<span>08.00 am - 03.00 pm</span>
								</li>															
							</ul>
						</div>
						<div class="col-lg-6 col-md-6 appointment-right pt-60 pb-60">
							
							<form class="form-wrap" action="<?php	echo $_SERVER['PHP_SELF']; ?>" method="POST">
								<h3 class="pb-20 text-center mb-30">Register Here</h3>
								<?php if($alert != '') : ?>
									<h5 class="pb-5 text-center text-uppercase" style="color: red;"><?php echo $alert; ?></h5>
								<?php endif; ?>		
								<input type="text" class="form-control" name="fname" placeholder="First Name " onfocus="this.placeholder = ''" onblur="this.placeholder = 'First Name'" required value="<?php echo $fval; ?>">

								<input type="text" class="form-control" name="lname" placeholder="Last Name " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Last Name'" required value="<?php echo $lval; ?>">

								<input type="text" class="form-control" name="uname" placeholder="Create Username " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Create Username'" required value="<?php echo $uval; ?>">

								<input type="text" class="form-control" name="phone" placeholder="Phone " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone'" required value="<?php echo $phval; ?>">

								<input type="Password" class="form-control" name="pswd" placeholder="Create Password " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Create Password'" required>

								<input type="Password" class="form-control" name="cpswd" placeholder="Confirm Password " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'" required>


								<input type="submit" name="submit" value="Confirm Registration" class="primary-btn text-uppercase">
							</form>
						</div>
					</div>
				</div>	
			</section>
			<!-- End appointment Area -->


			<!-- start footer Area -->		
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
			<!-- End footer Area -->


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