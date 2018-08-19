<?php
/*
	$pass = 'yuan123';
	$salt = uniqid('', true);
	$hash = sha1($pass . $salt);
*/	
/*	
include "../koneksi.php";
	$sandi="yuan123";	
	$qry = mysqli_query($con,"select * FROM akses WHERE username = 'yuni'");
	$det = mysqli_fetch_array($qry);
	$pass = $det['password'];
	$saltny = $det['salt'];
	
	$escapedPW = mysqli_real_escape_string($con,$sandi);
	$saltedPW =  $escapedPW . $saltny;

		$hashedPW = hash('sha256', $saltedPW);
		
		if($hashedPW == $pass){
			echo "sama oy";
		} else {
			echo "tidak oy";
		}
	echo " ini ".$hashedPW;
*/	
	//echo $pass."<br>".$salt."<br>".$hash;
	/*
	$karaker="ABCDEFGHIJKL1234567890^()";
	$random=rand(0,strlen($karakter)-1);
	echo $random;
	*/
	function create_random($length)
{
    $data = 'ABCDEFGHIJKLMNOPQRSTU1234567890';
    $string = '';
    for($i = 0; $i < $length; $i++) {
        $pos = rand(0, strlen($data)-1);
        $string .= $data{$pos};
    }
    return $string;
}

echo "hkamu ".create_random(4);
?>