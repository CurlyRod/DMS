<?php   
require 'db_connection.php';

if(isset($_POST['approve_files'])) 
{
    $folder_id = mysqli_real_escape_string($conn,$_POST['file_ids']);  
    
    $archives = "UPDATE tbl_share SET approval = 1 WHERE id='$folder_id' "; 

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






















   
?>