<?php
	session_start();
	include "../koneksi.php";
	include "../cek.php";
	$toko=$_SESSION['toko'];

	//$toko=$_GET['toko'];
	//echo $toko;

?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>List Pinjam Barang</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>
<body>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h2 class="page-header">List Pinjam Barang</h2>
    </div>
  </div>

<div class="row">
	<?php

		$qryTampil = mysqli_query($con,"select * from pinjam where toko1='$toko' or toko2='$toko' order by tglPinjam ASC, jenisBarang ASC, merk ASC, ukuran ASC;");
		//$ambilPinjam = mysqli_fetch_array($qryTampil);
		/*
		while ($ambilPinjam = mysqli_fetch_array($qryTampil)){
			$jumlahAwal=$ambilBarang['jumlah'];
			$kode=$ambilBarang['kode'];
			$harga=$ambilBarang['harga'];
		}
		*/

	?>
      <table class="table table-hover table-responsive">
        <thead>
          <tr>
						<th>Tanggal Pinjam</th>
            <th>Jenis</th>
            <th>Merk</th>
            <th>Ukuran</th>
            <th>Jumlah</th>
						<!-- epi -->
						<th>Dari/Ke</th>
						<!-- epi -->
						<th>Status</th>
          </tr>
        </thead>
        <tbody>
        <?php
          while ($dta = mysqli_fetch_array($qryTampil)) {
						if ($dta['toko1'] == $toko){
							$status="keluar";
							// epi
							$tokoLawan = 'Toko '.$dta['toko2'];
						} else if ($dta['toko2'] == $toko){
							$status="masuk";
							// epi
							$tokoLawan = 'Toko '.$dta['toko1'];
						}

						echo '<tr>
							<td>'.date("j F Y, g:i a",strtotime($dta['tglPinjam'])).'</td>
							<td>'.$dta['jenisBarang'].'</td>
						  <td>'.$dta['merk'].'</td>
						  <td>'.$dta['ukuran'].'</td>
						  <td>'.$dta['jumlah'].'</td>
							<td>'.$tokoLawan.'</td>
						  <td>'.$status.'</td>
            </tr>';
		      }

        ?>
        </tbody>
      </table>
</div>
</div>
</body>
</html>
