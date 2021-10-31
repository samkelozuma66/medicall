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
        $usertype           = $_POST['usertype'];
        $username           = $_POST['username'];
        $password           = $_POST['password'];
        $description        = $_POST['fullname'];
        $address            = $_POST['address'];
        $lat                = $_POST['lat'];
        $long               = $_POST['long'];
        
        $docType            = $_POST['docType'];
        $linkID             = $_POST['linkID'];
        $sql = "INSERT INTO user (user_id, status_id, type_id) VALUES (0 , 'user_active', '".$usertype."' )";
                    
        $result=mysqli_multi_query($conn,$sql);
        if ($result) {
            $sql = "INSERT INTO user_login (user_id, username, password) VALUES (LAST_INSERT_ID(),'".$username."','".$password."')";
            
            $resultLogin=mysqli_multi_query($conn,$sql);
            if ($resultLogin) 
            {
                $sql = "INSERT INTO user_details (user_id, username, name, surname, id_number, Address, Medical_Aid_Name, Medical_Aid_Number, Medical_Aid_Conatct, User_Cellnumber) VALUES (LAST_INSERT_ID(), '".$username."', '".$description."', '', '', '', '', '', '', '')";
                
                $resultDeails=mysqli_multi_query($conn,$sql);
                if ($resultDeails) 
                {
                    if  ($usertype == "USER_POLICE")
                    {
                        $sql = "INSERT INTO police (police_id,user_id, police_name, police_address, address_lat, address_long, police_status) VALUES (0,LAST_INSERT_ID(), '".$description."', '".$address."', '".$lat."', '".$long."', 'emergency_online')";
                    }
                    else if($usertype == "USER_AMBULANCE")
                    {
                        $sql = "INSERT INTO ambulance (ambulance_id,user_id, ambulance_name, ambulance_address, address_lat, address_long, ambulance_status) VALUES (0,LAST_INSERT_ID(), '".$description."', '".$address."', '".$lat."', '".$long."', 'emergency_online')";
                    }
                    else if($usertype == "USER_FIRE")
                    {
                        $sql = "INSERT INTO firedepartment (firedepartment_id,user_id, firedepartment_name, firedepartment_address, address_lat, address_long, firedepartment_status) VALUES (0,LAST_INSERT_ID(), '".$description."', '".$address."', '".$lat."', '".$long."', 'emergency_online')";
                    }
                    else if($usertype == "USER_MEDICENTER")
                    {
                        $sql = "INSERT INTO medical_centre_details (medic_id,user_id, medic_name, medic_address, address_lat, address_long, medic_status) VALUES (0,LAST_INSERT_ID(), '".$description."', '".$address."', '".$lat."', '".$long."', 'emergency_online')";
                    }
                    else if($usertype == "USER_DOCTOR")
                    {
                        $sql = "INSERT INTO doctor (doctor_id,user_id, 	doctor_name,doctor_address,doctor_type) VALUES (0,LAST_INSERT_ID(), '".$description."', '".$address."' , '".$docType."')";
                        
                        $sql4 = "INSERT INTO user_link (user_id,user_id_linked,link_desription) VALUES (LAST_INSERT_ID(), '".$linkID."', 'DOCTOR_MEDICENTER')";
                        $resultEmerg4=mysqli_multi_query($conn,$sql4);
                        if ($resultEmerg4) 
                        {
                           //echo "username=".$_POST['username'];
                        }
                        else
                        {
                            echo "Error: " . $sql4 . "\n" . $conn->error;
                        }
                        
                    }
                    //medical_centre_details
                    $resultEmerg=mysqli_multi_query($conn,$sql);
                    if ($resultEmerg) 
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
        } 
        else 
        {
          echo "Error: " . $sql . "\n" . $conn->error;
        }
        
        $conn->close();
        //exit();
    }
?>