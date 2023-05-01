<?php


include 'db_connection.php';
$qry = $conn->query("SELECT * FROM tbl_files where id=".$_GET['id'])->fetch_array();

extract($_POST);
$fname=$qry['file_path'];
 $file = ("assets/uploads/".$fname);
header('Content-type: application/octet-stream');
header("Content-Type: ".mime_content_type($file));
header ("Content-Disposition: attachment; filename=".$qry['name'].'.'.$qry['file_type']);

while (ob_get_level()) {
    ob_end_clean();
}
readfile($file);

?>