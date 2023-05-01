
<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

$conn = mysqli_connect("localhost",'root','','dms_db');
if (!$conn) {
    die("Connection Failed :-".mysqli_connect_error());
}?>