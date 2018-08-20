<?php
	session_start();
	include "../koneksi.php";
	include "../cek.php";
	include "../lib/fungsi.php";
	$toko=$_SESSION["toko"];

	// $qry1 = mysqli_query($con,"select sum(jumlah),sum(total) from penjualan where date(tglTransaksi)=date(now()) and toko='$toko'");
	// $data1 = mysqli_fetch_row($qry1);
	// $qry2 = mysqli_query($con,"select sum(jumlah),sum(total) from penjualan where (month(tglTransaksi)=month(date(now())) and year(tglTransaksi)=year(date(now()))) and toko='$toko'");
	// $data2 = mysqli_fetch_row($qry2);
	// $qry3 = mysqli_query($con,"select sum(jumlah) from pinjam where (month(tglPinjam)=month(date(now())) and year(tglPinjam)=year(date(now()))) and toko2='$toko'");
	// $data3 = mysqli_fetch_row($qry3);
	// $qry4 = mysqli_query($con,"select sum(jumlah) from pinjam where (month(tglPinjam)=month(date(now())) and year(tglPinjam)=year(date(now()))) and toko1='$toko'");
	// $data4 = mysqli_fetch_row($qry4);
	//
	// $qdat = mysqli_query($con,"SELECT * FROM $db.pinjam where date(tglPinjam)=date(now()) and toko1='$toko'");
	// while ($dat = mysqli_fetch_array($qdat)){
	// 	$alert = $alert.'<div class="alert alert-danger">
	// 					toko '.$dat['toko2'].' ingin meminjam barang dengan jenis '.$dat['jenisBarang'].', merk '.$dat['merk'].', ukuran '.$dat['ukuran'].', sebanyak '.$dat['jumlah'].' </div>';
	// }
	// $qdat = mysqli_query($con,"SELECT * FROM $db.pinjam where date(tglPinjam)=date(now()) and toko2='$toko'");
	// while ($dat = mysqli_fetch_array($qdat)){
	// 	$alert = $alert.'<div class="alert alert-success alert-dismissable">
	// 	<a href="#" class="btn btn-success">ambil</a>
	// 	toko '.$dat['toko1'].' telah menyediakan barang dengan jenis '.$dat['jenisBarang'].', merk '.$dat['merk'].', ukuran '.$dat['ukuran'].', sebanyak '.$dat['jumlah'].' silahkan ambil barang segera</div>';
	//
	// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
		<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
		<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div id="page-wrapper">
	  <div class="row">
	    <div class="col-lg-12"><?php echo $alert ?>
	      <h1 class="page-header">Dashboard</h1>
	    </div>
	  </div>

		<!-- epi  -->
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

        <div class="modal-content">
	          <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	            <h4 class="modal-title "></h4>
	          </div>

	          <div class="modal-body" id="formModal-body">
							hhahahaah
						</div>

	          <div class="modal-footer">
	            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	            <button type="button" class="btn btn-warning" id="lanjutkanForm">Lanjutkan</button>
	          </div>
					<!-- </form> -->

        </div>

    </div>
  </div>

	<?php
		$toko = $_SESSION['toko'];	// nama toko yang ...
		$durasi = 7; 	//lama tampil 7 hari
		// echo 'Anda login sekarang sebagai <div class="badge badge-info"> Toko '.$toko.'</div>';
		$dipinjam = getNotifPeminjaman('dipinjam',$toko,$durasi);
		// pr($dipinjam);
		$meminjam = getNotifPeminjaman('meminjam',$toko,$durasi);
		// vd($pinjam);
	?>
