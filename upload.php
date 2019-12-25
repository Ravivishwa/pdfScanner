<?php
// Include the database configuration file
include('functions.php');
$statusMsg = '';

// File upload path
$userid = $_SESSION['user']['id'];
$targetDir = "uploads/".$userid ;
// var_dump($targetDir);die;
if(!is_dir($targetDir)) 
    {
        echo "string";
        mkdir($targetDir, 0777, true);
    }
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir ."/". $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(!empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $insert = "INSERT into images (file_name, uploaded_on) VALUES ('".$fileName."', NOW())";
            mysqli_query($db, $query);
             header('location: index.php');
            if($insert){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            }else{
                $statusMsg = "File upload failed, please try again.";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

echo $statusMsg;
?>