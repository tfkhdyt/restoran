<!DOCTYPE html>
<html>
<head>
	<title>Halaman Login</title>
	<link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="asset/css/fontawesome.min.css">
	<script type="text/javascript" src="asset/js/bootstrap.min.js"></script>
</head>
<body>
	<br><br><br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
			</div>
			<div class="card text-white bg-info mb-4" style="width: 25rem;">
				<div class="card-header">
					<h2 class="page-header text-center">Login Restoran</h2>
				</div>
				<div class="card-body">
					<?php
						if(isset($_GET['pesan'])){
							if($_GET['pesan']=="berhasil"){
								echo"
								<a href='#' class='close' data-dismiss='alert' arial-label='close'>&times;</a>
								<div class='alert alert-success' role='alert'>Registrasi Berhasil!</div>
								";
							}else if($_GET['pesan']=="logout"){
								echo"<a href='#' class='close' data-dismiss='alert' arial-label='close'>&times;</a>
								<div class='alert alert-success' role='alert'>Sign Out Berhasil!</div>";
							}else if($_GET['pesan']=="alert"){
								echo"<a href='#' class='close' data-dismiss='alert' arial-label='close'>&times;</a>
								<div class='alert alert-danger' role='alert'>Anda Belum Login!</div>";
							}else if($_GET['pesan']=="gagal"){
								echo"<a href='#' class='close' data-dismiss='alert' arial-label='close'>&times;</a>
								<div class='alert alert-danger' role='alert'>Username Dan Password Anda Salah!</div>";
							}
						}
					?>
					<form action="proses/proses_login.php" method="post">
						<div class="form-group col-sm-12">
							<label>Username</label><br>
							<input type="text" name="username" class="form-control col-sm-12" placeholder="Username">
							<label>Password</label><br>
							<input type="password" name="password" class="form-control" placeholder="Password"><br>
							<button class="btn btn-success col-sm-12" type="submit">Login</button><br><br>
							<a href="index.php" class="btn btn-danger col-xs-4 float-right">Kembali</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>