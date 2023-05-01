<?php
include 'db_connection.php';

if(isset($_POST['delete_file'])) 
{ 
    extract($_POST);
    $file_id = mysqli_real_escape_string($conn,$_POST['file_id']);  
   
    $sql = "SELECT local_path FROM tbl_files  where id =".$file_id;
    $result = $conn->query($sql);  
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        $pathname =  $row["local_path"]; 
      
        unlink($pathname);
        } 
    }
   

    if( $result) 
        {   
            
            $deleteFile = "DELETE FROM tbl_files WHERE id =".$file_id; 
            $queryRun = mysqli_query($conn,$deleteFile);  
            
            $res=[ 'status' =>  200,
            'message' => 'File successfully deleted.' ];
        
                echo json_encode($res) ;
                return false;  
        } 
        else{ 

            $res=[ 'status' =>  500,
            'message' => 'Not Deleted.' ];
            } 
            echo json_encode($res) ;
            return false; 
        
}


      ?>
