<!DOCTYPE html>
<html>
<head>
	<title>Halaman Register</title>
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
			<div class="card text-white bg-success mb-4" style="max-width: 40rem;">
				<div class="card-header">
					<h2 class="page-header text-center">Halaman Register</h2>
				</div>
				<div class="card-body">
					<?php
						if(isset($_GET['pesan'])){
							if($_GET['pesan']=="berhasil"){
								echo"
								<a href='#' class='close' data-dismiss='alert' arial-label='close'>&times;</a>
								<div class='alert alert-success' role='alert'>Registrasi berhasil</div>
								";
							}else if($_GET['pesan']=="logout"){
								echo"<div class=berhasil>Anda berhasil logout!</div>";
							}else{
								echo"<div class='alert'>Anda belum login!</div>";
							

							}
						}
					?>
					<form action="proses/proses_register.php" method="post">
						<div class="form-group">
							<label>Nama</label><br>
							<input type="text" name="nama" class="form-control" placeholder="Nama" required>
							<label>Username</label><br>
							<input type="text" name="username" class="form-control" placeholder="Username" required>
							<label>Password</label><br>
							<input type="password" name="password" class="form-control" placeholder="Password" required>
							<label>Level</label><br>
							<select name="level" class="form-control">
								<option value="1">Administrator</option>
								<option value="2">Waiter</option>
								<option value="3">Kasir</option>
								<option value="4">Owner</option>
								<option value="5">Pelanggan</option>
							</select><br>
							<button class="btn btn-primary col-sm-12" type="submit">Daftar</button>
							<label class="col-sm-12 text-center p-3">Sudah punya akun? Login <a style="color: black;" href="login.php">di sini</a></label>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>