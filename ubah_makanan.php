<!DOCTYPE html>
<html>
<head>
	<title>Halaman Ubah Masakan</title>
	<link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="asset/css/fontawesome.min.css">
	<script type="text/javascript" src="asset/js/bootstrap.min.js"></script>
</head>
<body>
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
			</div>
			<div class="card text-white bg-secondary mb-4" style="max-width: 40rem;">
				<div class="card-header">
					<h2 class="page-header text-center">Halaman Ubah Masakan</h2>
				</div>
				<div class="card-body">
					<?php
					include "koneksi.php";
					$id_masakan = $_GET['id_masakan'];
					$query = "SELECT * FROM masakan WHERE id_masakan = '$id_masakan'";
					$result = mysqli_query($koneksi, $query);
					$data = mysqli_fetch_assoc($result);

						// if(isset($_GET['pesan'])){
						// 	if($_GET['pesan']=="berhasil"){
						// 		echo"
						// 		<a href='#' class='close' data-dismiss='alert' arial-label='close'>&times;</a>
						// 		<div class='alert alert-success' role='alert'>Entri berhasil</div>
						// 		";
						// 	}
						// }
					?>
					<form action="proses/proses_ubah_makanan.php" method="post" enctype="multipart/form-data"> 
						<div class="form-group">
							<input type="text" name="id_masakan" value="<?= $data['id_masakan'];  ?>" hidden>
							<label>Nama Makanan</label><br>
							<input type="text" name="nama" class="form-control" placeholder="Nama Makanan" required value="<?= $data['nama_masakan'];  ?>">
							<label>Deskripsi</label><br>
							<textarea class="form-control" name="deskripsi" placeholder="Deskripsi"><?= $data['deskripsi'];  ?></textarea>
							<label>Harga</label><br>
							<input type="number" name="harga" class="form-control" placeholder="Harga" required value="<?= $data['harga'];  ?>">
							<label>Status Masakan</label><br>
							<select name="status_masakan" class="form-control">
								<option value="1"<?php if($data['status_masakan'] == '1'){echo "selected";} ?>>Tersedia</option>
								<option value="0"<?php if($data['status_masakan'] == '0'){echo "selected";} ?>>Habis</option>
							</select>
							<label>Kategori Masakan</label><br>
							<select name="kategori_masakan" class="form-control">
								<option value="Makanan"<?php if($data['kategori_masakan'] == 'Makanan'){echo "selected";} ?>>Makanan</option>
								<option value="Minuman"<?php if($data['kategori_masakan'] == 'Minuman'){echo "selected";} ?>>Minuman</option>
							</select>
							<label>Foto</label><br>
							<img src="asset/gambar/<?php echo $data['kategori_masakan'] ?>/<?= $data['foto'];  ?>" style="height: 120px;float:left;margin-bottom: 5px;">
							<input type="file" name="foto" class="form-control">
							<i>Abaikan jika tidak merubah gambar makanan</i>
							<br>
							<button class="btn btn-success col-sm-12" type="submit">Submit</button>
							
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>