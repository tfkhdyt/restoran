<!DOCTYPE html>
<html>
<head>
	<title>Halaman Entri Makanan</title>
	<link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="asset/css/fontawesome.min.css">
	<script type="text/javascript" src="asset/js/bootstrap.min.js"></script>
</head>
<body>
	<br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
			</div>
			<div class="card text-white bg-secondary mb-4" style="max-width: 40rem;">
				<div class="card-header">
					<h2 class="page-header text-center">Halaman Entri Makanan</h2>
				</div>
				<div class="card-body">
					<?php
						if(isset($_GET['pesan'])){
							if($_GET['pesan']=="berhasil"){
								echo"
								<a href='#' class='close' data-dismiss='alert' arial-label='close'>&times;</a>
								<div class='alert alert-success' role='alert'>Entri berhasil</div>
								";
							}else if($_GET['pesan']=="logout"){
								echo"<div class=berhasil>Anda berhasil logout!</div>";
							}else{
								echo"<div class='alert'>Anda belum login!</div>";
							}
						}
					?>
					<form action="proses/proses_entri_makanan.php" method="post" enctype="multipart/form-data"> 
						<div class="form-group">
							<label>Nama Masakan</label><br>
							<input type="text" name="nama" class="form-control" placeholder="Nama Masakan" required>
							<label>Deskripsi</label><br>
							<textarea class="form-control" name="deskripsi" placeholder="Deskripsi"></textarea>
							<label>Harga</label><br>
							<input type="number" name="harga" class="form-control" placeholder="Harga" required>
							<label>Kategori Masakan</label><br>
							<select name="kategori_masakan" class="form-control">
								<option value="Makanan">Makanan</option>
								<option value="Minuman">Minuman</option>
							</select>
							<label>Foto</label><br>
							<input type="file" name="foto" class="form-control" required>
							<br>
							<button class="btn btn-primary col-sm-12" type="submit">Submit</button>
							
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>