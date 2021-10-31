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
        $patient_name = mysqli_real_escape_string($con, $_REQUEST['patient_name']);
        $patient_surname = mysqli_real_escape_string($con, $_REQUEST['patient_surname']);
        $Patient_number = mysqli_real_escape_string($con, $_REQUEST['patient_number']);
        $patient_address = mysqli_real_escape_string($con, $_REQUEST['patient_address']);
        $booking_status = mysqli_real_escape_string($con, $_REQUEST['booking_status']);
        $MedicalAid_name = mysqli_real_escape_string($con, $_REQUEST['MedicalAid_name']);
        $MedicalAid_number = mysqli_real_escape_string($con, $_REQUEST['MedicalAid_number']);
        $_date = mysqli_real_escape_string($con, $_REQUEST['_date']);
        $_time = mysqli_real_escape_string($con, $_REQUEST['_time']);
        $booking_number = mysqli_real_escape_string($con, $_REQUEST['booking_number']);
        $user_id = mysqli_real_escape_string($con, $_REQUEST['user_id']);
        $medic_id = mysqli_real_escape_string($con, $_REQUEST['medic_id']);
    $sql = "INSERT INTO medic_bookings (patient_name, patient_surname, patient_number, patient_address, booking_status, MedicalAid_name, MedicalAid_number, _date, _time, booking_number, user_id, medic_id ) VALUES ('". $patient_name ."', '". $patient_surname ."', '". $patient_number ."', '". $patient_address ."', '". $booking_status ."', '". $MedicalAid_name ."', '". $MedicalAid_number ."', '". $_date ."', '". $_time ."', null,".$user_id.",".$medic_id.")";
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