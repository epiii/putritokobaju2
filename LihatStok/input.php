<?php
	include "../koneksi.php";
	
	$qry1 = mysqli_query($con,"select sum(jumlah) from barang where toko='A'");
	$data1 = mysqli_fetch_row($qry1);
	$qry2 = mysqli_query($con,"select sum(jumlah) from barang where toko='B'");
	$data2 = mysqli_fetch_row($qry2);
	$qry3 = mysqli_query($con,"select sum(jumlah) from barang where toko='C'");
	$data3 = mysqli_fetch_row($qry3);
	$qry4 = mysqli_query($con,"select sum(jumlah) from barang where toko='D'");
	$data4 = mysqli_fetch_row($qry4);
	$qry5 = mysqli_query($con,"select sum(jumlah) from barang where toko='E'");
	$data5 = mysqli_fetch_row($qry5);
	$qry6 = mysqli_query($con,"select sum(jumlah) from barang where toko='F'");
	$data6 = mysqli_fetch_row($qry6);
	$qry7 = mysqli_query($con,"select sum(jumlah) from barang where toko='G'");
	$data7 = mysqli_fetch_row($qry7);
	$qry8 = mysqli_query($con,"select sum(jumlah) from barang where toko='H'");
	$data8 = mysqli_fetch_row($qry8);
	$qry9 = mysqli_query($con,"select sum(jumlah) from barang where toko='I'");
	$data9 = mysqli_fetch_row($qry9);
	$qry10 = mysqli_query($con,"select sum(jumlah) from barang where toko='J'");
	$data10 = mysqli_fetch_row($qry10);
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Lihat Stok</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<body>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Lihat Stok</h1>
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
											<?php if (isset($data1[0])) {
											  echo $data1[0];
											} else {
											  echo "0";
											}
											?>
											<sup style="font-size: 18px"> Baju </sup>
										</div>
										<div>
											
										</div>
									</div>
								</div>
							</div>
							<a href="?act=stokDetail&toko=A">
								<div class="panel-footer">
									<span class="pull-left">Stok Barang Toko A</span>
									<span class="pull-right">Lihat Detail</span>
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
											<?php if (isset($data2[0])) {
											  echo $data2[0];
											} else {
											  echo "0";
											}
											?>
											<sup style="font-size: 18px"> Baju </sup>
										</div>
										<div>
											
										</div>
									</div>
								</div>
							</div>
							<a href="?act=stokDetail&toko=B">
								<div class="panel-footer">
									<span class="pull-left">Stok Barang Toko B</span>
									<span class="pull-right">Lihat Detail</span>
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
										<i class="fa fa-book fa-4x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">											
											<?php if (isset($data3[0])) {
											  echo $data3[0];
											} else {
											  echo "0";
											}
											?>
											<sup style="font-size: 18px"> Baju </sup>
										</div>
										<div>
											
										</div>
									</div>
								</div>
							</div>
							<a href="?act=stokDetail&toko=C">
								<div class="panel-footer">
									<span class="pull-left">Stok Barang Toko C</span>
									<span class="pull-right">Lihat Detail</span>
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
										<i class="fa fa-book fa-4x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">
											<?php if (isset($data4[0])) {
											  echo $data4[0];
											} else {
											  echo "0";
											}
											?>
											<sup style="font-size: 18px"> Baju </sup>
										</div>
										<div>
										
										</div>
									</div>
								</div>
							</div>
							<a href="?act=stokDetail&toko=D">
								<div class="panel-footer">
									<span class="pull-left">Stok Barang Toko D</span>
									<span class="pull-right">Lihat Detail</span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
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
											<?php if (isset($data5[0])) {
											  echo $data5[0];
											} else {
											  echo "0";
											}
											?>
											<sup style="font-size: 18px"> Baju </sup>
										</div>
										<div>
										
										</div>
									</div>
								</div>
							</div>
							<a href="?act=stokDetail&toko=E">
								<div class="panel-footer">
									<span class="pull-left">Stok Barang Toko E</span>
									<span class="pull-right">Lihat Detail</span>
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
											<?php if (isset($data6[0])) {
											  echo $data6[0];
											} else {
											  echo "0";
											}
											?>
											<sup style="font-size: 18px"> Baju </sup>
										</div>
										<div>
										
										</div>
									</div>
								</div>
							</div>
							<a href="?act=stokDetail&toko=F">
								<div class="panel-footer">
									<span class="pull-left">Stok Barang Toko F</span>
									<span class="pull-right">Lihat Detail</span>
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
										<i class="fa fa-book fa-4x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">
											<?php if (isset($data7[0])) {
											  echo $data7[0];
											} else {
											  echo "0";
											}
											?>
											<sup style="font-size: 18px"> Baju </sup>
										</div>
										<div>
										
										</div>
									</div>
								</div>
							</div>
							<a href="?act=stokDetail&toko=G">
								<div class="panel-footer">
									<span class="pull-left">Stok Barang Toko G</span>
									<span class="pull-right">Lihat Detail</span>
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
										<i class="fa fa-book fa-4x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">
											<?php if (isset($data8[0])) {
											  echo $data8[0];
											} else {
											  echo "0";
											}
											?>
											<sup style="font-size: 18px"> Baju </sup>
										</div>
										<div>
										
										</div>
									</div>
								</div>
							</div>
							<a href="?act=stokDetail&toko=H">
								<div class="panel-footer">
									<span class="pull-left">Stok Barang Toko H</span>
									<span class="pull-right">Lihat Detail</span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
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
											<?php if (isset($data9[0])) {
											  echo $data9[0];
											} else {
											  echo "0";
											}
											?>
											<sup style="font-size: 18px"> Baju </sup>
										</div>
										<div>
										
										</div>
									</div>
								</div>
							</div>
							<a href="?act=stokDetail&toko=I">
								<div class="panel-footer">
									<span class="pull-left">Stok Barang Toko I</span>
									<span class="pull-right">Lihat Detail</span>
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
											<?php if (isset($data10[0])) {
											  echo $data10[0];
											} else {
											  echo "0";
											}
											?>
											<sup style="font-size: 18px"> Baju </sup>
										</div>
										<div>
										
										</div>
									</div>
								</div>
							</div>
							<a href="?act=stokDetail&toko=J">
								<div class="panel-footer">
									<span class="pull-left">Stok Barang Toko J</span>
									<span class="pull-right">Lihat Detail</span>
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
