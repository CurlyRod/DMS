<?php 
include 'db_connection.php'; 
function humanFileSize($size,$unit="") {
    if( (!$unit && $size >= 1<<30) || $unit == " GB")
      return number_format($size/(1<<30),1)." GB";
    if( (!$unit && $size >= 1<<20) || $unit == " MB")
      return number_format($size/(1<<20),0)." MB";
    if( (!$unit && $size >= 1<<10) || $unit == " KB")
      return number_format($size/(1<<10),0)." KB";
    return number_format($size)." bytes";
  } 

  
if(isset($_POST['upload_Form']))
{   
    $filecount = count($_FILES['file']['name']);   
    for($i=0; $i<$filecount; $i++)
	  	{  
        $allowed = array('gif', 'png', 'jpg');
        $filename = $_FILES['file']['name'][$i]; 
        $ext = pathinfo($filename, PATHINFO_EXTENSION); 
        
        if (in_array($ext, $allowed)) {
        

            $folder_id  = mysqli_real_escape_string($conn,$_POST['folder_ids']); 
            $user_id = $_SESSION['id'];
            $filename = $_FILES['file']['name'][$i];  
            $filesize = $_FILES['file']['size'][$i]; 
            $convert = humanFileSize($filesize); 
            $pathname = strtotime(date('y-m-d H:i:s')).'_'.$_FILES['file']['name'][$i];
            $targetPath ='assets/uploads/'.$pathname;  
                 
            $filename  = explode('.',$filename);   
          
            $upload = move_uploaded_file($_FILES['file']['tmp_name'][$i],$targetPath);  
            if($upload){ 
              $insertFile = "INSERT INTO tbl_files (name,user_id,file_path,file_type,byte_size,folder_id,filesize,local_path) VALUES ('$filename[0]','$user_id','$pathname','$filename[1]','$filesize','$folder_id','$convert','$targetPath')";
              $execute_query =  mysqli_query($conn, $insertFile);  
            } 
            if ($execute_query) {
                 
                $res=[ 'status' => 200,
                'message' => 'Success.'
                    ];
                echo json_encode($res) ;
                return false;
            }  

      
        } else{    
       
  
            $res=[ 'status' => 404,
            'message' => 'Warning: Selected file type is not valid.'
                ];
            echo json_encode($res) ;
            return false;
    

        

    } 
} 
}

?>