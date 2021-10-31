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
        $status              = $_POST['status'];
        $type                = $_POST['type'];
        $emergencyId         = $_POST['emergrncyId'];
        
        if(strcmp($type,"police") == 0)
    	{
    	    $sql = "UPDATE police SET police_status ='". $status ."' WHERE police_id = ".$emergencyId;
    	}
    	else if(strcmp($type,"fire") == 0)
    	{
    	    $sql =  "UPDATE firedepartment SET firedepartment_status = '". $status ."' WHERE firedepartment_id = ".$emergencyId;
    	}
    	else if(strcmp($type,"ambulance") == 0)
    	{
    	    $sql = "UPDATE police SET police_status = '". $status ."' WHERE police_id = ".$emergencyId;
    	}
    	else if(strcmp($type,"medical") == 0)
    	{
    	    $sql = "UPDATE police SET police_status = '". $status ."' WHERE police_id = ".$emergencyId;
    	}
    	
        
        $result=mysqli_query($conn,$sql);
        if ($result) {
          echo "emergencyid=".$_POST['emergrncyId'];
        } else {
          echo "Error: " . $sql . "\n" . $conn->error;
        }
        
        $conn->close();
        //exit();
    }
?>