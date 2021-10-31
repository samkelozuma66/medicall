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
        
        if ($stmt = $con->prepare('SELECT user_id,medic_id,medic_name,medic_address,medic_status FROM medical_centre_details WHERE username= ?')) 
            {
            	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
            	$username = $_POST['username'];
            	//$medic_id = $_POST['medic_id'];
            	$stmt->bind_param('s', $username);//username
            	$stmt->execute();
            	// Store the result so we can check if the account exists in the database.
            	$stmt->store_result();
            	$stmt->bind_result($user_id,$medic_id,$medic_name,$medic_address,$medic_status);
            	$json_array = array();
            	if($row = $stmt->num_rows > 0)
            	{
            	    while ($stmt->fetch())
            	    {
            	        $details->user_id              = $user_id;
            	        $details->medic_id              = $medic_id;
            	        $details->medic_name                 = $medic_name;
            	        $details->medic_address              = $medic_address;
            	        $details->medic_status             = $medic_status;
            	        $json_array[] = $details;
            	    }
            	    echo (json_encode($json_array));
            	}
            	
            	
            }
        
    }
    
?>