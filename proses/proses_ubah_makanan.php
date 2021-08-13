<?php  
	include "../koneksi.php";
	$id_masakan = $_POST['id_masakan'];
	$nama_masakan = $_POST['nama'];
	$deskripsi = $_POST['deskripsi'];
	$harga = $_POST['harga'];
	$status_masakan = $_POST['status_masakan'];
	$foto = $_FILES['foto']['name'];
	$kategori_masakan = $_POST['kategori_masakan'];

	if ($foto != "") {
	$ekstensi_diperbolehkan = array('png', 'jpg');
	$x = explode('.', $foto);
	$ekstensi = strtolower(end($x));
	$file_tmp = $_FILES['foto']['tmp_name'];
	$angka_acak = rand(1,999);
	$nama_gambar_baru = $angka_acak.'-'.$foto;

	if (in_array($ekstensi, $ekstensi_diperbolehkan) == true) {
		move_uploaded_file($file_tmp, '../asset/gambar/makanan/'.$nama_gambar_baru);
		$query = "UPDATE masakan SET nama_masakan = '$nama_masakan', deskripsi = '$deskripsi', harga = '$harga', status_masakan = '$status_masakan', foto = '$nama_gambar_baru', kategori_masakan = '$kategori_masakan' WHERE id_masakan = '$id_masakan'";
		$result = mysqli_query($koneksi, $query);
		if(!$result){
        	die("Query gagal dijalankan : ".mysqli_errno($koneksi));
        }else{
        	echo"<script>alert('Data berhasil diubah.');window.location='../admin.php?menu=daftar_minuman';</script>";
		}
	}else{
		echo"<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window location='entri_makanan.php';</script>";
	}
	}else{
		$query = "UPDATE masakan SET nama_masakan = '$nama_masakan', deskripsi = '$deskripsi', harga = '$harga', status_masakan = '$status_masakan', kategori_masakan = '$kategori_masakan' WHERE id_masakan = '$id_masakan'";
		$result = mysqli_query($koneksi, $query);
		if(!$result){
        	die("Query gagal dijalankan : ".mysqli_errno($koneksi));
        }else{
        	echo"<script>alert('Data berhasil diubah.');window.location='../admin.php?menu=daftar_minuman';</script>";
		}
	}
?>