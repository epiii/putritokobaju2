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
			$jumlah_disetujui= $_POST['jumlah_disetujui'];
				$s1 = 'UPDATE pinjam SET
								status="approved",
								jumlah_disetujui="'.$jumlah_disetujui.'"
							WHERE idPinjam='.$_POST['idPinjam'];
				$e1 = mysqli_query($con,$s1);

			// kurangi stok
				// $s2 = 'UPDATE barang
				// 			SET jumlah=jumlah-'.$jumlah_disetujui.'
				// 			WHERE
				// 				toko="'.$_POST['toko'].'"
				// 				AND jenisBarang="'.$_POST['jenisBarang'].'"
				// 				AND merk="'.$_POST['merk'].'"
				// 				AND ukuran="'.$_POST['ukuran'].'"
				// 				 ';
				// pr($s1);
				// $e1 = mysqli_query($con,$s1);
				// $e2 = mysqli_query($con,$s2);
				if (!$e1) {
					$outArr = ['status'=>'failed update "status" in tb pinjam'];
				}
				// else if (!$e2) {
				// 	$outArr = ['status'=>'failed update "jumlah" in tb barang'];
				// }
				 else {
					$outArr = ['status'=>'success'];
				}
		}
	} echo json_encode($outArr);  // send data as json format
?>
