<?php
    /* Attempt MySQL server connection. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
    session_start();
	
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'pinecott_medicall';
    $DATABASE_PASS = 'Medicall@123';
    $DATABASE_NAME = 'pinecott_medicallzn';
    // Try and connect using the info above.
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if ( mysqli_connect_errno() ) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    else{
        // Set Parameters
        
        // get id to delete
        $booking_number = $_POST['booking_number'];
        
        // connect to mysql
        $connect = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
        
        // mysql delete query 
        $query = "DELETE FROM `medic_bookings` WHERE `booking_number` = '$booking_number'";
        
        $result = mysqli_query($con, $query);
        
            if($result)
        {
            echo 'Appointment Deleted';
        }else{
            echo 'Data Not Deleted';
        }
        mysqli_close($co);
    }
    ?>