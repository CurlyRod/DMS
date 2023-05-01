<?php

require 'db_connection.php';
$sql = "SELECT SUM(byte_size) as total_filesize FROM tbl_files WHERE user_id=".$_SESSION['id'];
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);
$total_filesize = $row['total_filesize'];

// echo json_encode(array("total_filesize" => $total_filesize)); 

if($result){
$res=[    
    'status' =>  200,
    'message' => 'Record Found.',
    'data' => $total_filesize
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
?>
