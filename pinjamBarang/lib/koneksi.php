<?php

$user_name = "root";
$password  = "oemi1996";
$database  = "sf_db019";
$host_name = "localhost:3306";

$con = mysqli_connect($host_name, $user_name, $password, $database);
mysqli_select_db($con, $database);
/*
if ($con || mysqli_select_db($con, $database)) {
    echo "berhasil";
} else {
    echo " failed";
}
*/
?>