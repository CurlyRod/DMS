<?php    
    include 'db_connection.php';
     if(isset($_POST['save_user']))
    { 
        $parentFolder = mysqli_real_escape_string($conn,$_POST['folder_parent']);
        $folderName = mysqli_real_escape_string($conn,$_POST['folder_names']); 
        
        //RETURN IF THE SAME NAME AND USER IS EXIST IN DATABASE
        $checkfoldername = "SELECT * FROM tbl_folders WHERE user_id ='".$_SESSION['id']."' and folder name = '"$folderName"'"; 

        $result = mysqli_query($conn,$checkfoldername);

    } 



    
  


?>