<?php
    session_start();
    // Change this to your connection info.
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
    else
    {
        $sql = "SELECT user.user_id, type_id, status_id ,username , name FROM user , user_details where type_id != 'USER_GENERAL' AND user_details.user_id = user.user_id ";
        if ($stmt = $con->prepare($sql)) 
            {
                // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
            	$stmt->execute();
            	// Store the result so we can check if the account exists in the database.
            	$stmt->store_result();
            	$stmt->bind_result($userId,$typeid,$statusid,$username,$name);
            	$json_array = array();
            	if($row = $stmt->num_rows > 0)
            	{
            	    while ($stmt->fetch())
            	    {
            	        $details->user_id            = $userId;
            	        $details->type_id            = $typeid;
            	        $details->status_id          = $statusid;
            	        $details->username           = $username;
            	        $details->name               = $name;
            	        $json_array[] = $details;
            	        unset($details);
            	    }
            	    echo (json_encode($json_array));
            	}
            	
            	
            }
        
    }
    
?>