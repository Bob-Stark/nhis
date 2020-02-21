<?php
    include'connection.php';
    //Declare variable
    $alert = '';
    
    //What should happen when submit button is clicked
    if(isset($_POST['submit'])){
        //Declaring variables. It could have also been declared above
        $fname = mysqli_real_escape_string($conn,$_POST["fname"]);
        $lname = mysqli_real_escape_string($conn,$_POST["lname"]);
        $uname = mysqli_real_escape_string($conn,$_POST["uname"]);
        $phone = mysqli_real_escape_string($conn,$_POST["phone"]);
        $pswd = mysqli_real_escape_string($conn,$_POST["password"]);
        $cpswd = mysqli_real_escape_string($conn,$_POST["cpassword"]);
        $query = "INSERT INTO members('fname','lname','uname','phone','pswd')
                VALUES('$fname','$lname','$uname','$phone','$pswd');";
        $dUname = "SELECT * FROM members WHERE uname='$uname';";
        $dPhone = "SELECT * FROM members WHERE phone='$phone'";

        //Check if Passwords Match      
        if($pswd == $cpswd){
            //If no required field is empty, run query.
            if(mysqli_query($conn,$query)){
                header('Location: departments.php');
            }else{
                if(mysqli_query($conn,$dUname)){
                    $alert = ucwords('username has already been taken');
                }elseif(mysqli_query($conn,$dPhone)){
                    $alert = ucwords('this phone number has already been used');
                }
            }
        } 

    }

