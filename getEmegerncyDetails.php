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
        $username = $_POST['username'];
        $usertype = $_POST['usertype'];
        if($usertype == "USER_POLICE")
        {
            
            $sql = "SELECT user_login.user_id , police.police_id , police.police_name , police.police_address , police.address_lat , police.address_long , police.police_status FROM user_login , police WHERE user_login.username = '".$username."' AND police.user_id = user_login.user_id";
            
            if ($stmt = $con->prepare($sql)) 
            {
            // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
            //$username = $_POST['username'];
            //$stmt->bind_param('s', $username);
            $stmt->execute();
            // Store the result so we can check if the account exists in the database.
            $stmt->store_result();
            
            $stmt->bind_result($userId,$police_id ,$police_name,$police_address,$address_lat,$address_long,$police_status);
            $json_array = array();
                if($row = $stmt->num_rows > 0)
                {
                    while ($stmt->fetch())
                    {
                        $details->user_id        = $userId;
                        $details->police_id      = $police_id;
                        $details->police_name    = $police_name;
                        $details->police_address = $police_address;
                        $details->address_lat    = $address_lat;
                        $details->address_long   = $address_long;
                        $details->police_status  = $police_status;
                        $json_array[] = $details;
                    }
                    echo (json_encode($json_array));
               }
            }
            else 
            {
              echo "Error: " . $sql . "\n" . $con->error;
            }
        }
        
        //if pressed ambulance
        else if($usertype == "USER_MEDICENTER")
        {
            $sql = "SELECT user_login.user_id , medical_centre_details.medic_id , medical_centre_details.medic_name , medical_centre_details.medic_address , medical_centre_details.address_lat , medical_centre_details.address_long , medical_centre_details.medic_status FROM user_login , medical_centre_details WHERE user_login.username = '".$username."' AND medical_centre_details.user_id = user_login.user_id";
            if ($stmt = $con->prepare($sql)) 
            {
            // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
            //$username = $_POST['username'];
            //$stmt->bind_param('s', $username);
            $stmt->execute();
            // Store the result so we can check if the account exists in the database.
            $stmt->store_result();
            
            $stmt->bind_result($userId,$medic_id ,$medic_name,$medic_address,$address_lat,$address_long,$medic_status);
            $json_array = array();
                if($row = $stmt->num_rows > 0)
                {
                    while ($stmt->fetch())
                    {
                        $details->user_id        = $userId;
                        $details->police_id      = $medic_id;
                        $details->police_name    = $medic_name;
                        $details->police_address = $medic_address;
                        $details->address_lat    = $address_lat;
                        $details->address_long   = $address_long;
                        $details->police_status  = $medic_status;
                        $json_array[] = $details;
                    }
                    echo (json_encode($json_array));
                }
            }
            else 
            {
              echo "Error: " . $sql . "\n" . $con->error;
            }
        }
        else if($usertype == "USER_DOCTOR")
        {
            $sql = "SELECT user_login.user_id , doctor.doctor_id , doctor.doctor_name , doctor.doctor_address, doctor_type FROM user_login , doctor WHERE user_login.username = '".$username."' AND doctor.user_id = user_login.user_id";
            if ($stmt = $con->prepare($sql)) 
            {
            // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
            //$username = $_POST['username'];
            //$stmt->bind_param('s', $username);
            $stmt->execute();
            // Store the result so we can check if the account exists in the database.
            $stmt->store_result();
            
            $stmt->bind_result($userId,$medic_id ,$medic_name,$medic_address,$type);
            $json_array = array();
                if($row = $stmt->num_rows > 0)
                {
                    while ($stmt->fetch())
                    {
                        $details->user_id        = $userId;
                        $details->police_id      = $medic_id;
                        $details->police_name    = $medic_name;
                        $details->police_address = $medic_address;
                        $details->address_lat    = "";
                        $details->address_long   = "";
                        $details->police_status  = "";
                        $details->doctor_type    = $type  ;
                        $json_array[] = $details;
                    }
                    echo (json_encode($json_array));
                }
            }
            else 
            {
              echo "Error: " . $sql . "\n" . $con->error;
            }
        }
        else if($usertype == "USER_FIRE")
        {
            $sql = "SELECT user_login.user_id , firedepartment.firedepartment_id , firedepartment.firedepartment_name , firedepartment.firedepartment_address , firedepartment.address_lat , firedepartment.address_long , firedepartment.firedepartment_status FROM user_login , firedepartment WHERE user_login.username = '".$username."' AND firedepartment.user_id = user_login.user_id";
            if ($stmt = $con->prepare($sql)) 
            {
            // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
            //$username = $_POST['username'];
            //$stmt->bind_param('s', $username);
            $stmt->execute();
            // Store the result so we can check if the account exists in the database.
            $stmt->store_result();
            
            $stmt->bind_result($userId,$medic_id ,$medic_name,$medic_address,$address_lat,$address_long,$medic_status);
            $json_array = array();
                if($row = $stmt->num_rows > 0)
                {
                    while ($stmt->fetch())
                    {
                        
                        $details->user_id        = $userId;
                        $details->police_id      = $medic_id;
                        $details->police_name    = $medic_name;
                        $details->police_address = $medic_address;
                        $details->address_lat    = $address_lat;
                        $details->address_long   = $address_long;
                        $details->police_status  = $medic_status;
                        $json_array[] = $details;
                    }
                    echo (json_encode($json_array));
                }
            }
            else 
            {
              echo "Error: " . $sql . "\n" . $con->error;
            }
        }
        else
        {
            echo("pol");
        }
        
        
        
        
    }
    
?>