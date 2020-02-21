<?php

    include'..\connection.php';
    
    $uname = isset($_SESSION['uname']) ? $_SESSION['uname'] : '';

    $today = date('Y-m-d');
    $tm = strtotime('tomorrow');
	$tomorrow = date('Y-m-d',$tm);

	//CHECK WHETHER THE USER HAS ALREADY BOOKED TODAY
	$check = "SELECT * FROM client_booking WHERE UNAME='$uname' AND DATE >= '$today' ORDER BY DATE ASC; ";

    $run = mysqli_query($conn, $check);

    $count = mysqli_num_rows($run);

    $results = mysqli_fetch_assoc($run);

    mysqli_free_result($run);
	

    $datetostr = ($results != '') ? strtotime($results['DATE']) : '';



    if($count >= 1){
        if(date('Y-m-d',$datetostr) == $today){
            $day = 'today';
        }
        else if(date('Y-m-d',$datetostr) == $tomorrow){
            $day = 'tomorrow';
        }
        else{
            $day = 'on '.date('jS F, Y',$datetostr);
        }
    }
    else{ 
        $day = '';
    } 

    // echo var_dump($run);
    // echo $today;
?>