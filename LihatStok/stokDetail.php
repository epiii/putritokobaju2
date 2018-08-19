<?php
	include "../koneksi.php";
	$toko=$_GET['toko'];
	$act=$_GET['act'];
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Detail Stok</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<!--<link href="../vendor/css/style.css" rel="stylesheet">-->
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>
<body>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h2 class="page-header">Stok Barang Toko <?php echo $toko; ?></h2>
    </div>
  </div>
 
<div class="row">		
	<?php
		$qryTampil = mysqli_query($con,"select * from barang where toko='$toko' and jumlah>0 order by jenisBarang asc, merk asc, ukuran asc;");
		
		$qryHitung = mysqli_query($con,"select sum(jumlah) from barang where toko='$toko' and jumlah>0;");
		$dtaHit = mysqli_fetch_row($qryHitung);
		
	?>          
      <table class="table table-hover table-responsive">
        <thead>
          <tr>
            <th>Kode</th>
            <th>Jenis</th>
            <th>Merk</th>
            <th>Ukuran</th>
		      	<th>Harga</th>
            <th>Stok</th>
          </tr>
        </thead>
        <tbody>
        <?php        
          while ($dta = mysqli_fetch_array($qryTampil)) {
            echo '<tr>
              <td>'.$dta['kode'].'</td>
              <td>'.$dta['jenisBarang'].'</td>
			  <td>'.$dta['merk'].'</td>
              <td>'.$dta['ukuran'].'</td>			  
              <td>Rp. '.number_format($dta['harga']).'</td>
			  <td>'.$dta['jumlah'].'</td>	
            </tr>';
          }
        ?>
        </tbody>
      </table>
	  <br>
	  <h3>
        Total Stok :
        <span class="label label-warning">
          <?php 
			if(isset($dtaHit[0])){
				echo $dtaHit[0]." Barang";
			} else {
				echo "0 Barang";
			}
			?>
        </span>
      </h3>
</div>
</div>
</body>
</html>

