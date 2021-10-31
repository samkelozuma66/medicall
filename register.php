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
        $sql = "INSERT INTO user (user_id, status_id, type_id) VALUES (0 , 'user_active', 'USER_GENERAL' )";
                    
        $result=mysqli_multi_query($conn,$sql);
        if ($result) {
            $sql = "INSERT INTO user_login (user_id, username, password) VALUES (LAST_INSERT_ID(),'".$_POST['username']."','".$_POST['password']."')";
            
            $resultLogin=mysqli_multi_query($conn,$sql);
            if ($resultLogin) 
            {
                $sql = "INSERT INTO user_details (user_id, username, name, surname, id_number, Address, Medical_Aid_Name, Medical_Aid_Number, Medical_Aid_Conatct, User_Cellnumber) VALUES (LAST_INSERT_ID(), '".$_POST['username']."', '".$_POST['fullname']."', '', '', '', '', '', '', '".$_POST['phonenumber']."')";
                
                $resultDeails=mysqli_multi_query($conn,$sql);
                if ($resultDeails) 
                {
                    echo "username=".$_POST['username'];
                }
                else
                {
                    echo "Error: " . $sql . "\n" . $conn->error;
                }
            } 
            else 
            {
              echo "Error: " . $sql . "\n" . $conn->error;
            }
        } 
        else 
        {
          echo "Error: " . $sql . "\n" . $conn->error;
        }
        
        $conn->close();
        //exit();
    }
?>