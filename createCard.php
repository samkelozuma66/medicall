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
        $user_id      = $_REQUEST['user_id'];
        $doc_id       = $_REQUEST['doc_id'];
        $card_number  = $_REQUEST['card_number'];
        $card_note    = $_REQUEST['card_note'];
        
        $sql = "INSERT INTO card (card_id, user_id , doc_id , physical_card_number	, note) VALUES (0 , '".$user_id."', '".$doc_id."', '".$card_number."', '".$card_note."' )";
                    
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