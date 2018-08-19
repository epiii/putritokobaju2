<?php
//session_start();
include '../koneksi.php'; 
//include '../cek.php';
include 'lib/lib.php'; 

$isRequest=false;

if (isset($_POST['mode'])) {
	$isRequest=true;
	$returns = [];
	$returns['getparam']=false;
	
	switch ($_POST['mode']) {
		case 'combomerk':
			if (isset($_POST['jenis'])) {
				$returns['getparam']=true;
				$sql= ' SELECT DISTINCT(merk) as merk
						FROM barang 
						WHERE jenisBarang = "'.$_POST['jenis'].'" order by merk asc';
				$exe   = mysqli_query($con,$sql);
			// pr($exe);

				if (!$exe) { // failed query 
					$returns['queried'] = false;
				}else{ // success query 
					$returns['queried'] = true;
					$returns['total']   = mysqli_num_rows($exe);
				
					// pr($res);
					while ($res=mysqli_fetch_assoc($exe)){
						$returns['data'][]=array(
							'merk'     =>$res['merk'],
						);
					}
				}
			}
		break;
		case 'comboukuran':
			if (isset($_POST['merk']) && isset($_POST['jenis'])) {
				$returns['getparam']=true;
				$sql= ' SELECT DISTINCT(ukuran) as ukuran
						FROM barang 
						WHERE merk = "'.$_POST['merk'].'" and jenisBarang = "'.$_POST['jenis'].'" order by ukuran asc';
				$exe   = mysqli_query($con,$sql);
			// pr($exe);

				if (!$exe) { // failed query 
					$returns['queried'] = false;
				}else{ // success query 
					$returns['queried'] = true;
					$returns['total']   = mysqli_num_rows($exe);
				
					// pr($res);
					while ($res=mysqli_fetch_assoc($exe)){
						$returns['data'][]=array(
							'ukuran'     =>$res['ukuran'],
						);
					}
				}
			}
		break;
		case 'combotoko':
			if ((isset($_POST['merk']) && isset($_POST['jenis'])) && isset($_POST['ukuran'])) {
				$returns['getparam']=true;
				$sql= ' SELECT toko
						FROM barang 
						WHERE (merk = "'.$_POST['merk'].'" and jenisBarang = "'.$_POST['jenis'].'") and ukuran = "'.$_POST['ukuran'].'"';
				$exe   = mysqli_query($con,$sql);
			// pr($exe);

				if (!$exe) { // failed query 
					$returns['queried'] = false;
				}else{ // success query 
					$returns['queried'] = true;
					$returns['total']   = mysqli_num_rows($exe);
				
					// pr($res);
					while ($res=mysqli_fetch_assoc($exe)){
						$returns['data'][]=array(
							'toko'     =>$res['toko'],
						);
					}
				}
			}
		break;
		
	}

}

echo json_encode([
	'request' =>$isRequest,
	'returns' =>$returns
]);

?>