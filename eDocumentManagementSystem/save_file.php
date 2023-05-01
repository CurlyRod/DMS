<?php 
require 'db_connection.php';     

function humanFileSize($size,$unit="") {
    if( (!$unit && $size >= 1<<30) || $unit == " GB")
      return number_format($size/(1<<30),1)." GB";
    if( (!$unit && $size >= 1<<20) || $unit == " MB")
      return number_format($size/(1<<20),0)." MB";
    if( (!$unit && $size >= 1<<10) || $unit == " KB")
      return number_format($size/(1<<10),0)." KB";
    return number_format($size)." bytes";
  } 
if (!empty($_FILES['file'])){
    $targetDir = 'assets/uploads/';
     $filename = strtotime(date('y-m-d H:i:s')).'_'.$_FILES['file']['name'];
    $targetFilePath = $targetDir . $filename;  
  //  $folder_id  =  $_POST['filesid'];


if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) 
{

            
              $user_id = $_SESSION['id'];
              $filename = $_FILES['file']['name'];  
              $x = pathinfo($filename, PATHINFO_FILENAME);
             $folder_id =  $_POST['value'];
              $filetype = pathinfo($filename,PATHINFO_EXTENSION);
              $pathname = strtotime(date('y-m-d H:i:s')).'_'.$_FILES['file']['name'];
              $filesize = $_FILES['file']['size'];
              $convertSize = humanFileSize($filesize); 
  
           //  $filename  = explode('.',$filename); 
             
             $insertFile = "INSERT INTO tbl_files (name,user_id,file_path,file_type,folder_id,filesize,byte_size,local_path) VALUES ('$x','$user_id','$pathname','$filetype','$folder_id','$convertSize','$filesize','$targetFilePath')";
             $execute_query =  mysqli_query($conn, $insertFile);  
               
            
}
   if($execute_query){ 
                    
        $res=[ 'status' => 200,
        'message' => 'Files  Uploaded Successfully.',
        'filename' =>$filename
            ];
            ob_clean();
        echo json_encode($res) ;
        return false;
        
      } 
      else  
      { 
        $res=[ 'status' => 422,
        'message' => 'Files Not Uploaded.'
            ];
            ob_clean();
        echo json_encode($res) ;
        return false;
      

                        

}  
   


//   if(!empty($_FILES['files']))
//   {   
     
      
//           $filecount = count($_FILES['files']['name']);  
//             for($i=0; $i<$filecount; $i++)
//           {    
          
  
//             //  $folder_id  = mysqli_real_escape_string($conn,$_POST['folder_id']); 
//               $user_id = $_SESSION['id'];
//              $filename = $_FILES['files']['name'][$i]; 
//               $origname= $filename;
            
//               $pathname = strtotime(date('y-m-d H:i')).'_'.$_FILES['files']['name'][$i];
//               $filesize = $_FILES['files']['size'][$i];
//                $convertSize = humanFileSize($filesize);
  
//              $filename  = explode('.',$filename);   
  
//               $upload = move_uploaded_file($_FILES['files']['tmp_name'][$i],'assets/uploads/'.$pathname);  
              
   
//             if($upload)
  
//             { 
              
//               $insertFile = "INSERT INTO tbl_files (name,user_id,file_path,file_type,filesize) VALUES ('$filename[0]','$user_id','$pathname','$filename[1]',' $convertSize')";
//               $execute_query =  mysqli_query($conn, $insertFile);  
                  
//             } 
            
//             }
          
//               if($execute_query) 
//               { 
//                 $res=[ 'status' => 200,
//                     'message' => 'Files Uploaded successfully.'
//                         ];
                
//                     echo json_encode($res) ;
//                     return false;
      
               
//               } 
//               else{ 
      
//                 $res=[ 'status' => 422,
//                 'message' => 'Not uploaded successfully.'
//                     ];
            
//                 echo json_encode($res) ;
//                 return false;
                
//           // echo $uploads;  
             
//       }  

}
  ?>
  