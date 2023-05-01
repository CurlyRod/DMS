<?php

include 'db_connection.php';
// Allowed file types
$allowedTypes = array('application/x-msdownload','application/x-msdownload');

// Maximum file size (in bytes)
$maxSize = 50000000000;  

// FOR HUMANFILZE READABLE
function humanFileSize($size,$unit="") {
    if( (!$unit && $size >= 1<<30) || $unit == " GB")
      return number_format($size/(1<<30),1)." GB";
    if( (!$unit && $size >= 1<<20) || $unit == " MB")
      return number_format($size/(1<<20),0)." MB";
    if( (!$unit && $size >= 1<<10) || $unit == " KB")
      return number_format($size/(1<<10),0)." KB";
    return number_format($size)." bytes";
  }

// Upload directory 
if(isset($_POST['upload_Form'])){
$uploadDir = "assets/uploads/";
 
foreach ($_FILES["file"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
        $fileType = $_FILES["file"]["type"][$key];
        $fileSize = $_FILES["file"]["size"][$key];
        $fileName = $_FILES["file"]["name"][$key]; 
         $file_extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $convrtfileName =strtotime(date('y-m-d H:i:s')).'_'.$_FILES["file"]["name"][$key];
        $fileTemp = $_FILES["file"]["tmp_name"][$key]; 
        $convert = humanFileSize($fileSize); 
        $filext = explode('.',$fileName);  

       // print_r($fileName);

        // Validate file type
        // if (in_array($fileType, $allowedTypes)) {
        //    // echo "File type not allowed: " . $fileName . "<br>";
        //    ob_clean();
        //    echo json_encode(array("status" => 300, "message" => "File type not allowed: " .$fileName));
        //         continue;
        // } 
        if ($file_extension == "bat" || $file_extension == "exe") {
          ob_clean();
           echo json_encode(array("status" => 300, "message" => "File type not allowed: " .$fileName));
                continue;
      }

        // Validate file size
        if ($fileSize > $maxSize) {
            echo "File size too large: " . $fileName . "<br>";
            continue;
        }

        // Move the uploaded file to the upload directory
        $upload = move_uploaded_file($fileTemp, $uploadDir . $convrtfileName);  
        if($upload)
        { 
            //echo json_encode(array("status" => 200, "message" => "File uploaded successfully: " ));
            
            
           
            $user_id = $_SESSION['id']; 
            $pathname = $uploadDir.$convrtfileName;               
            $folder_id  = mysqli_real_escape_string($conn,$_POST['folder_ids']);  
          



            $insertFile = "INSERT INTO tbl_files (name,user_id,file_path,file_type,byte_size,folder_id,filesize,local_path) VALUES ('$filext[0]','$user_id','$convrtfileName','$filext[1]','$fileSize','$folder_id','$convert','$pathname')";
            $execute_run = mysqli_query($conn,$insertFile); 

            if($execute_run)
            { 
                ob_clean();
                echo json_encode(array("status" => 200, "message" => "File uploaded successfully " ));
               
            }

            
            
           
        }
    
    }
}
}

?>