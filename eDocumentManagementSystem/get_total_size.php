<?php
require 'db_connection.php';
$query = "SELECT * SUM(filesize) as total_filesize FROM tbl_files WHERE user_id=".$_SESSION['id'];
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$total_filesize = $row['total_filesize'];
echo json_encode(array("total_filesize" => $total_filesize));
mysqli_close($conn);
?>
