<?php
session_start();
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
						// pr($sql);
				$exe   = mysqli_query($con,$sql);

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
				// $sql= ' SELECT toko
				// 		FROM barang
				// 		WHERE (merk = "'.$_POST['merk'].'" and jenisBarang = "'.$_POST['jenis'].'") and ukuran = "'.$_POST['ukuran'].'"';

				// epi
				$sql= ' SELECT toko,jumlah
						FROM barang
						WHERE
							merk = "'.$_POST['merk'].'"
							and jenisBarang = "'.$_POST['jenis'].'"
							and ukuran = "'.$_POST['ukuran'].'"
							and toko != "'.$_SESSION['toko'].'"
							';
				// eof : epi
							// pr($sql);
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
							'jumlah'=>$res['jumlah'],
							'toko'=>$res['toko'],
						);
					}
				}
			}
		break;

		// epi
		case 'stoksekarang':
			if ((isset($_POST['merk']) && isset($_POST['jenis'])) && isset($_POST['ukuran']) && isset($_POST['toko'])) {
				$returns['getparam']=true;
				$sql= ' SELECT jumlah
						FROM barang
						WHERE
							merk = "'.$_POST['merk'].'"
							and jenisBarang = "'.$_POST['jenis'].'"
							and ukuran = "'.$_POST['ukuran'].'"
							and toko = "'.$_POST['toko'].'"
							';
							// pr($sql);
				$exe   = mysqli_query($con,$sql);

				if (!$exe) { // failed query
					$returns['queried'] = false;
				}else{ // success query
					$returns['queried'] = true;
					$returns['total']   = mysqli_num_rows($exe);

					$res=mysqli_fetch_assoc($exe);
					$returns['data']=$res['jumlah'];
				}
			}
		break;
		// eof epi

	}

}

echo json_encode([
	'request' =>$isRequest,
	'returns' =>$returns
]);

?>
