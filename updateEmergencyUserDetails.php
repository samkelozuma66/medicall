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
        $userid              = $_POST['userid'];
        $type                = $_POST['type'];
        $name                = $_POST['name'];
        $address             = $_POST['address'];
        $lat                 = $_POST['lat'];
        $long                = $_POST['long'];
        if($type == "USER_POLICE")
        {
             
            $sql = "UPDATE police SET police_name='". $name ."' , police_address='". $address ."', address_lat='". $lat ."', address_long='". $long ."' WHERE user_id = '".$userid."'";
            
            $result=mysqli_query($conn,$sql);
            if ($result) {
              echo "emergencyid=".$_POST['emergrncyId'];
            } else {
              echo "Error: " . $sql . "\n" . $conn->error;
            }
        
        }
        
        //if pressed ambulance
        else if($type == "USER_MEDICENTER")
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
        }
        else if($type == "USER_FIRE")
        {
            $sql = "SELECT user_login.user_id , firedepartment.medic_id , firedepartment.medic_name , firedepartment.medic_address , firedepartment.address_lat , firedepartment.address_long , firedepartment.medic_status FROM user_login , firedepartment WHERE user_login.username = '".$username."' AND firedepartment.user_id = user_login.user_id";
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
                        $details->medic_id      = $medic_id;
                        $details->medic_name    = $medic_name;
                        $details->medic_address = $medic_address;
                        $details->address_lat    = $address_lat;
                        $details->address_long   = $address_long;
                        $details->medic_status  = $medic_status;
                        $json_array[] = $details;
                    }
                    echo (json_encode($json_array));
                }
            }
        }
        else
        {
            echo("pol");
        }
        
        $conn->close();
        //exit();
    }
?>