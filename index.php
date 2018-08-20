<?php session_start();
include 'koneksi.php';
include 'cek.php';

// epi
include 'lib/fungsi.php';
// pr($_SESSION);
//include 'statistik.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Umi Collection</title>

    <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="./vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <link href="./dist/css/sb-admin-2.css" rel="stylesheet">

    <link href="./vendor/morrisjs/morris.css" rel="stylesheet">

    <link href="./vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>
 <script src="./vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="./vendor/metisMenu/metisMenu.min.js"></script>
<!-- DataTables CSS -->
    <link href="./vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="./vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom Theme JavaScript -->
    <script src="./dist/js/sb-admin-2.js"></script>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <!-- epi -->
            <h4 class="pull-right " style="color:grey;margin:10px;"><?php
              echo $_SESSION['nama'].'(
                '.$_SESSION['akses'].'
                '.(!is_null($_SESSION['toko'])?' toko '.$_SESSION['toko']:'').'
              )';
            ?></h4>
            <!-- eof : epi -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Umi Collection</a>
            </div>
            <!-- /.navbar-header -->


            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
				       <ul class="nav" id="side-menu">

					   <?php if($_SESSION["akses"] == "supervisor"){
							echo '
												<li>
													<a href="?act=dashboardS"><i class="fa fa-dashboard fa-fw"></i> Dashboard </a>
												</li>
												<li>
													<a href="?act=dashboard"><i class="fa fa-book fa-fw"></i> Lihat Penjualan </a>
												</li>
												<li>
													<a href="?act=lihatStok"><i class="fa fa-cubes fa-fw"></i> Lihat Stok </a>
												</li>
												<li>
													<a href="?act=riwayatTambahBarang"><i class="fa fa-history fa-fw"></i> Riwayat Tambah Barang </a>
												</li>
												';
						}
						?>
						<?php if($_SESSION["akses"] == "owner"){
							echo '
												<li>
													<a href="?act=dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard </a>
												</li>
												<li>
													<a href="?act=tambah"><i class="fa fa-edit fa-fw"></i> Tambah Barang</a>
												</li>
												<li>
													<a href="?act=admin"><i class="fa fa-users fa-fw"></i> Tambah Admin</a>
												</li>
												';
						}
						?>
						<?php if($_SESSION["akses"] == "penjaga"){
							echo '
												<li>
													<a href="?act=dashboardP"><i class="fa fa-dashboard fa-fw"></i> Dashboard </a>
												</li>
												<li>
													<a href="?act=jualBarang"><i class="fa fa-edit fa-fw"></i> Jual barang </a>
												</li>
												<li>
													<a href="?act=pinjamBarang"><i class="fa fa-cubes fa-fw"></i> Pinjam barang </a>
												</li>
												<li>
													<a href="?act=riwayatPinjam"><i class="fa fa-history fa-fw"></i> Riwayat Pinjam barang </a>
												</li>
												';
						}
						?>

						<li>
                            <a href="?act=logout"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
                        </li>

                    </ul>

		</div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- confirmation Dialog -->
        <div class="modal fade" id="confirmModal" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title "></h4>
              </div>
              <div class="modal-body">
                <p>Are you sure about this ?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="cancel">Batal</button>
                <button type="button" style="display:none" class="btn btn-success" id="lanjutkanAmbil">Lanjutkan</button>
                <button type="button" style="display:none"  class="btn btn-warning" id="lanjutkanTolak">Lanjutkan</button>
              </div>
            </div>
          </div>
        </div>

        <!-- form Dialog -->
        <div class="modal fade" id="formModal" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
          <div class="modal-dialog">

            <form class="" onsubmit="sediakanBarang();return false;">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title "></h4>
                </div>
                <div class="modal-body">
                <!-- <p>Are you sure about this ?</p> -->
                  <table class="table table-bordered table-hover">
                    <tbody>
                      <tr>
                        <th>jenis</th>
                        <td id="jenisBarangTD">...</td>
                      </tr>
                      <tr>
                        <th>merk</th>
                        <td id="merkTD">...</td>
                      </tr>
                      <tr>
                        <th>ukuran</th>
                        <td id="ukuranTD">...</td>
                      </tr>
                      <tr>
                        <th>jumlah (yang diminta)</th>
                        <td id="jumlahTD">...</td>
                      </tr>
                    </tbody>
                  </table>

                  <div class="form-group">
                    <label>Stok (yg dipinjamkan)</label>
                    <select class="form-control" name="">
                      <option value="">Pilih</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                    </select>
                    <small id="emailHelp" class="form-text text-muted red">We'll never share your email with anyone else.</small>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  <button type="button" class="btn btn-warning" id="lanjutkanForm">Lanjutkan</button>
                </div>
              </div>
            </form>

          </div>
        </div>
