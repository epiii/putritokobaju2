<?php
if(isset($_GET['act'])){
	if($_GET['act'] == "logout"){
		
		session_destroy();
		header('location: ./login.php?error=sesiexp');
		
		//echo "keluar";
	}
}
if(isset($_SESSION["otoritas"])){
	
	$passw1 = $_SESSION['otoritas'];
	$q_det1 = mysqli_query($con,"SELECT * FROM `$db`.`akses` WHERE `password` LIKE '$passw1'");
	$ck = mysqli_fetch_array($q_det1);
	if($ck){
		$nm_user = $ck['nama'];
		$_SESSION["nama"] = $nm_user;
		$username = $ck['username'];
		$_SESSION["username"] = $username;
		$ak_user = $ck['akses'];
		$_SESSION["akses"] = $ak_user;		
		$toko = $ck['toko'];
		$_SESSION["toko"] = $toko;
		if($nm_user == ''){
			header('location: ./login.php?error=no_user');
		}
	}else{
		header('location: ./login.php?error=database');
	}	
	
	//echo "otoritas ada";
}else{
	//echo "otoritas tidak ada";
	header('location: ./login.php?error=sesiexp');
}
?>