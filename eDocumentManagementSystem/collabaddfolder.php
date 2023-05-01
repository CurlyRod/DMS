<?php  


  
      include 'db_connection.php';
   
 
    if(isset($_POST['save_folder']))
    { 
        $user_id =$_SESSION['id'];
        $parent_id= mysqli_real_escape_string($conn,$_POST['folder_parent']);
        $foldername = mysqli_real_escape_string($conn,$_POST['folder_names']); 

        if($foldername ==  NULL)
        { 
            
            $res=[    
                'status' =>  422,
                'message' => 'Folder name require.'
                    ];
                    echo json_encode($res) ;
                    return false;
  
        }  
      $check  = "SELECT * FROM tbl_colab_folder where creator_id ='".$_SESSION['id']."' and foldername  ='".$foldername."' and parent_colab_id ='".$parent_id."' ";
      $execute = mysqli_query($conn,$check); 
      if(mysqli_num_rows($execute)>0){
            
            $res=[    
                'status' =>  404,
                'message' => 'Folder name already exist.'
                    ];
                    echo json_encode($res) ;
                    return false;
  
         
        }else{ 
            $save = "INSERT INTO tbl_colab_folder (creator_id,foldername,parent_colab_id)  VALUES ('$user_id','$foldername','$parent_id')" ;
            $execute = mysqli_query($conn,$save); 
   
            if($execute){ 
                $res=[    
                    'status' =>  200,
                    'message' => 'Folder Successfully created. '
                        ];
                        echo json_encode($res) ;
                        return false;
            }
           
   
    } 



         
} 
if(isset($_GET['folderid'])) 
{ 
    $flderid= mysqli_real_escape_string($conn,$_GET['folderid']); 

    $selectIDs = "SELECT * FROM tbl_colab_folder WHERE id=".$flderid; 
    $execute_querys = mysqli_query($conn,$selectIDs); 

    //CHECK RETURNING VALUE 
    
        if(mysqli_num_rows($execute_querys)== 1) 
        {   

            $user_record = mysqli_fetch_array($execute_querys); 


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




?>