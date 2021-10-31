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
        $id = $_REQUEST['id_number'];
        if ($stmt = $con->prepare('SELECT user.user_id,name,surname,id_number,Address,Medical_Aid_Name,Medical_Aid_Number, Medical_Aid_Conatct, User_Cellnumber FROM user , user_details where type_id = "USER_GENERAL" AND user_details.user_id = user.user_id AND id_number LIKE "%'.$id.'%"')) 
            {
            	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
            	//$username = $_POST['username'];
            	//$stmt->bind_param('s', $username);
            	$stmt->execute();
            	// Store the result so we can check if the account exists in the database.
            	$stmt->store_result();
            	$stmt->bind_result($userId,$name,$surname,$id_number,$Address,$Medical_Aid_Name,$Medical_Aid_Number,$Medical_Aid_Conatct,$User_Cellnumber);
            	$json_array = array();
            	if($row = $stmt->num_rows > 0)
            	{
            	    while ($stmt->fetch())
            	    {
            	        $details->user_id              = $userId;
            	        $details->name                 = $name;
            	        $details->surname              = $surname;
            	        $details->id_number            = $id_number;
            	        $details->Address              = $Address;
            	        $details->Medical_Aid_Name     = $Medical_Aid_Name;
            	        $details->Medical_Aid_Number   = $Medical_Aid_Number;
            	        $details->Medical_Aid_Conatct  = $Medical_Aid_Conatct;
            	        $details->User_Cellnumber      = $User_Cellnumber;
            	        $json_array[] = $details;
            	        unset($details);
            	    }
            	    echo (json_encode($json_array));
            	}
            	
            	
            }
        
    }
    
?>