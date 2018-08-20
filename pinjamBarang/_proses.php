<html>
<head>
	<title> Berhasil Pinjam </title>
	<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css" />
	<script type="text/javascript" src="../vendor/jquery/jquery-3.3.1.min.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php
include '../koneksi.php';

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

			$query=mysqli_multi_query($con,$sql);
			if($query){
				echo "<script> alert('Berhasil di pesan, harap segera mengambil barangnya');
				window.location='?act=pinjamBarang'</script>";
			} else {
				echo "<script> alert('Gagal di pesan, Mohon ulangi');
				window.location='?act=pinjamBarang'</script>";
			}
		} else {
			echo "<script> alert('Persediaan barang tidak cukup');
					window.location='?act=pinjamBarang'</script>";
		}
	} else {
		echo "<script> alert('Persediaan barang sudah habis');
				window.location='?act=pinjamBarang'</script>";
	}
}
?>
</body>
</html>
