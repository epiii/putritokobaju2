<?php 
session_start();
include 'koneksi.php';
if(isset($_POST['cek'])){
	$nm_u = $_POST['user'];

	$q_det = mysqli_query($con,"select * FROM akses WHERE username = '$nm_u'");
	$det = mysqli_fetch_array($q_det);
	$nm_agen = $det['nama'];
	$saltny = $det['salt'];
	$pass_db = $det['password'];
	//echo $nm_agen." ".$saltny." ".$pass_db;
}


if(isset($_POST['sand'])){
	$sandi = $_POST['sand'];
	//echo $sandi;
	
	if($pass_db ==''){
		
		$escapedName = mysqli_real_escape_string($con,$nm_agen); 
		$escapedPW = mysqli_real_escape_string($con,$sandi);
		//echo $escapedName." ".$escapedPW." db tidak ada";

		# generate a random salt to use for this account
		$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));

		$saltedPW =  $escapedPW . $salt;

		$hashedPW = hash('sha256', $saltedPW);
		//echo $saltedPW." ".$hashedPW." yg db kosong";

	mysqli_query($con,"UPDATE akses SET salt='$salt', password='$hashedPW' WHERE username='$nm_u'");
	$_SESSION["otoritas"] = $hashedPW;
	header('location: ./login.php?error=3');
	
	//echo "pass db kosong";
	
	}else{
		
		$escapedName = mysqli_real_escape_string($con, $nm_agen); 
		$escapedPW = mysqli_real_escape_string($con, $sandi);
		
		/*
		echo $escapedName." ".$escapedPW." db ada <br>";
		if (isset($escapedPW)){
			echo "escapePw ada db ada";
		} else {
			echo "escapePw tidak ada db ada";
		}
		*/
		
		# generate a random salt to use for this account
		
		$salt = $saltny;

		$saltedPW =  $escapedPW . $salt;

		$hashedPW = hash('sha256', $saltedPW);
		
		//echo $salt." yuan ".$saltedPW." yuan ".$hashedPW." yang db ada";

		//echo $hashedPW."<br>";
		//echo $pass_db;
		
		if($hashedPW == $pass_db){
		//echo "ya sama";
		
		$_SESSION["otoritas"] = $hashedPW;
		header('location: ./');
		
		//print_r($_SESSION['otoritas']);
		
		}else{
			//echo "tidak sama";
		header('location:location: ./login.php?error=2');
		//	echo $pass_db.' <-pass ';
		}
		
		
		//echo "pass db tidak kosong";
	}
	
} 
/*
else {
	echo "tidak ada sandi";
}
*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Login Umi Collection</title>
    <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="./dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="./vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Akses Masuk</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST">
                            <fieldset>
							<?php $info ='';
							if(isset($_GET['error'])){
								$error = $_GET['error'];
								if ($error == 2){
									$info = '<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<p class="text-danger">Anda tidak memiliki akses ke sistem ini!</p></div>';
								}else if($error == 3){
									$info = '<div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<p class="text-info">Ini login yang pertama! password anda sudah diset, cobalah login lagi</p></div>';
								}else if($error == "sesiexp"){
									$info = '<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<p class="text-danger">Anda perlu login kembali</p></div>';
								}else{
								$info = "error ".$error; }
							}
							echo $info;
							?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="user" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="sand" type="password" value="">
                                </div>
                                <button type="submit" class="btn btn-info pull-right" id="ktk2"  name="cek" >Masuk</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="./vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="./vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="./dist/js/sb-admin-2.js"></script>

</body>

</html>
