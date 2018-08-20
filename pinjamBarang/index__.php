<?php
session_start();
include '../koneksi.php';
// include '../lib/fungsi.php';
//include '../cek.php';
// include 'lib/lib.php';
$tokopinjam=$_SESSION['toko'];
?>
<html>
<head>
	<script type="text/javascript" src="pinjamBarang/js/jquery-3.3.1.min.js"></script>
	<script src="pinjamBarang/assets/js/bootstrap.min.js"></script>

    <title>Umi Collections</title>
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="dist/css/sb-admin-2.css" rel="stylesheet">

	<style type="text/css">
	.no-js #loader { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	.pageLoader {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;
		background: url(pinjamBarang/assets/images/loading.gif) center no-repeat #fff;
		opacity: 0.7;
	}
	</style>

	<body>
	<div id="page-wrapper">
	  <div class="row">
		<div class="col-lg-12">
		  <h1 class="page-header">Pinjam Barang</h1>
		</div>
		<!-- /.col-lg-12 -->
	  </div>
		<!-- <div class="pageLoader"></div> -->
		<br />

		<?php
			// $jenisBarangList = getDistinctList('barang','jenisBarang','');
			// vd($jenisBaranglist['status']);
		?>

			<div class="card">
				<div class="card-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>jenis</th>
							<th>merk</th>
							<th>ukuran</th>
							<th>toko</th>
							<th>jumlah</th>
						</tr>
						<tr>
							<th>
								<select name="jenisBarangS" id="jenisBarangS">
								</select>
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>


					<form method="post" action="?act=prosesPinjam">
						<?php
							$sql  = 'SELECT DISTINCT(jenisBarang) FROM barang order by jenisBarang asc';
							$exe  = mysqli_query($con,$sql);
						?>
						<div class="form-group row">
							<label for="jenis" class="col-sm-2 col-form-label">Jenis Barang</label>
							<div class="col-sm-10">
								<select onchange="merkcb(this.value);" class="form-control" id="jeniscombo" name="jeniscombo">
									<option value="" selected>- Pilih Jenis -</option>
									<?php
										while ($res=mysqli_fetch_row($exe)){
											echo '<option value="'.$res[0].'">'.$res[0].'</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="merk" class="col-sm-2 col-form-label">Merk Barang</label>
							<div class="col-sm-10">
							<select onchange="ukurancb(this.value,jeniscombo.value);" class="form-control" id="merkcombo" name="merkcombo">
								<option value="" selected>- Pilih Merk -</option>
							</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="ukuran" class="col-sm-2 col-form-label">Ukuran Barang</label>
							<div class="col-sm-10">
							<select onchange="tokocb(this.value,jeniscombo.value,merkcombo.value);" class="form-control" id="ukurancombo" name="ukurancombo">
								<option value="" selected>- Pilih Ukuran -</option>
							</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="toko" class="col-sm-2 col-form-label">Asal Toko</label>
							<div class="col-sm-10">
							<select required onchange="getCurrentStock();" class="form-control" id="tokocombo" name="tokocombo">
								<option value="" selected>- Pilih Asal Toko -</option>
							</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="jumlah" class="col-sm-2 col-form-label">Jumlah Pinjam</label>
							<div class="col-sm-10">
							<!-- epi -->
								<!-- <input type="text" id="stokH"> -->
								<input type="number" xonkeyup="getCurrentStock(this.value);return false;" required class="form-control" name="jumlah" placeholder="Masukkan Jumlah Barang yang akan di pinjam"/>
								<!-- <span id="warningJumlah" styke="display:none;color:red;"></span> -->
							<!-- eof : epi -->
								<!-- <input type="text" class="form-control" name="jumlah" placeholder="Masukkan Jumlah Barang yang akan di pinjam"/> -->
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-10">
								<input type="hidden" class="form-control" name="tokoPinjam" value="<?php echo $tokopinjam;?>"/>
							</div>
						</div>
						<div class="form-group row">
	    	        		<div class="offset-sm-2 col-sm-10">
            					<input type="submit" id="submit" value="Pinjam" class="btn btn-info" />
            				</div>
	            		</div>
					</form>
				</div>
			</div>
	</div>
	</body>

	<script>
		$(document).ready(function(){
			//debugger;
			setTimeout(function(){
				$('.pageLoader').attr('style','display:none');
			}, 700);
		});

		function merkcb(jenis) {
			$.ajax({
				//debugger;
				url:'pinjamBarang/action.php',
				data:{
					'mode':'combomerk',
					'jenis':jenis
				},type:'post',
				dataType:'json',
				beforeSend:function () {
					$('.pageLoader').removeAttr('style');
				},success:function(ret){
					setTimeout(function(){
						$('.pageLoader').attr('style','display:none');

						var opt='';
						if(ret.total==0) opt+='<option>-data kosong-</option>';
						else{
							opt+='<option value="">- Pilih Merk -</option>';
							$.each(ret.returns.data, function  (id,val) {
								opt+='<option value="'+val.merk+'">'+val.merk+'</option>';
							});
						}$('#merkcombo').html(opt);
					}, 700);
				}, error : function (xhr, status, errorThrown) {
					$('.pageLoader').attr('style','display:none');
			        alert('error : ['+xhr.status+'] '+errorThrown);
			    }
			});
		}

		function ukurancb(merk,jenis) {
			$.ajax({
				url:'pinjamBarang/action.php',
				data:{
					'mode':'comboukuran',
					'merk':merk,
					'jenis':jenis
				},type:'post',
				dataType:'json',
				beforeSend:function () {
					$('.pageLoader').removeAttr('style');
				},success:function(ret){
					setTimeout(function(){
						$('.pageLoader').attr('style','display:none');

						var opt='';
						if(ret.total==0) opt+='<option>-data kosong-</option>';
						else{
							opt+='<option value="">- Pilih Ukuran -</option>';
							$.each(ret.returns.data, function  (id,val) {
								opt+='<option value="'+val.ukuran+'">'+val.ukuran+'</option>';
							});
						}$('#ukurancombo').html(opt);
					}, 700);
				}, error : function (xhr, status, errorThrown) {
					$('.pageLoader').attr('style','display:none');
			        alert('error : ['+xhr.status+'] '+errorThrown);
			    }
			});
		}

		function tokocb(ukuran,jenis,merk) {
			$.ajax({
				url:'pinjamBarang/action.php',
				data:{
					'mode':'combotoko',
					'ukuran':ukuran,
					'merk':merk,
					'jenis':jenis
				},type:'post',
				dataType:'json',
				beforeSend:function () {
					$('.pageLoader').removeAttr('style');
				},success:function(ret){
					setTimeout(function(){
						$('.pageLoader').attr('style','display:none');

						var opt='';
						if(ret.total==0) opt+='<option>-data kosong-</option>';
						else{
							opt+='<option value="">- Pilih Asal Toko -</option>';
							$.each(ret.returns.data, function  (id,val) {
								opt+='<option value="'+val.toko+'">'+val.toko+'</option>';
							});
						}$('#tokocombo').html(opt);
					}, 700);
				}, error : function (xhr, status, errorThrown) {
					$('.pageLoader').attr('style','display:none');
			        alert('error : ['+xhr.status+'] '+errorThrown);
			    }
			});
		}

		// function getCurrentStock() {
		// 	$.ajax({
		// 		url:'pinjamBarang/action.php',
		// 		// data: $('form').serialize(),
		// 		data:{
		// 			'mode':'getCurrentStock',
		// 			'ukuran':ukuran,
		// 			'merk':merk,
		// 			'jenis':jenis,
		// 			'toko':toko
		// 		},
		// 		type:'post',
		// 		dataType:'json',
		// 		beforeSend:function () {
		// 			$('.pageLoader').removeAttr('style');
		// 		},success:function(ret){
		// 			setTimeout(function(){
		// 				$('.pageLoader').attr('style','display:none');
		// 				$('#stokH').val(ret.data);
		// 				// $('#warningJumlah').html('max '+ret.data);
		// 				// $('#warningJumlah').removeAttr('style');
		// 				// $('#warningJumlah').removeAttr('style');
		// 			}, 700);
		// 		}, error : function (xhr, status, errorThrown) {
		// 			$('.pageLoader').attr('style','display:none');
		// 	        alert('error : ['+xhr.status+'] '+errorThrown);
		// 	    }
		// 	});
		// }
	</script>

</html>
