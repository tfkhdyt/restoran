<?php  
	include "../koneksi.php";
	$id_masakan = $_POST['id_masakan'];
	$no_meja = $_POST['no_meja'];
	$tanggal = date('Y-m-d');
	$id_user = $_SESSION['id_user'];
	$jumlah = $_POST['jumlah'];
	$total_harga = $_POST['subtotal'];

	$query = "INSERT INTO cart VALUES ('', '$no_meja', '$tanggal', '$id_user', '', '', '$jumlah', '$total_harga')";
    $result = mysqli_query($koneksi, $query);
    if(!$result){
        	die("Query gagal dijalankan : ".mysqli_errno($koneksi));
		}else{
        	echo"<script>alert('Data berhasil ditambah.');window.location='../index.php';</script>";
		}
?>