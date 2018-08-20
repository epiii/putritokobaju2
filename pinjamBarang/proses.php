<?php
$out=[];
if (!isset($_POST['jumlah'])) {
	$out['isRequest']=false;
} else{
	$out['isRequest']=true;
	include '../koneksi.php';
	include '../lib/fungsi.php';

	$jenis = $_POST['jeniscombo'];
	$merk = $_POST['merkcombo'];
	$ukuran = $_POST['ukurancombo'];
	$tokoAsal = $_POST['tokocombo'];
	$jumlah = $_POST['jumlah'];
	$tokoPinjam = $_POST['tokoPinjam'];

	$cekBarang = mysqli_query($con, "select * from barang where (jenisBarang='$jenis' and merk='$merk') and (ukuran='$ukuran' and toko='$tokoAsal');");

	$ceBa=mysqli_num_rows($cekBarang);
	if ($ceBa > 0) {
		while ($ambilBarang = mysqli_fetch_array($cekBarang)){
			$jumlahAwal=$ambilBarang['jumlah'];
			$kode=$ambilBarang['kode'];
			$harga=$ambilBarang['harga'];
		}
		if ( $jumlahAwal > 0 )  {
			if ($jumlah <= $jumlahAwal){
				//echo "<script> alert('lanjutkan');
				//		window.location='index.php'</script>";

				$jumlahBaru=$jumlahAwal-$jumlah;
				$sql = "update $db.barang set barang.jumlah='$jumlahBaru' where (jenisBarang='$jenis' and merk='$merk') and (ukuran='$ukuran' and toko='$tokoAsal');";

				$cekToko = mysqli_query($con, "select * from barang where (jenisBarang='$jenis' and merk='$merk') and (ukuran='$ukuran' and toko='$tokoPinjam');");
				$ceTo=mysqli_num_rows($cekToko);
				while ($ambilToko = mysqli_fetch_array($cekToko)){
						$jmlAwal=$ambilToko['jumlah'];
					}
				$jmlBaru=$jmlAwal+$jumlah;
				//echo $jmlAwal." ".$jmlBaru;

				if ($ceTo > 0) {
					$sql = $sql."update $db.barang set barang.jumlah='$jmlBaru' where (jenisBarang='$jenis' and merk='$merk') and (ukuran='$ukuran' and toko='$tokoPinjam');";
				} else {
					$sql = $sql."insert into $db.barang (barang.idBarang,barang.kode,barang.ukuran,barang.jumlah,barang.harga,barang.jenisBarang,barang.toko,barang.merk)
				values (NULL,'$kode','$ukuran','$jumlah','$harga','$jenis','$tokoPinjam','$merk');";

				}

				$sql = $sql."insert into $db.pinjam (pinjam.idPinjam,pinjam.kode,pinjam.ukuran,pinjam.jumlah,pinjam.toko1,pinjam.jenisBarang,pinjam.merk,pinjam.tglPinjam,pinjam.toko2)
				values (NULL,'$kode','$ukuran','$jumlah','$tokoAsal','$jenis','$merk',NOW(),'$tokoPinjam');";

				// pr($sql);
				$query=mysqli_multi_query($con,$sql);

				if($query){
					$out['status']=true;
					$out['message']='Berhasil di pesan, harap segera mengambil barangnya';
					// echo "<script> alert('Berhasil di pesan, harap segera mengambil barangnya');
					// window.location='?act=pinjamBarang'</script>";
				} else {
					$out['status']=false;
					$out['message']='Gagal di pesan, Mohon ulangi';
					// echo "<script> alert('Gagal di pesan, Mohon ulangi');
					// window.location='?act=pinjamBarang'</script>";
				}
			} else {
				// echo "<script> alert('Persediaan barang tidak cukup');
				// 		window.location='?act=pinjamBarang'</script>";
				$out['status']=false;
				$out['message']='Persediaan barang tidak cukup';
			}
		} else {
			$out['status']=false;
			$out['message']='Persediaan barang sudah habis';
			// echo "<script> alert('Persediaan barang sudah habis');
			// 		window.location='?act=pinjamBarang'</script>";
		}
	}
} echo json_encode($out);
?>
