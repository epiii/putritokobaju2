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

$jenis = $_POST['jenis'];
$merk = $_POST['merk'];
$ukuran = $_POST['ukuran'];
$jumlah = $_POST['jumlah'];
$harga = $_POST['harga'];
$toko = $_POST['toko'];

$jenis = preg_replace('/[^A-Za-z0-9\  ]/', '', $jenis);
$merk = preg_replace('/[^A-Za-z0-9\  ]/', '', $merk);

function createKode($length){
	$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$string = '';
	for($i = 0; $i < $length; $i++) {
		$pos = rand(0, strlen($data)-1);
		$string .= $data{$pos};
	}
	return $string;
}
$kodeBaru=createKode(6);

$cekKode = mysqli_query($con, "select * from barang where kode='$kodeBaru'");
$ceKo=mysqli_num_rows($cekKode);
if ($ceKo <= 0) {
	$cekBarang = mysqli_query($con, "select * from barang where (merk='$merk' and ukuran='$ukuran') and (toko='$toko' and jenisBarang='$jenis')");
	$cekBar = mysqli_query($con, "select * from barang where merk='$merk' and jenisBarang='$jenis'");
	
	$tambah=mysqli_num_rows($cekBarang);
	$tambahBar=mysqli_num_rows($cekBar);
	
	$ukuran=strtoupper($ukuran);
	$toko=strtoupper($toko);

	if ($tambahBar > 0) {
		while ($ambilKode = mysqli_fetch_array($cekBar)){
			$kodeLama=$ambilKode['kode'];
		}
	}	
	
	if ($tambah > 0) {
		while ($ambilJumlah = mysqli_fetch_assoc($cekBarang)){
			$jumlahLama=$ambilJumlah['jumlah'];
			$kodeLm=$ambilJumlah['kode'];
		}
		$jumlahBaru=$jumlahLama+$jumlah;
		$sql = "update $db.barang set barang.harga='$harga',barang.jumlah='$jumlahBaru' where (barang.merk='$merk' and barang.ukuran='$ukuran') and barang.toko='$toko';";

		$sql = $sql."insert into $db.riwayat (riwayat.idRiwayat,riwayat.tglMasuk,riwayat.kode,riwayat.jumlah,riwayat.ukuran,riwayat.harga,riwayat.toko)
			values (NULL,NOW(),'$kodeLm','$jumlah','$ukuran','$harga','$toko');";	
	} else {
		if ($tambahBar > 0) {
			while ($ambilKode = mysqli_fetch_array($cekBar)){
				$kodeLama=$ambilKode['kode'];
			}
			$sql = "insert into $db.barang (barang.idBarang,barang.kode,barang.ukuran,barang.jumlah,barang.harga,barang.jenisBarang,barang.toko,barang.merk)
			values (NULL,'$kodeLama','$ukuran','$jumlah','$harga','$jenis','$toko','$merk');";
			$sql = $sql."insert into $db.riwayat (riwayat.idRiwayat,riwayat.tglMasuk,riwayat.kode,riwayat.jumlah,riwayat.ukuran,riwayat.harga,riwayat.toko)
			values (NULL,NOW(),'$kodeLama','$jumlah','$ukuran','$harga','$toko');";	
		} else {	
			$sql = "insert into $db.barang (barang.idBarang,barang.kode,barang.ukuran,barang.jumlah,barang.harga,barang.jenisBarang,barang.toko,barang.merk)
				values (NULL,'$kodeBaru','$ukuran','$jumlah','$harga','$jenis','$toko','$merk');";
			$sql = $sql."insert into $db.riwayat (riwayat.idRiwayat,riwayat.tglMasuk,riwayat.kode,riwayat.jumlah,riwayat.ukuran,riwayat.harga,riwayat.toko)
			values (NULL,NOW(),'$kodeBaru','$jumlah','$ukuran','$harga','$toko');";		
		}	
	}	
	
	
			
	$query=mysqli_multi_query($con,$sql);
			if($query){
				echo "<script> alert('Barang berhasil ditambahkan');
				window.location='?act=tambah'</script>";
			} else {
				echo "<script> alert('Barang gagal ditambahkan');
				window.location='?act=tambah'</script>";
			}
}
?>
</body>
</html>
