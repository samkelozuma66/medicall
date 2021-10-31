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
        if ( !isset($_POST['userid']) ) {
        	// Could not get the data that should have been sent.
        	exit('Please fill user id!');
        }
        else
        {   
            $userid = $_POST['userid'];
            if ($stmt = $con->prepare('SELECT type_id, status_id FROM user WHERE user_id = ?')) 
            {
            	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
            	$stmt->bind_param('i', $userid);
            	$stmt->execute();
            	// Store the result so we can check if the account exists in the database.
            	$stmt->store_result();
            	if($stmt->num_rows > 0)
            	{
            	    
            	    $stmt->bind_result($typeid,$statusid);
                	$stmt->fetch();
                	
            	    /*session_regenerate_id();
            		$_SESSION['loggedin'] = TRUE;
            		$_SESSION['loggedInUsername'] = $username;
            		$_SESSION['loggedInUserId']   = $userid;
            		
            		$return_arr[] = array(  "loggedin" => $_SESSION['loggedin'],
                                            "username" => $_SESSION['loggedInUsername'],
                                            "userId" => $userid,
                                            "password" => $password);
                                            
            		echo json_encode($return_arr);*/
            		
            		echo $typeid.",".$statusid;
            		$con->close();
                	
            	    
            	}
            	else 
            	{
                	// Incorrect username
                	echo '0';
                }
                $stmt->close();
            }
            
        }
    }
    $con->close();
    
?>