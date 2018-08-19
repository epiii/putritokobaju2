<html>
<head>
	<title> Registrasi Berhasil </title>
	<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css" />
	<script type="text/javascript" src="../vendor/jquery/jquery-3.3.1.min.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php
include '../koneksi.php';

$nama = $_POST['nama'];
$pass = $_POST['pass'];
$passCek = $_POST['passCek'];
$akses = $_POST['akses'];
$toko = $_POST['toko'];
$toko=strtoupper($toko);

if($pass == $passCek){
		$nama = preg_replace('/[^A-Za-z0-9\  ]/', '', $nama);
		$pisahNama=explode(" ",$nama);
		$user=strtolower($pisahNama[0]);
		$cekusername = mysqli_query($con, "select * from akses where nama like '$pisahNama[0]%'");
		$tambah=mysqli_num_rows($cekusername);

		if ($tambah <= 0) {
			$username=$pisahNama[0];
		} else {
			$username=$pisahNama[0].$tambah;
		}

		//Mengatur Password dan salt
		$salt = uniqid('', true);
		$escapedPass = mysqli_real_escape_string($con,$pass);
		$saltedPass =  $escapedPass . $salt;

		$hashedPass = hash('sha256', $saltedPass);
	if (!empty($toko)){
		$sql = "insert into akses (idAkses,username,password,salt,nama,akses,toko)
			values (NULL,'$username','$hashedPass','$salt','$nama','$akses','$toko')";
	} else {
		$sql = "insert into akses (idAkses,username,password,salt,nama,akses,toko)
			values (NULL,'$username','$hashedPass','$salt','$nama','$akses',NULL)";
	}
		$query=mysqli_query($con,$sql);
    		if($query){
    			echo "<script> alert('Hak Akses berhasil di tambahkan');
					window.location='?act=admin'</script>";
				}
} else {
	echo "<script> alert('Password tidak sama, mohon ulangi lagi');
		window.location='?act=admin'</script>";
}
?>
</body>
</html>
