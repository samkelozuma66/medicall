<?php
    session_start();
    
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'pinecott_medicall';
    $DATABASE_PASS = 'Medicall@123';
    $DATABASE_NAME = 'pinecott_medicallzn';
    
    $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if ( mysqli_connect_errno() ) {
        
    	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    else
    { 
        $message_id           = $_REQUEST['message_id'];
        $multimedia_string           = $_REQUEST['multimedia_string'];
        $sql = "INSERT INTO multimedia (multimedia_id, message_id, multimedia_string) VALUES (0 , '".$message_id."', '".$multimedia_string."' )";
                    
        $result=mysqli_multi_query($conn,$sql);
        if ($result)
        {
            echo($result);
                    
        } 
        else 
        {
          echo "Error: " . $sql . "\n" . $conn->error;
        }
        
        $conn->close();
        //exit();
    }
?>