<!-- eof : epi  -->

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
										<i class="fa fa-cubes fa-4x"></i>
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
									<span class="pull-left">Total Pinjam Barang Masuk Bulan Ini</span>
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
										<i class="fa fa-cubes fa-4x"></i>
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
									<span class="pull-left">Total Pinjam Barang Keluar Bulan Ini</span>
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

		<script>
			$(document).ready(function(){
				setTimeout(function(){
					$('.pageLoader').attr('style','display:none');
				}, 700);


				$('body').on('hidden.bs.modal', '.modal', function () {
					// $(this).removeData('bs.modal');
			    // $(this).removeData("bs.modal").find(".modal-content").empty();
					console.log();
					// $('#formModal').find('.modal-content').html('');

				// alert('hihi');
	      });
				$('#lanjutkanForm').on('click',sediakanBarang);
			});

			$('#confirmModal').on('show.bs.modal', function (e) {
				 $message = $(e.relatedTarget).attr('data-message');
				 $(this).find('.modal-body p').text($message);
				 $title = $(e.relatedTarget).attr('data-title');
				 $(this).find('.modal-title').text($title);
		 	});

			 function formSediakanBarang(idPinjam) {
				 // get value
				 var jenisBarang = $('#sediakan_'+idPinjam).attr('jenisBarang');
				 var merk = $('#sediakan_'+idPinjam).attr('merk');
				 var ukuran = $('#sediakan_'+idPinjam).attr('ukuran');
				 var jumlah = $('#sediakan_'+idPinjam).attr('jumlah');
				 var toko = $('#sediakan_'+idPinjam).attr('toko');
				 var stok = $('#sediakan_'+idPinjam).attr('stok');
				 $('#idPinjam').val(idPinjam);
				 // set value into form
				 $('#jenisBarangTD').html(jenisBarang);
				 $('#merkTD').html(merk);
				 $('#ukuranTD').html(ukuran);
				 $('#jumlahTD').html(jumlah);

				 var opt = '';
				 for (var i = stok; i>0; i--) {
					 opt+='<option '
						 			+(i==jumlah?' selected ':'')
									+(i>jumlah?' disabled ':'')
									+' value="'+i+'">'
									+i
								+'</option>'
				 }

				 $('.modal-body').html('');
				 var formx ='<form id="sediakanForm">'
				 +'<table class="table table-bordered table-hover">'
				    +'<tbody>'
				      +'<tr>'
				        +'<th>Toko</th>'
				        +'<td>'+toko+'</td>'
				       +'</tr>'
				      +'<tr>'
				        +'<th>Jenis</th>'
				        +'<td>'+jenisBarang+'</td>'
				       +'</tr>'
				       +'<tr>'
				         +'<th>Merk</th>'
				         +'<td>'+merk+'</td>'
				       +'</tr>'
				       +'<tr>'
				         +'<th>Ukuran</th>'
				         +'<td>'+ukuran+'</td>'
				       +'</tr>'
				       +'<tr>'
				         +'<th>Jumlah (yang diminta)</th>'
				         +'<td>'+jumlah+'</td>'
				       +'</tr>'
				     +'</tbody>'
				   +'</table>'

					 +'<input type="hidden" name="idPinjam" id="idPinjam" value="'+idPinjam+'" />'
					 +'<input type="hidden" name="jenisBarang" value="'+jenisBarang+'" />'
					 +'<input type="hidden" name="merk" value="'+merk+'" />'
					 +'<input type="hidden" name="ukuran" value="'+ukuran+'" />'
					 +'<input type="hidden" name="jumlah" value="'+jumlah+'" />'
					 +'<input type="hidden" name="toko" value="'+toko+'" />'
					 +'<div class="form-group">'
						 +'<label>Jumlah (yang dipinjamkan)</label>'
						 +'<select required id="jumlah_disetujui" name="jumlah_disetujui" class="form-control">'
							 +'<option value="">Pilih</option>'
							 +opt
						 +'</select>'
					 +'</div>'
				 +'</form>'
				 ;
				 $('.modal-body').html(formx);
			 }

			 function ambilBarang(id) {
				 $('#lanjutkanTolak').attr('style','display:none;');
				 $('#lanjutkanAmbil').removeAttr('style');

					$('#lanjutkanAmbil').on('click',function(){
						$.ajax({
							url:'dashboardPenjaga/penjagaProses.php',
							headers: {
							 'Cache-Control': 'no-cache, no-store, must-revalidate',
							 'Pragma': 'no-cache',
							 'Expires': '0'
							},
							cache:false,
							data:{'action':'ambil','idPinjam':id},
							method:'post',
							dataType:'json',
							beforeSend:function () {
								$('.pageLoader').removeAttr('style');
							},
							success:function(dt){ // success
								setTimeout(function(){ //setTimeout
									$('.pageLoader').attr('style','display:none');
									if(dt.status!='success') alert(dt.status);
									else { // else
										$('#confirmModal').modal('hide');
										$('#idAlert_'+id).fadeOut('slow',function(){
											$('#idAlert_'+id).remove();
										});
									} // end of else
								},700); // setTimeout
							} // end of success
						}); // end of ajax
					});// end of on click
				} // end of function

			function sediakanBarang() {
				 $('#lanjutkanForm').removeClass('btn-warning');
				 $('#lanjutkanForm').addClass('btn-success');
						$.ajax({
							url:'dashboardPenjaga/penjagaProses.php',
							data:$('form#sediakanForm').serialize()+'&action=sediakan',
							method:'post',
							dataType:'json',
							beforeSend:function () {
								$('.pageLoader').removeAttr('style');
							},
							success:function(dt){ // success
								setTimeout(function(){ //setTimeout
									$('.pageLoader').attr('style','display:none');
									if(dt.status!='success') alert(dt.status);
									else { // else
										var idPinjam = $('#idPinjam').val();
					 				 // alert(idPinjam);



										$('#formModal').modal('hide');
										$('#idAlert_'+idPinjam).fadeOut('slow',function(){
											$('#idAlert_'+idPinjam).remove();
										});
									} // end of else
								},700); // setTimeout
							} // end of success
						}); // end of ajax
					// });// end of on click
				} // end of function


			 function tolakPeminjaman(id) {
					$('#lanjutkanAmbil').attr('style','display:none;');
					$('#lanjutkanTolak').removeAttr('style');

					$('#lanjutkanTolak').on('click',function(){
						$.ajax({
							url:'notif_peminjaman_proses.php',
							cache:false,
							data:{'action':'tolak','idPinjam':id},
							method:'post',
							dataType:'json',
							beforeSend:function () {
								$('.pageLoader').removeAttr('style');
							},
							success:function(dt){ // success
								setTimeout(function(){ //setTimeout
									$('.pageLoader').attr('style','display:none');
									if(dt.status!='success')
										alert(dt.status);
									else { // else
										$('#confirmModal').modal('hide');
										$('#idAlert_'+id).fadeOut('slow',function(){
											$('#idAlert_'+id).remove();
										});
									} // end of else
								},700); // setTimeout
							} // end of success
						}); // end of ajax
					});// end of on click
				} // end of function

		</script>
</body>

</html>
