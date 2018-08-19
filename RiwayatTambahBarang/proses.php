<html>
<head>
	<title> Berhasil </title>
	<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css" />
	<script type="text/javascript" src="../vendor/jquery/jquery-3.3.1.min.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php
include '../koneksi.php';

$kode = $_POST['kode'];
$ukuran = $_POST['ukuran'];
$jumlah = $_POST['jumlah'];
$toko = $_POST['toko'];

$cekBarang = mysqli_query($con, "select * from barang where kode='$kode' and ukuran='$ukuran'");
$ceBa=mysqli_num_rows($cekBarang);
if ($ceBa > 0) {
	while ($ambilBrg = mysqli_fetch_array($cekBarang)){
			$harga=$ambilBrg['harga'];
			$jumlahBrg=$ambilBrg['jumlah'];			
	}
	if ( $jumlahBrg > 0 )  {
		if ($jumlah <= $jumlahBrg){
			$jml=$jumlahBrg-$jumlah;		
			$total=$jumlah*$harga;
			$kode=strtoupper($kode);
			$ukuran=strtoupper($ukuran);
			
			$sql = "update $db.barang set barang.jumlah='$jml' where (barang.kode='$kode' and barang.ukuran='$ukuran') and barang.toko='$toko';";
			
			$sql = $sql."insert into $db.penjualan (penjualan.idPenjualan,penjualan.kode,penjualan.tglTransaksi,penjualan.ukuran,penjualan.jumlah,penjualan.total,penjualan.toko,penjualan.harga)
			values (NULL,'$kode',NOW(),'$ukuran','$jumlah','$total','$toko','$harga');";
			
			$query=mysqli_multi_query($con,$sql);
			if($query){
				echo "<script> alert('Data Berhasil ditambahkan');
				window.location='input.php'</script>";
			} else {
				echo "<script> alert('Data Gagal ditambahkan');
				window.location='input.php'</script>";
			}
		} else {
			echo "<script> alert('Persediaan barang tidak cukup');
					window.location='input.php'</script>";
		}
		
	} else {
		echo "<script> alert('Persediaan barang sudah habis');
				window.location='input.php'</script>";
	}
	
} else {
				echo "<script> alert('Barang Tidak ditemukan');
				window.location='input.php'</script>";
}
	
	//$cekBarang = mysqli_query($con, "select * from barang where (merk='$merk' and ukuran='$ukuran') and toko='$toko'");
	//$tambah=mysqli_num_rows($cekBarang);
/*
	if ($tambah > 0) {
		while ($ambilJumlah = mysqli_fetch_assoc($cekBarang)){
			$jumlahLama=$ambilJumlah['jumlah'];
		}
		$jumlahBaru=$jumlahLama+$jumlah;
		$sql = "update $db.barang set barang.harga='$harga',barang.jumlah='$jumlahBaru' where (barang.merk='$merk' and barang.ukuran='$ukuran') and barang.toko='$toko';";

	} else {
		$sql = "insert into $db.barang (barang.idBarang,barang.kode,barang.ukuran,barang.jumlah,barang.harga,barang.jenisBarang,barang.toko,barang.merk)
			values (NULL,'$kodeBaru','$ukuran','$jumlah','$harga','$jenis','$toko','$merk');";

	}

	
	$sql = $sql."insert into $db.riwayat (riwayat.idRiwayat,riwayat.tglMasuk,riwayat.kode,riwayat.jumlah,riwayat.ukuran,riwayat.harga,riwayat.toko)
			values (NULL,NOW(),'$kodeBaru','$jumlah','$ukuran','$harga','$toko');";
			
	$query=mysqli_multi_query($con,$sql);
			if($query){
				echo "<script> alert('Data Berhasil ditambahkan');
				window.location='input.php'</script>";
			} else {
				echo "<script> alert('Data Gagal ditambahkan');
				window.location='input.php'</script>";
			}
}
*/
?>
</body>
</html>
