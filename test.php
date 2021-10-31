<?php
    /*$parameter = $_SERVER['QUERY_STRING'];
    echo "PARAMETER ". $parameter;
    echo "welcome" ;
    echo " name ". htmlspecialchars($_POST["name"]); 
    echo "<br />";
    $Url = $_GET['state']."#".$_GET['city'];
    $Query_String  = explode("&", $parameter );
    echo $Query_String[1];*/
    function getaddress($lat,$lng)
    {
         $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';
         $json = @file_get_contents($url);
         $data=json_decode($json);
         $status = $data->status;
         if($status=="OK")
         {
           return $data->results[0]->formatted_address;
         }
         else
         {
           return false;
         }
    }
    session_start();
    // Change this to your connection info.
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'pinecott_medicall';
    $DATABASE_PASS = 'Medicall@123';
    $DATABASE_NAME = 'pinecott_medicallzn';
    // Try and connect using the info above.
    $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if ( $conn->connect_error) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    else 
    {   
        
        //echo ($_POST['Type']);
        $link = "<a href=''https://www.google.com/maps/search/?api=1&query=" . $_POST['latitude'] . "%2C" . $_POST['longitude'] ."'' target=''_blank'' > open location</>";
        $msg = "EMERGENCY ALERT \n ".$_POST['name']." ".$_POST['surname']." \n Home Address: ".$_POST['userAddress']."  \n Current LatLong Address: lat " . $_POST['latitude'] . " and long " . $_POST['longitude'] ." \n Contact Number : ".$_POST['UserCellnumber']." \n Note : ".$_POST['note'] . "  ".$link ;
        /*$msg = $_POST['username'] . " is at latitude " . $_POST['latitude'] . " and longitude " . $_POST['longitude'] . "physical address ".getaddress($_POST['latitude'],$_POST['longitude'])." have an emegency Type ".$_POST['Type']." with note " . $_POST['note'] ; userid*/
        $sql = "INSERT INTO message (msg_id, user_id_from, user_id_to, message,message_status) VALUES (NULL , '".$_POST['userid']."' , '".$_POST['policeid']."' , '" . $msg ."', 'message_new')";
        //message_new
        $result=mysqli_query($conn,$sql);
        //echo ("result ".mysqli_error($conn));
        //echo ("\n");
        if ($result) {
            $sql1 = "SELECT LAST_INSERT_ID() , user_id_from from message where msg_id = LAST_INSERT_ID()  LIMIT 1 ";
            
            if ($stmt = $conn->prepare($sql1)) 
            {
                // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
            	$stmt->execute();
            	// Store the result so we can check if the account exists in the database.
            	$stmt->store_result();
            	$stmt->bind_result($userId,$msgId);
            	$json_array = array();
            	if($row = $stmt->num_rows > 0)
            	{
            	    while ($stmt->fetch())
            	    {
            	        $details->msg_id            = $userId;
            	        $details->user_id            = $msgId;
            	        
            	        $json_array[] = $details;
            	        unset($details);
            	    }
            	    echo (json_encode($json_array));
            	}
            	
            	
            }
            //$result=mysqli_query($conn,$sql);
          //echo "New record created successfully";
        } else {
          echo "Error: " . $sql . "\n" . $conn->error;
        }
        
        $conn->close();
        exit();
   }
?>
