<?php
	include "../koneksi.php";
	$toko=$_GET['toko'];
	$act=$_GET['act'];
	//echo $toko;
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Umi Collection</title>
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
      <h2 class="page-header">Riwayat Penambahan Barang Toko <?php echo $toko; ?></h2>
    </div>
  </div>
 
<div class="row">		
	<?php
		$qryTampil = mysqli_query($con,"select * from riwayat where toko='$toko' order by tglMasuk;");
		
		$qryHitung = mysqli_query($con,"select sum(jumlah) from riwayat where toko='$toko';");
		$dtaHit = mysqli_fetch_row($qryHitung);
		
	?>      
             
      <table class="table table-hover table-responsive">
        <thead>
          <tr>
            <th>Tanggal Masuk Barang</th>
            <th>Kode</th>
            <th>Ukuran</th>
            <th>Jumlah</th>
          </tr>
        </thead>
        <tbody>
        <?php        
          while ($dta = mysqli_fetch_array($qryTampil)) {
            echo '<tr>
              <td>'.date("j F Y, g:i a",strtotime($dta['tglMasuk'])).'</td>
              <td>'.$dta['kode'].'</td>
			  <td>'.$dta['ukuran'].'</td>
              <td>'.$dta['jumlah'].'</td>			  
            </tr>';
          }
        ?>
        </tbody>
      </table>
	  <br>
      <h3>
        Total Masuk Barang :
        <span class="label label-success">
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

