<?php  
	include "../koneksi.php";
	error_reporting(0);
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$id_level = $_POST['level'];

	$query = "INSERT INTO user VALUES('', '$username', '$password', '$nama', '$id_level')";
	$sql = mysqli_query($koneksi, $query);
	if($sql){
		header("location:../register.php?pesan=berhasil");
	}else{
		echo "Maaf, terjadi kesalahan saat mencoba untuk menyimpan data ke database";
		echo "<br><a href='../register.php'>Kembali ke Form</a>";
	}
?>