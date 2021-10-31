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
        if ($stmt = $conn->prepare('SELECT Patient_name, Patient_surname, Patient_address, booking_status, MedicalAid_Name, MedicalAid_Number, _date, _time, booking_number FROM medic_bookings WHERE user_id = ?')) 
            {
                	$user_id = $_POST['user_id'];
            	$stmt->bind_param('s', $user_id);
            	$stmt->execute();
            	// Store the result so we can check if the account exists in the database.
            	$stmt->store_result();
            	$stmt->bind_result($Patient_name, $Patient_surname,$Patient_address,$booking_status, $MedicalAid_Name, $MedicalAid_Number,$_date,$_time, $booking_number);
            	$json_array = array();
            	if($row = $stmt->num_rows > 0)
            	{
            	    while ($stmt->fetch())
            	    {
            	        //echo ("row ".$patient_name);
            	        $details->Patient_name          = $Patient_name;
            	        $details->Patient_surname       = $Patient_surname;
            	        $details->Patient_number        = $Patient_number;
            	        $details->Patient_address       = $Patient_address;
            	        $details->booking_status  = $booking_status;
            	        $details->MedicalAid_Name          = $MedicalAid_Name;
            	        $details->MedicalAid_Number          = $MedicalAid_Number;
            	        $details->_date          = $_date;
            	         $details->_time          = $_time;
            	        $details->booking_number  = $booking_number ;
            	       
            	        //echo (" row 2 ".$details.patient_name);
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