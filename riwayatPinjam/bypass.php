<?php
session_start();

$_SESSION['toko'] = 'G';  

header("Location:listPinjam.php");        
?>