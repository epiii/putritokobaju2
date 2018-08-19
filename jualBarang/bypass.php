<?php
session_start();

$_SESSION['toko'] = 'A';  

header("Location:input.php");        
?>