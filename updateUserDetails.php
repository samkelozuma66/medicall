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
        $userid              = $_POST['userid'];
        $userName            = $_POST['userName'];
        $userSurname         = $_POST['userSurname'];
        $userIdNumber        = $_POST['userIdNumber'];
        $userAddress         = $_POST['userAddress'];
        $userMedicalAidName  = $_POST['userMedicalAidName'];
        $MedicalAidNumber    = $_POST['MedicalAidNumber'];
        $MedicalAidConatct   = $_POST['MedicalAidConatct']; 
        $cellnumber          = $_POST['cellnumber'];
        $sql = "UPDATE user_details SET name='".$userName."',surname='".$userSurname."',id_number='".$userIdNumber."',Address='".$userAddress."',Medical_Aid_Name='".$userMedicalAidName."',Medical_Aid_Number='".$MedicalAidNumber."',Medical_Aid_Conatct='".$MedicalAidConatct."', User_Cellnumber='".$cellnumber."' WHERE user_id = ".$userid;
        
        $result=mysqli_query($conn,$sql);
        if ($result) {
          echo "username=".$_POST['username'];
        } else {
          echo "Error: " . $sql . "\n" . $conn->error;
        }
        
        $conn->close();
        //exit();
    }
?>