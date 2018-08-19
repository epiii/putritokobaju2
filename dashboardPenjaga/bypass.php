<?php
session_start();

$_SESSION['toko'] = 'G';  

header("Location:input.php");        
?>