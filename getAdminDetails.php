<?php

    session_start();
    //echo($_POST['user_Id']);
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
        if ($stmt = $conn->prepare('SELECT AdminId, InstitutionName, InstitutionEmail, AdminMobile, Address,AddressLat,AddressLong, Status, AdminPassword, UserID FROM AdminDetails')) 
            {
                
            	$stmt->execute();
            	// Store the result so we can check if the account exists in the database.
            	$stmt->store_result();
            	$stmt->bind_result($AdminId,$InstitutionName,$InstitutionEmail,$AdminMobile,$Address,$AddressLat,$AddressLong,$Status,$AdminPassword,$UserID);
            	$json_array = array();
            	if($row = $stmt->num_rows > 0)
            	{
            	    while ($stmt->fetch())
            	    {
            	        //echo ("row ".$AdminFullName);
            	        $details->AdminId         = $AdminId;
            	        $details->InstitutionName          = $InstitutionName;
            	        $details->InstitutionEmail       = $InstitutionEmail;
            	        $details->AdminMobile        = $AdminMobile;
            	        $details->Address        = $Address;
            	        $details->AddressLat        = $AddressLat;
            	         $details->AddressLong        = $AddressLong;
            	          $details->Status        = $Status;
            	        $details->AdminPassword       = $AdminPassword;
            	         $details->UserID       = $UserID;
            	        
            	        //echo (" row 2 ".$details.$AdminFullName);
            	        $json_array[] = $details;
            	        unset($details);
            	    }
            	    echo (json_encode($json_array));
            	}
            }
    }
    $conn->close();
    exit();

?>