<?php
	if(isset($_GET['act'])){
		if ($_GET['act'] == "dashboard"){
			include 'dashboardPenjualan/input.php';
		}else if($_GET['act'] == "tambah"){
			include 'inputBarang/input.php';
		}else if($_GET['act'] == "jualDetail"){
			include 'dashboardPenjualan/jualDetail.php';
		}else if($_GET['act'] == "prosesTambah"){
			include 'inputBarang/proses.php';
		}else if($_GET['act'] == "admin"){
			include 'registrasi/index.php';
		}else if($_GET['act'] == "prosesAdmin"){
			include 'registrasi/proses.php';
		}else if($_GET['act'] == "dashboardS"){
			include 'dashboardSupervisor/input.php';
		}else if($_GET['act'] == "lihatStok"){
			include 'LihatStok/input.php';
		}else if($_GET['act'] == "stokDetail"){
			include 'LihatStok/stokDetail.php';
		}else if($_GET['act'] == "riwayatTambahBarang"){
			include 'RiwayatTambahBarang/input.php';
		}else if($_GET['act'] == "riwayatDetail"){
			include 'RiwayatTambahBarang/riwayatDetail.php';
		}else if($_GET['act'] == "dashboardP"){
			include 'dashboardPenjaga/input.php';
		}else if($_GET['act'] == "jualBarang"){
			include 'jualBarang/input.php';
		}else if($_GET['act'] == "prosesJual"){
			include 'jualBarang/proses.php';
		}else if($_GET['act'] == "pinjamBarang"){
			include 'pinjamBarang/index.php';
		}else if($_GET['act'] == "prosesPinjam"){
			include 'pinjamBarang/proses.php';
		}else if($_GET['act'] == "riwayatPinjam"){
			include 'riwayatPinjam/listPinjam.php';


		}else{

		}
	} else {
		if($_SESSION["akses"] == "owner"){
			include 'dashboardPenjualan/input.php';
		} else if ($_SESSION["akses"] == "supervisor"){
			include 'dashboardSupervisor/input.php';
		} else if ($_SESSION["akses"] == "penjaga"){
			include 'dashboardPenjaga/input.php';
		}



	}
	/*
	else{
		echo '    <div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">'.$alert.'
						<h1 class="page-header">Bissmillah</h1>
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<!-- /.row -->
				<div class="row">
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-gitlab fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">'.$tawar.'</div>
										<div>Hewan ditawarkan!</div>
									</div>
								</div>
							</div>
							<a href="#">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-green">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-money fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">'.$lunas.'</div>
										<div>Lunas!</div>
									</div>
								</div>
							</div>
							<a href="#">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-yellow">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-shopping-cart fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">'.$total.'</div>
										<div>Order!</div>
									</div>
								</div>
							</div>
							<a href="#">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="panel panel-red">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-support fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">'.$keep.'</div>
										<div>Pending!</div>
									</div>
								</div>
							</div>
							<a href="#">
								<div class="panel-footer">
									<span class="pull-left">View Details</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
				</div>'.$txt_wa.'
				'.$statistik.$statistik1.'
				<!-- /.row -->
			</div>';
		}
		*/
?>

    </div>
    <!-- DataTables JavaScript -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="./vendor/datatables-responsive/dataTables.responsive.js"></script>
   <script>
    $(document).ready(function() {
        $('#dataTables-example1').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>
