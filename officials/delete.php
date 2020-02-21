<?php

	include'..\connection.php';


	session_start();
	$_SESSION['delRow'] = mysqli_real_escape_string($conn, $_POST['delRow']);

    header('Location: confirmDelete.php');
?>