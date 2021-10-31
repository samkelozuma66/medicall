<?php

// php code to Delete data from mysql database 

if(isset($_POST['delete']))
{
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'pinecott_medicall';
    $DATABASE_PASS = 'Medicall@123';
    $DATABASE_NAME = 'pinecott_medicallzn';
    
    // get id to delete
    $AdminId = $_POST['AdminId'];
    
    // connect to mysql
    $connect = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    
    // mysql delete query 
    $query = "DELETE FROM `AdminDetails` WHERE `AdminId` = '$AdminId'";
    
    $result = mysqli_query($connect, $query);
    
    if($result)
    {
        echo 'Data Deleted';
    }else{
        echo 'Data Not Deleted';
    }
    mysqli_close($connect);
}

?>