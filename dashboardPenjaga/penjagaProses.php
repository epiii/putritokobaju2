<?php
	include '../lib/koneksi.php';
	include '../lib/fungsi.php';

	$requestData= $_REQUEST;
	if (!isset($_POST['action'])) {
			$outArr=['status'=>'invalid_request'];
	}else{
		$outArr=['status'=>'valid_request'];
		if ($_POST['action']=='ambil') {
			$s = 'UPDATE pinjam SET status="taken" WHERE idPinjam='.$_POST['idPinjam'];
			$e = mysqli_query($con,$s);
			$outArr=['status'=>!$e?'failed save db':'success'];
		}
		elseif ($_POST['action']=='tolak') {
			$s = 'UPDATE pinjam SET status="refuse" WHERE idPinjam="'.$_POST['idPinjam'].'"';
			$e = mysqli_query($con,$s);
			$outArr=['status'=>!$e?'failed save db':'success'];
		}
		elseif ($_POST['action']=='sediakan') {
			// ganti status
				// $s = 'UPDATE pinjam SET status="approved" WHERE idPinjam='.$_POST['idPinjam'];
				// $e = mysqli_query($con,$s);
			// kurangi stok
				$s2 = 'UPDATE barang
							SET jumlah=jumlah-'.$_POST['stok'].'
							WHERE
								toko="'.$_POST['toko'].'"
								AND jenisBarang="'.$_POST['jenisBarang'].'"
								AND merk="'.$_POST['merk'].'"
								AND ukuran="'.$_POST['ukuran'].'"
								 ';
								 pr($s2);
				$e2 = mysqli_query($con,$s2);
			$outArr = ['status'=>!$e2?'failed save db':'success'];
		}
	} echo json_encode($outArr);  // send data as json format
?>
