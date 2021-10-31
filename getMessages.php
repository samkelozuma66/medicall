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
        $policeid = $_POST['policeid'];
        if ($stmt = $conn->prepare("SELECT user_id_from, message, message_status, msg_id , multimedia_string FROM message , multimedia WHERE user_id_to = '".$policeid."' AND 	message_id = msg_id ORDER BY message.message_status ASC , message.msg_id DESC ")) 
            {
                
            	$stmt->execute();
            	// Store the result so we can check if the account exists in the database.
            	$stmt->store_result();
            	$stmt->bind_result($userI,$message,$messageStatus,$msgid,$multimedia_string);
            	$json_array = array();
            	if($row = $stmt->num_rows > 0)
            	{
            	    while ($stmt->fetch())
            	    {
            	        //echo ("row ".$message);$myObj->name
            	        $details->user_id_from  = $userI;
            	        $details->message       = $message;
            	        $details->message_status = $messageStatus;
            	        $details->msg_id = $msgid;
            	        $details->multimedia_string = $multimedia_string;
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