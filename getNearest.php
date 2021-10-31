<?php
    function distance($lat1, $lon1, $lat2, $lon2, $unit) 
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        }
        else 
        {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);
        
            if ($unit == "K") 
            {
                return ($miles * 1.609344);
            } 
            else if ($unit == "N") 
            {
                return ($miles * 0.8684);
            } else 
            {
                return $miles;
            }
        }
    }

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
        
    	$userlat  = $_POST['latitude'];
    	$userlong = $_POST['longitude'];
    	$type     = $_POST['type'];
    	if(strcmp($type,"police") == 0)
    	{
    	    $sql = "SELECT user_id,address_lat,address_long FROM police where police_status ='emergency_online'  ";
    	}
    	else if(strcmp($type,"fire") == 0)
    	{
    	    $sql = "SELECT user_id,address_lat,address_long FROM firedepartment where firedepartment_status ='emergency_online'  ";
    	}
    	else if(strcmp($type,"ambulance") == 0)
    	{
    	    $sql = "SELECT user_id,address_lat,address_long FROM police where police_status ='emergency_online'  ";
    	}
    	else if(strcmp($type,"medical") == 0)
    	{
    	    $sql = "SELECT user_id,address_lat,address_long FROM medical_centre_details where medic_status ='emergency_online'  ";
    	}
    	
        if ($stmt = $con->prepare($sql)) 
            {
            	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
            	$stmt->execute();
            	// Store the result so we can check if the account exists in the database.
            	$stmt->store_result();
            	$stmt->bind_result($police_id,$address_lat,$address_long);
            	$json_array = array();
            	$pol_id = 0;
            	$dist   = 0;
            	$temp   = 0;
            	if($row = $stmt->num_rows > 0)
            	{
            	    while ($stmt->fetch())
            	    {
            	        
            	        $details->police_id              = $police_id;
            	        $details->address_lat            = $address_lat;
            	        $details->address_long           = $address_long;
            	        $json_array[] = $details;
            	        $temp = distance($userlat,$userlong,$address_lat,$address_long,'K');
            	        if($dist <> 0)
            	        {
            	            if($temp < $dist)
            	            {
            	                $dist   = $temp ;
            	                $pol_id = $police_id;
            	            }
            	        }
            	        else
            	        {
            	            $dist   = $temp ;
            	            $pol_id = $police_id;
            	        }
            	        
            	    }
            	    echo ($pol_id);
            	}
            	$stmt->close();
            	
            }
        
    }
    $con->close();
?>