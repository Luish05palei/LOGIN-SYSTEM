<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "Users";

$conn = mysqli_connect($server, $username, $password, $database);
if(!$conn){
//     echo "Successfully connected";
// }else{
    die("Error" . mysqli_connect_errno());
}

?>