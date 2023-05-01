<?php
    include 'db_connection.php';
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['name'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $name = $_POST['name'];

        $Sql = 'INSERT into users (username,password,name) VALUES("'.$username.'","'.$password.'","'.$name.'")';
        mysqli_query($conn,$Sql);

        echo 'success';
    }

    elseif (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $Sql = "Select * from tbl_users where username ='$username' && password = '$password' && role='Admin' ";
        $res = mysqli_query($conn,$Sql);
        
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $_SESSION['id'] = $row['id'];
            $arr = array("status" => 'success', 'message' => 'Logged Successfully'); 
            
        }else {
            $arr = array("status" => 'error', 'message' => 'Check username or password');
        }
        echo  json_encode($arr);
    }  

   
   

?>