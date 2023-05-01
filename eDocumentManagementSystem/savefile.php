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
//  $uploads = 'err';  
// if(isset($_POST['upload_Form']))
// {   
   
    
// 		$filecount = count($_FILES['file']['name']);   
     
// 	  	for($i=0;$i<$filecount; $i++)
// 		{    
        

//       $folder_id  = mysqli_real_escape_string($conn,$_POST['folder_ids']); 
//       $user_id = $_SESSION['id'];
//       $filename = $_FILES['file']['name'][$i]; 
//       $pathname = strtotime(date('y-m-d H:i:s')).'_'.$_FILES['file']['name'][$i];
//       $filesize = $_FILES['file']['size'][$i];  
//       $convertSize = humanFileSize($filesize);   
//       $targetPath = 'assets/uploads/'.$pathname; 
//       $filename  = explode('.',$filename);   
      
//       //TO UPLOAD 
//       $upload = move_uploaded_file($_FILES['file']['tmp_name'][$i],$targetPath);  
    
         
//       if($upload)

//       { 
        
//         $insertFile = "INSERT INTO tbl_files (name,user_id,file_path,file_type,filesize,folder_id,byte_size,local_path) VALUES ('$filename[0]','$user_id','$pathname','$filename[1]',' $convertSize','$folder_id','$filesize','$targetPath')";
//         $execute_query =  mysqli_query($conn, $insertFile);  
          
//         if($execute_query) 
//         { 
//             $res=[ 'status' => 200,
//             'message' => 'Files Uploaded successfully.'
//                 ];
       
//             echo json_encode($res) ;
//             return false;
         
//         } else{ 

//             $res=[ 'status' =>  422,
//             'message' => 'Files not uploaded.' ];
               
//         echo json_encode($res) ;
//         return false;
//          } 
                 
//         // echo $uploads;  
           
//     }
//   }
//   }  


if(isset($_POST['upload_Form']))
{   
	  $filecount = count($_FILES['file']['name']);  
	  	for($i=0; $i<$filecount; $i++)
	  	{    
         
        $folder_id   = $_POST['value'];
        $user_id = $_SESSION['id'];
        $filename = $_FILES['file']['name'][$i];  
        $filesize = $_FILES['file']['size'][$i]; 
        $convert = humanFileSize($filesize); 
        $pathname = strtotime(date('y-m-d H:i:s')).'_'.$_FILES['file']['name'][$i];
        $targetPath ='assets/uploads/'.$pathname;  
        $filename  = explode('.',$filename);   
        //UPLOAD TO ASSETS
        $upload = move_uploaded_file($_FILES['file']['tmp_name'][$i],$targetPath);  
        if($upload){ 
          $insertFile = "INSERT INTO tbl_files (name,user_id,file_path,file_type,byte_size,folder_id,filesize,local_path) VALUES ('$filename[0]','$user_id','$pathname','$filename[1]','$filesize','$folder_id','$convert','$targetPath')";
          $execute_query =  mysqli_query($conn, $insertFile);  
        }      
        }
            if($execute_query) 
            { 
                $res=[ 'status' => 200,
                'message' => 'Files Uploaded successfully.'
                    ];
                echo json_encode($res) ;
                return false;
    
             
            } 
            else{ 
    
                $res=[ 'status' =>  422,
                'message' => 'Files not uploaded.' 
              
            ];
                   
    
                } 
                echo json_encode($res) ;
                return false;
 
	   
          
		 
       
        
        echo $uploads;  
           
    } 
    if(isset($_POST['delete_folder'])) 
    {
        $folder_id = mysqli_real_escape_string($conn,$_POST['folder_id']);  
        
        $archives = "UPDATE tbl_folders SET archive = 1  WHERE id='$folder_id' "; 

        $archiveFile = mysqli_query($conn,$archives); 


        if($archiveFile) 
            { 
                $res=[ 'status' =>  200,
                'message' => 'Folder Deleted successfully.'
                    ];
                   
    
                
                echo json_encode($res) ;
                return false;
    
             
            } 
            else{ 
    
                $res=[ 'status' =>  500,
                'message' => 'Folder Not Deleted.'
            ];
                   
    
                } 
                echo json_encode($res) ;
                return false;


    } 

    if(isset($_POST['restore_folder'])) 
    {
        $folder_id = mysqli_real_escape_string($conn,$_POST['folder_id']);  
        
        $archives = "UPDATE tbl_folders SET archive =  0 WHERE id='$folder_id' "; 

        $archiveFile = mysqli_query($conn,$archives); 


        if($archiveFile) 
            { 
                $res=[ 'status' =>  200,
                'message' => 'Folder Restore successfully.'
                    ];
                   
    
                
                echo json_encode($res) ;
                return false;
    
             
            } 
            else{ 
    
                $res=[ 'status' =>  500,
                'message' => 'Folder Not Restore.'
            ];
                   
    
                } 
                echo json_encode($res) ;
                return false;


    } 

    
    if(isset($_POST['approve_file'])) 
    {
        $folder_id = mysqli_real_escape_string($conn,$_POST['file_id']);  
        
        $archives = "UPDATE tbl_files SET archive = 1 WHERE id='$folder_id' "; 

        $archiveFile = mysqli_query($conn,$archives); 


        if($archiveFile) 
            { 
                $res=[ 'status' =>  200,
                'message' => 'File successfully Approve.'
                    ];
                   
    
                
                echo json_encode($res) ;
                return false;
    
             
            } 
            else{ 
    
                $res=[ 'status' =>  500,
                'message' => 'File not Approve.'
            ];
                   
    
                } 
                echo json_encode($res) ;
                return false;


    } 


 


