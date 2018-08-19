<?php
session_start();

$_SESSION['toko'] = 'G';  

header("Location:index.php");        
?>