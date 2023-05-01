<?php   

      require  '../db_connection.php';


    if(isset($_POST['restore_user'])) 
    {
        $user_id = mysqli_real_escape_string($conn,$_POST['user_id']);  
        
        $archives = "UPDATE tbl_users SET archive='Active' WHERE id='$user_id' "; 

        $archiveUser = mysqli_query($conn,$archives); 


        if($archiveUser) 
            {
                $res=[ 'status' =>  200,
                'message' => 'Restore successfully.'
                    ];
                echo json_encode($res) ;
                return false;
             
            } 
            else{ 
    
                $res=[ 'status' =>  500,
                'message' => 'Restore not successfully.'
            ];
                   
                } 
                echo json_encode($res) ;
                return false;


    }
    if(isset($_POST['delete_user'])) 
    { 
        $user_id = mysqli_real_escape_string($conn,$_POST['user_id']);  
        
        $archives = "DELETE FROM tbl_users  WHERE id='$user_id' "; 

        $archiveUser = mysqli_query($conn,$archives); 


        if($archiveUser) 
            { 
                $res=[ 'status' =>  200,
                'message' => 'Deleted successfully.'
                    ];
                   
    
                
                echo json_encode($res) ;
                return false;
    
             
            } 
            else{ 
    
                $res=[ 'status' =>  500,
                'message' => 'Not Deleted.'
            ];
                   
    
                } 
                echo json_encode($res) ;
                return false;


    }





     
      // ---------GET USER_ID FROM DATABASE---- ---  /// 

if(isset($_GET['user_id'])) 
{ 
    $userId = mysqli_real_escape_string($conn,$_GET['user_id']); 

    $selectID = "SELECT * FROM tbl_users WHERE id='$userId' "; 
    $execute_query = mysqli_query($conn,$selectID); 

    //CHECK RETURNING VALUE 
    
        if(mysqli_num_rows($execute_query)== 1) 
        {   

            $user_record = mysqli_fetch_array($execute_query); 


            $res=[    
                'status' =>  200,
                'message' => 'Record Found.',
                'data' => $user_record
                    ];
                echo json_encode($res) ;
                return false;
        }
        else 
        { 
            $res=[    
                'status' =>  404,
                'message' => 'No record found.',
                    ];
                echo json_encode($res) ;
                return false;
        }
}  
    


        if(isset($_POST['restore_file'])) 
        {
            $file_id = mysqli_real_escape_string($conn,$_POST['file_id']);  
            
            $archives = "UPDATE tbl_files SET archive='' WHERE id='$file_id' "; 
    
            $archiveFile = mysqli_query($conn,$archives); 
    
    
            if($archiveFile) 
                {
                    $res=[ 'status' =>  200,
                    'message' => 'Restore successfully.'
                        ];
                    echo json_encode($res) ;
                    return false;
                 
                } 
                else{ 
        
                    $res=[ 'status' =>  500,
                    'message' => 'Restore not successfully.'
                ];
                       
                    } 
                    echo json_encode($res) ;
                    return false;
    
    
        }  


        if(isset($_POST['restore_folder'])) 
        {
            $folder_id = mysqli_real_escape_string($conn,$_POST['folder_id']);  
            
            $archives = "UPDATE tbl_folders SET archive= 0 WHERE id='$folder_id' "; 
    
            $archiveFile = mysqli_query($conn,$archives); 
    
    
            if($archiveFile) 
                {
                    $res=[ 'status' =>  200,
                    'message' => 'Restore successfully.'
                        ];
                    echo json_encode($res) ;
                    return false;
                 
                } 
                else{ 
        
                    $res=[ 'status' =>  500,
                    'message' => 'Restore not successfully.'
                ];
                       
                    } 
                    echo json_encode($res) ;
                    return false;
    
    
        } 
  
        
         
       
?>