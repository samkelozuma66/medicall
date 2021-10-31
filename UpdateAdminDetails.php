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
        $AdminId =  $_POST['AdminId'];
        $InstitutionName = $_POST['InstitutionName'];
        $InstitutionEmail =  $_POST['InstitutionEmail'];
        $AdminMobile =  $_POST['AdminMobile'];
        $Address =  $_POST['Address'];
         $AddressLong =  $_POST['AddressLat'];
         $AddressLat =  $_POST['AddressLong'];
         $Status = $_POST['Status'];
        $AdminPassword =  $_POST['AdminPassword'];
        
        // $msgid              = $_POST['msg_id'];
       // $sql = "UPDATE 'AdminDetails' SET AdminFullName= ('". $AdminFullName ."',AdminEmail='". $AdminEmail ."' ,AdminMobile='". $AdminMobile ."',AdminAddress='". $AdminAddress ."',AdminPassword='$AdminPassword' WHERE`AdminId` = '$AdminId'";
       
         $sql=" UPDATE AdminDetails SET InstitutionName = '". $InstitutionName ."', InstitutionEmail = '".$InstitutionEmail."',AdminMobile = '". $AdminMobile ."',Address =  '". $Address ."',AddressLat =  '". $AddressLat ."',AddressLong =  '". $AddressLong ."',Status =  '". $Status ."',AdminPassword = '". $AdminPassword ."'  WHERE `AdminId` = ".$AdminId;
        echo ($sql);
        
        $result=mysqli_query($conn,$sql);
        if ($result) {
          echo "Updated Successfully";
        } else {
          echo "Error: " . $sql . "\n" . $conn->error;
        }
        
        $conn->close();
        //exit();
    }
?>