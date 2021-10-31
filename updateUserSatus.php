<?php
    session_start();
    // Change this to your connection info.
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'pinecott_medicall';
    $DATABASE_PASS = 'Medicall@123';
    $DATABASE_NAME = 'pinecott_medicallzn';
    // Try and connect using the info above.
    $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if ( mysqli_connect_errno() ) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    else
    {
        $userid              = $_POST['userid'];
        $newstatus           = $_POST['statusid'];
        
        $sql = "UPDATE user SET status_id='".$newstatus."' WHERE user_id = ".$userid;
        echo ($sql);
        
        $result=mysqli_query($conn,$sql);
        if ($result) {
          echo "user_id=".$_POST['userid'];
        } else {
          echo "Error: " . $sql . "\n" . $conn->error;
        }
        
        $conn->close();
        //exit();
    }
?>