<?php
  
  
  session_start();
  $client = isset($_SESSION['name']) ? $_SESSION['name'] : '';

  
  $conn = mysqli_connect('localhost','root','','eastpoint');
  
  if(mysqli_connect_errno()){
     $alert = 'there was a problem connecting to msql '.mysqli_connect_errno();
  }else{
    $q = "SELECT * FROM clients WHERE uname='$client';";
    $rq = mysqli_query($conn, $q);
    $col = mysqli_fetch_all($rq, MYSQLI_NUM);    
  }

  mysqli_close($conn);

?>
    

    <!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="generator" content="Responsive Site Designer 1.5.1390">
  <title>My Profile</title>
  <link rel="stylesheet" href="css/coffeegrinder.min.css">
  <link rel="stylesheet" href="css/wireframe-theme.min.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,b">

  
</head>

<body class="grid-1">
  <div class="row">
    <div class="coffee-span-12">
      <h1 class="page-title">EastPoint</h1>
    </div>
  </div>
  <header class="row nav-row">
    <nav class="coffee-span-12 centered-content">
    <!--a class="link-button nav" href="tour.php">Tour</a-->
    <a class="link-button nav" href="#"><?php foreach($col as $cols => $row){echo $row[1].' '. $row[2];}; ?> </a>
    <a class="link-button nav" href="contactUs.php" target="_blank">Contact Us</a>
    </nav>
  </header>
  
  <main class="row">
    <div class="coffee-span-12">
      <h4 class="sub-title">You are logged in</h4>
    </div>
  </main>

  <main class="row">
    <main class="coffee-span-12 centered-content">
      <a class="link-button action-button"
      id="registerWithUs" href="logout.php" name="rwu"><?php echo $client; ?> | Logout</a>
    </main>
  </main>

    <footer class="row footer-row">
    <div class="coffee-span-12 footer-column">
      <div class="rule">
        <hr>
      </div>
     &copy;2018 MindCraft Inc.
    </div>
  </footer>

   
</body>

</html>