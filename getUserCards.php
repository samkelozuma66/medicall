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
        $user_id      = $_REQUEST['user_id'];
        if ($stmt = $con->prepare('SELECT card_id, user_id , doc_id , physical_card_number	, note , card_type FROM card where user_id = "'.$user_id.'" ')) 
            {
            	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
            	//$username = $_POST['username'];
            	//$stmt->bind_param('s', $username);
            	$stmt->execute();
            	// Store the result so we can check if the account exists in the database.
            	$stmt->store_result();
            	$stmt->bind_result($card_id,$userId,$doc_id,$physical_card_number,$note,$card_type);
            	$json_array = array();
            	if($row = $stmt->num_rows > 0)
            	{
            	    while ($stmt->fetch())
            	    {
            	        $details->card_id              = $card_id;
            	        $details->user_id              = $userId;
            	        $details->doc_id               = $doc_id;
            	        $details->card_number          = $physical_card_number;
            	        $details->note                 = $note;
            	        $details->card_type            = $card_type;
            	        $json_array[] = $details;
            	        unset($details);
            	    }
            	    echo (json_encode($json_array));
            	}
            	
            	
            }
        
    }
    
?>