if(isset($_POST['delete_item'])) 
    {
        $file_id = mysqli_real_escape_string($conn,$_POST['file_id']);  
        
        $archives = "UPDATE tbl_files SET archive = 3 WHERE id='$file_id' "; 

        $archiveFile = mysqli_query($conn,$archives); 


        if($archiveFile) 
            { 
                $res=[ 'status' =>  200,
                'message' => 'File Deleted successfully.'
                    ];
                   
    
                
                echo json_encode($res) ;
                return false;
    
             
            } 
            else{ 
    
                $res=[ 'status' =>  500,
                'message' => 'File Not Deleted.'
            ];
                   
    
                } 
                echo json_encode($res) ;
                return false;


    } 



    if(isset($_POST['remove_item'])) 
    {
        $file_id = mysqli_real_escape_string($conn,$_POST['file_id']);  
        
        $archives = "UPDATE tbl_share SET aprroval = 1 WHERE id='$file_id' "; 

        $archiveFile = mysqli_query($conn,$archives); 


        if($archiveFile) 
            { 
                $res=[ 'status' =>  200,
                'message' => 'File Remove successfully.'
                    ];
                   
    
                
                echo json_encode($res) ;
                return false;
    
             
            } 
            else{ 
    
                $res=[ 'status' =>  500,
                'message' => 'File Not Remove.'
            ];
                   
    
                } 
                echo json_encode($res) ;
                return false;


    } 
    
if(isset($_POST['delete_collab_folder'])) 
{
    $folder_id = mysqli_real_escape_string($conn,$_POST['folder_id']);  
    
    $archives = "UPDATE tbl_colab_folder SET archive = 3 WHERE id='$folder_id' "; 

    $archiveFile = mysqli_query($conn,$archives); 


    if($archiveFile) 
        { 
            $res=[ 'status' =>  200,
            'message' => 'File Deleted successfully.'
                ];
               

            
            echo json_encode($res) ;
            return false;

         
        } 
        else{ 

            $res=[ 'status' =>  500,
            'message' => 'File Not Deleted.'
        ];
               

            } 
            echo json_encode($res) ;
            return false;


} 

?>

 


          
      
      

             
 
          

