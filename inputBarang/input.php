<?php
	include "../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Umi Collection | Tambah Barang</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<body>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Tambah Barangg</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>   
			<div class="card">
				<div class="card-body">
                        <form action="?act=prosesTambah" method="POST">                           
							<div class="form-group row">
								<label for="jenis" class="col-sm-2 col-form-label">Jenis Barang</label>
								<div class="col-sm-5">
								    <input class="form-control" placeholder="Masukkan Jenis" name="jenis" type="text" autofocus required>
								</div>
							</div>
							<div class="form-group row">
								<label for="merk" class="col-sm-2 col-form-label">Merk Barang</label>
								<div class="col-sm-5">
									<input class="form-control" placeholder="Masukkan Merk" name="merk" type="text" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="ukuran" class="col-sm-2 col-form-label">Ukuran Barang</label>
								<div class="col-sm-5">
                                    <input class="form-control" placeholder="Masukkan Ukuran" name="ukuran" type="text">
								</div>
							</div>
							<div class="form-group row">
								<label for="jumlah" class="col-sm-2 col-form-label">Jumlah Barang</label>
								<div class="col-sm-5">
									<input class="form-control" placeholder="Masukkan Jumlah" name="jumlah" type="text" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="harga" class="col-sm-2 col-form-label">Harga Barang</label>
								<div class="col-sm-5">
									<input class="form-control" placeholder="Masukkan Harga Per Satuan" name="harga" type="text" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="toko" class="col-sm-2 col-form-label">Nama Toko</label>
								<div class="col-sm-5">
									<input class="form-control" placeholder="Masukkan Toko" name="toko" type="text" required>
								</div>
							</div>

                                <button type="submit" class="btn btn-info pull-left" id="tambah" name="tambah">Tambah</button>
								
                        </form>
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
