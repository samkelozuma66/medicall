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
        $card_id     = $_REQUEST['card_id'];
        $document       = $_REQUEST['documentR'];
        $note    = $_REQUEST['note'];
        
        $sql = "INSERT INTO card_record (	card_record_id, card_id, document, note) VALUES (0 , '".$card_id."', '".$document."', '".$note."')";
                    
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