<?php   

    require('connection.php');

    //Create Query
    $query = 'SELECT * FROM client_booking';
   
    // Get Result
    $result = mysqli_query($conn, $query);

    // Fetch Data
    $bookings = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Free Result
    mysqli_free_result($result);

    // Close Connection
    mysqli_close($conn);

?>

<?php include('inc/header.php'); ?>

    <div class="container">
        <h1>Posts</h1>
        <?php foreach($bookings as $booking): ?>
            <div class='well'>
                <h3><?php echo $booking['DATE']; ?></h3>
                <small>booked by <?php echo $booking['UNAME'] ?>
              
            </div>
        <?php endforeach; ?>
    </div>

<?php include('inc/footer.php'); ?>