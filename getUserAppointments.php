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
        if ($stmt = $con->prepare('SELECT P_name,P_surname,P_number,P_age,P_address,request_status,_date1,_date2, _date3, suitable_time,reason_comment FROM AppointmentRequests' )) 
            {
                
            	$stmt->execute();
            	// Store the result so we can check if the account exists in the database.
            	$stmt->store_result();
            	$stmt->bind_result($P_name,$P_surname,$P_number,$P_age,$P_address,$request_status,$_date1,$_date2,$_date3,$suitable_time,$reason_comment);
            	$json_array = array();
            	if($row = $stmt->num_rows > 0)
            	{
            	    while ($stmt->fetch())
            	    {
            	        //echo ("row ".$AdminFullName);
            	       $details->P_name              = $P_name;
            	        $details->P_surname                 = $P_surname;
            	        $details->P_number              = $P_number;
            	        $details->P_age            = $P_age;
            	        $details->P_address              = $P_address;
            	        $details->request_status     = $request_status;
            	        $details->_date1   = $_date1;
            	        $details->_date2  = $_date2;
            	        $details->_date3      = $_date3;
            	         $details->suitable_time      = $suitable_time;
            	         $details->reason_comment      = $reason_comment;
            	        $json_array[] = $details;
            	        
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