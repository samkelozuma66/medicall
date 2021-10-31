<?php
    /* Attempt MySQL server connection. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
    session_start();
	
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
        $InstitutionName = mysqli_real_escape_string($con, $_REQUEST['InstitutionName']);
        $InstitutionEmail = mysqli_real_escape_string($con, $_REQUEST['InstitutionEmail']);
        $AdminMobile = mysqli_real_escape_string($con, $_REQUEST['AdminMobile']);
        $Address = mysqli_real_escape_string($con, $_REQUEST['Address']);
         $AddressLat = mysqli_real_escape_string($con, $_REQUEST['AddressLat']);
         $AddressLong = mysqli_real_escape_string($con, $_REQUEST['AddressLong']);
        $Status= mysqli_real_escape_string($con, $_REQUEST['Status']);

        $AdminPassword = mysqli_real_escape_string($con, $_REQUEST['AdminPassword']);
        //$usertype = mysqli_real_escape_string($con, $_REQUEST['usertype']);
        $UserID = mysqli_real_escape_string($con, $_REQUEST['UserID']);
        
        

    // Prepare an insert statement
    $sql = "INSERT INTO AdminDetails (InstitutionName, InstitutionEmail, AdminMobile, Address, AddressLat, AddressLong, Status, AdminPassword,UserID ) VALUES ('". $InstitutionName ."','". $InstitutionEmail ."' ,'". $AdminMobile ."' ,'". $Address ."' ,'". $AddressLat ."' ,'". $AddressLong ."' ,'". $Status ."' , '". $AdminPassword ."','$UserID')";
    echo($sql);
 
 
    if($stmt = mysqli_prepare($con, $sql)){
         
       
    
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
           echo ("Insert on Admin Executed Successfully");
           //header("Location:AdminProfile.php/showNewAddedAdminIndex.html");
           //exit();
        } else{
            echo "ERROR: Could not execute query: $sql. " . mysqli_error($con);
        }
 
        }
   
    
    else{
        echo "ERROR: Could not prepare query: $sql. " . mysqli_error($con);
    }
    
    
    // Close statement
    mysqli_stmt_close($stmt);
    
 

 
    // Close connection
    mysqli_close($con);
    ?>