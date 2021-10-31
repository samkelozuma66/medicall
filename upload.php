<?php
    // Check if the form was submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Check if file was uploaded without errors
        if(isset($_FILES["file"]) && $_FILES["file"]["error"] == 0){
            
            $temp_name  = $_REQUEST['infilename'];
            echo($temp_name);
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png", "pdf" => "application/pdf", "PDF" => "application/PDF");
            $filename = $_FILES["file"]["name"];
            $filetype = $_FILES["file"]["type"];
            $filesize = $_FILES["file"]["size"];
            echo($filetype);
            // Verify file extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
        
            // Verify file size - 5MB maximum
            $maxsize = 5 * 1024 * 1024;
            if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
        
            // Verify MYME type of the file
            if(in_array($filetype, $allowed)){
                // Check whether file exists before uploading it
                if(file_exists("uploads/" . $filename)){
                    echo $filename . " is already exists.";
                } else{
                    move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $temp_name);
                    echo "Your file was uploaded successfully.";
                } 
            } else{
                echo "Error: There was a problem uploading your file. Please try again."; 
            }
        } else{
            echo "Error: " . $_FILES["file"]["error"];
        }
    }
?>