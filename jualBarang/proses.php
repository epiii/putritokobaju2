<html>
<head>
	<title> Berhasil </title>
	<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css" />
	<script type="text/javascript" src="../vendor/jquery/jquery-3.3.1.min.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php
session_start();
include '../koneksi.php';

$kode = $_POST['kode'];
$ukuran = $_POST['ukuran'];
$jumlah = $_POST['jumlah'];
$toko = $_SESSION['toko'];

$cekBarang = mysqli_query($con, "select * from barang where (kode='$kode' and ukuran='$ukuran') and toko='$toko'");
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
				echo "<script> alert('Transaksi Berhasil');
				window.location='?act=jualBarang'</script>";
			} else {
				echo "<script> alert('Transaksi Gagal');
				window.location='?act=jualBarang'</script>";
			}
		} else {
			echo "<script> alert('Persediaan barang tidak cukup');
					window.location='?act=jualBarang'</script>";
		}
		
	} else {
		echo "<script> alert('Persediaan barang sudah habis');
				window.location='?act=jualBarang'</script>";
	}
	
} else {
				echo "<script> alert('Barang Tidak ditemukan');
				window.location='?act=jualBarang'</script>";
}
?>
</body>
</html>
