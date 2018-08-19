<?php
	include "../koneksi.php";
	
	$qry1 = mysqli_query($con,"select sum(jumlah),sum(total) from penjualan where date(tglTransaksi)=date(now())");
	$data1 = mysqli_fetch_row($qry1);
	$qry2 = mysqli_query($con,"select sum(jumlah),sum(total) from penjualan where month(tglTransaksi)=month(date(now())) and year(tglTransaksi)=year(date(now()))");
	$data2 = mysqli_fetch_row($qry2);
	$qry3 = mysqli_query($con,"select sum(jumlah) from riwayat where month(tglMasuk)=month(date(now())) and year(tglMasuk)=year(date(now()))");
	$data3 = mysqli_fetch_row($qry3);
	$qry4 = mysqli_query($con,"select sum(jumlah) from riwayat");
	$data4 = mysqli_fetch_row($qry4);
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard Supervisor</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<body>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Dashboard</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>
			<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-book fa-4x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">
											<sup style="font-size: 18px">Rp. </sup>
											<?php if (isset($data1[1])) {
											  echo number_format($data1[1]);
											} else {
											  echo "0";
											}
											?>
										</div>
										<div>
											<?php if (isset($data1[0])) {
											  echo $data1[0];
											} else {
											  echo "0";
											}
											?>
											Baju
										</div>
									</div>
								</div>
							</div>
							<a href="javascript:;">
								<div class="panel-footer">
									<span class="pull-left">Total Penjualan Hari Ini</span>
									<span class="pull-right"></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="panel panel-green">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-book fa-4x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">
											<sup style="font-size: 18px">Rp. </sup>
											<?php if (isset($data2[1])) {
											  echo number_format($data2[1]);
											} else {
											  echo "0";
											}
											?>
										</div>
										<div>
											<?php if (isset($data2[0])) {
											  echo $data2[0];
											} else {
											  echo "0";
											}
											?>
											Baju
										</div>
									</div>
								</div>
							</div>
							<a href="javascript:;">
								<div class="panel-footer">
									<span class="pull-left">Total Penjualan Bulan Ini</span>
									<span class="pull-right"></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="panel panel-yellow">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-history fa-4x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">
											<?php if (isset($data3[0])) {
											  echo $data3[0];
											} else {
											  echo "0";
											}
											?>
											Baju
										</div>
										<div>
											
										</div>
									</div>
								</div>
							</div>
							<a href="javascript:;">
								<div class="panel-footer">
									<span class="pull-left">Total Penambahan Barang Bulan Ini</span>
									<span class="pull-right"></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="panel panel-red">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-history fa-4x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">
											<?php if (isset($data4[0])) {
											  echo $data4[0];
											} else {
											  echo "0";
											}
											?>
											Baju
										</div>
										<div>
										
										</div>
									</div>
								</div>
							</div>
							<a href="javascript:;">
								<div class="panel-footer">
									<span class="pull-left">Total Penambahan Barang Semua</span>
									<span class="pull-right"></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
			</div>
			
			
			
    
</div>
  
    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
