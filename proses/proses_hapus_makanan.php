<?php  
	include "../koneksi.php";
	$id_masakan = $_GET['id_masakan'];
	$query = "DELETE FROM masakan WHERE id_masakan = '$id_masakan'";
	$hasil_query = mysqli_query($koneksi, $query);
	if(!$hasil_query){
		die("Gagal menghapus data: ".mysqli_errno($koneksi).
			"-".mysqli_error($koneksi));
	}else{
		echo "<script>alert('Data berhasil dihapus.');window.location='../admin.php?menu=daftar_makanan';</script>";
	}
?>