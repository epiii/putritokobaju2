<?php
	include "../koneksi.php";
	include "../cek.php";
	
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Umi Collection</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<body>
<div id="page-wrapper">

  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Tambah Admin</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>
	<div class="card">
		<div class="card-body">
		<form action="?act=prosesAdmin" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Masukkan Nama" name="nama" type="text" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Masukkan Password" name="pass" type="password" required>
                                </div>
								<div class="form-group">
                                    <input class="form-control" placeholder="Ulangi Password" name="passCek" type="password" required>
                                </div>

								<div class="form-group">
									<select name="akses" class="form-control">
										<option value="akses" selected>- Pilih Akses -</option>
										<option value="owner">Owner</option>
										<option value="supervisor">Supervisor</option>
										<option value="penjaga">Penjaga Toko</option>
									</select>
								</div>
								<div class="form-group">
									<input class="form-control" placeholder="Masukkan Toko" name="toko" type="text">
								</div>
                                <button type="submit" class="btn btn-info pull-left" id="daftar" name="daf">Tambah</button>
							 </fieldset>
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
