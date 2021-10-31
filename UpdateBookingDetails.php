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
        $booking_number     = $_POST['booking_number'];
        $_date              = $_POST['_date'];
        $_time              = $_POST['_time'];
        $patient_name       = $_POST['patient_name'];
        $patient_surname    = $_POST['patient_surname'];
        $patient_number     = $_POST['patient_number'];
        $patient_address    = $_POST['patient_address'];
        $MedicalAidName     = $_POST['MedicalAidName'];
        $MedicalAidNumber   = $_POST['MedicalAidNumber'];
        //$MedicalAidConatct   = $_POST['MedicalAidConatct'];
        $sql = "UPDATE medic_bookings SET _date='".$_date."',_time='".$_time."',patient_surname='".$patient_surname."',patient_name='".$patient_name."',patient_number='".$patient_number."',Medical_Aid_Name='".$userMedicalAidName."',Medical_Aid_Number='".$MedicalAidNumber."',patient_address='".$patient_address."' WHERE booking_number = ".$booking_number;
        echo ($sql);
        
        $result=mysqli_query($conn,$sql);
        if ($result) {
          echo "username=".$_POST['username'];
        } else {
          echo "Error: " . $sql . "\n" . $conn->error;
        }
        
        $conn->close();
        //exit();
    }
?>