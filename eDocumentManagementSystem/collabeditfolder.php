<?php 
include 'db_connection.php'; 

if(isset($_POST['update_folder']))
{ 
    $folder_id = mysqli_real_escape_string($conn,$_POST['f_id']);
    $parent_id= mysqli_real_escape_string($conn,$_POST['updatefolder_parent']);
    $foldername = mysqli_real_escape_string($conn,$_POST['updatefolder_names']); 

    if($foldername ==  NULL)
    { 
        
        $res=[    
            'status' =>  422,
            'message' => 'Folder name require.'
                ];
                echo json_encode($res) ;
                return false;

    }  
  $check  = "SELECT * FROM tbl_colab_folder  where creator_id ='".$_SESSION['id']."' and foldername  ='".$foldername."' and parent_colab_id ='".$parent_id."' ";
  $execute = mysqli_query($conn,$check); 
  if(mysqli_num_rows($execute)>0){
        
        $res=[    
            'status' =>  404,
            'message' => 'Folder name already exist.'
                ];
                echo json_encode($res) ;
                return false;

     
    }else{ 
        $save = "UPDATE tbl_colab_folder SET foldername='$foldername' WHERE id=".$folder_id;
        $execute = mysqli_query($conn,$save); 

        if($execute){ 
            $res=[    
                'status' =>  200,
                'message' => 'Folder Successfully updated. '
                    ];
                    echo json_encode($res) ;
                    return false;
        }
       

} 


} 





?>