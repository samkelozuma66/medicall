
<?php


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
    // Prepare an insert statement
    // Set Parameters
        $P_name = mysqli_real_escape_string($con, $_REQUEST['P_name']);
        $P_surname = mysqli_real_escape_string($con, $_REQUEST['P_surname']);
        $P_number = mysqli_real_escape_string($con, $_REQUEST['P_number']);
        $P_age = mysqli_real_escape_string($con, $_REQUEST['P_age']);
        $P_address = mysqli_real_escape_string($con, $_REQUEST['P_address']);
        $request_status = mysqli_real_escape_string($con, $_REQUEST['request_status']);
        $_date1 = mysqli_real_escape_string($con, $_REQUEST['_date1']);
        $_date2 = mysqli_real_escape_string($con, $_REQUEST['_date2']);
        $_date3 = mysqli_real_escape_string($con, $_REQUEST['_date3']);
        $suitable_time = mysqli_real_escape_string($con, $_REQUEST['suitable_time']);
        $reason_comment = mysqli_real_escape_string($con, $_REQUEST['reason_comment']);
        $request_id = mysqli_real_escape_string($con, $_REQUEST['request_id']);
    $sql = "INSERT INTO AppointmentRequests ( request_id, P_name, P_surname,P_address, P_age, _date1, _date2, _date3,  reason_comment, P_number, suitable_time,request_status ,user_id , medic_id ) VALUES ( 0,'". $P_name ."', '". $P_surname ."',  '". $P_address ."', '". $P_age ."', '". $_date1 ."', '". $_date2 ."', '". $_date3 ."','". $reason_comment ."',  '". $P_number ."', '". $suitable_time ."', '". Pending ."', 0, 0)";
    echo($sql);
    if($stmt = mysqli_prepare($con, $sql)){
        // Bind variables to the prepared statement as parameters
        /*mysqli_stmt_bind_param($stmt, "ssssssssss", $patient_name, $patient_surname, $patient_number, $patient_address, $booking_status, $MedicalAid_name, $MedicalAid_number, $_date, $_time);
     */
        
     
    //* Attempt insert query execution
    //$sql = "INSERT INTO medic_bookings (patient_name, patient_surname, patient_number, patient_address, booking_status, MedicaAid_name, MedicalAid_number, _date, _time, booking_number) VALUES ('$patient_name', '$patient_surname', '$patient_number','$patient_address', '$booking_status', '$MedicalAid_name', '$MedicalAid_number',  '$_date', '$_time', '$booking_number')";
    
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            echo "Records inserted successfully.";
        } else{
            echo "ERROR: Could not execute query: $sql. " . mysqli_error($con);
        }
    } 
    else{
        echo "ERROR: Could not prepare query: $sql. " . mysqli_error($con);
    }
 
    // Close statement
    mysqli_stmt_close($stmt);
 
    // Close connection
    mysqli_close($con);
?>

    session_start();
    /*echo($_POST['user_Id']);
    // Change this to your connection info.
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'id16640623_sezmedicall';
    $DATABASE_PASS = 'Samu@zuma[]1';
    $DATABASE_NAME = 'id16640623_medicallzn';
    // Try and connect using the info above.
    $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if ( mysqli_connect_errno() ) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    else
    {
        $user_id = mysqli_real_escape_string($con, $_REQUEST['user_id']);
        if ($stmt = $conn->prepare(" INSERT INTO user_bookings (_date,_time,booking_status, user_id) SELECT _date, _time, booking_status FROM medic_bookings WHERE medic_bookings.user_id = '". $user_id ."'")) 
            {
                
            	$stmt->execute();
            	// Store the result so we can check if the account exists in the database.
            	$stmt->store_result();
            	$stmt->bind_result($_date,$_time,$booking_status,);
            	$json_array = array();
            	if($row = $stmt->num_rows > 0)
            	{
            	    while ($stmt->fetch())
            	    {
            	        //echo ("row ".$patient_name);
            	        $details->_date          = $_date;
            	        $details->_time       = $_time;
            	        $details->booking_status        = $booking_status;
            	        //$details->user_id       = $user_id;
            	        //echo (" row 2 ".$details.patient_name);
            	        $json_array[] = $details;
            	        unset($details);
            	    }
            	    echo (json_encode($json_array));
            	}
            }
    }
    $conn->close();
    exit();/*/

?>